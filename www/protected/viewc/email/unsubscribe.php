<?php $this->inc("header");?>
<div class="container">
	<div style="margin-bottom: 50px;" class="row"></div>
    <div class="row">
	     <div class="span12">
	     	<div class="span3"></div>
	     	<?php if($valid){?>
		     	<div class="span6 well">
		     		<form action="/email/unsubscribe/" method="POST">
			     		<div class="alert">
							<?php echo $nick?$nick:$email;?>,您好！<br/><br/><strong>您确定要取消订阅吗？</strong><br/>取消订阅后您将无法收到我们的促销活动信息！
			     		</div>
						<div class="form-actions">
						  <input type="hidden" name="email" value="<?php echo $email;?>" />
						  <input type="hidden" name="code" value="<?php echo $code;?>" />
						  <input type="hidden" name="submit" value=1 />
						  <button type="submit" class="btn btn-primary">确定取消订阅</button>
						  <a type="button" class="btn" href="/">继续订阅</a>
						</div>
					</form>
				</div>
	     	<?php }else{ ?>
		     	<div class="alert span6">
					<h4>
						提示!
					</h4> 您提交的信息已经记录！
				</div>
	     	<?php }?>
	     	<div class="span3"></div>
	      </div>
    </div>
</div>
<?php $this->inc("footer");?>