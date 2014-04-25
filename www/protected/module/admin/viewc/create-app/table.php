<?php $main = "";?>
<?php if($list){?>
	<table class="table table-striped table-bordered table-hover table-condensed">
                  <thead>
					<tr class=""><th>字段</th><th>主要</th><th>字段名</th><th>默认值</th><th>在表单显示</th><th>不为空</th><th>在列表显示</th><th>搜索</th></tr>
				</thead>
                  <tbody class="j_data_list">
                  <?php foreach($list as $k => $v){?>
                  <?php 
                  		$is_main = false;
                  		if($v['Key']=="PRI"){
                  			$main = $v['Field'];
                  			$is_main = true;
                  		}
                  ?>
	                   <tr>
                  		  	<td><?php echo $v['Field'];?></td>
							<td><?php if($is_main){?><i  class="icon-ok" ></i><?php }?></td>
							<td><input type="text" name="fields[<?php echo $v['Field'];?>][label]" value="<?php echo $v['Comment'];?>"></td>
							<td><input type="text" name="fields[<?php echo $v['Field'];?>][default]" value="<?php echo $v['Default'];?>"></td>
							<td><input type="checkbox" name="fields[<?php echo $v['Field'];?>][formview]" value="1" <?php echo $is_main?'disabled':'checked';?>></td>
							<td><input type="checkbox" name="fields[<?php echo $v['Field'];?>][notnull]" value="1"  <?php if($is_main){?> checked disabled<?php }?>></td>
							<td><input type="checkbox" name="fields[<?php echo $v['Field'];?>][listview]" value="1" <?php echo $is_main?'disabled checked':'checked';?>></td>
							<td>
								<input type="radio" name="fields[<?php echo $v['Field'];?>][search]" value="0" checked>不
								<input type="radio" name="fields[<?php echo $v['Field'];?>][search]" value="#">精确
								<input type="radio" name="fields[<?php echo $v['Field'];?>][search]" value="#%">左匹配
								<input type="radio" name="fields[<?php echo $v['Field'];?>][search]" value="%#">右匹配
								<input type="radio" name="fields[<?php echo $v['Field'];?>][search]" value="%#%">模糊匹配
							</td>
                      </tr>
                      <?php }?>
         	</tbody>
	</table>
	<input type="hidden" name="main" value="<?php echo $main;?>"/>
	<div class="alert">备注：主要字段默认不能为空，不在表单上显示，但在列表上显示。</div>
<?php }else{?>
	<?php $params = gpc_strip_slashes( $_GET)+gpc_strip_slashes( $_POST);?>
	<div class="alert alert-block">
	  <h4>未找到信息</h4>
	  你可以尝试更改查询条件试试！<br/>
	  当前条件为：
	  <blockquote>
	  	<ul class="unstyled">
	  		<?php foreach($params as $k => $v){?>
	  			<li><?php echo $k;?>: <?php echo htmlspecialchars($v);?></li>
	  		<?php }?>
	  	</ul>
	  </blockquote>
	</div>
<?php }?>