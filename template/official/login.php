<?php
if (!defined('IN_CRONLITE')) exit;
// 关闭钩子监听
disable_hook('homeLoaded', 'sendRedPack');
disable_hook('homeLoaded', 'testAdvert');
$is_defend = true;
if (!Template::isMobile()) {
    header('Location: /user/login.php');
    exit;
}
if (isset($_GET['act']) && $_GET['act'] == 'login') {
    $user = addslashes($_POST['user']);
    $pass = addslashes($_POST['pass']);
    if (!$user || !$pass) {
        exitJson('用户名或密码不能为空');
    }
    if ($conf['captcha_open_login'] == 1 && $conf['captcha_open'] == 1) {
        if (isset($_POST['geetest_challenge']) && isset($_POST['geetest_validate']) && isset($_POST['geetest_seccode'])) {
            require_once SYSTEM_ROOT . 'class.geetestlib.php';
            $GtSdk = new GeetestLib($conf['captcha_id'], $conf['captcha_key']);

            $data = array(
                'user_id'     => $cookiesid,
                'client_type' => "web",
                'ip_address'  => $clientip
            );

            if ($_SESSION['gtserver'] == 1) {   //服务器正常
                $result = $GtSdk->success_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'], $data);
                if (!$result) {
                    exitJson('验证失败，请重新验证');
                }
            } else {  //服务器宕机,走failback模式
                if (!$GtSdk->fail_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'])) {
                    exitJson('验证失败，请重新验证');
                }
            }
        } else {
            exit(json(['code' => 2, 'type' => 1, 'msg' => '请先完成验证']));
        }
    } elseif ($conf['captcha_open_login'] == 1 && $conf['captcha_open'] == 2) {
        if (isset($_POST['token'])) {
            require_once SYSTEM_ROOT . 'class.dingxiang.php';
            $client = new CaptchaClient($conf['captcha_id'], $conf['captcha_key']);
            $client->setTimeOut(2);
            $response = $client->verifyToken($_POST['token']);
            if ($response->result) {
                exitJson('验证失败，请重新验证');
            }
        } else {
            exit(json(['code' => 2, 'type' => 2, 'appid' => $conf['captcha_id'], 'msg' => '请先完成验证']));
        }
    }
    if (empty($_SESSION['loginToken'])) {
        exitJson('用户名或密码不正确！');
    }
    $row = $DB->get('site', '*', ['user' => $user]);
    if ($row && $user === $row['user'] && $pass === $row['pwd']) {
        if ($row['status'] == 0) {
            exitJson('当前账号已被封禁！');
        }
        unset($_SESSION['loginToken']);
        $userToken = hash('sha256', md5($user . $pass . SYS_KEY));
        //进行不可逆加密用户密码
        $userTokenEncode = aesEncrypt($row['zid'] . PHP_EOL . $userToken, SYS_KEY);
        //加密userToken
        setcookie('userToken', $userTokenEncode, time() + 604800, '/');
        //存储Token
        $result = siteAttr($row['zid'], 'loginToken', $userToken);

        log_result('分站登录', 'User:' . $user . ' IP:' . $clientip, null, 1);
        $DB->update('site', ['lasttime' => $date], ['zid' => $row['zid']]);
        exitJson('登陆用户中心成功！', 0);
    } else {
        exitJson('用户名或密码不正确！');
    }
} elseif (isset($_GET['logout'])) {
    setcookie('userToken', '', time() - 604800, '/');
    if(!empty($userrow)){
        siteAttr($userrow['zid'],'loginToken',null);
    }
    @header('Content-Type: text/html; charset=UTF-8');
    exit('<script>alert("您已成功注销本次登陆！");window.location.href="/?mod=login";</script>');
} elseif ($islogin2 == 1) {
    @header('Content-Type: text/html; charset=UTF-8');
    unset($_SESSION['loginToken']);
    exit('<script>alert("您已登陆！");window.location.href="/?mod=user";</script>');
}
$_SESSION['loginToken'] = my_str_shuffle(9);
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>用户登录</title>
    <!-- 引入样式文件 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vant@2.8/lib/index.css"/>
    <style>
        [v-cloak] {
            display: none !important;
        }

        .login-avatar {
            width: 100px;
            margin: 20px auto;
        }

        .login-form {
            margin: 0 16px;
        }

        .login-form-found-pwd {
            width: 100%;
            font-size: 14px;
            margin-bottom: 14px;
        }

        .login-form-found-pwd span {
            color: #1989fa;
        }

        .login-other {
            margin: 0 16px;
        }

        .login-other-aisle-list {
            margin: 0 auto;
            text-align: center;
        }

        .login-other-aisle-item {
            width: 50px;
            height: 50px;
            display: inline-block;
        }

        .login-register {
            position: absolute;
            bottom: 30px;
            width: 100%;
            text-align: center;
        }

        .login-register .login-register-text span {
            display: inline-block;
            position: relative;
            top: -0.13rem;
        }

        #captcha_text {
            margin: 0 auto;
            text-align: center;
            font-size: 14px;
        }
    </style>
