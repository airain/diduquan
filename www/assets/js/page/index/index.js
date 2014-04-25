define(function(require, exports, module) {
    
   var main = function(){
       
       $("body").css("overflow","hidden");
       $(window).resize(autosize);
       autosize();
       
       nav_init();
       
//       getMenuData(0,menu_init);
       
//       menu_init();
   }
   
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
   }
   
   var showMenu = function(pid){
       var data = $("#menu").data("data");
       if(!data){
           getMenuData(pid,arguments.callee);
           return ;
       }
       
       $html = "";
       for(var i in data){
           if(data[i]['id'] == pid){
               var pdata = data[i]['childs'];
               for(var j in pdata){
                   $html += '<div class="accordion-group">' + 
                       '<div class="accordion-heading">' +
                   '<a href="#accordion-element-'+ pdata[j]['id'] +'" data-parent="#menu" data-toggle="collapse" class="accordion-toggle">'+ pdata[j]['name'] +'</a>' + 
                   '</div>' + 
                   '<div class="accordion-body '+ (j==0?'in':'') +' collapse" id="accordion-element-'+ pdata[j]['id'] +'">' + 
                       '<div class="accordion-inner">' + 
                           '<ul class="nav nav-stacked nav-pills">';
                       var mdata = pdata[j]['childs'];
                       for(var k in mdata){
                           $html += '<li class="leaf"><a href="'+ mdata[k]['url'] +'" target="'+ mdata[k]['target'] +'">'+ mdata[k]['name'] +'</a></li>';
                       }
                   $html += '</ul></div></div></div>';
               }
               break;
           }
       }
       
       $("#menu").html($html);
       
       menu_init();
       
   }
   
   var getMenuData = function(pid, callback){
       $.get("/menu",{pid:pid},function(data){
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
               var target = $(this).attr("target"), url = $(this).attr("href")+"?"+gid();
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