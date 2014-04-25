<?php $this->inc("header");?>
<style>
    body {
        padding-bottom: 40px;
        padding-top: 0px;
    }
</style>
<div class="container-fluid">
	<div class="row">
		<h3>飞+</h3>
	</div>
</div>
<hr/>
<div class="container">
    <div class="row">
	     <div class="span6">
	        <form method="POST" action="/admin/login/ajax"  class="form-horizontal form-pos j_validate">
			  <div class="form-group">
			    <label class="control-label" for="inputEmail">登录名</label>
			    <div class="col-sm-10">
			      <input name="email" value="<?php echo cookie("username");?>" type="email" id="inputEmail" placeholder="邮箱" required>
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="control-label" for="inputPassword">密码</label>
			    <div class="col-sm-10">
			      <input name="password" type="password" id="inputPassword" placeholder="密码" required>
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="col-sm-10">
			      <div id="error" class="alert hide">
					  <button type="button" class="close" >&times;</button>
					  <span>&nbsp;</span>
					</div>
			      <button type="submit" class="btn btn-primary" >登录</button>
			    </div>
			  </div>
			</form>
	      </div>
	      <div class="span6">
	      	<a title="使用淘宝账号登录" href="<?php //echo $tao_login_url;?>" style="background-color: red;"><i class="icon-heart icon-white"></i></a>
	      </div>
    </div>
</div>

<?php $this->inc("footer");?>