</head>

<body>

<div id="app" v-cloak>
    <van-nav-bar
            fixed="true"
            left-arrow
            placeholder
            :border="false"
            @click-left="window.history.go(-1);"
    ></van-nav-bar>
    <div class="login-avatar">
        <van-image
                round
                width="100px"
                height="100px"
                src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['kfqq']; ?>&spec=100"
        ></van-image>
    </div>
    <div class="login-form">
        <van-form @submit="onSubmit">
            <van-field
                    v-model="username"
                    name="username"
                    label="用户名"
                    placeholder="用户名"
                    :rules="[{ required: true, message: '请填写用户名' }]"
            ></van-field>
            <van-field
                    v-model="password"
                    type="password"
                    name="password"
                    label="密码"
                    placeholder="密码"
                    :rules="[{ required: true, message: '请填写密码' }]"
            ></van-field>

            <?php if ($conf['captcha_open_login'] == 1 && $conf['captcha_open'] >= 1) { ?>
                <div style="margin: 16px 10px 0 10px;height: 44px;">
                    <input type="hidden" name="captcha_type" value="<?php echo $conf['captcha_open'] ?>"/>
                    <?php if ($conf['captcha_open'] == 2) { ?><input type="hidden" name="appid"
                                                                     value="<?php echo $conf['captcha_id'] ?>"/><?php } ?>
                    <div id="captcha" style="margin: auto;">
                        <div id="captcha_text">
                            <van-loading>正在加载验证码...</van-loading>
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
                </div>
            <?php } ?>

            <div style="margin: 16px;">
                <div class="login-form-found-pwd"><span @click="location.href = '/?mod=findpwd';">忘记密码？</span></div>
                <van-button round block type="info" native-type="submit" :disabled="(!username || !password)">
                    登&nbsp;&nbsp;录
                </van-button>
            </div>
        </van-form>
    </div>
    <div class="login-other">
        <van-divider>其它登录方式</van-divider>
        <div class="login-other-aisle-list">
            <div class="login-other-aisle-item" @click="qqLoginAisle">
                <svg t="1591099550300" class="icon" viewBox="0 0 1024 1024" version="1.1"
                     xmlns="http://www.w3.org/2000/svg" p-id="1555" width="50" height="50">
                    <path d="M544.059897 959.266898h-64.949141c-228.633593 0-415.697442-187.063849-415.697442-415.697442v-64.949141c0-228.633593 187.063849-415.697442 415.697442-415.697442h64.949141c228.633593 0 415.697442 187.063849 415.697442 415.697442v64.949141c-0.001024 228.633593-187.064873 415.697442-415.697442 415.697442z"
                          fill="#5EAADE" p-id="1556"></path>
                    <path d="M729.459932 627.30075c-3.156638-39.628458-24.044923-83.747676-32.624058-105.910698l-22.084182-57.046794c-0.701361-23.73059 6.312253-78.322108-30.510759-146.611164s-110.820228-74.444654-124.497288-75.146016c-13.67706-0.701361-99.247252-1.402723-141.330987 72.944663-42.083735 74.347385-30.744205 148.812517-30.744205 148.812517l-23.523765 57.47785c-0.001024 0.002048-10.961716 26.222727-20.429584 58.135185-9.468891 31.913482-18.937783 82.063385-9.468892 92.233638 9.468891 10.170253 43.836626-46.643096 46.993265-51.902795 0 0 2.455277 27.179036 8.942615 41.382373l0.809893 1.776441 0.330715 0.722863 0.378837 0.826276 0.299999 0.652215 0.444366 0.960404 0.202729 0.435151a281.465052 281.465052 0 0 0 1.917738 4.024893l0.188394 0.386005c0.231398 0.473035 0.467916 0.953237 0.711601 1.442655l0.145391 0.291807c6.886653 13.807094 18.611164 33.823028 37.443487 50.420209l0.017406 0.015358-1.183612 0.387029c-10.666837 3.516022-31.69437 11.209497-40.624698 19.819348-1.717056 1.655623-2.987697 3.345033-3.650151 5.045707-5.376422 13.793783 4.208169 15.430976 20.574976 16.365783 16.365783 0.934807 94.922361 3.039916 132.563457-2.220807 0.407506-0.056314 0.787368-0.113651 1.171325-0.170989 2.710224 0.094197 5.32318 0.14232 7.828627 0.16075l0.151535 0.001024c0.83549 0.005119 1.66279 0.008191 2.474731 0.008191 0.496584 0 1.01467-0.002048 1.541971-0.006144l0.209896-0.001023a222.59267 222.59267 0 0 0 5.462429-0.106484c0.260067 0.037884 0.507847 0.075768 0.778152 0.113651 37.64212 5.260723 116.197674 3.156638 132.563457 2.220807 16.365783-0.934807 25.951397-2.572 20.573952-16.365783-4.301342-11.03646-34.17422-21.619339-45.956069-25.412834a141.388325 141.388325 0 0 0 7.958661-7.645351l0.236517-0.244709a142.494121 142.494121 0 0 0 2.531045-2.702033c42.433903-46.643096 38.927096-76.101301 40.681011-92.935 0 0 35.775577 51.552626 43.488506 53.306542 7.712928 1.753916 10.168205-6.311229 7.011566-45.940711z"
                          fill="#FFFFFF" p-id="1557"></path>
                </svg>
            </div>
            <div class="login-other-aisle-item" @click="moreLoginAisle">
                <van-icon name="more-o" size="50" color="#dedede"></van-icon>
            </div>
        </div>
    </div>
    <?php if ($conf['user_open'] == 1): ?>
        <div class="login-register">
            <div class="login-register-text">
                <span @click="location.href = '/?mod=reg';">立即注册</span>
                <van-icon name="arrow"></van-icon>
            </div>
        </div>
    <?php else: ?>
        <div class="login-register">
            <div class="login-register-text">
                <span @click="location.href = '/?mod=substation';">开通分站</span>
                <van-icon name="arrow"></van-icon>
            </div>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.staticfile.org/jquery/3.5.1/jquery.min.js"></script>
