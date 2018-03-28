<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel"><strong>请假记录</strong></h4>

</div>
<div class="modal-body">
    <div class="form-horizontal">

        <div class="form-group">
            <label class="col-sm-2 control-label"> 开始日期</label>
            <div class="col-sm-10">
                <div class="col-sm-12">
                    <input id="dates_start" type="text"  name="dates" class="hasDatepicker">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"> 结束日期</label>
            <div class="col-sm-10">
                <div class="col-sm-12">
                    <input id="dates_end" type="text"  name="dates" class="hasDatepicker">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">业务名称</label>
            <div class="col-sm-10">
                <div class="col-sm-12">
                    <input class="form-control" id="leave_content" type="text"  value="请假占用" readonly>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword" class="col-sm-2 control-label">请假时长</label>
            <div class="col-sm-10">
                <div class="col-sm-6">
                    <div class="input-group">
                        <input type="text" class="form-control" id="leave_hours" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" aria-describedby="basic-addon2">
                        <span class="input-group-addon" id="basic-addon2">小时</span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="input-group">
                        <input type="text" class="form-control" id="leave_minute" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" aria-describedby="basic-addon2">
                        <span class="input-group-addon" id="basic-addon2">分</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="modal-footer"> 
    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
    <button type="button" class="btn btn-primary" onclick="leaveNote()">确定</button>
</div>
<script type="text/javascript">
    $('.hasDatepicker').datetimepicker({
        language: 'zh-CN',
        autoclose: 1,
        todayBtn: 1,
        pickerPosition: "bottom-left",
        minuteStep: 5,
		Format:'Custom',   
		CustomFormat:"yyyy-MM-dd HH:mm:ss"

    });


</script>
