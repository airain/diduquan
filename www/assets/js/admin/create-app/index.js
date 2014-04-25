define(function(require, exports, module) {
   
   var main = function(){
      $("form.j_add").on("submit",submit);
      
      $("input[name=table]").blur(function(){
          var table=$(this),value=table.val();
          if(value==""||value==table.data("value")){return;}
          table.data("value",value);
          $(".j_table").load("/admin/create-app/table",{table:value});
      });
      
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
       },'json');
       return false;
   }
   
   main();
});