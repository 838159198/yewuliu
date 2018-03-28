<?php

/**
 * This is the model class for table "{{kpi_project}}".
 *
 * The followings are the available columns in table '{{kpi_project}}':
 * @property string $id
 * @property string $name
 * @property string $developmenttime
 * @property string $username
 * @property string $estimate
 * @property string $status
 * @property string $remarks
 * @property string $postid
 */
class KpiProject extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{kpi_project}}';
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
			array('id, name, sum,status, explain, attribute,rule', 'safe', 'on'=>'search'),
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
			'name' => '考核项',
			'explain' => '解释',
            'attribute' => '归属性',

			'status' => '状态',
			'rule' => '扣分指标',

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

		$criteria->compare('status',$this->status,true);


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

    public static  function findRuleById($id){
        $kpiProject = KpiProject::model()->findByPk($id);
        $rules=$kpiProject->rule;
        return $rules;
    }

    public static  function findExplainById($id){
        $kpiProject = KpiProject::model()->findByPk($id);
        $explains=$kpiProject->explain;
        return $explains;
    }
}
