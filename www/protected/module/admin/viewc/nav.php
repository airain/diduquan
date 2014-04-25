<?php extract($this->data);?>
<!-- nav -->
<header role="banner" class="navbar navbar-inverse">
  <div class="container">
    <div class="navbar-header" style="float:none;">
      <button data-target=".bs-navbar-collapse" data-toggle="collapse" type="button" class="navbar-toggle">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="../">后台管理</a>
      <nav role="navigation" class="collapse navbar-collapse bs-navbar-collapse">
        <ul id="nav" class="nav navbar-nav">
          <?php foreach($menu as $m){?>
              <li<?php echo isset($m['active']) && $m['active']?' class="active"':'';?>><a data-menu-id="<?php echo $m['id'];?>" href="javascript:;"><?php echo $m['name'];?></a></li>
            <?php }?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li>
            <a href="#" data-original-title="飞+" data-content="飞+">飞+</a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</header>
