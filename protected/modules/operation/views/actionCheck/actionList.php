<div class="container-fluid">
    <div class="container">
        <div class="panel panel-danger">
            <div class="panel-heading panel-question">
                <span class=""><strong style="font-size: x-large"> 个人行为考核<span style="font-size: large">（注意：此项必须在考核当月月末之前完成，红色代表已考核完成的）</span></strong></span>
            </div>
            <?php
            //判断是否有提示信息
            if(Yii::app()->user->hasFlash('status')):?>
                <div class="alert alert-success">
                    <b><?php echo Yii::app()->user->getFlash('status');?></b>
                </div>
            <?php endif;?>
            <div class="modal-body">
                <div class="form-horizontal">
                    <div class="tab-content" style="padding-top: 15px;">
                        <?php foreach($departmentData as $departmentData_b):?>

                                <div role="tabpanel" class="tab-pane active" id="<?php echo $departmentData_b['id']?>">

                                            <div class="panel panel-default">
                                                <div class="panel-heading"><?php echo $departmentData_b['department']?></div>
                                                <div class="panel-body">
                                                    <!--//列出当前部门人员-->
                                                    <?php foreach($manageData as $_manageData):
                                                        $is_check=ActionScore::check($_manageData['id'],'action',date("Y-m"));
                                                        $url=$_manageData['id'] !=Yii::app()->user->id ? '/operation/actionCheck/index?uid='.$_manageData['id']:'javascript:alert(\'您不能给自己打分吆\');';
                                                        if($_manageData['department'] == $departmentData_b['id']):?>
                                                            <a class="btn btn-<?php echo ($is_check==false)?'primary':'danger' ?>" href="<?php echo ($is_check==false)? $url:'#'?>"><?php echo $_manageData['name']?></a>
                                                        <?php endif; endforeach;?>
                                                </div>
                                            </div>
                                </div>

                        <?php endforeach;?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
