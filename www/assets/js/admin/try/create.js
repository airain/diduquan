define(function(require, exports, module) {
   var $uploader = require('page/uploadify');
   var tqEditCObj = null;
   var tqEditDObj = null;
   var main = function(){
      tqEditDObj = new  tqEditor('desc',{toolbar:'default',imageUploadUrl:'/upload?path=try'});
      tqEditCObj = new  tqEditor('content',{toolbar:'default',imageUploadUrl:'/upload?path=try'});
      $("form.j_add").on("submit",submit);

      $uploader.showUpload('uploadify','dlogo',
        function(file, data, response) {
            var data = eval('('+data+')');
            //$('#showImgBox').
            var imgObj = $('#showImg').attr({
              width: data.width,
              height: data.height,
              src:data.url
            });
            $('#pic').val(data.url);
            $('#showImgBox').append(imgObj);
            // alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
        },function(file, errorCode, errorMsg, errorString) {
            alert('The file ' + file.name + ' could not be uploaded: ' + errorString);
        });

      //城市
      require('apply_area');
      var areaobj = new area();
      areaobj.createSelectOption('areaid',2);
      areaobj.init(cityid);

      //日期
      // require('/assets/css/datepicker.css');
      // require('bootstrap-datepicker');
      // $('#b_stattime').datepicker({});
      var dpObj = require('module/datepicker');
      dpObj.datepicker('b_stattime');
      dpObj.datepicker('b_endtime');
      dpObj.datepicker('bg_stattime');
      dpObj.datepicker('bg_endtime');
   };

   var submit = function(){
       var form=$(this),url=form.attr("action")||window.location.href,sb=form.find("[type=submit]");
       var data={},temp=form.serializeArray();
       if(!form.valid()){return;}
       for(var i in temp){
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