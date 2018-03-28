<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
    <title>搜狗搜索引擎 - 上网从搜狗开始</title>
    <!-- HTTP 1.1 -->
    <meta http-equiv="pragma" content="no-cache">
    <!-- HTTP 1.0 -->
    <meta http-equiv="cache-control" content="no-cache">
    <!-- Prevent caching at the proxy server -->
    <meta http-equiv="expires" content="0">
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9" />

    <link rel="shortcut icon" href="http://www.sogou.com/images/favicon.ico" type="image/x-icon">
    <link href="http://www.sogou.com/resourceforad/Index2.0/Big/css/style1.css" rel="stylesheet" type="text/css" />
    <!--link href="./Index2.0/Big/css/style.css" rel="stylesheet" type="text/css" /-->
    <script  type="text/javascript" language="javascript">

        var host_suv="http://test.hermes.sogou.com";
        var pbfile_suv="sa.gif";
        var img_src_idx = 0;
        function pingback(url)
        {
            var imaobj=new Image();
            imaobj.src=url;
        }
        function getcookie(l)
        {
            var m=new RegExp("(^| )"+l+"=([^;]*)(;|\x24)");
            var k=m.exec(document.cookie);
            if(k){return k[2]||""}return""
        }
        var time_suv=new Date().getTime();
        var url_suv=host_suv+"/"+pbfile_suv+"?suv="+getcookie("SUV")+"&time="+time_suv+"&old=0";
        pingback(url_suv);

        function load_body()
        {
        }

        function s(o, p, po)
        {
            var w = document.sf.query;
            var h = o.href;
            var q = encodeURIComponent(w.value);
            if (h.indexOf("kw=") > 0)
            {
                o.href = h.replace(new RegExp("kw=[^&$]*"), "kw=" + q);
            }
            else
            {
                if (h.indexOf("?") > 0)
                {
                    o.href += "&p=" + p + "&kw=" + q
                }
                else
                {
                    o.href += "?p=" + p + "&kw=" + q
                }
            }
            if(po && po.length > 0)
                o.href += "#" + po;
        }

        function random_show()
        {
            var r = Math.round(Math.random() *10);
            if (r < 3)
                return hotword;
            else if (r >=3 && r <7)
                return game;
            else
                return health;
        }
    </script>
    <script type="text/javascript" src="http://www.sogou.com/resourceforad/Index2.0/Common/js/words.js" charset="gb2312"></script>
    <script type="text/javascript" src="http://www.sogou.com/resourceforad/Index2.0/Big/js/fill_channel.0.0.0.12.js" charset="gb2312"></script>
    <script type="text/javascript" src="http://www.sogou.com/resourceforad/Index2.0/Big/js/pargs.js" charset="gb2312"></script>
    <script type="text/javascript" src="http://p.inte.sogou.com/add_index/index2_js/index2_img_word.js" charset="gb2312"></script>
</head>

<script  type="text/javascript" language="javascript">
    var current = new Date().getTime();
    //var N = "sogou-plmm-e70f1387dcd29270-8782";
    var N = "<?php echo $key;?>";
    if(new RegExp('pid=([^&]+)').test(location.search)) N = decodeURIComponent(RegExp.$1);

    var hotword = 0;
    var game = 1;
    var health = 2;
    var biz = 3;
    var travel = 4;
    var shop = 5;

    var channel_row = 7;
    var channel_col = 3;
    var version = 2;

    var show_channel = random_show();
</script>

<body onload="load_body()">
<div id="wrap">
<div class="outer">
<!-- part1 -->
<div class="logo-box">
    <span></span>
</div>
<div class="s-word-top">
    <a onclick="s(this,'40030300')" href="http://news.sogou.com">新闻</a> <strong>网页</strong>
    <a onclick="s(this,'73141200')" href="http://weixin.sogou.com/">微信</a>
    <a onclick="cid(this,'web2ww')" href="http://wenwen.sogou.com/">问问</a>
    <a onclick="s(this,'40030500')" href="http://pic.sogou.com">图片</a>
    <a onclick="s(this,'40030600')" href="http://v.sogou.com/">视频</a>
    <a onclick="s(this,'40030200')" href="http://mp3.sogou.com">音乐</a>
    <a onclick="s(this,'40031000')" href="http://map.sogou.com">地图</a>
    <a onclick="s(this,'40031500')" href="http://gouwu.sogou.com/">购物</a>
    <a href="http://www.sogou.com/docs/more.htm" onclick="s(this,'40031204&amp;v=1')">更多&gt;&gt;</a>
