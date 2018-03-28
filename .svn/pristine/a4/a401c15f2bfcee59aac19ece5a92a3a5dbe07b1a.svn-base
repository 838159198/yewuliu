<div class="container-fluid">
    <div class="page-header  sp-title">
        <h1 class="text-center">添加用户<small></small></h1>
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
        <label for="inputEmail3" class="col-sm-2 control-label">用户名</label>
        <div class="col-sm-10">
            <?php echo $form->textField($model, 'username',array("class"=>"form-control")); ?>

        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">姓名</label>
        <div class="col-sm-10">
            <?php echo $form->textField($model, 'name',array("class"=>"form-control")); ?>

        </div>
    </div>
    <div class="form-group">
        <label  class="col-sm-2 control-label">级别</label>
        <div class="col-sm-10">
            <?php echo $form->dropDownList($model, 'role',CHtml::listData(Role::model()->findAll(),"id","name"),array("class"=>"form-control","empty"=>"== 请选择级别 ==")); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">部门</label>
        <div class="col-sm-10">
            <?php echo $form->dropDownList($model, 'department',CHtml::listData(Department::model()->findAll("f_id!=0"),"id","department"),array("class"=>"form-control","empty"=>"== 请选择部门 ==")); ?>
        </div>
    </div>
    <div class="form-group">
        <label  class="col-sm-2 control-label">状态</label>
        <div class="col-sm-10">
            <?php echo $form->dropDownList($model, 'status',array("0"=>"禁止","正常"),array("class"=>"form-control")); ?>
        </div>
    </div>


    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">确认提交</button>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>