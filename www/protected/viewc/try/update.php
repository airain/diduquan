<?php 
$this->inc("header"); 
?>
<div class="container-fluid">
    <div class="row-fluid">
	      <div id="main"  class="span12">
	      	  <h5 class=""><?php echo $module_name;?>编辑 <i class="muted">|</i> <a data-placement="bottom"  title="<?php echo $module_name;?>管理" class="icon-list-alt" href="/try/index" ></a></h5>
			  <form method="POST" class="form-horizontal j_validate j_add">
				<div class="control-group">
				  <label class="control-label" >合作商id</label>
				  <div class="controls">
				    <input type="text" placeholder="合作商id"  name="parter_id" value="<?php echo $item->parter_id;?>" />
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" >标题</label>
				  <div class="controls">
				    <input type="text" placeholder="标题"  name="title" value="<?php echo $item->title;?>" />
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" >产品类型id</label>
				  <div class="controls">
				    <input type="text" placeholder="产品类型id"  name="type_id" value="<?php echo $item->type_id;?>" />
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" >产品价格</label>
				  <div class="controls">
				    <input type="text" placeholder="产品价格"  name="price" value="<?php echo $item->price;?>" />
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" >产品消费积分</label>
				  <div class="controls">
				    <input type="text" placeholder="产品消费积分"  name="jifen" value="<?php echo $item->jifen;?>" />
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" >试用报价奖励积分</label>
				  <div class="controls">
				    <input type="text" placeholder="试用报价奖励积分"  name="reward_jifen" value="<?php echo $item->reward_jifen;?>" />
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" >参与对象[0所有，1备孕，2孕妇，3产妇，4孩子]</label>
				  <div class="controls">
				    <input type="text" placeholder="参与对象[0所有，1备孕，2孕妇，3产妇，4孩子]"  name="totype" value="<?php echo $item->totype;?>" />
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" >申请规则</label>
				  <div class="controls">
				    <input type="text" placeholder="申请规则"  name="desc" value="<?php echo $item->desc;?>" />
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" >产品详细信息</label>
				  <div class="controls">
				    <input type="text" placeholder="产品详细信息"  name="content" value="<?php echo $item->content;?>" />
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" >产品logo</label>
				  <div class="controls">
				    <input type="text" placeholder="产品logo"  name="pic" value="<?php echo $item->pic;?>" />
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" >申请区域[城市]</label>
				  <div class="controls">
				    <input type="text" placeholder="申请区域[城市]"  name="city" value="<?php echo $item->city;?>" />
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" >城市id</label>
				  <div class="controls">
				    <input type="text" placeholder="城市id"  name="city_id" value="<?php echo $item->city_id;?>" />
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" >省份</label>
				  <div class="controls">
				    <input type="text" placeholder="省份"  name="provice" value="<?php echo $item->provice;?>" />
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" >省份id</label>
				  <div class="controls">
				    <input type="text" placeholder="省份id"  name="province_id" value="<?php echo $item->province_id;?>" />
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" >配送方式[1包邮，2自取，3付邮]</label>
				  <div class="controls">
				    <input type="text" placeholder="配送方式[1包邮，2自取，3付邮]"  name="posttype" value="<?php echo $item->posttype;?>" />
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" >已用商品数[申请成功人数]</label>
				  <div class="controls">
				    <input type="text" placeholder="已用商品数[申请成功人数]"  name="used_cnt" value="<?php echo $item->used_cnt;?>" />
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" >剩余商品数</label>
				  <div class="controls">
				    <input type="text" placeholder="剩余商品数"  name="remain_cnt" value="<?php echo $item->remain_cnt;?>" />
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" >申请人数</label>
				  <div class="controls">
				    <input type="text" placeholder="申请人数"  name="b_cnt" value="<?php echo $item->b_cnt;?>" />
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" >报名开始时间</label>
				  <div class="controls">
				    <input type="text" placeholder="报名开始时间"  name="b_stattime" value="<?php echo $item->b_stattime;?>" />
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" >报名截止日期</label>
				  <div class="controls">
				    <input type="text" placeholder="报名截止日期"  name="b_endtime" value="<?php echo $item->b_endtime;?>" />
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" >报告提交开始时间</label>
				  <div class="controls">
				    <input type="text" placeholder="报告提交开始时间"  name="bg_stattime" value="<?php echo $item->bg_stattime;?>" />
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" >报告提交截止日期</label>
				  <div class="controls">
				    <input type="text" placeholder="报告提交截止日期"  name="bg_endtime" value="<?php echo $item->bg_endtime;?>" />
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" >已提交报告数</label>
				  <div class="controls">
				    <input type="text" placeholder="已提交报告数"  name="bg_cnt" value="<?php echo $item->bg_cnt;?>" />
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" >添加时间</label>
				  <div class="controls">
				    <input type="text" placeholder="添加时间"  name="createtime" value="<?php echo $item->createtime;?>" />
				  </div>
				</div>

			    <div class="form-actions">
			      <input type="hidden" name="submit" value="1" />
				  <button type="submit"  class="btn btn-primary" data-loading-text="保存中...">&nbsp;&nbsp;保存&nbsp;&nbsp;</button>
				  <a type="button" class="btn j_cancel" href="javascript:window.history.go(-1);">取消</a>
				</div>
			 </form>
	      </div>
    </div>
</div>
<?php 
$this->inc("footer");
?>

