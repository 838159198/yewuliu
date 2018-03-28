<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel"><strong>加入到我的业务池</strong></h4>
    <h5 class="modal-title" id="notice"><strong style="color: #FF0000">预计时间为开发者（技术或其他），非相关开发者不可填写</strong></h5>
</div>
<div class="modal-body">
    <div class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-2 control-label">业务名称</label>
            <div class="col-sm-10">
                <div class="col-sm-12">
                    <p class="form-control-static"><?php echo CHtml::encode($data['title']);?></p>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword" class="col-sm-2 control-label">预估时间</label>
            <div class="col-sm-10">
                <div class="col-sm-6">
                    <div class="input-group">
                        <input type="text" class="form-control" id="add_tips_hours" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" aria-describedby="basic-addon2">
                        <span class="input-group-addon" id="basic-addon2">小时</span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="input-group">
                        <input type="text" class="form-control" id="add_tips_minute" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" aria-describedby="basic-addon2">
                        <span class="input-group-addon" id="basic-addon2">分</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="modal-footer"> 
    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
    <button type="button" class="btn btn-primary" onclick="updateOperationTime(<?php echo $data['id']?>)">确定</button>
</div>
<script type="text/javascript">
    $(function(){
        $("#add_tips_hours").click(function(){
            alert('预计时间由开发填写，一经填写不可更改');
        })
    })

</script>