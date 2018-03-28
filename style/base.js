jQuery(document).ready(function () {
    //头像提示会员信息
    $('[rel=author]').popover({
        trigger : 'manual',
        container: 'body',
        html : true,
        placement: 'auto right',
        content : '<div class="popover-user"></div>',
    }).on('mouseenter', function(){
        var _this = this;
        $(this).popover('show');
        $.ajax({
            url: $(this).attr('data-url'),
            success: function(html){
                $('.popover-user').html(html);
                $('.popover .btn-success, .popover .btn-danger').click(function(){
                    $.ajax({
                        url: $(this).attr('href'),
                        success: function(data) {
                            $('.popover .btn-success').text('关注成功').addClass('disabled');
                            $('.popover .btn-danger').text('取消成功').addClass('disabled');
                        },
                        error: function (XMLHttpRequest, textStatus) {
                            $(_this).popover('hide');
                            //$('#modal').modal({ remote: '/login'});
                            this.abort();
                        }
                    });
                    return false;
                });
            }
        });
        $('.popover').on('mouseleave', function () {
            $(_this).popover('hide');
        });
    }).on('mouseleave', function () {
        var _this = this;
        setTimeout(function () {
            if(!$('.popover:hover').length) {
                $(_this).popover('hide')
            }
        }, 100);
    });

});
//bug等级选择
function changeBug(){
    //alert(666);
    var id =$("#bug").attr("val");
    var bug=$("#bug").val();
    $.ajax({
        type:"POST",
        url:"/operation/default/changeBug",
        data:{id:id,bug:bug},
        datatype: "json",
        success:function(data){
            var jsonStr = eval("("+data+")");
            if(jsonStr.status==403){
                alert(jsonStr.message);
                return false;
            }else if(jsonStr.status==200){
                alert(jsonStr.message);
                location.replace(location.href);
            }else{
                alert("发生错误"+jsonStr.status);
                return false;
            }
        },
        error: function(){
            alert("未知错误");
        }
    });

}
//回复消息时提示信息
function ReplyThreadTips()
{
    var _hours = $("#OperationThread_hours").val();
    var _minute = $("#OperationThread_minute").find("option:selected").text();
    var _postuid = $("#OperationThread_post_uid").val();

    var _content =  $("#OperationThread_content").val();
/*    if(_hours==''){
        alert("请填写开发周期（小时）");
        return false;
    }
    if(_minute==""){
        alert("请选择开发周期（分钟）");
        return false;
    }*/
    if(_postuid==""){
        alert("请选择接收人");
        return false;
    }
    if(_content==""){
        alert("请填写回复内容");
        return false;
    }
    if(window.confirm('你确定要发布消息吗？')){
        //alert("确定");
        return true;
    }else{
        //alert("取消");
        return false;
    }
    //return true;
}
/****
 *
 * 加入我的业务池
 *
****/

function addOperationTips(id)
{
    var _id = id;
    var _url="/operation/default/Addtips?id="+_id;
    $('#addOperationCart').removeData("bs.modal");
    $("#addOperationCart").modal({remote: _url});

};

