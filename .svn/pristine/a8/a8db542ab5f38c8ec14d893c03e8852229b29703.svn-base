<div class="container-fluid">
    <div class="page-header  sp-title">
        <h1 class="text-center">创建周总结（<?php echo date("Y-m-d",time());?>）</small></h1>
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
        <label for="inputEmail3" class="col-sm-2 control-label">业务流名称</label>
        <div class="col-sm-6">
            <?php echo $form->textField($model, 'title',array("class"=>"form-control")); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">开始时间</label>
        <div class="col-sm-6">
            <?php echo $form->textField($model, 'statdatetime',array("class"=>"form-control")); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">结束时间(一般周五15:00)</label>
        <div class="col-sm-6">
            <?php echo $form->textField($model, 'enddatetime',array("class"=>"form-control")); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">上班天数</label>
        <div class="col-sm-6">
            <?php echo $form->textField($model, 'days',array("class"=>"form-control")); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">提交日期</label>
        <div class="col-sm-6">
            <?php echo $form->textField($model, 'submit_date',array("class"=>"form-control hasDatepicker")); ?>
        </div>
    </div>
<script>
    $('#SummaryWeek_statdatetime').datetimepicker({
        format: 'yyyy-mm-dd 00:00:00',
        todayHighlight:true,
        language:'zh-CN',
        autoclose:true,
        minView:'month'
    });
    $('#SummaryWeek_enddatetime').datetimepicker({
        format: 'yyyy-mm-dd 23:59:59',
        todayHighlight:true,
        language:'zh-CN',
        autoclose:true,
        minView:'month'
    });
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


    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">确认提交</button>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>
<div class="modal fade" id="modaldiglog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        </div>
    </div>
</div>