<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title text-center" id="myModalLabel"><strong><?php echo CHtml::encode($summary->summaryWeeks->title)?></strong></h4>
</div>
<div class="modal-body">
    <div class="form-horizontal">

        <div class="form-group">
            <label class="col-sm-2 control-label">业务名称</label>
            <div class="col-sm-9">
                <input class="form-control" type="text" id="project_name" value="" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">进度情况</label>
            <div class="col-sm-9">
                <select class="form-control" id="project_status">
                    <option value="2">进行中</option>
                    <option value="3">完成</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword" class="col-sm-2 control-label">工作时间</label>
            <div class="col-sm-9">
                <div class="row">
                <div class="col-sm-6">
                    <div class="input-group">
                        <input type="text" class="form-control" id="project_hours" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" aria-describedby="basic-addon2">
                        <span class="input-group-addon" id="basic-addon2">小时</span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="input-group">
                        <input type="text" class="form-control" id="project_minute" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" aria-describedby="basic-addon2">
                        <span class="input-group-addon" id="basic-addon2">分</span>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">备注内容</label>
            <div class="col-sm-9">
                <textarea rows="5" class="form-control" id="project_remark"></textarea>
            </div>

        </div>


    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
    <button type="button" class="btn btn-primary" onclick="summaryProjectAddSave(<?php echo $summary['id']?>)">确定添加</button>
</div>
