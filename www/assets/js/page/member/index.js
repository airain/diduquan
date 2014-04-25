define(function(require, exports, module) {
    
    var error;
    var emailObj;
    var pwdObj;
    var nickObj ;
    var regBox;
   
   var main = function(){
      regBox = $("#registerBox").find('#ciBnt');
      emailObj = $('#email').on('blur', chEmail);
      pwdObj = $('#password').on('blur', chPwd);
      nickObj = $('#nick').on('blur', chNick);
      regBox.on("click",submit).on('blur',function (){
        showError('error', '');
      });
   }

   var chEmail = function(){
      var email = emailObj.val();
      if(email == ""){
        showError(emailObj.attr('id'), '请输入邮箱');
        return false;
      }
      var urlReg = /^[a-zA-Z0-9_.]+@[a-zA-Z0-9]+\.[a-zA-Z0-9]{2,4}(\.[a-zA-Z0-9]{2,3})?$/;
      if(!urlReg.test(email)){
        showError(emailObj.attr('id'), '邮箱格式错误');
        return false;
      }
      return email;
   }

   var chPwd = function(){
      var pwd = pwdObj.val();
      if(pwd == ""){
         showError(pwdObj.attr('id'), '请输入密码');
        return false;
      }
      return pwd;
   }

   var chNick = function(){
      var nick = nickObj.val();
      if(nick == ""){
        showError(nickObj.attr('id'), '请输入昵称');
        return false;
      }
      return nick;
   }
   
   var submit = function(){
        if(!$('#clause').prop('checked')){
          showError('error', '未选服务条款');
          return ;
        }
       var email = chEmail();
       var pwd = chPwd();
       var nick = chNick();

       if(!email || !pwd || !nick) return ;

       $.post('/register/ajax',{
          email: email,
          pwd: pwd,
          nick: nick
       },function(data){
           if(data.result){
                window.location.href = data.BACK_URL;
           }else{
               showError(data.type, data.message);
           }
       },'json');
       return false;
   }
   
   var showError = function(type, msg){
       error = $("#"+type+"Tip");
       _showerror(msg);
   }
   
   var _showerror = function(msg){
       error.text(msg);
   }
   
   main();
});