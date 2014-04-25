<!--content 开始-->
<div class="content" > 
    <div class="login">           
       <div class="login_left">
             <h3 class="title_ren"><span class="h3_landing">立即注册嘀嘟圈，获得<span class="yellow">500</span>积分！</span></h3>
             <table cellspacing="0" id="registerBox" cellpadding="0" border="0" class="info">
                 <tbody>
                    <tr>
                       <th><span class="txt-impt">*</span>&nbsp;&nbsp;<span>注册邮箱：</span></th>
                       <td ><input type="text" class="input_tong idleField" name="email" id="email"></td>
                       <td class="w"><div style="width:260px;" id="emailTip" class="onShow">请认真填写号和登陆系统</div></td><!--邮箱账号-->
                    </tr>
                    <tr>
                       <th><span class="txt-impt">*</span><span>&nbsp;&nbsp;创建密码：</span></th>
                       <td><input type="password" class="input_tong idleField" name="password" id="password"></td>
                       <td class="w"><div style="width:288px;" id="passwordTip" class="onShow">只能包含大、下划线，不少于6个字符</div></td><!--密码-->
                    </tr>
                    <tr>
                        <th><span class="txt-impt">*</span>&nbsp;&nbsp;<span>用户名：</span></th>
                        <td><input type="" class="input_tong idleField" name="nick" id="nick"></td><!--重复密码-->
                        <td class="w"><div style="width:160px;" id="nickTip" class="onShow">昵称</div></td>
                    </tr>
                 
                   <tr>
                        <th></th>
                        <td><label><input type="checkbox" value="1" class="log" name="" id="clause"><font style="color:#006699;"><a target="blank" href="/site/Hand/Service">接受服务条款</a>                              </font></label></td><!--接受服务条款-->
                        <td></td>
                   </tr>
                   <tr>
                        <td class="table_l" colspan="3" id="errorTip"></td>
                   </tr>
                   <tr>
                       <td class="table_ssu" colspan="3"><input type="submit" class="button_xia anniu" value="立即注册" name="" id="ciBnt"></td>
                  </tr>
                </tbody>
              </table>
             
            
                   </div>
                   <div class="login_right p20">
                        <h3 class="title_ren bordom_1 pb30"><span class="h3_landing">已有嘀嘟圈帐号？</span><input type="button" onclick="location.href='/login/'" class="button_deng sign fr" value="登录" name="" id="login"></h3>
                <table cellspacing="0" cellpadding="0" border="0">
                  <tbody>
                   <tr><td class="table_sqm" style="height:0px;"></td><td class="table_schang "></td></tr>
                   <tr></tr>
                   <tr><td class="table_ll pt20">可以用第三方帐号登录</td><td class="table_sqm"></td><td class="table_schang "></td></tr>
                   <tr><td align="center" colspan="2" class="table_su  pt10  pb20"><input type="button" id="login" name="" value="" class="button_deng weibo"><input type="button" id="login" name="" value="" class="button_deng qq"></td></tr>
                   </tbody></table> 
                   <div ><img src="<?php echo $staticurl;?>/images/ico14.jpg"></div>    
                    </div>
    </div>

</div>
<!--content end-->