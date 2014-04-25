define(function(require, exports, module) {
    require('/assets/css/datepicker.css');
    // require('locales/bootstrap-datepicker.zh-CN');
    require('bootstrap-datepicker');
    exports.datepicker = function(id,params){
        var params = typeof params == 'undefined'?{}:params;
        $obj = $('#'+id);
        // params.language = 'zh-CN';
        params.format = 'yyyy-mm-dd';
        $obj.datepicker(params);
    };
    exports.setDatepicker = function(str){
        $obj.datepicker(str);
    };
});