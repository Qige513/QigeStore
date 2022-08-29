<?php
/**
 * 找回密码
 **/
$is_defend = true;

if (isset($_GET['act']) && $_GET['act'] == 'qrlogin') {
    if (isset($_SESSION['findpwd_qq']) && $qq = $_SESSION['findpwd_qq']) {
        $row = $DB->get('site', '*', ['qq' => $qq]);
        unset($_SESSION['findpwd_qq']);
        if ($row['user']) {

            $userToken = hash('sha256', md5($row['user'] . $row['pwd'] . SYS_KEY));
            //进行不可逆加密用户密码
            $userTokenEncode = aesEncrypt($row['zid'] . PHP_EOL . $userToken, SYS_KEY);
            //加密userToken
            setcookie('userToken', $userTokenEncode, time() + 604800, '/');
            //存储Token
            $result = siteAttr($row['zid'], 'loginToken', $userToken);

            log_result('分站找回密码', 'User:' . $row['user'] . ' IP:' . $clientip, null, 1);
            $DB->update('site', ['lasttime' => $date], ['zid' => $row['zid']]);
            exit('{"code":1,"msg":"登录成功，请在用户资料设置里重置密码","url":"./"}');
        } else {
            @header('Content-Type: application/json; charset=UTF-8');
            exit('{"code":-1,"msg":"当前QQ不存在，请确认你已开通过分站"}');
        }
    } else {
        @header('Content-Type: application/json; charset=UTF-8');
        exit('{"code":-2,"msg":"验证失败，请重新扫码"}');
    }
} elseif (isset($_GET['act']) && $_GET['act'] == 'qrcode') {
    exitJson('QQ登录维护中');
    $image = trim($_POST['image']);
    $result = qrcodelogin($image);
    exit(json_encode($result));
} elseif ($islogin2 == 1) {
    @header('Content-Type: text/html; charset=UTF-8');
    exit("<script>alert('您已登陆！');window.location.href='./';</script>");
}
disable_hook('homeLoaded', 'sendRedPack');
disable_hook('homeLoaded', 'testAdvert');
$title = '找回密码';
include 'user/head2.php';
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

    #mlogin {
        background-color: #FF9D34;
        border-color: #FF9D34;
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
<div class="col-xs-12 col-sm-10 col-md-8 col-lg-4 center-block" style="float: none;margin-top: 80px;">
    <div class="block">
        <div class="block-title" style="text-align: center;">
            <h2><b>找回密码</b></h2>
        </div>
        <div class="form-group" style="text-align: center;">
            <div class="list-group-item list-group-item-info" style="font-weight: bold;" id="login">
                <span id="loginmsg">请使用QQ手机版扫描二维码</span><span id="loginload" style="padding-left: 10px;color: #790909;">.</span>
            </div>
            <br>
            <div id="qrimg" style="width: 148px;height: 148px;margin: 0 auto;">
            </div>
            <button type="button" id="mobile" onclick="loadScript()" class="btn btn-success btn-block" style="border-color: #1A99F2;background-color: #1A99F2;display: none;margin-top: 16px;">我已完成登录</button>
            <br>
            <div class="alert alert-info">提示：只能找回注册时填写了QQ号码的帐号密码，QQ快捷登录的暂不持支该方式找回密码，请回到登录页面直接点击“QQ快捷登录”即可</div>
        </div>
        <hr>
        <div class="form-group">
            <a href="/?mod=login" class="btn btn-primary btn-rounded"><i class="fa fa-user"></i>&nbsp;返回登录</a>
            <a href="/?mod=reg" class="btn btn-danger btn-rounded" style="float:right;border-color: #FF9D34;background-color: #FF9D34;"><i class="fa fa-user-plus"></i>&nbsp;注册用户</a>
        </div>
    </div>
    <div class="form-group">
        <a href="/" class="btn btn-default" style="width: 100%;background-color: #ffffff;border-color: #ffffff;">返回首页</a>
    </div>
</div>
<script src="<?php echo $cdnpublic ?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic ?>twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="/assets/layer/2.3/layer.js"></script>
<script src="/assets/official/js/qrlogin.js?ver=<?php echo VERSION; ?>"></script>