<?php

class ApiController extends Controller
{

/*
* bat计划任务接口
* */
    public function actionCloseOperation()
    {
        //关闭所有用户已开启所有业务流
        $onoffDataAll = OperationOnoff::model()->findAll('status=1 and end_datetime=0');
        if(!empty($onoffDataAll))
        {
            $time = time();
            foreach($onoffDataAll as $key=>$val)
            {
                $developtime=ceil(($time-$val["start_datetime"])/60);
                OperationOnoff::model()->updateAll(array('status'=>'0','end_datetime'=>$time,'developtime'=>$developtime),'id=:id',array(":id"=>$val["id"]));
                OperationPost::model()->updateAll(array('cur_status'=>'0'),'id=:id',array(":id"=>$val["postid"]));
            }
        }
        //关闭所有用户已开启所有占用项目
        $spareDataAll = SpareTimeOnoff::model()->findAll('status=1 and end_datetime=0');
        if(!empty($spareDataAll))
        {
            $time = time();
            foreach($spareDataAll as $ke=>$va)
            {
                $developtime=ceil(($time-$va["start_datetime"])/60);
                SpareTimeOnoff::model()->updateAll(array('status'=>'0','end_datetime'=>$time,'developtime'=>$developtime),'id=:id',array(":id"=>$va["id"]));
            }
        }
    }

    /*
 * 客户端读取写入配置文件
 * */
    public function actionConfig()
    {
        $file=Yii::getPathOfAlias('webroot')."/uploads/config.ini";
        if(file_exists($file)===false)
        {
            fopen($file,"w");
        }
        //读取ini为array
        $count=parse_ini_file($file,true);
        //取最后一个key
        $last = end($count);
        $last_key = key($count);
        if(!empty($last_key))
        {
            echo $last_key;
        }
        else
        {
            echo "0";
        }


    }

}
