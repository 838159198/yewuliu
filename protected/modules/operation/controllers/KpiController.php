<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2015/8/13
 * Time: 10:41
 * Name: 周报
 */
class KpiController extends OperationController
{

    /*
     * KPI考核列表
     * 权限：指定用户id可查看
     * */
    public function actionMonthList()
    {
        $mid = Yii::app()->user->id;
        $manageData = Manage::model()->findByPk($mid);
        $manageDataList = Manage::model()->findAll("status=1 and `department` in (16,18,19,20,33)");
        if(in_array($manageData->department,array(21,22,23,24,25,26)))
        {
            throw new CHttpException(403,"你没有访问权限");
        }
        $model = new KpiMonth('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['KpiMonth'])) {
            $model->attributes = $_GET['KpiMonth'];
        }
        $this->render('month_list',array("model"=>$model));
    }

    /*
     * 建立月kpi考核表
     * */
    public function actionCreateMonth()
    {
        //需要判断人员权限
        $mid = Yii::app()->user->id;
        //$manageData = Manage::model()->findByPk($mid);
        if(!in_array($mid,array(1,3,50)))
        {
            throw new CHttpException(403,"你没有访问权限");
        }else{
            $kpiMonthModel = new KpiMonth();
            $kpiMonthModel -> title = date('Y年第m月考核（m月d日）',time())."";
            if(isset($_POST['KpiMonth']))
            {
                foreach($_POST['KpiMonth'] as $_k => $_v)
                {
                    $kpiMonthModel -> $_k = $_v;
                }
                $time = time();
                $kpiMonthModel -> createdate = $time;
                $statDatetime = $kpiMonthModel->startdatetime;
                $endDatetime = $kpiMonthModel->enddatetime;
                $kpiMonthModel -> startdate = strtotime($statDatetime);
                $kpiMonthModel -> enddate = strtotime($endDatetime);
                $kpiMonthModel -> mid = $mid;
                //获取技术部人员
                $manageDataList = Manage::model()->findAll("status=1 and `department` in (16,18,19,20,33)");
                $manageNum = count($manageDataList);
                $kpiMonthModel ->num =$manageNum;
                if($kpiMonthModel -> save())
                {
                    $monthid =  Yii::app()->db->getLastInsertID();
                    //建立静态kpi考核表单 先循环每个人再循环每个考核项目
                    foreach($manageDataList as $_manage_row)
                    {
                        if($_manage_row['department']==19){
                            $kpiProject = KpiProject::model()->findAll("status=1 and attribute !=1 ");
                        }else{
                            $kpiProject = KpiProject::model()->findAll("status=1 and attribute !=2");
                        }
                        //var_dump($kpiProject);exit;
                        for($i=0;$i<sizeof($kpiProject);$i++){

                            $kpiCheck = new KpiCheck();
                            $kpiCheck -> month_id = $monthid;
                            $kpiCheck -> uid = $_manage_row['id'];
                            $kpiCheck -> createdate = $time;

                            $kpiCheck -> pid = $kpiProject[$i]['id'];
                            $kpiCheck -> sum = $kpiProject[$i]['sum'];
                            $kpiCheck->insert();
                        }

                    }
                    $this->redirect("monthList");
                }
            }
            $this->render("month_create",array("model"=>$kpiMonthModel));
        }
    }
    /*
     * 月kpi考核详情
     * 权限：指定用户可查看
     * */
    public function actionMonthDetail($id)
    {
        $mid = Yii::app()->user->id;
        if(!in_array($mid,array($mid)))
        {
            throw new CHttpException(403,"你没有访问权限");
        }else{
            $monthModel = new KpiMonth();
            $monthData = $monthModel->findByPk($id);
            $checkData = KpiCheck::model()->findAll("month_id={$id} ");

            $names = KpiCheck::model()->findAll(array(
                'select'=>array('distinct uid'),
                'condition' => 'month_id=:month_id',
                'params' => array(':month_id' =>$id),
                'order'=>'id ASC',
            ));

            $this->render("month_detail",array('monthData'=>$monthData,'checkData'=>$checkData,'names'=>$names));
        }
    }

    /*
     * 修改考核积分
     * */
    public function actionUpdateScore()
    {
        if(Yii::app()->request->isAjaxRequest && isset($_POST['id']) && isset($_POST['beizhu']) && isset($_POST['score']))
        {
            $mid = Yii::app()->user->id;
            $id = $_POST['id'];
            $beizhu = $_POST['beizhu'];
            $score = $_POST['score'];

            $checkModel = KpiCheck::model();
            $checkInfo = $checkModel->findByPk($id);
            if(!in_array($mid,array(50,1,3,14)))
            {
                exit(CJSON::encode(array("status"=>404,"message"=>"没有权限修改！")));
            }else{
                $checkInfo->score = $score;
                $checkInfo->beizhu = $beizhu;
                if($checkInfo->update())
                {
                    $checkLogModel = new KpiLog();
                    $checkLogModel->check_id=$id;
                    $checkLogModel->month_id=$checkInfo->month_id;
                    $checkLogModel->uid=$checkInfo->uid;
                    $checkLogModel->mid=$mid;
                    $checkLogModel->score=$score;
                    $checkLogModel->datetime=time();
                    $checkLogModel->save();

                    exit(CJSON::encode(array("status"=>200,"message"=>"修改成功！")));
                }else{
                    exit(CJSON::encode(array("status"=>400,"message"=>"修改失败！")));
                }
            }
        }else{
            exit(CJSON::encode(array("status"=>400,"message"=>"请使用正确的姿势提交！")));
        }
    }

    /*
     * 批量修改考核积分
     * */
    public function actionUpdateAllScore()
    {
        if(Yii::app()->request->isAjaxRequest && isset($_POST['obj']) )
        {
            $mid = Yii::app()->user->id;
            $obj= $_POST["obj"];
            $lines = explode(",", $obj);    //将多行数据分开
            //echo count($lines)-1;
            for($i=0;$i<=count($lines)-1;$i++){
                $info = explode("_", $lines[$i]);
               if(count($info)>1){
                   $id = $info[0];
                   $score=$info[1];
                   $beizhu = ($info[2] == "=")? "" :$info[2] ;
                   $checkModel = KpiCheck::model();
                   $checkInfo = $checkModel->findByPk($id);
                   $checkInfo->score = $score;
                   $checkInfo->beizhu = $beizhu;
                   $m=$checkInfo->update();
                   if($m){
                       $checkLogModel = new KpiLog();
                       $checkLogModel->check_id=$id;
                       $checkLogModel->month_id=$checkInfo->month_id;
                       $checkLogModel->uid=$checkInfo->uid;
                       $checkLogModel->mid=$mid;
                       $checkLogModel->score=$score;
                       $checkLogModel->datetime=time();
                       $checkLogModel->save();
                   }

               }

               // $checkInfo->update();

            }
            if($m>=1){
                exit(CJSON::encode(array("status"=>200,"message"=>"批量修改完成！")));
            }else{
                exit(CJSON::encode(array("status"=>400,"message"=>"批量修改失败！")));
            }



        }else{
            exit(CJSON::encode(array("status"=>400,"message"=>"请使用正确的姿势提交！")));
        }


    }


}