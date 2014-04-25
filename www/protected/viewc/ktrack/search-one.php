<?php extract($this->data);?>
<div class="well"> 
		 <h4>查询结果</h4>
		 <?php if($v){?>
			 <ul class="unstyled">
			 	<li>
			 		<label>产品：</label>
			 		<p><a target="_blank" href="<?php echo $v['url'];?>"><?php echo $v['title'];?></a></p>
			 	</li>
			 	<li>
			 		<label>卖家：</label>
			 		<p><?php echo $v['nick'];?></p>
			 	</li>
			 	<li>
			 		<label>排名：</label>
			 		<p><?php echo $v['ranking'];?></p>
			 	</li>
			 	<li>
			 		<label>位置：</label>
			 		<p><a target="_blank" href="<?php echo $v['s_url'];?>"><?php echo $v['s_url'];?></a></p>
			 	</li>
			 </ul>
			 <?php }else{?>
			 	<p>未找到结果...</p>
			 <?php }?>
</div>