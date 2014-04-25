define(function(require, exports, module) {
   
   var main = function(){
       
       
       seajs.use('/assets/js/highstock', function(module) {
           $.getJSON('/admin/keyword-track/get-sort?id=1&callback=?', function(data) {
               
               //log(data);
               
               var _data = {};
               for(var i in data){
                   _data[data[i][0]] = data[i];
               }
               
               // Create the chart
               $('#container').highcharts('StockChart', {

                   rangeSelector : {
                       selected : 1
                   },
                   
                   credits:{
                       enabled: false
                   },
                   
                   lang:{
                       months: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
                       shortMonths: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一', '十二'],
                       weekdays: ['星期天', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六'],
                       exportButtonTitle:'导出PDF',
                       printButtonTitle:'打印报表'
                   },
                   
                   rangeSelector: {
                       // 缩放选择按钮，是一个数组。
                       // 其中type可以是： 'millisecond', 'second', 'minute', 'day', 'week', 'month', 'ytd' (year to date), 'year' 和 'all'。
                       // 其中count是指多少个单位type。
                       // 其中text是配置显示在按钮上的文字
                       buttons: [{
                               type: 'month',
                               count: 1,
                               text: '1月'
                           }, {
                               type: 'month',
                               count: 3,
                               text: '3月'
                           }, {
                               type: 'month',
                               count: 6,
                               text: '6月'
                           }, {
                               type: 'year',
                               count: 1,
                               text: '1年'
                           },{
                               type: 'year',
                               count: 3,
                               text: '3年'
                           }, {
                               type: 'all',
                               text: '所有'
                           }],
                       // 默认选择域：0（缩放按钮中的第一个）、1（缩放按钮中的第二个）……
                       selected: 1,
                       // 是否允许input标签选框
                       inputEnabled: false
                   },

                   title : {
                       text : '走势图'
                   },

                   xAxis:{
                       // 如果X轴刻度是日期或时间，该配置是格式化日期及时间显示格式
                       dateTimeLabelFormats: {
                           second: '%Y-%m-%d<br/>%H:%M:%S',
                           minute: '%Y-%m-%d<br/>%H:%M',
                           hour: '%Y-%m-%d<br/>%H:%M',
                           day: '%Y<br/>%m-%d',
                           week: '%Y<br/>%m-%d',
                           month: '%Y-%m',
                           year: '%Y'
                       }
                   },
                   
                   yAxis: {
                       reversed: true,
                       showFirstLabel: false,
                       showLastLabel: true
                   },
                   
                   /*
                   tooltip: {  
                       xDateFormat: '%Y年%m月%日, %a'//鼠标移动到趋势线上时显示的日期格式  
                   }, 
                   */
                   
                   tooltip: {
                       formatter: function() {
                           var d=new Date(this.x);
                           var formatdate=(d.getMonth()+1)+"月"+d.getDay()+"日"+d.getHours()+"时"+d.getMinutes()+"分";
                           
                           return formatdate+'：<br/>'+ 
                               '<b>排名</b>：'+(this.y==400?"未找到":this.y)+'<br/> ';
                       }
                       //xDateFormat: '%Y-%m-%d, %H:%s'
                   },

                   series : [{
                       name : '排名',
                       data : data,
                       tooltip : {
                           valueDecimals: 40
                       }
                   }]
               });
           });
       });
       
       
       
   }
   
   main();
});