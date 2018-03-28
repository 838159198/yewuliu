<?php
class SoftPutRecord extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    public function tableName()
    {
        return '{{softput_record}}';
    }
    public function rules()
    {
        return array(
            array('customer_name,service_name','required'),
            array("update_datetime","type","dateFormat"=>"yyyy-MM-dd","type"=>"date","message"=>"请填写正确时间格式"),
            //array('c_id, c_time, m_time, d_id, t_id, status, f_id', 'numerical', 'integerOnly'=>true),
            //array('title, content', 'length', 'max'=>255),
            array('customer_name,service_name,id,version,md5,update_datetime', 'safe', 'on'=>'search'),
        );
    }
    public function relations()
    {
        return array(
            //'user' => array(self::BELONGS_TO, 'manage', '','on' => 't.uid=user.id'),
            'user' => array(self::BELONGS_TO, 'Manage', 'uid'),
        );
    }
    public function attributeLabels()
    {
        return array(
            'id' => '序号',
            'customer_name' => '客户名',
            'service_name' => '业务名称',
            'version' => '版本号',
            'update_datetime' => '更新时间',
            'content' => '更新内容',
            'md5' => 'md5',
            'source_md5' => '源码md5',
            'comment' => '备注',
            'create_datetime' => '创建时间',
            'last_datetime' => '最后时间',
            'username' => '发布者',
            'uid'=>'uid',
        );
    }
    public function search()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('customer_name', $this->customer_name, true);
        $criteria->compare('service_name', $this->service_name, true);
        $criteria->compare('version', $this->version, true);
        $criteria->compare('update_datetime', $this->update_datetime, true);
        $criteria->compare('md5', $this->md5, true);
        $criteria->compare('source_md5', $this->source_md5, true);
        $criteria->compare('create_datetime', $this->create_datetime);
        //$criteria->order = 'role';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 25,
            ),
            'sort'=>array(
                'defaultOrder'=>'id DESC', //设置默认排序
                //       'defaultOrder'=>'t.id DESC', //当有join连接查询时，需要添加表别名
            ),
        ));
    }
    public function getXrole()
    {
        return $this->uid == Yii::app()->user->id ? 1 : 0;
    }


}