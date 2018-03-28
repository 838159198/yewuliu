<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel"><strong>退回到公共业务池</strong></h4>
</div>
<div class="modal-body">
    <div class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-2 control-label">业务名称</label>
            <div class="col-sm-10">
                <p class="form-control-static"><?php echo CHtml::encode($data['title']);?></p>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword" class="col-sm-2 control-label">退回理由</label>
            <div class="col-sm-10">
            <textarea class="form-control" rows="3" id="rollback_content"></textarea>
            </div>
        </div>

    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
    <button type="button" class="btn btn-danger" onclick="operationRollback(<?php echo $data['id']?>)">确定退回</button>
</div>