function AddOperationCart(id)
{
    var _hours = $("#add_tips_hours").val();
    var _minute = $("#add_tips_minute").val();
    var _postid = id;
    if(_hours!==""){
        if(isNaN(_hours)){
            alert("预估时间（小时）必须为数字");
            return false;
        }
        if(_hours>=100){
            alert("预估时间（小时）必须小于100小时");
            return false;
        }
    }else{
        _hours=0;
    }
    if(_minute!=="")
    {
        if(isNaN(_minute)){
            alert("预估时间（分）必须为数字");
            return false;
        }
    }else{
        _minute=0;
    }
    //if(_minute==""&&_hours==""){
    //    alert("预估时间，小时和分钟必须填一项");
    //    return false;
    //}
    $.ajax({
        type:"POST",
        url:"/operation/default/add",
        data:{id:_postid,minute:_minute,hours:_hours},
        datatype: "json",
        success:function(data){
            var jsonStr = eval("("+data+")");
            if(jsonStr.status==404){
                alert(jsonStr.message);
                return false;
            }else if(jsonStr.status==200){
                alert("成功加入到我的业务池");
                location.replace(location.href);
            }else{
                alert("发生错误"+jsonStr.status);
                return false;
            }
        },
        error: function(){
            alert("未知错误");
        }
    });

};
//弹出请假记录
function leave()
{
    //alert(666);
    var _url="/operation/my/leave";
    $('#tt_leave').removeData("bs.modal");
    $("#tt_leave").modal({remote: _url});
}
//添加请假记录
function leaveNote(){
    //alert(666);
    var dates_start = $("#dates_start").val();
    var dates_end = $("#dates_end").val();
    var _hours = $("#leave_hours").val();
    var _minute = $("#leave_minute").val();
    var content = $("#leave_content").val();
    if(dates_start==''){
        alert("请填写开始日期");
        return false;
    }
    if(dates_end==''){
        alert("请填写结束日期");
        return false;
    }
    if(_hours!==""){
        if(isNaN(_hours)){
            alert("请假时长（小时）必须为数字");
            return false;
        }

    }else{
        _hours=0;
    }
    if(_minute!=="")
    {
        if(isNaN(_minute)){
            alert("请假时长（分）必须为数字");
            return false;
        }
    }else{
        _minute=0;
    }
    if(_minute==""&&_hours==""){
        alert("请假时长，小时和分钟必须填一项");
        return false;
    }
    $.ajax({
        type:"POST",
        url:"/operation/my/addLeave",
        data:{dates_start:dates_start,dates_end:dates_end,minute:_minute,hours:_hours,content:content},
        datatype: "json",
        success:function(data){
            var jsonStr = eval("("+data+")");
            if(jsonStr.status==200){
                alert(jsonStr.message);
               window.location.href='/operation/my/underway?status=2';
            }
        },error: function(msg){
            alert("未知错误");
        }
    });
}
//打开预计时间页面
function tttt(id)
{
    var _id = id;
    var _url="/operation/default/update?id="+_id;
    $('#tt').removeData("bs.modal");
    $("#tt").modal({remote: _url});

};
//修改预计时间
function updateOperationTime(id){
    //alert(666);
    var _hours = $("#add_tips_hours").val();
    var _minute = $("#add_tips_minute").val();
    var _postid = id;
    if(_hours!==""){
        if(isNaN(_hours)){
            alert("预估时间（小时）必须为数字");
            return false;
        }
        if(_hours>=100){
            alert("预估时间（小时）必须小于100小时");
            return false;
        }
    }else{
        _hours=0;
    }
    if(_minute!=="")
    {
        if(isNaN(_minute)){
            alert("预估时间（分）必须为数字");
            return false;
        }
    }else{
        _minute=0;
    }
    if(_minute==""&&_hours==""){
        alert("预估时间，小时和分钟必须填一项");
        return false;
    }
    $.ajax({
        type:"POST",
        url:"/operation/default/edit",
        data:{id:_postid,minute:_minute,hours:_hours},
        datatype: "json",
        success:function(data){
            var jsonStr = eval("("+data+")");
            if(jsonStr.status==200){
                alert(jsonStr.message);
                window.location.href='/operation/default/detail?id='+id;
            }
    },error: function(msg){
            alert("未知错误");
        }
    });
}
/*
* 结束业务流
* */
function closeOperation(id)
{
    if(window.confirm('你确定要结束业务吗？')){
        var id = id;
        //判断回复是否为空
        var _content =  $("#OperationThread_content").val();

        if(_content==""){
            alert("请填写回复内容");
            return false;
        }

        $.ajax({
            type:"POST",
            url:"/operation/default/close",
            data:{id:id,content:_content},
            datatype: "json",
            success:function(data){
                var jsonStr = eval("("+data+")");
                if(jsonStr.status==403){
                    alert(jsonStr.message);
                    return false;
                }else if(jsonStr.status==200){
                    alert(jsonStr.message);
                    location.replace(location.href);
                }else{
                    alert("发生错误"+jsonStr.status);
                    return false;
                }
            },
            error: function(){
                alert("未知错误");
            }
        });
    }else{
        //alert("取消");
        return false;
    }
}
/*
 * 暂停业务流
 * */
