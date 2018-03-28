<div class="container-fluid">
    <div class="page-header  sp-title">
        <h1 class="text-center"><?php echo $summaryData->summaryWeeks->title?><small></small></h1>
    </div>
</div>
<div class="alert alert-info" style="margin-left:16px;margin-right: 15px;">
    <h4>注：每周五14:00结束所有业务流，15:00之前提交本周工作总结，故实际每周总工作时长最大为36-37小时</h4>
</div>
<div class="container-fluid" style="margin-bottom: 20px">

    目前状态：<?php if($summaryData['status']==0){?>
        <span class="label label-danger">未完成</span>
    <?php }else{?>
        <span class="label label-success">完成</span>
    <?php }?>
<?php if($summaryData['status']==0){?>
    <!--<a href="javascript:summaryProjectAddModal(<?php /*echo $summaryData['id']*/?>)" class="btn btn-success">添加数据</a>-->
    <a href="javascript:summaryProjectAddWeek(<?php echo $summaryData['id']?>)" class="btn btn-success">周工作总结</a>
<?php }?>
</div>
<div class="container-fluid">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th width="300">名称</th>
                <th width="70">姓名</th>
                <th width="160">接收时间</th>
                <th width="120">预估时间</th>

                <th width="150">本周停留时间</th>
                <th width="150">总停留时间</th>
                <th width="85">工作进度</th>
                <th width="100">目前拥有者</th>
                <th>备注</th>
                <th width="85">操作</th>
            </tr>
        </thead>
        <tbody>
        <?php $count=0;$count1=0;$count2=0; foreach($summaryProjectData as $project_row):?>
            <tr>
                <td><a href="<?php echo '/operation/default/detail?id='.$project_row['postid']?>" target="_blank"><?php echo $project_row['name']?></a></td>
                <td><?php echo $project_row['username'];?></td>
                <td>
                    <?php
                    $owiner=OperationPost::model()->findByPk($project_row['postid']);
                    echo $owiner['receive_datetime'];
                    ?>
                </td>

                <td><?php $count1=$count1+$project_row['estimate'];echo Helper::FormattingTime($project_row['estimate']);?></td>

                <td><?php $count=$count+$project_row['developmenttime']; echo Helper::FormattingTime($project_row['developmenttime']);?></td>
                <td><?php $count2=$count2+OperationOnoff::getAllDeveloptime($project_row['postid'], Yii::app()->user->id,$summaryData->summaryWeeks->endtime);
                    echo  Helper::FormattingTime(OperationOnoff::getAllDeveloptime($project_row['postid'], Yii::app()->user->id,$summaryData->summaryWeeks->endtime));?></td>
                <td><?php echo $project_row['xstatus'];?></td>
                <td>
                    <?php
                    $man=Manage::model()->findByPk($owiner['owner_mid']);
                    echo $man["name"];
                    ?>
                </td>
                <td><?php echo $project_row['remarks'];?></td>
                <td><a class="label label-primary" href="javascript:summaryAddRemarksModal(<?php echo $project_row['id']?>)">添加备注</a></td>
            </tr>
        <?php endforeach;?>

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>总：<?php echo Helper::FormattingTime($count1);?></td>
            <td>总：<?php echo Helper::FormattingTime($count);?></td>
            <td>总：<?php echo Helper::FormattingTime($count2);?></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td rowspan="4" >周工作总结</td>
            <td colspan="8"><textarea rows="5" class="form-control" id="project_remarks" readonly><?=$r; ?></textarea></td>
        </tr>
        </tbody>
    </table>
</div>
<div class="alert alert-danger" style="margin-left:16px;margin-right: 15px;" id="spare_time">
    <h4>注：本周占用的时间（单击显示详情）</h4>
</div>
<div class="container-fluid" id="tt" style="display: none">
    <!--占用时间-->
    <table class="table table-bordered table-hover" style="margin-top: 5px;">
        <thead style="background-color: #5ba0c9">
        <tr>
            <th width="300">占用事项</th>
            <th width="70">开启时间</th>
            <th width="160">关闭时间</th>
            <th width="120">占用时间</th>
        </tr>
        </thead>
        <tbody>
        <?php $count3=0;

        $spareTimes=SpareTimeOnoff::findSpareTimeByUid(Yii::app()->user->id,$summaryData->stattime,$summaryData->endtime);foreach($spareTimes as $spareTime):?>
            <?php if($spareTime['content'] !='请假占用'){?>
                <tr style="height: 50px">
            <?php }else{ ?>
                <tr style="height: 50px; background-color: lightyellow">
            <?php } ?>

                <td><?php echo $spareTime['content']; ?></td>
                <td><?php echo date("Y-m-d H:i:s", $spareTime['start_datetime'])?></td>
                <td><?php echo date("Y-m-d H:i:s", $spareTime['end_datetime'])?></td>
                <td><?php
                    $cha_feng=$spareTime['developtime'];
                    $count3 = $count3 + $cha_feng;
                    echo Helper::FormattingTime($cha_feng);?>
                </td>
            </tr>
        <?php endforeach;?>

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>总占用时间：<?php echo Helper::FormattingTime($count3);?></td>
        </tr>

        </tbody>
    </table>
</div>
<div class="container-fluid">
    <?php if($summaryData['status']==0){?>
        <button type="submit" class="btn  btn-block btn-primary" onclick="summaryWeekSave(<?php echo $summaryData['id']?>)">保存提交本周工作总结</button>
    <?php }?>

</div>

<div class="modal fade" id="modalDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        </div>
    </div>
</div>
<div class="modal fade" id="weekDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#spare_time").click(function(){
        $('#tt').toggle(1000);
        //  alert(666);

    });
</script>