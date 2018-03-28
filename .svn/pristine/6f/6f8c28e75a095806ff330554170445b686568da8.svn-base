<div class="container-fluid">
    <div class="page-header  sp-title">
        <h1 class="text-center"><?php echo $weekData->title;?><small><?php echo $weekData->statdatetime?> ~ <?php echo $weekData->enddatetime?></small></h1>
    </div>
</div>
<div class="alert alert-info" style="margin-left:16px;margin-right: 15px;">
    <h4>注：每周五14:00结束所有业务流，15:00之前提交本周工作总结，故实际每周总工作时长最大为36-37小时</h4>
</div>
<div class="container-fluid">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <?php $i=1; foreach($summaryData as $_summary_row):?>
        <li role="presentation" <?php if($i==1):?> class="active"<?php endif;?>><a href="#<?php echo $_summary_row->manages->username;?>" aria-controls="home" role="tab" data-toggle="tab"><?php echo $_summary_row->manages->name;?></a></li>
        <?php $i++;$uid=$_summary_row['mid'];endforeach;?>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <?php $i=1; foreach($summaryData as $_summary_row):?>
        <div role="tabpanel" class="tab-pane <?php if($i==1):?> active<?php endif;?>" id="<?php echo $_summary_row->manages->username?>">
            <?php $summaryProjectData = SummaryProject::model()->findAll("sid={$_summary_row['id']}");?>
            <table class="table table-bordered table-hover" style="margin-top: 15px;">
                <thead>
                <tr>
                    <th width="300">名称</th>
                    <th width="70">姓名</th>
                    <th width="160">接收时间</th>
                    <th width="120">预估时间</th>
                    <th width="120">停留时间</th>
                    <th width="120">总停留时间</th>
                    <th width="85">工作进度</th>
                    <th width="100">目前拥有者</th>
                    <th>备注</th>
                </tr>
                </thead>
                <tbody>
                <?php $count=0;$count1=0;$week='';$count2=0; foreach($summaryProjectData as $project_row):?>
                    <tr>
                        <td><a href="<?php echo '/operation/default/detail?id='.$project_row['postid']?>" target="_blank"><?php

                                if($project_row['name']!='周工作总结') {
                                    echo $project_row['name'];
                                }else{

                                    $week= $project_row['remarks'];
                                    continue;
                                }
                                ?></a></td>
                        <td><?php echo $project_row['username']; ?></td>
                        <td>
                            <?php
                            $owiner=OperationPost::model()->findByPk($project_row['postid']);
                            echo $owiner['receive_datetime'];

                            ?>
                        </td>
                        <td><?php $count1=$count1+$project_row['estimate']; echo Helper::FormattingTime($project_row['estimate']);?></td>
                        <td><?php $count=$count+$project_row['developmenttime'];echo Helper::FormattingTime($project_row['developmenttime']);?></td>
                        <td><?php
                            $owiner=OperationPost::model()->findByPk($project_row['postid']);
                            $mid=$owiner['receive_mid'];
                            $count2=$count2+OperationOnoff::getAllDeveloptime($project_row['postid'],$mid,$weekData->endtime);
                            echo Helper::FormattingTime(OperationOnoff::getAllDeveloptime($project_row['postid'],$mid,$weekData->endtime));

                            ?></td>
                        <td><?php echo $project_row['xstatus'];?></td>
                        <td>
                            <?php
                            $man=Manage::model()->findByPk($owiner['owner_mid']);
                            echo $man["name"];
                            ?>
                        </td>
                        <td><?php echo $project_row['remarks'];?></td>
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
                <?php if($week!=''){ ?>
                    <tr>
                        <td rowspan="4" >周工作总结</td>
                        <td colspan="8"><textarea rows="5" class="form-control" id="project_remarks" readonly><?php echo $week;?></textarea></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

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

                $spareTimes=SpareTimeOnoff::findSpareTimeByUid($_summary_row['mid'],$weekData->stattime,$weekData->endtime);foreach($spareTimes as $spareTime):?>
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
        <?php $i++;endforeach;?>
    </div>
</div>
