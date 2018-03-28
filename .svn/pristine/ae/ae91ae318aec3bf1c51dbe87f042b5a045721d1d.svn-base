<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2015/8/5
 * Time: 9:38
 */
class MyController extends OperationController
{
    /*
     * 我的全部业务
     * */
    public function actionAll()
    {
        $model = new OperationPost('search');
        $model->unsetAttributes();
        //$model->manage_create_name="";
        if (isset($_GET['OperationPost'])) {
            $model->attributes = $_GET['OperationPost'];
        }
        $this->render('all',array("model"=>$model));
    }
    /*
     * 进行中
     * */
    public function actionUnderway()
    {
        $uid = Yii::app()->user->id;
        $model = new OperationPost('search');
        $model->unsetAttributes();
        if (isset($_GET['OperationPost'])) {
            $model->attributes = $_GET['OperationPost'];

        }

        //获取本周第一天/最后一天的时间戳
        $year = date("Y");
        $month = date("m");
        $day = date('w');
        $nowMonthDay = date("t");
        $firstday = date('d') - $day;
        if(substr($firstday,0,1) == "-"){
            $firstMonth = $month - 1;
            $lastMonthDay = date("t",$firstMonth);
            $firstday = $lastMonthDay - substr($firstday,1);
            $time_1 = strtotime($year."-".$firstMonth."-".$firstday);
        }else{
            $time_1 = strtotime($year."-".$month."-".$firstday);
        }
        $lastday = date('d') + (7 - $day);
        if($lastday > $nowMonthDay){
            $lastday = $lastday - $nowMonthDay;
            $lastMonth = $month + 1;
            $time_2 = strtotime($year."-".$lastMonth."-".$lastday);
        }else{
            $time_2 = strtotime($year."-".$month."-".$lastday);
        }

        //获取本周的占用项
        $spareTime =SpareTimeOnoff::model()->findAll(array(
            'select'=>array('id','content','start_datetime','end_datetime','status','developtime'),
            'order' => 'id DESC',
            'condition' => 'start_datetime>:start_datetime and end_datetime<:end_datetime and post_uid=:post_uid',
            'params' => array(':start_datetime'=>$time_1,':end_datetime'=>$time_2,':post_uid'=>$uid),
        ));

        $spareTime_status=SpareTimeOnoff::model()->find('status=:status and post_uid=:post_uid',array(':status'=>1,':post_uid'=>$uid));

        $status=0;$id=0;
        if($spareTime_status){
            $id=$spareTime_status->id;
            $status=1;
        }
        $this->render('underway',array("model"=>$model,"spareTime"=>$spareTime,"status"=>$status,"id"=>$id));
    }
    /*
     * 我创建的业务流
     * */
    public function actionCreate()
    {
        $name = Yii::app()->user->name;
        $model = new OperationPost('search');
        $model->unsetAttributes();
        $model->manage_create_name=$name;
        if (isset($_GET['OperationPost'])) {
            $model->attributes = $_GET['OperationPost'];
        }
        $this->render('create',array("model"=>$model));
    }

