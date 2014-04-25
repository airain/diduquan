define(function(require, exports, module) {
    
    var init = function(_node,_config){
        var isFixed = 0,
            bench = $('<div>&nbsp;</div>'),
            $win=$(window),
            config = {
                offset:0
        };
        
        node = _node,config = E({},config,_config);
        navTop = node.length && node.offset().top;
        
        var main = function(){
            processScroll();
            $win.scroll(processScroll);
        };
        
        var processScroll = function () {
            var i, scrollTop = $win.scrollTop()
            if (scrollTop >= navTop && !isFixed) {
                isFixed = 1
                node.before(bench.height(node.outerHeight()+config.offset))
                node.addClass('subnav-fixed');
            } else if (scrollTop <= navTop && isFixed) {
                isFixed = 0
                node.removeClass('subnav-fixed');
                bench.remove();
            }
        };
        
        main();
    }
    
    return {
        init:init
    }
});