
<!--content 开始-->
<div class="content"> 
     <div class="content_left">
           <div class="dhooo_tab">
               <ul class="tab_btn" id="myTab_btns1">
                <li class="gray_333">我的评论</li>
               </ul>
       <?php if ($cmtlist) { ?>
           <?php foreach ($cmtlist as $key => $val) { ?>
               <div class="main" style=" border-bottom:1px dashed #b0b0b0;">
                    <div class="shell">
                        <ul id="content1">
                         <li>
                             <div class="wan">
                                
                                <ul style=" width:580px;">
                                    <li class="f14"><?php echo $val->title; ?></li>
                                    <li><?php echo $val->content ?></li>
                                    <li><?php echo date('Y-m-d H:i:s', $val->createtime); ?></li>
                                 </ul>
                             </div>
                         </li>
                        </ul>
                    </div>
               </div>
           <?php } ?>
       <?php } ?>
               
               <div class="main" id="main1" style=" border-bottom:1px dashed #b0b0b0;">
                    <div class="shell">
                        <ul id="content1">
                         <li>
                             <div class="wan">
                                
                                <ul style=" width:580px;">
                                    <li class="f14">2到3岁儿童的最佳早教课程</li>
                                    <li>这个活动不错 <span class="yellow">@幸福一家子</span>我们一起去参加吧...</li>
                                    <li>2013-10-09 19:00</li>
                                 </ul>
                             </div>
                         </li>
                        </ul>
                    </div>
               </div>
           </div>
     </div>
	
	 <?php echo $this->inc('member/menu');?>
</div>
<!--content end-->
