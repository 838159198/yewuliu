<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel"><strong>添加测试项目</strong></h4>
</div>
<div class="modal-body">
    <div class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-3 control-label">业务流名称</label>
            <div class="col-sm-9">
                <p class="form-control-static"><?php echo CHtml::encode($testData->operation_post->title);?></p>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword" class="col-sm-3 control-label">测试项目</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="project" >
            </div>
        </div>

    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
    <button type="button" class="btn btn-primary" onclick="testProjectModalDialogAdd(<?php echo $testData['id']?>)">确定添加</button>
</div>