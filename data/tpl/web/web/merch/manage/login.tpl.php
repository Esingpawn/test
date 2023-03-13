<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('merch/manage/header_base', TEMPLATE_INCLUDEPATH)) : (include fx_template('merch/manage/header_base', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
body {background-color:#f2f2f2!important;}
.page-header {position: absolute;top: 0;left: 0;right: 0;height:50px;line-height:50px;padding: 0 30px;overflow: hidden;background: rgba(255,255,255,.2);z-index:10}
.page-header:before {display: none;}
.page-header .inner {margin: auto;}
.page-header .inner .logo {line-height:50px;width: auto;vertical-align: middle;}
.page-header .inner .logo img {width: auto;height: 24px;}
.page-content {width: 100%;background-size: cover;background-position: 50% 50%;background-repeat: no-repeat;position: relative;height: 100vh;background-color:#f2f2f2!important;}
.signup-adv {-webkit-box-flex: 1;-webkit-flex: 1;-ms-flex: 1;flex: 1;padding-right: 40px;}
.signup-adv img {max-height: 100%;max-width: 100%;}
.signup-main{width: 360px;height: 390px;padding: 40px;background: rgba(255,255,255,.7);border-radius: 4px;position: fixed;right: 20%;top: 20%;}
.signup-main .title {color: #333;font-size: 16px;}
.signup-main .title span {font-size: 12px;color: #666;padding-left: 4px;}
.signup-main .input {height: 38px;width: 100%;margin-top: 20px;}
.signup-main .input input {height: 38px;width: 100%;border: 1px solid #e5e5e5;outline: none;border-radius: 3px;	padding: 0 10px;font-size: 14px;}
.signup-main .input input:focus {border: 1px solid #44abf7;}
.signup-main .button {height: 38px;width: 100%;margin-top: 14px;}
.signup-main .button input {height: 38px;width: 100%;background: #44abf7;border: 0;border-radius: 3px;color: #fff;font-size: 16px;outline: none;}
.signup-main .button input:active {background: #33a4f7;}
.signup-main .option {height: 40px;line-height: 40px;text-align: right;margin-bottom: 5px;}
.signup-main .option span {cursor: pointer;}
.signup-main .option span:hover {border-bottom: 1px solid #666;}
.signup-main .text {border-top: 1px solid #e5e5e5;width: 100%;padding: 10px 0;}
.signup-main .text p.title {font-size: 14px;color: #444;}
.signup-main .text p {font-size: 12px;margin-bottom: 8px;color: #999;}
</style>
<body>
<div class="page-header">
    <div class="inner">
        <div class="logo">
            <?php  if(!empty($set['merch_logo'])) { ?>
                <img src="<?php  echo tomedia($set['merch_logo'])?>"/>
            <?php  } ?>
        </div>
    </div>
</div>
<div class="page-content" style="background-image: url('<?php  echo tomedia($set['merch_loginbg'])?>');">
    <div class="signup-adv"></div>
    <div class="signup-main">
        <div class="title">商家登录 <span>主办方管理后台</span></div>
        <div class="input"><input type="text" name="username" placeholder="请输入登录账号" /></div>
        <div class="input"><input type="password" name="password" placeholder="请输入登录密码" /></div>
        <div class="button"><input type="submit" value="登录" id="btn-login" /></div>
        <div class="option"><span class="foget">忘记密码</span> </div>
        <div class="text">
            <p class="title">温馨提示</p>
            <p>请使用管理员分配的账号密码进行登录~有问题请联系系统管理员。</p>
        </div>
    </div>
</div>


<script language='javascript'>
    $(".foget").click(function () {
        tip.alert("忘记密码请联系系统管理员");
    });
    $(".signup-main .input input").keydown(function (e) {
        if(e.keyCode==13){
            var name = $(this).attr('name');
            var value = $.trim($(this).val());
            if(name=='username' && value!=''){
                $("input[name='password']").focus();
            }
            if(name=='password' && value!=''){
                $('#btn-login').click();
            }
        }
    });
    $('#btn-login').click(function () {
        if ($(":input[name=username]").isEmpty()) {
            tip.msgbox.err('请输入登录账号');
            $(":input[name=username]").focus();
            return;
        }
        if ($(":input[name=password]").isEmpty()) {
            tip.msgbox.err('请输入登录密码');
            $(":input[name=password]").focus();
            return;
        }
        if ($(this).attr('stop')) {
            return;
        }
        $('#btn-login').attr('stop', 1).val('正在登录...');
        $.ajax({
            url: "<?php  echo $submitUrl;?>",
            type: 'post',
            data: {username: $(":input[name=username]").val(), password: $(":input[name=password]").val()},
            dataType: 'json',
            cache: false,
            success: function (ret) {
                if (ret.status == 1) {
                    tip.msgbox.suc("登录成功");
                    $('#btn-login').attr('stop', 1).val('跳转中...');
                    setTimeout(function () {
                        location.href = ret.result.url;
                    }, 500);
                    return;
                }
                $('#btn-login').removeAttr('stop').val('登录');
                $(":input[name=password]").select();
                tip.msgbox.err(ret.result.message);
            }
        })
    })
</script>
<script language="javascript">myrequire(['web/init'],function(){});</script>
<?php  if(!empty($_W['setting']['copyright']['statcode'])) { ?><?php  echo $_W['setting']['copyright']['statcode'];?><?php  } ?>
<?php  if(!empty($copyright) && !empty($copyright['copyright'])) { ?>
<div class="signup-footer" style='width:750px;margin:auto;margin-top:10px;'>
    <div><?php  echo $copyright['copyright'];?></div>
</div>
<?php  } ?>
</body>
</html>