<!-- 引入 Vue 和 Vant 的 JS 文件 -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vant@2.8/lib/vant.min.js"></script>
<script src="/assets/official/js/login.js"></script>

<script>
    new Vue({
        el: '#app',
        data() {
            return {
                username: '',
                password: ''
            }
        },
        methods: {
            onSubmit(values) {
                const that = this;
                let captcha_type = $("input[name='captcha_type']").val();
                captcha_type = parseInt(captcha_type);
                const data = {user: values['username'], pass: values['password']};
                let addData = {};
                if (captcha_type === 1) {
                    let geetest_challenge = $("input[name='geetest_challenge']").val();
                    let geetest_validate = $("input[name='geetest_validate']").val();
                    let geetest_seccode = $("input[name='geetest_seccode']").val();
                    if (geetest_challenge === undefined) {
                        that.$toast.fail('请先完成滑动验证');
                        return false;
                    }
                    addData = {
                        geetest_challenge: geetest_challenge,
                        geetest_validate: geetest_validate,
                        geetest_seccode: geetest_seccode
                    };
                } else if (captcha_type === 2) {
                    let token = $("input[name='token']").val();
                    if (token === undefined) {
                        that.$toast.fail('请先完成滑动验证');
                        return false;
                    }
                    addData = {token: token};
                }
                const loading = this.$toast.loading({
                    message: '正在登录...',
                    forbidClick: true,
                    duration: 0
                });
                $.ajax({
                    type: 'POST',
                    url: '/?mod=login&act=login',
                    data: Object.assign(data, addData),
                    dataType: 'json',
                    success(data) {
                        loading.clear();
                        if (data['code'] === 0) {
                            that.$toast({
                                message: '登录成功，正在跳转到用户中心',
                                onClose() {
                                    window.location.href = '/?mod=user';
                                }
                            });
                        } else {
                            that.$toast.fail(data['msg']);
                        }
                    },
                    error() {
                        loading.clear();
                        that.$toast.fail('系统异常，请联系相关人员');
                    }
                });
            },
            qqLoginAisle() {
                const loading = this.$toast.loading({
                    message: '请稍后...',
                    forbidClick: true,
                    duration: 0
                });
                const that = this;
                $.ajax({
                    url: '/ajax.php?act=get_auth_url',
                    success(res) {
                        loading.clear();
                        if (res['code'] !== 0) {
                            that.$toast.fail(res['msg']);
                            return false;
                        }
                        if (res['url']) {
                            location.href = res['url'];
                        } else {
                            that.$toast('系统异常，请联系相关人员');
                        }
                    },
                    error() {
                        loading.clear();
                        that.$toast('系统异常，请联系相关人员');
                    }
                });
            },
            moreLoginAisle() {
                this.$toast('敬请期待')
            }
        }
    });

    Vue.use(vant.Lazyload);
</script>
</body>

</html>
