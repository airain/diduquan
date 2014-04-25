<?php if($list){?>
	<div style="display:none;position: absolute; top: 5px;z-index:1021;" class="j_action alert alert-success">
	  <a class="j_removeall" href="javascript:;">删除</a>
	</div>
	<table class="table table-striped table-bordered table-hover table-condensed">
                  <thead>
                      <tr>
                          <th style="width:50px;"><label class="checkbox"><input class="j_selectall" data-widget="selectall" data-widget-config='{target:".j_data_list",action:".j_action"}'  type="checkbox">all</label></th>
                          <th>标题</th><th>类型</th><th>参与对象</th><th>城市</th><th>配送</th><th>已用</th><th>剩余</th><th>申请</th><th>报告</th><th>发布时间</th>
                          <th style="width: 70px;">操作</th>
                      </tr>
                  </thead><!-- 表头可选 -->
                  <tbody class="j_data_list">
	                  <?php foreach($list as $k => $v){?>
	                  	<tr did="<?php echo $v['pid'];?>">
                  		  <td><input type="checkbox" value="<?php echo $v['pid'];?>"> <?php echo $v['pid']; ?></td>
									<td><?php echo $v['title'];?></td>
									<td><?php echo getProductType(array('type'=>'text','checked'=>$v['type_id']));?></td>
									<td><?php echo getJoinType(array('type'=>'text','checked'=>$v['totype']));?></td>
									<td><?php echo $v['city'];?></td>
									<td><?php echo getPostType(array('type'=>'text','checked'=>$v['posttype']));?></td>
									<td><?php echo $v['used_cnt'];?></td>
									<td><?php echo $v['remain_cnt'];?></td>
									<td><?php echo $v['b_cnt'];?></td>
									<td><?php echo $v['bg_cnt'];?></td>
									<td><?php echo date('Y-m-d',$v['createtime']);?></td>

                          <td>
                          	<a class="j_edit" href="/admin/try/update?pid=<?php echo $v['pid'];?>">编辑</a>
                          	<i class="text-muted">|</i>
                          	<a class="j_remove" href="javascript:;">删除</a>
                          </td>
                      </tr>
                  <?php }?>
                  </tbody>
              </table>
              <div class="page"><?php echo $pager['pages'];?><?php echo $pager['page_size'];?></div>
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