function stopOperation(id)
{
    if(window.confirm('你确定要暂停业务吗？')){
        var id = id;
        $.ajax({
            type:"POST",
            url:"/operation/default/stop",
            data:{id:id},
            datatype: "json",
            success:function(data){
                var jsonStr = eval("("+data+")");
                if(jsonStr.status==403){
                    alert(jsonStr.message);
                    return false;
                }else if(jsonStr.status==200){
                    alert(jsonStr.message);
                    location.replace(location.href);
                }else{
                    alert("发生错误"+jsonStr.status);
                    return false;
                }
            },
            error: function(){
                alert("未知错误");
            }
        });
    }else{
        //alert("取消");
        return false;
    }
}
/*
 * 重启业务流
 * */
function restartOperation(id)
{
    if(window.confirm('你确定要重启业务吗？')){
        var id = id;
        $.ajax({
            type:"POST",
            url:"/operation/default/restart",
            data:{id:id},
            datatype: "json",
            success:function(data){
                var jsonStr = eval("("+data+")");
                if(jsonStr.status==403){
                    alert(jsonStr.message);
                    return false;
                }else if(jsonStr.status==200){
                    alert(jsonStr.message);
                    location.replace(location.href);
                }else{
                    alert("发生错误"+jsonStr.status);
                    return false;
                }
            },
            error: function(){
                alert("未知错误");
            }
        });
    }else{
        //alert("取消");
        return false;
    }
}
/****
 *
 * 退回到公共业务池
 *
 ****/

function rollbackTips(id)
{
    var _id = id;
    var _url="/operation/default/rollbackTips?id="+_id;
    $('#modalTips').removeData("bs.modal");
    $("#modalTips").modal({remote: _url});
};
function operationRollback(id)
{
    var _rollback_content = $("#rollback_content").val();
    var _postid = id;
    if(_rollback_content==""){
        alert("请填写退回理由");
        return false;
    }
    if(_rollback_content.length<2)
    {
        alert("退回理由不可少于2个字符");
        return false;
    }
    if(_rollback_content.length>100)
    {
        alert("退回理由少写点，不能超过100字符");
        return false;
    }
    $.ajax({
        type:"POST",
        url:"/operation/default/rollback",
        data:{id:_postid,rollback_content:_rollback_content},
        datatype: "json",
        success:function(data){
            var jsonStr = eval("("+data+")");
            if(jsonStr.status==404){
                alert(jsonStr.message);
                return false;
            }else if(jsonStr.status==200){
                alert(jsonStr.message);
                location.replace(location.href);
            }else{
                alert("发生错误"+jsonStr.status);
                return false;
            }
        },
        error: function(){
            alert("未知错误");
        }
    });

};
/*
* 生成版本号
* 2015年8月6日14:08:12
* */
function createVersionTips(id)
{
    var _id = id;
    var _url="/operation/version/create?postid="+_id;
    $('#modalTips').removeData("bs.modal");
    $("#modalTips").modal({remote: _url});
}
function createVersion(id)
{
    var categoryid = jQuery("#category").val();
    var businessid = jQuery("#business").val();
    var _postid = id;
    $.ajax({
        type:"POST",
        url:"/operation/version/ajaxCreate",
        data:{id:_postid,categoryid:categoryid,businessid:businessid},
        datatype: "json",
        success:function(data){
            var jsonStr = eval("("+data+")");
            if(jsonStr.status==400){
                alert(jsonStr.message);
                return false;
            }else if(jsonStr.status==200){
                alert(jsonStr.message);
                location.replace(location.href);
            }else{
                alert("发生错误"+jsonStr.status);
                return false;
            }
        },
        error: function(){
            alert("未知错误");
        }
    });
}
/*
 * 业务开关
 * */
function curStatus(id,status)
{
    var _postid = id;
    var _status = status;
    $("#cur_status_"+_postid).html("正在处理...");
    $("#status_"+_postid).removeAttr("href");

    $.ajax({
        type:"POST",
        url:"/operation/default/ajaxCurstatus",
        data:{id:_postid,status:_status},
        datatype: "json",
        success:function(data){
            var jsonStr = eval("("+data+")");
            if(jsonStr.status==400){
                alert(jsonStr.message);
                location.replace(location.href);
            }else if(jsonStr.status==200){
                alert(jsonStr.message);
                location.replace(location.href);
            }else{
                alert("发生错误"+jsonStr.status);
                location.replace(location.href);
            }
        },
        error: function(){
            alert("未知错误");
        }
    });
}

