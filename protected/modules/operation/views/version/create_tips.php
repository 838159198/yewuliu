<script>
    $(function () {
        $('[data-toggle="popover"]').popover()
    });
    //显示隐藏
    $("#btnCreateBusiness").click(function(){
        $("#createBusinessBox").toggle();
    });

</script>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title text-center" id="myModalLabel"><strong>生成版本号</strong></h4>
</div>
<div class="modal-body">
    <div class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-3 control-label">业务名称</label>
            <div class="col-sm-9">
                <p class="form-control-static">
                    <?php echo CHtml::encode($postdata['title'])?>
                </p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">版本号格式</label>
            <div class="col-sm-9">
                <p class="form-control-static">
                    主类别.业务ID.日期(月日).随机数(5位)
                </p>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-3 control-label">主类别</label>
            <div class="col-sm-9">
                <select class="form-control" name="category" id="category">
                    <?php foreach(OperationVersion::model()->CategoryListData as $_vr):?>
                    <option value="<?php echo $_vr['key']?>"><?php echo $_vr['value']?></option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-3 control-label">业务</label>
            <div class="col-sm-6">
                <select class="form-control" name="business" id="business">
                    <?php foreach($businessData as $_br):?>
                        <option value="<?php echo $_br['id']?>"><?php echo $_br['name']?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="col-sm-3">
                <button type="button" id="btnCreateBusiness" class="btn btn-default">添加业务 <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></button>
            </div>
        </div>
        <div class="alert alert-success " id="createBusinessBox" style="display: none;" role="alert">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">添加业务</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <input type="text" class="form-control" id="business_name" placeholder="业务名称">
                          <span class="input-group-btn">
                            <button class="btn btn-success" type="button" onclick="BusinessCreate()">确认添加</button>
                          </span>
                    </div><!-- /input-group -->
                </div>
            </div>
        </div>


    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
    <button type="button" class="btn btn-primary" onclick="createVersion(<?php echo $postdata['id']?>)">确定生成</button>
</div>
