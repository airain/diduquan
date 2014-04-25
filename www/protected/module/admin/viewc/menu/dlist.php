<?php if($list){?>
	<div style="display:none;position: absolute; top: -30px;z-index:1021;" class="j_action alert alert-success">
	  <a class="j_removeall" href="javascript:;">删除</a>
	</div>
	<table class="table table-striped table-bordered table-hover table-condensed">
                  <thead>
                      <tr>
                          <th style="width:50px;"><label class="checkbox"><input class="j_selectall" data-widget="selectall" data-widget-config='{target:".j_data_list",action:".j_action"}'  type="checkbox">all</label></th>
                          <th>ID</th><th>父ID</th><th>名称</th><th>排序</th><th>url</th><th>打开方式</th><th>是否叶子节点</th><th>深度</th><th>创建者</th><th>创建时间</th>
                          <th style="width: 70px;">操作</th>
                      </tr>
                  </thead><!-- 表头可选 -->
                  <tbody class="j_data_list">
	                  <?php foreach($list as $k => $v){?>
	                  	<tr did="<?php echo $v['id'];?>">
                  		  <td><input type="checkbox" value="<?php echo $v['id'];?>"></td>
                          									<td><?php echo $v['id'];?></td>
									<td><?php echo $v['pid'];?></td>
									<td><?php echo $v['name'];?></td>
									<td><?php echo $v['sort'];?></td>
									<td><?php echo $v['url'];?></td>
									<td><?php echo $v['target'];?></td>
									<td><?php echo $v['isleaf'];?></td>
									<td><?php echo $v['deep'];?></td>
									<td><?php echo $v['maker'];?></td>
									<td><?php echo date("Y-m-d H:i:s",$v['mktime']);?></td>

                          <td>
                          	<a class="j_edit" href="/admin/menu/update?id=<?php echo $v['id'];?>">编辑</a>
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