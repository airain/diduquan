define(function(require, exports, module) {
    
    var sb = $("#search").click(function(){
        var value = $("#value").val();
        if(value==""){
            $("#value").focus();
            return;
        }
        sb.button('loading');
        $("#searchBox").load("/ktrack/search-one",{keywords:value,nick:$("#nick").val()},function(data){
            sb.button('reset');
        });
        
        
        
    });
  

});