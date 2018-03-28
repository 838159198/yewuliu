<?php

/**
 * This is the model class for table "{{operation_thread}}".
 *
 * The followings are the available columns in table '{{operation_thread}}':
 * @property string $id
 * @property string $content
 * @property string $datetime
 * @property string $file
 * @property string $developtime
 * @property string $post_uid
 * @property string $start_datetime
 * @property string $end_datetime
 * @property string $about_uid
 */
class OperationThread extends CActiveRecord
{
    public $minute;
    public $hours=0;
    public $post_username;
    public $priority;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{operation_thread}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('hours,content, datetime, post_uid, start_datetime, end_datetime', 'required'),
			array('datetime, developtime, post_uid, start_datetime, end_datetime', 'length', 'max'=>10),
			array('file', 'length', 'max'=>255),
            array('post_uid', 'numerical','integerOnly'=>true),
            array('minute,hours', 'numerical','integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, content, datetime, file, developtime, post_uid, start_datetime, end_datetime,about_uid', 'safe', 'on'=>'search'),
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
			'content' => '回复内容',
			'datetime' => '回复时间',
			'file' => '文件',
			'developtime' => '开发周期（分钟）',
			'post_uid' => '接收人',
			'start_datetime' => '开始时间',
			'end_datetime' => '结束时间',
            'hours'=>'开发周期（小时）',
            'minute'=>'开发周期（分钟）',
            'post_username'=>'接收人',
            'about_uid'=>'about_uid',
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
		$criteria->compare('content',$this->content,true);
		$criteria->compare('datetime',$this->datetime,true);
		$criteria->compare('file',$this->file,true);
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
	 * @return OperationThread the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    /*
     * 返回文件列表
     * */
    public function getXfile()
    {
        if(empty($this->file))
        {
            return null;
        }else{
            //$fileArray = explode(",",$this->file);
            $data = OperationFile::model()->findAll(array("condition"=>"`id` in ({$this->file})"));
            if(empty($data))
            {
                return null;
            }else{
                return $data;
            }
        }
    }
    public function afterSave()
    {
        parent::afterSave();
        $model = new OperationTimesLog();
        if($model->exists("`postid`=:postid and `mid`=:mid",array(":postid"=>$this->postid,":mid"=>$this->create_uid)))
        {
            $timesLogModel = OperationTimesLog::model();
            $timesLogData = $timesLogModel->find("`postid`=:postid and `mid`=:mid",array(":postid"=>$this->postid,":mid"=>$this->create_uid));
            $timesLogData->updateCounters(array("times"=>$this->developtime),"`postid`={$this->postid} and `mid`={$this->create_uid}");
        }else{
            $model->postid=$this->postid;
            $model->mid=$this->create_uid;
            $model->times=$this->developtime;
            $model->insert();
        }
    }

}
