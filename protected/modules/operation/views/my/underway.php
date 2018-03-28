<div class="container-fluid">
    <div class="page-header sp-title">
        <h1 class="text-center">等待回复的业务流<small></small></h1>
    </div>
</div>
<div class="container-fluid"  >
    <a class="btn btn-primary" <span class="glyphicon glyphicon-plus" aria-hidden="true" id="spare_time"></span> 占用业务流时间项</a>
    <a  href="javascript:leave()" class="btn btn-success" <span class="glyphicon glyphicon-plus" aria-hidden="true" id="leave"></span> 添加请假占用</a>
</div>
<div class="form-group" id="tt" style=" width: 60%;height: 50%;text-align: center;margin-left: auto;margin-right: auto;display: none;background-color: #bbbbbb">

    <div class="input-group">
       <input type="text" class="form-control" value="开会占用" id ="spare_time_content">
      <span class="input-group-btn">
        <?php if($status==1){?>
            <button class="btn btn-primary" type="button" onclick="closeSpareTime(<?=$id?>)">关闭</button>
        <?php }else{ ?>
        <button class="btn btn-success" type="button" onclick="addSpareTime()">开启</button>
        <?php }?>
      </span>
    </div>
    <table border="1" cellpadding="3" cellspacing="0" style="width: 100%;margin:auto">
        <tr style="height: 50px;background-color: #337ab7">
            <td>ID</td>
            <td>占用事项</td>
            <td>开启时间</td>
            <td>占用时间</td>
            <td>开关状态</td>
        </tr>
        <?php foreach($spareTime as $spareTime_row):?>
            <?php if($spareTime_row['content'] !='请假占用'){?>
            <tr style="height: 50px">
             <?php }else{ ?>
                <tr style="height: 50px; background-color: lightyellow">
           <?php } ?>
                <td><?=$spareTime_row['id']?></td>
                <td><?=$spareTime_row['content']?></td>
                <td><?php echo date("Y-m-d H:i:s", $spareTime_row['start_datetime'])?></td>
                <td>
                    <?php
                    if($spareTime_row['developtime']==0){
                        $res='--';
                    }else{

                        $cha_feng=$spareTime_row['developtime'];
                        if($cha_feng>=60){
                            $stay_hour=floor($cha_feng/60);
                            $stay_min=$cha_feng%60;
                            $res=$stay_hour.'小时';
                            $stay_min!=0 && $res.=$stay_min.'分钟';
                        }else{
                            $res=$cha_feng.'分钟';
                        }
                    }
                    echo $res;
                    ?>
                </td>
                <td <?php if($spareTime_row['status']==1){?>bgcolor="red"<?php }?>>
                    <?php

                    if($spareTime_row['status']==1){
                        echo '开启';
                    }else{
                        echo '关闭';
                    }
                    ?>
                </td>
            </tr>
        <?php endforeach;?>
    </table>

</div>

<div class="container-fluid">
    <?php $this->widget('zii.widgets.grid.CGridView', array(

        'id' => 'default-grid',
        'dataProvider' => $model->underwaydata(Yii::app()->getRequest()->getQuery('status')),
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
                'name'=>'sc_id',
                'value'=>'empty($data->sitecategory)?"--":$data->sitecategory->aliasname',
                'htmlOptions'=>array("style"=>"text-align:center;width:70px;"),
                'filter'=>CHtml::listData(OperationPost::model()->ListDataSiteCategory,'id','aliasname'),
            ),
            array(
                'name'=>'priority',
                'value'=>'$data->Xpriority',
                'htmlOptions'=>array("style"=>"text-align:center;width:60px;"),
                'type'=>'html',
                'filter'=>CHtml::listData(OperationPost::model()->listDataPriority,'key','value'),
            ),
            array(
                'name'=>'title',
                'value'=>'$data->xtitle',
                'type'=>'raw',
            ),
            array(
                'name'=>'estimate',
                'value'=>'Helper::FormattingTime($data->estimate)',
                'type'=>'raw',
                'htmlOptions'=>array("style"=>"text-align:center;width:80px;"),
                'filter'=>false,
            ),
            array(
                'name'=>'manage_create_name',
                'value'=>'empty($data->manage_create)?"发生错误":$data->manage_create->name',
                'htmlOptions'=>array("style"=>"text-align:center;width:80px;"),
            ),
            array(
                'name'=>'manage_receive_name',
                'value'=>'empty($data->manage_receive)?"--":$data->manage_receive->name',
                'htmlOptions'=>array("style"=>"text-align:center;width:80px;"),
            ),
            // array(
            //     'name'=>'manage_owner_name',
            //     'value'=>'empty($data->manage_owner)?"--":$data->manage_owner->name',
            //     'htmlOptions'=>array("style"=>"text-align:center;width:80px;"),
            // ),

            array(
                'name'=>'create_datetime',
                'value'=>'$data->create_datetime',
                'htmlOptions'=>array("style"=>"text-align:center;width:130px;"),
                //'filter'=>false,
            ),
            array(
                'name'=>'modifytime',
                'value'=>'date("Y-m-d H:i:s",$data->modifytime)',
                'htmlOptions'=>array("style"=>"text-align:center;width:130px;"),
                //'filter'=>false,
            ),

            array(
                'name'=>'status',
                'value'=>'$data->xstatus',
                'htmlOptions'=>array("style"=>"text-align:center;width:100px;"),
                'type'=>'html',
                //'filter'=>CHtml::listData(OperationPost::model()->listDataStatus,'key','value'),
                //'filter'=> CHtml::dropDownList('OperationPost[status]','', CHtml::listData(OperationPost::model()->listDataStatus,'key','value')), 'htmlOptions' => array('style' => 'text-align:center'),
                'filter'=>false,
            ),

            array(
                'name'=>'cur_status',
                'value'=>'"<a href=\'javascript:curStatus(".$data->id.",".$data->cur_status.")\' id=status_$data->id>$data->xcur_status</a>"',
                'htmlOptions'=>array("style"=>"text-align:center;width:100px;"),
                'type'=>'raw',
                'filter'=>false,
            ),

            array(
                'header'=>"操作",
                'value'=>'($data->receive_mid==Yii::app()->user->id)?"<a class=\"label label-danger\" href=\'javascript:rollbackTips(".$data->id.")\'><span class=\"glyphicon glyphicon-remove-sign\" aria-hidden=\"true\"></span> 退回</a>":""',
                'htmlOptions'=>array("style"=>"text-align:center;width:70px;"),
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
                'template'=>'{update}{delete}',//{delete}
                'afterDelete'=>'function(link,success,data){alert(data) }',
                'buttons'=>array(),
            ),*/
        ),
    ));
    ?>
</div>
<div class="modal fade" id="tt_leave" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        </div>
    </div>
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
<script type="text/javascript">
    $("#spare_time").click(function(){
       $('#tt').slideToggle(1000);
      //  alert(666);
    });


</script>