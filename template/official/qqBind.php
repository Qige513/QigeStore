<?php
if (!defined('IN_CRONLITE')) exit();
// 关闭钩子监听
disable_hook('homeLoaded', 'sendRedPack');
disable_hook('homeLoaded', 'testAdvert');
if ($islogin2 != 1) {
    exit('<script>window.location.href="/?mod=login";</script>');
}
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo empty($userrow['qq_openid']) ? '绑定QQ号' : '解绑QQ号'; ?></title>

    <!-- 引入样式文件 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vant@2.8/lib/index.css" />
    <style>
        body {
            background-color: #f7f8fa;
        }
        [v-cloak] {
            display: none!important;
        }
        .qq-bind-icon {
            width: 100px;
            height: 100px;
            margin: 30px auto;
        }
        .qq-bind-tips {
            margin: 16px;
            font-size: 14px;
            color: #999999;
        }
    </style>
</head>

<body>

<div id="app" v-cloak>
    <van-nav-bar
        :title="!is_bind ? '绑定QQ号' : '解绑QQ号'"
        left-text="返回"
        fixed
        left-arrow
        placeholder
        @click-left="window.history.go(-1);"
    ></van-nav-bar>
    <?php if (empty($userrow['qq_openid'])): ?>
    <div class="qq-bind-icon">
        <van-icon name="/assets/official/image/03_qq_symbol-853x1024.png" size="100"></van-icon>
    </div>
    <?php else: ?>
    <div class="qq-bind-icon">
        <van-image
                round
                width="100px"
                height="100px"
                src="<?php echo htmlspecialchars($userrow['qq_head_img_url']); ?>"
        ></van-image>
    </div>
    <p style="text-align: center"><?php echo htmlspecialchars($userrow['qq_nickname']); ?></p>
    <?php endif; ?>
    <div style="margin: 16px;">
        <van-button block type="info" @click="qqBind">{{!is_bind ? '开始绑定' : '解绑'}}</van-button>
    </div>
    <van-divider>提示</van-divider>
    <div class="qq-bind-tips">
        <p>绑定提示：如果您之前使用过同个QQ号授权登录过系统，绑定相同的QQ号，之前授权登录的帐号余额将自动同步到本帐号，其它信息暂时不支持同步，之前帐号将无法登录，或者您可以暂不绑定，继续使用之前授权帐号。</p>
    </div>
</div>

<!-- 引入 Vue 和 Vant 的 JS 文件 -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vant@2.8/lib/vant.min.js"></script>
<script src="https://cdn.staticfile.org/jquery/3.5.1/jquery.min.js"></script>

<script>
    const is_bind = '<?php echo !empty($userrow['qq_openid']); ?>';

    new Vue({
        el: '#app',
        data() {
            return {
                is_bind: is_bind
            }
        },
        methods: {
            getAuthUrl() {
                const loading = this.$toast.loading({
                    message: '请稍后...',
                    forbidClick: true,
                    duration: 0
                });
                const that = this;
                $.ajax({
                    url: '/user/ajax.php?act=get_auth_bind_url',
                    success(res) {
                        loading.clear();
                        if (res['code'] !== 0) {
                            that.$toast.fail(res['msg']);
                            return false;
                        }
                        if (res['url']) {
                            location.href = res['url'];
                        } else {
                            that.$toast.fail('系统异常，请联系相关人员');
                        }
                    },
                    error() {
                        loading.clear();
                        that.$toast.fail('系统异常，请联系相关人员');
                    }
                });
            },
            qqBind() {
                if (this.is_bind) { // 已经绑定
                    this.$dialog.confirm({
                        title: '提示',
                        message: '您确定取消绑定吗？解绑后还可以重新绑定哦'
                    }).then(() => {
                        this.getAuthUrl();
                    }).catch(() => {

                    });
                } else {
                    this.getAuthUrl();
                }
            }
        }
    });

    Vue.use(vant.Lazyload);
</script>

</body>

</html>
