/*--defined----------------------------------*/
window.errors = window.errors ? window.errors : new Array();
var E = jQuery.extend;

/*--function ---------------------------------*/
//日志打印函数
var log = function(){
    try{
        return console.log.apply(this,arguments);
    }catch(e){}
};

//生成随机ID
var gid = function(){
	return "s_"+(Math.random()+"").substring(2);
};

//获取当前参数
var getArgs = function(instr){
    var args = new Object();
    var query = window.location.search.substring(1);
    if(instr){
        query = instr;
    }
    var pairs = query.split("&"); // 以 & 符分开成数组
    for(var i = 0; i < pairs.length; i++) {
        var pos = pairs[i].indexOf('='); // 查找 "name=value" 对
        if (pos == -1) continue; // 若不成对，则跳出循环继续下一对
        var argname = pairs[i].substring(0,pos); // 取参数名
        var value = pairs[i].substring(pos+1); // 取参数值
        value = decodeURIComponent(value); // 若需要，则解码
        args[argname] = value; // 存成对象的一个属性
    }
    return args; // 返回此对象
};

var message = function(message,success){
    $ = window!=parent?parent.$:$;
    var modal = $("#modal_panel"),success=success||"info";
    if(modal.length<=0){
        success = success == 'error'?'danger':success;
        modal = $('<div id="modal_panel" class="alert alert-block hide alert-'+success+' modal">'+
    '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'+
     '<h4 class="alert-heading">'+message+'</h4>'+
'</div>');
    }else{
        modal.find("h4.alert-heading").html(message);
    }
    if(message){
        modal.modal();
    }else{
        modal.find(".close").click();
    }
}


/*--object-----------------------------------*/
var widget = (function(){
    var init = function(range){
        var nodes = $("[data-widget]");
        if(typeof range != "undefined"){
            nodes = range.find("[data-widget]");
        }
        nodes.each(function(){
            var node = $(this),type = node.attr("data-widget");
            if(type && !node.attr("data-widget-isload")){
                var config = get_widget_config(node.attr("data-widget-config"));
                if(eval("typeof widget."+type+" =='object'")){
                    eval("widget."+type+".init(node,config)");
                }else{
                    seajs.use('/assets/js/module/'+type, function(module) {
                        if(typeof module.init == "function"){
                            module.init(node,config);
                        }
                    });
                }
                node.attr("data-widget-isload",true);
            }
        });
    }

    var get_widget_config = function(config){
        if(typeof config != "undefined"){
            try {
                eval("config = "+config+";");
            } catch (e) {}
        }
        return config||{};
    };

    return {
        init:init
    }
})();

/*--init--------------------------------------------*/

//un focus
$("a").click(function(){
    $(this).blur();
});

//loading widget
widget.loading = (function() {
    var init = function(_node,_config){
        var node=_node,runload=function(i){
            var i=i||1,point = new Array(".",".",".",".",".");
            node.html("加载中"+point.slice(0,i%4).join(""));
            if(!node.is(":visible")){return;}
            setTimeout(function(){
                runload(++i);
            },200);
        }
        setTimeout(runload,100);
    }
    return {
        init:init
    }
})();

//widget init
widget.init();

//bootstrap tooltip
//$("[title]").tooltip();


//form validate
if($("form.j_validate").length>0){
    seajs.use('/assets/js/jquery-validation', function(module) {
        $("form.j_validate").validate({
            errorClass:'help-inline',
            errorElement:'em',
        });
    });
}

$(".j_has_loading").loadStart(function(url,condition){
    $(this).html('<div data-widget="loading" class="lead" style="height:'+$(this).outerHeight()+'px"></div>');
    widget.init();
});

//页面load加loading
$("#dlist").loadStart(function(url,condition){
    $(this).data("condition",E({},condition,getArgs(url.split("?")[1])));
    var ttop = $("#dlist").offset().top - $("div.j_subnav").outerHeight();
    if($("html,body").scrollTop()>ttop){
        $("html,body").animate({scrollTop:ttop},500);
    }
});

//load后置初始化分页代码
$("#dlist").onload(function(data){
    //pagination
    $(".pagination li>a").click(function(){
        var a = $(this),href=a.attr("href");
        if(href.toLowerCase().indexOf("javascript")!==0){
            $(this).parents(".j_box").load(href);
        }
        return false;
    });
    $(".pagination .j_pagesize").change(function(){
        var url = $(this).attr("data-url").replace(new RegExp("size=[0-9]*", "gi"), "size="+$(this).val());
        $(this).parents(".j_box").load(url);
    });

    //reload condition to url
    var qpage = "#"+$.param($(this).data("condition"));
    if(qpage.length>1){
        if(window.location.href.indexOf("#")>=0){
            window.location.href = window.location.href.replace(/#(.*)$/gi,qpage);
        }else{
            window.location.href += qpage;
        }
    }

    widget.init();

});

//前置condition
var _hash = window.location.hash.split("#");
if(typeof _hash[1] != "undefined"){
    $("#dlist").data("condition",getArgs(_hash[1]));
}


//jQuery._before(["post","get"],function(){},function(data){
//    log(arguments);
//    log(data);
//    if(data==-1){
//        log("is no login!");
//        log(typeof arguments[3]);
//        arguments[3]();
//        return false;
//    }
//});

//$("body").ajaxSuccess(function(e,r,d){
//    console.log("ajaxStart----------------------");
////    log(this);
//    log(arguments);
//});
