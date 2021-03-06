<?php if($list){?>
	<div style="display:none;position: absolute; top: -30px;z-index:1021;" class="j_action alert alert-success">
	  <a class="j_removeall" href="javascript:;">删除</a>
	</div>
	<table class="table table-striped table-bordered table-hover table-condensed">
                  <thead>
                      <tr>
                          <th style="width:50px;"><label class="checkbox"><input class="j_selectall" data-widget="selectall" data-widget-config='{target:".j_data_list",action:".j_action"}'  type="checkbox">all</label></th>
                          <th>标题</th><th>年龄段</th><th>城市</th><th>类型</th><th>是否免费</th><th>已用</th><th>剩余</th><th>报名数</th><th>报名日期</th><th>添加时间</th>
                          <th style="width: 70px;">操作</th>
                      </tr>
                  </thead><!-- 表头可选 -->
                  <tbody class="j_data_list">
	                  <?php foreach($list as $k => $v){?>
	                  	<tr did="<?php echo $v['aid'];?>">
                  		  <td><input type="checkbox" value="<?php echo $v['aid'];?>">
								<?php echo $v['aid'];?>
                  		  </td>
									<td><?php echo $v['title'];?></td>
									<td><?php echo $v['totype'];?></td>
									<td><?php echo $v['city'];?></td>
									<td><?php echo $v['type'];?></td>
									<td><?php echo $v['isfree'];?></td>
									<td><?php echo $v['used_cnt'];?></td>
									<td><?php echo $v['remain_cnt'];?></td>
									<td><?php echo $v['b_cnt'];?></td>
									<td><?php echo $v['b_stattime'],'~',$v['b_endtime'];?></td>
									<td><?php echo date('Y-m-d H:i:s',$v['createtime']);?></td>

                          <td>
                          	<div class="btn-group">
							  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
							    操作 <span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu j_list_menu_opt" role="menu">
							  	<li><a data-opt="edit" href="/admin/activity/update?aid=<?php echo $v['aid'];?>">编辑</a></li>
							    <li><a data-opt="remove" href="javascript:;">删除</a></li>
							  </ul>
							</div>
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