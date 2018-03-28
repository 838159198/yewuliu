<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <?php if(Yii::app()->controller->id=="default" && $this->getAction()->getId()=="detail"){ ?>
    <title><?php echo CHtml::encode($this->pageTitle);?></title>
    <?php }?>
    <title>管理后台<?php //echo CHtml::encode($this->pageTitle);?></title>
    <?php Yii::app()->clientScript->registerCoreScript('jquery');?>
    <!-- Bootstrap -->
    <link href="/style/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/style/v1/base.css" rel="stylesheet">
<!--    <link href="/style/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">-->
    <!--<script src="http://apps.bdimg.com/libs/jquery/1.11.1/jquery.min.js"></script>-->
    <script src="/style/bootstrap/js/bootstrap.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="/style/uploadify/jquery.uploadify.min.js"></script>
    <link href="/style/uploadify/uploadify.css" rel="stylesheet">
    <script src="/style/bsdatetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/style/bsdatetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>
    <link href="/style/bsdatetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <script src="/style/base.js"></script>
</head>
<body>
<?php
//业务池
$operationModel = new OperationPost();
$opserationNum = count($operationModel->findAll("status=1"));
//等待我回复的业务
$mid = Yii::app()->user->id;
$manageData = Manage::model()->findByPk($mid);
$operationWaitNum = $operationModel->count("`status`=2 and `owner_mid`={$mid}");
$operationStopNum = $operationModel->count("`status`=4 and `owner_mid`={$mid}");
?>
<nav class="navbar navbar-default navbar-static-top navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!--<a class="navbar-brand" href="#">业务流</a>-->
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <!--class="active"-->
                <li class="active"><a href="<?php echo Yii::app()->createUrl("operation/default");?>">系统首页</a></li>
                <li><a href="<?php echo Yii::app()->createUrl("operation/default/wait");?>">公共业务池 <span class="badge"><?php echo $opserationNum;?></span><span class="sr-only">(current)</span></a></li>
                <li><a href="<?php echo Yii::app()->createUrl("operation/default/all");?>">全部业务流</a></li>
                <li><a href="<?php echo Yii::app()->createUrl("operation/test/template");?>">测试用例模板</a></li>
                <li><a href="<?php echo Yii::app()->createUrl("operation/manage");?>">用户管理</a></li>
                <li><a href="<?php echo Yii::app()->createUrl("operation/summary/weekList");?>">工作总结</a></li>
                <li><a href="<?php echo Yii::app()->createUrl("operation/softPutRecord");?>">软件投放信息</a></li>
                <?php if($manageData->department !=19){?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">考核评分 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <!--<li><a href="<?php /*echo Yii::app()->createUrl("operation/my/all");*/?>">全部业务流</a></li>-->
                        <li><a href="<?php echo Yii::app()->createUrl("operation/kpi/monthList");?>">工作质量考核</a></li>
                        <?php if($manageData['is_head']>=1){?>
                        <li><a href="<?php echo Yii::app()->createUrl("operation/actionCheck/actionList");?>">个人行为考核</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl("operation/actionCheck/leadList");?>">领导评价考核</a></li>
                        <?php }?>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?php echo Yii::app()->createUrl("operation/actionCheck/monthList");?>">考核得分列表</a></li>
                    </ul>
                </li>
                <?php }?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">我的业务池 <span class="badge"><?php echo $operationWaitNum;?></span><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <!--<li><a href="<?php /*echo Yii::app()->createUrl("operation/my/all");*/?>">全部业务流</a></li>-->

                        <li><a href="<?php echo Yii::app()->createUrl("operation/my/operation");?>">我接收的业务流</a></li>
    <?php 
    $id = Yii::app()->user->id;
    $sql="select department from `ele_manage` where id={$id}";
    $result=yii::app()->db->createCommand($sql)->queryAll();
    if(isset($result) && !empty($result)){
        if($result[0]['department']=='19'){//质检部的才有此权限
            echo '<li><a href="'.Yii::app()->createUrl("operation/my/test").'">我测试的业务流</a></li>';
        }
    }
    ?>
                        <li><a href="<?php echo Yii::app()->createUrl("operation/my/underway?status=2");?>">等待回复 <span class="badge"><?php echo $operationWaitNum;?></span></a></li>
                        <li><a href="<?php echo Yii::app()->createUrl("operation/my/underway?status=4");?>">已暂停 <span class="badge"><?php echo $operationStopNum;?></span></a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?php echo Yii::app()->createUrl("operation/my/create");?>">我创建的业务流</a></li>
                    </ul>
                </li>

            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo Yii::app()->user->name;?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo Yii::app()->createUrl("operation/summary/my");?>">我的工作总结</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl("operation/manage/password");?>">修改密码</a></li>
                        <?php if(Yii::app()->user->id==21):?>
                             <li><a href="<?php echo Yii::app()->createUrl("operation/default/dayText");?>">每日一言</a></li>
                        <?php endif; ?>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?php echo Yii::app()->createUrl("site/logout");?>">安全退出</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<?php echo $content;?>

</body>
</html>