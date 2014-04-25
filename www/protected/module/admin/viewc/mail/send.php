<?php
$this->inc("header");
?>
<div class="container-fluid">
    <div class="row">
	      <div id="main"  class="col-md-12">
	      	  <h5 class=""><?php echo $module_name;?>发邮件 <i class="text-muted">|</i> <a data-placement="bottom"  title="<?php echo $module_name;?>管理" class="glyphicon glyphglyphicon glyphicon-plus-sign" href="/admin/mail/index" ></a></h5>
			  <form method="POST" class="form-horizontal form-pos j_validate j_add">
				<div class="form-group">
				  <label class="col-sm-2 control-label" >收件人</label>
				  <div class="col-sm-10">
				    <textarea class="input-xlarge" placeholder="收件人"  name="to"  rows=3  required /></textarea>
				    <p class="help-block">每行一条</p>
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >邮件标题</label>
				  <div class="col-sm-10">
				    <input type="text" class="input-xxlarge" placeholder="邮件标题"  name="title"  required/>
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >内容</label>
				  <div class="col-sm-10">
				    <textarea class="input-xxlarge" placeholder="内容"  name="content"  rows=6 required /></textarea>
				    <p class="help-block">支持html源码</p>
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >发送频率</label>
				  <div class="col-sm-10">
				  	<div class="input-append">
					  	<input class="input-mini" type="text" name="sleep" value="1" />
					  	<span class="add-on">秒</span>
				  	</div>
		            <p class="help-inline">[用户多账号控制发送频率]</p>
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >代理服务器</label>
				  <div class="col-sm-10">
		            <label class="radio inline">
				  		<input type="radio" checked="checked" name="proxy" value="local" />本地邮箱
		            </label>
		            <label class="radio inline">
				  		<input type="radio" name="proxy" value="qq" />QQ企业邮箱
		            </label>
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >发送间隔</label>
				  <div class="col-sm-10">
		            <label class="radio inline">
				  		<input type="radio" checked="checked" name="interval" value="24" />一天
		            </label>
		            <label class="radio inline">
				  		<input type="radio" name="interval" value="12" />12小时
		            </label>
		            <label class="radio inline">
				  		<input type="radio" name="interval" value="6" />6小时
		            </label>
		            <label class="radio inline">
				  		<input type="radio" name="interval" value="1" />1小时
		            </label>
		            <p class="help-inline">[多长时间内，同一邮箱，只发送一次]</p>
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