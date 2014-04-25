define(function(require, exports, module) {

   var main = function(uname){
      var dialog = require('seajs/src/dialog');
      var wcontent = require('tpl/wpop.tpl');
      var dlg_title = '写新消息';
      var touname = typeof uname == 'undefined'? '' : uname;

      wcontent = wcontent.replace(/\{uname\}/g,touname);

      $(wcontent).find('.idleField').bind('focus', function (){
         hideError();
      });

      var d = dialog({
          title: dlg_title,
          content: wcontent,
          button:[
            {
                fixed: true,
                value: '保存',
                callback: function () {
                    var dthis = this;
                    var $msgObj = $('#msgBox');
                    var username = $msgObj.find('#username').val();
                    var content = $msgObj.find('#content').val();

                    // $msgObj.find('.idleField').bind('focus', function (){
                    //    hideError();
                    // });

                    if(username == ''){
                      showError('您这是要给谁发呀');
                      return false;
                    }

                    if (content == '') {
                      showError('您要告诉对方什么话呀');
                      return false;
                    }

                    //提交

                    $.ajax({
                        beforeSend: function(){
                          dthis.title('正在提交..');
                        },
                        type: 'POST',
                        dataType: 'json',
                        url:'/member/ajax_save/?op=savemsg', 
                        data: {username: username, content: content}, 
                        success: function (data) {
                          // body...
                          if(data.result){
                            dthis.close();
                            var sdlg = dialog({
                                  content:'发送成功！'
                              }).show();
                            setTimeout(function () {
                                sdlg.close().remove();
                            }, 2000);
                          }else{
                            dthis.title(dlg_title);
                            showError(data.message);
                            return false;
                          }
                      }
                  });
                  return false;
                },
                autofocus: true
            },
            {
                value: '取消',
                callback: function () {
                }
            },
          ]
      })
      .width(600)
      .show();

      $('#msgBox').find('.idleField').bind('focus', function (){
         hideError();
      });

      function showError (str) {
        d.statusbar('<span style="color:#FF4400;font-weight:bold; ">出错啦：'+str+'</span>');
      }

      function hideError () {
        d.statusbar();
      }
   };
   
  
   
   exports.show = main;
});