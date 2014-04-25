<?php
$this->inc("header");
?>
<div class="container-fluid">
    <div class="row">
	      <div id="main"  class="col-md-12">
	      	  <h5 class=""><?php echo $module_name;?>添加 <i class="text-muted">|</i> <a data-placement="bottom"  title="<?php echo $module_name;?>管理" class="glyphicon glyphglyphicon glyphicon-plus-sign" href="/admin/member-controller/index" ></a></h5>
			  <form method="POST" class="form-horizontal form-pos j_validate j_add">
				<div class="form-group">
				  <label class="col-sm-2 control-label" >用户昵称</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="用户昵称"  name="nick" value="<?php echo $item->nick;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >性别</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="性别"  name="gender" value="<?php echo $item->gender;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >邮箱</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="邮箱"  name="email" value="<?php echo $item->email;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >真实姓名</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="真实姓名"  name="realname" value="<?php echo $item->realname;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >手机号</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="手机号"  name="mobile" value="<?php echo $item->mobile;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >地址</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="地址"  name="address" value="<?php echo $item->address;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >邮编</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="邮编"  name="postcode" value="<?php echo $item->postcode;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >邮箱是否确认</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="邮箱是否确认"  name="isemail" value="<?php echo $item->isemail;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >用户状态[0正常，1停用]</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="用户状态[0正常，1停用]"  name="status" value="<?php echo $item->status;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >积分</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="积分"  name="jifen" value="<?php echo $item->jifen;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >添加时间</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="添加时间"  name="regtime" value="<?php echo $item->regtime;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >申请成功次数</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="申请成功次数"  name="try_cnt" value="<?php echo $item->try_cnt;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >发布报告次数</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="发布报告次数"  name="try_bj_cnt" value="<?php echo $item->try_bj_cnt;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >登录IP</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="登录IP"  name="last_ip" value="<?php echo $item->last_ip;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >登录时间</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="登录时间"  name="last_time" value="<?php echo $item->last_time;?>" />
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

