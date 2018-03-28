<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel"><strong>测试评分</strong></h4>

</div>
<div class="modal-body">
    <div class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-2 control-label">评分规则</label>
            <div class="col-sm-10">
                <div class="col-sm-12">
                    <p class="form-control-static"><span style="color: red;"><strong>由测试人员针对开发质量、bug率、完成情况做客观评分，百分制，不得输入100，不可空，提交后不可修改</strong></span></p>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword" class="col-sm-2 control-label">业务分数</label>
            <div class="col-sm-10">

                    <div class="input-group">
                        <input type="text" class="form-control" id="test_score" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" aria-describedby="basic-addon2">
                        <span class="input-group-addon" id="basic-addon2">分</span>
                    </div>

            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword" class="col-sm-2 control-label">评分备注</label>
            <div class="col-sm-10">
                <textarea rows="5" class="form-control" id="test_content"></textarea>
            </div>
        </div>

    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
    <button type="button" class="btn btn-primary" onclick="addScore(<?php echo $data['id']?>)">确定</button>
</div>
