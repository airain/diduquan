define(function(require, exports, module) {
   var $fr = $('#issueBox');
   $fr.find('#bntOk').bind('click', onSubmit);
   var main = function(){

   };

   function onSubmit(){
      var aid = $fr.find('#aid').val();
      var title = $fr.find('#title').val();
      var content = $fr.find('#content').val();

      if(title == ''){
      	return showError('标题不能为空');
      }
      if (content == '') {
      	return showError('内容不能为空');
      }

      $.post('/activity/ajaxIssue',{
      	aid: aid,
      	title: title,
      	content: content
      },function (data) {
      	// body...
      	if(data.result){
      		location.href = data.referurl;
      	}else{
      		showError(data.message);
      	}
      },
      'json');
   }
   
   function showError (msg) {
   		var msg = typeof msg=='undefined'?'':msg;
   		var errObj = $('#errorMsgBox');
   		errObj.html(msg);
   		if(msg=='') errObj.hide();
   		else errObj.show();
   }
   
   main();
});