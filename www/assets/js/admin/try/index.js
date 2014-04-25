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
       $("#dlist").load("/admin/try/dlist",condition);
   };

   var remove = function(ids){
       if(!ids){return;}
       $.post("/admin/try/delete",{id:ids},function(data){
           if(data.success){
               ids = ids.split(",");
               for(var i in ids){
                   var lis = $("#dlist tr[did="+ids[i]+"]");
                   lis.hide(function(){lis.remove()});
               }
            }else{
                message(data.message);
            }
       },'json');
   };

   var bindevent = function(data){
       $(this).find("tr[did]").each(function(i){
           var li = $(this),id=li.attr("did");
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