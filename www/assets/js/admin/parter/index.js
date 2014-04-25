define(function(require, exports, module) {

    var condition = $("#dlist").data("condition")||{
            size: 10
    };

   var main = function(){
       $("#dlist").onload(bindevent);
       $(".j_submit").parents("form").submit(search);
       loadlist();
   };

   var search = function(){
       var form = $(this);
       //获取数据
       var fv = form.serializeArray();
       for(var i in fv){
           condition[fv[i].name] = fv[i].value;
       }
       condition['p'] = 1;
       loadlist();
       return false;
   };

   var loadlist = function(){
       $("#dlist").load("/admin/parter/dlist",condition);
   };

   var remove = function(ids,op,isdel){
       var op = typeof op == 'undefined'?'':op;
       var isdel = typeof isdel == 'undefined'?true:isdel;
       if(!ids){return;}
       $.post("/admin/parter/delete",{id:ids,op:op},function(data){
           if(data.success){
               if(isdel){
                 ids = ids.split(",");
                 for(var i in ids){
                     var lis = $("#dlist tr[did="+ids[i]+"]");
                     lis.hide(function(){lis.remove();});
                 }
              }
              location.href = data.referurl;
            }else{
                message(data.message);
            }
       },'json');
   };

   var bindevent = function(data){
       $(this).find("tr[did]").each(function(i){
           var li = $(this),id=li.attr("did");
           li.find(".j_remove").click(function(){
               var op = $(this).attr('data-op');
               remove(id,op,false);
           }).confirm({msg:"你确定要【这样做】吗？"});
       });
       $(".j_removeall").click(function(){
           var ids = $(".j_selectall").val();
           var op = $(this).attr('data-op');
           if(ids==""){
               message("请先选择!");
               return;
           }
           $(".j_action").hide();
           remove(ids,op,false);
       }).confirm({msg:'你确定要【这样对】选中内容吗？'});
   };

   main();
});