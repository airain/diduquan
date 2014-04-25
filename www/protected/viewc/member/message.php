
<!--content 开始-->
<div class="content"> 
    <div class="content_left">
           <div class="dhooo_tab">
               <ul class="tab_btn" id="myTab_btns1">
                <li class="gray_333">我的消息</li>
               </ul>
               <?php if ($msglist){ ?>
                 <?php foreach ($msglist as $val){ 
                    $val = (object)$val;
                  ?>
                  <div class="main" style=" border-bottom:1px dashed #b0b0b0;">
                    <div class="shell">
                        <ul id="content1">
                         <li>
                             <div class="wan">
                                <p style="width:50px; height:50px;"><img style="width:50px; height:50px;" src="<?php echo echoUserAvatar($val->avatar); ?>"></p>
                                <ul style=" width:580px;">
                                    <li><?php echo $val->nick; ?></li>
                                    <li><?php echo $val->content; ?></li>
                                    <li><?php echo date('Y-m-d H:i:s', $val->createtime); ?>
                                      <a href="javascript:;"class="yellow fr replyMsg" data-uname="<?php echo $val->nick; ?>" style=" padding: 0px;">回复</a>
                                    </li>
                                 </ul>
                             </div>
                         </li>
                        </ul>
                    </div>
                  </div>
                 <?php } ?>
               <?php } ?>
               
           </div>
     </div>
	
	 <?php echo $this->inc('member/menu');?>
</div>
<!--content end-->
