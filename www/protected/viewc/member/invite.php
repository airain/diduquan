
<!--content 开始-->
<div class="content"> 
    <div class="content_left">
           <div class="dhooo_tab">
               <ul class="tab_btn" id="myTab_btns1">
                <li class="gray_333">邀请好友</li>
               </ul>
               <div style="border:none;" class="tanchuang">                
                <ul>
                   <li>你的邀请链接：<input type="text" value="<?php echo $invite_url; ?>" class="input_tong idleField" name="inviteUrl" id="inviteUrl">
                    <input type="button" class="button_xia anniu mr20" value="复制链接" name="" id="copyUrl" /></li>
                   <li class="ml100">邀请好友成功将获得<span class="yellow">20</span>积分</li>
                </ul>
             
                
            </div>
           </div>
     </div>
	
	 <?php echo $this->inc('member/menu');?>
</div>
<!--content end-->
