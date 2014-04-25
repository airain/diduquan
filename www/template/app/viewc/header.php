<?php extract($this->data);?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $title;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="<?php echo $staticurl;?>/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo $staticurl;?>/css/admin/common.css" rel="stylesheet">
<script src="<?php echo $staticurl;?>/js/jquery.min.js"></script>
<script data-main="<?php echo $script;?>" charset="utf-8" id="seajsnode" src="<?php echo $staticurl;?>/js/seajs/sea.js"></script>
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<style>
    body {
        padding-bottom: 0px;
        padding-top: 0px;
    }
</style>
</head>
<body>