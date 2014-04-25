
<!--content 开始-->
<div class="content"> 
    <div class="content_left">
           <div class="friend">
               <p id="myTab_btns1" class="tab_btn">
                <span class="fried">我的好友</span>
               </p>
               <?php if ($friList){ ?>
                 <ul>
                 <?php foreach ($friList as $val){ ?>
                   <li><img width="50" height="50" src="<?php echo echoUserAvatar($val->avatar); ?>"><span><?php echo $val->nick ?></span></li>
                 <?php } ?>
                  </ul>
               <?php }?>
           </div>
     </div>
	
	 <?php echo $this->inc('member/menu');?>
</div>
<!--content end-->
