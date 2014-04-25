define(function(require, exports, module) {
   
   var main = function(){
      $("form.j_add").on("submit",submit);
   }
   
   var submit = function(){
       var form=$(this),url=form.attr("action")||window.location.href,sb=form.find("[type=submit]");
       var data={},temp=form.serializeArray();
       if(!form.valid()){return;}
       for(var i in temp){
           data[temp[i]['name']] = temp[i]['value'];
       }
       sb.button('loading');
       $.post(url,data,function(data){
           sb.button('reset');
           message(data.message);
           if(data.success){
               setTimeout(function(){
                   message(false);
                   window.history.go(-1);
               },1000);
           }
       },'json');
       return false;
   }
   
   main();
});