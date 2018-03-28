<?php
/**
 * Created by PhpStorm.
 * User: zkn
 * Date: 2015/3/30
 * Time: 9:56
 * Name: 软件投放信息录入
 */
class SoftputrecordController extends OperationController
{
    /**
     * @Name: 列表
     * @Author: zkn
     * @Datetime: 2015-3-30 10:01:11
     * */
    public function actionIndex()
    {
        //datagrid模式
        $model = new SoftPutRecord('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['SoftPutRecord'])) {
            $model->attributes = $_GET['SoftPutRecord'];
        }
        $this->render('index', array(
            'model' => $model,
        ));
    }
    /**
     * @Name: 创建
     * @Author: zkn
     * @Datetime: 2015-3-30 10:01:11
     * */
    public function actionCreate()
    {
        //Script::registerUeditor();
        $model = new SoftPutRecord();
        if(isset($_POST['SoftPutRecord'])){
            foreach($_POST['SoftPutRecord'] as $_k => $_v){
                $model -> $_k = $_v;
            }
            $model -> create_datetime = time();
            $model -> last_datetime = time();
            $model -> uid = Yii::app()->user->id;
            if($model->save()){
                Yii::app()->user->setFlash('status',"添加成功！<a href='".Yii::app()->createUrl('operation/softPutRecord')."'>点击返回列表</a>");
                $this->refresh();
            }
        }
        $this->render("create",array('model'=>$model));
    }
    /**
     * @Name: 编辑
     * @Author: zkn
     * @Datetime: 2015-3-30 13:54:11
     * */
    public function actionEdit($id)
    {

        $model = SoftPutRecord::model();
        $data = $model -> findByPk($id);
        if(!empty($data)){
            if($data['uid'] != Yii::app()->user->id) {
                //throw new CHttpException(403,"没有权限");

                Yii::app()->user->setFlash('edit_fail',"只能修改自己发布的信息！");
                $this->redirect(Yii::app()->baseUrl."/development/softPutRecord");
            }else{
                if(isset($_POST['SoftPutRecord'])){
                    foreach($_POST['SoftPutRecord'] as $_k => $_v){
                        $data -> $_k = $_v;
                    }
                    $data -> last_datetime = time();
                    if($data -> save()){
                        Yii::app()->user->setFlash('status',"修改成功！<a href='".Yii::app()->createUrl('operation/softPutRecord')."'>点击返回列表</a>");
                        $this->refresh();
                    }
                }
                $this->render("edit",array('model'=>$data));
            }
        }else{
            throw new CHttpException(404,"no id");
        }
    }
    /*
     * @name: 复制功能
     * @datetime: 2015-4-22 09:46:57
     * */
    public function actionCopy($id)
    {
        //Script::registerUeditor();
        $model = new SoftPutRecord();
        $data = $model->findByPk($id);
        if(empty($data)){
            throw new CHttpException(404,"业务不存在，请选择已存在的业务复制！");
        }else{
            $uid = Yii::app()->user->id;
            if($data['uid'] != $uid){
                throw new CHttpException(403,"这不是你创建的业务，不能复制！");
            }else{
                //需要复制的内容
                $model -> customer_name = $data['customer_name'];
                $model -> service_name = $data['service_name'];
                $model -> version = $data['version'];
                $model -> content = $data['content'];
                $model -> md5 = $data['md5'];
                $model -> source_md5 = $data['source_md5'];
                $model -> comment = $data['comment'];
                if(isset($_POST['SoftPutRecord'])){
                    foreach($_POST['SoftPutRecord'] as $_k => $_v){
                        $model -> $_k = $_v;
                    }
                    $model -> create_datetime = time();
                    $model -> last_datetime = time();
                    $model -> uid = Yii::app()->user->id;
                    if($model->save()){
                        Yii::app()->user->setFlash('status',"复制成功！<a href='".Yii::app()->createUrl('operation/softPutRecord')."'>点击返回列表</a>");
                        Yii::app()->user->setFlash('copy',"复制成功！");
                        $this->refresh();
                    }
                }
                $this->render("copy",array('model'=>$model,'data'=>$data));
            }
        }
    }
    /**
     * @name: 删除
     * @author: zkn
     * @datetime: 2015-3-30 17:01:40
     * */
    public function actionDel($id){
        if(Yii::app()->request->isPostRequest) {
            $model = new SoftPutRecord();
            $data = $model->findByPk($id);
            if (empty($data)) {
                echo "失败，不存在的id";
            } else {
                //判断是否是自己发布
                if ($data['uid'] != Yii::app()->user->id) {
                    echo "删除失败，这不是你发布的内容！";
                } else {
                    if ($data->delete()) {
                        echo "恭喜你，删除成功！";
                    } else {
                        echo "删除失败，请再删一次或者联系技术人员查看！";
                    }
                }

            }
        }else{
            throw new CHttpException(500,"请按照正规流程操作。");
        }
        //$this->redirect(Yii::app()->baseUrl."/development/softPutRecord");
    }
    /**
     * @Name: 详情
     * @Author: zkn
     * @datetime: 2015-3-30 17:02:08
     * */
    public function actionDetail($id)
    {
        //Script::registerUeditor();
        $model = new SoftPutRecord();
        $data = $model -> findByPk($id);
        if(!empty($data)){
            $this->render("detail",array('data'=>$data));
        }else{
            Yii::app()->user->setFlash('detail_fail',"你要查看的信息不存在！");
            $this->redirect(Yii::app()->baseUrl."/operation/softPutRecord");
        }
    }
}