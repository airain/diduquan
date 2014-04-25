<?php extract($this->data);?>
<!-- nav -->
<div id="navbar" class="navbar">
  <div class="navbar-inner">
    <div class="container-fluid">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      
      <a class="brand" data-content="飞+" data-original-title="飞+" data-placement="bottom" title="" href="javascript:;">飞+</a>
      
      <div class="nav-collapse">
        <ul id="nav" class="nav">
        	<?php foreach($menu as $m){?>
        		<li <?php echo $m['active']?'class="active"':'';?>><a data-menu-id="<?php echo $m['id'];?>" href="javascript:;"><?php echo $m['name'];?></a></li>
        	<?php }?>
        </ul>
        <p class="navbar-text pull-right"><?php echo $_SESSION['NICK'];?>，您好！ <a href="/logout" >[退出账号]</a></p>
      </div><!--/.nav-collapse -->
    </div>
  </div>
</div>