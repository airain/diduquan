<?php
$this->inc("header");
?>
<div class="container-fluid">
    <div class="row">
	      <div id="main"  class="col-md-12">
	      	  <h5 class=""><?php echo $module_name;?>编辑 <i class="text-muted">|</i> <a data-placement="bottom"  title="<?php echo $module_name;?>管理" class="glyphicon glyphglyphicon glyphicon-plus-sign" href="/admin/mail/index" ></a></h5>
			  <form method="POST" class="form-horizontal form-pos j_validate j_add">
				<div class="form-group">
				  <label class="col-sm-2 control-label" >类型:</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="类型"  name="type" value="<?php echo $item->type;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >Email:</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="Email"  name="email" value="<?php echo $item->email;?>" required/>
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >亲昵:</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="亲昵"  name="nick" value="<?php echo $item->nick;?>" />
				  </div>
				</div>

			    <div class="form-group">
			    	<label class="col-sm-2 visible-sm" >
			      <input type="hidden" name="submit" value="1" /></label>
			      <div class="col-sm-10">
					  <button type="submit"  class="btn btn-primary" data-loading-text="保存中...">&nbsp;&nbsp;保存&nbsp;&nbsp;</button>
					  <a type="button" class="btn j_cancel" href="javascript:window.history.go(-1);">取消</a>
				   </div>
				</div>
			 </form>
	      </div>
    </div>
</div>
<?php
$this->inc("footer");
?>

