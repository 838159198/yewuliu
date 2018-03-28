<?php

/**
 * This is the model class for table "{{summary}}".
 *
 * The followings are the available columns in table '{{summary}}':
 * @property string $id
 * @property string $mid
 * @property string $projectnum
 * @property string $createdatetime
 * @property string $createtime
 */
class Summary extends CActiveRecord
{
    public $title;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{summary}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mid, projectnum, createdatetime, createtime', 'required'),
			array('mid, projectnum, createtime', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, mid, projectnum, createdatetime, createtime,days,submit_date', 'safe', 'on'=>'search'),
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
            'manages' => array(self::BELONGS_TO, 'Manage', 'mid'),
            'summaryWeeks' => array(self::BELONGS_TO, 'SummaryWeek', 'weekid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'mid' => '创建人',
			'projectnum' => '项目数量',
			'createdatetime' => '日期',
			'createtime' => '日期',
            'weekid'=>'标题',
            'status'=>'状态',
            'statdatetime'=>'开始日期',
            'enddatetime'=>'结束日期',
            'days'=>'上班天数',
            'submit_date'=>'提交日期'
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
		$criteria->compare('mid',$this->mid);
		$criteria->compare('projectnum',$this->projectnum,true);
		$criteria->compare('createdatetime',$this->createdatetime,true);
		$criteria->compare('createtime',$this->createtime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination' => array(
                'pageSize' => 20,
            ),
            'sort'=>array(
                'defaultOrder'=>'t.id DESC',

            ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Summary the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    public function getXstatus()
    {
        switch($this->status)
        {
            case 0:
                $data = "<span class=\"label label-default\">未完成</span>";
                break;
            case 1:
                $data = "<span class=\"label label-success\">完成</span>";
                break;
            default:
                $data = "<span class=\"label label-danger\">发生错误</span>";
                break;
        }
        return $data;
    }
    public function getXmytitle()
    {
        if($this->status==0)
        {
            $data = $this->summaryWeeks->title;
        }else{
            $data = "<a href='/operation/summary/detail?id={$this->id}' target='_blank'>{$this->summaryWeeks->title}</a>";
        }
        return $data;
    }
}
