# 表格

---



### 基础表格 【不分页 没有工具栏 不搜索】
```
<table class="shamtable table table-striped" >
<thead>
    <tr>
    <th data-field="id">ID</th>
    <th data-field="name">名称</th>
    <th data-field="price">价格</th>
    <th data-field="operation"
        data-formatter="actionFormatter"
        data-events="actionEvents">操作</th>
    </tr>
</thead>
<tbody>
    <tr>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
    </tr>
</tbody>
</table>

//value: 所在collumn的当前显示值，
//row:整个行的数据 ，对象化，可通过.获取
//表格-操作 - 格式化
function actionFormatter(value, row, index) {
    return '<a class="mod" rel=/id='+row.id+'>修改</a> ' + '<a class="delete">删除</a>';
}
//表格  - 操作 - 事件
window.actionEvents = {
    'click .mod': function(e, value, row, index) {
        alert('修改')
        //修改操作
    },
    'click .delete' : function(e, value, row, index) {
        alert('删除')
        //删除操作
    }
}

$(document).ready(function () {

    $('.shamtable').bootstrapTable({
    });

});
```

---

### 基础功能
```
<div class="btn-group hidden-xs" id="shamTableEventsToolbar" >
    <button type="button" class="btn btn-outline btn-default">
        <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
    </button>
    <button type="button" class="btn btn-outline btn-default">
        <i class="glyphicon glyphicon-heart" aria-hidden="true"></i>
    </button>
    <button type="button" class="btn btn-outline btn-default">
        <i class="glyphicon glyphicon-trash" aria-hidden="true"></i>
    </button>
</div>
<table class="shamtable table table-striped" >
 <thead>
 <tr>
     <th data-field="state" data-checkbox="true"></th>
     <th data-field="id">ID</th>
     <th data-field="name">名称</th>
     <th data-field="price">价格</th>
     <th data-field="operation"
         data-formatter="actionFormatter"
         data-events="actionEvents">操作</th>
 </tr>
 </thead>
</table>

//value: 所在collumn的当前显示值，
//row:整个行的数据 ，对象化，可通过.获取
//表格-操作 - 格式化
function actionFormatter(value, row, index) {
    return '<a class="mod" rel=/id='+row.id+'>修改</a> ' + '<a class="delete">删除</a>';
}
//表格  - 操作 - 事件
window.actionEvents = {
    'click .mod': function(e, value, row, index) {
        alert('修改')
        //修改操作
    },
    'click .delete' : function(e, value, row, index) {
        alert('删除')
        //删除操作
    }
}

$(document).ready(function () {

    $('.shamtable').bootstrapTable({
        url: '/plus/demo/bootstrap_table_test.json',
        search: true,  //是否显示搜索框功能
        pagination: true,  //是否分页
        showRefresh: true, //是否显示刷新功能
        showToggle: true,
        showColumns: true,
        iconSize: 'outline',
        toolbar: '#shamTableEventsToolbar', // 可以在table上方显示的一条工具栏，
    });

});
```
