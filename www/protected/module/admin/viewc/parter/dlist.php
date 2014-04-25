<?php if($list){?>
	<div class="alert">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<span class="icon-ok-circle"></span> <strong>正常</strong> |
		<span class="icon-remove-sign"></span> <strong>被禁用</strong> |
		<span class="icon-remove-circle"></span> <strong>已删除</strong>
	</div>
	<div style="display:none;position: absolute; top: -30px;z-index:1021;" class="j_action alert alert-success">
	  <a class="j_removeall" href="javascript:;">删除</a>
	</div>
	<table class="table table-striped table-bordered table-hover table-condensed">
                  <thead>
                      <tr>
                          <th style="width:50px;"><label class="checkbox"><input class="j_selectall" data-widget="selectall" data-widget-config='{target:".j_data_list",action:".j_action"}'  type="checkbox">all</label></th>
                          <th>id</th><th>帐号</th><th>名称</th><th>类型</th><th>邮箱</th><th>联系人</th><th>联系电话</th><th>状态</th>
                          <th style="width: 70px;">操作</th>
                      </tr>
                  </thead><!-- 表头可选 -->
                  <tbody class="j_data_list">
	                  <?php foreach($list as $k => $v){?>
	                  	<tr did="<?php echo $v['id'];?>">
                  		  <td><input type="checkbox" value="<?php echo $v['id'];?>"></td>
                          									<td><?php echo $v['id'];?></td>
									<td><?php echo $v['username'];?></td>
									<td><?php echo $v['company'];?></td>
									<td><?php echo getCompanyType(array('type'=>'text','checked'=>$v['type']));?></td>
									<td><?php echo $v['email'];?></td>
									<td><?php echo $v['contact'];?></td>
									<td><?php echo $v['mobile'];?></td>
									<td>
										<span class=" <?php echo $v['disable']?'icon-remove-circle':($v['statue']?'icon-remove-sign':'icon-ok-circle'); ?>"></span>
									</td>

                          <td>
                          	<a class="j_edit" href="/admin/parter/update?id=<?php echo $v['id'];?>">编辑</a>
                          	<i class="text-muted">|</i>
                          	<?php if($v['statue']) {?>
                          	<a class="j_remove" data-op="unban" href="javascript:;">启用</a>
                          	<?php }else {?>
                          	<a class="j_remove" data-op="ban" href="javascript:;">禁用</a>
                          	<?php }?>
                          	<?php if(!$v['disable']) {?>
                          	<i class="text-muted">|</i>
                          	<a class="j_remove" data-op="del" href="javascript:;">删除</a>
                          	<?php }?>
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