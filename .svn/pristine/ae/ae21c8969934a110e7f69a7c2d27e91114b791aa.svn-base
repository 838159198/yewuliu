<div class="container-fluid">
    <div class="page-header  sp-title">
        <h1 class="text-center">创建周总结（<?php echo date("Y-m-d",time());?>）</small></h1>
    </div>
</div>
<div class="container">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'admin-form',
        'enableAjaxValidation' => false,
        'htmlOptions' =>array("class"=>"form-horizontal","onsubmit"=>"return templateverify();"),
    )); ?>
    <?php echo $form->errorSummary($model,'<b>请修复以下错误</b>','',array("class"=>"col-md-offset-2 alert alert-danger")); ?>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">业务流名称</label>
        <div class="col-sm-6">
            <p class="form-control-static"><?php echo $model['mid']?></p>
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">版本号</label>
        <div class="col-sm-6">
            <p class="form-control-static"><?php echo $model['projectnum']?></p>
        </div>
    </div>

    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">测试模块</label>
        <div class="col-sm-6" >
            <?php echo $form->textField($model, 'projectnum',array("class"=>"form-control")); ?>
        </div>
    </div>




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
<script>
    function templateverify()
    {

        var _developer = $("#OperationTest_developer").val();
        var _project = $("#OperationTest_project").val();

        if(_developer==""){
            alert("请填写开发者姓名");
            return false;
        }
        if(typeof(_project)=="undefined" )
        {
            alert("测试项目不能为空，至少填写一项");
            return false;
        }

        var o=document.getElementsByName("OperationTest[project][]");
        /*var o=f.abc*/;
        if(!o){alert('程序错误，无法验证！');return false}
        for(var i=0;i<o.length;i++){
            if(o[i].value==""){alert("测试项目内容"+(i+1)+"不能为空"); o[i].focus(); return false; }
        }


        return true;
    }

</script>