</div>
<div class="s-form">
    <form action="http://www.sogou.com/sogou" name="sf" id="sf" onsubmit="if(N){document.getElementById('pid').value=N;}if(document.getElementById('query').value==''){this.action='http://www.sogou.com/index.htm';}document.getElementById('_ast').value=Math.round(new Date().getTime()/1000);return true;" target="_top">
        <span class="s-input-box"><input type="text" name="query" class="" id="query" size="47" maxlength="100" autocomplete="off"></span>
        <span class="s-btn-enter"><input type="submit" value="" id="stb" onclick="return&quot;&quot;==this.form.query.value?!1:void 0" onmouseover="this.className=&quot;search-btn-hover&quot;" onmousedown="this.className=&quot;search-btn-active&quot;" onmouseup="this.className=&quot;search-btn-hover&quot;" onmouseout="this.className=&quot;&quot;" class=""></span>
        <input type="hidden" name="_asf" value="www.sogou.com">
        <input type="hidden" name="_ast">
        <input type="hidden" name="w">
        <script>document.write('<input type=hidden name=p value=' + parg_search_bar + '>');</script>
        <input type="hidden" name=pid id=pid value="<?php echo $key?>">
    </form>
</div>
<!--part2-->
<div class="ad-main" style="dispaly:none" >
    <div class="ad-horizon-list">
        <div id="link_top" style="height:19px">
            <script type="text/javascript">
                var sogou_ad_id="link4";
                var sogou_ad_pid=N
                var sogou_ad_width=650;
                var sogou_ad_height=30;
                var is_sogou_index=1;
            </script>
            <script type="text/javascript" src="http://p.inte.sogou.com/add_index/js/c.compress.js">
            </script>
        </div>
    </div>
    <div class="ad-tab-box">
        <ul class="tab-nav" id="tabNav">
            <li class="">热点</li>
            <li class="">游戏</li>
            <li class="">健康</li>
            <li class="">商业</li>
            <li class="">旅游</li>
            <li class="" style="margin-right:0;">购物</li>
        </ul>
        <div id="tabCon">
            <div class="tab-con" id="hotword">
                <script type="text/javascript">
                    var content = fill_channel(hotword, channel_col, channel_row, N);
                    document.write(content);
                </script>
            </div>

            <div class="tab-con" id="game">
                <script type="text/javascript">
                    var content = fill_channel(game, channel_col, channel_row, N);
                    document.write(content);
                </script>
            </div>

            <div class="tab-con" id="health">
                <script type="text/javascript">
                    var content = fill_channel(health, channel_col, channel_row, N);
                    document.write(content);
                </script>
            </div>

            <div class="tab-con" id="biz">
                <script type="text/javascript">
                    var content = fill_channel(biz, channel_col, channel_row, N);
                    document.write(content);
                </script>
            </div>

            <div class="tab-con" id="travel">
                <script type="text/javascript">
                    var content = fill_channel(travel, channel_col, channel_row, N);
                    document.write(content);
                </script>
            </div>

            <div class="tab-con" id="shop">
                <script type="text/javascript">
                    var content = fill_channel(shop, channel_col, channel_row, N);
                    document.write(content);
                </script>
            </div>

        </div><!--end tab-con-->
    </div><!--end ad-box-->
</div>



