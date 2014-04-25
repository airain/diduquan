define(function(require, exports, module) {
   var $uploader = require('page/uploadify');
   var tqEditObj = null;
   var main = function(){
      tqEditObj = new  tqEditor('info',{toolbar:'default',imageUploadUrl:'/upload?path=parter'});
      $("form.j_add").on("submit",submit);
      $uploader.showUpload('uploadify','clogo',
        function(file, data, response) {
            var data = eval('('+data+')');
            //$('#showImgBox').
            var imgObj = $('#showImg').attr({
              width: data.width,
              height: data.height,
              src:data.url
            });
            $('#logo').val(data.url);
            $('#showImgBox').append(imgObj);
            // alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
        },function(file, errorCode, errorMsg, errorString) {
            alert('The file ' + file.name + ' could not be uploaded: ' + errorString);
        });
      $uploader.setFun('onSelect',function(file) {
            // alert('The file ' + file.name + ' was added to the queue.');
        });

      $uploader.setPro('auto',false);
      $('#start_upload').bind('click', function() {
        /* Act on the event */
        $uploader.upload();
      });
   };

   var submit = function(){
       var form=$(this),url=form.attr("action")||window.location.href,sb=form.find("[type=submit]");
       var data={},temp=form.serializeArray();
       if(!form.valid()){return;}
       for(var i in temp){
          if(temp[i]['name'] == 'info')
            data[temp[i]['name']] = tqEditObj.content();
          else
           data[temp[i]['name']] = temp[i]['value'];
       }
       sb.button('loading');
       $.post(url,data,function(data){
           sb.button('reset');
           message(data.message);
           if(data.success){
               setTimeout(function(){
				          message(false);
                  window.history.go(-1);
               },1000);
           }
       },'json');
       return false;
   };

   main();
});