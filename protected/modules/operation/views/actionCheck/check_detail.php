<div class="container-fluid">
    <div class="page-header  sp-title">
        <h1 class="text-center"><?php  $month=ActionMonth::model()->findByPk($_GET['id']);echo $month['datemonth']?> 月综合考核列表</small></h1>
    </div>
</div>
<div class="alert alert-info" style="margin-left:16px;margin-right: 15px;">
    <h4>月综合考核包括：单项任务考核【20%】，工作质量考核【50%】，个人行为考核【10%】，领导评价考核【20%】</h4>
</div>
<div class="container-fluid">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <?php $i=1; foreach($summaryData as $_summary_row):?>
        <li role="presentation" <?php if($i==1):?> class="active"<?php endif;?>><a href="#<?php echo $_summary_row->username;?>" aria-controls="home" role="tab" data-toggle="tab"><?php echo $_summary_row->name;?></a></li>
        <?php $i++;$uid=$_summary_row['id'];endforeach;?>
    </ul>

    <!-- Tab panes -->
    <!-- Tab panes -->
    <div class="tab-content">
        <?php $i=1; foreach($summaryData as $_summary_row):?>
            <div role="tabpanel" class="tab-pane <?php if($i==1):?> active<?php endif;?>" id="<?php echo $_summary_row->username?>">
                <?php $summaryProjectData = CheckScore::model()->findAll("uid={$_summary_row['id']} and m_id='{$_GET['id']}'");?>
                <table class="table table-bordered table-hover" style="margin-top: 15px;">
                    <thead>
                    <tr>
                        <th width="120">考核项</th>
                        <th width="160">考核日期</th>
                        <th width="120">单项得分</th>
                        <th width="70">最终得分</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $count=0; foreach($summaryProjectData as $project_row):?>
                        <tr>
                            <td><?php echo $project_row->xtype;?></td>
                            <td><?php echo $project_row->updatetime;?></td>
                            <td><?php $count=$count+CheckScore::getXscore($project_row); echo $project_row['score'];?>分</td>
                            <td><?php echo CheckScore::getXscore($project_row); ?>分</td>
                        </tr>
                    <?php endforeach;?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>总：<?php echo $count;?>分</td>
                    </tr>
                    <?php if($head>=1 && $_summary_row['id'] !=Yii::app()->user->id): ?>
                        <tr>
                            <td rowspan="3" >领导考核评价内容</td>
                            <td colspan="3"><textarea rows="4" class="form-control" id="project_remarks" readonly><?php echo ActionScore::findContent($_summary_row['id'],'lead',$project_row->month->datemonth);?></textarea></td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>

            </div>
            <?php $i++;endforeach;?>
    </div>
</div>
