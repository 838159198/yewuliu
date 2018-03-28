<?php

/**
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $profile
 */
class Manage extends CActiveRecord
{
    public $rolename;
    public $departmentname;
    /**
     * Returns the static model of the specified AR class.
     * @return static the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{manage}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username,name,department,  role', 'required', 'on' => 'insert,update'),
            array('username', 'length', 'min' => 5, 'max' => 16, 'on' => 'insert'), //用户名长度为5-16
            array('password', 'length', 'min' => 6, 'max' => 16, 'on' => 'insert,password'), //密码长度为6-16
            array('username', 'unique', 'className' => 'Manage', 'attributeName' => 'username', 'on' => 'insert,update'),
            array('jointime, overtime, status', 'numerical', 'integerOnly' => true),
            array('username, password, name', 'length', 'max' => 32),
            array('joinip, overip', 'length', 'max' => 15),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('departmentname,rolename,id, username, password, joinip, overip, jointime, overtime, status, role, name,department', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            //'posts' => array(self::HAS_MANY, 'Post', 'author_id'),
            'roles' => array(self::BELONGS_TO, 'Role', 'role'),
            'departments' => array(self::BELONGS_TO, 'Department', 'department'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'Id',
            'username' => '用户名',
            'password' => '密码',
            'name'=>'姓名',
            'credits'=>'积分',
            'complete_num'=>'完成数量',
            'underway_num'=>'进行中',
            'create_num'=>'创建数量',
            'developmenttimes'=>'开发时间',
            'rollback_num'=>'退回数量',
            'status'=>'状态',
            'rolename'=>'级别',
            'departmentname'=>'部门',
            'department'=>'部门',
            'role'=>'级别'
        );
    }
    public function search()
    {
        $criteria=new CDbCriteria;
        $criteria->with = array('roles','departments');
        $criteria->compare('t.id',$this->id);
        $criteria->compare('t.username',$this->username,true);
        $criteria->compare('t.name',$this->name,true);
        $criteria->compare('t.credits',$this->credits,true);
        $criteria->compare('t.complete_num',$this->complete_num,true);
        $criteria->compare('t.underway_num',$this->underway_num,true);
        $criteria->compare('t.create_num',$this->create_num,true);
        $criteria->compare('t.developmenttimes',$this->developmenttimes,true);
        $criteria->compare('t.rollback_num',$this->rollback_num,true);
        $criteria->compare('t.department',$this->department,true);
        $criteria->compare('t.status',$this->status);
        $criteria->compare('t.role',$this->rolename);
        $criteria->compare('t.department',$this->departmentname);


        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination' => array(
                'pageSize' => 30,
            ),
            'sort'=>array(
                'defaultOrder'=>'t.id DESC',
                //加入排序
                'attributes'=>array(
                    'rolename'=>array(
                        'asc'=>'roles.name',
                        'desc'=>'roles.name DESC',
                    ),
                    'departmentname'=>array(
                        'asc'=>'departments.department',
                        'desc'=>'departments.department DESC',
                    ),
                     '*',
                ),
            ),
        ));
    }

    /**
     * Checks if the given password is correct.
     * @param string the password to be validated
     * @return boolean whether the password is valid
     */
    public function validatePassword($password)
    {
        //return CPasswordHelper::verifyPassword($password,$this->password);
        return $this->createPassword($password) === $this->password;
    }
    /**
     * 获得加密密码
     * @param $password
     * @return string
     */
    public function createPassword($password)
    {
        return md5(strrev(md5(strrev(trim($password)))));
    }
    /**
     * @param $username
     *根据用户名获取用户id
    */
    public function getIdByname($username)
    {
        $mid = Manage::model()->find('name=:name',array(':name' => $username));
        return $mid['id'];
    }
    /**
     * Generates the password hash.
     * @param string password
     * @return string hash
     */
    public function hashPassword($password)
    {
        return CPasswordHelper::hashPassword($password);
    }
    /*
     * 修改积分
     * */
    public function updateCredits($uid,$credits=0)
    {
        //$data = Manage::model()->findByPk($uid);
        //$data->credits = $data->credits+$credits;
        //$data->update();
        Manage::model()->updateCounters(array('credits'=>$credits),"`id`=$uid");
    }
    /*
     * 记录数、用时
     * */
    public function updateNum($uid,$filed,$number)
    {
        Manage::model()->updateCounters(array($filed=>$number),"`id`=$uid");
    }
    /*
     * 状态样式
     * */
    public function getXstatus()
    {
        switch($this->status)
        {
            case 0:
                $data = "<span class=\"label label-danger\">禁用</span>";
                break;
            case 1:
                $data = "<span class=\"label label-success\">正常</span>";
                break;
            case 3:
                $data = "<span class=\"label label-primary\">完成</span>";
                break;
            default:
                $data = "<span class=\"label label-default\">错误</span>";
                break;
        }
        return $data;
    }
}
