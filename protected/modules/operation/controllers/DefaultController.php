<?php

class DefaultController extends OperationController
{
    /*
     * @name 默认页
     * */
	public function actionIndex()
	{
        //$this->layout = "operation";
        $model = new OperationPost('search');
        $model->unsetAttributes(); // clear any default values
        $model->status=1;
        if (isset($_GET['OperationPost'])) {
            $model->attributes = $_GET['OperationPost'];
        }

		$this->render('index',array("model"=>$model));
	}
    /*
     * @name 业务池
     * */
    public function actionWait()
    {
        //$this->layout = "operation";
        $model = new OperationPost('search');
        $model->unsetAttributes(); // clear any default values
        $model->status=1;
        if (isset($_GET['OperationPost'])) {
            $model->attributes = $_GET['OperationPost'];
        }

        $this->render('wait',array("model"=>$model));
    }
    /*
     * @name 全部业务
     * */
    public function actionAll()
    {
        $model = new OperationPost('search');
        $model->unsetAttributes(); // clear any default values

        if (isset($_GET['OperationPost'])) {
            $model->attributes = $_GET['OperationPost'];
            echo '<pre/>';
            print_r($model);
        }
        $this->render('all_list',array("model"=>$model));
    }
    /*
     * 每日一言
     * */
    public function actionDayText()
    {
        $sql = "select *  from `ele_manage_text` order by id DESC limit 20";
        $textData = Yii::app()->db->createCommand($sql)->queryAll();

        if(isset($_POST['text']))
        {
            $text=$_POST['text'];
            $sql = 'INSERT INTO ele_manage_text (id,text) VALUES ("",\'' . $text . '\')';
            Yii::app()->db->createCommand($sql)->execute();
            $this->redirect("daytext");
        }

        $this->render('daytext',array("model"=>$textData));
    }
    /*
     * 客户端读取写入配置文件
     * */
    public function actionConfig($JobTitle,$JobText,$From,$To,$Time,$JobUrl)
    {
        $file=Yii::getPathOfAlias('webroot')."/uploads/config.ini";
        if(file_exists($file)===false)
        {
            fopen($file,"w");
        }
        //读取ini为array
        $count=parse_ini_file($file,true);
        //取最后一个key
        $last = end($count);
        $last_key = key($count);
        if(!empty($last_key))
        {
            $last_key=$last_key+1;
        }
        else
        {
            $last_key=1;
        }

        $text="[".$last_key."]\r
JobTitle=".$JobTitle."\r
JobText=".$JobText."\r
From=".$From."\r
To=".$To."\r
Time=".$Time."\r
JobUrl='".$JobUrl."'\r
";
        //客户端读取写入配置文件
        file_put_contents($file, $text, FILE_APPEND);
    }
    /*
     * @name 创建
     * */
    public function actionCreate()
    {
        $model = new OperationPost();
        if(isset($_POST['OperationPost']))
        {
            print_r($_POST['OperationPost']);exit;
            $uid = Yii::app()->user->id;
            //var_dump($_POST['OperationPost']);exit;
            foreach($_POST['OperationPost'] as $_k => $_v)
            {
                if($_k=="about_uid")
                {

                    $model->$_k= implode(',',array_filter($_v));
                }
                else
                {
                    $model->$_k=$_v;
                }
            }
            if(!empty($model->file))
            {
                $model->file = implode(",",$model->file);
            }
            $time = time();
            $model->create_mid = $uid;
            $model->create_datetime = date("Y-m-d H:i:s",$time);
            $model->createdatetime = $time;
            $model->modifytime=$time;
            //接收者为空
            if(empty($_POST['OperationPost']['receive_mid'])){
                $model->status=1;
            }else{//接收者不为空 修改拥有者和接收时间 和状态
                $model->owner_mid=$_POST['OperationPost']['receive_mid'];
                $model->status=2;
                $model->receive_datetime=date("Y-m-d H:i:s",$time);
                $model->receivedatetime=$time;
                $model->modifytime=$time;
            }
            if($model->save())
            {
                //发送客户端接口信息
                if(!empty($model->receive_mid)){
                    $JobTitle=strip_tags($_POST['OperationPost']['title']);
                    //$JobText=strip_tags($_POST['OperationPost']['content']);
                    $sql = "select `text`  from `ele_manage_text` order by id DESC limit 1";
                    $textData = Yii::app()->db->createCommand($sql)->queryAll();
                    $JobText=$textData[0]["text"];
                    $JobTitle=Common::clearTags($JobTitle);
                    $man=Manage::model()->findByPk($uid);
                    $From=$man["name"];
                    $to_name=Manage::model()->findByPk($model->receive_mid);
                    $To=$to_name["name"];
                    $Time=date("Y-m-d H:i:s");
                    $JobUrl="http://spoa.58xuntui.com/operation/default/detail?id=".$model->id;
                    $this->actionConfig($JobTitle,$JobText,$From,$To,$Time,$JobUrl);
                }


                Manage::model()->updateCredits($uid,Common::CREDITS_CREATE);
                //用时
                Manage::model()->updateNum($uid,"create_num",1);
                Yii::app()->user->setFlash("create_status","ok");

                $this->redirect("wait");
            }
        }

        $this->render("create",array("model"=>$model));
    }
    /*
     * 加入业务池弹出显示
     * */
    public function actionAddtips($id)
    {
        $model = new OperationPost();
        $data=$model->findByPk($id);

        $this->renderPartial("add_tips",array("data"=>$data));
    }
    //预计时间弹出页面
    public function actionUpdate($id)
    {
        $model = new OperationPost();
        $data=$model->findByPk($id);
        $this->renderPartial("update",array("data"=>$data));
    }
    //预计时间
    public function actionEdit(){
        if(isset($_POST['id']) && isset($_POST['minute']) && isset($_POST['hours'])){
            $uid = Yii::app()->user->id;
            $id = $_POST['id'];
            $minute = $_POST['minute'];
            $hours = $_POST['hours'];
            $operationModel = OperationPost::model();
            $operationData = $operationModel->findByPk($id);
            if(empty($minute)){
                $minute=0;
            }
            if(empty($hours)){
                $hours=0;
            }
            $operationData->estimate = $hours*60+$minute;
            if(!empty($minute) or !empty($hours) ){
                $operationData->owner_uid=$uid;
            }
            if($operationData->save()){
                exit(CJSON::encode(array("status"=>200,"message"=>"预计时间修改完成")));
                $this->redirect(array('detail','id'=>$id));
            }
        }
    }
    /*
     * 添加测试时间弹出显示
     * */
    public function actionTest($id)
    {
        $model = new OperationPost();
        $data=$model->findByPk($id);
        $this->renderPartial("test",array("data"=>$data));
    }
    //添加预计时间和测试者id
    public function actionAddTest(){
        if(isset($_POST['id']) && isset($_POST['minute']) && isset($_POST['hours'])){
            $id = $_POST['id'];
            $minute = $_POST['minute'];
            $hours = $_POST['hours'];
            $operationModel = OperationPost::model();
            $operationData = $operationModel->findByPk($id);
            if(empty($minute)){
                $minute=0;
            }
            if(empty($hours)){
                $hours=0;
            }
            $operationData->test_estimate = $hours*60+$minute;
            $operationData->test_id =Yii::app()->user->id;
            if($operationData->save()){
                exit(CJSON::encode(array("status"=>200,"message"=>"测试预估时间添加成功")));
                $this->redirect(array('detail','id'=>$id));
            }
        }
    }
    /*
    * 添加测试评分弹出显示
    * */
    public function actionScore($id)
    {
        $model = new OperationPost();
        $data=$model->findByPk($id);
        $this->renderPartial("score",array("data"=>$data));
    }
    //添加测试评分
    public function actionAddScore(){
        if(isset($_POST['id']) && isset($_POST['score']) && isset($_POST['content'])){
            $mid=Yii::app()->user->id;
            $type='post';
            $id = $_POST['id'];
            $score = $_POST['score'];
            $test_content = $_POST['content'];
            $operationModel = OperationPost::model();
            $operationData = $operationModel->findByPk($id);
            if(empty($score)){
                $score=0;
            }
            $operationData->score = $score;
            $operationData->test_content = $test_content;
            if($operationData->save()){
                ActionScore::addActionScore($operationData->owner_uid,$mid,$score,$type,$operationData->id);
                exit(CJSON::encode(array("status"=>200,"message"=>"测试评分成功")));
                $this->redirect(array('detail','id'=>$id));
            }
        }
    }


