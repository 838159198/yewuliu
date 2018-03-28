<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/19
 * Time: 11:17
 */
class CheckScore extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{check_score}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, type, uid,createdatetime,m_id, score', 'safe', 'on' => 'search'),
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
            'manages' => array(self::BELONGS_TO, 'Manage', 'uid'),
            'month' => array(self::BELONGS_TO, 'ActionMonth', 'm_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'type' => '考核项',
            'score' => '考核得分',
            'createdatetime' => '创建日期时间',
            'm_id' => '考核月',
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

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 20,
            ),
            'sort' => array(
                'defaultOrder' => 't.id DESC',

            ),
        ));
    }
    /*
    * 考核项样式
    * */
    public function getXtype()
    {
        switch($this->type)
        {
            case 'action':
                $data = "<span class=\"label label-danger\">个人行为考核</span>";
                break;
            case 'lead':
                $data = "<span class=\"label label-success\">领导评价考核</span>";
                break;
            case 'post':
                $data = "<span class=\"label label-primary\">单项任务考核</span>";
                break;
            case 'kpi':
                $data = "<span class=\"label label-default\">工作质量考核</span>";
                break;
            default:
                $data = "<span class=\"label label-default\">错误</span>";
                break;
        }
        return $data;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return SummaryWeek the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /*
  * 考核项按比例得分
  * */
    public static  function getXscore(CheckScore $checkScore)
    {
            switch($checkScore['type'])
            {
                case 'action':
                    $data =$checkScore['score']==0?10*0.95:$checkScore['score']*0.1;
                    break;
                case 'lead':
                    $data =$checkScore['score']==0?20*0.95:$checkScore['score']*0.2;
                    break;
                case 'post':
                    $manageData = Manage::model()->findByPk($checkScore['uid']);
                    $data =$checkScore['score']==0?20*0.95:$checkScore['score']*0.2;
                    $data=$manageData['department']==19? 20:$data;
                    break;
                case 'kpi':
                    $data =$checkScore['score']==0?50*0.95:$checkScore['score']*0.5;
                    break;
                default:
                    $data =0;
                    break;
            }

        return $data;
    }


}