<?php

/**
 * This is the model class for table "{{operation_test}}".
 *
 * The followings are the available columns in table '{{operation_test}}':
 * @property string $id
 * @property string $developer
 * @property string $postid
 * @property string $module
 * @property string $mid
 * @property integer $createtime
 */
class OperationTest extends CActiveRecord
{
    public $project;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{operation_test}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('developer,project, postid, mid, createtime', 'required'),
			array('createtime', 'numerical', 'integerOnly'=>true),
			array('developer, module', 'length', 'max'=>30),
			array('postid, mid', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, developer, postid, module, mid, createtime', 'safe', 'on'=>'search'),
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
            'operation_post' => array(self::BELONGS_TO, 'OperationPost', 'postid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'developer' => '开发者',
			'postid' => '业务流id',
			'module' => '测试模块',
			'mid' => '创建者id',
			'createtime' => 'Createtime',
            'project'=>'测试项目',
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
		$criteria->compare('developer',$this->developer,true);
		$criteria->compare('postid',$this->postid,true);
		$criteria->compare('module',$this->module,true);
		$criteria->compare('mid',$this->mid,true);
		$criteria->compare('createtime',$this->createtime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OperationTest the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
