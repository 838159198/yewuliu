<div class="container-fluid">
    <div class="page-header  sp-title">
        <h1 class="text-center"><?php echo $postData['title']?><small>测试用例</small></h1>
    </div>
</div>
<div class="container">
    <div class="form-horizontal">
        <label for="inputEmail3" class="col-sm-2 control-label">关键字</label>
        <div class="col-sm-4">
            <div class="input-group">
                <input class="form-control" name="search_keyword" id="search_keyword" type="text" value="">
                <span class="input-group-btn"><button class="btn btn-primary" type="button" onclick="testTemplateSearch(<?php echo $postData['id']?>)"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> 搜索模板</button></span>
            </div>
        </div>
    </div>

</div>
<hr>
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
            <p class="form-control-static"><?php echo $postData['title']?></p>
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">版本号</label>
        <div class="col-sm-6">
            <p class="form-control-static"><?php echo $postData['version_number']?></p>
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">开发人员</label>
        <div class="col-sm-6">
            <div class="input-group">
                <?php echo $form->textField($model, 'developer',array("class"=>"form-control")); ?>
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="button" onclick="testManageDialog('OperationTest_developer')">选择人员</button>
                  </span>
            </div><!-- /input-group -->
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">测试模块</label>
        <div class="col-sm-6" >
            <?php echo $form->textField($model, 'module',array("class"=>"form-control")); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">测试项目</label>
        <div class="col-sm-6" id='testLog'>
            <input type="hidden" id="testProjeNum"  name ="testProjeNum" value = '0'>
            <div class="rowBottomxxx">
                <div class="input-group">
                    <?php echo $form->textField($model, 'project[]',array("class"=>"form-control")); ?>
                    <span class="input-group-btn">
                        <button class="btn btn-success" type="button" onclick="createTestProject(0)">增加一项</button>
                      </span>
                </div><!-- /input-group -->
            </div>

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