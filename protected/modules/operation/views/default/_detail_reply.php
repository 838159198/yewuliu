<?php
//判断用户是否有权限回复
if($threadRole=="ok"):?>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4 class="panel-title"><span class="label label-primary"><strong>回复</strong></span>&nbsp;&nbsp;<strong></strong></h4>
        </div>
        <div class="panel-body">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'admin-form',
                'enableAjaxValidation' => false,
                //'htmlOptions' =>array("class"=>"form-inline"),
            )); ?>
            <?php echo $form->errorSummary($threadModel,'<b>请修复以下错误</b>','',array("class"=>"alert alert-danger")); ?>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">开发周期</label>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <?php echo $form->textField($threadModel, 'hours',array("class"=>"form-control text-center","aria-describedby"=>"sizing-addon2")); ?>
                                    <span class="input-group-addon" id="sizing-addon2">小时</span>
                                </div>
                            </div>


                            <div class="col-sm-6">
                                <?php echo $form->dropDownList($threadModel, 'minute',CHtml::listData(Common::MinuteListData(0,60),"key","value"),array("class"=>"form-control")); ?>

                            </div>
                        </div>
                    </div>
                </div>
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
                <button type="submit" id="myButton" class="btn btn-primary">确认提交</button>
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