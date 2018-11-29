<?php

namespace app\api\model\dealer;

use app\common\model\dealer\Order as OrderModel;

/**
 * 分销商订单模型
 * Class Apply
 * @package app\api\model\dealer
 */
class Order extends OrderModel
{
    /**
     * 隐藏字段
     * @var array
     */
    protected $hidden = [
        'update_time',
    ];

    /**
     * 获取分销商订单列表
     * @param $user_id
     * @param int $is_settled
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public function getList($user_id, $is_settled = -1)
    {
        $this->with(['user', 'orderMaster'])
            ->where('first_user_id|second_user_id|third_user_id', '=', $user_id);
        $is_settled > -1 && $this->where('is_settled', '=', !!$is_settled);
        return $this->order(['create_time' => 'desc'])
            ->paginate(15, false, [
                'query' => \request()->request()
            ]);
    }

    /**
     * 创建分销商订单记录
     * @param $order
     * @param $goods_list
     * @return bool|false|int
     * @throws \think\exception\DbException
     */
    public static function createOrder(&$order, &$goods_list)
    {
        // 分销订单模型
        $model = new self;
        // 分销商基本设置
        $setting = Setting::getItem('basic');
        // 是否开启分销功能
        if (!$setting['is_open']) return false;
        // 计算分销信息
        $commission = $model->commissions($order['user_id'], $goods_list, $setting['level']);
        // 非分销订单
        if (!$commission['first_user_id']) {
            return false;
        }
        // 订单总金额(不含运费)
        $orderPrice = bcsub($order['pay_price'], $order['express_price'], 2);
        // 保存分销订单记录
        return $model->save([
            'user_id' => $order['user_id'],
            'order_id' => $order['order_id'],
            'order_no' => $order['order_no'],
            'order_price' => $orderPrice,
            'first_user_id' => $commission['first_user_id'],
            'second_user_id' => $commission['second_user_id'],
            'third_user_id' => $commission['third_user_id'],
            'first_money' => max($commission['first_money'], 0),
            'second_money' => max($commission['second_money'], 0),
            'third_money' => max($commission['third_money'], 0),
            'is_settled' => 0,
            'wxapp_id' => $model::$wxapp_id
        ]);
    }

    /**
     * 计算分销总佣金
     * @param $user_id
     * @param $goods_list
     * @param $level
     * @return array
     * @throws \think\exception\DbException
     */
    private function commissions($user_id, $goods_list, $level)
    {
        // 佣金设置
        $setting = Setting::getItem('commission');
        $data = [
            'first_money' => 0.00,  // 一级分销佣金
            'second_money' => 0.00, // 二级分销佣金
            'third_money' => 0.00   // 三级分销佣金
        ];
        // 计算分销佣金
        foreach ($goods_list as $goods) {
            $level >= 1 && $data['first_money'] += ($goods['total_pay_price'] * ($setting['first_money'] * 0.01));
            $level >= 2 && $data['second_money'] += ($goods['total_pay_price'] * ($setting['second_money'] * 0.01));
            $level == 3 && $data['third_money'] += ($goods['total_pay_price'] * ($setting['third_money'] * 0.01));
        }
        // 记录分销商用户id
        $data['first_user_id'] = $level >= 1 ? Referee::getRefereeUserId($user_id, 1, true) : 0;
        $data['second_user_id'] = $level >= 2 ? Referee::getRefereeUserId($user_id, 2, true) : 0;
        $data['third_user_id'] = $level == 3 ? Referee::getRefereeUserId($user_id, 3, true) : 0;
        return $data;
    }

}