<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2015/8/13
 * Time: 10:41
 * Name: 周报
 */
class ActionCheckController extends OperationController
{

    /*
     * 个人行为考核
     * 权限：指定用户id可查看
     * */
    public function actionIndex()
    {
        $mid = Yii::app()->user->id;
        $manageData = Manage::model()->findByPk($mid);
        if(!in_array($manageData->department,array(16,17,18,20,27,33)))
        {
            throw new CHttpException(403,"你没有访问权限");
        }
        if (isset($_GET['uid'])) {
            $uid= $_GET['uid'];
        }else{
            throw new CHttpException(403,"发生错误");
        }
        if($mid==$uid)throw new CHttpException(403,"您不能给自己打分");
        $department=$manageData['department'];
        $manageDataList = Manage::model()->findAll("status=1 and `department`={$department}");
        foreach($manageDataList as $v){
            $uidList[]=$v['id'];
        }

        if(!in_array($uid,$uidList) && $manageData['is_head']==1) throw new CHttpException(403,"你没有打分权限");
        $model=ActionCheck::model()->findAll("status=1 and fid=0");
        $this->render('index',array("data"=>$model,"uid"=>$uid));
    }

    /*
     * 个人行为考核
     * 权限：指定用户id可查看
     * */
    public function actionScore(){
        $mid = Yii::app()->user->id;
        $n=ActionCheck::model()->count("status=1 and fid=0 ");
        if($n !=count($_POST)){
            throw new CHttpException(403,"您有未选择项，请重新选择");
        }
        $score=0;
        foreach($_POST as $v){
            $score +=$v;
        }
        if($score==$n*100) throw new CHttpException(403,"您不能打满分，请重新评分");

        $uid=$_GET['uid'];
        $actionScore= new ActionScore() ;
        $actionScore->uid=$uid;
        $actionScore->mid=$mid;
        $actionScore->score=$score/$n;
        $actionScore->type='action';
        $actionScore->createdatetime=date("Y-m-d H:i:s");
        $actionScore->createdate=date("Y-m");
        if($actionScore->save()){
            Yii::app()->user->setFlash('status','评分成功');
            $this->redirect(array('actionList','uid'=>$uid));
        }

    }

    //弹出用户评分页面
    public function actionLeadAddScore($id){
        $manageData = Manage::model()->findByPk($id);

        $this->renderPartial("lead_add_score",array('manageData'=>$manageData));
    }

    /*
    * 部门领导考核
    * 权限：指定用户id可查看
    * */
    public function actionAddScore(){
        $mid = Yii::app()->user->id;
        $manageData = Manage::model()->findByPk($mid);
        if(!in_array($manageData->department,array(16,17,18,20,27,33)))
        {
            throw new CHttpException(403,"你没有访问权限");
        }
        if(Yii::app()->request->isAjaxRequest && isset($_POST['uid']) && isset($_POST['score']) && isset($_POST['content']))
        {
            $uid=$_POST['uid'];
            $score=$_POST['score'];
            $content=$_POST['content'];
            $actionScore= new ActionScore() ;
            $actionScore->uid=$uid;
            $actionScore->mid=$mid;
            $actionScore->type='lead';
            $actionScore->score=$score;
            $actionScore->content=$content;
            $actionScore->createdatetime=date("Y-m-d H:i:s");
            $actionScore->createdate=date("Y-m");
            if($actionScore->save()){
                exit(CJSON::encode(array("status"=>200,"message"=>"保存成功！")));
            }
        }else{
            exit(CJSON::encode(array("status"=>400,"message"=>"请使用正确的姿势提交！")));
        }

    }
    //导入月kpi考核分数
    public function actionAddKpiScore(){
        if(Yii::app()->request->isAjaxRequest && isset($_POST['uid']) && isset($_POST['score'])  && isset($_POST['date']))
        {
            $uid=$_POST['uid'];
            $score=$_POST['score'];
            $date=$_POST['date'];

            $Data = ActionScore::model()->find("uid=:uid and createdate=:createdate and type=:type",
                array(":uid"=>$uid,":createdate"=>date("Y-m",$date),":type"=>'kpi'));
            if(isset($Data)){
                exit(CJSON::encode(array("status"=>400,"message"=>"您已经提交！")));
            }
            $actionScore= new ActionScore() ;
            $actionScore->uid=$uid;
            $actionScore->type='kpi';
            $actionScore->score=$score;
            $actionScore->createdatetime=date("Y-m-d H:i:s");
            $actionScore->createdate=date("Y-m",$date);
            if($actionScore->save()){
                exit(CJSON::encode(array("status"=>200,"message"=>"保存成功！")));
            }
        }else{
            exit(CJSON::encode(array("status"=>400,"message"=>"请使用正确的姿势提交！")));
        }

    }

    /*
     * 领导考核列表
     * */
    public function actionLeadList()
    {
        $mid = Yii::app()->user->id;
        $manage = Manage::model()->findByPk($mid);
        if(!in_array($manage->department,array(16,17,18,20,27,33)))
        {
            throw new CHttpException(403,"你没有访问权限");
        }
        if($manage['is_head']<1)
        {
            throw new CHttpException(403,"你没有访问权限");
        }else{
            $department=$manage['department'];
            if($manage['is_head']==1){
                $departmentData=Department::model()->findAll("status=1 and id={$department} and id !=19");

            }else{
                $departmentData = Department::model()->findAll("status=1 and f_id=17 and id!=19");

            }
        }


        $manageData = Manage::model()->findAll("status=1");
        $this->render('leadList',array("manageData"=>$manageData,"departmentData"=>$departmentData));
    }