    /*
     * 加入业务池
     * */
    public function actionAdd()
    {
        if(isset($_POST['id']) && isset($_POST['minute']) && isset($_POST['hours']))
        {
            $id = $_POST['id'];
            $minute = $_POST['minute'];
            $hours = $_POST['hours'];
            $operationModel = OperationPost::model();
            $operationData = $operationModel->findByPk($id);
            if(empty($operationData))
            {
                exit(CJSON::encode(array("status"=>404,"message"=>"该业务流不存在")));
            }elseif($operationData['status']!=1){
                exit(CJSON::encode(array("status"=>404,"message"=>"哦，你好像慢了一步，已经被抢走了")));
            }elseif($operationData['status']==1){
                $uid=Yii::app()->user->id;
                $time = time();
                if(empty($minute)){
                    $minute=0;
                }
                if(empty($hours)){
                    $hours=0;
                }
                $operationData->estimate = $hours*60+$minute;
                $operationData->status=2;
                $operationData->receive_mid=$uid;
                if(!empty($minute) or !empty($hours) ){
                    $operationData->owner_uid=$uid;
                }

                $operationData->receive_datetime=date("Y-m-d H:i:s",$time);
                $operationData->receivedatetime=$time;
                $operationData->owner_mid=$uid;
                $operationData->modifytime=$time;
                $operationData->cur_status=1;

                //关闭用户已开启所有业务流
                $onoffModel = new OperationOnoff();
                $onoffDataAll = OperationOnoff::model()->find('post_uid='.$uid.' and status=1 and end_datetime=0');
                if(!empty($onoffDataAll))
                {
                    $developtime=ceil(($time-$onoffDataAll["start_datetime"])/60);
                    $onoffDataAll->status=0;
                    $onoffDataAll->developtime=$developtime;
                    $onoffDataAll->end_datetime=$time;
                    $onoffDataAll->update();

                    //修改operation_Post的cur_status状态
                    $operationPostDataAll = OperationPost::model()->findByPk($onoffDataAll["postid"]);
                    $operationPostDataAll->cur_status=0;
                    $operationPostDataAll->update();
                }
                //新建开关信息
                $onoffModel->postid=$id;
                $onoffModel->post_uid=$uid;
                $onoffModel->start_datetime=$time;
                $onoffModel->end_datetime=0;
                $onoffModel->status=1;

                if($operationData->update() && $onoffModel->save()){
                    Manage::model()->updateCredits($uid,Common::CREDITS_ADD);
                    Manage::model()->updateNum($uid,"underway_num",1);
                    exit(CJSON::encode(array("status"=>200,"message"=>"已成功加入到我的业务池")));
                }
            }
        }else{
            exit(CJSON::encode(array("status"=>404,"message"=>"发生错误")));
        }

    }
    /*
     * @name 详情
     * */
    public function actionDetail($id)
    {
        $uid = Yii::app()->user->id;
        $model = OperationPost::model();
        $data = $model->findByPk($id);

        //权限设置--已被领取
        $manallid="";
        if($data["receive_mid"]!=0 && $data["receive_mid"]!="")
        {
            $mangsel=Manage::model()->find('id=:id',array(':id'=>$data["create_mid"]));
            $rolesel=Role::model()->find('id=:id',array(':id'=>$mangsel["role"]));

            if(empty($data["about_uid"])){$data["about_uid"]="1";}

            //role<2可以查看，部门主管可以查看，相关者可以查看，创建者，接收者
            $mangll=Manage::model()->findAll('status=:status and (role=:role or id=:id or id= '.$data["receive_mid"].' or role<3 or id in ('.$data["about_uid"].'))',array(':status'=>1,':role'=>$rolesel["fid"],':id'=>$data["create_mid"]));
            foreach($mangll as $ki=>$vi)
            {
                $manallid=$vi['id'].",".$manallid;
            }

            //当前拥有者可以查看
            $modelth = OperationThread::model()->findAll('postid=:postid',array(':postid'=>$id));
            if(!empty($modelth))
            {
                foreach($modelth as $kim=>$vim)
                {
                    $manallid=$manallid.$vim['post_uid'].",";
                }
            }
            //二级部门主管查看
//            $manageModel=Manage::model()->findByPk($uid);
            $mang=Manage::model()->find("department=:department and  is_head=1",array(":department"=>$mangsel['department']));
            if($mang)  $manallid=$manallid.$mang['id'].',';

            if($uid==3){
                $manallid=$manallid.'3,';
            }

            $manallid=explode(",",substr($manallid,0,strlen($manallid)-1));
            if(array_search($uid,$manallid)===false)
            {
                echo '<meta http-equiv="Content-Type" content="text/html"; charset="utf-8">;<script type="text/javascript" charset=UTF-8>alert("无此权限！");window.opener=null;window.open("","_self");window.close(); </script>';
                exit;
            }
        }



        $about_uids="";
        if(empty($data))
        {
            throw new CHttpException(404,"您访问的页面不存在");
        }else{
            $postData="";
            $threadRole=false;
            $testRole=false;
            $scoreRole=false;
            $departmentRole=false;
            $testDepartmentRole=false;
            $threadModel = new OperationThread();
            //回复帖子
            $threadData = $threadModel->findAll(array("condition"=>"`postid`={$id}","order"=>"id ASC"));
            if($data['status']==2 || $data['status']==4){

                /*
                * 回复*/
                if(isset($_POST['OperationThread']))
                {
                    $transaction = Yii::app()->db->beginTransaction();
                    try {
                        foreach($_POST['OperationThread'] as $_thread_k => $_thread_v)
                        {
                            if($_thread_k=="about_uid")
                            {
                                $threadModel->$_thread_k= implode(',',array_filter($_thread_v));
                                $about_uids=$threadModel->$_thread_k;
                            }
                            else
                            {
                                $threadModel->$_thread_k=$_thread_v;
                            }

                        }
                        if(!empty($threadModel->file))
                        {
                            $threadModel->file = implode(",",$threadModel->file);
                        }
                        //判断是否有回复权限
                        if($data['owner_mid']!=$uid){
                            throw new CHttpException(403,"你没有回复权限");
                        }
                        $time=time();

                        $threadModel->postid = $id;
                        $threadModel->create_uid=$uid;
                        //积分
                        $threadModel->credits=$this->loadCredits($id,$uid);
                        $threadModel->developtime = $threadModel->hours*60+$threadModel->minute;
                        $threadModel->start_datetime=$data['modifytime'];//获取上一条时间
                        $threadModel->datetime=$time;
                        $threadModel->end_datetime=$time;
                        if($threadModel->save())
                        {
                            //发送客户端接口信息
                            $JobTitle=strip_tags($data["title"]);
                            //$JobText=strip_tags($threadModel->content);
                            $sql = "select `text`  from `ele_manage_text` order by id DESC limit 1";
                            $textData = Yii::app()->db->createCommand($sql)->queryAll();
                            $JobText=$textData[0]["text"];
                            $man=Manage::model()->findByPk($uid);
                            $From=$man["name"];
                            $toname=Manage::model()->findByPk($threadModel->post_uid);
                            $To=$toname["name"];
                            $Time=date("Y-m-d H:i:s");
                            $JobUrl="http://spoa.58xuntui.com/operation/default/detail?id=".$data["id"];
                            $this->actionConfig($JobTitle,$JobText,$From,$To,$Time,$JobUrl);


                            //修改积分
                            Manage::model()->updateCredits($uid,$threadModel->credits);
                            //用时
                            Manage::model()->updateNum($uid,"developmenttimes",$threadModel->developtime);
                            //接收人ID，当前拥有者
                            $data->owner_mid=$threadModel->post_uid;
                            $data->modifytime=$time;

                            //如当前用户已开启则关闭业务流
                            $onoffDataAll = OperationOnoff::model()->find('post_uid='.$uid.' and postid='.$id.' and status=1 and end_datetime=0');
                            if(!empty($onoffDataAll))
                            {
                                $developtime=ceil(($time-$onoffDataAll["start_datetime"])/60);
                                $onoffDataAll->status=0;
                                $onoffDataAll->developtime=$developtime;
                                $onoffDataAll->end_datetime=$time;
                                $onoffDataAll->update();

                                //修改operation_Post的cur_status状态
                                $data->cur_status=0;
                            }
                            //常规审核在回复后更新
                            $data->priority=$_POST['OperationThread']['priority'];

                            if($data->update())
                            {
                                Yii::app()->user->setFlash("reply_status","ok");
                                //$this->refresh();
                                //$this->redirect("index");
                            }

                        }
                        //修改OperationPost下obaout_uis
                        $oppost=OperationPost::model()->findByPk($id);
                        $oppost->about_uid=$about_uids;
                        $oppost->update();
                        $transaction->commit();
                        $this->refresh();
                    } catch (Exception $e) {
                        $transaction->rollback();
                        throw new CHttpException(500,"发生错误请重新提交");
                    }
                }
                //判断是否有回复权限
                if($data['owner_mid']==$uid){
                    $threadRole="ok";
                }else{
                    $threadRole="norole";
                }
                //判断是否有结束业务流权限
                if($data['create_mid']==$uid){
                    $departmentRole = true;
                }
                //判断是否有添加测试预估时间权限
                $manageData = Manage::model()->findByPk($uid);

                $oppost=OperationPost::model()->findByPk($id);
                if($manageData->department ==19 && $oppost['test_estimate']<=0){
                    $testRole=true;
                }
                if($manageData->department ==19 && $oppost['score']==0){
                    $scoreRole=true;
                }


            }
            //判断是否有添加测试预估时间权限
            $manageData = Manage::model()->findByPk($uid);
            if($manageData->department ==19 ){
                $testDepartmentRole=true;
            }
            //获取停留时间（谁登录的显示谁的）
           $sql="SELECT sum(developtime) aa  FROM ele_operation_onoff where postid='$id'";
            $model = Yii::app()->db->createCommand($sql)->queryAll();
            $stay_time= $model[0]['aa'];
            if($stay_time>=60){
                $stay_hour=floor($stay_time/60);
                $stay_min=$stay_time%60;
                $res=$stay_hour.'小时';
                $stay_min!=0 && $res.=$stay_min.'分钟';
            }else{
                $res=$stay_time.'分钟';
            }
            //判断完成业务流的BUG
            $n=0;$m=0;

                $bugArray=explode(",",$data->bug);

                for($i=0;$i<count($bugArray);$i++){
                    if($bugArray[$i]==1){
                        $n=$n+1;
                    }
                }
                $m=count($bugArray)-$n-1;
                //var_dump($manallid);exit;
            $this->render("detail",array("data"=>$data,"threadModel"=>$threadModel,"threadData"=>$threadData,'threadRole'=>$threadRole,'departmentRole'=>$departmentRole,'res'=>$res,'n'=>$n,'m'=>$m,'testRole'=>$testRole,'sRole'=>$scoreRole,'testDepartmentRole'=>$testDepartmentRole,'manallid'=>$manallid));
            // 1、等待 2、进行中 3、完成4、暂停
        }

    }
    /*
     * 结束业务
     * */
    public function actionClose()
    {
        if(Yii::app()->request->isAjaxRequest && (isset($_POST['id'])))
        {
            $postid = $_POST['id'];
            $uid = Yii::app()->user->id;
            $manageData = Manage::model()->findByPk($uid);

            $operationModel = OperationPost::model();
            $operationData = $operationModel->findByPk($postid);
            if($operationData['create_mid']==$uid){

                if(empty($operationData)){
                    exit(CJSON::encode(array("status"=>403,"message"=>"你要结束的业务不存在")));
                }else{
                    if($operationData['status']!=2){
                        exit(CJSON::encode(array("status"=>403,"message"=>"该业务不是正在进行中，无法结束")));
                    }else{
                        //查看是否有测试用例未全部通过
                        $testData = OperationTest::model()->find("`postid`={$postid}");
                        if(!empty($testData))
                        {
                            if($testData['status']!=1){
                                exit(CJSON::encode(array("status"=>403,"message"=>"测试用例还未全部通过")));
                            }
                        }
                        //查询最后一个回复的是否为测试部门
                        $operationThread =OperationThread::model()->find(array(
                            'select'=>array('create_uid'),
                            'order' => 'id DESC',
                            'limit'=> 1,
                            'condition' => 'postid=:postid',
                            'params' => array(':postid' => $postid),
                        ));
                        $id=$operationThread->create_uid;
                        $manageData = Manage::model()->findByPk($id);

                        if($manageData->department !=19){
                            exit(CJSON::encode(array("status"=>403,"message"=>"该业务还未经过测试部，无法结束")));
                        }


                        $time = time();
                        //业务结束前 保存回复内容
                        $threadModel = new OperationThread();
                        $threadModel->content=$_POST['content'];
                        $threadModel->postid = $postid;
                        $threadModel->create_uid=$uid;
                        $threadModel->datetime=$time;
                        $threadModel->end_datetime=$time;
                        $threadModel->post_uid=$uid;
                        $threadModel->start_datetime=$operationData['modifytime'];//获取上一条时间
                        if($threadModel->save()){
                            $operationData->owner_mid=$uid;
                            $operationData->modifytime=$time;
                            $operationData->save();

                        };

                        $operationData->status=3;
                        $operationData->close_mid=$uid;
                        $operationData->enddatetime=$time;
                        $operationData->end_datetime=date("Y-m-d H:i:s",$time);
                        if($operationData->update()){

                            $manageData = Manage::model()->findByPk($operationData['receive_mid']);
                            Manage::model()->updateNum($operationData['receive_mid'],"complete_num",1);
                            //出现0
                            if($manageData['underway_num']>=1){
                                Manage::model()->updateNum($operationData['receive_mid'],"underway_num",-1);
                            }
                            exit(CJSON::encode(array("status"=>200,"message"=>"业务结束成功")));
                        }else{
                            exit(CJSON::encode(array("status"=>403,"message"=>"结束业务失败")));
                        }
                    }
                }
            }else{
                exit(CJSON::encode(array("status"=>403,"message"=>"你没有权限结束业务")));
            }
        }else{
            exit(CJSON::encode(array("status"=>403,"message"=>"发生错误")));
        }
    }
    /*
     * 暂停业务
     * */
    public function actionStop()
    {
        if(Yii::app()->request->isAjaxRequest && (isset($_POST['id'])))
        {
            $postid = $_POST['id'];
            $uid = Yii::app()->user->id;
            $operationModel = OperationPost::model();
            $operationData = $operationModel->findByPk($postid);
            if(empty($operationData)){
                exit(CJSON::encode(array("status"=>403,"message"=>"你要结束的业务不存在")));
            }else{
                if($operationData['status']!=2){
                    exit(CJSON::encode(array("status"=>403,"message"=>"该业务不是正在进行中，无法暂停")));
                }else{
                    $operationData->status=4;
                    if($operationData->update()){
                        exit(CJSON::encode(array("status"=>200,"message"=>"业务暂停成功")));
                    }else{
                        exit(CJSON::encode(array("status"=>403,"message"=>"结束暂停失败")));
                    }
                }
            }
        }else{
            exit(CJSON::encode(array("status"=>403,"message"=>"发生错误")));
        }
    }
    /*
     * 暂停业务
     * */
    public function actionRestart()
    {
        if(Yii::app()->request->isAjaxRequest && (isset($_POST['id'])))
        {
            $postid = $_POST['id'];
            $uid = Yii::app()->user->id;
            $operationModel = OperationPost::model();
            $operationData = $operationModel->findByPk($postid);
            if(empty($operationData)){
                exit(CJSON::encode(array("status"=>403,"message"=>"你要结束的业务不存在")));
            }else{
                if($operationData['status']!=4){
                    exit(CJSON::encode(array("status"=>403,"message"=>"该业务不是暂停中，无法重启")));
                }else{
                    $operationData->status=2;
                    if($operationData->update()){
                        exit(CJSON::encode(array("status"=>200,"message"=>"业务重启成功")));
                    }else{
                        exit(CJSON::encode(array("status"=>403,"message"=>"重启失败")));
                    }
                }
            }
        }else{
            exit(CJSON::encode(array("status"=>403,"message"=>"发生错误")));
        }
    }
    /*
     * 关闭状态--业务流开关
     * */
    public function actionAjaxCurstatus()
    {
        if(Yii::app()->request->isAjaxRequest && isset($_POST['id']) && isset($_POST['status']))
        {
            $postid=$_POST['id'];
            $status=$_POST['status'];
            if($status==0){$chg_status=1;} elseif($status==1){$chg_status=0;}

            $operationPostData = OperationPost::model()->findByPk($postid);
            if(empty($operationPostData))
            {
                exit(CJSON::encode(array("status"=>400,"message"=>"业务不存在")));
            }else{
                $transaction = Yii::app()->db->beginTransaction();
                try {
                    $time = time();
                    $mid = Yii::app()->user->id;
                    $manageData = Manage::model()->findByPk($mid);
                    $onoffModel = new OperationOnoff();

                    $onoffData = OperationOnoff::model()->find('postid='.$postid.' and post_uid='.$mid.' and status=1 and end_datetime=0 order by id desc');
                    //已开启状态操作
                    if(!empty($onoffData))
                    {
                        $developtime=ceil(($time-$onoffData["start_datetime"])/60);
                        $onoffData->status=0;
                        $onoffData->developtime=$developtime;
                        $onoffData->end_datetime=$time;
                    }
                    //未开启状态新建
                    else
                    {
                        $estimate=$operationPostData->estimate;
                        if(empty($estimate))
                            exit(CJSON::encode(array("status"=>400,"message"=>"开关失败，请先填写预估时间")));

                        if($mid != $operationPostData->owner_uid &&  $manageData->department !=19)
                            exit(CJSON::encode(array("status"=>400,"message"=>"开关失败，您无权限开启")));
                        //关闭用户已开启所有业务流
                        if($status==0)
                        {
                            $onoffDataAll = OperationOnoff::model()->find('post_uid='.$mid.' and status=1 and end_datetime=0');
                            if(!empty($onoffDataAll))
                            {
                                $developtime=ceil(($time-$onoffDataAll["start_datetime"])/60);
                                $onoffDataAll->status=$status;
                                $onoffDataAll->developtime=$developtime;
                                $onoffDataAll->end_datetime=$time;
                                $onoffDataAll->update();

                                //修改operation_Post的cur_status状态
                                $operationPostDataAll = OperationPost::model()->findByPk($onoffDataAll["postid"]);
                                $operationPostDataAll->cur_status=$status;
                                $operationPostDataAll->update();
                            }


                        }

                        //新建开关信息
                        $onoffModel->postid=$postid;
                        $onoffModel->post_uid=$mid;
                        $onoffModel->start_datetime=$time;
                        $onoffModel->end_datetime=0;
                        $onoffModel->status=1;
                    }

                    if($onoffModel->save() || $onoffData->update())
                    {
                        //修改operation_Post的cur_status状态
                        $operationPostData->cur_status=$chg_status;
                        $operationPostData->update();
                        $transaction->commit();
                        exit(CJSON::encode(array("status"=>200,"message"=>"开关成功")));
                    }else{
                        exit(CJSON::encode(array("status"=>400,"message"=>"开关失败，请重新提交")));
                    }

                } catch (Exception $e) {
                    $transaction->rollback();
                    exit(CJSON::encode(array("status"=>400,"message"=>"开关失败rollback，请重新提交")));
                }
            }
        }else{
            exit(CJSON::encode(array("status"=>400,"message"=>"请用正确的姿势提交")));
        }
    }
    /*
     * 打回业务池提示
     * */
    public function actionRollbackTips($id)
    {
        $model = new OperationPost();
        $data=$model->findByPk($id);
        $this->renderPartial("rollback_tips",array("data"=>$data));
    }
    /*
     * 打回业务池
     * */
    public function actionRollback()
    {
        if(Yii::app()->request->isAjaxRequest && (isset($_POST['id']) && (isset($_POST['rollback_content']))))
        {
            $uid = Yii::app()->user->id;
            $postid = $_POST['id'];
            $content = $_POST['rollback_content'];
            $postData = OperationPost::model()->findByPk($postid);
            if(empty($postData)){
                exit(CJSON::encode(array("status"=>404,"message"=>"该业务不存在")));
            }elseif($postData['status']!=2){
                exit(CJSON::encode(array("status"=>404,"message"=>"该业务禁止退回到业务池")));
            }elseif($postData['receive_mid']!=$uid){
                exit(CJSON::encode(array("status"=>404,"message"=>"你没有权限退回")));
            }


            $transaction = Yii::app()->db->beginTransaction();
            try {

                $rollbackModel = new OperationRollback();
                $rollbackModel->mid = $uid;
                $rollbackModel->postid = $postid;
                $rollbackModel->content = $content;
                $rollbackModel->create_datetime=time();
                if($rollbackModel->save()){
                    //修改业务流状态

                    $postData->receive_mid = 0;
                    $postData -> owner_mid = 0;
                    $postData->receive_datetime = "0000-00-00 00:00:00";
                    $postData->status=1;
                    $postData->receivedatetime=0;
                    $postData->rollback_num=$postData->rollback_num+1;
                    $postData->update();
                    //添加到详情里一条回复消息
                    $threadModel = new OperationThread();
                    $time=time();

                    $threadModel->postid = $postid;
                    $threadModel->create_uid=$uid;
                    $threadModel->credits=Common::CREDITS_ROLLBACK;
                    $threadModel->developtime = 0;
                    $threadModel->start_datetime=$time;//获取上一条时间
                    $threadModel->datetime=$time;
                    $threadModel->end_datetime=$time;
                    $threadModel->content = $content;
                    $threadModel->post_uid=0;
                    $threadModel->insert();
                    //添加到manage
                    Manage::model()->updateNum($uid,"rollback_num",1);
                    //积分
                    Manage::model()->updateCredits($uid,Common::CREDITS_ROLLBACK);
                    $transaction->commit();
                    exit(CJSON::encode(array("status"=>200,"message"=>"业务已退回到公共业务池")));
                }
            } catch (Exception $e) {
                $transaction->rollback();
                exit(CJSON::encode(array("status"=>404,"message"=>"退回失败，请重新提交")));
                //throw new CHttpException(500,"发生错误请重新提交");
            }
        }else{
            exit(CJSON::encode(array("status"=>404,"message"=>"发生错误")));
        }
    }
    /*
     * 文件下载
     * */
    public function actionDownload($id)
    {
        $fileModel = OperationFile::model();
        $fileData = $fileModel -> findByPk($id);
        if(empty($fileData))
        {
            throw new CHttpException(404,"文件不存在");
        }else{
            $file = substr_replace($fileData['filepath'],"",0,1);
            //exit($file);
            if(file_exists($file))
            {
                $fileModel->updateCounters(array("hits"=>1),"id=".$id);
                $content = file_get_contents($file);
                Yii::app()->request->sendFile($fileData['name'],$content);
            }else{
                throw new CHttpException(404,"服务器上找不到该文件");
            }

        }
    }
    /*
     * 获取积分
     * */
    private function loadCredits($id,$uid)
    {
        $threadModel = new OperationThread();
        $threadData = $threadModel->find("`postid`=:postid and `create_uid`=:uid",array(":postid"=>$id,":uid"=>$uid));
        $manageData=Manage::model()->findByPk($uid);
        if(empty($threadData))
        {
            $credits = Common::CREDITS_REPLY_FIRST;
        }else{

            //判断是否为测试部门
            if($manageData['department']==19)
            {
                $credits = Common::CREDITS_REPLY_DEPARTMENT_TRUE;
            }else{
                $credits = Common::CREDITS_REPLY_DEPARTMENT_FALSE;
            }
        }

        return $credits;
    }

