<!--content 开始-->
<div class="content" > 
    
           <div class="landing_left">
             <h3 class="title_ren"><span class="h3_landing">使用嘀嘟圈帐号登录</span></h3>

             <form method="POST" action="/login/ajax"  class="form-horizontal j_validate">
               <table cellspacing="0" cellpadding="0" border="0">
                 <tbody>
                     <tr>
                        <td class="table_sqm">
                          <input type="text" class="input_tong idleField" id="email" placeholder="邮箱/用户名" name="username" value="<?php echo cookie("username");?>" required>
                        </td>
                        <td class="table_schang"></td>
                      </tr>
                     <tr>
                        <td class="table_sqm">
                          <input type="password" class="input_tong idleField" name="password" placeholder="请输入密码"id="password" required></td>
                        <td class="table_schang"></td>
                      </tr>
                     <tr>
                      <td class="table_ll pt20">
                        <input type="checkbox" value="" class="log mr5" id="auto_login" name="">记住登陆状态
                        <p class="fr mr15 su"><a href="#">忘记密码</a></p>
                      </td>
                        <td class="table_sqm"></td>
                        <td class="table_schang"></td>
                      </tr>
                     <tr>
                      <td align="center" class="table_su  pt10 bordom_1 pb20" colspan="2">
                        <div style="display:none;" id="error" class="alert hide">
                          <button type="button" class="close" >&times;</button>
                          <span>&nbsp;</span>
                        </div>
                        <input type="submit" class="button_deng sign" value="登录" name="" id="login">
                        <p class="fr mr15 mt15 f12">还没有帐号？<a href="/register/"><span class="yellow">立即注册</span></a></p></td></tr>
                     <tr><td class="table_ll pt20">使用第三方账号</td><td class="table_sqm"></td><td class="table_schang "></td></tr>
                     <tr><td align="center" class="table_su  pt10  pb20" colspan="2"><input type="button" class="button_deng weibo" value="" name="" id="login"><input type="button" class="button_deng qq" value="" name="" id="login"></td></tr>
                     </tbody>
                  </table>
                </form>

                </div>



     
     <div class="landing_right">
		  <img src="<?php echo $staticurl;?>/images/ico8.jpg">
     </div>  

</div>
<!--content end-->