<!-- part2 -->
<script type="text/javascript">
    window.onload = function() {
        var pvimg = new Image();
        var uigsimg = new Image();
        var w = document.sf.query;
        w.focus();
        if (new RegExp("kw=([^&]+)").test(location.search))
        {
            if (w.value.length == 0)
                w.value = decodeURIComponent(RegExp.$1)
        }
        var c = Math.round((new Date().getTime() + Math.random()) * 1000);
        with(document)
        {
            if (cookie.indexOf("SUV=") < 0)
                cookie = "SUV=" + c + ";path=/;expires=Sun, 29 July 2026 00:00:00 UTC;domain=sogou.com"
            current = new Date().getTime() - current;
            pvimg.src = "http://pv.sogou.com/pv.gif?t?=" + c + "?r?=" + referrer;
            uigsimg.src = "http://pb.sogou.com/pv.gif?uigs_productid=web&abtest=4&uigs_t=" + c + "&uigs_loadtime=" + current + "&uigs_refer="+referrer;
        }

        var wrap = document.getElementById("wrap"),
            b = document.body;

        if (window.navigator.userAgent.indexOf("MSIE 8.0") > 0) {
            b.className = "ie8";
        }

        if (window.navigator.userAgent.indexOf("MSIE 7.0") > 0) {
            b.className = "ie7";
        }

        function screenOffset() {
            var bodyWidth = document.documentElement.clientWidth;
            if (window.navigator.userAgent.indexOf("MSIE 6.0") > 0 && bodyWidth < 1200 ) {
                wrap.className = "ie6";
            } else {
                wrap.className = "";
            }
        };
        window.onresize = screenOffset;
        screenOffset();

        // TAB
        var tabNav = document.getElementById("tabNav"),
            tabLi = tabNav.children,
            tabLiLen = tabLi.length,
            tabCon = document.getElementById("tabCon"),
            tabConS = tabCon.children;

        for (var i = 0; i < tabLiLen; i++) {
            (function(index) {
                tabLi[index].onmouseover = function() {
                    for (var i = 0; i < tabLiLen; i++) {
                        tabLi[i].className = "";
                        tabConS[i].style.display = "none";
                    };
                    tabLi[index].className = "tab-cur";
                    tabConS[index].style.display = "block";
                }
            })(i);
        };

        (function() {
            for (var i = 0; i < tabLiLen; i++) {
                tabLi[i].className = "";
                tabConS[i].style.display = "none";
            };
            tabLi[show_channel].className = "tab-cur";
            tabConS[show_channel].style.display = "block";
        })();
    }
</script>
<script type="text/javascript" src="http://www.sogou.com/resourceforad/Index2.0/Common/js/pbindex.js"></script>

