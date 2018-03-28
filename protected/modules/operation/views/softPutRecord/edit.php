<div class="container-fluid">
    <div class="page-header sp-title">
        <h1 class="text-center">软件投放信息编辑<small></small></h1>
    </div>
</div>
<div class="container">

    <?php
    //判断是否有提示信息
    if(Yii::app()->user->hasFlash('status')){?>
        <script type="text/javascript">alert("修改成功！");</script>
        <div class="alert alert-success">
            <b><?php echo Yii::app()->user->getFlash('status');?></b>

        </div>
    <?php }?>
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'admin-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array("class"=>"form-horizontal"),
    )); ?>
    <?php echo $form->errorSummary($model,'<b>请修复以下错误</b>','',array("class"=>"col-md-offset-2 alert alert-danger")); ?>

    <div class="col-sm-offset-2 col-sm-10 alert">带（*）的内容是必须填写的！</div>
    <div class="form-group">
        <label class="col-sm-2 control-label">更新时间</label>
        <div class="col-sm-10">

            <?php echo $form->textField($model, 'update_datetime',array("class"=>"form-control")); ?>
            <script>
                $('#SoftPutRecord_update_datetime').datetimepicker({
                    format: 'yyyy-mm-dd',
                    todayHighlight:true,
                    language:'zh-CN',
                    autoclose:true,
                    minView:'month'
                });

            </script>


        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">客户名 *</label>
        <div class="col-sm-10">
            <?php echo $form->textField($model, 'customer_name',array("class"=>"form-control")); ?>

        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">业务名称 *</label>
        <div class="col-sm-10">
            <?php echo $form->textField($model, 'service_name',array("class"=>"form-control")); ?>

        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">版本号</label>
        <div class="col-sm-10">
            <?php echo $form->textField($model, 'version',array("class"=>"form-control")); ?>

        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">md5</label>
        <div class="col-sm-10">
            <?php echo $form->textField($model, 'md5',array("class"=>"form-control")); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">源码md5</label>
        <div class="col-sm-10">
            <?php echo $form->textField($model, 'source_md5',array("class"=>"form-control")); ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">更新内容</label>
        <div class="col-sm-10">
            <?php $this->widget('ext.KEditor.KEditor',array(
                'model'=>$model,  //传入form model
                'name'=>'content', //设置name
                'properties'=>array(
                    //设置接收文件上传的action
                    'uploadJson'=>Yii::app()->createUrl('kindedit/upload'),
                    //设置浏览服务器文件的action，这两个就是上面配置在/admin/default的
                    'fileManagerJson'=>Yii::app()->createUrl('kindedit/manageJson'),
                    /*'items'=>array('source', '|', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                        'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                        'insertunorderedlist', '|',  'image', 'link','unlink'),*/
                    //'newlineTag'=>'br',
                    'allowFileManager'=>true,
                    //传值前加js:来标记这些是js代码
                    'afterCreate'=>"js:function() {
                        K('#ChapterForm_all_len').val(this.count());
                        K('#ChapterForm_word_len').val(this.count('text'));
                    }",
                    'afterBlur'=> "js:function(){this.sync();}",
                    'afterChange'=>"js:function() {
                        K('#ChapterForm_all_len').val(this.count());
                        K('#ChapterForm_word_len').val(this.count('text'));
                    }",
                ),
                'textareaOptions'=>array(
                    "class"=>"form-control",
                    'style'=>'width:100%;height:400px;',
                )
            )); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">备注</label>
        <div class="col-sm-10">
            <?php $this->widget('ext.KEditor.KEditor',array(
                'model'=>$model,  //传入form model
                'name'=>'comment', //设置name
                'properties'=>array(
                    //设置接收文件上传的action
                    'uploadJson'=>Yii::app()->createUrl('kindedit/upload'),
                    //设置浏览服务器文件的action，这两个就是上面配置在/admin/default的
                    'fileManagerJson'=>Yii::app()->createUrl('kindedit/manageJson'),
                    /*'items'=>array('source', '|', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                        'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                        'insertunorderedlist', '|',  'image', 'link','unlink'),*/
                    //'newlineTag'=>'br',
                    'allowFileManager'=>true,
                    //传值前加js:来标记这些是js代码
                    'afterCreate'=>"js:function() {
                        K('#ChapterForm_all_len').val(this.count());
                        K('#ChapterForm_word_len').val(this.count('text'));
                    }",
                    'afterBlur'=> "js:function(){this.sync();}",
                    'afterChange'=>"js:function() {
                        K('#ChapterForm_all_len').val(this.count());
                        K('#ChapterForm_word_len').val(this.count('text'));
                    }",
                ),
                'textareaOptions'=>array(
                    "class"=>"form-control",
                    'style'=>'width:100%;height:400px;',
                )
            )); ?>
        </div>
    </div>




    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">确认提交</button>
        </div>
    </div>

    <?php $this->endWidget(); ?>
</div>