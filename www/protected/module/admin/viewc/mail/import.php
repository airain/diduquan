<?php
$this->inc("header");
?>
<div class="container-fluid">
    <div class="row">
	      <div id="main"  class="col-md-12">
	      	  <h5 class=""><?php echo $module_name;?>导入<i class="text-muted">|</i> <a data-placement="bottom"  title="<?php echo $module_name;?>管理" class="glyphicon glyphglyphicon glyphicon-plus-sign" href="/admin/mail/index" ></a></h5>
			  <div class="form-group">
			    	<label class="col-sm-2 visible-sm" >
			      <input type="hidden" name="submit" value="1" /></label>
			      <div class="col-sm-10">
					  <button type="submit"  class="btn btn-primary" data-loading-text="保存中...">&nbsp;&nbsp;保存&nbsp;&nbsp;</button>
					  <a type="button" class="btn j_cancel" href="javascript:window.history.go(-1);">取消</a>
				   </div>
				</div>
	      </div>
    </div>
</div>
<?php
$this->inc("footer");
?>

