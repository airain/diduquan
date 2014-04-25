
<style>
  .content_left p{
     margin:10px 0px;
  }
  .h1{
    font-size:20px; font-weight:bold; margin:10px 0px;
  }

  .h5{
    font-size:13px; font-weight:bold; margin:10px 0px;
  }
</style>
<!--content 开始-->
<div class="content"> 
     <div class="content_left" id="issueBox">
          <div class="h1">发布活动感想</div>  
          <div class="h5"><?php echo $actinfo->title; ?><input type="hidden" id="aid" name="aid" value="<?php echo $actinfo->aid; ?>" /></div>
          <div>
            <p>标题：<input type="text" name="title" id="title" value="" /></p>
            <p>内容：<textarea name="content" id="content" cols="50" rows="10"></textarea></p>
            <p>
              <input type="button" name="bntOk" id="bntOk" value="提交" /> 
              <input type="button" name="bntNo" id="bntNo" value="取消" /> 
              <span id="errorMsgBox" style="display: none;"></span>
            </p>
          </div>
     </div>
	
	 <?php echo $this->inc('member/menu');?>
</div>
<!--content end-->
