<?php
$this->inc("header");
?>
<div class="container-fluid">
    <div class="row">
	      <div id="main"  class="col-md-12">
	      	  <h5 class=""><?php echo $module_name;?>编辑 <i class="text-muted">|</i> <a data-placement="bottom"  title="<?php echo $module_name;?>管理" class="glyphicon glyphglyphicon glyphicon-plus-sign" href="/admin/maillog/index" ></a></h5>
			  <form method="POST" class="form-horizontal form-pos j_validate j_add">
				<div class="form-group">
				  <label class="col-sm-2 control-label" >Email</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="Email"  name="email" value="<?php echo $item->email;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >发送方式</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="发送方式"  name="type" value="<?php echo $item->type;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >发送状态</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="发送状态"  name="state" value="<?php echo $item->state;?>" />
				  </div>
				</div>

			    <div class="form-actions">
			      <input type="hidden" name="submit" value="1" />
				  <button type="submit"  class="btn btn-primary" data-loading-text="保存中...">&nbsp;&nbsp;保存&nbsp;&nbsp;</button>
				  <a type="button" class="btn j_cancel" href="javascript:window.history.go(-1);">取消</a>
				</div>
			 </form>
	      </div>
    </div>
</div>
<?php
$this->inc("footer");
?>

