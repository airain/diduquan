<?php
$this->inc("header");
?>
<div class="container-fluid">
    <div class="row">
	      <div id="main"  class="col-md-12">
	      	  <h5 class=""><?php echo $module_name;?>编辑 <i class="text-text-muted">|</i> <a data-placement="bottom"  title="<?php echo $module_name;?>管理" class="glyphicon glyphglyphicon glyphicon-plus-sign" href="/admin/try/index" ></a></h5>
			  <form method="POST" class="form-horizontal form-pos j_validate j_add"  role="form">
				<div class="form-group">
				  <label class="col-sm-2 control-label" >商家</label>
				  <div class="col-sm-10">
				  	<?php echo showArrayType($parters,array('id'=>'parter_id','type'=>'select','checked'=>$item->parter_id)); ?>
				    <!-- <input type="text" placeholder="合作商id"  name="parter_id" value="<?php echo $item->parter_id;?>" /> -->
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >标题</label>
				  <div class="col-sm-5">
				    <input type="text" class="form-control" placeholder="标题"  name="title" value="<?php echo $item->title;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >产品类型id</label>
				  <div class="col-sm-10">
				  	<?php echo getProductType(array('id'=>'type_id','type'=>'select','checked'=>$item->type_id)); ?>
				    <!-- <input type="text" placeholder="产品类型id"  name="type_id" value="<?php echo $item->type_id;?>" /> -->
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >产品价格</label>
				  <div class="col-sm-2">
				  	<div class="input-group">
				    	<input type="number"  class="form-control" placeholder="产品价格"  name="price" value="<?php echo $item->price;?>" />
						<span class="input-group-addon">￥</span>
					</div>
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >产品消费积分</label>
				  <div class="col-sm-3">
				  	<div class="input-group">
				    	<input type="number"  class="form-control" placeholder="产品消费积分"  name="jifen" value="<?php echo $item->jifen;?>" />
						<span class="input-group-addon">积分</span>
					</div>
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >试用报价奖励积分</label>
				  <div class="col-sm-3">
				  	<div class="input-group">
				    	<input type="number"  class="form-control" placeholder="试用报价奖励积分"  name="reward_jifen" value="<?php echo $item->reward_jifen;?>" />
						<span class="input-group-addon">积分</span>
					</div>
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >参与对象</label>
				  <div class="col-sm-10">
				  	<?php echo getJoinType(array('id'=>'totype','type'=>'radio','checked'=>$item->totype)); ?>
				    <!-- <input type="text" placeholder="参与对象[0所有，1备孕，2孕妇，3产妇，4孩子]"  name="totype" value="<?php echo $item->totype;?>" /> -->
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >申请规则</label>
				  <div class="col-sm-10">
				  	<textarea placeholder="申请规则" name="desc" id="desc" cols="70" rows="5"><?php echo $item->desc;?></textarea>
				    <!-- <input type="text" placeholder="申请规则"  name="desc" value="<?php echo $item->desc;?>" /> -->
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >产品详细信息</label>
				  <div class="col-sm-10">
				  	<textarea cols="70" placeholder="产品详细信息" rows="5" name="content" id="content"><?php echo $item->content;?></textarea>
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >产品logo</label>
				  <div class="col-sm-10">
				  	<input type="hidden" name="pic" id="pic" />
				  	<div id="showImgBox"><img id="showImg" src="<?php echo getImgUrl($item->logo); ?>"/></div>
				    <div id="fileQueue"></div>
				    <input type="text" name="uploadify" id="uploadify" />
				    <!-- <input type="text" placeholder="产品logo"  name="pic" value="<?php echo $item->pic;?>" /> -->
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >申请区域[城市]</label>
				  <div class="col-sm-10">
				  	<script type="text/javascript">var cityid = '<?php echo $item->city_id;?>';</script>
				    <input type="hidden" placeholder="申请区域[城市]"  name="areaid" id="areaid" value="<?php echo $item->city;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >配送方式</label>
				  <div class="col-sm-10">
				  	<?php echo getPostType(array('id'=>'type_id','type'=>'select','checked'=>$item->posttype)); ?>
				    <!-- <input type="text" placeholder="配送方式[1包邮，2自取，3付邮]"  name="posttype" value="<?php echo $item->posttype;?>" /> -->
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >已用商品数[申请成功人数]</label>
				  <div class="col-sm-2">
				  	<div class="input-group">
				    	<input type="number"  class="form-control" disabled placeholder="0"  name="used_cnt" value="<?php echo $item->used_cnt;?>" />
						<span class="input-group-addon">件[人]</span>
					</div>
				    <!-- <input type="text" readonly placeholder="已用商品数[申请成功人数]"  name="used_cnt" value="<?php echo $item->used_cnt;?>" /> -->
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >剩余商品数</label>
				  <div class="col-sm-2">
				  	<div class="input-group">
				    	<input type="number"  class="form-control" placeholder="剩余商品数"  name="remain_cnt" value="<?php echo $item->remain_cnt;?>" />
						<span class="input-group-addon">件</span>
					</div>
				    <!-- <input type="text" placeholder="剩余商品数"  name="remain_cnt" value="<?php echo $item->remain_cnt;?>" /> -->
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >申请人数</label>
				  <div class="col-sm-2">
				  	<div class="input-group">
				    	<input type="number"  class="form-control" disabled placeholder="0"  name="b_cnt" value="<?php echo $item->b_cnt;?>" />
						<span class="input-group-addon">个</span>
					</div>
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >报名时间</label>
				  <div class="col-sm-10">
				    <input type="date" placeholder="报名开始时间" id="b_stattime" name="b_stattime" value="<?php echo $item->b_stattime;?>" />
				  	to
				    <input type="date" placeholder="报名截止日期" id="b_endtime" name="b_endtime" value="<?php echo $item->b_endtime;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >报告提交时间</label>
				  <div class="col-sm-10">
				    <input type="date" placeholder="报告提交开始时间" id="bg_stattime" name="bg_stattime" value="<?php echo $item->bg_stattime;?>" />
				  	to
				    <input type="date" placeholder="报告提交截止日期" id="bg_endtime" name="bg_endtime" value="<?php echo $item->bg_endtime;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >已提交报告数</label>
				  <div class="col-sm-2">
				  	<div class="input-group">
				    	<input type="number"  class="form-control" disabled placeholder="0"  name="bg_cnt" value="<?php echo $item->bg_cnt;?>" />
						<span class="input-group-addon">篇</span>
					</div>
				  </div>
				</div>

			    <div class="form-group">
			    	<label class="col-sm-2 visible-sm" >
			      <input type="hidden" name="submit" value="1" /></label>
			      <div class="col-sm-10">
					  <button type="submit"  class="btn btn-primary" data-loading-text="保存中...">&nbsp;&nbsp;保存&nbsp;&nbsp;</button>
					  <a type="button" class="btn j_cancel" href="javascript:window.history.go(-1);">取消</a>
				   </div>
				</div>
			 </form>
	      </div>
    </div>
</div>
<?php
$this->inc("footer");
?>

