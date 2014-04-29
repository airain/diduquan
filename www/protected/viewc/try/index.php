<div class="content">
     <div class="content_left">


           <div class="dhooo_tab">
               <ul class="tab_btn" id="myTab_btns1">
                <li class="hot">免费试用</li><li>往期试用</li>
               </ul>
               <div class="main" id="main1">
              <div class="shell">
              <ul id="content1">
               <li>
                   <?php foreach ($list as $k => $item) {?>
                    <div class="kuai">
                       <a href="#"><p><img src="<?php echo $staticurl;?>/images/ico1.jpg"></p>
                                <ul>

                                   <li class="f16 fb"><?php echo $item->title;?></li>
                                   <li>活动申请时间： <?php echo date('Y-m-d',$item->b_starttime)?> 至 <?php echo date('Y-m-d',$item->b_endtime)?></li>
                                   <li>报告提交时间：<?php echo date('Y-m-d',$item->bg_starttime)?> 至 <?php echo date('Y-m-d',$item->bg_endtime)?></li>
                                    <li>可以申请区域：<?php echo $item->city;?></li>
                                    <li>配送方式： <?php echo getPostType(array('type'=>'text','checked'=>$item->posttype));?></li>
                                    <li>商品数量：还有<span class="coler"><?php echo $item->remain_cnt;?></span>份（共<span class="lv"><?php echo $item->used_cnt+$item->remain_cnt; ?></span>份）</li>
                                    <li>申请人数：共<span class="coler"> <?php echo $item->b_cnt; ?></span>人</li>
                                    <li><span class="sign">立即报名</span></li>
                                    <li class="renshu"><img src="<?php echo $staticurl;?>/images/ico2.jpg"><img src="<?php echo $staticurl;?>/images/ico2.jpg"><img src="<?php echo $staticurl;?>/images/ico2.jpg"><img src="<?php echo $staticurl;?>/images/ico2.jpg"><img src="images/ico2.jpg">&nbsp;&nbsp;等<span class="yellow">186</span>位用户已报名参与</li>
                                 </ul>
                         </a>
                   </div>
           <?php }?>





               </li>

              </ul>
              </div>
               </div>

           </div>





     </div>


</div>