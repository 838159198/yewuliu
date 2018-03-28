<div class="container-fluid">
    <div class="page-header  sp-title">
        <h1 class="text-center">创建月末考核（<?php echo date("Y-m",time());?>）</small></h1>
    </div>
</div>
<div class="container">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'admin-form',
        'enableAjaxValidation' => false,
        'htmlOptions' =>array("class"=>"form-horizontal"),
    )); ?>
    <?php echo $form->errorSummary($model,'<b>请修复以下错误</b>','',array("class"=>"col-md-offset-2 alert alert-danger")); ?>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">考核名称</label>
        <div class="col-sm-6">
            <?php echo $form->textField($model, 'title',array("class"=>"form-control")); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">开始时间</label>
        <div class="col-sm-6">
            <?php echo $form->textField($model, 'startdatetime',array("class"=>"form-control")); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">结束时间</label>
        <div class="col-sm-6">
            <?php echo $form->textField($model, 'enddatetime',array("class"=>"form-control")); ?>
        </div>
    </div>

<script>
    $('#ActionMonth_startdatetime').datetimepicker({
        format: 'yyyy-mm-dd 00:00:00',
        todayHighlight:true,
        language:'zh-CN',
        autoclose:true,
        minView:'month'
    });
    $('#ActionMonth_enddatetime').datetimepicker({
        format: 'yyyy-mm-dd 23:59:59',
        todayHighlight:true,
        language:'zh-CN',
        autoclose:true,
        minView:'month'
    });
</script>


    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">确认提交</button>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>
