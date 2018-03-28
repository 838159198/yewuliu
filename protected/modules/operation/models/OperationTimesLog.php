<?php

/**
 * This is the model class for table "{{operation_timeslog}}".
 *
 * The followings are the available columns in table '{{operation_timeslog}}':
 * @property string $id
 * @property string $name
 * @property string $alias
 */
class OperationTimesLog extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{operation_timeslog}}';
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
}
