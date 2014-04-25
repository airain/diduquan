<?php
$this->inc("header");
?>
<div class="container-fluid">
    <div class="row">
	      <div id="main"  class="col-md-12">
	      	  <h5 class=""><?php echo $module_name;?>添加 <i class="text-muted">|</i> <a data-placement="bottom"  title="<?php echo $module_name;?>管理" class="glyphicon glyphglyphicon glyphicon-plus-sign" href="/admin/parter/index" ></a></h5>
			  <form method="POST" class="form-horizontal form-pos j_validate j_add">
				<div class="form-group">
				  <label class="col-sm-2 control-label" >登录名称</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="登录名称"  name="username" value="<?php echo $item->username;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >登录密码</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="登录密码"  name="pwd" value="<?php echo $item->pwd;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >公司名称</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="公司名称"  name="company" value="<?php echo $item->company;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >公司logo图</label>
				  <div class="col-sm-10">
				  	<input type="hidden" name="logo" id="logo" />
				  	<div id="showImgBox"><img id="showImg" src="<?php echo getImgUrl($item->logo); ?>"/></div>
				    <div id="fileQueue"></div>
				    <input type="text" name="uploadify" id="uploadify" />
				    <a href="javascript:;" id="start_upload">start_upload</a>
				    <!-- <input type="text" placeholder="公司logo图"  name="logo" value="<?php echo $item->logo;?>" /> -->
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >公司类型</label>
				  <div class="col-sm-10">
				  	<?php getCompanyType(array('type'=>'select', 'checked'=>$item->type)); ?>
				    <!-- <input type="text" placeholder="公司类型"  name="type" value="<?php echo $item->type;?>" /> -->
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >公司地址</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="公司地址"  name="address" value="<?php echo $item->address;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >邮编</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="邮编"  name="postcode" value="<?php echo $item->postcode;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >公司介绍</label>
				  <div class="col-sm-10">
				  	<textarea id="info" name="info" rows="5" cols="70" ><?php echo $item->info;?>33</textarea>
				    <!-- <input type="text" placeholder="公司介绍"  name="info" value="<?php echo $item->info;?>" /> -->
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >邮箱</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="邮箱"  name="email" value="<?php echo $item->email;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >联系人</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="联系人"  name="contact" value="<?php echo $item->contact;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >联系电话</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="联系电话"  name="mobile" value="<?php echo $item->mobile;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >其他联系电话</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="其他联系电话"  name="iphone" value="<?php echo $item->iphone;?>" />
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

