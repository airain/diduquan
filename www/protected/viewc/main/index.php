<?php $this->inc("header");?>
<div class="container-fluid">
    <div class="row-fluid">
	     <div class="span12 ">
	        <?php echo $_SESSION['NICK']?> <i class="muted"></i> <a href="/logout">登出</a>
	      </div>
    </div>
</div>

<?php $this->inc("footer");?>