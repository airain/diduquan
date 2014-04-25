
<!--content 开始-->
<div class="content"> 
     <div class="content_left">
           <div class="dhooo_tab">
              <ul class="tab_btn" id="myTab_btns1">
                <li class="gray_333">我参加的活动</li>
              </ul>
               <div class="main" id="main1" style=" border-bottom:1px dashed #b0b0b0;">
                    <ul>
                  <?php if ($myactlist) {?>
                    <?php foreach ($myactlist as $key => $val)  {?>
                      <li>
                        <span><a href="/activity/detail/<?php echo date('Ymd', $val->createtime); ?>/<?php echo $val->aid; ?>"><?php echo $val->title; ?></a></span>
                        <span style="margin:20px;"><?php echo date('Y-m-d H:i:s', $val->createtime); ?></span>
                        <span><?php echo $val->state?'已提交报告':'<a class="coler" style="font-size:12px;" href="/activity/issue/'.$val->aid.'">未提交报告</a>'; ?></span>
                      </li>
                    <?php } ?>
                  <?php } ?>
                    </ul>
               </div>
           </div>
     </div>
	
	 <?php echo $this->inc('member/menu');?>
</div>
<!--content end-->
