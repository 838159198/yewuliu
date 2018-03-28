<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class OperationController extends CController
{
    /**
     * 当前用户权限
     * @var array
     */
    protected $auth;
    /**
     * 当前用户ID
     * @var int
     */
    protected $uid, $username;
    /*public function __construct($id, $module = null)
    {
        parent::__construct($id, $module);
        //echo Yii::app()->getController()->id;
    }*/
    protected function beforeController()
    {

    }
    //访问action之前进行权限判断
    protected function beforeAction($action)
    {
        //echo Yii::app()->getController()->id;
        //echo $this->getId();
        //echo $this->getAction()->id;
        //先判断是否登录
        if(!Yii::app()->user->isGuest){
            return parent::beforeAction($action);
        }else{
            throw new CHttpException(500,"请先登录");
        }
        //return parent::beforeAction($action);
    }

    /**
     * @var string the default layout for the controller view. Defaults to 'column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout='operation';
    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu=array();
    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs=array();
    /**
     * 跳过验证的权限
     * @return array
     */
    protected function skipAuth()
    {
        return array();
    }



    /**
     * 控制器过滤器
     * @return array
     */
    public function filters()
    {
        return parent::filters();
    }

    protected function afterAction($action)
    {
        parent::afterAction($action);
        //关闭数据库连接
        Yii::app()->db->setActive(false);
    }
}