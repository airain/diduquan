
<!--content 开始-->
<div class="content"> 
     <div class="content_left">
           <div id="tabs">
              <ul class="mb20">
                  <li><a href="#11">基本资料</a></li>
                  <li><a href="#22">修改头像</a></li>
                  <li><a href="#33">邮寄地址</a></li>
                  <li><a href="#44">修改密码</a></li>
                  <li><a href="#55">积分管理</a></li>
              </ul>
              <div id="11">
                  <div class="login_left" style="background:none; border:none;">                     
                    <table cellspacing="0" id="binfoBox" cellpadding="0" border="0" class="info">
                      <tbody>
                        <tr>
                           <th><span class="txt-impt">*</span>&nbsp;&nbsp;<span>邮箱：</span></th>
                           <td >8459807@qq.com   ( <span class="red">修改邮件地址</span> )</td>
                           
                        </tr>
                        <tr>
                           <th><span class="txt-impt">*</span>&nbsp;&nbsp;<span>昵称：</span></th>
                           <td >布丁妈妈</td>
                           
                        </tr>
                        <tr>
                           <th><span class="txt-impt">*</span><span>&nbsp;&nbsp;性别：</span></th>
                           <td>
                              <fieldset id="genderBox">
                                  <input style="width:20px;" type="radio" name="gender" <?php echo $userinfo->gender=="男"?'checked':'';?> value="男"/> 男
                                  <input style="width:20px;" type="radio" name="gender" <?php echo $userinfo->gender=="女"?'checked':'';?> value="女"/> 女
                              </fieldset>
                          </td>
                           
                        </tr>
                         <tr>
                           <th><span class="txt-impt">*</span><span>&nbsp;&nbsp;宝宝状态：</span></th>
                           <td>
                             <fieldset id="babyStateBox">
                                <input style="width:20px;"type="radio" name="bstate" <?php echo isset($userbaby->baby_state) && $userbaby->baby_state=="1"?'checked':'';?> value="1"/> 已有宝贝
                                <input style="width:20px;"type="radio" name="bstate" <?php echo isset($userbaby->baby_state) && $userbaby->baby_state=="2"?'checked':'';?> value="2"/> 已怀孕
                                <input style="width:20px;"type="radio" name="bstate" <?php echo isset($userbaby->baby_state) && $userbaby->baby_state=="3"?'checked':'';?> value="3"/> 准备怀孕
                            </fieldset>
                           </td>
                           
                        </tr>
                        <tr>
                            <th><span class="txt-impt">*</span>&nbsp;&nbsp;<span>宝宝姓名：</span></th>
                            <td><input type="text" class="input_tong idleField" name="bname" id="bname" value="<?php echo isset($userbaby->baby_name)?$userbaby->baby_name:'';?>"></td>
                            
                        </tr>
                         <tr>
                            <th><span class="txt-impt">*</span>&nbsp;&nbsp;<span>宝宝生日：</span></th>
                            <td><input type="text" class="input_tong idleField" name="bbirth" id="bbirth" style=" margin-right:350px;" value="<?php echo isset($userbaby->baby_birth)?$userbaby->baby_birth:'';?>"> </td>
                            
                        </tr>
                         <tr>
                            <th><span class="txt-impt">*</span>&nbsp;&nbsp;<span>宝宝性别：</span></th>
                            <td>
                              <fieldset id="babyGenderBox">
                                  <input style="width:20px;"type="radio" name="bsex" <?php echo isset($userbaby->baby_sex) && $userbaby->baby_sex=="男"?'checked':'';?> value="男"/> 男
                                  <input style="width:20px;"type="radio" name="bsex" <?php echo isset($userbaby->baby_sex) && $userbaby->baby_sex=="女"?'checked':'';?> value="女"/> 女
                              </fieldset>
                            </td>
                            
                        </tr>
                       <tr>
                            <td class="table_l"></td>
                       </tr>
                       <tr>
                           <td class="table_ssu" colspan="3">
                            <input type="submit" class="button_xia anniu" value="保存资料" name="save_info" id="save_info">
                            <span id="errorTip"></span>
                          </td>
                       </tr>
                    </tbody>
                  </table>
                </div>
            </div>


            <div id="22">
                <div class="portrait">
                  <form id= "uploadpicFrm" action="/member/save_pic" method="post" enctype="multipart/form-data">
                   <p><img src="images/ico12.jpg"></p>
                    <ul>
                       
                       <li class="f12 font1">请选择一张头部大且人物清晰的照片作为头像。照片大小不要超过1M。</li>
                       
                        <li class="mt10 mb10"><input type="file" name="filename" value="选择文件"/></li>
                        <li>
                          <a href="javascript:;" id="uploadBnt" ><span class="portrait_sign mr26">上传头像</span></a>
                          <span class="portrait_sign">取消</span>
                        </li>  
                                               
                    </ul>
                   </form>
                </div>
            </div>
                    

            <div id="33">
                <div class="login_left" style="background:none; border:none;">
                    <h3 class="title_ren red">（注：用来邮寄试用品，非常重要！嘀嘟圈承诺不会泄露给第三方）</h3>
                    <table cellspacing="0" id="saveAddrBox" cellpadding="0" border="0" class="info">
                       <tbody>
                          <tr>
                             <th><span class="txt-impt">*</span>&nbsp;&nbsp;<span>真实姓名：</span></th>
                             <td ><input type="text" class="input_tong idleField" name="realname" id="realname"  value="<?php echo $userinfo->realname;?>" /></td>
                             
                          </tr>
                          <tr>
                             <th><span class="txt-impt">*</span><span>&nbsp;&nbsp;手机号码：</span></th>
                             <td><input type="text" class="input_tong idleField" name="mobile" value="<?php echo $userinfo->mobile;?>"/></td>
                             
                          </tr>
                           <tr>
                              <th><span class="txt-impt">*</span>&nbsp;&nbsp;<span>通讯地址：</span></th>
                              <td><input type="text" class="input_tong idleField" name="address" value="<?php echo $userinfo->address;?>"/ style="margin-right:350px;"> </td><!--重复密码-->
                              
                          </tr>
                          <tr>
                              <th><span class="txt-impt">*</span>&nbsp;&nbsp;<span>邮政编码：</span></th>
                              <td><input type="text" class="input_tong idleField" name="postcode" value="<?php echo $userinfo->postcode;?>"/></td>
                              
                          </tr>
                      
                         <tr>
                              <td class="table_l"></td>
                         </tr>
                         <tr>
                             <td class="table_ssu" colspan="3">
                                <input type="submit" class="button_xia anniu" value="保存" name="save_add" id="save_add">
                                <span id="errorTip"></span>
                              </td>
                         </tr>
                      </tbody>
                    </table>
                </div>
            </div>
                    
            <div id="44">
                <div class="login_left" style="background:none; border:none;">
                     <table cellspacing="0" id="modPwdBox" cellpadding="0" border="0" class="info">
                         <tbody>
                            <tr>
                               <th><span class="txt-impt">*</span>&nbsp;&nbsp;<span>旧密码：</span></th>
                               <td ><input type="password" class="input_tong idleField" name="oldpwd" value=""/></td>
                               
                            </tr>
                            <tr>
                               <th><span class="txt-impt">*</span><span>&nbsp;&nbsp;新密码：</span></th>
                               <td><input type="password" class="input_tong idleField" name="newpwd" value=""/></td>
                               
                            </tr>
                            <tr>
                                <th><span class="txt-impt">*</span>&nbsp;&nbsp;<span>确认密码：</span></th>
                                <td><input type="password" class="input_tong idleField" name="renewpwd" value=""/></td>
                                
                            </tr>
                        
                           <tr>
                                <td class="table_l"></td>
                           </tr>
                           <tr>
                               <td class="table_ssu" colspan="3"><input type="submit" class="button_xia anniu" value="保存" name="mod_pwd" id="mod_pwd"><span id="errorTip"></span></td>
                               <td class="table_ssu" colspan="3"><input type="button" class="button_xia anniu" style="margin-left:10px;"value="取消" name="" id="next"></td>
                           </tr>
                        </tbody>
                    </table>
                </div>
            </div>
                    

            <div id="55">
                <div id="main1" class="main">
                  <div class="shell">
                      <ul id="content1">
                       <li>
                           <div class="wan">
                               <a href="#">
                                        <ul>
                                            <li class="f12 fb">您好，<span class="f14"><?php echo $userinfo->nick; ?> </span> </li>
                                           <li>您当前  <span class="yellow"> <?php echo $userinfo->jifen; ?></span>积分   <span class=" yellow">兑换礼品</span></li>
                                         </ul>
                                 </a>
                           </div>
                          <div > <h3 class="new_susu mt15">积分消费记录</h3></div>
                         <div>
                            <ul style=" width:600px;">
                               <?php if ($rulelist){ ?>
                                 <?php foreach ($rulelist as $key => $value){ ?>
                                   <li class="anniu_sussu">
                                    <span><?php echo $value->info; ?></span>
                                    <span style="padding-right: 10px;">(<?php echo $value->score; ?>)</span>
                                    <span style="padding: 0px;" class="fr"><?php echo date('Y-m-d H:i:s',$value->createtime); ?></span>
                                  </li>
                                 <?php } ?>
                               <?php } ?>
                            </ul>
                          </div>                       
                         
                       </li>
                      </ul>
                  </div>
               </div>
            </div>
               
        </div>
     </div>
	
	 <?php echo $this->inc('member/menu');?>
</div>
<!--content end-->
