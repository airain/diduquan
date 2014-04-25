<?php
$this->inc("header");
$opt_state = array('未审核','未通过','通过');
?>
<div class="">
    <div class="row">
	      <div id="main"  class="col-md-12">
	      		<h5 class="">
					    <ul class="breadcrumb">
						    <li><?php echo $module_name;?>管理</li>
						    <li class="active"><?php echo '申请名单' ?></li>
					    </ul>
				</h5>
	      		<div data-widget="navfixed" data-widget-config='{}'  class="j_subnav" style="overflow: hidden;">
		      		<form class="j_search form well" method="get" role="form" action="/admin/try/sqlist">
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
		      				<li>
					    		<label>状态：</label>
					    		<?php echo getTypeS(array('id'=>'sstate','type'=>'radio','checked'=>$sstate,'data'=>$opt_state));?>
					    	</li>
							<li><button type="submit" class="btn btn-info j_submit">搜索</button></li>
						</ul>
					</form>
				</div>
				<div id="dlist" class="j_box j_has_loading" >
					<?php if($list){?>
					<div style="display:none;position: absolute; top: 5px;z-index:1021;" class="j_action alert alert-success">
					  <a data-opt="agree" class="j_removeall" href="javascript:;">通过</a>
					</div>
					<table class="table table-striped table-bordered table-hover table-condensed">
				                  <thead>
				                      <tr>
				                          <th style="width:50px;"><label class="checkbox"><input class="j_selectall" data-widget="selectall" data-widget-config='{target:".j_data_list",action:".j_action"}'  type="checkbox">all</label></th>
				                          <th>标题</th><th>用户</th><th>报告</th><th>状态</th><th>发布时间</th>
				                          <th style="width: 70px;">操作</th>
				                      </tr>
				                  </thead><!-- 表头可选 -->
				                  <tbody class="j_data_list">
					                  <?php foreach($list as $k => $v){?>
					                  	<tr data-id="<?php echo $v['paid'];?>">
				                  		  <td><input type="checkbox" value="<?php echo $v['paid'];?>"> <?php echo $v['paid']; ?></td>
													<td><a href="/admin/try/prview?paid=<?php echo $v['paid'];?>"><?php echo $v['title'];?></a></td>
													<td><?php echo $v['nick']?></td>
													<td><?php echo getTypeS(array('type'=>'text','checked'=>$v['isbg'],'data'=>array('否','是')));?></td>
													<td><?php echo getTypeS(array('type'=>'text','checked'=>$v['state'],'data'=>$opt_state));?></td>
													<td><?php echo date('Y-m-d',$v['createtime']);?></td>

				                          <td>
											<div class="btn-group">
											  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
											    操作 <span class="caret"></span>
											  </button>
											  <ul class="dropdown-menu j_list_menu_opt" role="menu">
											  	<li><a data-opt="agree" href="javascript:;">通过</a></li>
											  	<li><a data-opt="refuse" href="javascript:;">拒绝</a></li>
											    <!-- <li><a data-opt="remove" href="javascript:;">删除</a></li> -->
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
				</div>
	      </div>
    </div>
</div>
<?php
$this->inc("footer");
?>

