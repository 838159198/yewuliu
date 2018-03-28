<?php


class OperationRollback extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{operation_rollback}}';
    }
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('postid, mid, content, create_datetime', 'required'),
            array('postid, mid, content, create_datetime', 'safe', 'on'=>'search'),
        );
    }
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'alias' => '别名',
        );
    }
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
