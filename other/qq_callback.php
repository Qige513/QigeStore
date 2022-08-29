<?php
require_once '../includes/common.php';

$model = new \ds\QQAuthConnect();

if (!isset($_SESSION['qq_auth_' . $userrow['zid']]) && empty($_SESSION['qq_auth_' . $userrow['zid']])) {
    $result = $model->callBack();
} else {
    $result = $_SESSION['qq_auth_' . $userrow['zid']];
}

if ($result['code'] != 0) { ?>
    <!DOCTYPE html>
    <html lang="zh">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>QQ授权</title>
        <style>
            h1 {
                text-align: center;
            }
        </style>
    </head>
    <body>
    <h1><?php echo $result['msg']; ?></h1>
    </body>
    </html>
    <?php
    exit;
} elseif ($result['auth_type'] == 1) { ?>
    <!doctype html>
    <html lang="zh">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,viewport-fit=cove">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>QQ授权</title>
        <style>
            h1 {
                text-align: center;
            }
        </style>
    </head>
    <body>
    <h1><?php echo $result['msg']; ?></h1>
    <?php
    if ($result['code'] == 0) {
        echo '<script>window.location.href = "' . (isset($result['url']) ? $result['url'] : '/') . '";</script>';
    }
    ?>
    </body>
    </html>
<?php } else { ?>
    <!DOCTYPE html>
    <html lang="zh">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>QQ授权</title>
        <!-- 引入样式文件 -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vant@2.8/lib/index.css"/>
        <style>
            [v-cloak] {
                display: none !important;
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

            .select-login-type {
                margin: 50% 16px 0 16px;
            }

            @media only screen and (min-width: 1080px) {
                .select-login-type {
                    margin: 15% 45% 0 45%;
                }
            }

            @media only screen and (min-width: 768px) {
                .select-login-type {
                    margin: 15% 35% 0 35%;
                }
            }
        </style>
    </head>

    <body>

    <div id="app" v-cloak>
        <van-nav-bar
                :title="title"
                left-text="返回"
                fixed="true"
                left-arrow
                placeholder
                @click-left="onClickLeft"
        ></van-nav-bar>
        <div v-if="!is_select" class="select-login-type">
            <van-button round type="info" block @click="newUserLocation">我是新用户，点击进入</van-button>
            <br>
            <van-button round block @click="onBindOldUser">我是老用户，开始绑定</van-button>
        </div>
        <div class="login-form" style="display: none">
            <van-divider>请输入老用户账号密码进行绑定</van-divider>
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
                    <van-button round block type="info" native-type="submit" :disabled="(!username || !password)">
                        绑&nbsp;&nbsp;定
                    </van-button>
                </div>
            </van-form>
        </div>
    </div>

    <script src="https://cdn.staticfile.org/jquery/3.5.1/jquery.min.js"></script>
    <!-- 引入 Vue 和 Vant 的 JS 文件 -->
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vant@2.8/lib/vant.min.js"></script>
    <script src="/assets/js/qq_callback.js"></script>

    <script>
        new Vue({
            el: '#app',
            data() {
                return {
                    username: '',
                    password: '',
                    is_select: false,
                    title: '请选择用户类型'
                }
            },
            methods: {
                newUserLocation() {
                    location.href = "<?php echo $result['url']; ?>";
                },
                onClickLeft() {
                    if (!this.is_select) {
                        history.go(-1);
                    } else {
                        this.is_select = false;
                        this.title = '请选择用户类型';
                        $('.login-form').hide();
                    }
                },
                onBindOldUser() {
                    this.is_select = true;
                    this.title = '绑定老用户';
                    $('.login-form').show();
                },
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
                        message: '正在绑定...',
                        forbidClick: true,
                        duration: 0
                    });
                    $.ajax({
                        type: 'POST',
                        url: '/ajax.php?act=post_bind_old_user',
                        data: Object.assign(data, addData),
                        dataType: 'json',
                        success(data) {
                            loading.clear();
                            if (data['code'] === 0) {
                                that.$toast({
                                    message: '绑定成功，正在跳转到用户中心',
                                    onClose() {
                                        window.location.href = data['url'];
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
<?php } ?>