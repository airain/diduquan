<?php extract($this->data);?>
<?php
$this->inc("header");
?>

<?php $this->inc("nav"); ?>

<div class="container">
    <div class="row">
	     <div class="col-md-2">
		 	<?php $this->inc("menu");?>
	      </div>
	      <div id="main"  class="col-md-10">
	        	<iframe id="inner" name="inner" src="" width="100%" marginheight="0" marginwidth="0" frameborder="0" ></iframe>
	      </div>
    </div>

</div>
<?php
$this->inc("footer");
?>

