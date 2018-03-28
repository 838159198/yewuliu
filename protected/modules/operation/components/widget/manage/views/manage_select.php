<!-- Modal -->
<div class="modal fade" id="manageDepartmentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><strong>选择用户</strong></h4>
            </div>
            <div class="modal-body">
                <div>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <?php $a=1; foreach($departmentData as $departmentData_a):?>
                            <?php  if($departmentData_a['f_id']==0):?>
                                <?php if($a==1){?>
                                    <li role="presentation" class="active"><a href="#<?php echo $departmentData_a['id']?>" aria-controls="<?php echo $departmentData_a['id']?>" role="tab" data-toggle="tab"><?php echo $departmentData_a['department']?></a></li>
                                    <?php }else{?>
                                    <li role="presentation"><a href="#<?php echo $departmentData_a['id']?>" aria-controls="<?php echo $departmentData_a['id']?>" role="tab" data-toggle="tab"><?php echo $departmentData_a['department']?></a></li>
                                <?php }$a++;endif;?>
                        <?php endforeach;?>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content" style="padding-top: 15px;">
                        <?php $b=1;
                        foreach($departmentData as $departmentData_b):?>
                            <?php  if($departmentData_b['f_id']==0):?>

                                    <div role="tabpanel" class="tab-pane <?php if($b==1){?>active<?php $b++;}?>" id="<?php echo $departmentData_b['id']?>">
                                        <?php //子部门
                                            foreach($departmentData as $departmentData_c):
                                                if($departmentData_c['f_id']==$departmentData_b['id']):
                                        ?>
                                        <div class="panel panel-default">
                                            <div class="panel-heading"><?php echo $departmentData_c['department']?></div>
                                            <div class="panel-body">
                                                <!--//列出当前部门人员-->
                                                <?php foreach($manageData as $_manageData):
                                                    if($_manageData['department'] == $departmentData_c['id']):?>
                                                        <button type="button" class="btn btn-default" onclick="receiveUser(<?php echo $_manageData['id']?>,'<?php echo $_manageData['name']?>')" data-dismiss="modal"><?php echo $_manageData['name']?></button>
                                                <?php endif; endforeach;?>
                                            </div>
                                        </div>
                                        <?php endif;endforeach;?>
                                    </div>
                                <?php endif;?>
                        <?php endforeach;?>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">关闭窗口</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function receiveUser($uid,$name)
    {
        $("#OperationThread_postusername").attr("value",$name);//填充内容
        $("#OperationThread_post_uid").attr("value",$uid);

        $("#OperationPost_postusername").attr("value",$name);//填充内容
        $("#OperationPost_receive_mid").attr("value",$uid);
        //$("#OperationThread_postusername").val($name);
        //$("#OperationThread_post_uid").val($uid);
    }
</script>