    /*
    * 提交bug等级
    * */
    public function actionChangeBug()
    {
        if(Yii::app()->request->isAjaxRequest && (isset($_POST['id'])  && (isset($_POST['bug']))))
        {
            $id = $_POST['id'];
            $bug = $_POST['bug'];

            $operationModel = OperationPost::model();
            $operationData = $operationModel->findByPk($id);
            if(empty($operationData)){
                exit(CJSON::encode(array("status"=>403,"message"=>"该业务流不存在")));
            }else{
                if($bug==''){
                    exit(CJSON::encode(array("status"=>403,"message"=>"请选择bug等级")));
                }else{
                    $bug2=$operationData->bug;
                    if($bug2==null && $bug2==''){
                        $operationData->bug=$bug;
                    }
                    $operationData->bug=$bug.','.$bug2;

                    if($operationData->update()){
                        exit(CJSON::encode(array("status"=>200,"message"=>"bug等级提交成功")));
                    }else{
                        exit(CJSON::encode(array("status"=>403,"message"=>"bug等级提交失败")));
                    }
                }


            }
        }else{
            exit(CJSON::encode(array("status"=>403,"message"=>"发生错误")));
        }
    }

    /*
   * 清空bug等级
   * */
    public function actionClearBug()
    {
        if(Yii::app()->request->isAjaxRequest && (isset($_POST['id'])))
        {
            $id = $_POST['id'];


            $operationModel = OperationPost::model();
            $operationData = $operationModel->findByPk($id);
            if(empty($operationData)){
                exit(CJSON::encode(array("status"=>403,"message"=>"该业务流不存在")));
            }else{

                $operationData->bug=0;

                if($operationData->update()){
                    exit(CJSON::encode(array("status"=>200,"message"=>"bug等级清空成功")));
                }else{
                    exit(CJSON::encode(array("status"=>403,"message"=>"bug等级清空失败")));
                }

            }
        }else{
            exit(CJSON::encode(array("status"=>403,"message"=>"发生错误")));
        }
    }

}