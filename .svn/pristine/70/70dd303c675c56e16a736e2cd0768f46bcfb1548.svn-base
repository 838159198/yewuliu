<style type="text/css">
    #checkstt.input-group-addon{padding: 8px;text-align: left;white-space:normal}
    .input-group-addon.checkstt{height: 70px;line-height: 25px;width: 1100px;float: left;text-align: left;}
    #checkstt{display: none;}
    .col-sm-2{width: auto}
    .checkstt label{margin-right: 23px;}
    #leftsead{width:88px;position:fixed;top:400px;left:0px;z-index: 9999}
    #leftsead ul li{list-style: none;height: 30px}
</style>
<link type="text/css" href="/css/check.css" rel="stylesheet">
<script type="text/javascript" src="/style/js/check.js"></script>
<script type="text/javascript">
    $(function(){
        //初始化滑动div
        loadSwitchBox('.boxwrap',loadData,'#frameMain','tab.html');
    });
    //点击回调函数
    function loadData(){
        var obj = arguments[0];
        var params = "";
        var url ="tab.html?";
        if(typeof obj !="undefined" && obj !=null){
            var value = obj.value;
            var type  = obj.type;
            var param =type+"="+value;
            params = param+"&";
            $('[typeId="'+type+'"]').siblings().each(function(k){
                var param = $(this).attr('typeId')+"="+$(this).attr('selVal');
                params+=param+"&";
            });
            params = params.substring(0,params.length-1);
            url = url + params;

            //业务流常规审核
            $("#OperationThread_priority").val(value);
//            $.ajax({
//                type:"POST",
//                url:"/operation/default/checkOperation",
//                data:{priority:value,id:<?//=$_GET['id']?>//},
//                datatype: "json",
//                success:function(data){
//                    var jsonStr = eval("("+data+")");
//                    if(jsonStr.status==400){
//                        alert(jsonStr.message);
//                        return false;
//                    }else if(jsonStr.status==200){
//                        alert(jsonStr.message);
//                        location.replace(location.href);
//                    }else{
//                        alert("发生错误"+jsonStr.status);
//                        return false;
//                    }
//                },
//                error: function(){
//                    alert("未知错误");
//                }
//            });
            //alert("切换到..."+url);
            loadUrl('#frameMain', url);
        }
    }
</script>
<?php   $pageTitle=substr(strrchr($data->title, "]"), 1);
         $pageTitle=empty($pageTitle) ? "管理后台":$pageTitle;
         $this->setPageTitle($pageTitle);
        //有权查看者
        if(!empty($manallid)){
            $arr=array_unique($manallid);//去重
            sort($arr);//paixu
        }
