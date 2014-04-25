
<!--content 开始-->
<div class="content"> 
     <div class="content_left">
           <div class="dhooo_tab">
               <ul class="tab_btn" id="myTab_btns1">
                <li class="gray_333">会员中心</li>
               </ul>
               <div class="main" id="main1">
              <div class="shell">
              <ul id="content1">
               <li>
                   <div class="wan">
                       <a href="#"><p style="width:50px; height:50px;"><img width="50"  height="50" src="<?php echo echoUserAvatar($userinfo->avatar);?>"></p>
                                <ul>
                                    <li class="f12 fb">您好，<span class="f14"><?php echo $userinfo->nick; ?> </span> </li>
                                   <li><?php echo $userinfo->email; ?> [<span class="yellow">邮箱未验证，</span>验证邮箱即可获得<span class="coler">50</span>积分]当前积分<span class="coler"><?php echo $userinfo->jifen; ?></span>分</li>
                                 </ul>
                         </a>
                   </div>
                  <div class="anniu" style="width:600px; height:35px; color:#444; text-align:left;"><span>您当前邮寄资料尚未填写，完善后才可参加免费试用和亲子活动</span></div>
                  <h3 class="new_susu mt15" >我参加的活动</h3>
				  <?php if(!!$actList){
					  foreach($actList as $k => $item){ ?>
						<div class="anniu_sussu"><a href="./activity/detail/<?php echo $item->aid; ?>"><?php echo $item->title?></a><a href="#"class="yellow fr" style=" color: #FF6600; padding: 0px;">提交分享报告</a></div>
					<?php  }
					}?>
                  <div class="anniu_sussu"><a href="#">2到3岁儿童的最佳早教课程</a><a href="#"class="yellow fr" style=" color: #FF6600; padding: 0px;">提交分享报告</a></div>
                  
                  <div class="anniu_sussu " ><span class="f14">我参加的免费试用</span><span><a href="#"class="fr ml10">所有</a> <a href="#"class="fr ml10">待审核</a><a href="#"class="fr ml10">已批准</a><a href="#"class="fr ml10">未审核通过</a></span></div>
				  <?php if(!!$proList){
					  foreach($proList as $k => $item){ 
                if($item->isbg){?>
                  <div class="anniu_sussu">
                    <a href="./try/detail/<?php echo $item->pid; ?>"><?php echo $item->title?></a>
                    <a href="#"class="yellow fr">报告已提交</a>
                  </div>
                <?php }else{
              ?>
						      <div class="anniu_sussu">
                    <a href="./try/detail/<?php echo $item->pid; ?>"><?php echo $item->title?></a>
                    <a href="#"class="yellow fr" style=" color: #FF6600;">提交分享报告</a>
                  </div>
					<?php  }
               }
					}?>
               </li>
              </ul>
              </div>
               </div>
           </div>
     </div>
	
	 <?php echo $this->inc('member/menu');?>
</div>
<!--content end-->
