<?php

/**
 * This is the model class for table "{{operation_onoff}}".
 *
 * The followings are the available columns in table '{{operation_onoff}}':
 * @property string $id
 * @property string $status
 * @property string $developtime
 * @property string $post_uid
 * @property string $postid
 * @property string $start_datetime
 * @property string $end_datetime

 */
class SpareTimeOnoff extends CActiveRecord
{
    public $post_username;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{spare_timeonoff}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(



			// @todo Please remove those attributes that should not be searched.
			array('id, post_uid,postid, status,start_datetime, end_datetime', 'safe', 'on'=>'search'),
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

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'post_uid' => '接收人',
            'postid' => 'postid',
            'status' => 'status',
            'developtime' => '占用时间',
			'start_datetime' => '开始时间',
			'end_datetime' => '结束时间',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;



		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Operationonoff the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * @param 通过用户id来查询本周的占用时间
     * @return static[]
     */
    public static function findSpareTimeByUid($uid,$start_datetime,$end_datetime){
       // $spareTimes=SpareTimeOnoff::model()->findAll("post_uid=:post_uid and  status=:status", array(":post_uid"=>$uid,":status"=>0));

        $spareTimes =SpareTimeOnoff::model()->findAll(array(
            'select'=>array('content','start_datetime','end_datetime','developtime'),
            'order' => 'id DESC',
            'condition' => 'status=:status AND post_uid=:post_uid and start_datetime>:start_datetime and end_datetime<:end_datetime',
            'params' => array(':status'=>0,':post_uid' => $uid,':start_datetime'=>$start_datetime,':end_datetime'=>$end_datetime),
        ));

        return $spareTimes;



    }

}
