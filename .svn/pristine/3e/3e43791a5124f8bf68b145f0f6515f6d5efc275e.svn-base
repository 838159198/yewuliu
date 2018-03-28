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
class OperationOnoff extends CActiveRecord
{
    public $minute;
    public $hours=0;
    public $post_username;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{operation_onoff}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('postid,post_uid, start_datetime, end_datetime', 'required'),
			array('developtime, post_uid, start_datetime, end_datetime', 'length', 'max'=>10),
            array('post_uid,postid', 'numerical','integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, developtime, post_uid,postid, status,start_datetime, end_datetime', 'safe', 'on'=>'search'),
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
			'developtime' => '开发周期（分钟）',
			'post_uid' => '接收人',
            'postid' => 'postid',
            'status' => 'status',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('postid',$this->postid,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('developtime',$this->developtime,true);
		$criteria->compare('post_uid',$this->post_uid,true);
		$criteria->compare('start_datetime',$this->start_datetime,true);
		$criteria->compare('end_datetime',$this->end_datetime,true);

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
    //通过postid，uid获取总的停留时间
    public static  function getAllDeveloptime($postid,$mid,$week_end)
    {

        //$data = $model->findAll("postid=:postid and post_uid=:post_uid ", array(":postid" => $postid,":post_uid"=>$mid));
        $sql = "SELECT sum(developtime) aa  FROM ele_operation_onoff where postid='$postid' and post_uid=$mid and end_datetime<$week_end";

        $model = Yii::app()->db->createCommand($sql)->queryAll();

        if ($model) {
            $developtime = $model[0]['aa'];


        }else{
            $developtime=0;
        }
        return $developtime;
    }

}
