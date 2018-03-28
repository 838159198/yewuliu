<style type="text/css">
    .tt{background-color:#CCFFFF;}
</style>
<script type="text/javascript">
    //批量修改的全选
    function check_all(obj,cName) {
        var checkboxs = document.getElementsByName(cName);
        for(var i=0;i<checkboxs.length;i++){checkboxs[i].checked = obj.checked;}
    }
</script>
<div class="container-fluid">
    <div class="page-header  sp-title">
        <h1 class="text-center"><?php echo $monthData->title;?><small><?php echo $monthData->startdatetime?> ~ <?php echo $monthData->enddatetime?></small></h1>
    </div>
</div>
<div class="alert alert-info" style="margin-left:16px;margin-right: 15px;">
    <?php if(in_array(Yii::app()->user->id,array(3,50,1,14))): ?>
        <button type="button" id="myAll" onclick="updateAllScore()" class="btn btn-danger pull" >批量修改</button>&nbsp;&nbsp;&nbsp;
    <?php endif;?>
        <span>注：有背景色的为自动扣分项，原则上不允许修改</span>
</div>
<div class="container-fluid">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <?php if(in_array(Yii::app()->user->id,array(1,3,14,50))) {?>
         <?php $i=1;foreach($names as $name): ?>
            <li role="presentation" <?php if($i==1):?> class="active"<?php endif;?>>
                <a href="#<?php echo $name->manages->username;?>" aria-controls="home" role="tab" data-toggle="tab" >
                    <?php echo $name->manages->name;?>
                </a>
            </li>
         <?php $i++;$uid=$name['uid'];endforeach;?>
            <?php }else{ $uid =Yii::app()->user->id; $data=Manage::model()->findByPk($uid); ?>
            <a href="#<?=$data['username']?>" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><?=$data['name']?></a>
            <?php } ?>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
    <?php if(in_array(Yii::app()->user->id,array(1,3,14,50))) {?>
        <?php $i=0; foreach($names as $name):?>
        <div role="tabpanel" class="tab-pane <?php if($i==0):?> active<?php endif;?>" id="<?php echo $name->manages->username?>">
            <?php $kpiChecks = KpiCheck::model()->findAll("uid={$name['uid']} and month_id={$_GET['id']}");?>
            <table class="table table-bordered table-hover" style="margin-top: 15px;">
                <thead>
                <tr>
                    <th width="120"><input type="checkbox" name="all" onclick="check_all(this,'box')" /></th>
                    <th width="300">考核项</th>
                    <th width="120">规则</th>
                    <th width="120">总分值</th>
                    <th width="160">扣分</th>
                    <th width="160">总得分</th>
                    <th width="600">备注</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php $count=0;$count1=0;$week_start='';$week_fri=''; foreach($kpiChecks as $kpiCheck):?>
                    <tr class="<?php if(in_array($kpiCheck->projects->name,array('业务流周工作总结提交', '业务流周工作总结创建','业务流周总时长', '业务流任务完成率','业务流bug'))):?>tt<?php endif; ?>">
                        <td><input type="checkbox" name="box" value="<?=$kpiCheck['id']?>"></td>
                        <td><?php echo $kpiCheck->projects->name;?></td>
                        <td>
                            <p class="tooltip-options" >
                                <a href="#" data-toggle="tooltip" title="<h5><?php echo KpiProject::findExplainById($kpiCheck['pid']) ?></h5><h4><?php echo KpiProject::findRuleById($kpiCheck['pid']) ?></h4>">详情</a>
                            </p>
                        </td>
                        <td><?php $count1=$count1+$kpiCheck['sum'];echo $kpiCheck['sum'];?></td>
                        <td><input type="text" id="score_<?=$kpiCheck['id']?>" value="<?=$kpiCheck['score']?>" /></td>
                        <?php
                            if($kpiCheck->projects->name == '业务流周工作总结提交') {//业务流周工作总结提交的自动扣分
                               $data=KpiCheck::findByKpi($kpiCheck);
                                $score=$data['score'];
                        ?>
                            <td title="<?php echo '周总结：'.$data['num'].'个 逾期：'.$data['i'];?>"><?php $b=5-$kpiCheck['score']>=0? 5-$kpiCheck['score']:0;echo $a=($kpiCheck['score']==null ? 5-$score:$b);
                                $kpiCheck['score']==null ? $count=$count+5-$score:$count=$count+5-$kpiCheck['score'] ?></td>
                        <?php
                            }elseif($kpiCheck->projects->name == '业务流周工作总结创建'&& $kpiCheck->manages->department!=19 ){
                                $data=KpiCheck::findByKpi($kpiCheck);
                                $score=$data['score'];
                        ?>
                                <td title="<?php echo $data['num'].'个周总结&nbsp过简'.$data['i']; ?>"><?php $b=3-$kpiCheck['score']>=0? 3-$kpiCheck['score']:0;echo $a=($kpiCheck['score']==null? 3-$score:$b);
                                    $kpiCheck['score']==null ? $count=$count+3-$score:$count=$count+3-$kpiCheck['score'] ?></td>
                            <?php
                            }elseif($kpiCheck->projects->name == '业务流周工作总结创建'&& $kpiCheck->manages->department==19 ){
                                $data=KpiCheck::findByKpi($kpiCheck);
                                $score=$data['score'];
                                ?>

                                <td title="<?php echo  $data['num'].'个周总结&nbsp过简'. $data['i']; ?>"><?php $b=5-$kpiCheck['score']>=0? 5-$kpiCheck['score']:0;echo $a=($kpiCheck['score']==null? 5-$score:$b);
                                    $kpiCheck['score']==null ? $count=$count+5-$score:$count=$count+5-$kpiCheck['score'] ?></td>
                        <?php
                            }elseif($kpiCheck->projects->name == '业务流周总时长'){
                                $data=KpiCheck::findByKpi($kpiCheck);
                                $score=$data['score'];
                                $scores=$data['scores'];
                                if(count($scores)==5){
                                    $score1=$scores[0]; $score2=$scores[1]; $score3=$scores[2]; $score4=$scores[3]; $score5=$scores[4];
                                }elseif(count($scores)==4){
                                    $score1=$scores[0]; $score2=$scores[1]; $score3=$scores[2]; $score4=$scores[3]; $score5=0;
                                }elseif(count($scores)==3){
                                    $score1=$scores[0]; $score2=$scores[1]; $score3=$scores[2]; $score4=0; $score5=0;
                                }elseif(count($scores)==2){
                                    $score1=$scores[0]; $score2=$scores[1]; $score3=0; $score4=0; $score5=0;
                                }

                            ?>
                                <td title="<?php echo '总的扣分：'.$score.'&nbsp;  1周：'.$score1.'&nbsp;&nbsp;&nbsp;&nbsp;2周：'.$score2.'&nbsp;&nbsp;&nbsp;&nbsp;3周：'.$score3.'&nbsp;&nbsp;&nbsp;&nbsp;4周：'.$score4.'&nbsp;&nbsp;&nbsp;&nbsp;5周：'.$score5;?>">
                                    <?php $b=5-$kpiCheck['score']>=0 ? 5-$kpiCheck['score']:0;echo $a=($kpiCheck['score']==null? (5-$score):$b);
                                    if($kpiCheck['score']==null) {
                                        $count = $count + 5 - $score;
                                    }else{$count=$count+5-$kpiCheck['score'];}
                                 ?></td>
                            <?php
                            }elseif($kpiCheck->projects->name == '业务流任务完成率'){
                                $data=KpiCheck::findByKpi($kpiCheck);
                                $score=$data['score'];
                        ?>
                                <td title="<?php echo '停留时间：'.round(($data['stay_time']/60),1).'预估时间：'.round(($data['estimate']/60),1).'完成率：'.$data['finish']?>"><?php $b=55-$kpiCheck['score']>=0? 55-$kpiCheck['score']:0;echo $a=($kpiCheck['score']==null? 55-$score:$b);
                                    $kpiCheck['score']==null ? $count=$count+55-$score:$count=$count+55-$kpiCheck['score'] ?></td>
                        <?php }elseif($kpiCheck->projects->name == '业务流bug' && $kpiCheck->manages->department==19){
                                $data=KpiCheck::findByKpi($kpiCheck);
                                $score=$data['score'];
                        ?>
                                <td><?php $b=15-$kpiCheck['score']>=0? 15-$kpiCheck['score']:0;echo $a=($kpiCheck['score']==null? 15-$score:$b);
                                    $kpiCheck['score']==null ? $count=$count+15-$score:$count=$count+15-$kpiCheck['score'] ?></td>
                        <?php }else{ ?>
                            <td><?=$kpiCheck['sum']-$kpiCheck['score']>=0 ? $kpiCheck['sum']-$kpiCheck['score']:0;$count=$count+$kpiCheck['sum']-$kpiCheck['score']?></td>
                        <?php  } ?>
                            <td><input type="text" id="beizhu_<?=$kpiCheck['id']?>" style="width: 100%" value="<?=$kpiCheck['beizhu']?>" > </td>
                            <td><?php if(in_array(Yii::app()->user->id,array(3,50,1,14))) {?>
                            <a href="javascript:updateScore(<?=$kpiCheck['id']?>)"><button class="btn btn-primary" data-toggle="modal" data-target="#myModal">修改</button></a>
                        <?php }?>
                            </td>
                    </tr>
                <?php endforeach;?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>总：<?php echo $count1;?></td>
                    <td></td>
                    <td>总：<?php echo $count;?></td>
                    <?php $Data = ActionScore::model()->find("uid=:uid and createdate=:createdate and type=:type",array(":uid"=>$name["uid"],":createdate"=>date("Y-m",$monthData->createdate),":type"=>'kpi'));
                        isset($Data)? $url='javascript:alert(\'您已经提交！\')':$url='javascript:addKpi('.$count.','.$name["uid"].','.$monthData->createdate.')';
                    ?>
                    <td>
                        <a href="<?php echo $url;?> " val="<?php echo $name["uid"].'_'.$count ?>"><button class="btn btn-<?php echo isset($Data) ? 'danger':'primary' ?>" >导入KPI考核得分</button></a>
                    </td>
                </tr>

                </tbody>
            </table>
        </div>
        <?php $i++;endforeach;?>
    <?php }elseif( !in_array(Yii::app()->user->id,array(1,3,14,50))){ ?>
        <?php $i=0; $name= Yii::app()->user->id  ?>
            <div role="tabpanel" class="tab-pane <?php if($i==0):?> active<?php endif;?>" id="<?php echo $name ?>">
            <?php $kpiChecks = KpiCheck::model()->findAll("uid={$name} and month_id={$_GET['id']}");?>
            <table class="table table-bordered table-hover" style="margin-top: 15px;">
            <thead>
            <tr>
                <th width="120"><input type="checkbox" name="all" onclick="check_all(this,'box')" /></th>
                <th width="300">考核项</th>
                <th width="120">规则</th>
                <th width="120">总分值</th>
                <th width="160">扣分</th>
                <th width="160">总得分</th>
                <th width="600">备注</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php $count=0;$count1=0;$week_start='';$week_fri=''; foreach($kpiChecks as $kpiCheck):?>
                <tr class="<?php if(in_array($kpiCheck->projects->name,array('业务流周工作总结提交', '业务流周工作总结创建','业务流周总时长', '业务流任务完成率','业务流bug'))):?>tt<?php endif; ?>">
                <td><input type="checkbox" name="box" value="<?=$kpiCheck['id']?>"></td>
                <td><?php echo $kpiCheck->projects->name;?></td>
                <td> <p class="tooltip-options" >
                        <a href="#" data-toggle="tooltip" title="<h5><?php echo KpiProject::findExplainById($kpiCheck['pid']) ?></h5><h4><?php echo KpiProject::findRuleById($kpiCheck['pid']) ?></h4>">详情</a>
                    </p></td>
                <td><?php $count1=$count1+$kpiCheck['sum'];echo $kpiCheck['sum'];?></td>
                <td><input type="text" id="score_<?=$kpiCheck['id']?>" value="<?=$kpiCheck['score']?>" /></td>
                    <?php
                    if($kpiCheck->projects->name == '业务流周工作总结提交') {//业务流周工作总结提交的自动扣分
                        $data=KpiCheck::findByKpi($kpiCheck);
                        $score=$data['score'];
                        ?>
                        <td title="<?php echo '周总结：'.$data['num'].'个 逾期：'.$data['i'];?>"><?php $b=5-$kpiCheck['score']>=0? 5-$kpiCheck['score']:0;echo $a=($kpiCheck['score']==null ? 5-$score:$b);
                            $kpiCheck['score']==null ? $count=$count+5-$score:$count=$count+5-$kpiCheck['score'] ?></td>
                    <?php
                    }elseif($kpiCheck->projects->name == '业务流周工作总结创建'&& $kpiCheck->manages->department!=19 ){
                        $data=KpiCheck::findByKpi($kpiCheck);
                        $score=$data['score'];
                        ?>
                        <td title="<?php echo $data['num'].'个周总结&nbsp过简'.$data['i']; ?>"><?php $b=3-$kpiCheck['score']>=0? 3-$kpiCheck['score']:0;echo $a=($kpiCheck['score']==null? 3-$score:$b);
                            $kpiCheck['score']==null ? $count=$count+3-$score:$count=$count+3-$kpiCheck['score'] ?></td>
                    <?php
                    }elseif($kpiCheck->projects->name == '业务流周工作总结创建'&& $kpiCheck->manages->department==19 ){
                        $data=KpiCheck::findByKpi($kpiCheck);
                        $score=$data['score'];
                        ?>

                        <td title="<?php echo  $data['num'].'个周总结&nbsp过简'. $data['i']; ?>"><?php $b=5-$kpiCheck['score']>=0? 5-$kpiCheck['score']:0;echo $a=($kpiCheck['score']==null? 5-$score:$b);
                            $kpiCheck['score']==null ? $count=$count+5-$score:$count=$count+5-$kpiCheck['score'] ?></td>
                    <?php
                    }elseif($kpiCheck->projects->name == '业务流周总时长'){
                        $data=KpiCheck::findByKpi($kpiCheck);
                        $score=$data['score'];
                        $scores=$data['scores'];
                        if(count($scores)==5){
                            $score1=$scores[0]; $score2=$scores[1]; $score3=$scores[2]; $score4=$scores[3]; $score5=$scores[4];
                        }elseif(count($scores)==4){
                            $score1=$scores[0]; $score2=$scores[1]; $score3=$scores[2]; $score4=$scores[3]; $score5=0;
                        }elseif(count($scores)==3){
                            $score1=$scores[0]; $score2=$scores[1]; $score3=$scores[2]; $score4=0; $score5=0;
                        }elseif(count($scores)==2){
                            $score1=$scores[0]; $score2=$scores[1]; $score3=0; $score4=0; $score5=0;
                        }

                        ?>
                        <td title="<?php echo '总的扣分：'.$score.'&nbsp;  1周：'.$score1.'&nbsp;&nbsp;&nbsp;&nbsp;2周：'.$score2.'&nbsp;&nbsp;&nbsp;&nbsp;3周：'.$score3.'&nbsp;&nbsp;&nbsp;&nbsp;4周：'.$score4.'&nbsp;&nbsp;&nbsp;&nbsp;5周：'.$score5;?>">
                            <?php $b=5-$kpiCheck['score']>=0 ? 5-$kpiCheck['score']:0;echo $a=($kpiCheck['score']==null? (5-$score):$b);
                            if($kpiCheck['score']==null) {
                                $count = $count + 5 - $score;
                            }else{$count=$count+5-$kpiCheck['score'];}
                            ?></td>
                    <?php
                    }elseif($kpiCheck->projects->name == '业务流任务完成率'){
                        $data=KpiCheck::findByKpi($kpiCheck);
                        $score=$data['score'];
                        ?>
                        <td title="<?php echo '停留时间：'.round(($data['stay_time']/60),1).'预估时间：'.round(($data['estimate']/60),1).'完成率：'.$data['finish']?>"><?php $b=55-$kpiCheck['score']>=0? 55-$kpiCheck['score']:0;echo $a=($kpiCheck['score']==null? 55-$score:$b);
                            $kpiCheck['score']==null ? $count=$count+55-$score:$count=$count+55-$kpiCheck['score'] ?></td>
                    <?php }elseif($kpiCheck->projects->name == '业务流bug' && $kpiCheck->manages->department==19){
                        $data=KpiCheck::findByKpi($kpiCheck);
                        $score=$data['score'];
                        ?>
                        <td><?php $b=15-$kpiCheck['score']>=0? 15-$kpiCheck['score']:0;echo $a=($kpiCheck['score']==null? 15-$score:$b);
                            $kpiCheck['score']==null ? $count=$count+15-$score:$count=$count+15-$kpiCheck['score'] ?></td>
                    <?php }else{ ?>
                        <td><?=$kpiCheck['sum']-$kpiCheck['score']>=0 ? $kpiCheck['sum']-$kpiCheck['score']:0;$count=$count+$kpiCheck['sum']-$kpiCheck['score']?></td>
                    <?php  } ?>
                <td><input type="text" id="beizhu_<?=$kpiCheck['id']?>" style="width: 100%" value="<?=$kpiCheck['beizhu']?>" > </td>
                <td><?php if(in_array(Yii::app()->user->id,array(3,50,1,14))) {?>
                        <a href="javascript:updateScore(<?=$kpiCheck['id']?>)"><button class="btn btn-primary" data-toggle="modal" data-target="#myModal">修改</button></a>
                    <?php }?>
                </td>
                </tr>
            <?php endforeach;?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>总：<?php echo $count1;?></td>
                <td></td>
                <td>总：<?php echo $count;?></td>
                <td></td>
            </tr>
            </tbody>
            </table>
            </div>
            <?php ;$i++;?>
    <?php } ?>
    </div>
</div>
<script>
    $(function () { $(".tooltip-options a").tooltip({html : true });});
</script>
