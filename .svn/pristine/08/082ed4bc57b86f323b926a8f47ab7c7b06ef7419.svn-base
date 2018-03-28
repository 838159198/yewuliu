<?php

/**
 * This is the model class for table "{{summary_project}}".
 *
 * The followings are the available columns in table '{{summary_project}}':
 * @property string $id
 * @property string $name
 * @property string $developmenttime
 * @property string $username
 * @property string $estimate
 * @property string $status
 * @property string $remarks
 * @property string $postid
 */
class SummaryProject extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{summary_project}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, developmenttime,estimate, username, status,  postid', 'required'),
			array('name', 'length', 'max'=>255),
			array('developmenttime,estimate, postid', 'length', 'max'=>10),
			array('username', 'length', 'max'=>60),
			array('status', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, developmenttime,estimate, username, status, remarks, postid', 'safe', 'on'=>'search'),
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
            'summary' => array(self::BELONGS_TO, 'Summary', 'sid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'developmenttime' => '开发时间',
            'estimate' => '预估时间',
			'username' => '开发人员',
			'status' => '状态',
			'remarks' => '说明备注',
			'postid' => 'Postid',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('developmenttime',$this->developmenttime,true);
        $criteria->compare('estimate',$this->estimate,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('remarks',$this->remarks,true);
		$criteria->compare('postid',$this->postid,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SummaryProject the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    public function getXstatus()
    {
        //状态1等待2进行3完成
        switch($this->status)
        {
            case 1:
                $data = "<span class=\"label label-default\">等待领取</span>";
                break;
            case 2:
                $data = "<span class=\"label label-info\">进行中</span>";
                break;
            case 3:
                $data = "<span class=\"label label-success\">完成</span>";
                break;
            case 4:
                $data = "<span class=\"label label-success\">暂停</span>";
                break;
            default:
                $data = "<span class=\"label label-danger\">发生错误</span>";
                break;
        }
        return $data;
    }
    public static  function findCreateTime($username,$start,$end){
        $summaryProjectModel = SummaryProject::model()->find('createtime >'.$start.' and createtime<'.$end.' and name="周工作总结" and username='.$username.' order by id desc');
        return $summaryProjectModel->createtime;
    }
}
