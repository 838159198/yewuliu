<div class="container-fluid">
    <div class="page-header sp-title">
        <h1 class="text-center">工作考核列表（月）<small></small></h1>
    </div>
</div>
<div class="container-fluid">
    <a class="btn btn-primary" href="<?php echo Yii::app()->createUrl("operation/actionCheck/createMonth");?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 创建月工作考核</a>
</div>
<div class="container-fluid">
    <?php $this->widget('zii.widgets.grid.CGridView', array(

        'id' => 'default-grid',
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
//关于分页器这个array，具体还有很多属性，可参考CLinkPager的API
        ),
        'emptyText'=>'暂时没有业务!!!',
        //'filter' => $model,
        'columns' => array(
            //'id',
            array(
                'name'=>'id',
                'value'=>'$data->id',
                'htmlOptions'=>array("style"=>"text-align:center;width:60px;")
            ),
            array(
                'name'=>'title',
                'value'=>'$data->title',
                'type'=>'raw',
            ),
            array(
                'name'=>'mid',
                'value'=>'$data->manages->name',
                //'type'=>'raw',
                'htmlOptions'=>array("style"=>"text-align:center;width:120px;"),
            ),
            array(
                'name'=>'num',
                'value'=>'$data->num',
                'htmlOptions'=>array("style"=>"text-align:center;width:100px;"),
                'type'=>'html',
                //'filter'=>CHtml::listData(OperationPost::model()->listDataStatus,'key','value'),
                //'filter'=>false,
            ),
            array(
                'name'=>'startdatetime',
                'value'=>'$data->startdatetime',
                'htmlOptions'=>array("style"=>"text-align:center;width:150px;"),
                'type'=>'html',
                //'filter'=>CHtml::listData(OperationPost::model()->listDataStatus,'key','value'),
                //'filter'=>false,
            ),
            array(
                'name'=>'enddatetime',
                'value'=>'$data->enddatetime',
                'htmlOptions'=>array("style"=>"text-align:center;width:150px;"),
                'type'=>'html',
                //'filter'=>CHtml::listData(OperationPost::model()->listDataStatus,'key','value'),
                //'filter'=>false,
            ),
            array(
                'header'=>"操作",
                'value'=>'$data->status==1?"<a class=\"label label-warning\" href=\'/operation/actionCheck/all?id=".$data->id."\'><span class=\"glyphicon glyphicon-zoom-in\" aria-hidden=\"true\"></span> 详情</a>":
                    "<a class=\"label label-warning\" href=\'/operation/actionCheck/importCheck?id=".$data->id."\'><span class=\"glyphicon glyphicon-plus\" aria-hidden=\"true\"></span> 导入考核项</a>"',
                'htmlOptions'=>array("style"=>"text-align:center;width:70px;"),
                'type'=>'raw',
                'filter'=>false,
            ),
        ),
    ));
    ?>
</div>

<!-- Modal -->
<div class="modal fade" id="addOperationCart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

        </div>
    </div>
</div>

<div class="modal fade" id="modalTips" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

        </div>
    </div>
</div>