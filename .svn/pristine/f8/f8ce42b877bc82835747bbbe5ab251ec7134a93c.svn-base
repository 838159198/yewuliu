<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2015/8/20
 * Time: 9:43
 */
class CeshiController extends Controller
{
    public function actionIndex()
    {
        header('Content-Type: text/html;charset=gb2312');
        $ch = curl_init();
        //设置选项，包括URL
        curl_setopt($ch, CURLOPT_URL, "http://www.sogou.com/index.htm?pid=sogou-netb-38181d991caac98b-0010");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        //执行并获取HTML文档内容
        $output = curl_exec($ch);
        //释放curl句柄
        curl_close($ch);
        //转换成绝对路径
        $string = str_replace("=\"res","=\"http://www.sogou.com/res",$output);
        $string = str_replace("action=\"/sogou","action=\"http://www.sogou.com/sogou",$string);
        $ad_bottom ="<div style=\"position: relative; width:600px; height:120px;top:0px;margin:0 auto; margin-top:-300px;z-index: 999;\"><script type=\"text/javascript\">
			var sogou_ad_id=\"bottom_cubic1\";
			var sogou_ad_pid=\"sogou-netb-38181d991caac98b-0010\";
			var sogou_ad_width=600;
			var sogou_ad_height=120;
		</script><script type=\"text/javascript\" src=\"http://p.inte.sogou.com/add_index/js/c.compress.js\"></script></div>";
        $string = str_replace("</body>",$ad_bottom."</body>",$string);
        //打印获得的数据
        print_r($string);

        $pattern ='/<title>(.*?)<\/title>/';
        //$abc = preg_match_all($pattern, $output, $data); //将此页面的章节连接匹配出来
        //print_r($data);
        //var_dump($abc);
        //echo $data[1][0];
        preg_match($pattern, $output, $hehe);
        //var_dump($hehe);
        //$string = str_replace("你就知道","你也不一定知道",$hehe[1]);
        //echo $string;

    }
    private function actionA()
    {
        return "a";
    }
    protected function actionB()
    {
        return "b";
    }
    public function actionc()
    {
        echo $this->actionA();
        echo $this->actionB();
    }
    /*
     * 搜狗搜索
     * */
    public function actionSogou()
    {
        header('Content-Type: text/html;charset=gb2312');
        $key = "sogou-netb-38181d991caac98b-0010";
        $this->renderPartial("sogou",array("key"=>$key));
    }
}