    /*
     * 我的业务池
     * */
    public function actionOperation()
    {
        $name = Yii::app()->user->name;
        $mid = Yii::app()->user->id;
        $model = new OperationPost('search');
        $model->unsetAttributes();
        $model->manage_receive_name=$name;
        //$model->receive_mid=$mid;
        if (isset($_GET['OperationPost'])) {
            $model->attributes = $_GET['OperationPost'];
        }
        $this->render('operation',array("model"=>$model));
    }
    /**
     *业务流3060
     * 2017-10-17
     * zlb
     * 质检人员测试的业务流
     */
    public function actionTest(){
        $mid = Yii::app()->user->id;
        if(isset($mid)){
            //保留2017-10-18号之前的旧数据
            $sql="select postid from `ele_operation_thread` where post_uid={$mid} and datetime<=1508315200";
            $result=yii::app()->db->createCommand($sql)->queryAll();
            $ywlid=array();
            if(isset($result) && !empty($result)){
                foreach ($result as $key => $value) {
                    $ywlid[]=$value['postid'];
                }
            }
            //新增功能，数据库content对应业务流id，每个评分对应相应的业务流
            $sql="select content from `ele_action_score` where mid={$mid} and type='post'";
            $result=yii::app()->db->createCommand($sql)->queryAll();
            $ywlid2=array();
            if(isset($result) && !empty($result)){
                foreach ($result as $key => $value) {
                    $ywlid2[]=$value['content'];
                }
            }
            $id=array_merge($ywlid,$ywlid2);
            $ids=array_merge(array_unique($id));
            $model = new OperationPost('retest');
            $model->unsetAttributes();
            if (isset($_GET['OperationPost'])) {
                // print_r($_GET['OperationPost']);exit;
                $model->attributes = $_GET['OperationPost'];
            }
            // print_r($model);exit;
            $this->render('test',array("model"=>$model,'data'=>$ids));
        }
        
    }
    //开启占用时间
    public function actionSpareTimeAdd(){
        $name = Yii::app()->user->name;
        $uid = Yii::app()->user->id;
        $model = new SpareTimeOnoff();

        $model->post_uid=$uid;
        $model->content=$_POST['content'];

        $model->start_datetime=time();
       if($model->save()){

           //关闭业务流
           $operationPost=OperationPost::model()->find('cur_status=:cur_status and owner_mid=:owner_mid',array(':cur_status'=>1,':owner_mid'=>$uid));
           if($operationPost){
               $operationPost->cur_status=0;
               $operationPost->save();
           }

           //关闭业务流 并保存关闭时间
           $operationOnoff=OperationOnoff::model()->find('status=:status and post_uid=:post_uid',array(':status'=>1,':post_uid'=>$uid));
           if($operationOnoff){
               $operationOnoff->status=0;
               $time=time();
               $operationOnoff->end_datetime=$time;
               $operationOnoff->developtime=ceil(($time- $operationOnoff->start_datetime)/60);
               $operationOnoff->update();
           }

           exit(CJSON::encode(array("status"=>200,"message"=>"保存成功！")));
       }else{
           exit(CJSON::encode(array("status"=>400,"message"=>"保存失败！")));
       }
    }

    //关闭占用时间
    public function actionSpareTimeClose(){

        $pid=$_POST['id'];

        $model = new SpareTimeOnoff();
        $spareTimeOnoff = $model -> findByPk($pid);

        $spareTimeOnoff->status=0;
        $time=time();
        $spareTimeOnoff->end_datetime=$time;
        $spareTimeOnoff->developtime=ceil(($time- $spareTimeOnoff->start_datetime)/60);
        if($spareTimeOnoff->save()){
            exit(CJSON::encode(array("status"=>200,"message"=>"关闭成功！")));
        }else{
            exit(CJSON::encode(array("status"=>400,"message"=>"关闭失败！")));
        }
    }
    /**
     * 通过类名找到业务名称
     */
    public function actionFindCategory(){

        $category=$_POST['category'];

        $operationTitlecategorys=OperationTitlecategory::model()->findAll('category=:category and status=:status',array(':category'=>$category,':status'=>1));
        if($operationTitlecategorys){
            $names=array();
            foreach($operationTitlecategorys as $k=> $operationTitlecategory){

                $names[$k]['c_name']=$operationTitlecategory->name;
                $names[$k]['c_id']=$operationTitlecategory->id;
            }

            exit(CJSON::encode(array("status"=>200,"message"=>$names)));
        }
    }

    //请假弹出页面
    public function actionLeave()
    {
        $this->renderPartial("leave");
    }
    /**
     * 请假记录添加
     */
    public function actionAddLeave(){
        if(isset($_POST['dates_start']) && isset($_POST['dates_end']) && isset($_POST['minute']) && isset($_POST['hours'])){
            $dates_start = $_POST['dates_start'];
            $dates_end = $_POST['dates_end'];
            $minute = $_POST['minute'];
            $hours = $_POST['hours'];
            $content = $_POST['content'];
            $uid = Yii::app()->user->id;
            if(empty($minute)){
                $minute=0;
            }
            if(empty($hours)){
                $hours=0;
            }
            $spareTimeOnoff =new SpareTimeOnoff();
            $spareTimeOnoff->developtime = $hours*60+$minute;
            $spareTimeOnoff->content = $content;
            $spareTimeOnoff->start_datetime = strtotime( $dates_start) ;
            $spareTimeOnoff->end_datetime = strtotime( $dates_end) ;
            $spareTimeOnoff->post_uid = $uid;
            $spareTimeOnoff->postid = 0;
            $spareTimeOnoff->status = 0;//2-请假
            if($spareTimeOnoff->save()){
                exit(CJSON::encode(array("status"=>200,"message"=>"请假记录添加成功")));
                $this->redirect(array('underway','status'=>2));
            }
        }
    }
}