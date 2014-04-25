<?php
$this->inc("header");
?>
<div class="container-fluid">
    <div class="row">
	      <div id="main"  class="col-md-12">
	      	  <h5 class=""><?php echo $module_name;?>编辑 <i class="text-muted">|</i> <a data-placement="bottom"  title="<?php echo $module_name;?>管理" class="glyphicon glyphglyphicon glyphicon-plus-sign" href="/admin/user/index" ></a></h5>
			  <form method="POST" class="form-horizontal form-pos j_validate j_add">
				<div class="form-group">
				  <label class="col-sm-2 control-label" >类型</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="类型0:管理员;1:普通用户"  name="type" value="<?php echo $item->type;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >亲昵</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="亲昵"  name="nick" value="<?php echo $item->nick;?>" required/>
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >Email</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="Email"  name="email" value="<?php echo $item->email;?>" required/>
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >手机号</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="手机号"  name="mobile" value="<?php echo $item->mobile;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >密码</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="密码"  name="password" value="" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >淘宝ID</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="淘宝ID"  name="tao_uid" value="<?php echo $item->tao_uid;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >用户状态</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="用户状态"  name="state" value="<?php echo $item->state;?>" />
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

