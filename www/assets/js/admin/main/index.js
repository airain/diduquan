define(function(require, exports, module) {

   var main = function(){

       $("body").css("overflow","hidden");
       $(window).resize(autosize);
       autosize();

       nav_init();

      // getMenuData(0,menu_init);

      // menu_init();
   };

   var nav_init = function(){
       $("#nav>li").each(function(){
           var li = $(this);
           li.find(">a").click(function(){
               var pid = $(this).attr("data-menu-id");
               showMenu(pid);
               $("#nav>li").removeClass("active");
               li.addClass("active");
           });
       });
       $("#nav>li>a:first").click();
   };

   var showMenu = function(pid){
       var data = $("#menu").data("data");
       if(!data){
           getMenuData(pid,arguments.callee);
           return ;
       }
       $html = showMenus(data,'menu');

       $("#menu").html($html);

       menu_init();

   };

   function showMenus(data, parenId){
      var $html = "";
      for(var i in data){
          $html += getMenus(i, data[i], parenId);
      }
      return $html;
   }

   function getMenus(i, data, parenId){
      var $html = "";
      var childs = data['childs'];
      var subMenuID = '_submenu_' + data['id'];
      $html += '<div class="panel" id="'+subMenuID+'">' +
            '<div class="panel-heading">' +
            '<a href="#accordion-element-'+ data['id'] +'" data-parent="#'+parenId+'" data-toggle="collapse" class="accordion-toggle">'+ data['name'] +'</a>' +
            '</div>' +
            '<div class="panel-collapse '+ (i==0?'in':'') +' collapse" id="accordion-element-'+ data['id'] +'">' +
            '<div class="panel-body">';
      if(childs.length && parseInt(data['isleaf']) == 0){
        $html += '<ul class="nav nav-stacked nav-pills">';
        for(var j in childs){
          var subChilds = childs[j]['childs'];
          if(subChilds.length && parseInt(childs[j]['isleaf']) == 0){
            $html += getMenus(j, childs[j],subMenuID);
          }else{
            $html += '<li class="leaf"><a href="'+ childs[j]['url'] +'" target="'+ childs[j]['target'] +'">'+ childs[j]['name'] +'</a></li>';
          }
        }
        $html += '</ul>';
      }
      $html += '</div></div></div>';
      return $html;
   }

   var getMenuData = function(pid, callback){
       $.get("/admin/main/menu",{pid:pid},function(data){
           log(data);
           $("#menu").data("data",data);
           callback(pid);
       },'json');
   }

   var menu_init = function(){

       $("#menu li.leaf").each(function(){
           var li = $(this);
           li.find(">a").click(function(){
               $("#menu li.leaf").removeClass("active");
               li.addClass("active");
               var target = $(this).attr("target"), url = $(this).attr("href");
               if(target=="inner"){
                   $("#inner").attr("src", url);
               }else if(target=="_blank"){
                   window.open(url);
               }else{
                   window.location.href = url;
               }
               return false;
           });
       });

       var target = $("#menu li.leaf:first");
       if($("#menu li.active").length>0){
           target = $("#menu li.active:first");
       }
       target.find(">a").click();
   }

   var autosize = function(){
       $("#main>iframe").height($(window).height()-$("#navbar").height()-20);
   };

   main();

});