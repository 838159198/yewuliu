<?php

/**
 * This is the model class for table "{{operation_test_templete}}".
 *
 * The followings are the available columns in table '{{operation_test_templete}}':
 * @property string $id
 * @property string $name
 * @property string $test_module
 * @property string $test_developer
 * @property string $test_project
 * @property string $mid
 */
class OperationTestTemplate extends CActiveRecord
{
    //发布人姓名
    public $manage_create_name;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{operation_test_template}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, test_developer, test_project, mid', 'required'),
			array('name, test_module, test_developer', 'length', 'max'=>100),
			array('mid', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('manage_create_name,id,name, test_module, test_developer, test_project, mid,createtime,updatetime', 'safe', 'on'=>'search'),
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
            'manage_create' => array(self::BELONGS_TO, 'Manage', 'mid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => '名称',
			'test_module' => '测试模块',
			'test_developer' => '开发者',
			'test_project' => '测试项目',
			'mid' => '用户id',
            'createtime'=>'创建时间',
            'updatetime'=>'更新时间',
            'manage_create_name'=>'创建人'
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
        $criteria->with = array('manage_create');
		$criteria->compare('t.id',$this->id,true);

		$criteria->compare('t.test_module',$this->test_module,true);
		$criteria->compare('t.test_developer',$this->test_developer,true);
		$criteria->compare('t.test_project',$this->test_project,true);
		$criteria->compare('t.mid',$this->mid,true);
        $criteria->compare('t.name',$this->name,true);
        $criteria->compare('manage_create.name',$this->manage_create_name,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination' => array(
                'pageSize' => 20,
            ),
            'sort'=>array(
                'defaultOrder'=>'t.id DESC',
                'attributes'=>array(
                    'manage_create_name'=>array(
                        'asc'=>'manage_create.name',
                        'desc'=>'manage_create.name DESC',
                    ),
                    '*',
                ),
            ),
        ));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OperationTestTemplete the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
