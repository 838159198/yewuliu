<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2015/8/6
 * Time: 9:46
 * Name: 版本号
 */
class VersionController extends OperationController
{
    /*
     * @Name 版本号生成
     * */
    public function actionCreate($postid)
    {
        $operationPostModel = new OperationPost();
        $operationPostData = $operationPostModel -> findByPk($postid);
        if(empty($operationPostData))
        {
            throw new CHttpException(404,"不存在");
        }else{
            if($operationPostData['version_number']!=""){
                $_data = "已经生成过版本号";
                $this->renderPartial("tips_fail",array("data"=>$_data));
            }else{
                $versionModel = new OperationVersion();
                $businessModel = new OperationVersionBusiness();
                $businessData = $businessModel->findAll("status=1");
                $this->renderPartial("create_tips",array("versionmodel"=>$versionModel,
                    'postdata'=>$operationPostData,
                    'businessData'=>$businessData));
            }
        }
    }
    /*
     * 接收版本号创建
     * */
    public function actionAjaxCreate()
    {
        if(Yii::app()->request->isAjaxRequest && isset($_POST['categoryid']) && isset($_POST['businessid']))
        {
            $postid=$_POST['id'];
            $operationPostData = OperationPost::model()->findByPk($postid);
            if(empty($operationPostData))
            {
                exit(CJSON::encode(array("status"=>400,"message"=>"业务不存在")));
            }else{
                $transaction = Yii::app()->db->beginTransaction();
                try {
                    $time = time();
                    $mid = Yii::app()->user->id;
                    $versionModel = new OperationVersion();
                    $one = $_POST['categoryid'];
                    $two = $_POST['businessid'];
                    $three = date("nd",$time);
                    $four = rand(1,30000);
                    $vvalue = $one.".".$two.".".$three.".".$four;
                    $versionModel->one=$one;
                    $versionModel->two=$two;
                    $versionModel->three=$three;
                    $versionModel->four=$four;
                    $versionModel->vvalue=$vvalue;
                    $versionModel->createtime=$time;
                    $versionModel->mid=$mid;
                    $versionModel->postid=$postid;
                    if($versionModel->save())
                    {
                        $operationPostData->version_number=$vvalue;
                        $operationPostData->update();
                        $transaction->commit();
                        exit(CJSON::encode(array("status"=>200,"message"=>"生成版本号成功")));
                    }else{
                        exit(CJSON::encode(array("status"=>400,"message"=>"生成失败，请重新提交")));
                    }

                } catch (Exception $e) {
                    $transaction->rollback();
                    exit(CJSON::encode(array("status"=>400,"message"=>"生成失败rollback，请重新提交")));
                }
            }
        }else{
            exit(CJSON::encode(array("status"=>400,"message"=>"请用正确的姿势提交")));
        }
    }
    /*
     * 业务添加
     * */
    public function actionAjaxBusinessCreate()
    {
        if(Yii::app()->request->isAjaxRequest && isset($_POST['name']))
        {
            $name = $_POST['name'];
            $businessModel = new OperationVersionBusiness();
            $businessModel->status=1;
            $businessModel->name = $name;
            if($businessModel->save())
            {
                $id =Yii::app()->db->getLastInsertID();
                exit(CJSON::encode(array("status"=>200,"id"=>$id,"name"=>$name,"message"=>"业务添加成功")));
            }else{
                exit(CJSON::encode(array("status"=>400,"message"=>"添加业务失败，请重新提交")));
            }
        }else{
            exit(CJSON::encode(array("status"=>400,"message"=>"请用正确的姿势提交")));
        }
    }
}