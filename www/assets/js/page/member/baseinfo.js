define(function(require, exports, module) {
    
    var error;
    var emailObj;
    var pwdObj;
    var nickObj ;
    var regBox;
   
   var main = function(){
      require("jquery-ui-1.8.1.custom.min");
      $("#tabs").tabs();
     binfoBox();
     baddress();
     bmodpwd();
     uploadPic();
   }

   var uploadPic = function(){
      var frm = $('#uploadpicFrm');
      frm.find('#uploadBnt').on('click', function(){
        $(frm).submit();
      });
   };

   var binfoBox = function(){
      var bbox = $('#binfoBox');
      bbox.find('#save_info').on('click', function(){
          var gender = bbox.find('input[name=gender]:checked').val();
          var bstate = bbox.find('input[name=bstate]:checked').val();
          var bname = bbox.find('input[name=bname]').val();
          var bbirth = bbox.find('input[name=bbirth]').val();
          var bsex = bbox.find('input[name=bsex]').val();
          if(!bstate) {
            showError('error', '请选择宝宝状态');

            return false;
          }
          if(bname == ""){ 
            showError('error', '请填写宝宝名字');
            return false;
          }
          if(bbirth == ""){
            showError('error', '请选择宝宝生日');
            return false;
          }

          $.post('/member/ajax_save', {gender: gender, bstate: bstate, bname: bname, bbirth: bbirth, bsex: bsex, op:'baseinfo'}, function(data) {
            /*optional stuff to do after success */
            showError('error', data.message);
          },'json');
      }).on('blur',function(){
        showError('error', '');
      });
   };

   var baddress = function() {
      var bbox = $('#saveAddrBox');
      bbox.find('#save_add').on('click',function(){
        var realname = bbox.find('input[name=realname]').val();
        var mobile = bbox.find('input[name=mobile]').val();
        var address = bbox.find('input[name=address]').val();
        var postcode = bbox.find('input[name=postcode]').val();
        if(realname == ""){ 
          showError('error', '请填写姓名');
          return false;
        }
        if(mobile == ""){ 
          showError('error', '请填联系电话');
          return false;
        }
        if(address == ""){ 
          showError('error', '请填写联系地址');
          return false;
        }

        $.post('/member/ajax_save', {realname: realname, mobile: mobile, address: address, postcode: postcode, op:'contact'}, function(data) {
            /*optional stuff to do after success */
            showError('error', data.message);
          },'json');

      }).on('blur',function(){
        showError('error', '');
      });
   };



   var bmodpwd = function() {
      var bbox = $('#modPwdBox');
      bbox.find('#mod_pwd').on('click',function(){
        var oldpwd = bbox.find('input[name=oldpwd]').val();
        var newpwd = bbox.find('input[name=newpwd]').val();
        var renewpwd = bbox.find('input[name=renewpwd]').val();
        if(oldpwd == ""){ 
          showError('error', '请填写原始密码');
          return false;
        }
        if(newpwd == ""){ 
          showError('error', '请填新密码');
          return false;
        }
        if(renewpwd == ""){ 
          showError('error', '请填写确认密码');
          return false;
        }
        if(renewpwd != newpwd){ 
          showError('error', '新密码与确认密码不相同');
          return false;
        }

        $.post('/member/ajax_save', {newpwd: newpwd, oldpwd: oldpwd, renewpwd: renewpwd, op:'modpwd'}, function(data) {
            /*optional stuff to do after success */
            showError('error', data.message);
          },'json');

      }).on('blur',function(){
        showError('error', '');
      });
   };

   
   
   var showError = function(type, msg){
       error = $("#"+type+"Tip");
       _showerror(msg);
   }
   
   var _showerror = function(msg){
       error.text(msg);
   }
   
   main();
});