?>
<?php if(!empty($manallid)) {?>
<div id="leftsead">
    <div class="list-group">
        <a href="#" class="list-group-item disabled">
            有权查看
        </a>
        <?php foreach($arr as $v){?>
            <a href="#" class="list-group-item"><?php $to_name=Manage::model()->findByPk($v);echo $to_name['name']  ?></a>
        <?php } ?>
    </div>
</div>
<?php }?>
<div class="container">
    <div class="panel panel-danger">
        <div class="panel-heading panel-question">
            <span class="label label-danger"><strong>需求文档</strong></span>&nbsp;&nbsp;
            <strong><?php echo CHtml::encode($data->title);?>&nbsp;&nbsp;<?php echo ($data->version_number!="")?"[ version:{$data->version_number} ]":""?></strong>
        </div>
        <div class="panel-body">
            <?php echo $data->content;?>
            <?php if(!empty($data['xfile'])):?>
                <hr>
                <p><strong>附件下载</strong></p>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>序号</th>
                        <th>文件名</th>
                        <th>文件路径</th>
                        <th>类型</th>
                        <th>大小</th>
                        <th>下载次数</th>
                        <th>文件下载</th>
                    </tr>
                    <?php foreach($data['xfile'] as $_xfile):?>
                    <tr>
                        <td><?php echo $_xfile['id']?></td>
                        <td><?php echo $_xfile['name']?></td>
                        <td><?php echo $_xfile['filepath']?></td>
                        <td><?php echo $_xfile['type']?></td>
                        <td><?php echo Helper::FormattingSize($_xfile['size']);?></td>
                        <td><?php echo $_xfile['hits']?></td>
                        <td><a class="label label-success" href="<?php echo $this->createUrl("download",array("id"=>$_xfile['id']))?>"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> 文件下载</a></td>
                    </tr>
                    <?php endforeach;?>
                </table>
            <?php endif;?>
            <hr>
            <?php echo ($data['test']==0)?"<a class=\"btn btn-warning\" href=\"".Yii::app()->createUrl('/operation/test/create',array('postid'=>$data['id']))."\"><span class=\"glyphicon glyphicon-plus\" aria-hidden=\"true\"></span> 创建测试用例</a>":"<a class=\"btn btn-success\" href=\"".Yii::app()->createUrl('/operation/test/detail',array('postid'=>$data['id']))."\"><span class=\"glyphicon glyphicon-align-left\" aria-hidden=\"true\"></span> 查看测试用例</a>";?>

            <?php if($departmentRole):?>
                <button type="button" id="myButton" onclick="closeOperation(<?php echo $data['id']?>)" class="btn btn-danger pull-right" >结束业务流</button>
            <?php endif;?>

        </div>

        <div class="panel-footer panel-fscf">
            <span class="glyphicon glyphicon-user" aria-hidden="true"></span> 需求者 ：<?php echo Helper::UserLinkName($data['create_mid']);?>&nbsp;&nbsp;
            <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> 优先级 ：<font color="#cc0000"><?php echo $data->Xpriority;?></font>&nbsp;&nbsp;
            <span class="glyphicon glyphicon-list" aria-hidden="true"></span> 分类 ：<?php echo OperationSitecategory::findSiteNameById($data['sc_id']);?>&nbsp;&nbsp;
            <span class="glyphicon glyphicon-time" aria-hidden="true"></span> 发布时间 ：<?php echo $data['create_datetime'];?>&nbsp;&nbsp;
            <!--div class="panel-receive"> <span class="glyphicon glyphicon-flag" aria-hidden="true"></span> <?php echo Helper::UserLinkName($data['receive_mid']);?></div>&nbsp;&nbsp;-->
            <span class="glyphicon glyphicon-time" aria-hidden="true"></span> 总停留时间 ：<?php echo ($data['receive_datetime']=="0000-00-00 00:00:00")?"未接收":$res;?>&nbsp;&nbsp;
            <span class="glyphicon glyphicon-hourglass" aria-hidden="true"></span> 预计时间 ：
            <?php if($data['estimate']>0){
                echo Helper::FormattingTime($data['estimate']);
            }else{ ?>
                <a href="javascript:tttt(<?php echo $data['id']?>)" class="btn btn-success" ><span class="glyphicon glyphicon-plus" aria-hidden="true">预计时间</span></a>

            <?php
            }?>&nbsp;&nbsp;
            <span class="glyphicon glyphicon-tent" aria-hidden="true"></span> 测试时间 ：
            <?php if($data['test_estimate']>0){
                echo Helper::FormattingTime($data['test_estimate']);
            }else if($testRole){ ?>
                <button type="button" id="myTest" onclick="showTestTime(<?php echo $data['id']?>)" style="margin-top:-8px;" class="btn btn-danger pull-right"><span class="glyphicon glyphicon-plus" aria-hidden="true">测试时间</span></button>
            <?php
            }?>
        </div>


    </div>
</div>
<div class="container">
    <div class="alert alert-info " role="alert">
        <div class="form-group">
            <label class="col-sm-2 control-label">开发者： <?php echo empty($data['owner_uid'])?"":Helper::UserLinkName($data['owner_uid']);?></label>
            <label class="col-sm-2 control-label">BUG等级</label>
            <div class="col-sm-4 ">
                <select  name="bug" id="bug"  val="<?=$data['id']?>">
                    <option value="">== 请选择BUG等级 ==</option>
                    <option value="2">普通</option>
                    <option value="1">严重</option>
                </select>&nbsp;&nbsp;&nbsp;&nbsp;
                <?php if($testDepartmentRole){ ?>
                    <span>普通: <?=$m?></span>&nbsp;&nbsp;&nbsp;&nbsp; 严重 ：<?=$n?>
                <?php }else{ ?>
                    <button type="button" id="clearBug" onclick="changeBug(<?php echo $data['id']?>)" style="margin-top:-8px;" class="btn btn-warning "><span  aria-hidden="true">确定</span></button>
                <?php } ?>
            </div>
            <label class="col-sm-4 control-label">希望完成时间 ： <?php echo empty($data['finishdatetime'])?"":$data['finishdatetime'];?></label>
            <label class="col-sm-2 control-label" title="<?php echo $data['test_content']?>">综合得分 ： <?php echo empty($data['score'])?"":$data['score'];?></label>
        </div>

    </div>

