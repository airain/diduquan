<?php
$this->inc("header");
?>
<div class="">
    <div class="row">
	      <div id="main"  class="col-md-12">
	      		<h5 class="">
					    <ul class="breadcrumb">
						    <li><?php echo $module_name;?>管理</li>
						    <li class="active"><?php echo '试用报告' ?></li>
					    </ul>
				</h5>
	      		<div data-widget="navfixed" data-widget-config='{}'  class="j_subnav" style="overflow: hidden;">
		      		<form class="j_search form well" role="form" action="/admin/try/ptlist">
		      			<input type="hidden" name="search" value="1" />
		      			<ul class="list-unstyled list-inline">
		      				<li>
					    		<label>标题：</label>
					    		<input name="stitle" type="text" class="input-sm" placeholder="%#%..." value="<?php echo $stitle;?>">
					    	</li>
		      				<li>
					    		<label>用户：</label>
					    		<input name="snick" type="text" class="input-sm" placeholder="%#%..." value="<?php echo $snick;?>">
					    	</li>
							<li><button type="submit" class="btn btn-info j_submit">搜索</button></li>
						</ul>
					</form>
				</div>
				<div id="dlist" class="j_box j_has_loading" >
					<?php if($list){?>
					<div style="display:none;position: absolute; top: 5px;z-index:1021;" class="j_action alert alert-success">
					  <a class="j_removeall" href="javascript:;">删除</a>
					</div>
					<table class="table table-striped table-bordered table-hover table-condensed">
				                  <thead>
				                      <tr>
				                          <th style="width:50px;"><label class="checkbox"><input class="j_selectall" data-widget="selectall" data-widget-config='{target:".j_data_list",action:".j_action"}'  type="checkbox">all</label></th>
				                          <th>标题</th><th>用户</th><th>图片数</th><th>状态</th><th>发布时间</th>
				                          <th style="width: 70px;">操作</th>
				                      </tr>
				                  </thead><!-- 表头可选 -->
				                  <tbody class="j_data_list">
					                  <?php foreach($list as $k => $v){?>
					                  	<tr prid="<?php echo $v['prid'];?>">
				                  		  <td><input type="checkbox" value="<?php echo $v['prid'];?>"> <?php echo $v['prid']; ?></td>
													<td><a href="/admin/try/prview?prid=<?php echo $v['prid'];?>"><?php echo $v['title'];?></a></td>
													<td><?php echo $v['nick']?></td>
													<td><?php echo $v['img_cnt'];?></td>
													<td><?php echo getTypeS(array('type'=>'text','checked'=>$v['state'],'data'=>array('正常','已删除')));?></td>
													<td><?php echo date('Y-m-d',$v['createtime']);?></td>

				                          <td>
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
				</div>
	      </div>
    </div>
</div>
<?php
$this->inc("footer");
?>

