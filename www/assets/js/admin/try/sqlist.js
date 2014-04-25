define(function(require, exports, module) {

   var main = function(){
        _bindevent();
       $(".j_submit").parents("form").submit(_search);
   };

   function _search(){

   }


   function _remove(ids, type){
       if(!ids){return;}
       $.post("/admin/try/opt",{ids:ids, opt_type:type},function(data){
           if(data.success){
              location.href=data.referurl;
            }else{
                message(data.message);
            }
       },'json');
   }

   function _bindevent(){
      $('.j_list_menu_opt').find('a').bind('click',function(e){
        var opt_type = $(this).attr('data-opt');
        var opt_text = $(this).text();
        var parent_obj = $(this).parents('tr');
        var id = parent_obj.attr('data-id');
        _remove(id, opt_type);
      });
      $('.j_action').find('a').bind('click', function(e) {
        var opt_type = $(this).attr('data-opt');
        var ids = $(".j_selectall").val();
         if(ids==""){
             message("����ѡ��!");
             return;
         }
         _remove(ids, opt_type);
      });
      /*
       $("#dlist").find("tr[data-id]").each(function(i){
           var li = $(this),id=li.attr("data-id");
           li.find(".j_remove").click(function(){
               remove(id);
           }).confirm({msg:"��ȷ��Ҫɾ����"});
       });
       $(".j_list_menu_opt").click(function(){
           var ids = $(".j_selectall").val();
           if(ids==""){
               message("����ѡ��!");
               return;
           }
           $(".j_action").hide();
           remove(ids);
       }).confirm({msg:'��ȷ��Ҫɾ��ѡ��������'});*/
   }

   main();
});