    /*
     * 行为考核列表
     * */
    public function actionActionList()
    {
        $mid = Yii::app()->user->id;
        $manage = Manage::model()->findByPk($mid);
        if(!in_array($manage->department,array(16,17,18,20,27,33)))
        {
            throw new CHttpException(403,"你没有访问权限");
        }
        if($manage['is_head']<1)
        {
            throw new CHttpException(403,"你没有访问权限");
        }else{
            $department=$manage['department'];
            if($manage['is_head']==1 ){
                $departmentData=Department::model()->findAll("status=1 and id={$department} and id !=19");

            }else{
                $departmentData = Department::model()->findAll("status=1 and f_id=17 and id !=19");

            }
        }


        $manageData = Manage::model()->findAll("status=1");
        $this->render('actionList',array("manageData"=>$manageData,"departmentData"=>$departmentData));
    }

    /*
    * 月考核列表
    * 权限：指定用户id可查看
    * */
    public function actionMonthList()
    {
        $model = new ActionMonth('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['ActionMonth'])) {
            $model->attributes = $_GET['ActionMonth'];
        }
        $this->render('month_list',array("model"=>$model));
    }

    /*
    * 工作考核列表
    * 权限：指定用户可查看
    * */
    public function actionAll()
    {
        $mid = Yii::app()->user->id;
        $manageData = Manage::model()->findByPk($mid);
        if(!in_array($manageData->department,array(16,17,18,20,27,33,29)))
        {
            throw new CHttpException(403,"你没有访问权限");
        }
        if(!isset($manageData))
        {
            throw new CHttpException(403,"你没有访问权限");
        }else{
            $actionModel = new ActionScore();
            if($manageData['is_head']==1){
                $department=$manageData['department'];
                $manageDataList = Manage::model()->findAll("status=1 and `department`={$department} and id !=19");
            }elseif($manageData['is_head']==2){
                $manageDataList = Manage::model()->findAll("status=1 and `department` in (16,18,20,33)");
            }else{
                $manageDataList=Manage::model()->findAll("status=1 and `id`={$mid}");
            }
            $this->render("check_detail",array('actionModel'=>$actionModel,'summaryData'=>$manageDataList,'head'=>$manageData->is_head));
        }
    }



    /*
    * 添加月考核
    * */
    public function actionCreateMonth()
    {
        //需要判断人员权限
        $mid = Yii::app()->user->id;
        //$manageData = Manage::model()->findByPk($mid);
        if(!in_array($mid,array(3,50)))
        {
            throw new CHttpException(403,"你没有访问权限");
        }else{
            $actionMonthModel = new ActionMonth();
            $actionMonthModel -> title = date('Y年第m月工作考核（m月d日）',time())."";
            if(isset($_POST['ActionMonth']))
            {
                foreach($_POST['ActionMonth'] as $_k => $_v)
                {
                    $actionMonthModel -> $_k = $_v;
                }
                $time = time();
                $actionMonthModel -> createdatetime = date("Y-m-d H:i:s",$time);
                $actionMonthModel -> datemonth = date("Y-m",$time);
                $actionMonthModel -> mid = $mid;
                //获取技术role用户
                $manageDataList = Manage::model()->findAll("status=1 and `department` in (16,18,20,33)");
                $manageNum = count($manageDataList);
                $actionMonthModel ->num =$manageNum;
                if($actionMonthModel -> save())
                {
                    $weekid =  Yii::app()->db->getLastInsertID();
                    //添加用户周总结
                    $arrType=array('post','kpi','action','lead');
                    foreach($manageDataList as $_manage_row)
                    {

                        foreach($arrType as $type_row){
                            $checkScoreModel = new CheckScore();
                            $checkScoreModel -> m_id = $weekid;
                            $checkScoreModel -> uid = $_manage_row['id'];
                            $checkScoreModel -> type = $type_row;
                            $checkScoreModel -> createdatetime = date("Y-m-d H:i:s");
                            $checkScoreModel->save();
                        }

                    }
                    $this->redirect("monthList");
                }

            }
            $this->render("month_create",array("model"=>$actionMonthModel));
        }
    }

    /*
  * 导入月考核分数
  * */
    public function actionImportCheck(){
        $mid = Yii::app()->user->id;
        if(!in_array($mid,array(3,50))) throw new CHttpException(403,"你没有访问权限");
        if(isset($_GET['id'])){
            $m_id=$_GET['id'];
            $models=CheckScore::model()->findAll("m_id=:m_id",array(":m_id"=>$m_id));
            foreach($models as $model){
                $data=$this->getScore($model['uid'],$m_id,$model['type']);
                $model->score=$data[0];
                $model->updatetime=$data[1];
                $model->save();
            }
            ActionMonth::model()->updateByPk($m_id,array('status'=>1));

            $this->redirect(array('all','id'=>$m_id));
        }else{
            throw new CHttpException(403,"发生错误");
        }
    }
    //获取考核项分数
    private function getScore($uid,$id,$type){
        $month=ActionMonth::model()->findByPk($id);
        if($type=='post'){
            $sql = "select avg(score)as score,MAX(createdatetime) createdatetime  from {{action_score}} where `uid`={$uid} AND  createdate='{$month['datemonth']}' AND type='{$type}'";
            $data = Yii::app()->db->createCommand($sql)->queryAll();
            $dat=array($data[0]['score'],$data[0]['createdatetime']);
        }else{
            $summaryProjectData = ActionScore::model()->find("uid=:uid and createdate=:createdate and type=:type",
                array(":uid"=>$uid,":createdate"=>$month['datemonth'],":type"=>$type));
            $dat=array($summaryProjectData['score'],$summaryProjectData['createdatetime']);
        }
        return $dat;
    }

}