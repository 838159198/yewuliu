<div class="container-fluid">
    <div class="page-header sp-title">
        <h1 class="text-center">用户列表<small></small></h1>
    </div>
</div>
<div class="container-fluid">
    <a class="btn btn-primary" href="<?php echo Yii::app()->createUrl("operation/manage/create");?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 添加用户</a>
</div>
<div class="container-fluid">
    <?php $this->widget('zii.widgets.grid.CGridView', array(

        'id' => 'default-grid',
        'dataProvider' => $model->search(),
        'cssFile'=>false,
        'pagerCssClass'=>'yiipage text-center',
        'pager'=>array(
            'class'=>'CLinkPager',
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
        'emptyText'=>'没有发现用户',
        'filter' => $model,
        'columns' => array(
            //'id',
            array(
                'name'=>'id',
                'value'=>'$data->id',
                'htmlOptions'=>array("style"=>"text-align:center;width:90px;")
            ),
            array(
                'name'=>'username',
                'value'=>'$data->username',
                'htmlOptions'=>array("style"=>"text-align:left;")
            ),
            array(
                'name'=>'name',
                'value'=>'$data->name',
                'htmlOptions'=>array("style"=>"text-align:center;"),
                //'filter'=>CHtml::listData(Manage::model()->findAll("status=1"),'name','name'),
            ),
            array(
                'name'=>'role',
                'value'=>'$data->roles->name',
                'htmlOptions'=>array("style"=>"text-align:center;width:100px;"),
                'filter'=>CHtml::listData(Role::model()->findAll(),'id','name'),
            ),
            array(
                'name'=>'department',
                'value'=>'(empty($data->departments))?"--":$data->departments->department',
                'htmlOptions'=>array("style"=>"text-align:center;width:150px;"),
                'filter'=>CHtml::listData(Department::model()->findAll("f_id!=0"),'id','department'),
            ),

            array(
                'name'=>'create_num',
                'value'=>'$data->create_num',
                'htmlOptions'=>array("style"=>"text-align:center;width:90px;")
            ),



            array(
                'name'=>'underway_num',
                'value'=>'$data->underway_num',
                'htmlOptions'=>array("style"=>"text-align:center;width:90px;"),

            ),
            array(
                'name'=>'complete_num',
                'value'=>'$data->complete_num',
                'htmlOptions'=>array("style"=>"text-align:center;width:90px;"),

            ),

            array(
                'name'=>'rollback_num',
                'value'=>'$data->rollback_num',
                'htmlOptions'=>array("style"=>"text-align:center;width:90px;"),

            ),
            array(
                'name'=>'developmenttimes',
                'value'=>'Helper::FormattingTime($data->developmenttimes)',
                'htmlOptions'=>array("style"=>"text-align:center;width:180px;"),

            ),
            array(
                'name'=>'credits',
                'value'=>'$data->credits',
                'htmlOptions'=>array("style"=>"text-align:center;width:90px;")
            ),
            array(
                'name'=>'status',
                'value'=>'$data->xstatus',
                'htmlOptions'=>array("style"=>"text-align:center;width:60px;"),
                'type'=>'html',

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
                //'viewButtonUrl'=>'Yii::app()->createUrl("development/softPutRecord/detail",array("id"=>$data->id));',
                'updateButtonUrl'=>'Yii::app()->createUrl("operation/manage/update",array("id"=>$data->id));',
                'deleteButtonUrl'=>'Yii::app()->createUrl("operation/manage/del",array("id"=>$data->id));',
                //'template' => $template,
                'template'=>'{update}',//{delete}
                'afterDelete'=>'function(link,success,data){alert(data) }',
                'buttons'=>array(),
            ),
        ),
    ));
    ?>
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
                    <p><?php echo Yii::app()->user->getFlash("create_status");?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                </div>
            </div>
        </div>
    </div>
    <script>document.getElementById("create_status_button").click();</script>
<?php endif;?>