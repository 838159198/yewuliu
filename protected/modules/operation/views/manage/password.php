<div class="container-fluid">
    <div class="page-header  sp-title">
        <h1 class="text-center">密码修改<small></small></h1>
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
        <label for="inputEmail3" class="col-sm-2 control-label">新密码</label>
        <div class="col-sm-10">
            <?php echo $form->textField($model, 'password',array("class"=>"form-control")); ?>

        </div>
    </div>



    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">确认提交</button>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>