function BusinessCreate()
{
    var name = $("#business_name").val();
    if(name==""){
        alert("请填写业务名称");
        return false;
    }
    if(name.length<2)
    {
        alert("业务名称不能少于2个字符");
        return false;
    }
    if(name.length>50)
    {
        alert("业务名称不能大于50个字符");
        return false;
    }
    $.ajax({
        type:"POST",
        url:"/operation/version/ajaxBusinessCreate",
        data:{name:name},
        datatype: "json",
        success:function(data){
            var jsonStr = eval("("+data+")");
            if(jsonStr.status==400){
                alert(jsonStr.message);
                return false;
            }else if(jsonStr.status==200){
                alert(jsonStr.message);
                $("#business").append("<option value=\""+jsonStr.id+"\" selected>"+jsonStr.name+"</option>");
            }else{
                alert("发生错误"+jsonStr.status);
                return false;
            }
        },
        error: function(){
            alert("未知错误");
        }
    });
}
function testManageDialog(keyname)
{
    var _url="/operation/manage/testListDialog?keyname="+keyname;
    $('#modaldiglog').removeData("bs.modal");
    $("#modaldiglog").modal({remote: _url});
}
function createTestProject(){

    var  num = $("#testProjeNum").val();
    if(num == '' || num == null){
        num = 0;
    }
    var  add_num = num*1+1;
    var  testProject = "<div class=\"rowBottom\" id="+add_num+"><div class=\"input-group\"><input class=\"form-control\" name=\"OperationTest[project][]\" id=\"OperationTest_project\" type=\"text\" /><span class=\"input-group-btn\"><button class=\"btn btn-danger\" type=\"button\" onclick=\"delTestProject("+add_num+")\">删除</button></span></div></div>";
    $("#testProjeNum").val(add_num);
    $("#testLog").append(testProject);
}
function delTestProject(id){
    id = "#"+id;
    $(id).remove();

}
/*模板创建*/
function createTestTemplateProject(){

    var  num = $("#testProjeNum").val();
    if(num == '' || num == null){
        num = 0;
    }
    var  add_num = num*1+1;
    var  testProject = "<div class=\"rowBottom\" id="+add_num+"><div class=\"input-group\"><input class=\"form-control\" name=\"OperationTestTemplate[test_project][]\" id=\"OperationTestTemplate_test_project\" type=\"text\" /><span class=\"input-group-btn\"><button class=\"btn btn-danger\" type=\"button\" onclick=\"delTestProject("+add_num+")\">删除</button></span></div></div>";
    $("#testProjeNum").val(add_num);
    $("#testLog").append(testProject);
}
function delTestTemplateProject(id){
    id = "#"+id;
    $(id).remove();

}
/*搜索模板*/
function testTemplateSearch(id)
{
    var _id = id;
    var keyword = $("#search_keyword").val();
    var _url="/operation/test/TemplateSearchDataList?postid="+_id+"&keyword="+keyword;
    $('#modaldiglog').removeData("bs.modal");
    $("#modaldiglog").modal({remote: _url});
}
/*
* 增加测试项目弹出窗口
* */
function testProjectModalDialog(id)
{
    var _url="/operation/test/testProjectModalDialog?id="+id;
    $('#modaldialog').removeData("bs.modal");
    $("#modaldialog").modal({remote: _url});
}
/*
* 接收内容
* */
function testProjectModalDialogAdd(id)
{
    var _project = $("#project").val();
    var _postid = id;

    if(_project=="")
    {
        alert("请填写测试项目内容");
        return false;
    }
    $.ajax({
        type:"POST",
        url:"/operation/test/testProjectModalDialogSave",
        data:{id:id,project:_project},
        datatype: "json",

        success:function(data){
            var jsonStr = eval("("+data+")");
            if(jsonStr.status==404){
                alert(jsonStr.message);
                return false;
            }else if(jsonStr.status==200){
                alert(jsonStr.message);
                location.replace(location.href);
            }else{
                alert("发生错误");
                return false;
            }
        },

        error: function(){
            alert("未知错误");
        }
    });
}
function testProjectBtnStatus(id)
{
    $.ajax({
        type:"POST",
        url:"/operation/test/testProjectBtnStatus",
        data:{id:id},
        datatype: "json",
        success:function(data){
            var jsonStr = eval("("+data+")");
            if(jsonStr.status==404){
                alert(jsonStr.message);
                return false;
            }else if(jsonStr.status==200){
                if(jsonStr.type==1){
                    $("#projectbtn"+id).attr("class", "btn btn-success");
                    $("#projectbtn"+id).val(jsonStr.value);
                }else if(jsonStr.type==0){
                    $("#projectbtn"+id).attr("class", "btn btn-danger");
                    $("#projectbtn"+id).val(jsonStr.value);
                    //$("#projectbtn"+id).innerHTML += jsonStr.value;
                }else{
                    alert("好像出错啦");
                    return false;
                }
            }else{
                alert("发生错误");
                return false;
            }
        },
        error: function(){
            alert("未知错误");
        }
    });
}
function testPass(id)
{
    if(window.confirm('你确定要修改状态为全部测试通过吗？')){
        $.ajax({
            type:"POST",
            url:"/operation/test/testPass",
            data:{id:id},
            datatype: "json",
            success:function(data){
                var jsonStr = eval("("+data+")");
                if(jsonStr.status==404){
                    alert(jsonStr.message);
                    return false;
                }else if(jsonStr.status==200){
                    alert(jsonStr.message);
                    location.replace(location.href);
                }else{
                    alert("发生错误");
                    return false;
                }
            },
            error: function(){
                alert("未知错误");
            }
        });
    }else{
        //alert("取消");
        return false;
    }

}
/*
* 工作总结添加备注
* */
function summaryAddRemarksModal(id)
{

    var _id = id;
    var _url="/operation/summary/projectRemarksModal?id="+_id;
    $('#modalDialog').removeData("bs.modal");
    $("#modalDialog").modal({remote: _url});
}
/*
* 接收备注
* */
function summaryAddRemarksSave(id)
{
    var _remarks = $("#remarks").val();

    if(_remarks=="")
    {
        alert("请填写备注内容");
        return false;
    }
    $.ajax({
        type:"POST",
        url:"/operation/summary/projectRemarksSave",
        data:{id:id,remarks:_remarks},
        datatype: "json",

        success:function(data){
            var jsonStr = eval("("+data+")");
            if(jsonStr.status==400){
                alert(jsonStr.message);
                return false;
            }else if(jsonStr.status==200){
                alert(jsonStr.message);
                location.replace(location.href);
            }else{
                alert("发生错误");
                return false;
            }
        },

        error: function(){
            alert("未知错误");
        }
    });
}
/*
* 添加项目
* */
function summaryProjectAddModal(id)
{

    var _id = id;
    var _url="/operation/summary/projectAddModal?id="+_id;
    $('#modalDialog').removeData("bs.modal");
    $("#modalDialog").modal({remote: _url});
}
/*
* 添加项目接收
* */
function summaryProjectAddSave(id)
{
    var _name = $("#project_name").val();
    var _hours = $("#project_hours").val();
    var _minute = $("#project_minute").val();
    var _remarks = $("#project_remark").val();
    var _status = $("#project_status").val();
    //alert(_status);return false;
    if(_name=="")
    {
        alert("填写业务名称");
        return false;
    }
    if(_hours!==""){
        if(isNaN(_hours)){
            alert("工作时间（小时）必须为数字");
            return false;
        }
    }else{
        _hours=0;
    }
    if(_minute!=="")
    {
        if(isNaN(_minute)){
            alert("工作时间（分）必须为数字");
            return false;
        }
    }else{
        _minute=0;
    }
    if(_minute==""&&_hours==""){
        alert("工作时间，小时和分钟必须填一项");
        return false;
    }
    $.ajax({
        type:"POST",
        url:"/operation/summary/projectAdd",
        data:{id:id,name:_name,minute:_minute,hours:_hours,remarks:_remarks,status:_status},
        datatype: "json",
        success:function(data){
            var jsonStr = eval("("+data+")");
            if(jsonStr.status==400){
                alert(jsonStr.message);
                return false;
            }else if(jsonStr.status==200){
                alert(jsonStr.message);
                location.replace(location.href);
            }else{
                alert("发生错误"+jsonStr.status);
                return false;
            }
        },
        error: function(){
            alert("未知错误");
        }
    });
}
/*
 * 添加周工作总结
 * */
