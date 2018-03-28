<?php

class ActionScore extends CActiveRecord
{


    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{action_score}}';
    }

    public function rules()
    {
        return array(
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id', 'safe', 'on' => 'search'),
        );
    }
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'manages' => array(self::BELONGS_TO, 'Manage', 'uid'),
        );
    }
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
        );
    }

    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
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
                $data = "<span>个人行为考核</span>";
                break;
            case 'lead':
                $data = "<span>领导评价考核</span>";
                break;
            case 'post':
                $data = "<span>单项任务考核</span>";
                break;
            case 'kpi':
                $data = "<span>工作质量考核</span>";
                break;
            default:
                $data = "<span class=\"label label-default\">错误</span>";
                break;
        }
        return $data;
    }

    //添加考核项得分
    public static function addActionScore($uid,$mid,$score,$type,$content=''){
        $actionScore= new ActionScore() ;
        $actionScore->uid=$uid;
        $actionScore->mid=$mid;
        $actionScore->type=$type;
        $actionScore->score=$score;
        $actionScore->content=$content;
        $actionScore->createdatetime=date("Y-m-d H:i:s");
        $actionScore->createdate=date("Y-m");
        $actionScore->save();
    }
    //获取领导考核项内容
    public static function findContent($uid,$type,$date){
        $content='';
        $scoreModel=ActionScore::model()->find("uid=:uid and type=:type and createdate=:createdate",array(
            ":uid"=>$uid,":type"=>$type,":createdate"=>$date
        ));
        if($scoreModel){
            $content=$scoreModel->content;
        }
        return $content;
    }
    //判断是否已打分
    public static function check($uid,$type,$date){
        $check=false;
        $scoreModel=ActionScore::model()->find("uid=:uid and type=:type and createdate=:createdate",array(
            ":uid"=>$uid,":type"=>$type,":createdate"=>$date
        ));
        if($scoreModel){
            $check=true;
        }
        return $check;
    }

}