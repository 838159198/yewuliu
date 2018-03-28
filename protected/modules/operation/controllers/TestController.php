<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2015/8/7
 * Time: 15:25
 * 测试用例
 */
class TestController extends OperationController
{
    /*
     * 列表
     * */
    public function actionIndex()
    {

    }
    /*
     * 创建
     * */
    public function actionCreate($postid,$importid=0)
    {
        $postModel = OperationPost::model();
        $postData = $postModel -> findByPk($postid);
        if(empty($postData))
        {
            throw new CHttpException(404,"业务流不存在无法创建");
        }else{
            if($postData['test']==0 && $postData['version_number']!="")
            {
                $testModel = new OperationTest();
                if(isset($_POST['OperationTest']))
                {
                    foreach($_POST['OperationTest'] as $_k => $_v)
                    {
                        $testModel->$_k =$_v;
                    }
                    $time = time();
                    $mid = Yii::app()->user->id;
                    $testModel -> createtime = $time;
                    $testModel -> mid = $mid;
                    $testModel -> postid = $postid;
                    //$testModel -> test = 1;
                    //print_r($testModel->project);

                    if(!empty($testModel->project))
                    {
                        $projectArray = $testModel->project;
                        $project = implode("::::",$projectArray);
                        //$testModel->project = $project;
                        $testModel->projectnum = count($projectArray);
                    }else{
                        exit("测试项目没有填写");
                    }
                    if($testModel->save())
                    {
                        $id =Yii::app()->db->getLastInsertID();
                        //成功,添加项目
                        foreach($projectArray as $_tk => $_tv)
                        {
                            $TestProjectModel = new OperationTestProject();
                            $TestProjectModel -> createtime = $time;
                            $TestProjectModel -> mid = $mid;
                            $TestProjectModel -> name = $_tv;
                            $TestProjectModel -> testid = $id;
                            $TestProjectModel -> insert();
                        }
                        $postData->test=1;
                        $postData->update();
                        $this->redirect("/operation/default/detail?id=".$postid);
                    }
                }
                $this->render("create",array("postData"=>$postData,"model"=>$testModel));
            }else{
                throw new CHttpException(404,"已经创建过测试实例或还没生成版本号");
            }
        }
    }
    /*
     * 导入模板
     * */
    public function actionCreateImport($postid,$templateid)
    {
        $postModel = OperationPost::model();
        $postData = $postModel -> findByPk($postid);
        if(empty($postData))
        {
            throw new CHttpException(404,"业务流不存在无法创建");
        }else{
            if($postData['test']==0 && $postData['version_number']!="")
            {
                $templateModel = new OperationTestTemplate();
                $templateData = $templateModel -> findByPk($templateid);
                if(empty($templateData))
                {
                    throw new CHttpException(404,"模板不存在");
                }else{
                    $testModel = new OperationTest();
                    //生成模板数据
                    $testModel -> developer = $templateData['test_developer'];
                    $testModel -> module = $templateData['test_module'];
                    $testProjectArray = explode("::::",$templateData['test_project']);
                    $testProjectCountNum = count($testProjectArray);
                    if(isset($_POST['OperationTest']))
                    {
                        foreach($_POST['OperationTest'] as $_k => $_v)
                        {
                            $testModel->$_k =$_v;
                        }
                        $time = time();
                        $mid = Yii::app()->user->id;
                        $testModel -> createtime = $time;
                        $testModel -> mid = $mid;
                        $testModel -> postid = $postid;
                        if(!empty($testModel->project))
                        {
                            $projectArray = $testModel->project;
                            $project = implode("::::",$projectArray);
                            $testModel->project = $project;
                            $testModel->projectnum = count($projectArray);
                        }else{
                            exit("测试项目没有填写");
                        }
                        if($testModel->save())
                        {
                            $id =Yii::app()->db->getLastInsertID();
                            //成功,添加项目
                            foreach($projectArray as $_tk => $_tv)
                            {
                                $TestProjectModel = new OperationTestProject();
                                $TestProjectModel -> createtime = $time;
                                $TestProjectModel -> mid = $mid;
                                $TestProjectModel -> name = $_tv;
                                $TestProjectModel -> testid = $id;
                                $TestProjectModel -> insert();
                            }
                            $postData->test=1;
                            $postData->update();
                            $this->redirect("/operation/default/detail?id=".$postid);
                        }
                    }
                    $this->render("create_import",array("postData"=>$postData,"model"=>$testModel,'testProjectCountNum'=>$testProjectCountNum,"testProjectArray"=>$testProjectArray));
                }
            }else{
                throw new CHttpException(404,"已经创建过测试实例或没有生成版本号");
            }

        }
    }
    /*
     * 查看测试用例
     * */
    public function actionDetail($postid)
    {
        $testModel = OperationTest::model();
        $testData = $testModel->find("`postid`=".$postid);
        if(empty($testData))
        {
            throw new CHttpException(404,"不存在");
        }else{
            $testProjectModel = new OperationTestProject();
            $testProjectData = $testProjectModel -> findAll("`testid`={$testData['id']}");
            if(empty($testProjectData))
            {
                throw new CHttpException(404,"发生错误，测试用例没有测试项目，请联系技术人员");
            }else{
                $this->render("detail",array('testData'=>$testData,'testProjectDataList'=>$testProjectData));
            }

        }
    }
    /*
     * 模板列表
     * */
    public function actionTemplate()
    {
        $model = new OperationTestTemplate('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['OperationTestTemplate'])) {
            $model->attributes = $_GET['OperationTestTemplate'];
        }
        $this->render('template_list',array("model"=>$model));
    }
    /*
     * 模板创建
     * */
    public function actionTemplateCreate()
    {
        $templateModel = new OperationTestTemplate();
        if(isset($_POST['OperationTestTemplate']))
        {
            foreach($_POST['OperationTestTemplate'] as $_k => $_v)
            {
                $templateModel -> $_k = $_v;
            }
            $time = time();
            $mid = Yii::app()->user->id;
            $templateModel -> createtime = $time;
            $templateModel -> updatetime = $time;
            $templateModel -> mid = $mid;
            if(!empty($templateModel->test_project))
            {
                $project = implode("::::",$templateModel->test_project);
                $templateModel->test_project = $project;
            }
            if($templateModel->save())
            {
                Yii::app()->user->setFlash("create_status","恭喜你，测试用例模板创建成功!");
                $this->redirect("template");
            }
        }
        $this->render("template_create",array("model"=>$templateModel));
    }
    /*
     * 模板修改
     * */
    public function actionTemplateUpdate($id)
    {
        $templateModel = OperationTestTemplate::model();
        $templateData = $templateModel -> findByPk($id);
        if(empty($templateData))
        {
            throw new CHttpException(404,"不存在");
        }else{
            $projectArray = explode("::::",$templateData['test_project']);

            $count = count($projectArray);
            if(isset($_POST['OperationTestTemplate']))
            {
                foreach($_POST['OperationTestTemplate'] as $_k => $_v)
                {
                    $templateData->$_k =$_v;
                }
                $templateData->updatetime = time();
                if(isset($templateData->test_project))
                {
                    if(!empty($templateData->test_project))
                    {
                        $project = implode("::::",$templateData->test_project);
                        $templateData->test_project = $project;
                    }
                }

                if($templateData->save())
                {
                    Yii::app()->user->setFlash("create_status","恭喜你，测试用例模板修改成功!");
                    $this->redirect("template");
                }
            }
            $this->render("template_update",array("model"=>$templateData,'count'=>$count,'project'=>$projectArray));
        }
    }
    /*
     * 模板导入搜索
     * 模糊查询
     * */
    public function actionTemplateSearchDataList($postid,$keyword)
    {
        $templateModel = new OperationTestTemplate();
        $criteria = new CDbCriteria();
        $criteria->compare('name',$keyword,true);
        //$criteria -> condition = "`name` LIKE :name";
        //$criteria -> params = array(":name"=>$keyword);
        $criteria -> order = "id desc";
        $templateDataList = $templateModel -> findAll($criteria);
        $this->renderPartial("search_datalist",array("data"=>$templateDataList,'keyword'=>$keyword,'postid'=>$postid));
    }
    /*
     * 添加测试项目，modal弹出形式
     * */
    public function actionTestProjectModalDialog($id)
    {
        $testModel = OperationTest::model();
        $testData = $testModel->findByPk($id);

        $this->renderPartial("test_project_modaldialog",array("testData"=>$testData));
    }
    /*
     * 接收项目内容
     * */
    public function actionTestProjectModalDialogSave()
    {
        if(isset($_POST['id']) && isset($_POST['project']))
        {
            $testid = $_POST['id'];
            $name = $_POST['project'];
            $mid = Yii::app()->user->id;
            $testProjectModel = new OperationTestProject();
            $testProjectModel -> createtime = time();
            $testProjectModel -> mid = $mid;
            $testProjectModel -> status = 0;
            $testProjectModel -> testid = $testid;
            $testProjectModel -> name = $name;

            if($testProjectModel->save())
            {
                OperationTest::model()->updateCounters(array("projectnum"=>1),"id=".$testid);
                exit(CJSON::encode(array("status"=>200,"message"=>"添加成功")));
            }else{
                exit(CJSON::encode(array("status"=>404,"message"=>"提交失败".$testid)));
            }
        }else{
            exit(CJSON::encode(array("status"=>404,"message"=>"请正确传值")));
        }
    }
    /*
     * 修改状态
     * */
    public function actionTestProjectBtnStatus()
    {
        if(isset($_POST['id']))
        {
            $id = $_POST['id'];
            $testProjectModel = OperationTestProject::model();
            $testProjectData = $testProjectModel->findByPk($id);
            if(empty($testProjectData))
            {
                exit(CJSON::encode(array("status"=>404,"message"=>"不存在")));
            }else{
                $testData = OperationTest::model()->findByPk($testProjectData['testid']);
                if($testData['status']==1){
                    exit(CJSON::encode(array("status"=>404,"message"=>"测试已全部通过，不可修改状态")));
                }
                $type =0;
                if($testProjectData['status']==1){

                    $testProjectData->status=$type;
                }elseif($testProjectData['status']==0){
                    $type =1;
                    $testProjectData->status=$type;
                }else{

                    $testProjectData->status=$type;
                }
                if($testProjectData->update())
                {
                    if($type==1){
                        $value = "PASS";
                    }else{
                        $value ='N　G';
                    }
                    exit(CJSON::encode(array("status"=>200,"type"=>$type,"value"=>$value)));
                }else{
                    exit(CJSON::encode(array("status"=>404,"message"=>"修改失败")));
                }
            }

        }else{
            exit(CJSON::encode(array("status"=>404,"message"=>"请正确传值")));
        }
    }
    /*
     * 测试通过
     * */
    public function actionTestPass()
    {
        if(isset($_POST['id']))
        {
            $id = $_POST['id'];
            $testModel = OperationTest::model();
            $testData = $testModel -> findByPk($id);
            if(empty($testData))
            {
                exit(CJSON::encode(array("status"=>404,"message"=>"测试用例不存在")));
            }else{
                $count = OperationTestProject::model()->count("`testid`={$id} and `status`=0");
                if($count>0){
                    //不通过
                    exit(CJSON::encode(array("status"=>404,"message"=>"还有测试项目没有通过")));
                }else{
                    //通过
                    $testData->status=1;
                    if($testData->update()){
                        exit(CJSON::encode(array("status"=>200,"message"=>"修改成功")));
                    }else{
                        exit(CJSON::encode(array("status"=>404,"message"=>"修改失败")));
                    }
                }
            }
        }else{
            exit(CJSON::encode(array("status"=>404,"message"=>"请正确传值")));
        }

    }
}