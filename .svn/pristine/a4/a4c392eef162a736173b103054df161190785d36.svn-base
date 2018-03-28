<div class="container-fluid">
    <div class="page-header sp-title">
        <h1 class="text-center">周总结列表<small></small></h1>
    </div>
</div>
<div class="container-fluid">
    <a class="btn btn-primary" href="<?php echo Yii::app()->createUrl("operation/summary/create");?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 创建周总结</a>
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
        'filter' => $model,
        'columns' => array(
            //'id',
            array(
                'name'=>'id',
                'value'=>'$data->id',
                'htmlOptions'=>array("style"=>"text-align:center;width:40px;")
            ),

            array(
                'name'=>'projectnum',
                'value'=>'$data->projectnum',
                'type'=>'raw',
            ),
            array(
                'name'=>'mid',
                'value'=>'$data->mid',
                //'type'=>'raw',
                'htmlOptions'=>array("style"=>"text-align:center;width:80px;"),
            ),

            array(
                'name'=>'createdatetime',
                'value'=>'$data->createdatetime',
                'htmlOptions'=>array("style"=>"text-align:center;width:100px;"),
                'type'=>'html',
                //'filter'=>CHtml::listData(OperationPost::model()->listDataStatus,'key','value'),
                //'filter'=> CHtml::dropDownList('OperationPost[status]','', CHtml::listData(OperationPost::model()->listDataStatus,'key','value')), 'htmlOptions' => array('style' => 'text-align:center'),
                //'filter'=>false,
            ),
            /*array(
                'header'=>"操作",
                'value'=>'($data->status==1)?"<a class=\"label label-warning\" href=\'javascript:addOperationTips(".$data->id.")\'><span class=\"glyphicon glyphicon-shopping-cart\" aria-hidden=\"true\"></span> 加入</a>":""',
                'htmlOptions'=>array("style"=>"text-align:center;width:70px;"),
                'type'=>'raw',
                'filter'=>false,
            ),*/



            array(
                'header'=>'操作',
                'class' => 'CButtonColumn',
                'viewButtonUrl'=>'Yii::app()->createUrl("development/softPutRecord/detail",array("id"=>$data->id));',
                //'updateButtonUrl'=>'Yii::app()->createUrl("manage/memberGroup/update",array("id"=>$data->id));',
                //'deleteButtonUrl'=>'Yii::app()->createUrl("manage/article/del",array("id"=>$data->id));',
                //'template' => $template,
                'template'=>'{view}',//{update}{delete}
                'afterDelete'=>'function(link,success,data){alert(data) }',
                'buttons'=>array(),
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