function summaryProjectAddWeek(id)
{

    var _id = id;
    var _url="/operation/summary/projectAddWeek?id="+_id;
    $('#weekDialog').removeData("bs.modal");
    $("#weekDialog").modal({remote: _url});
}
/*
 * 保存总结
 * */
function summaryWeekSave(id)
{
    var _name = $("#project_name").val();
    var _remarks = $("#project_remarks").val();
    if(_remarks=="")
    {
        alert("填写周工作总结");
        return false;
    }
    $.ajax({
        type:"POST",
        url:"/operation/summary/weekSave",
        data:{id:id,name:_name,remarks:_remarks},
        datatype: "json",
        success:function(data){
            var jsonStr = eval("("+data+")");
            if(jsonStr.status==400){
                alert(jsonStr.message);
                return false;
            }else if(jsonStr.status==200){
                alert(jsonStr.message);
                location.replace(location.href);
            }else{
                alert("发生错误"+jsonStr.status);
                return false;
            }
        },
        error: function(){
            alert("未知错误");
        }
    });
}

 function summaryWeekAddSave(id)
{

    var _name = $("#project_name").val();

    var _remarks = $("#project_remarkss").val();

    $.ajax({
        type:"POST",
        url:"/operation/summary/summaryAdd",
        data:{id:id,name:_name,remarks:_remarks},
        datatype: "json",
        success:function(data){
            var jsonStr = eval("("+data+")");
            if(jsonStr.status==400){
                alert(jsonStr.message);
                return false;
            }else if(jsonStr.status==200){
                alert(jsonStr.message);
                location.replace(location.href);
            }else{
                alert("发生错误"+jsonStr.status);
                return false;
            }
        },
        error: function(){
            alert("未知错误");
        }
    });
}
function summaryProjectImport(id)
{
    if(window.confirm('访问后将自动导入业务流到工作总结，请先回复业务流再进入。\n确定已经都回复完了吗？')){
        location.replace("/operation/summary/detail?id="+id);

    }else{
        //alert("取消");
        return false;
    }
}
/*
* 业务流创建验证
* */
function postCreateVerify(form1)
{
    var _title = $("#OperationPost_title").val();
    var _scid = $("#OperationPost_sc_id").val();
    var _priority = $("#OperationPost_priority").val();
    var _departmentId = $("#OperationPost_departmentId").val();
    var _content = $("#OperationPost_content").val();

    if(_title==""){
        alert("请填写业务名称");
        return false;
    }
    if(_title.length>30)
    {
        alert("长度大于30字符，请短点");
        return false;
    }
    if(_scid==""){
        alert("请选择网站分类");
        return false;
    }
    if(_priority==""){
        alert("请选择优先级");
        return false;
    }
    if(_departmentId==""){
        alert("请选择你想要接收该业务的部门");
        return false;
    }
    if(_content==""){
        alert("请填写业务内容");
        return false;
    }
    if(document.all||document.getElementById){
        for(i=0;i<form1.length;i++){
            var tempobj=form1.elements[i];
            if(tempobj.type.toLowerCase()=="submit"||tempobj.type.toLowerCase()=="reset")
                tempobj.disabled=true;
        }
    }

    return true;
}
function f1(){
    var _priority = $("#OperationPost_priority").val();
    if(_priority==3){
        $("#OperationPost_postusername").val('贺丰');
        $("#OperationPost_receive_mid").val('1');
    }else{
        $("#OperationPost_postusername").val('');
        $("#OperationPost_receive_mid").val('');
    }
}


