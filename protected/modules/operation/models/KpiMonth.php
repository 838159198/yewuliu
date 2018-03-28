<?php

/**
 * This is the model class for table "{{summary_week}}".
 *
 * The followings are the available columns in table '{{summary_week}}':
 * @property string $id
 * @property string $title
 * @property string $mid
 * @property string $createtime
 * @property string $endtime
 * @property string $createdatetime
 * @property string $enddatetime
 */
class KpiMonth extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{kpi_month}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title,enddatetime,startdatetime', 'required'),
			array('title', 'length', 'max'=>30),

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id,mid,title,createdate,enddate,startdate,enddatetime,startdatetime,weeks', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => '标题',
			'mid' => '创建人',
			'createtime' => '创建时间',
			'endtime' => '截止时间',
			'createdatetime' => '创建日期时间',
			'enddatetime' => '结束日期',
            'startdatetime'=>'开始日期',
            'num'=>'人数',
            'status'=>'状态',
            'weeks'=>'考核周数'
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
	 * @return SummaryWeek the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    /*
     * 状态样式
     * */
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
    /*
     * 状态列表下拉
     * */
    public function getlistDataStatus()
    {
        // $a = 1,2,3,4,5,6; $b  array_map($a,$b,'key','value')
        $data = array();
        $data = array(array("key"=>0,"value"=>"未完成"),array("key"=>1,"value"=>"完成"));
        //$data[1]="代理商";
        //$data[0]="普通用户";
        return $data;
    }
}
