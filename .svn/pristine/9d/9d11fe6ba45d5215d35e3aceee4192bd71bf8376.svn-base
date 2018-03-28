<style type="text/css">
    #checkstt.input-group-addon{padding: 8px;text-align: left;white-space:normal}
    .input-group-addon.checkstt{height: 70px;line-height: 25px;width: 1100px;float: left;text-align: left;}
    #checkstt{display: none;}
    .col-sm-2{width: auto}
    .checkstt label{margin-right: 23px;}
    #leftsead{width:88px;position:fixed;top:400px;left:0px;z-index: 9999}
    #leftsead ul li{list-style: none;height: 30px}
    #vv li{height: 40px;width:800px }
    .roundedOne {
        width: 25px;
        height: 25px;
        position: relative;
        margin: 25px auto;
        background: #fcfff4;
        background: -moz-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
        background: -webkit-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
        background: linear-gradient(to bottom, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
        -moz-border-radius: 50px;
        -webkit-border-radius: 50px;
        border-radius: 50px;

    }
</style>
<?php
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
<form  name="form" action="/operation/actionCheck/score?uid=<?php echo $uid;?>" method="post">
    <div class="container">
        <div class="panel panel-danger">
            <div class="panel-heading panel-question">
                <span class=""><strong style="font-size: x-large"><?php $to_name=Manage::model()->findByPk($uid);echo $to_name['name']  ?> 行为考核项</strong></span>&nbsp;&nbsp;
            </div>
            <?php
            //判断是否有提示信息
            if(Yii::app()->user->hasFlash('status')):?>
                <div class="alert alert-success">
                    <b><?php echo Yii::app()->user->getFlash('status');?></b>
                </div>
            <?php endif;?>
            <div class="panel-body">
                <ul style="list-style: decimal" id="v">
                    <?php foreach($data as $v) {?>
                        <li> <?php echo $v['title'];$model=ActionCheck::findByFid($v['id'])?>
                            <ul style="list-style: upper-alpha" id="vv">
                                <?php foreach($model as $vv) {?>
                                    <LI> <label>
                                            <input type="radio" name="<?php echo $v['id'];?>" id="optionsRadios1" value="<?php echo $vv['score'];?>" class="roundedOne">
                                        </label>
                                        <?php echo $vv['title']. ' ['.$vv['score'].'分]';?>
                                    </LI>
                                <?php }?>
                            </ul>
                        </li>
                    <?php }?>
                </ul>
                <button type="submit" class="btn btn-default">提交</button>
            </div>
        </div>
    </div>
</form>

