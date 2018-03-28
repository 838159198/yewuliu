<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2015/8/10
 * Time: 9:06
 */
class ManageController extends OperationController
{
    /*
     * 用户列表
     * */
    public function actionIndex()
    {
        $this->loadAuth();
        $model = new Manage('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Manage'])) {
            $model->attributes = $_GET['Manage'];
        }
        $this->render('index',array("model"=>$model));
    }
    /*
     * 创建用户
     * */
    public function actionCreate()
    {
        $this->loadAuth();
        $manageModel = new Manage();
        if(isset($_POST['Manage']))
        {
            foreach($_POST['Manage'] as $_k => $_v)
            {
                $manageModel -> $_k =$_v;
            }
            if($manageModel->validate())
            {
                $time = time();
                $manageModel -> joinip = Yii::app()->request->userHostAddress;
                $manageModel -> jointime = $time;
                $manageModel->password = $manageModel->createPassword("123456");
                if($manageModel->insert())
                {
                    $this->redirect("index");
                }
            }
        }
        $this->render("create",array('model'=>$manageModel));
    }
    /*
     * 更新
     * */
    public function actionUpdate($id)
    {
        $this->loadAuth();
        $manageModel = Manage::model();
        $manageData = $manageModel->findByPk($id);
        if(empty($manageData))
        {
            throw new CHttpException(404,"不存在");
        }else{
            if(isset($_POST['Manage']))
            {
                foreach($_POST['Manage'] as $_k => $_v)
                {
                    $manageData -> $_k = $_v;
                }
                if($manageData->save())
                {
                    $this->redirect("index");
                }
            }
            $this->render("update",array("model"=>$manageData));
        }
    }
    /*
     * 密码修改
     * */
    public function actionPassword()
    {
        $mid = Yii::app()->user->id;
        $model = Manage::model();

        $data = $model->findByPk($mid);
        $data ->scenario = "password";
        $data->password="";
        if (isset($_POST['Manage'])) {
            $data->attributes = $_POST['Manage'];
            if ($data->validate())
            {
                $data->password = $model->createPassword($data->password);
                if($data->update())
                {
                    Common::redirect($this->createUrl('/operation'), '修改成功');
                }

            }
        }
        $this->render('password', array('model' => $data));
    }
    public function actionTestListDialog($keyname)
    {
        $departmentData = Department::model()->findAll("status=1");
        $manageData = Manage::model()->findAll("status=1");
        $this->renderPartial("list_dialog",array("manageData"=>$manageData,"departmentData"=>$departmentData,"keyname"=>$keyname));
    }
    /*
     * 权限判断
     * */
    public function loadAuth()
    {
        $mid = Yii::app()->user->id;
        $data=Manage::model()->findByPk($mid);
        if($mid!=3)
        {
            throw new CHttpException(403,"你没有访问权限");
        }
    }
}