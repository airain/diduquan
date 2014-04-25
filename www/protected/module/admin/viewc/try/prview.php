<?php
$this->inc("header");
?>
<div class="container-fluid">
    <div class="row">
	      <div id="main"  class="col-md-12">
	      		<h5 class="">
					    <ul class="breadcrumb">
						    <li><?php echo $module_name;?>管理</li>
						    <li><a href="/admin/try/prlist"><?php echo '试用报告' ?></a></li>
						    <li class="active"><?php echo $article->title ?></li>
					    </ul>
				</h5>
	      		<div class="container form-pos">
	      			<div class="row text-center">
						<blockquote>
						  <h4><?php echo $article->title; ?></h4>
						  <small>发布者：<?php echo $article->nick; ?>　　日期：<?php echo date('Y-m-d H:i:s',$article->createtime); ?></small>
						</blockquote>
	      			</div>
	      			<div class="row highlight">
						<pre>
	      					<p><?php echo $article->des; ?></p>
	      				</pre>
	      			 </div>
					<div class="row text-left">
						<p>
						<?php echo $article->content; ?>
						</p>
	      			 </div>


				</div>
	      </div>
    </div>
</div>
<?php
$this->inc("footer");
?>

