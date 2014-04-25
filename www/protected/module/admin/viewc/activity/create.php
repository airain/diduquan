<?php
$this->inc("header");
?>
<div class="container-fluid">
    <div class="row">
	      <div id="main"  class="col-md-12">
	      	  <h5 class=""><?php echo $module_name;?>添加 <i class="text-muted">|</i> <a data-placement="bottom"  title="<?php echo $module_name;?>管理" class="glyphicon glyphglyphicon glyphicon-plus-sign" href="/admin/activity/index" ></a></h5>
			  <form method="POST" class="form-horizontal form-pos j_validate j_add">
				<div class="form-group">
				  <label class="col-sm-2 control-label" >标题</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="标题"  name="title" value="<?php echo $item->title;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >产品详细信息</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="产品详细信息"  name="content" value="<?php echo $item->content;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >活动主办方</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="活动主办方"  name="sponsor" value="<?php echo $item->sponsor;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >产品logo</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="产品logo"  name="pic" value="<?php echo $item->pic;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >年龄段</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="年龄段"  name="totype" value="<?php echo $item->totype;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >申请区域[城市]</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="申请区域[城市]"  name="city" value="<?php echo $item->city;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >城市id</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="城市id"  name="city_id" value="<?php echo $item->city_id;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >省份</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="省份"  name="provice" value="<?php echo $item->provice;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >省份id</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="省份id"  name="province_id" value="<?php echo $item->province_id;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >活动类型</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="活动类型"  name="type" value="<?php echo $item->type;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >是否免费[1免费，0不免费]</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="是否免费[1免费，0不免费]"  name="isfree" value="<?php echo $item->isfree;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >已用名额</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="已用名额"  name="used_cnt" value="<?php echo $item->used_cnt;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >剩余名额</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="剩余名额"  name="remain_cnt" value="<?php echo $item->remain_cnt;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >报名人数</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="报名人数"  name="b_cnt" value="<?php echo $item->b_cnt;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >报名开始时间</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="报名开始时间"  name="b_stattime" value="<?php echo $item->b_stattime;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >报名截止日期</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="报名截止日期"  name="b_endtime" value="<?php echo $item->b_endtime;?>" />
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >添加时间</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="添加时间"  name="createtime" value="<?php echo $item->createtime;?>" />
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