</div>
<div class="container">
    <?php if(Yii::app()->user->id==1) {?>
        <div style="float: left;padding: 15px">
            <strong>优先级审核：</strong>
            <div class="boxwrap fr"><!--容器 开始-->
                <div class="switchBox fl" id="cityList" typeId="city">
                    <table  cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="switch_box_l"></td>
                            <td class="switch_box_c rel">
                            <span class="abs switchBtn" >
                                <i class="switchBtn-l"></i>
                                <i class="switchBtn-r"></i>
                                <span class="curTxt"><?php echo ($data['priority']==3)?"常规":"正常";?></span>
                            </span>
                                <?php if($data['priority']==3) {?>
                                    <a href="javascript:void(0);" class="swichTxt" id="3">常规</a>
                                <a href="javascript:void(0);" class="swichTxt" id="1">正常</a>
                                <?php }else{?>
                                    <a href="javascript:void(0);" class="swichTxt" id="1">正常</a>
                                    <a href="javascript:void(0);" class="swichTxt" id="3">常规</a>

                                <?php }?>
                            </td>
                            <td class="switch_box_r"></td>
                        </tr>
                    </table>
                </div>
            </div><!--容器 结束-->
        </div>

    <?php }?>
    <?php echo $data->XdetailStatusTips;?>
</div>
<div class="container">
    <?php if(!empty($threadData)):?>
        <?php $threadData_i=1;foreach($threadData as $_threadData):?>
            <div class="panel panel-default">
                <div class="panel-heading panel-fsc">
                    <span class="label label-primary"><strong># <?php echo $threadData_i;?></strong></span>&nbsp;&nbsp;
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo Helper::UserLinkName($_threadData['create_uid']);?>&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="glyphicon glyphicon-time" aria-hidden="true"></span> 回复时间 ：<?php echo date("Y-m-d H:i:s",$_threadData['datetime']);?>&nbsp;&nbsp;&nbsp;&nbsp;
                    <!--<span class="glyphicon glyphicon-time" aria-hidden="true"></span> 开发周期 ：<?php /*echo Helper::FormattingTime($_threadData['developtime']);*/?>&nbsp;&nbsp;&nbsp;&nbsp;-->
                    <span class="glyphicon glyphicon-bell" aria-hidden="true"></span> 积分 ：<strong style="font-size: 16px;"><?php echo ($_threadData['credits']>0)?"<font color='#009900'>+{$_threadData['credits']}</font>":"<font color='#ff0000'>{$_threadData['credits']}</font>"?></strong>
                </div>
                <div class="panel-body">
                    <?php echo $_threadData['content'];?>
                    <?php if(!empty($_threadData['xfile'])):?>
                        <hr>
                        <p><strong>附件下载</strong></p>
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>序号</th>
                                <th>文件名</th>
                                <th>文件路径</th>
                                <th>类型</th>
                                <th>大小</th>
                                <th>下载次数</th>
                                <th>操作</th>
                            </tr>
                            <?php foreach($_threadData['xfile'] as $_threadFile):?>
                                <tr>
                                    <td><?php echo $_threadFile['id']?></td>
                                    <td><?php echo $_threadFile['name']?></td>
                                    <td><?php echo $_threadFile['filepath']?></td>
                                    <td><?php echo $_threadFile['type']?></td>
                                    <td><?php echo Helper::FormattingSize($_threadFile['size']);?></td>
                                    <td><?php echo $_threadFile['hits']?></td>
                                    <td><a class="label label-success" href="<?php echo $this->createUrl("download",array("id"=>$_threadFile['id']))?>"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> 文件下载</a></td>
                                </tr>
                            <?php endforeach;?>
                        </table>
                    <?php endif;?>

                </div>
            </div>
            <?php $threadData_i++;endforeach;?>
    <?php endif;?>
    <!--//回复部分开始-->
    <?php
    //判断用户是否有权限回复
    if($threadRole=="ok"):?>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4 class="panel-title"><span class="label label-primary"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> <strong>回复</strong></span>&nbsp;&nbsp;<strong></strong></h4>
            </div>
            <div class="panel-body">
                <?php $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'admin-form',
                    'enableAjaxValidation' => false,
                    'htmlOptions' =>array("onsubmit"=>"return ReplyThreadTips();"),
                )); ?>

                <?php echo $form->errorSummary($threadModel,'<b>请修复以下错误</b>','',array("class"=>"alert alert-danger")); ?>
                <input name="OperationThread[priority]" id="OperationThread_priority" type="hidden" value="<?=$data['priority']?>">
                <div class="row">
