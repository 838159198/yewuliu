<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2015/8/13
 * Time: 10:41
 * Name: 周报
 */
class SummaryController extends OperationController
{
    /*
     * 周报列表
     * */
    public function actionIndex()
    {
        $model = new Summary('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Summary'])) {
            $model->attributes = $_GET['Summary'];
        }
        $this->render('index',array("model"=>$model));
    }
    /*
     * 创建
     * 指定用户拥有全新
     * */
    public function actionCreate()
    {
        $summaryModel = new Summary();
        if(isset($_POST['Summary']))
        {
            foreach($_POST['Summary'] as $_k => $_v)
            {
                $summaryModel -> $_k = $_v;
            }
            $time = time();
            $summaryModel -> createdatetime= date("Y-m-d H:i:s",$time);
            $summaryModel -> createtime = $time;
            if($summaryModel->save())
            {
                $this->redirect("index");
            }
        }
        $this->render("create",array("model"=>$summaryModel));
    }
    /*
     * 周总结列表
     * 权限：指定用户id可查看
     * */
    public function actionWeekList()
    {
        $mid = Yii::app()->user->id;
        if(!in_array($mid,array(1,3,50)))
        {
            throw new CHttpException(403,"你没有访问权限");
        }
        $model = new SummaryWeek('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['SummaryWeek'])) {
            $model->attributes = $_GET['SummaryWeek'];
        }
        $this->render('week_list',array("model"=>$model));
    }
    /*
     * 添加周总结
     * */
    public function actionCreateWeek()
    {
        //需要判断人员权限
        $mid = Yii::app()->user->id;
        //$manageData = Manage::model()->findByPk($mid);
        if(!in_array($mid,array(3,50)))
        {
            throw new CHttpException(403,"你没有访问权限");
        }else{
            $summaryWeekModel = new SummaryWeek();
            $summaryWeekModel -> title = date('Y年第W周工作总结（m月d日）',time())."";
            if(isset($_POST['SummaryWeek']))
            {
                foreach($_POST['SummaryWeek'] as $_k => $_v)
                {
                    $summaryWeekModel -> $_k = $_v;
                }
                $time = time();
                $summaryWeekModel -> createtime = $time;
                $summaryWeekModel -> createdatetime = date("Y-m-d H:i:s",$time);
                $statDatetime = $summaryWeekModel->statdatetime;
                $endDatetime = $summaryWeekModel->enddatetime;
                $summaryWeekModel -> endtime = strtotime($endDatetime);
                $summaryWeekModel -> stattime = strtotime($statDatetime);
                $summaryWeekModel -> mid = $mid;
                //获取技术role用户
                $manageDataList = Manage::model()->findAll("status=1 and `department` in (16,18,19,20,33)");
                $manageNum = count($manageDataList);
                $summaryWeekModel ->num =$manageNum;
                if($summaryWeekModel -> save())
                {
                    $weekid =  Yii::app()->db->getLastInsertID();
                    //添加用户周总结

                    foreach($manageDataList as $_manage_row)
                    {
                        $summaryModel = new Summary();
                        $summaryModel -> weekid = $weekid;
                        $summaryModel -> mid = $_manage_row['id'];
                        $summaryModel -> createtime = $time;
                        $summaryModel -> projectnum = 0;
                        $summaryModel -> status = 0;
                        $summaryModel -> createdatetime = date("Y-m-d H:i:s",$time);
                        $summaryModel -> statdatetime = $statDatetime;
                        $summaryModel -> enddatetime = $endDatetime;
                        $summaryModel -> endtime = strtotime($endDatetime);
                        $summaryModel -> stattime = strtotime($statDatetime);
                        $summaryModel->insert();
                    }
                    $this->redirect("weekList");
                }
            }
            $this->render("week_create",array("model"=>$summaryWeekModel));
        }
    }
    /*
     * 周总结详情
     * 权限：指定用户可查看
     * */
    public function actionWeekDetail($id)
    {
        $mid = Yii::app()->user->id;
        if(!in_array($mid,array($mid)))
        {
            throw new CHttpException(403,"你没有访问权限");
        }else{
            $weekModel = new SummaryWeek();
            $weekData = $weekModel->findByPk($id);
            $summaryData = Summary::model()->findAll("weekid={$id} ");
            $this->render("week_detail",array('weekData'=>$weekData,'summaryData'=>$summaryData));
        }
    }

     /* 我的周总结
     * */
    public function actionMy()
    {
        $mid = Yii::app()->user->id;
        $model = new Summary('search');
        $model->unsetAttributes();

        $model->mid=$mid;

        if (isset($_GET['Summary'])) {
            $model->attributes = $_GET['Summary'];
        }
        $this->render('my',array("model"=>$model));
    }
    /*
     * 详情周总结
     * */
    public function actionDetail($id)
    {
        $mid = Yii::app()->user->id;
        $summaryModel = new Summary();
        $summaryData = $summaryModel->findByPk($id);
        if(empty($summaryData))
        {
            throw new CHttpException(404,"不存在");
        }else{
            if($summaryData['mid']!=$mid)
            {
                throw new CHttpException(403,"无权限");
            }else{
                if($summaryData['importstatus']==0)
                {
                    $this->loadOneImport($id);
                }
                $summaryProjectModel = new SummaryProject();
                $summaryProjectData = $summaryProjectModel->findAll("sid={$id} and name !='周工作总结'");

                /*$criteria=new CDbCriteria;
                $criteria->distinct = "postid";
                $criteria->select='postid,developtime,SUM(`developtime`) AS `qq`';  // 只选择 'title' 列
                $criteria->condition='`create_uid`=:create_uid';
                $criteria->params=array(':create_uid'=>$mid);
                $criteria->group = 'postid';
                $post=OperationThread::model()->findAll($criteria); // $params 不需要了
                foreach($post as $_post_row)
                {
                    echo "postid:".$_post_row['postid']."  developtimesum:".$_post_row['developtime']."<br>";
                }
                print_r($post);*/
                //判断是否为 周工作总结大文本信息 并且是否为空
                $criteria=new CDbCriteria;
                $criteria->condition='`name`=:name and sid=:id';
                $criteria->params=array(':name'=>'周工作总结',':id'=>$id);
                $model=SummaryProject::model()->findAll($criteria);
                if($model){
                    foreach($model as $m)
                    {
                        $r=$m->remarks;
                    }
                }else{
                    $r='';
                }
                $this->render("detail",array("summaryData"=>$summaryData,'summaryProjectData'=>$summaryProjectData,'r'=>$r,'mid'=>$mid));
            }
        }
    }
    /*
     * 一键导入业务流到工作总结
     * */
    public function loadOneImport($id)
    {
        $summaryModel = Summary::model();
        $summaryData = $summaryModel->findByPk($id);
        if(empty($summaryData))
        {
            throw new CHttpException(404,"不存在");
        }else{
            $summaryWeekData = SummaryWeek::model()->findByPk($summaryData['weekid']);
            $mid = Yii::app()->user->id;
            $username = Yii::app()->user->name;
            $sql = "select distinct(postid),sum(developtime) as developtimesum  from `ele_operation_onoff` where `post_uid`={$mid} AND {$summaryWeekData['stattime']} < `end_datetime` AND {$summaryWeekData['endtime']} > `end_datetime` GROUP BY postid";
            $threadData = Yii::app()->db->createCommand($sql)->queryAll();
            $time = time();
            for($i=0;$i<count($threadData);$i++)
            {
                $summaryProjectModel = new SummaryProject();
                $summaryProjectModel->postid = $threadData[$i]['postid'];
                $summaryProjectModel->developmenttime = $threadData[$i]['developtimesum'];
                $summaryProjectModel->createtime=$time;
                $summaryProjectModel->createdatetime=date("Y-m-d H:i:s",$time);
                $operation = $this->loadPostStatus($threadData[$i]['postid']);
                $summaryProjectModel->status = $operation['status'];
                $summaryProjectModel->name = $operation['title'];
                $summaryProjectModel->username = $username;

                //测试跟开发的预估时间分开
                $opst=OperationPost::model()->findByPk($threadData[$i]['postid']);
                $manage=Manage::model()->findByPk($mid);
                if($manage->department==19) {
                    $summaryProjectModel->estimate = $opst["test_estimate"];
                }else{
                    $summaryProjectModel->estimate = $opst["estimate"];
                }

                $summaryProjectModel->sid = $id;
                $summaryProjectModel->insert();
            }
            $summaryData->importstatus=1;
            $summaryData->update();
        }
    }
    /*
     * 添加备注
     * */
    public function actionProjectRemarksModal($id)
    {
        $summaryProjectModel = SummaryProject::model();
        $summaryProjectData = $summaryProjectModel->findByPk($id);
        if(empty($summaryProjectData))
        {
            throw new CHttpException(404,"不存在");
        }else{
            $this->renderPartial("project_remarks_modal",array("data"=>$summaryProjectData));
        }
    }
    /*
     * 接收备注
     * */
    public function actionProjectRemarksSave()
    {
        if(Yii::app()->request->isAjaxRequest && isset($_POST['id']) && isset($_POST['remarks']))
        {
            $mid = Yii::app()->user->id;
            $id = $_POST['id'];
            $remarks = $_POST['remarks'];
            $summaryProjectModel = SummaryProject::model();
            $summaryProjectData = $summaryProjectModel->findByPk($id);
            //查看状态
            $summaryData = Summary::model()->findByPk($summaryProjectData['sid']);
            if($summaryData['status']==1)
            {
                exit(CJSON::encode(array("status"=>400,"message"=>"工作总结已上报，无法再次修改！")));
            }elseif($summaryData['mid']!=$mid){
                exit(CJSON::encode(array("status"=>400,"message"=>"没有权限！")));
            }else{
                $summaryProjectData->remarks = $remarks;
                if($summaryProjectData->update())
                {
                    exit(CJSON::encode(array("status"=>200,"message"=>"保存成功！")));
                }else{
                    exit(CJSON::encode(array("status"=>400,"message"=>"保存失败！")));
                }
            }
        }else{
            exit(CJSON::encode(array("status"=>400,"message"=>"请使用正确的姿势提交！")));
        }
    }
    /*
     * 项目添加modal
     * */
    public function actionProjectAddModal($id)
    {
        $mid = Yii::app()->user->id;
        $summaryModel = new Summary();
        $summaryData = $summaryModel->findByPk($id);
        if($summaryData['mid']!=$mid)
        {
            throw new CHttpException(404,"没有权限");
        }elseif($summaryData['status']!=0)
        {
            throw new CHttpException(404,"已提交，无法添加");
        }else{
            $this->renderPartial("project_add_modal",array('summary'=>$summaryData));
        }
    }
    //周总结添加
    public function actionProjectAddWeek($id)
    {
        $mid = Yii::app()->user->id;
        $summaryModel = new Summary();
        $summaryData = $summaryModel->findByPk($id);
        if($summaryData['mid']!=$mid)
        {
            throw new CHttpException(404,"没有权限");
        }elseif($summaryData['status']!=0)
        {
            throw new CHttpException(404,"已提交，无法添加");
        }else{
            $this->renderPartial("project_add_week",array('summary'=>$summaryData));
        }
    }
    /*
     * 项目添加
     * */
    public function actionProjectAdd()
    {
        if(Yii::app()->request->isAjaxRequest && isset($_POST['id']) && isset($_POST['name']) && isset($_POST['remarks']) && isset($_POST['minute']) && isset($_POST['hours']) && isset($_POST['status']))
        {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $remarks = $_POST['remarks'];

            $minute = $_POST['minute'];
            $hour = $_POST['hours'];
            $status = $_POST['status'];
            $mid = Yii::app()->user->id;
            $username = Yii::app()->user->name;
            $summaryData = Summary::model()->findByPk($id);
            $time = time();
            if(empty($summaryData)){
                exit(CJSON::encode(array("status"=>400,"message"=>"不存在！")));
            }elseif($summaryData['mid']!=$mid){
                exit(CJSON::encode(array("status"=>400,"message"=>"没有权限！")));
            }elseif($summaryData['status']!=0){
                exit(CJSON::encode(array("status"=>400,"message"=>"本周工作总结已结束，不能再次提交！")));
            }else{
                $summaryProjectModel = new SummaryProject();
                $summaryProjectModel -> sid = $id;
                $summaryProjectModel -> name = $name;
                $summaryProjectModel -> username = $username;
                $summaryProjectModel -> developmenttime = $hour*60 + $minute;
                $summaryProjectModel -> status = $status;
                $summaryProjectModel -> remarks = $remarks;
                $summaryProjectModel -> postid = 0;
                $summaryProjectModel -> createtime = $time;
                $summaryProjectModel -> createdatetime = date("Y-m-d H:i:s",$time);
                if($summaryProjectModel -> save())
                {
                    exit(CJSON::encode(array("status"=>200,"message"=>"保存成功！")));
                }else{
                    exit(CJSON::encode(array("status"=>400,"message"=>"保存失败！")));
                }
            }
        }else{
            exit(CJSON::encode(array("status"=>400,"message"=>"请使用正确的姿势提交！")));
        }
    }

    /*
    * 备注内容添加
    * */
    public function actionRemarksAdd()
    {
        if(Yii::app()->request->isAjaxRequest && isset($_POST['id']) && isset($_POST['name']) && isset($_POST['remarks']) && isset($_POST['minute']) && isset($_POST['hours']) && isset($_POST['status']))
        {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $remarks = $_POST['remarks'];

            $mid = Yii::app()->user->id;
            $username = Yii::app()->user->name;
            $summaryData = Summary::model()->findByPk($id);
            $time = time();
            if(empty($summaryData)){
                exit(CJSON::encode(array("status"=>400,"message"=>"不存在！")));
            }elseif($summaryData['mid']!=$mid){
                exit(CJSON::encode(array("status"=>400,"message"=>"没有权限！")));
            }elseif($summaryData['status']!=0){
                exit(CJSON::encode(array("status"=>400,"message"=>"本周工作总结已结束，不能再次提交！")));
            }else{
                $summaryProjectModel = new SummaryProject();
                $summaryProjectModel -> sid = $id;
                $summaryProjectModel -> name = $name;



                $summaryProjectModel -> remarks = $remarks;

                if($summaryProjectModel -> save())
                {
                    exit(CJSON::encode(array("status"=>200,"message"=>"保存成功！")));
                }else{
                    exit(CJSON::encode(array("status"=>400,"message"=>"保存失败！")));
                }
            }
        }else{
            exit(CJSON::encode(array("status"=>400,"message"=>"请使用正确的姿势提交！")));
        }
    }
    /*
     * 保存本周工作总结
     * */
    public function actionWeekSave()
    {
        $mid = Yii::app()->user->id;
        if(Yii::app()->request->isAjaxRequest && isset($_POST['id']))
        {
            $id = $_POST['id'];
            $summaryData = Summary::model()->findByPk($id);

            if(empty($summaryData))
            {
                exit(CJSON::encode(array("status"=>400,"message"=>"不存在！")));
            }else{
                if($summaryData['mid']!=$mid){
                    exit(CJSON::encode(array("status"=>400,"message"=>"没有权限！")));
                }elseif($summaryData['status']==1){
                    exit(CJSON::encode(array("status"=>400,"message"=>"已保存过，不要多次提交！")));
                }else{
                    $summaryProjectNum = SummaryProject::model()->count("sid={$id}");
                    $summaryData -> projectnum = $summaryProjectNum;
                    $summaryData -> status = 1;

                    if($summaryData->update())
                    {
                        exit(CJSON::encode(array("status"=>200,"message"=>"保存成功！")));
                    }else{
                        exit(CJSON::encode(array("status"=>400,"message"=>"保存失败！")));
                    }
                }
            }
        }else{
            exit(CJSON::encode(array("status"=>400,"message"=>"请使用正确的姿势提交！")));
        }
    }
    /*
     * 查看业务状态
     * */
    private function loadPostStatus($postid)
    {
        $operationPostModel = new OperationPost();
        $operationPostData = $operationPostModel -> findByPk($postid);
        return $operationPostData;
    }
    //总结添加
    public function actionSummaryAdd()
    {
        if(Yii::app()->request->isAjaxRequest && isset($_POST['id']) && isset($_POST['name']) && isset($_POST['remarks']) )
        {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $remarks = $_POST['remarks'];

            $mid = Yii::app()->user->id;
            $username = Yii::app()->user->name;
            $summaryData = Summary::model()->findByPk($id);



            $time = time();
            if(empty($summaryData)){
                exit(CJSON::encode(array("status"=>400,"message"=>"不存在！")));
            }elseif($summaryData['mid']!=$mid){
                exit(CJSON::encode(array("status"=>400,"message"=>"没有权限！")));
            }elseif($summaryData['status']!=0){
                exit(CJSON::encode(array("status"=>400,"message"=>"本周工作总结已结束，不能再次提交！")));
            }else{
                $summaryProjectModel = new SummaryProject();
                $summaryProjectModel -> sid = $id;
                $summaryProjectModel -> name = $name;
                $summaryProjectModel -> username = $username;
                $summaryProjectModel -> developmenttime =0;
                $summaryProjectModel -> status = 2;
                $summaryProjectModel -> remarks = $remarks;
                $summaryProjectModel -> postid = 0;
                $summaryProjectModel -> createtime = $time;
                $summaryProjectModel -> createdatetime = date("Y-m-d H:i:s",$time);
                if($summaryProjectModel -> save())
                {
                    exit(CJSON::encode(array("status"=>200,"message"=>"保存成功！")));
                }else{
                    exit(CJSON::encode(array("status"=>400,"message"=>"保存失败！")));
                }
            }
        }else{
            exit(CJSON::encode(array("status"=>400,"message"=>"请使用正确的姿势提交！")));
        }
    }
}