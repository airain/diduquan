define(function(require, exports, module) {

   var main = function(){
        bindevent();
       $(".j_submit").parents("form").submit(search);
   };

   var search = function(){
       var form = $(this);
       form.submit();
       return false;
   };


   var remove = function(ids){
       if(!ids){return;}
       $.post("/admin/try/prdel",{prid:ids},function(data){
           if(data.success){
               ids = ids.split(",");
               for(var i in ids){
                   var lis = $("#dlist tr[prid="+ids[i]+"]");
                   lis.hide(function(){lis.remove()});
               }
            }else{
                message(data.message);
            }
       },'json');
   };

   var bindevent = function(){
       $("#dlist").find("tr[prid]").each(function(i){
           var li = $(this),id=li.attr("prid");
           li.find(".j_remove").click(function(){
               remove(id);
           }).confirm({msg:"你确定要删除吗？"});
       });
       $(".j_removeall").click(function(){
           var ids = $(".j_selectall").val();
           if(ids==""){
               message("请先选择!");
               return;
           }
           $(".j_action").hide();
           remove(ids);
       }).confirm({msg:'你确定要删除选中内容吗？'});
   };

   main();
});