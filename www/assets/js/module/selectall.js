define(function(require, exports, module) {
    
    var init = function(_node,_config){
        var cboxs,node,config = {
                checkedClass: 'warning',
                action:"",
                target:""
        };
        
        node = _node,config = E({},config,_config);
        
        if(!config.target){
            return;
        }
        
        cboxs = $(config.target+" input:checkbox");
        
        var main = function(){
            node.click(function(){
                cboxs.attr("checked",node.attr("checked")||false);
                if(node.attr("checked")){
                    cboxs.parents("[did]").addClass(config.checkedClass);
                }else{
                    cboxs.parents("[did]").removeClass(config.checkedClass);
                }
                val2node();
            });
            cboxs.click(function(){
                val2node();
                $(this).parents("[did]:first").toggleClass(config.checkedClass);
            });
        }
        
        var val2node = function(){
            var ids = new Array();
            cboxs.each(function(){
                if($(this).is(":visible")&&$(this).attr("checked")){
                    ids.push($(this).val());
                }
            });
            node.val(ids.join(","));
            if(config.action){
                if(ids.length>0){
                    $(config.action).slideDown("fast");
                }else{
                    $(config.action).slideUp("fast");
                }
            }
        }
        main();
    }

    return {
        init:init
    }
});