<div id="hot" style="display:none">
    <script type="text/javascript" defer>
        var sogou_is_one = new Object();
        if (N) sogou_is_one["pid"] = N;
        sogou_is_one["charset"] = 'gb2312';
        sogou_is_one["max_len"] = '300';
        sogou_is_one["lines"] = '3';
        sogou_is_one["sohuurl"] = document.location.href;
        sogou_is_one["iw1"] = '200';
        sogou_is_one["type"] = '2';
        sogou_is_one["ih1"] = '100';
        function q(s)
        {
            return s.replace(/%/g, "%25").replace(/&/g, "%26").replace(/#/g, "%23");
        }
        var sogou_is_one_url = "http://extend.brand.sogou.com/get_word";
        var one_cnt = 0;
        for (var p in sogou_is_one)
        {
            sogou_is_one_url += (one_cnt++?"&": "?") + q(p) + "=" + q(sogou_is_one[p]);
        }

        var scriptobj=document.createElement("script");
        scriptobj.type="text/javascript";
        //scriptobj.src=sogou_is_one_url;
        scriptobj.src = "http://extend.brand.sogou.com/index.htm?v=1&in=1&s=ext&pid=" + N;

        document.getElementById("hot").appendChild(scriptobj);
        window.setTimeout(getextendata, 3000);
        function getextendata(){
            return false;
        }
    </script>
</div>

<!--
<script>
        var SugPara = {
            "enableSug": true,
            "sugType": "web",
            "sugFormName": "sf",
            "inputid": "query",
            "submitId": "stb",
            "suggestRid": "01015000",
            "normalRid": "01019901",
            "useParent": 1
        };
    </script>
    <script type="text/javascript" src="js/sugg_ajaj.v.4.0.js">
    </script>
    -->
<script>
    var uigs_para = {
        "uigs_productid": "webapp",
        "type": "webindex",
        "uigs_pbtag": "A",
        "uigs_cookie": "SUID",
        "abtestid": "0",
        'scrnwi': screen.width,
        'scrnhi': screen.height,
        'pid': N || 'null'
    };
</script>
<script type="text/javascript" src="http://www.sogou.com/resourceforad/Index2.0/Common/js/pb_v.0.0.js">
</script>
<script>
    var makecon = function() {
        try {
            window.external.metasearch('make_connection', 'www.google.com.hk');
        } catch(e) {}
    };
    var msBrowserName = navigator.userAgent.toLowerCase();
    var msIsSe = false;
    var msIsMSearch = false;
    if (/se 2\.x/i.test(msBrowserName)) {
        msIsSe = true;
    }
    if (/metasr/i.test(msBrowserName)) {
        msIsMSearch = true;
    }
    var queryinput = document.getElementById('query');
    if (queryinput) {
        if (msIsSe && msIsMSearch) {
            if (queryinput.addEventListener) {
                queryinput.addEventListener('keypress', makecon, false);
                queryinput.addEventListener('keydown', makecon, false);
            } else if (queryinput.attachEvent) {
                queryinput.attachEvent('onkeypress', makecon);
                queryinput.attachEvent('onkeydown', makecon);
            } else {
                queryinput.onkeypress = makecon;
                queryinput.onkeydown = makecon;
            }
        }
    }
</script>
<script>
    var fSugPara={
        oms:1,"domain":"w.sugg.sogou.com","inputid":"floatquery", "suggestRid":"04023000", "normalRid":"04023100", "useParent":1
    };
</script>
<!--script src="http://www.sogou.com/suggnew/hotwords?v=1438247677723"></script-->
<script type="text/javascript" charset="gbk" src="http://dl.web.sogoucdn.com/common/lib/jquery/jquery-1.11.0.min.js"></script>
<script type="text/javascript" charset="gbk" src="http://www.sogou.com/js/sugg_new.v.47.js"></script>
<!--link href="http://www.sogou.com/sug/css/m3.v.26.css" rel="stylesheet" type="text/css" /-->
<!--end div id="hot"-->
<!--底部广告ad-->
<div style="position: relative; width:600px; height:120px;top:0px;margin:0 auto; margin-top:0px;z-index: 999;">
    <script type="text/javascript">
    var sogou_ad_id="bottom_cubic1";
    var sogou_ad_pid=N;
    var sogou_ad_width=600;
    var sogou_ad_height=120;
</script>
    <script type="text/javascript" src="http://p.inte.sogou.com/add_index/js/c.compress.js"></script>
</div>
<!--底部结束-->
<!-- part3 -->
<div id="ft">
    <a href="http://corp.sogou.com/" target="_blank">关于搜狗</a>
    <a href="http://www.sogou.com/docs/terms.htm?v=1" target="_blank">免责声明</a>
    <a href="http://fankui.help.sogou.com/index.php/web/web/index/type/4" target="_blank">意见反馈</a>
    <br>&nbsp;&nbsp;
    &copy;
    <script type="text/javascript" src="http://www.sogou.com/websearch/features/year.jsp"></script>
    &nbsp;SOGOU&nbsp;-&nbsp;
    <a href="http://www.miibeian.gov.cn" target="_blank" class="g">京ICP证050897号</a>
    &nbsp;-&nbsp;京公网安备1100<span class="ba">00000025号</span>
</div>
</div><!-- end div class="outer"-->
<div class="ad-lr-wrap">
    <div class="ad-left-side">
        <script type="text/javascript">
            var sogou_ad_id="left_cubic3";
            var sogou_ad_pid=N
            var sogou_ad_width=140;
            var sogou_ad_height=360;
            var is_sogou_index=1;
        </script>
        <script type="text/javascript" src="http://p.inte.sogou.com/add_index/js/c.compress.js">
        </script>
        &nbsp;
    </div>
    <div class="ad-right-side">
        <div id="todo_left3" style="float:right">
            <script type="text/javascript">
                var sogou_ad_id="right_cubic3";
                var sogou_ad_pid=N
                var sogou_ad_width=140;
                var sogou_ad_height=360;
                var is_sogou_index=1;
            </script>
            <script type="text/javascript" src="http://p.inte.sogou.com/add_index/js/c.compress.js">
            </script>
        </div>
    </div>
</div>
</div> <!-- end div id="wrap" -->
</body>
</html>