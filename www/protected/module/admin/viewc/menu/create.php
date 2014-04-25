<?php
$this->inc("header");
?>
<div class="container-fluid">
    <div class="row">
	      <div id="main"  class="col-md-12">
	      	  <h5 class=""><?php echo $module_name;?>添加 <i class="text-muted">|</i> <a data-placement="bottom"  title="<?php echo $module_name;?>管理" class="glyphicon glyphglyphicon glyphicon-plus-sign" href="/admin/menu/index" ></a></h5>
			  <form method="POST" class="form-horizontal form-pos j_validate j_add">
				<div class="form-group">
				  <label class="col-sm-2 control-label" >父ID</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="父ID"  name="pid" value="<?php echo $item->pid;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >名称</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="名称"  name="name" value="<?php echo $item->name;?>" required/>
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >排序</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="排序"  name="sort" value="<?php echo $item->sort;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >url</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="url"  name="url" value="<?php echo $item->url;?>" required/>
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >打开方式</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="打开方式"  name="target" value="<?php echo $item->target;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >是否叶子节点</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="是否叶子节点"  name="isleaf" value="<?php echo $item->isleaf;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >深度</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="深度"  name="deep" value="<?php echo $item->deep;?>" />
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

