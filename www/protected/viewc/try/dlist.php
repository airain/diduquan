<?php if($list){?>
	<div style="display:none;position: absolute; top: -30px;z-index:1021;" class="j_action alert alert-success">
	  <a class="j_removeall" href="javascript:;">删除</a>
	</div>
	<table class="table table-striped table-bordered table-hover table-condensed">
                  <thead>
                      <tr>
                          <th style="width:50px;"><label class="checkbox"><input class="j_selectall" data-widget="selectall" data-widget-config='{target:".j_data_list",action:".j_action"}'  type="checkbox">全选</label></th>
                          <th>ID</th><th>合作商id</th><th>标题</th><th>产品类型id</th><th>产品价格</th><th>产品消费积分</th><th>试用报价奖励积分</th><th>参与对象[0所有，1备孕，2孕妇，3产妇，4孩子]</th><th>申请规则</th><th>产品详细信息</th><th>产品logo</th><th>申请区域[城市]</th><th>城市id</th><th>省份</th><th>省份id</th><th>配送方式[1包邮，2自取，3付邮]</th><th>已用商品数[申请成功人数]</th><th>剩余商品数</th><th>申请人数</th><th>报名开始时间</th><th>报名截止日期</th><th>报告提交开始时间</th><th>报告提交截止日期</th><th>已提交报告数</th><th>添加时间</th>
                          <th style="width: 70px;">操作</th>
                      </tr>
                  </thead><!-- 表头可选 -->
                  <tbody class="j_data_list">
	                  <?php foreach($list as $k => $v){?>
	                  	<tr did="<?php echo $v['pid'];?>">
                  		  <td><input type="checkbox" value="<?php echo $v['pid'];?>"></td>
                          									<td><?php echo $v['pid'];?></td>
									<td><?php echo $v['parter_id'];?></td>
									<td><?php echo $v['title'];?></td>
									<td><?php echo $v['type_id'];?></td>
									<td><?php echo $v['price'];?></td>
									<td><?php echo $v['jifen'];?></td>
									<td><?php echo $v['reward_jifen'];?></td>
									<td><?php echo $v['totype'];?></td>
									<td><?php echo $v['desc'];?></td>
									<td><?php echo $v['content'];?></td>
									<td><?php echo $v['pic'];?></td>
									<td><?php echo $v['city'];?></td>
									<td><?php echo $v['city_id'];?></td>
									<td><?php echo $v['provice'];?></td>
									<td><?php echo $v['province_id'];?></td>
									<td><?php echo $v['posttype'];?></td>
									<td><?php echo $v['used_cnt'];?></td>
									<td><?php echo $v['remain_cnt'];?></td>
									<td><?php echo $v['b_cnt'];?></td>
									<td><?php echo $v['b_stattime'];?></td>
									<td><?php echo $v['b_endtime'];?></td>
									<td><?php echo $v['bg_stattime'];?></td>
									<td><?php echo $v['bg_endtime'];?></td>
									<td><?php echo $v['bg_cnt'];?></td>
									<td><?php echo $v['createtime'];?></td>

                          <td>
                          	<a class="j_edit" href="/try/update?id=<?php echo $v['pid'];?>">编辑</a>
                          	<i class="muted">|</i>
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