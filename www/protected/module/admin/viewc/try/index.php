<?php
$this->inc("header");
?>
<div class="container-fluid">
    <div class="row">
	      <div id="main"  class="col-md-12">
	      		<h5 class=""><?php echo $module_name;?>管理 <i class="text-text-muted">|</i> <a data-placement="bottom"  title="<?php echo $module_name;?>添加" class="glyphicon glyphglyphicon glyphicon-plus-sign" href="/admin/try/create" ></a></h5>
	      		<div data-widget="navfixed" data-widget-config='{}'  class="j_subnav" style="overflow: hidden;">
		      		<form class="j_search well form">
		      			<ul class="list-unstyled list-inline">
		      				<?php foreach($s_field as $k => $v){?>
						    	<li>
						    		<label><?php echo $v['label'];?>:</label>
						    		<input name="<?php echo $k;?>" type="text" class="input-small" placeholder="<?php echo isset($v['search'])?str_replace(array("#","%"), array($v['label'],"*"), $v['search']):$v['label'];?>...">
						    	</li>
						    <?php }?>
							<li><button type="submit" class="btn btn-info j_submit">搜索</button></li>
						</ul>
					</form>
				</div>
				<div id="dlist" class="j_box j_has_loading" ></div>
	      </div>
    </div>
</div>
<?php
$this->inc("footer");
?>

