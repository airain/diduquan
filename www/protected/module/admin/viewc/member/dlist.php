<?php if($list){?>
	<div style="display:none;position: absolute; top: -30px;z-index:1021;" class="j_action alert alert-success">
	  <a class="j_removeall" href="javascript:;">删除</a>
	</div>
	<table class="table table-striped table-bordered table-hover table-condensed">
                  <thead>
                      <tr>
                          <th style="width:50px;"><label class="checkbox"><input class="j_selectall" data-widget="selectall" data-widget-config='{target:".j_data_list",action:".j_action"}'  type="checkbox">all</label></th>
                          <th>用户id</th><th>昵称</th><th>性别</th><th>邮箱</th><th>姓名</th><th>手机号</th><th>地址</th><th>邮箱验证</th><th>状态</th><th>积分</th><th>登录时间</th>
                          <th style="width: 70px;">操作</th>
                      </tr>
                  </thead><!-- 表头可选 -->
                  <tbody class="j_data_list">
	                  <?php foreach($list as $k => $v){?>
	                  	<tr did="<?php echo $v['uid'];?>">
                  		  <td><input type="checkbox" value="<?php echo $v['uid'];?>"></td>
                          									<td><?php echo $v['uid'];?></td>
									<td><?php echo $v['nick'];?></td>
									<td><?php echo $v['gender']==null?'-':$v['gender'];?></td>
									<td><?php echo $v['email'];?></td>
									<td><?php echo $v['realname'];?></td>
									<td><?php echo $v['mobile'];?></td>
									<td><?php echo $v['address'];?></td>
									<td><span class="<?php echo $v['isemail']?'icon-ok':'icon-remove';?>"></span></td>
									<td><span class="<?php echo $v['status']?'icon-ban-circle':'icon-ok-circle';?>"></span></td>
									<td><?php echo $v['jifen'];?></td>
									<td><?php echo date("y-m-d H:i",$v['last_time']);?></td>

                          <td>
                          	<a class="j_edit" href="/admin/member/update?uid=<?php echo $v['uid'];?>">编辑</a>
                          	<i class="text-muted">|</i>
                          	<a class="j_remove" href="javascript:;">删除</a>
                          </td>
                      </tr>
                  <?php }?>
                  </tbody>
              </table>
              <div class="pagination"><?php echo $pager['pages'];?><?php echo $pager['page_size'];?></div>
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
