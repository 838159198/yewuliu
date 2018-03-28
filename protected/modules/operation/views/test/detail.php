<div class="container-fluid">
    <div class="page-header  sp-title">
        <h1 class="text-center"><?php echo $testData->operation_post->title?><small>测试用例</small></h1>
    </div>
</div>

<div class="container">
    <div class="form-horizontal">

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">状态</label>
            <div class="col-sm-6">
                <p class="form-control-static">
                    <?php if($testData['status']==0){?>
                        <span class="label label-danger">未通过</span>
                    <?php }else{?>
                        <span class="label label-success">通过</span>
                    <?php }?>
                </p>
            </div>
        </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">业务流名称</label>
        <div class="col-sm-6">
            <p class="form-control-static"><?php echo $testData->operation_post->title?></p>
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">版本号</label>
        <div class="col-sm-6">
            <p class="form-control-static"><?php echo $testData->operation_post->version_number?></p>

        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">开发人员</label>
        <div class="col-sm-6">
            <p class="form-control-static"><?php echo $testData['developer']?></p>
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">测试模块</label>
        <div class="col-sm-6">
            <p class="form-control-static"><?php echo $testData['module']?></p>
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">测试项目</label>
        <div class="col-sm-6" id='testLog'>
            <input type="hidden" id="testProjeNum"  name ="testProjeNum" value = '0'>
            <?php if($testData['status']==0):?>
            <button class="btn btn-success" type="button" onclick="testProjectModalDialog(<?php echo $testData['id']?>)">增加一项</button>
            <?php endif;?>
            <?php foreach($testProjectDataList as $pro_row):?>
                <?php if($pro_row['status']==1){?>
                <div class="rowBottom" id="project<?php echo $pro_row['id']?>">
                    <div class="input-group rowBottom">
                        <input type="text" class="form-control" value="<?php echo $pro_row['name']?>">
                          <span class="input-group-btn">
                            <button id="projectbtn<?php echo $pro_row['id']?>" class="btn btn-success" type="button" onclick="testProjectBtnStatus(<?php echo $pro_row['id']?>)">PASS</button>
                          </span>
                    </div>
                </div>
            <?php }elseif($pro_row['status']==0){?>
                <div class="rowBottom" id="project<?php echo $pro_row['id']?>">
                    <div class="input-group rowBottom">
                        <input type="text" class="form-control" value="<?php echo $pro_row['name']?>">
                      <span class="input-group-btn">
                        <input id="projectbtn<?php echo $pro_row['id']?>" class="btn btn-danger" type="button" onclick="testProjectBtnStatus(<?php echo $pro_row['id']?>)" value="N&nbsp;&nbsp;&nbsp;&nbsp;G"/>
                      </span>
                    </div>
                </div>
            <?php }else{?>
                    <div class="rowBottom" id="project<?php echo $pro_row['id']?>">
                        <div class="input-group rowBottom">
                            <input type="text" class="form-control" value="<?php echo $pro_row['name']?>">
                          <span class="input-group-btn">
                            <button id="projectbtn<?php echo $pro_row['id']?>" class="btn btn-warning" type="button" onclick="testProjectBtnStatus(<?php echo $pro_row['id']?>)">出错了</button>
                          </span>
                        </div>
                    </div>
            <?php }?>
            <?php endforeach;?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-6">
            <?php if($testData['status']==0){?>
            <button type="submit" class="btn  btn-block btn-primary" onclick="testPass(<?php echo $testData['id']?>)">测试通过</button>
            <?php }else{?>
                <button type="submit" class="btn  btn-block btn-success">测试全部通过</button>
            <?php }?>
        </div>
    </div>


    </div>
</div>
<div class="modal fade" id="modaldialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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