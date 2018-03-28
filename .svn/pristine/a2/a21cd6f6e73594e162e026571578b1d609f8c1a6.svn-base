<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2015/7/30
 * Time: 10:48
 * Name: 管理员
 */
class ManageController extends Controller
{
    /*
     * 详情
     * */
    public function actionAjaxDetail($id)
    {
        if(Yii::app()->request->isAjaxRequest)
        {
            if(!isset($_GET['id']))
            {
                //throw new CHttpException(404,"不存在的id");
                echo "不存在的id！";
            }else{
                $id = intval($id);
                $model = new Manage();
                $data = $model->findByPk($id);
                if(empty($data))
                {
                    $returnData = "没有找到用户数据！";
                }else{
                    //部门
                    $departmentData = Department::model()->findByPk($data['department']);
                    //权限
                    $roleData = Role::model()->findByPk($data['role']);
                    //开发周期
                    $developmenttime=Helper::FormattingTime($data['developmenttimes']);
                    $returnData = '<div class="media media-user"><div class="media-left"><a href="#123456"><img src="/style/v1/noavatar_small.gif"></a><div class="label label-danger">'.$roleData["name"].'</div></div><div class="media-body"><h2 class="media-heading"><span class="fa fa-mars"></span> <a href="#123456">'.$data['name'].'</a><small> ('.$departmentData['department'].')</small></h2><div class="time">开发时间：'.$developmenttime.'<br/>注册时间：'.date("Y-m-d",$data['jointime']).'<br />最后登录：'.date("Y-m-d H:i:s",$data['overtime']).'</div></div></div><div class="media-footer"><div class="board"><span>业务池<br /><em>'.$data['underway_num'].'</em></span><span>已完成<br /><em>'.$data['complete_num'].'</em></span><span>创建数<br /><em>'.$data['create_num'].'</em></span><span>积分<br /><em>'.$data["credits"].'</em></span></div><a class="btn btn-xs btn-success btn-follow" href="#12345"><span class="glyphicon glyphicon-user"></span> 点击通过QQ联系</a><a class="btn btn-xs btn-primary" href="#"><span class="glyphicon glyphicon-home"></span> 进入主页</a><span class="pull-right"><span class="fa fa-heart-o"></span> <span class="fa fa-heart-o"></span> <span class="fa fa-heart-o"></span> <span class="fa fa-heart-o"></span> <span class="fa fa-heart-o"></span> </span></div>';
                }
                echo $returnData;
            }
        }else{
            echo "发生错误";
        }

    }
}