//添加占用业务流项
function addSpareTime(){
   // alert(6666);

    var _content = $("#spare_time_content").val();
    $.ajax({
        type:"POST",
        url:"/operation/my/spareTimeAdd",
        data:{content:_content},
        datatype: "json",
        success:function(data){

            var jsonStr = eval("("+data+")");
            if(jsonStr.status==400){
                alert(jsonStr.message);
                return false;
            }else if(jsonStr.status==200){

                alert(jsonStr.message);
                location.replace(location.href);

            }else{
                alert("发生错误"+jsonStr.status);
                return false;
            }
        },
        error: function(){
            alert("未知错误");
        }
    });


}
//关闭占用业务流项
function closeSpareTime(id){
     //alert(id);

    $.ajax({
        type:"POST",
        url:"/operation/my/spareTimeClose",
        data:{id:id},
        datatype: "json",
        success:function(data){

            var jsonStr = eval("("+data+")");
            if(jsonStr.status==400){
                alert(jsonStr.message);
                return false;
            }else if(jsonStr.status==200){

                alert(jsonStr.message);

                location.replace(location.href);

            }else{
                alert("发生错误"+jsonStr.status);
                return false;
            }
        },
        error: function(){
            alert("未知错误");
        }
    });
}
/**
 * 业务流1,2级分类的自动查找
 */
