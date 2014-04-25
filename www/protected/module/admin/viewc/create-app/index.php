<?php
$this->inc("header");
?>
<div class="container-fluid">
    <div class="row">
	      <div id="main"  class="col-md-12">
	      	  <h4 class="">创建模块</h4>
			  <form method="POST" class="form-horizontal form-pos j_validate j_add">
				<div class="form-group">
				  <label class="col-sm-2 control-label" >模块名称(中文):</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="模块名称(中文),如:''用户"  name="name" required/>
				  </div>
				</div>

				<div class="form-group">
				  <label class="col-sm-2 control-label" >模块(module):</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="模块(module),可为空"  name="module" />
				  </div>
				</div>

				<div class="form-group">
				  <label class="col-sm-2 control-label" >类(controller):</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="类(controller)"  name="controller" required/>
				  </div>
				</div>

				<div class="form-group">
				  <label class="col-sm-2 control-label" >数据表(table):</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="数据表(table)"  name="table" required/>
				    <p/>
				    <div class="j_table j_has_loading"></div>
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

