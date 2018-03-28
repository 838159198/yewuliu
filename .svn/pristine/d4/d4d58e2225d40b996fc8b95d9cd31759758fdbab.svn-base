<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2015/7/30
 * Time: 15:18
 */
class Helper
{
    /*
     * 传入用户id返回带有链接的用户名
     * */
    public static function UserLinkName($id)
    {
        $model = new Manage();
        $data = $model->findByPk($id);
        if(empty($data))
        {
            return "---";
        }else{
            $name = $data->name;
            $uidlink=Yii::app()->createUrl("manage/AjaxDetail",array("id"=>$data['id']));

            return CHtml::link($name,"javascript:void()",array("data-url"=>$uidlink,"rel"=>"author"));
        }
    }
    /*
     * 格式化时间
     * @minute int 分钟
     * */
    public static function FormattingTime($minute)
    {
        $minute = intval($minute);
        if($minute<=0)
        {
            $data = "0分钟";
        }elseif($minute<60){
            $data = "{$minute}分钟";
        }elseif($minute>=60){
            //计算小时
            $hours = floor($minute/60);
            $_minute = $minute - $hours*60;
            if($_minute>0){
                $data = "{$hours}小时{$_minute}分";
            }else{
                $data = "{$hours}小时";
            }
        }
/*        elseif($minute>=1440){
            //计算天数
            $days = floor($minute/1440);
            $_minute = $minute - $days*1440;
            if($_minute>0){
                //计算小时
                $hours = floor($_minute/60);
                $_minute = $_minute-$hours*60;
                if($_minute>0){
                    $data = "{$days}天{$hours}小时{$_minute}分";
                }else{
                    $data = "{$days}天{$hours}小时";
                }
            }else{
                $data = "{$days}天";
            }
        }*/
        return $data;
    }
    /*
     * 格式化文件大小
     * $byte字节
     * kb kb
     * mb mb
     * */
    public static function FormattingSize($byte)
    {
        $byte = intval($byte);
        if($byte<1024)
        {
            $_data = "{$byte}字节";
        }elseif($byte>=1024 && $byte <1024*1024)
        {
            $kb = round($byte/1024,2);
            $_data = "{$kb}KB";
        }elseif($byte>=1024*1024 && $byte<1024*1024*1024)
        {
            $mb = round($byte/(1024*1024),2);
            $_data = "{$mb}MB";
        }else{
            $_data = "文件太大,{$byte}字节";
        }
        return $_data;
    }
}