<?php
/**
 * 注册用户
 **/
$is_defend = true;
disable_hook('homeLoaded', 'sendRedPack');
disable_hook('homeLoaded', 'testAdvert');
if ($islogin2 == 1) {
    @header('Content-Type: text/html; charset=UTF-8');
    exit('<script>alert(\'您已登陆！\');window.location.href=\'/\';</script>');
}
if (!$conf['user_open'] && $conf['fenzhan_buy'] == 1) {
    exit('<script>window.location.href=\'/?mod=substation\';</script>');
} elseif (!$conf['user_open']) {
    @header('Content-Type: text/html; charset=UTF-8');
    exit('<script>alert(\'未开放新用户注册\');window.location.href=\'./\';</script>');
}
$title = '用户注册';

include 'user/head2.php';

$addsalt = md5(mt_rand(0, 999) . time());
$_SESSION['addsalt'] = $addsalt;
$x = new hieroglyphy();
$addsalt_js = $x->hieroglyphyString($addsalt);
?>
<style>
    body {
        position: absolute;
        background: url('/assets/official/image/用户登录背景.png') no-repeat;
        width: 100%;
        height: 100%;
        background-size: cover;
    }
    .btn-rounded {
        background-color: #1A99F2;
        border-color: #1A99F2;
    }
    #submit_reg {
        background-color: #1A99F2;
        border-color: #1A99F2;
    }
    .block {
        box-shadow: unset;
    }
    @media only screen and (min-width: 320px) {
        body {
            background-size: unset;
        }
        .widget {
            margin-bottom: 20px;
        }
    }
    @media only screen and (min-width: 414px) {
        body {
            background-size: unset;
        }
    }
    @media only screen and (min-width: 375px) {
        body {
            background-size: unset;
        }
    }
    @media only screen and (min-width: 768px) {
        body {
            background-size: cover;
        }
    }
</style>
<div class="col-xs-12 col-sm-10 col-md-8 col-lg-4 center-block " style="float: none;">
    <br/><br/><br/>
    <div class="widget">
        <div class="widget-content themed-background-flat text-center"
             style="background-image: url(<?php echo $cdnserver ?>assets/simple/img/userbg.jpg);background-size: 100% 100%;">
            <img class="img-circle" src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['kfqq']; ?>&spec=100"
                 alt="Avatar" height="60" width="60"/>
            <p></p>
        </div>
        <div class="block">
            <div class="block-title" style="text-align: center;">
                <h2><b>新用户注册</b></h2>
            </div>
            <form>
                <input type="hidden" name="captcha_type" value="<?php echo $conf['captcha_open']; ?>"/>
                <div class="input-group">
                    <div class="input-group-addon"><span class="fa fa-user"></span></div>
                    <input type="text" name="user" value="" class="form-control" required="required"
                           placeholder="输入登录用户名"/>
                </div>
                <br/>
                <div class="input-group">
                    <div class="input-group-addon"><span class="fa fa-lock"></span></div>
                    <input type="text" name="pwd" class="form-control" required="required" placeholder="输入6位以上密码"/>
                </div>
                <br/>
                <div class="input-group">
                    <div class="input-group-addon"><span class="fa fa-qq"></span></div>
                    <input type="text" name="qq" class="form-control" required="required" placeholder="输入QQ号，用于找回密码"/>
                </div>
                <br/>
                <?php if (intval($conf['captcha_open']) >= 1 && intval($conf['captcha_open_reg']) == 1) { ?>
                    <?php if ($conf['captcha_open'] == 2) { ?>
                        <input type="hidden" name="appid" value="<?php echo $conf['captcha_id'] ?>"/>
                    <?php } ?>
                    <div id="captcha" style="margin: auto;">
                        <div id="captcha_text">
                            正在加载验证码
                        </div>
                        <div id="captcha_wait">
                            <div class="loading">
                                <div class="loading-dot"></div>
                                <div class="loading-dot"></div>
                                <div class="loading-dot"></div>
                                <div class="loading-dot"></div>
                            </div>
                        </div>
                    </div>
                    <div id="captchaform"></div>
                    <br/>
                <?php } else { ?>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <span class="fa fa-adjust"></span>
                        </div>
                        <input type="text" name="code" class="form-control input-lg" required="required"
                               placeholder="输入验证码"/>
                        <span class="input-group-addon" style="padding: 0">
                            <img alt="验证码" id="codeimg" src="/user/code.php?r=<?php echo time(); ?>" height="43"
                                 onclick="this.
                                 src='/user/code.php?r='+Math.random();" title="点击更换验证码"/>
                        </span>
                    </div>
                    <br/>
                <?php } ?>
                <div class="form-group">
                    <input type="button" value="立即注册" id="submit_reg" class="btn btn-danger btn-block"/>
                </div>
                <hr>
                <div class="form-group">
                    <a href="/?mod=findpwd" class="btn btn-info btn-rounded" style="border-color: #FF9D34;background-color: #FF9D34;"><i class="fa fa-unlock"></i>&nbsp;找回密码</a>
                    <a href="/?mod=login" class="btn btn-primary btn-rounded" style="float:right;"><i
                            class="fa fa fa-user"></i>&nbsp;返回登录</a>
                </div>
            </form>
        </div>
    </div>
    <div class="form-group">
        <a href="/" class="btn btn-default" style="width: 100%;background-color: #ffffff;border-color: #ffffff;">返回首页</a>
    </div>
    <br><br><br>
    <script src="<?php echo $cdnpublic ?>jquery/1.12.4/jquery.min.js"></script>
    <script src="<?php echo $cdnpublic ?>twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="<?php echo $cdnpublic ?>layer/2.3/layer.js"></script>
    <script>
        const hashsalt = <?php echo $addsalt_js; ?>;
    </script>
    <script src="/assets/official/js/reguser.js"></script>
</div>