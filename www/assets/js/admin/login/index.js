define(function(require, exports, module) {
    
    var error;
   
   var main = function(){
       error = $("#error").find(".close").click(function(){
           error.slideUp();
       }).end();
      $("form").on("submit",submit);
   }
   
   var submit = function(){
       var form=$(this),url=form.attr("action")||window.location.href,sb=form.find("[type=submit]");
       var data={},temp=form.serializeArray();
       if(!form.valid()){return;}
       for(var i in temp){
           data[temp[i]['name']] = temp[i]['value'];
       }
       $.post(url,data,function(data){
           if(data.result){
               log(data);
               setTimeout(function(){
                   window.location.href = data.BACK_URL ;
               },1000);
           }else{
               $("[name=password]").val("");
               $("[name=email]").focus();
               showError(data.message);
           }
       },'json');
       return false;
   }
   
   var showError = function(msg){
       if(error.is(":visible")){
           error.slideUp(function(){
               _showerror(msg);
           });
       }else{
           _showerror(msg);
       }
   }
   
   var _showerror = function(msg){
       error.find(">span").text(msg);
       error.slideDown();
   }
   
   main();
});