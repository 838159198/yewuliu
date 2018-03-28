<div class="container-fluid">
    <div class="page-header  sp-title">
        <h1 class="text-center"><?php echo $model['name']?><small>测试用例模板修改</small></h1>
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
        <label for="inputEmail3" class="col-sm-2 control-label">模板名称</label>
        <div class="col-sm-6">
            <?php echo $form->textField($model, 'name',array("class"=>"form-control")); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">开发人员</label>
        <div class="col-sm-6">
            <div class="input-group">
                <?php echo $form->textField($model, 'test_developer',array("class"=>"form-control")); ?>
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button" onclick="testManageDialog('OperationTestTemplate_test_developer')">选择人员</button>
                  </span>
            </div><!-- /input-group -->
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">测试模块</label>
        <div class="col-sm-6" >
            <?php echo $form->textField($model, 'test_module',array("class"=>"form-control")); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">测试项目</label>
        <div class="col-sm-6" id = 'testLog'>
            <input type="hidden" id="testProjeNum"  name ="testProjeNum" value = '<?php echo $count;?>'>
            <div class="rowBottomxxx">
                <div class="input-group">
                    <?php //echo $form->textField($model, 'test_project[]',array("class"=>"form-control")); ?>
                    <span class="input-group-btn">
                        <button class="btn btn-success" type="button" onclick="createTestTemplateProject(0)">增加一项</button>
                      </span>
                </div><!-- /input-group -->
            </div>
            <?php $i=1;foreach($project as $pro_k => $pro_v):?>
            <div class="rowBottom" id="<?php echo $i;?>">
                <div class="input-group">
                    <input class="form-control" name="OperationTestTemplate[test_project][]" id="OperationTestTemplate_test_project" type="text" value="<?php echo $pro_v;?>">
                    <span class="input-group-btn"><button class="btn btn-danger" type="button" onclick="delTestProject(<?php echo $i;?>)">删除</button></span>
                </div>
            </div>
            <?php $i++;endforeach;?>
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
        var _name = $("#OperationTestTemplate_name").val();
        var _developer = $("#OperationTestTemplate_test_developer").val();
        var _project = $("#OperationTestTemplate_test_project").val();

        if(_name==""){
            alert("请填写模板名称");
            return false;
        }
        if(_developer==""){
            alert("请填写开发者姓名");
            return false;
        }
        if(_project == "" || typeof(_project)=="undefined" )
        {
            alert("测试项目不能为空");
            return false;
        }

        var o=document.getElementsByName("OperationTestTemplate[test_project][]");
        /*var o=f.abc*/;
        if(!o){alert('程序错误，无法验证！');return false}
        for(var i=0;i<o.length;i++){
            if(o[i].value==""){alert("测试项目内容"+(i+1)+"不能为空"); o[i].focus(); return false; }
        }


        return true;
    }

</script>