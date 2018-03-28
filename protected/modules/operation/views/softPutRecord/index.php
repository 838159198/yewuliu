<style type="text/css">
    /*.grid-view{ font-size: 16px; font-family:  "宋体", Arial, sans-serif}
    .grid-view .filters input, .grid-view .filters select{ width: 90%;}*/
</style>
<div class="container-fluid">
    <div class="page-header sp-title">
        <h1 class="text-center">软件投放信息列表<small></small></h1>
    </div>
</div>
<div class="container-fluid">
    <a class="btn btn-primary" href="<?php echo Yii::app()->createUrl("operation/softPutRecord/create");?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 信息录入</a>
</div>
<?php
//判断是否有提示信息
if(Yii::app()->user->hasFlash('copy')){?>
    <script type="text/javascript">alert("复制成功！");</script>
    <div class="alert alert-success">
        <b><?php echo Yii::app()->user->getFlash('copy');?></b>

    </div>
<?php }?>
<?php
if(Yii::app()->user->hasFlash('edit_fail')){?>
    <div class="alert alert-success">
        <b><?php echo Yii::app()->user->getFlash('edit_fail');?></b>

    </div>
<?php }?>
<div class="container-fluid">
<?php
 $this->widget('zii.widgets.CMenu', array(
    'items' => $this->menu,
    'htmlOptions' => array('class' => 'breadcrumb')
));

$template = '';


$this->widget('zii.widgets.grid.CGridView', array(

    'id' => 'admin-grid',
    'dataProvider' => $model->search(),
    'cssFile'=>false,
    'pagerCssClass'=>'yiipage text-center',
    'pager'=>array(
        'class'=>'CLinkPager',//定义要调用的分页器类，默认是CLinkPager，需要完全自定义，还可以重写一个，参考我的另一篇博文：http://blog.sina.com.cn/s/blog_71d4414d0100yu6k.html
        //'pagerClass'=>'pagination11',
        'cssFile'=>false,//定义分页器的要调用的css文件，false为不调用，不调用则需要亲自己css文件里写这些样式
        'header'=>'',//定义的文字将显示在pager的最前面
        'footer'=>'',//定义的文字将显示在pager的最后面
        'firstPageLabel'=>'首页',//定义首页按钮的显示文字
        'lastPageLabel'=>'尾页',//定义末页按钮的显示文字
        'nextPageLabel'=>'下一页',//定义下一页按钮的显示文字
        'prevPageLabel'=>'前一页',//定义上一页按钮的显示文字
        //'firstPageCssClass'=>'pager_first',//default "first"
        //'lastPageCssClass'=>'pager_last',//default "last"
        //'previousPageCssClass'=>'pager_previous',//default "previours"
        //'nextPageCssClass'=>'pager_next',//default "next"
        'internalPageCssClass'=>'',//default "page"
        'selectedPageCssClass'=>'active',//default "selected"
        'hiddenPageCssClass'=>'disabled',//default "hidden"
        'maxButtonCount'=>8,
        'htmlOptions'=>array("class"=>"pagination"),
    ),
    'filter' => $model,
    'htmlOptions'=>array('a'=>'b'),
    'columns' => array(
        /*array (
            'selectableRows' => 2, //允许多选，改为 0 时代表不允许修改，1 的话为单选
            'class' => 'CCheckBoxColumn' ,
            'name' => 'id' ,//取value值为id对应的值
            'id'=>'select',//取name为select数组
            ),*/
        array(
            'name'=>'id',
            'value'=>'$data->id',
            'filter'=>false,
            'htmlOptions'=>array('style'=>'width:40px;text-align:center;'),
        ),
        array(
            'name'=>'customer_name',
            'value'=>'$data->customer_name',
            'htmlOptions'=>array('style'=>'width:150px;'),
            //'filter'=>false,
        ),
        'service_name',
        array(
            'name'=>'version',
            'value'=>'$data->version',
            'htmlOptions'=>array('style'=>'width:150px;'),
            //'filter'=>false,
        ),
        //'update_datetime',
        array(
            'name'=>'update_datetime',
            'value'=>'$data->update_datetime',
            'htmlOptions'=>array('style'=>'width:90px;text-align:center;'),
            //'filter'=>false,
        ),
        array(
            'name'=>'md5',
            'value'=>'$data->md5',
            'htmlOptions'=>array('style'=>'text-align:center;width:260px;'),

        ),
        array(
            'name'=>'username',
            'value'=>'$data->user->name',
            'htmlOptions'=>array('style'=>'text-align:center;width:60px;'),
            'filter'=>false,
        ),
        array(
            'header'=>'复制',
            'type'=>'raw',
            'value'=>'CHtml::link(CHtml::encode("复制"), array("copy","id"=>$data->id))',
            'htmlOptions'=>array('style'=>'text-align:center;width:50px;'),
            //'filter'=>false,
        ),

        array(
            'header'=>'操作',
            'class' => 'CButtonColumn',
            'viewButtonUrl'=>'Yii::app()->createUrl("operation/softPutRecord/detail",array("id"=>$data->id));',
            'updateButtonUrl'=>'Yii::app()->createUrl("operation/softPutRecord/edit",array("id"=>$data->id));',
            'deleteButtonUrl'=>'Yii::app()->createUrl("operation/softPutRecord/del",array("id"=>$data->id));',

            //'template' => $template,
            'template'=>'{view}{update}{delete}',
            'afterDelete'=>'function(link,success,data){alert(data) }',
            'buttons'=>array(
                //根据权限判断是否显示按钮
                'view'=>array(
                    'options'=>array("target"=>"_blank"),
                ),
                'update'=>array(
                    'visible'=>'$data->xrole',
                ),
                'delete'=>array(
                    'visible'=>'$data->xrole',
                ),
                /*演示代码测试
                 * 'print'=>array(
                    'label'=>'打印',
                    'url'=>'Yii::app()->controller->createUrl("print", array("id"=>$data->id))',
                    'options'=>array("target"=>"_blank","onclick"=>"return del()"),
                ),*/
                /*'delete'=>array(
                    'options'=>array("onclick"=>"return del()"),
                    'click'=>"none",
                //根据权限隐藏按钮
                    'visible'=>'false',
                ),*/
            ),
           /* 'footer' => '<button type="button" style="width:76px">批量删除</button>',*/

    ),
    ),
));
?>
</div>
