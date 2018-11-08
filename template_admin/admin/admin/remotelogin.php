<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>{getTitle($archive,$category,$catid,$type)}</title>
<link rel="shortcut icon" href="{$base_url}/favicon.ico" type="image/x-icon" />

<style type="text/css">
	body {
  background:#6f8489 url({$skin_path}/images/login-bg.jpg) left top no-repeat;background-attachment: fixed; 
  min-height: 100%;
}
@media(max-width:768px) {
		body { background-size;auto;}
		}


.container {
margin: 0 auto;
float: none;
width:360px;
    
}

.box {
width:300px;
padding: 35px 30px 30px 30px;
box-shadow: 0 0 6px 2px rgba(0, 0, 0, 0.1);
border-radius: 5px;
background: rgba(255, 255, 255, 0.65);
}



.form-control {
    display: block;
    width: 274px;
    height: 28px;
	line-height:28px;
	margin-bottom:18px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #b2bfc7;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}

.form-control:focus{
border-color:#66afe9;
outline:0;
-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);
box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);
}

input:-webkit-autofill {  
-webkit-box-shadow: inset 100px 100px 100px white,0 0 8px rgba(102,175,233,.6) !important;  
}  


.sr-only {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0,0,0,0);
    border: 0;
}
label {
    display: inline-block;
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: 700;
}
.btn-block {
    display: block;
    width: 100%;
}
.btn-group-lg>.btn, .btn-lg {
    padding: 10px 16px;
    font-size: 18px;
    line-height: 1.3333333;
    border-radius: 6px;
}
.btn-primary {
    color: #fff;
    background-color: #337ab7;
    border-color: #2e6da4;
}
.btn {
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
}
.btn:hover {background:#2a608f;}
.pull-right {float:right;}


.form-signin {
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
  margin-bottom: 10px;
}
.form-signin .checkbox {
  font-weight: normal;
}
.form-signin .form-control {
  position: relative;
  height: auto;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}



a.help {color:#3d88ba;font-size:0.8em;}
a.help:hover {color:#3d88ba;}

.btn-group-lg>.btn, .btn-lg {
width:auto;
margin:30px 0px 0px 108px;
clear:both;text-transform: uppercase;
    font-size: 13px;
    padding: 8px 30px;
	border-color: #2480c2;
    color: #fff;
    text-shadow: rgba(0, 0, 0, 0.35) 0 1px 0;
    box-shadow: inset 0px 1px 0px 0px rgba(255, 255, 255, 0.5);
    background: #54b3ff;
    background: -moz-linear-gradient(top, #54b3ff 0%, #0078d9 100%);
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #54b3ff), color-stop(100%, #0078d9));
    background: -webkit-linear-gradient(top, #54b3ff 0%, #0078d9 100%);
    background: linear-gradient(#54b3ff, #0078d9);
    background: -o-linear-gradient(top, #54b3ff 0%, #0078d9 100%);
    background: -ms-linear-gradient(top, #54b3ff 0%, #0078d9 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#54b3ff', endColorstr='#0078d9',GradientType=0 );
	}

.logo {margin:88px auto 55px auto;text-align:center;}
.logo img {max-width:188px;}

.copy {clear:both; margin:20px 0px;text-align:center; color:#aaa;font-size:0.6em;}
.copy a {color:#aaa;}
.copy a:hover {color:#fff;}

.blank5, .blank10, .blank20,.blank30 { clear: both; height: 5px; }
.blank10 { height: 10px; }
.blank20 { height: 20px; }
.blank30 { height: 30px; }

.text-right {text-align:right;}


</style>
<script type="text/javascript" src="{$skin_path}/js/jquery-1.11.2.min.js"></script>
  </head>
  <body>

  <div id="container">
    <div id="anitOut"></div>
</div>


    <div class="container">
	
 <div class="logo"><img src="{$skin_path}/images/logo-login.png"></div>

 <?php
    if(!get('submit')) flash();
    if(!get('submit') || hasflash()) {
?>
<div class="box">
<form name="loginform" id="loginform" action="<?php echo uri();?>" method="post">
<input type="hidden" name="submit" value="提交">
        <label for="inputEmail" class="sr-only">用户名</label>
        <input name="username" type="text" id="username" class="form-control" placeholder="用户名" tabindex="1" required autofocus>
        <label for="inputPassword" class="sr-only">密码</label>
        <input name="password" type="password" id="password" class="form-control" placeholder="密码" tabindex="2" required>

{if config::get('mobilechk_enable') && config::get('mobilechk_admin')}
<style type="text/css">
#tel {float:left;
width:148px;
margin:10px 0px;
height:38px;
  line-height:38px;
  padding:0px 10px;
  border:1px solid #ccc;
border-radius: 5px;
}
#select {width:290px;}
#btm_sendMobileCode { float:right; width:120px; border:1px solid #ccc; height:38px; line-height:38px; margin:10px 0px; padding:0px 10px;border-radius: 5px;}
#mobilenum {clear:both; width:278px; border:1px solid #ccc; height:38px; line-height:38px; padding:0px 10px;border-radius: 5px;}
</style>

<script src="{$base_url}/js/mobilechk.js"></script>
<input placeholder="{lang('tel')}" type='text' id="tel"  name="tel" value="" tabindex="3" class="form-control" />
<input id="btm_sendMobileCode" onclick="sendMobileCode('{url('tool/smscode')}',$('#tel'));" type="button" value="{lang('send_cell_phone_verification_code')}" />
<div class="blank20"></div>
<input type='text' placeholder="{lang('please_enter_the_phone_verification_code')}" id="mobilenum" name="mobilenum" />
<div class="blank20"></div>
{/if}

{if config::get('verifycode') == 1}
<style type="text/css">
#verify {
  float:right;
  width:205px;
  height:30px;
  line-height:30px;
  padding:0px 15px;
  border:1px solid #ccc;
border-radius: 0px 5px 5px 0px;
}
#verify:hover {
border:1px solid #A5C7FE;
-moz-box-shadow:0px 0px 10px #A5C7FE;
-webkit-box-shadow:0px 0px 10px #A5C7FE;
box-shadow:0px 0px 10px #A5C7FE;

}
</style>
<label for="inputVerify" class="sr-only">验证码</label>
<input type='text' id="verify"  tabindex="3"  name="verify" />{verify()}
{/if}


{if config::get('verifycode') == 2}
    <link rel="stylesheet" href="{$base_url}/common/dialog/reveal.css">
    <script type="text/javascript" src="{$base_url}/common/dialog/jquery.reveal.js"></script>
    <script type="text/javascript">
        //WWW
        var submit=false;
        $(document).ready(function(){
            $('#loginform').submit(function(e){
                if(submit==false) {
                    $('#verify-dialog').reveal();
                    return false;
                }
            });
        });
    </script>

    <script src="http://static.geetest.com/static/tools/gt.js"></script>
    <script>
        var handlerPopup = function (captchaObj) {
            captchaObj.onSuccess(function () {
                var validate = captchaObj.getValidate();
                submit=true;
                setTimeout( function(){
                        $('#verify-dialog').hide();
                    },
                    2000);
                setTimeout( function(){
                        $('.show-dialog').click();
                    },
                    1000);
            });
            $("#popup-submit").click(function () {
                //captchaObj.show();
            });
            captchaObj.appendTo("#verifycode_embed");
        };

        $.ajax({
                url : '{url('tool/geetest',0)}',
            type: "get",
            dataType: "json",
            success: function (data) {
            initGeetest({
                gt: data.gt,
                challenge: data.challenge,
                product: "embed",
                offline: !data.success
            }, handlerPopup);
        }
        });
    </script>

    <div  id="verify-dialog" class="reveal-modal">
        <h5>请先完成以下验证</h5>
        <div class="blank10"></div>
        <a class="close-reveal-modal">×</a>
        <div id="verifycode_embed"></div>
    </div>
    {/if}

 <div class="clearfix text-right">
<a title="CmsEasy 重置管理员密码工具" target="_blank" href="http://www.cmseasy.cn/plus/show_134.html" class="help">忘记密码?</a>
</div>

        <button class="btn btn-lg btn-primary btn-block show-dialog" type="submit">登录</button>
      </form>

	  

<?php
    }
    if(get('submit')) {
	  if(hasflash()) {
	      echo '<div style="clear:both;margin:50px 0px;text-align:center;color:red;font-size:16px;font-weight:bold;color:red;">';
		  echo flash();
	  } else { ?>
            <div style="margin:50px 0px;padding-top:5px; text-align:center;font-size:16px;font-weight:bold;color:#fff;">
            登陆成功！

            <meta http-equiv="refresh" content="2;url={$admin_url}&site=<?php echo front::get('site')?>">
<?php
      }
	  echo '</div>';
	}
?>
</div> 

<div class="copy">{getCopyRight()}</div>

    </div> <!-- /container -->


</body>
</html>