<!--                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">开发周期</label>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <?php /*echo $form->textField($threadModel, 'hours',array("class"=>"form-control text-center","aria-describedby"=>"sizing-addon2",'readonly' => true)); */?>
                                        <span class="input-group-addon" id="sizing-addon2">小时</span>
                                    </div>
                                </div>


                                <div class="col-sm-6">
                                    <?php /*echo $form->dropDownList($threadModel, 'minute',CHtml::listData(Common::MinuteListData(0,60),"key","value"),array("class"=>"form-control",'readonly' => true)); */?>

                                </div>
                            </div>
                        </div>
                    </div>-->
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">接收人</label>
                            <div class="input-group">
                                <!--<input type="text" class="form-control" id="receiveid" placeholder="请选择接收业务流的用户" disabled>-->
                                <?php echo $form->hiddenField($threadModel, 'post_uid'); ?>
                                <input type="text" class="form-control" id="OperationThread_postusername" placeholder="请选择接收业务流的用户" disabled>
                              <span class="input-group-btn">
                                <button class="btn btn-default" type="button" data-toggle="modal" data-target="#manageDepartmentModal"><i class="glyphicon glyphicon-user"></i> 选择</button>
                              </span>
                            </div><!-- /input-group -->
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">&nbsp;</label>
                            <div class="center-block">
                                <?php if($departmentRole):?>
                                    <button type="button" id="myButton" onclick="closeOperation(<?php echo $data['id']?>)" class="btn btn-danger pull-right" >结束业务流</button>
                                <?php endif;?>
                            </div>
                        </div>

                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">&nbsp;</label>
                            <div class="center-block">
                                <?php if($testRole):?>
                                    <button type="button" id="myTest" onclick="showTestTime(<?php echo $data['id']?>)" class="btn btn-danger pull-right" >测试预估时间</button>
                                <?php endif;?>
                                <?php if($sRole):?>
                                    <button type="button" id="myScore" onclick="testOperation(<?php echo $data['id']?>)" class="btn btn-danger pull-left">评分</button>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">相关者</label>
                            <div class="input-group">
                                <span class="btn btn-primary" id="aboutme">选择</span>
                                <?php if($data['status']==2):?>
                                    <span class="btn btn-info" style="margin-left: 50px;color: #000020;" id="zant" onclick="stopOperation(<?php echo $data['id']?>)">暂停业务流</span>
                                    <?php elseif($data['status']==4):?>
                                    <span class="btn btn-info" style="margin-left: 50px;color: #000020;" id="rests" onclick="restartOperation(<?php echo $data['id']?>)">重启业务流</span>
                                <?php endif;?>



                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group" id="checkstt">
                    <div class="input-group">
                    <span class="input-group-addon checkstt">
                        <?php
                        $uid = Yii::app()->user->id;

                        $mangll=Manage::model()->findAll('status=:status and id!=:id and role>2',array(':status'=>1,':id'=>$uid));
                        $detail_id =Yii::app()->request->getParam('id');
                        $opost=OperationPost::model()->findByPk($detail_id);

                        foreach($mangll as $ki=>$vi)
                        {
                            $echostr=$form->checkBoxList($threadModel,'about_uid[]',array($vi['id']=>$vi['name']));
                            echo $echostr;
                        }
                        ?>
                    </span>
                    </div>
                </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">回复内容</label>
                            <?php $this->widget('ext.KEditor.KEditor',array(
                                'model'=>$threadModel,  //传入form model
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
                <div class="form-group">
                    <label for="exampleInputEmail1">附件</label>
                    <?php //echo $form->hiddenField($threadModel, 'file'); ?>
                    <div id="file_ok"></div>
                    <input id="file_uploada" name="file_uploada" type="file" multiple="true">
                    <div id="queue"></div>
                </div>

                <div class="form-group">
                    <div class="pull-left"><button type="submit" id="myButton" class="btn btn-primary" ><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 确认提交</button></div>
                    <div class="pull-right">

                    </div>
                </div>
                <?php $this->endWidget(); ?>
            </div>

        </div>
    <?php endif;?>
    <?php
    //判断用户是否有回复权限tips
    if($threadRole=="norole"):?>
        <!--提示-->
        <div class="alert alert-warning text-center" role="alert"><strong>您没有权限，等待<?php echo Helper::UserLinkName($data['owner_mid']);?>回复！</strong></div>
    <?php endif;?>
    <!--#回复结束//-->
</div>
<!-- Button trigger modal -->
<?php if($this->beginCache("manage_select_dilog", array('duration'=>60))) { ?>
    <?php $this->widget('application.modules.operation.components.widget.manage.ManageSelectWidget'); ?>
<?php $this->endCache(); } ?>
<script type="text/javascript">
    //移除文件
    function opremove($id)
    {
        //var $id = $id;
        var opid = "#opfile"+$id;
        ///alert(opid)
        $(opid).remove();
    }
</script>
<script type="text/javascript">
    <?php $timestamp = time();?>
    $(function() {
        $('#file_uploada').uploadify({

            'formData'     : {
                'timestamp' : '<?php echo $timestamp;?>',
                'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
            },
            'buttonText' : '选择上传文件...',

            'swf'      : '/style/uploadify/uploadify.swf',
            'uploader' : '<?php echo Yii::app()->createUrl("operation/upload/uploadify")?>',
            'onFallback' : function() {
                alert('未检测到兼容版本的Flash.');
            },
            'onUploadSuccess' : function(file, data, response) {
                resJSON=$.parseJSON(data);
                if(resJSON.status==200)
                {

                    if(resJSON.type=="zip")
                    {
                        $("#file_ok").append("<div id=\"opfile"+resJSON.id+"\" class=\"createfile\">" +
                        "<input name=\"OperationThread[file][]\" value=\""+resJSON.id+"\" type=\"hidden\" />"+
                        "<div class=\"createfile-img\"><img src=\"/style/v1/icon_zip01.png\"></div>" +
                        "<div class=\"createfile-body\">"+
                        "<h4>"+resJSON.name+"</h4>"+
                        "<div class=\"createfile-txt\">大小："+resJSON.size+"&nbsp;&nbsp;</div>"+
                        "</div>"+
                        "<div class=\"createfile-button\">"+
                        "<div class=\"text-right\"><button class=\"btn btn-danger\" onclick=\"opremove("+resJSON.id+")\" >删除</button></div>"+
                        "</div>"+
                        "</div>");
                        //"<img src="+resJSON.url+" alt="+resJSON.name+" title="+resJSON.name+">");
                    }else if(resJSON.type=="rar"){
                        $("#file_ok").append("<div id=\"opfile"+resJSON.id+"\" class=\"createfile\">" +
                        "<input name=\"OperationThread[file][]\" value=\""+resJSON.id+"\" type=\"hidden\" />"+
                        "<div class=\"createfile-img\"><img src=\"/style/v1/zip01.png\"></div>" +
                        "<div class=\"createfile-body\">"+
                        "<h4>"+resJSON.name+"</h4>"+
                        "<div class=\"createfile-txt\">大小："+resJSON.size+"&nbsp;&nbsp;</div>"+
                        "</div>"+
                        "<div class=\"createfile-button\">"+
                        "<div class=\"text-right\"><button class=\"btn btn-danger\" onclick=\"opremove("+resJSON.id+")\" >删除</button></div>"+
                        "</div>"+
                        "</div>");
                    }else if(resJSON.type=="xls" || resJSON.type=="docx" || resJSON.type=="xlsx" || resJSON.type=="rp" || resJSON.type=="pptx"){
                        $("#file_ok").append("<div id=\"opfile"+resJSON.id+"\" class=\"createfile\">" +
                        "<input name=\"OperationThread[file][]\" value=\""+resJSON.id+"\" type=\"hidden\" />"+
                        "<div class=\"createfile-img\"><img src=\"/style/v1/icon_excel.png\"></div>" +
                        "<div class=\"createfile-body\">"+
                        "<h4>"+resJSON.name+"</h4>"+
                        "<div class=\"createfile-txt\">大小："+resJSON.size+"&nbsp;&nbsp;</div>"+
                        "</div>"+
                        "<div class=\"createfile-button\">"+
                        "<div class=\"text-right\"><button class=\"btn btn-danger\" onclick=\"opremove("+resJSON.id+")\" >删除</button></div>"+
                        "</div>"+
                        "</div>");
                    }else if(resJSON.type=="jpg"||resJSON.type=="jpeg"||resJSON.type=="png"||resJSON.type=="gif"){
                        $("#file_ok").append("<div id=\"opfile"+resJSON.id+"\" class=\"createfile\">" +
                        "<input name=\"OperationThread[file][]\" value=\""+resJSON.id+"\" type=\"hidden\" />"+
                        "<div class=\"createfile-img\"><img src=\"/style/v1/icon_pic.png\"></div>" +
                        "<div class=\"createfile-body\">"+
                        "<h4>"+resJSON.name+"</h4>"+
                        "<div class=\"createfile-txt\">大小："+resJSON.size+"&nbsp;&nbsp;</div>"+
                        "</div>"+
                        "<div class=\"createfile-button\">"+
                        "<div class=\"text-right\"><button class=\"btn btn-danger\" onclick=\"opremove("+resJSON.id+")\" >删除</button></div>"+
                        "</div>"+
                        "</div>");
                    }else{
                        $("#file_ok").append("<div id=\"opfile"+resJSON.id+"\" class=\"createfile\">" +
                        "<input name=\"OperationThread[file][]\" value=\""+resJSON.id+"\" type=\"hidden\" />"+
                        "<div class=\"createfile-img\"><img src=\"/style/v1/icon_txt.png\"></div>" +
                        "<div class=\"createfile-body\">"+
                        "<h4>"+resJSON.name+"</h4>"+
                        "<div class=\"createfile-txt\">大小："+resJSON.size+"&nbsp;&nbsp;</div>"+
                        "</div>"+
                        "<div class=\"createfile-button\">"+
                        "<div class=\"text-right\"><button class=\"btn btn-danger\" onclick=\"opremove("+resJSON.id+")\" >删除</button></div>"+
                        "</div>"+
                        "</div>");
                    }
                }else if(resJSON.status==403){
                    alert(resJSON.message);
                }else{
                    alert("发生错误");
                }

            }
        });
    });
</script>
<?php
//成功回复后的状态显示
if (Yii::app()->user->hasFlash("reply_status")):?>
    <button type="button" id="haha" class="btn btn-primary" style="display: none;" data-toggle="modal" data-target="#reply_status">Small modal</button>
    <div class="modal fade bs-example-modal-sm" id="reply_status" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel"><b>温馨提示</b></h4>
                </div>
                <div class="modal-body">
                    <p>恭喜你，回复成功！</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                </div>
            </div>
        </div>
    </div>
    <script>document.getElementById("haha").click();</script>
<?php endif;?>
<!-- 领取业务 -->
<div class="modal fade" id="addOperationCart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

        </div>
    </div>
</div>

<!-- 开发预估时间 -->
<div class="modal fade" id="tt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        </div>
    </div>
</div>
<!-- 测试预估时间 -->
<div class="modal fade" id="testTime" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        </div>
    </div>
</div>
<!-- 业务流评分 -->
<div class="modal fade" id="testScore" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#aboutme").click(function(){
        $('#checkstt').toggle();
    });
    $(function ()
        {
            <?php if(!empty($opost["about_uid"])): ?>
                var arr ='<?php echo $opost["about_uid"];?>'.split(',');
                if(arr!="")
                {
                    for(var i in arr)
                    {
                        $(":checkbox").each(function()
                        {
                            if(arr[i]==$(this).val())
                            {
                                $(this).attr("checked", true);
                            }
                        });
                    }
                }
            <?php endif; ?>
        }
    )
</script>