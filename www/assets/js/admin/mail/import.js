define(function(require, exports, module) {
	
   var button;
   
   var main = function(){
	   var button = $("#upload");
	   button.click(function(){
		   upload("/admin/mail/import",{},function(){
			   button.button('loading');
		   },function(data){
		       log(data);
			   button.button('reset');
			   message(data);
		   });
	   });
   }
   
   var upload = function(url, data, onSend, onComplate){
	   seajs.use('/assets/js/jquery-upload', function() {
 		  $.upload({
	  			url: url, 
	  			params: data,
	  			onSend: onSend,
	  			onComplate: onComplate
		  	});
       });
   }
   
   main();
});