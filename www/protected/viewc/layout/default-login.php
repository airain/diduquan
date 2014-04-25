<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $title;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="<?php echo $staticurl;?>/css/index.css" rel="stylesheet">
<link href="<?php echo $staticurl;?>/css/base.css" rel="stylesheet">
<script src="<?php echo $staticurl;?>/js/jquery.min.js"></script>
<script data-main="<?php echo $script;?>" charset="utf-8" id="seajsnode" src="<?php echo $staticurl;?>/js/seajs/sea.js"></script>
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>

<div class="logo mb20" style="border-bottom:2px solid #86c174;">
 <div class="logo_weight">
  <div class="logo_logo mt6"><img src="<?php echo $staticurl;?>/images/logo1.jpg"></div>
  <div class="fr mt40  font1 gray_333 su "><a href="#">返回首页</a></div>
  </div>
</div>

<!-- 中间模板部分 -->
<?php echo $this->data['_OUTPUT'];?>

<?php $this->inc('elements/footer');?>