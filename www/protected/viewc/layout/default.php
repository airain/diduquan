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
<script src="<?php echo $staticurl;?>/js/seajs/src/seajs-text.js"></script>
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script>
	seajs.config({
	  alias: {
	    "jquery": "seajs/jquery-1.10.2.js"
	  }
	});
</script>
</head>
<body>
<!--header 开始-->
<div class="logo">
	<div class="logo_weight">
		<?php if(!isset($userinfo) && count($userinfo)<=0){?>
		<div class="fr mt40">
			<p class="fl mt10">目前已有<span class="coler">125648</span>人参加活动</p>
			<span class="sign ml10 fr" style="width:40px;">快速注册</span>
			<span class="sign ml10 mr10 fr" style="width:40px;">登陆</span>
		</div>
		<?php }else{?>
		<div class="logo_logo mt6"><img src="<?php echo $staticurl;?>/images/logo.jpg"></div>
		<div class="wan_susu">
			<p style="width:50px; height:50px;float: left; margin-right:20px;"><img width="50"  height="50" src="<?php echo echoUserAvatar($userinfo->avatar);?>"></p>
			<ul>
				<li><a href="#"><?php echo $userinfo->nick; ?></a>丨<a href="/member/message">消息</a>丨<a href="/member/invite">邀请好友 </a>丨<a href="#">退出</a></li>
				<li>您当前 <span class="coler"><?php echo $userinfo->jifen; ?></span>积分</li>
			</ul>
		</div>
		<?php }?>
	</div>
</div>
<!--header 结束-->

<!--nav 开始-->
<div id="bg">
	<div id="container">
		<ul id="nav">
			<li><a href="#" class="shubiao">首页</a></li>
			<li><a href="/try">免费试用</a></li>
			 <li><a href="#">亲子活动</a></li>
			<li><a href="#">积分兑换</a></li>
		</ul>
		<div class="buoy">亲子123官方QQ群：28259812</div>
	</div>
</div>
<!--nav 结束-->

<!-- 中间模板部分 -->
<?php echo $this->data['_OUTPUT'];?>

<?php echo $this->inc('elements/footer');?>