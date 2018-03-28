<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2015/7/31
 * Time: 13:07
 */
class Common
{
    /*
     * 积分设置
     * */
    //创建
    const CREDITS_CREATE=10;
    //加入我的用户池
    const CREDITS_ADD=10;
    //首次回复
    const CREDITS_REPLY_FIRST=10;
    //测试部门
    const CREDITS_REPLY_DEPARTMENT_TRUE=2;
    //其他部门
    const CREDITS_REPLY_DEPARTMENT_FALSE=2;
    //退回到公共业务池
    const CREDITS_ROLLBACK=1;
    /*积分设置结束*/
    /*
     * 生成时间数据
     * */
    public static function MinuteListData($minnum=1,$maxnum=60)
    {
        $data = array();
        for($_minute_i=$minnum;$_minute_i<=$maxnum;$_minute_i++)
        {
            $data[] = array("key" => $_minute_i, "value" => "{$_minute_i}分钟");
        }
        return $data;
    }
    /*
    * 取得两个日期相减
    * @before  较小的时间戳
    * @after 较大的时间戳
    * @return str 返回天数
    * */
    public static function datediffage($before, $after) {
        if ($before>$after) {
            $b = getdate($after);
            $a = getdate($before);
        }
        else {
            $b = getdate($before);
            $a = getdate($after);
        }
        $n = array(1=>31,2=>29,3=>31,4=>30,5=>31,6=>30,7=>31,8=>31,9=>30,10=>31,11=>30,12=>31);
        $y=$m=$d=0;
        if ($a['mday']>=$b['mday']) { //天相减为正
            if ($a['mon']>=$b['mon']) {//月相减为正
                $y=$a['year']-$b['year'];$m=$a['mon']-$b['mon'];
            }
            else { //月相减为负，借年
                $y=$a['year']-$b['year']-1;$m=$a['mon']-$b['mon']+12;
            }
            $d=$a['mday']-$b['mday'];
        }
        else {  //天相减为负，借月
            if ($a['mon']==1) { //1月，借年
                $y=$a['year']-$b['year']-1;$m=$a['mon']-$b['mon']+12;$d=$a['mday']-$b['mday']+$n[12];
            }
            else {
                if ($a['mon']==3) { //3月，判断闰年取得2月天数
                    $d=$a['mday']-$b['mday']+($a['year']%4==0?29:28);
                }
                else {
                    $d=$a['mday']-$b['mday']+$n[$a['mon']-1];
                }
                if ($a['mon']>=$b['mon']+1) { //借月后，月相减为正
                    $y=$a['year']-$b['year'];$m=$a['mon']-$b['mon']-1;
                }
                else { //借月后，月相减为负，借年
                    $y=$a['year']-$b['year']-1;$m=$a['mon']-$b['mon']+12-1;
                }
            }
        }
        if($m!=0){$d=$d+$m*30;}
        return $d;
    }
    /**
     * 清理字符串中的HTML标签、空格等多余信息
     * @param $str
     * @return mixed
     */
    public static function clearTags($str)
    {
        $str=str_replace(array("\r\n", "\r", "\n"), "", $str);
        $str=preg_replace('/\s+/','',$str);
        $str = str_replace(' ', '', strip_tags($str));
        $str = str_replace('&nbsp;', '', $str);
        $str = str_replace('~', '', $str);

        return $str;
    }
    /**
     * @param $url
     * @param $message
     */
    public static function redirect($url, $message)
    {
        Yii::app()->controller->redirect(array('/redirect/index', 'url' => $url, 'message' => $message));
        exit;
    }
}