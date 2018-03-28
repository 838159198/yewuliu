/**
 * Created by Administrator on 2017/6/28.
 */
/**
 * 滑动div初始化函数
 * @wrap 所属顶层容器
 * @fn 点击后回调函数
 * @iframe 子页面加载
 * @url 提交的页面
 */
function loadSwitchBox(wrap, fn, iframe, url) {
    $(".switchBox").each(function() {
        var id = $(this).attr("id");
        var type = $(this).attr("typeId");
        createSlideDiv(id, type, fn);
    });
    loadDataInit(wrap, url, iframe);
}
/**
 *初始化数据
 *@wrap 顶层容器
 *@url 提交的页面
 *@iframe 加载子页面
 */
function loadDataInit(wrap, url, iframe) {
    var params = "";
    var url = url + "?";
    $(wrap).find('div[typeId]').each(function() {
        var param = $(this).attr('typeId') + "=" + $(this).attr('selVal');
        params += param + "&";
    });
    params = params.substring(0,params.length-1);
    url = url + params;
    //alert("初始化.."+ url);
    loadUrl(iframe, url);
}

/**
 *@iframe 加载内容页面
 *@url url
 */
function loadUrl(iframe, url) {
    $(iframe).attr('src', url);
}

/**
 * 创建一个滑动div容器
 * @wrapperId 容器ID
 * @type 切换标签的类型
 * @fnCallBack 回调函数
 */
function createSlideDiv(wrapperId, type, fnCallBack) {
    calTabWidth(wrapperId); //初始化容器宽度
    var $wraper = $('#' + wrapperId);
    //默认选中第一项
    var default_padding = 5;
    var default_BtnWidth = $wraper.find('.swichTxt').eq(0).width() + default_padding;
    var $switchBtn = $wraper.find('.switchBtn');
    $switchBtn.width(default_BtnWidth); //浮动按钮宽度
    $wraper.find('.swichTxt').eq(0).addClass('cur'); //设置选中选项
    $wraper.attr('selVal', $wraper.find('.swichTxt').eq(0).attr('id'));

    //添加click事件
    $wraper.find('.swichTxt').click(function() {
        var default_padding = 5;
        var newIndex = $(this).index(),
            oldIndex = $wraper.find('.cur').index(),
            curTxt = $(this).html(),
            eleWidth = $(this).width() + default_padding,
            value = $(this).attr('id');
        distant = -1;
        $wraper.attr('selVal', value);
        distant = moveWidth(wrapperId, oldIndex, newIndex); //计算滑动距离
        //回调函数参数 点击标签的类型 和 值
        var obj = {
            type: type,
            value: value
        };

        //左移动
        if (newIndex > oldIndex) {
            $wraper.find(".switchBtn").animate({
                'left': '+=' + distant + 'px'
            }, function() {
                $wraper.find('.curTxt').html(curTxt);
                $wraper.find("#switchBtn").width(eleWidth);
                //执行回调函数
                if ($.isFunction(fnCallBack)) fnCallBack(obj);
            });
            oldIndex = newIndex;
        } else if (newIndex < oldIndex) { //右移动
            $wraper.find(".switchBtn").animate({
                'left': '-=' + distant + 'px'
            }, function() {
                $(this).find('.curTxt').html(curTxt);
                $wraper.find(".switchBtn").width(eleWidth);
                //执行回调函数
                if ($.isFunction(fnCallBack)) fnCallBack(obj);
            });
            oldIndex = newIndex;
        }
        $wraper.find('.cur').removeClass('cur');
        $(this).addClass('cur');
    });
}

/**
 *计算容器宽度
 * @wrapperId 容器id
 */
function calTabWidth(wrapperId) {
    var $wraper = $('#' + wrapperId);
    var wrapperWidth = 0;
    var tdSpace = 18; //左右圆角宽度
    var oPadding = 5; //元素默认间距
    $wraper.find('.swichTxt').each(function(i) {
        wrapperWidth += $(this).outerWidth() + oPadding;
    });
    wrapperWidth = wrapperWidth + tdSpace;
    $wraper.width(wrapperWidth);
}

/**
 *计算按钮移动距离
 * @wrapperId 容器id
 * @oldIndex 之前选中的选项索引
 * @newIndex 当前点击选项索引
 */
function moveWidth(wrapperId, oldIndex, newIndex) {
    var $wraper = $('#' + wrapperId);
    var width = 0;
    //向右移动
    if (oldIndex < newIndex) {
        var $s_btn = $wraper.find(".switchBtn");
        var $a_btn = $wraper.find('.swichTxt').eq(newIndex - 1);
        //当前span左侧位置离左边的距离
        var curBtn = $s_btn.offset().left;
        //目标标签左侧位置离左边的距离
        var einA = $a_btn.offset().left;
        width = parseInt(einA - curBtn + 9); //?
    } else { //向左移动
        var $s_btn = $wraper.find(".switchBtn");
        var $a_btn = $wraper.find('.swichTxt').eq(newIndex - 1);
        //当前span左侧位置离左边的距离
        var curBtn = $s_btn.offset().left;
        //目标标签左侧位置离左边的距离
        var einA = $a_btn.offset().left;
        width = parseInt(curBtn - einA);
    }
    return width;
}
