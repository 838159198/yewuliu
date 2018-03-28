<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title text-center" id="myModalLabel"><strong><?=$manageData['name']?></strong></h4>
</div>
<div class="modal-body">
    <div class="form-horizontal">

        <div class="form-group">
            <label class="col-sm-2 control-label">考核得分</label>
            <div class="col-sm-9">
                <input class="form-control" type="text" id="lead_score"   />
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">考核评价</label>
            <div class="col-sm-9">
                <textarea rows="5" class="form-control" id="lead_content"></textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label"></label>
            <div class="col-sm-9">
                <h5 class="modal-title" id="notice"><strong style="color: #FF0000">注意：这两项为必填，考核评价只有上级可看本人不可见</strong></h5>
            </div>
        </div>

    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
    <button type="button" id="chongfu" class="btn btn-primary" onclick="leadAddSave(<?=$manageData['id']?>)">确定添加</button>
</div>
