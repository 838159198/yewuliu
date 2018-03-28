<style type="text/css">
    .input-group-addon{padding: 8px;text-align: left;white-space: pre-wrap}
    .checkst{margin-right: 15px;float: left;}
    .input-group-addon.checkstt{height: 70px;line-height: 25px;width: 945px;float: left}
    #checkstt{display: none;}
    .tt{
        margin: 0;
        padding: 0;
        float: left;
    }
    .input-group-addon, .input-group-btn {
        width: 1%;
        /* white-space: nowrap; */
        vertical-align: middle;
    }
    input[type="checkbox"]{margin-left: 23px;}
</style>
  <?php

    $model = new OperationPost();
    ?>
<div class="container-fluid">
    <div class="page-header  sp-title">
        <h1 class="text-center">需求变更<small></small></h1>
    </div>
</div>
<div class="container">
  <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'admin-form',
        'enableAjaxValidation' => false,
        'htmlOptions' =>array("class"=>"form-horizontal", 'name'=>'form1',"onsubmit"=>"return queren()"),'action'=>array('/operation/default/change'),
    )); ?>
    <div class="form-group">
        <label class="col-sm-2 control-label">预估时长</label>
        <div class="col-sm-2">
            <input class="form-control" style="width:200px" name="OperationPost[shi]" id="OperationPost_shi" type="text" maxlength="30" onkeyup="this.value=this.value.replace(/\D/g,'')">
        </div>
        <div style="width:10px;margin-left:10px;padding-top:7px;" class="col-sm-2">
            时
        </div>
        <div class="col-sm-2">
            <input class="form-control" style="width:200px" name="OperationPost[fen]" id="OperationPost_fen" type="text" maxlength="30" onkeyup="this.value=this.value.replace(/\D/g,'')">
        </div>
        <div style="width:10px;margin-left:10px;padding-top:7px;" class="col-sm-2">
            分
        </div>
        <input type="hidden" name='OperationPost[postid]' id="postid">
    </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">附件</label>
            <div class="col-sm-10">
                <?php echo $form->hiddenField($model, 'file',array("class"=>"form-control")); ?>
                <div id="file_ok">
<!--                    <div class="createfile">
                        <div class="createfile-img">
                                <img src="/style/v1/zip01.png" alt="...">
                        </div>
                        <div class="createfile-body">
                            <h4>内谁的内谁的测试包.zip</h4>
                            <div class="createfile-txt">大小：120 kb&nbsp;&nbsp;</div>
                        </div>
                        <div class="createfile-button">
                            <div class="text-right"><a class="btn btn-danger" href="#">删除</a></div>
                        </div>
                    </div>-->

                </div>
                <input id="file_upload" name="file_upload" type="file" multiple="true">
                <div id="queue"></div>
            </div>
            <script type="text/javascript">
                //移除文件
                function opremove(id)
                {
                    //var $id = $id;
                    var opid = "#opfile"+id;
                    //alert(opid)
                    $(opid).remove();
                }
            </script>
            <script type="text/javascript">
                <?php $timestamp = time();?>
                $(function() {
                    $('#file_upload').uploadify({
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
                                        "<input name=\"OperationPost[file][]\" value=\""+resJSON.id+"\" type=\"hidden\" />"+
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
                                    "<input name=\"OperationPost[file][]\" value=\""+resJSON.id+"\" type=\"hidden\" />"+
                                    "<div class=\"createfile-img\"><img src=\"/style/v1/zip01.png\"></div>" +
                                    "<div class=\"createfile-body\">"+
                                    "<h4>"+resJSON.name+"</h4>"+
                                    "<div class=\"createfile-txt\">大小："+resJSON.size+"&nbsp;&nbsp;</div>"+
                                    "</div>"+
                                    "<div class=\"createfile-button\">"+
                                    "<div class=\"text-right\"><button class=\"btn btn-danger\" onclick=\"opremove("+resJSON.id+")\" >删除</button></div>"+
                                    "</div>"+
                                    "</div>");
                                }else if(resJSON.type=="xls"){
                                    $("#file_ok").append("<div id=\"opfile"+resJSON.id+"\" class=\"createfile\">" +
                                    "<input name=\"OperationPost[file][]\" value=\""+resJSON.id+"\" type=\"hidden\" />"+
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
                                    "<input name=\"OperationPost[file][]\" value=\""+resJSON.id+"\" type=\"hidden\" />"+
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
                                    "<input name=\"OperationPost[file][]\" value=\""+resJSON.id+"\" type=\"hidden\" />"+
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
                                //$("#"+file.id).append("<img src='"+resJSON.msg+"' class='img' data='"+resJSON.id+"'><input type='hidden' name='imgid[]' value='"+resJSON.id+"'>");
                                //$("#file_ok").append("<img src="+resJSON.url+" alt="+resJSON.name+" title="+resJSON.name+">");
                                //alert('文件 ' + file.name + ' 上传成功.详细信息： '+resJSON.url+'a:' + response + ':' + data);
                            }else if(resJSON.status==403){
                                alert(resJSON.message);
                            }else{
                                alert("发生错误");
                            }

                        }
                    });
                });
            </script>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">业务内容</label>
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
                <?php //echo $form->textArea($model, 'content', array("class"=>"form-control",'rows' => 6)); ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-primary" id="submit_btn_123" name="submit_btn" value="确认提交">
            </div>
        </div>
    <?php $this->endWidget(); ?>
</div>
<script type="text/javascript">
	function GetQueryString(name)
    	{
        var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if(r!=null)return  unescape(r[2]); return null;
    	}

   function queren(){
	var content=$('#OperationPost_content').html();
	var shi=$('#OperationPost_shi').val();
	var fen=$('#OperationPost_fen').val();
	$('#postid').val(GetQueryString('id'));
	if(shi=='' && fen==''){
		alert('预估时间不能为空');
		return false;
	}
	//if(content==''){
		//alert('内容不能为空');
		//return false;
	//}
	return true;
	
}
</script>