function findCategory(){
   // $('#aa').toggle();
    //一级分类获取
    var title_c=$('#title_category').val();//值也就是id
    var text_c= $("#title_category option:selected").text();//文本内容即分类名
    $("#name_category").empty();
    $.ajax({
        type:"POST",
        url:"/operation/my/findCategory",
        data:{category:text_c},
        datatype: "json",
        success:function(data){

            var jsonStr = eval("("+data+")");

            if(jsonStr.status==400){
                alert(jsonStr.message);
                return false;
            }else if(jsonStr.status==200){
                var names=jsonStr.message;
                //console.log(names);
                var tt='<option value="">== 请选择业务分类 ==</option>';
                for(var e in names){
                    var html='';
                     html+=' <option value="">'+names[e].c_name+'</option>';
                    tt += html;
                }
                //for(var i=0,l=names.length;i<l;i++){
                //    var name=names[i];
                //    console.log(name);
                //    for(var key in name){
                //        alert(key);
                //        alert(key +':'+name[key]);
                //    }
                //}

                $("#name_category").append(tt);
               // location.replace(location.href);

            }else{
                alert("发生错误"+jsonStr.status);
                return false;
            }
        },
        error: function(){
            alert("未知错误");
        }
    });
    //2级分类名获取
    $("#name_category").change(function(){
        var name_c=$('#name_category').val();//值也就是id
        var text_name= $("#name_category option:selected").text();//文本内容即分类名

        if(text_name!=''){
            $("#OperationPost_title").val( text_c+text_name);
        }else{
            $("#OperationPost_title").val('');
        }

    });

    if(title_c!=''){
        $("#OperationPost_title").val( text_c);
    }else{
        $("#OperationPost_title").val('');
    }
}
//弹出测试预估时间页面
function showTestTime(id)
{
    var _id = id;
    var _url="/operation/default/test?id="+_id;
    $('#testTime').removeData("bs.modal");
    $("#testTime").modal({remote: _url});

};
function addTestTime(id)
{
    var _hours = $("#add_tips_hours").val();
    var _minute = $("#add_tips_minute").val();
    var _postid = id;
    if(_hours!==""){
        if(isNaN(_hours)){
            alert("预估时间（小时）必须为数字");
            return false;
        }
        if(_hours>=100){
            alert("预估时间（小时）必须小于20小时");
            return false;
        }
    }else{
        _hours=0;
    }
    if(_minute!=="")
    {
        if(isNaN(_minute)){
            alert("预估时间（分）必须为数字");
            return false;
        }
    }else{
        _minute=0;
    }
    if(_minute==""&&_hours==""){
        alert("预估时间，小时和分钟必须填一项");
        return false;
    }
    $.ajax({
        type:"POST",
        url:"/operation/default/addTest",
        data:{id:_postid,minute:_minute,hours:_hours},
        datatype: "json",
        success:function(data){
            var jsonStr = eval("("+data+")");
            if(jsonStr.status==404){
                alert(jsonStr.message);
                return false;
            }else if(jsonStr.status==200){
                alert(jsonStr.message);
                location.replace(location.href);
            }else{
                alert("发生错误"+jsonStr.status);
                return false;
            }
        },
        error: function(){
            alert("未知错误");
        }
    });

}
//弹出测试评分页面
function testOperation(id)
{
    var _id = id;
    var _url="/operation/default/score?id="+_id;
    $('#testScore').removeData("bs.modal");
    $("#testScore").modal({remote: _url});

};

