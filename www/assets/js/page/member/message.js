define(function(require, exports, module) {
     
    var msgModel = require('page/sendmsg');
    var main = function(){
      $('.replyMsg').bind('click', function () {
          var touname = $(this).attr('data-uname');
          msgModel.show(touname);  
      });
    }
  
    main();
});