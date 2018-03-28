<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title text-center" id="myModalLabel"><strong>添加备注</strong></h4>
</div>
<div class="modal-body">
    <div class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-2 control-label">业务名称</label>
            <div class="col-sm-9">
                <p class="form-control-static">
                    <?php echo CHtml::encode($data['name'])?>
                </p>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">备注内容</label>
            <div class="col-sm-9">
                <textarea rows="5" class="form-control" id="remarks"><?php echo CHtml::encode($data['remarks'])?></textarea>
            </div>

        </div>



    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
    <button type="button" class="btn btn-primary" onclick="summaryAddRemarksSave(<?php echo $data['id']?>)">确定更新</button>
</div>
