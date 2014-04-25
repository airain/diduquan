<?php extract($this->data);?>
<?php 
$this->inc("header"); 
?>

<?php $this->inc("nav"); ?>

<div class="container">
    <div class="row">
	     <div class="span12 ">
	        <form class="well form-search control-group form-horizontal">
	        	
	        	<fieldset>
				    <div class="control-group">
				      <label class="control-label" for="value">关键字：</label>
				      <div class="controls">
				      	 <input id="value" placeholder="关键字..." type="text" class="input-xlarge">
				        <p class="help-block">需要查询的淘宝关键字</p>
				      </div>
				    </div>
				    <div class="control-group">
				      <label class="control-label" for="nick">亲昵：</label>
				      <div class="controls">
				      	<input value="<?php echo $_SESSION['NICK'];?>" id="nick" placeholder="亲昵..." type="text" class="input-xlarge">
				      </div>
				    </div>
				    <div class="control-group">
				      <div class="controls">
				      	<button id="search" type="button" class="btn btn-primary"  data-loading-text="查询中，请稍后...">查询</button>
				      </div>
				    </div>
				  </fieldset>
			</form>
			<div id="searchBox"></div>
	      </div>
		 
    </div>
    
</div>

<?php $this->inc("footer");; ?>


