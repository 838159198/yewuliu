<?php

class OperationVersion extends CActiveRecord
{
    public $minute;
    public $hours=0;
    public $post_username;
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{operation_version}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('one,two,three,four,mid,createtime,vvalue,postid', 'required'),
            array('one,two,three,four', 'length', 'max'=>6),
            array('one,two,three,four,mid,createtime', 'numerical','integerOnly'=>true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('one,two,three,four,mid,createtime,vvalue,postid', 'safe', 'on'=>'search'),
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
        );
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    /*
     * 版本号第一位数据
     * 主类别
     * */
    public function getCategoryListData()
    {
        $data = array();
        $data = array(array("key"=>1,"value"=>"客户端"),array("key"=>2,"value"=>"独立用户"),array("key"=>3,"value"=>"第三方插件"),);
        return $data;
    }


}
