<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title text-center" id="myModalLabel"><strong><?php echo CHtml::encode($summary->summaryWeeks->title)?></strong></h4>
</div>
<div class="modal-body">
    <div class="form-horizontal">

        <div class="form-group">
            <label class="col-sm-2 control-label">业务名称</label>
            <div class="col-sm-9">
                <input class="form-control" type="text" id="project_name" value="周工作总结" readonly />
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">总结内容</label>
            <div class="col-sm-9">
                <textarea rows="5" class="form-control" id="project_remarkss"></textarea>
            </div>

        </div>


    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
    <button type="button" id="chongfu" class="btn btn-primary" onclick="summaryWeekAddSave(<?php echo $summary['id']?>)">确定添加</button>
</div>
