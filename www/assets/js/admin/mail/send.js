define(function(require, exports, module) {
   
   var main = function(){
      $("form.j_add").on("submit",submit);
   }
   
   var submit = function(){
       var form=$(this),url=form.attr("action")||window.location.href,sb=form.find("[type=submit]");
       var data={},temp=form.serializeArray();
       if(!form.valid()){return false;}
   }
   
   main();
});