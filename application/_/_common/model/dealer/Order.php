<?php

namespace app\common\model\dealer;

use app\common\model\BaseModel;

/**
 * 分销商订单模型
 * Class Apply
 * @package app\common\model\dealer
 */
class Order extends BaseModel
{
    protected $name = 'dealer_order';

    /**
     * 订单所属用户
     * @return \think\model\relation\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('app\common\model\User');
    }

    /**
     * 订单详情信息
     * @return \think\model\relation\BelongsTo
     */
    public function orderMaster()
    {
        return $this->belongsTo('app\common\model\Order');
    }

    /**
     * 一级分销商用户
     * @return \think\model\relation\BelongsTo
     */
    public function dealerFirst()
    {
        return $this->belongsTo('User', 'first_user_id');
    }

    /**
     * 二级分销商用户
     * @return \think\model\relation\BelongsTo
     */
    public function dealerSecond()
    {
        return $this->belongsTo('User', 'second_user_id');
    }

    /**
     * 三级分销商用户
     * @return \think\model\relation\BelongsTo
     */
    public function dealerThird()
    {
        return $this->belongsTo('User', 'third_user_id');
    }

    /**
     * 订单详情
     * @param $order_id
     * @return Order|null
     * @throws \think\exception\DbException
     */
    public static function detail($order_id)
    {
        return static::get(['order_id' => $order_id]);
    }

    /**
     * 发放分销订单佣金
     * @param $order_id
     * @return bool|false|int
     * @throws \think\Exception
     * @throws \think\exception\DbException
     */
    public static function grantMoney($order_id)
    {
        // 分销订单详情
        $model = static::detail($order_id);
        if (!$model || $model['is_settled'] == 1) {
            return false;
        }
        // 发放一级分销商佣金
        $model['first_user_id'] > 0 && User::grantMoney($model['first_user_id'], $model['first_money']);
        // 发放二级分销商佣金
        $model['second_user_id'] > 0 && User::grantMoney($model['second_user_id'], $model['second_money']);
        // 发放三级分销商佣金
        $model['third_user_id'] > 0 && User::grantMoney($model['third_user_id'], $model['third_money']);
        return $model->save(['is_settled' => 1, 'settle_time' => time()]);
    }

}
