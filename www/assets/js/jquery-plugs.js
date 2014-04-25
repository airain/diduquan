/*添加前置方法*/
jQuery.fn._before = jQuery._before = function(func,beforfunc,callback){
    if(typeof func == "object"){
        for(var i in func){
            arguments.callee.apply(this,[func[i],beforfunc,callback]);
        }
    }
    if(typeof this[func] != "function")
        return ;
    var _func = this[func];
    this[func] = function(){
        var _arg=arguments,_that=this,scene = function(){
            _arg.callee.apply(_that,_arg);
        }
        if(typeof beforfunc=="function"&&false===beforfunc.apply(this,arguments)){
            return false;
        }
        var arg = new Array(),incallback = function(){};
        for(var i in arguments){
            if(typeof arguments[i] == "function"){
                incallback = arguments[i];
                continue;
            }
            arg.push(arguments[i]);
        }
        arg.splice(2,0,function(){
            var arg = new Array();
            for(var i in arguments){
                arg[i] = arguments[i];
            }
            if(typeof callback!="function"||false!==callback.apply(this,arg.concat(scene))){
                incallback.apply(this,arguments);
            }
        });
        _func.apply(this,arg);
    };
};

//load 加载后
jQuery.fn.onload = function(){
    var funcs = $(this).data("onload")||[];
    if(arguments.length>=1&&typeof arguments[0] == "function"){
        funcs.push(arguments[0]);
        return $(this).data("onload",funcs);
    }else{
        return funcs;
    }
}

//load 开始时
jQuery.fn.loadStart = function(){
    var funcs = $(this).data("loadStart")||[];
    if(arguments.length>=1&&typeof arguments[0] == "function"){
        funcs.push(arguments[0]);
        return $(this).data("loadStart",funcs);
    }else{
        return funcs;
    }
}

//页面load，加前置和回调
jQuery.fn._before("load",function(){
    var callbacks = $(this).loadStart();
    if(typeof callbacks == "object"){
        for(var i in callbacks){
            if(typeof callbacks[i] == "function"){
                callbacks[i].apply(this,arguments);
            }
        }
    }
},function(data){
    var callbacks = $(this).onload();
    if(typeof callbacks == "object"){
        for(var i in callbacks){
            if(typeof callbacks[i] == "function"){
                callbacks[i].apply(this,arguments);
            }
        }
    }
});

jQuery.fn.confirm = function(options) {
    options = jQuery.extend({
      msg: '你确定吗？',
      stopAfter: 'never',
      eventType: 'click',
      timeout: 3000
    }, options);
    options.stopAfter = options.stopAfter.toLowerCase();
    if (!options.stopAfter in ['never', 'once', 'ok', 'cancel']) {
      options.stopAfter = 'never';
    }
    options.buttons = jQuery.extend({
      ok: '确定',
      cancel: '取消',
    }, options.buttons);

    // Shortcut to eventType.
    var type = options.eventType;
  //TODO ASD
    return this.each(function() {
      var target = this;
      var $target = jQuery(target);
      var timer;
      var saveHandlers = function() {
      var events = jQuery._data(target, 'events');
        if (!events && target.href) {
          // No handlers but we have href
          $target.bind('click', function() {document.location = target.href;});
          events = jQuery._data(target, 'events');
        } else if (!events) {
          // There are no handlers to save.
          return;
        }
        target._handlers = new Array();
        for (var i in events[type]) {
          target._handlers.push(events[type][i]);
        }
      };
      
      var $dialog = $('<div class="popover fade right in" style="visibility:inherit;position:absolute;">'+
              '<div class="arrow"></div><h3 class="popover-title">'+options.msg+'</h3>'+
              '<div class="popover-content">'+
                  '<a href="javascript:;" class="btn btn-small btn-primary j_ok">'+options.buttons.ok+'</a>  '+
                  '<a href="javascript:;" class="btn btn-small j_cancel">'+options.buttons.cancel+'</a>'+
              '</div>'+
       '</div>');
      
      var $ok = $dialog.find(".j_ok").click(function() {
        // Check if timeout is set.
        if (options.timeout != 0) {
          clearTimeout(timer);
        }
        $target.unbind(type, handler);
        $target.show();
        $dialog.hide();
        // Rebind the saved handlers.
        if (target._handlers != undefined) {
          jQuery.each(target._handlers, function() {
            $target.click(this.handler);
          });
        }
        // Trigger click event.
        $target.click();
        if (options.stopAfter != 'ok' && options.stopAfter != 'once') {
          $target.unbind(type);
          // Rebind the confirmation handler.
          $target.one(type, handler);
        }
        return false;
      });
      
      var $cancel = $dialog.find(".j_cancel").click(function() {
        if (options.timeout != 0) {
          clearTimeout(timer);
        }
        if (options.stopAfter != 'cancel' && options.stopAfter != 'once') {
          $target.one(type, handler);
        }
        $target.show();
        $dialog.hide();
        return false;
      });

      var handler = function() {
        var position = $(this).offset();
        $dialog.appendTo("body");
        $dialog.css({top:position.top+25,left:position.left-10});
        $dialog.show();
        if (options.timeout != 0) {
          // Set timeout
          clearTimeout(timer);
          timer = setTimeout(function() {$cancel.click(); $target.one(type, handler);}, options.timeout);
        }
        return false;
      };
      saveHandlers();
      $target.unbind(type);
      target._confirm = handler;
      target._confirmEvent = type;
      $target.one(type, handler);
    });
  };
