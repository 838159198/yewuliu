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
class KpiCheck extends CActiveRecord
{
    public $name;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{kpi_check}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(

			array('id, uid,pid,beizhu,sum,score,createdate,month_id', 'safe', 'on'=>'search'),
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
            'projects' => array(self::BELONGS_TO, 'KpiProject', 'pid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'uid' => '创建人',
			'projectnum' => '项目数量',
			'createdatetime' => '日期',
			'createtime' => '日期',
            'weekid'=>'标题',
            'status'=>'状态',
            'statdatetime'=>'开始日期',
            'enddatetime'=>'结束日期',
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
		$criteria->compare('uid',$this->uid);

		$criteria->compare('svn',$this->createtime,true);

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

    public static function findByKpi(KpiCheck $kpiCheck){
        $score = 0; $num = 0;
        if($kpiCheck->projects->name == '业务流周工作总结提交') {//业务流周工作总结提交的自动扣分
            //获取指定月的开始，结束
            $start_time = date('Y-m-01', $kpiCheck['createdate']);
            $end_time = date('Y-m-d 18:00:00', strtotime(date('Y-m-01', $kpiCheck['createdate']) . ' +1 month -1 day'));
            $summaryProject = SummaryProject::model()->findAll("createdatetime>='{$start_time}' and createdatetime<='{$end_time}' and username='{$kpiCheck->manages->name}' and name='周工作总结'");
            if ($summaryProject) {
                $num = 0;
                $i = 0;// num 提交了几个周总结 i没按时提交的几个
                foreach ($summaryProject as $v) {
                    $num = $num + 1;//有几个工作总结
                    $time1 = $v->createdatetime;
                   //获取本周应该提交工作总结的规定时间
                    $weekid = $v->summary->weekid;
                    $summaryWeek=SummaryWeek::model()->findByPk($weekid);
                    //判断没有按时提交的个数
                    if (strtotime($time1) > strtotime($summaryWeek['submit_date'])) {
                        $i = $i + 1;
                    }
                }
                //获取本月应该提交工作总结的个数
                $kpiMonth=KpiMonth::model()->findByPk($kpiCheck->month_id);
                $weeks=$kpiMonth['weeks'];
                if ($num < $weeks) {
                    $score = ($weeks - $num) * 2;
                } else {
                    $score = 0;
                }
                $score = $score + $i;

            } else {
                $num = 0;
                $i = 0;// num 提交了几个周总结 i没按时提交的几个
                $score = 5;//索要扣得分数
            }
            if (in_array(Yii::app()->user->id, array(3))) {
                KpiCheck::noteLog($kpiCheck['id'], $kpiCheck['month_id'],$kpiCheck['uid'],$score);
            }
            $score = $score > 5 ? 5 : $score;
            $data=array("score"=>$score,"num"=>$num,"i"=>$i);
        }elseif($kpiCheck->projects->name == '业务流周工作总结创建'&& $kpiCheck->manages->department!=19 ) {
            $start_time = date('Y-m-01', $kpiCheck['createdate']);
            $end_time = date('Y-m-d 18:00:00', strtotime(date('Y-m-01', $kpiCheck['createdate']) . ' +1 month -1 day'));
            $summaryProject = SummaryProject::model()->findAll("createdatetime>='{$start_time}' and createdatetime<='{$end_time}' and username='{$kpiCheck->manages->name}' and name='周工作总结'");
            if ($summaryProject) {
                $i = 0;
                $num = 0;
                foreach ($summaryProject as $v) {
                    $num = $num + 1;//有几个工作总结
                    $remarks = $v->remarks;

                    if (strlen(trim($remarks)) < 20) {
                        $i = $i + 1;//有几个不满足条件
                    }
                }
                //获取本月应该提交工作总结的个数
                $kpiMonth=KpiMonth::model()->findByPk($kpiCheck->month_id);
                $weeks=$kpiMonth['weeks'];

                if ($num < $weeks) {
                    $score = ($weeks - $num) * 2;
                } else {
                    $score = 0;
                }
                $score = $score + $i;

            } else {
                $i = 0;
                $num = 0;
                $score = 3;//索要扣得分数
            }
            if (in_array(Yii::app()->user->id, array(3))) {
                KpiCheck::noteLog($kpiCheck['id'], $kpiCheck['month_id'],$kpiCheck['uid'],$score);
            }
            $score = $score + $i > 3 ? 3 : $score + $i;
            $data=array("score"=>$score,"num"=>$num,"i"=>$i);
        }elseif($kpiCheck->projects->name == '业务流周工作总结创建'&& $kpiCheck->manages->department==19 ) {
            $start_time = date('Y-m-01', $kpiCheck['createdate']);
            $end_time = date('Y-m-d 18:00:00', strtotime(date('Y-m-01', $kpiCheck['createdate']) . ' +1 month -1 day'));
            $summaryProject = SummaryProject::model()->findAll("createdatetime>='{$start_time}' and createdatetime<='{$end_time}' and username='{$kpiCheck->manages->name}' and name='周工作总结'");
            if ($summaryProject) {
                $i = 0;
                $num = 0;
                foreach ($summaryProject as $v) {
                    $num = $num + 1;//有几个工作总结
                    $remarks = $v->remarks;
                    if (strlen(trim($remarks)) < 20) {
                        $i = $i + 1;//有几个过于简化
                    }
                }
                //获取本月应该提交工作总结的个数
                $kpiMonth=KpiMonth::model()->findByPk($kpiCheck->month_id);
                $weeks=$kpiMonth['weeks'];
                if ($num < $weeks) {
                    $score = ($weeks - $num) * 2;
                } else {
                    $score = 0;
                }
                $score = $score + $i;

            } else {
                $i = 0;
                $num = 0;
                $score = 5;//索要扣得分数
            }
            if (in_array(Yii::app()->user->id, array(3))) {
                KpiCheck::noteLog($kpiCheck['id'], $kpiCheck['month_id'],$kpiCheck['uid'],$score);
            }
            $score = $score > 5 ? 5 : $score;
            $data=array("score"=>$score,"num"=>$num,"i"=>$i);
        }elseif($kpiCheck->projects->name == '业务流周总时长') {
            //获取本月应该提交工作总结的个数
            $kpiMonth=KpiMonth::model()->findByPk($kpiCheck->month_id);
            //获取本月考核的起始时间，截止时间
            $startdatetime=$kpiMonth->startdatetime;
            $enddatetime=$kpiMonth->enddatetime;
            $summaryWeeks = SummaryWeek::model()->findAll(array(
                'select'=>array('stattime','endtime','days'),
                'condition' => 'statdatetime>=:statdatetime AND enddatetime<=:enddatetime',
                'params' => array(':statdatetime'=>$startdatetime,':enddatetime' =>$enddatetime),
            ));
            if(isset($summaryWeeks)){
                $scores=array();
                foreach($summaryWeeks as $summaryWeek){
                    $week_developtime=0;
                    //1.计算本周业务流开启时间
                    $sql = "SELECT SUM(developtime/60)developtime FROM {{operation_onoff}} WHERE post_uid={$kpiCheck->uid} AND start_datetime>={$summaryWeek->stattime} AND end_datetime<={$summaryWeek->endtime}";
                    $result = yii::app()->db->createCommand($sql);
                    $query = $result->queryAll();
                    $week_developtime=$query[0]['developtime'];
                    //2.计算本周占用业务流项开启时间
                    $sql2 = "SELECT SUM(developtime/60)developtime FROM {{spare_timeonoff}} WHERE post_uid={$kpiCheck->uid} AND start_datetime>={$summaryWeek->stattime} AND end_datetime<={$summaryWeek->endtime}";
                    $result2 = yii::app()->db->createCommand($sql2);
                    $query2 = $result2->queryAll();
                    $week_developtime2=$query2[0]['developtime'];
                    //3.总的业务流周总时长
                    $week_developtime=round(($week_developtime + $week_developtime2), 1);
                    //4.规定的业务流时间
                    $week_time=$summaryWeek['days']*8-6;
                    if($week_time>$week_developtime){
                        $scores[]=$week_time-$week_developtime;
                    }else{
                        $scores[]=0;
                    }
                }
                if (in_array(Yii::app()->user->id, array(3))) {
                    KpiCheck::noteLog($kpiCheck['id'], $kpiCheck['month_id'],$kpiCheck['uid'],$score);
                }
                //本月总共扣分
                $score=array_sum($scores)>=5?5:array_sum($scores);
                $data=array("score"=>$score,"scores"=>$scores);
            }

        }elseif($kpiCheck->projects->name == '业务流任务完成率') {
            //获取本月考核的起始时间，截止时间
            $kpiMonth=KpiMonth::model()->findByPk($kpiCheck->month_id);
            $startdatetime=strtotime($kpiMonth->startdatetime);
            $enddatetime=strtotime($kpiMonth->enddatetime);
            $sql = "select DISTINCT postid  FROM {{operation_onoff}} where post_uid={$kpiCheck->uid} AND end_datetime>={$startdatetime} AND end_datetime<={$enddatetime}";
            $onoffs = Yii::app()->db->createCommand($sql)->queryAll();
            $score = 0;
            if (isset($onoffs)) {
                $estimate = 0;
                $stay_time = 0;
                $finish = 0;
                foreach ($onoffs as $v) {
                    $opps = OperationPost::model()->findAll("status=3 and id={$v['postid']} ");
                    if ($opps) {
                        foreach ($opps as $opp) {
                            if ($kpiCheck->manages->department == 19) {
                                $estimate = $estimate + $opp->test_estimate;
                            } else {
                                $estimate = $estimate + $opp->estimate;
                            }
                            $operationOnoffs = OperationOnoff::model()->findAll("postid={$opp->id} and post_uid={$kpiCheck->uid} ");
                            foreach ($operationOnoffs as $operationOnoff) {
                                //echo $opp->id.'-'.$operationOnoff->developtime.'<br>';
                                $stay_time = $stay_time + $operationOnoff->developtime;
                            }
                        }

                        if ($estimate > 0) {
                            $finish = round(($stay_time - $estimate) / $estimate, 2);//完成率
                        } else {
                            $finish = 0;
                        }

                        if ($finish > 0.4) {
                            $score = 20;
                        } elseif ($finish > 0.3 && $finish <= 0.4) {
                            $score = 10;
                        } elseif ($finish > 0.15 && $finish <= 0.3) {
                            $score = 5;
                        } else {
                            $score = 0;
                        }
                    }
                }
            } else {
                $finish = 0;
                $estimate = 0;
                $stay_time = 0;
            }
            if (in_array(Yii::app()->user->id, array(3))) {
                KpiCheck::noteLog($kpiCheck['id'], $kpiCheck['month_id'],$kpiCheck['uid'],$score);
            }
            $data=array("score"=>$score,"stay_time"=>$stay_time,"estimate"=>$estimate,"finish"=>$finish);
        }elseif($kpiCheck->projects->name == '业务流bug' && $kpiCheck->manages->department==19) {
            //获取本月考核的起始时间，截止时间
            $kpiMonth=KpiMonth::model()->findByPk($kpiCheck->month_id);
            $startdatetime=strtotime($kpiMonth->startdatetime);
            $enddatetime=strtotime($kpiMonth->enddatetime);
            $operationPosts = OperationPost::model()->findAll("status=3  and createdatetime>={$startdatetime} and enddatetime<={$enddatetime} and test_id={$kpiCheck['uid']}");
            $score = 0;
            if ($operationPosts) {
                foreach ($operationPosts as $operationPost) {
                    //查询最后一个回复的是否为测试部门
                    // $operationThread =OperationThread::model()->findAll("postid={$operationPost->id} and create_uid={$kpiCheck->uid}");
                    // if($operationThread){
                    //判断完成业务流的BUG n-严重 m-普通
                    $n = 0;
                    $m = 0;
                    $bugArray = explode(",", $operationPost->bug);
                    for ($i = 0; $i < count($bugArray); $i++) {
                        if ($bugArray[$i] == 1) {
                            $n = $n + 1;
                        }
                    }
                    $m = count($bugArray) - $n - 1;
                    $score1 = $n * 3 + $m;
                    $score = $score + $score1;
                    // }

                }
            } else {
                $score = 0;
            }
            if (in_array(Yii::app()->user->id, array(3))) {
               KpiCheck::noteLog($kpiCheck['id'], $kpiCheck['month_id'],$kpiCheck['uid'],$score);
            }
            $score = $score > 15 ? 15 : $score;
            $data=array("score"=>$score);
        }
        return $data;
    }

    //kpi考核记录
    private static function noteLog($check_id,$month_id,$uid,$score){
        $kpiLog=KpiLog::model()->find("check_id=:check_id and month_id=:month_id and uid=:uid",array(":check_id"=>$check_id,":month_id"=>$month_id,":uid"=>$uid));
        if($kpiLog){
            $kpiLog->score=$score;
            $kpiLog->datetime = time();
            $kpiLog->save();
        }else{
            $checkLogModel = new KpiLog();
            $checkLogModel->check_id =$check_id ;
            $checkLogModel->month_id =$month_id;
            $checkLogModel->uid =$uid ;
            $checkLogModel->mid = 0;
            $checkLogModel->score = $score;
            $checkLogModel->datetime = time();
            $checkLogModel->save();
        }
    }
}
