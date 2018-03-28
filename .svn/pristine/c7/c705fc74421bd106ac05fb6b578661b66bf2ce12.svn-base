<div class="container-fluid">
    <div class="page-header sp-title">
        <h1 class="text-center">公共业务池<small></small></h1>
    </div>
</div>
<div class="container-fluid">
    <a class="btn btn-primary" href="<?php echo Yii::app()->createUrl("operation/default/create");?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 创建业务流</a>
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
                'htmlOptions'=>array("style"=>"text-align:center;width:90px;")
            ),
            array(
                'name'=>'priority',
                'value'=>'$data->Xpriority',
                'htmlOptions'=>array("style"=>"text-align:center;width:60px;"),
                'type'=>'html',
                'filter'=>CHtml::listData(OperationPost::model()->listDataPriority,'key','value'),
            ),
            array(
                'name'=>'sc_id',
                'value'=>'empty($data->sitecategory)?"--":$data->sitecategory->aliasname',
                'htmlOptions'=>array("style"=>"text-align:center;width:90px;"),
                'filter'=>CHtml::listData(OperationPost::model()->ListDataSiteCategory,'id','aliasname'),
            ),

            array(
                'name'=>'departmentId',
                'value'=>'empty($data->post_department)?"--":$data->post_department->name',
                'htmlOptions'=>array("style"=>"text-align:center;width:100px;"),
                'type'=>'html',
                'filter'=>CHtml::listData(OperationDepartment::model()->ListData,'id','name'),
            ),
            array(
                'name'=>'title',
                'value'=>'$data->xtitle',
                'type'=>'raw',
                //'htmlOptions'=>array(),
            ),
            array(
                'name'=>'manage_create_name',
                'value'=>'empty($data->manage_create)?"发生错误":$data->manage_create->name',
                'htmlOptions'=>array("style"=>"text-align:center;width:100px;"),
            ),



            array(
                'name'=>'create_datetime',
                'value'=>'$data->create_datetime',
                'htmlOptions'=>array("style"=>"text-align:center;width:150px;"),
                //'filter'=>false,
            ),
            array(
                'name'=>'status',
                'value'=>'$data->xstatus',
                'htmlOptions'=>array("style"=>"text-align:center;width:100px;"),
                'type'=>'html',
                'filter'=>CHtml::listData(OperationPost::model()->listDataStatus,'key','value'),
                //'filter'=> CHtml::dropDownList('OperationPost[status]','', CHtml::listData(OperationPost::model()->listDataStatus,'key','value')), 'htmlOptions' => array('style' => 'text-align:center'),
                //'filter'=>false,
            ),
            array(
                'header'=>"操作",
                'value'=>'"<a class=\"label label-warning\" href=\'javascript:addOperationTips(".$data->id.")\'><span class=\"glyphicon glyphicon-shopping-cart\" aria-hidden=\"true\"></span> 加入</a>"',
                'htmlOptions'=>array("style"=>"text-align:center;width:100px;"),
                'type'=>'raw',
                'filter'=>false,
            ),



            /*array(
                'header'=>'操作',
                'class' => 'CButtonColumn',
                //'viewButtonUrl'=>'Yii::app()->createUrl("development/softPutRecord/detail",array("id"=>$data->id));',
                'updateButtonUrl'=>'Yii::app()->createUrl("manage/memberGroup/update",array("id"=>$data->id));',
                //'deleteButtonUrl'=>'Yii::app()->createUrl("manage/article/del",array("id"=>$data->id));',
                //'template' => $template,
                'template'=>'{update}',//{delete}
                'afterDelete'=>'function(link,success,data){alert(data) }',
                'buttons'=>array(

                ),

            ),*/
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
<?php
//成功回复后的状态显示
if (Yii::app()->user->hasFlash("create_status")):?>
    <button type="button" id="create_status_button" class="btn btn-primary" style="display: none;" data-toggle="modal" data-target="#create_status">Small modal</button>
    <div class="modal fade bs-example-modal-sm" id="create_status" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel"><b>温馨提示</b></h4>
                </div>
                <div class="modal-body">
                    <p>恭喜你，业务流创建成功！</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                </div>
            </div>
        </div>
    </div>
    <script>document.getElementById("create_status_button").click();</script>
<?php endif;?>