function addScore(id)
{
    var _score = $("#test_score").val();
    var _content = $("#test_content").val();
    var _postid = id;
    if(_score!==""){
        if(isNaN(_score)){
            alert("业务流评分必须为数字");
            return false;
        }
        if(_score>=100){
            alert("业务流评分必须小于100");
            return false;
        }
    }else{
        alert("请填写分数");
        return false;
    }
    if(_content==''){
        alert("请填写扣分详情");
        return false;
    }
    $.ajax({
        type:"POST",
        url:"/operation/default/addScore",
        data:{id:_postid,score:_score,content:_content},
        datatype: "json",
        success:function(data){
            var jsonStr = eval("("+data+")");
            if(jsonStr.status==404){
                alert(jsonStr.message);
                return false;
            }else if(jsonStr.status==200){
                alert(jsonStr.message);
                location.replace(location.href);
            }else{
                alert("发生错误"+jsonStr.status);
                return false;
            }
        },
        error: function(){
            alert("未知错误");
        }
    });

}
//修改扣分
function updateScore(id){
    //alert(666);
    var score = $("#score_"+id).val();
    var beizhu = $("#beizhu_"+id).val();

    $.ajax({
        type:"POST",
        url:"/operation/kpi/updateScore",
        data:{id:id,score:score,beizhu:beizhu},
        datatype: "json",
        success:function(data){
            var jsonStr = eval("("+data+")");
            if(jsonStr.status==404){
                alert(jsonStr.message);
                return false;
            }else if(jsonStr.status==200){
                alert(jsonStr.message);
                location.replace(location.href);
            }else{
                alert("发生错误"+jsonStr.status);
                return false;
            }
        },
        error: function(){
            alert("未知错误");
        }
    });

}
//批量修改扣分
function updateAllScore() {
    // alert(666);

    var cheMajor = $('input[name="box"]');//定为checkbox


    var obj ='';
    for (var i = 0; i < cheMajor.length; i++) {	//遍历checkbox
        if (cheMajor[i].checked) {//判断checkbox选中项

            var beizhu=$("#beizhu_" +cheMajor[i].value).val();
            if(beizhu==''){
                 beizhu='=';
            }
           obj += cheMajor[i].value+'_'+ $("#score_" +cheMajor[i].value).val()+'_'+beizhu+',';

        }
    }
    //for (var i = 0; i < dataMajor.length; i++) {//测试二维数组内容
    //    alert(dataMajor[i]["id"])
    //}
    $.ajax({
        traditional: true,
        type:"POST",
       // dataType: "json",
        url:"/operation/kpi/updateAllScore",
        data:{"obj":obj},
        //data: {"dataMajor" :JSON.stringify({id: valu1,test2: valu2})},
        success:function(data){
            var jsonStr = eval("("+data+")");
            if(jsonStr.status==404){
                alert(jsonStr.message);
                return false;
            }else if(jsonStr.status==200){
                alert(jsonStr.message);
               location.replace(location.href);
            }else{
                alert("发生错误"+jsonStr.status);
                return false;
            }
        },
        error: function(){
            alert("未知错误");
        }
    })
}
//弹出领导评分页面
function leadUser(id)
{
    var _id = id;
    var _url="/operation/actionCheck/leadAddScore?id="+_id;
    $('#leadUser').removeData("bs.modal");
    $("#leadUser").modal({remote: _url});

};

function leadAddSave(id)
{
    var _score = $("#lead_score").val();
    var _content = $("#lead_content").val();
    var _uid = id;
    if(_score!==""){
        if(isNaN(_score)){
            alert("评分必须为数字");
            return false;
        }
        if(_score>=100){
            alert("评分必须小于100");
            return false;
        }
    }else{
        alert("请填写分数");
        return false;
    }
    if(_content==''){
        alert("请填写评价内容");
        return false;
    }
    $.ajax({
        type:"POST",
        url:"/operation/actionCheck/addScore",
        data:{uid:_uid,score:_score,content:_content},
        datatype: "json",
        success:function(data){
            var jsonStr = eval("("+data+")");
            if(jsonStr.status==400){
                alert(jsonStr.message);
                return false;
            }else if(jsonStr.status==200){
                alert(jsonStr.message);
                location.replace(location.href);
            }else{
                alert("发生错误"+jsonStr.status);
                return false;
            }
        },
        error: function(){
            alert("未知错误");
        }
    });
}
function addKpi(score,uid,date)
{
    var _score = score;
    $.ajax({
        type:"POST",
        url:"/operation/actionCheck/addKpiScore",
        data:{uid:uid,score:_score,date:date},
        datatype: "json",
        success:function(data){
            var jsonStr = eval("("+data+")");
            if(jsonStr.status==400){
                alert(jsonStr.message);
                return false;
            }else if(jsonStr.status==200){
                alert(jsonStr.message);
                location.replace(location.href);
            }else{
                alert("发生错误"+jsonStr.status);
                return false;
            }
        },
        error: function(){
            alert("未知错误");
        }
    });

}
