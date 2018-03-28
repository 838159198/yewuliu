<?php

class Department extends CActiveRecord
{


    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{department}}';
    }

    public function rules()
    {
        return array(
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id', 'safe', 'on' => 'search'),
        );
    }
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
        );
    }

    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('department', $this->department);
        $criteria->compare('f_id', $this->f_id);
        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }
}