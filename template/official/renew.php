<?php
if (!defined('IN_CRONLITE')) exit();
disable_hook('homeLoaded', 'sendRedPack');
disable_hook('homeLoaded', 'testAdvert');
if ($islogin2 != 1) {
    exit('<script>window.location.href="/?mod=login";</script>');
}
if (!Template::isMobile()) {
    header('Location: /user/renew.php');
    exit;
}
if ($userrow['power'] == 0) {
    exit('<script>alert("你没有权限使用此功能");history.go(-1);</script>');
}
if ($userrow['power'] == 2) {
    $price = $conf['fenzhan_price2'];
    if ($userrow['upzid'] > 1) {
        $ktfz_price2 = $DB->get('site', 'ktfz_price2', ['zid' => $userrow['upzid']]);
        if ($ktfz_price2 && $ktfz_price2 > 0) {
            $price = $ktfz_price2;
        }
    }
} else {
    $price = $conf['fenzhan_price'];
    if ($userrow['upzid'] > 1) {
        $ktfz_price = $DB->get('site', 'ktfz_price', ['zid' => $userrow['upzid']]);
        if ($ktfz_price && $ktfz_price > 0) {
            $price = $ktfz_price;
        }
    }
}
$fenzhan_expiry = $conf['fenzhan_expiry'] > 0 ? $conf['fenzhan_expiry'] : 12;
if ($userrow['endtime'] > date("Y-m-d")) {
    $endtime = date('Y-m-d', strtotime("+ {$fenzhan_expiry} months", strtotime($userrow['endtime'])));
} else {
    $endtime = date('Y-m-d', strtotime("+ {$fenzhan_expiry} months"));
}
if (isset($_GET['act']) && $_GET['act'] == 'submit') {
    if ($price > $userrow['rmb']) {
        exitJson('你的余额不足，请充值', 1);
    }
    $DB->pdo->beginTransaction();
    $flag = $DB->update('site', ['endtime' => $endtime, 'rmb[-]' => $price], ['zid' => $userrow['zid']]);
    if (!$flag->rowCount()) {
        $DB->pdo->rollBack();
        exitJson('续期失败，请联系相关人员');
    }
    addPointRecord($userrow['zid'], $price, '消费', '自助续期站点');
    $DB->pdo->commit();
    exitJson('恭喜你成功续期到 ' . $endtime, 0);
}
?>
<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>自助续期站点</title>
    <!-- 引入样式文件 -->
    <link rel="stylesheet" href="/assets/official/vant@2.8/lib/index.css"/>
    <style>
        [v-cloak] {
            display: none!important;
        }
    </style>
</head>

<body style="background-color: #f7f8fa;">

<div id="nav_bar" v-cloak>
    <van-nav-bar
        title="自助续期站点"
        left-text="返回"
        left-arrow
        fixed
        placeholder
        @click-left="onClickLeft"
    ></van-nav-bar>
</div>

<section>
    <div id="app" v-cloak>
        <div class="payment">
            <van-form @submit="onSubmit">
                <van-field v-model="rmb" label-width="100px" type="number" label="账户余额" right-icon="gold-coin-o" error disabled></van-field>
                <van-field v-model="endTime" label-width="100px" label="当前到期时间" disabled></van-field>
                <van-field v-model="needTime" label-width="100px" label="续后到期时间" disabled></van-field>
                <van-field v-model="need" name="need" label-width="100px" type="number" label="续期所需" right-icon="gold-coin-o" disabled></van-field>
                <div style="margin: 16px;">
                    <van-button round block type="info" native-type="submit">立即购买</van-button>
                </div>
            </van-form>
        </div>
    </div>
</section>

<!-- 引入 Vue 和 Vant 的 JS 文件 -->
<script src="/assets/official/vue/dist/vue.min.js"></script>
<script src="/assets/official/vant@2.8/lib/vant.min.js"></script>
<script src="/assets/jquery/2.1.4/jquery.min.js"></script>

<script>
    new Vue({
        el: '#nav_bar',
        methods: {
            onClickLeft() {
                history.go(-1);
            }
        }
    });

    new Vue({
        el: '#app',
        data() {
            return {
                rmb: "<?php echo $userrow['rmb']; ?>",
                activeNames: ['1'],
                endTime: '<?php echo $userrow['endtime']; ?>',
                needTime: '<?php echo $endtime; ?>',
                need: '<?php echo number_format($price, 2, '.', ''); ?>'
            }
        },
        methods: {
            onSubmit(values) {
                const that = this;
                const loading = this.$toast.loading({
                    duration: 0,
                    message: '请稍后...',
                    forbidClick: true,
                    overlay: true
                });
                $.ajax({
                    type: 'POST',
                    url: '/?mod=renew&act=submit',
                    dataType: 'json',
                    success(res) {
                        loading.clear();
                        if (res['code'] === 0) {
                            that.$toast.success({
                                message: res['msg'],
                                onClose() {
                                    history.go(-1);
                                }
                            });
                            return false;
                        }
                        if (res['code'] === 1) {
                            that.$toast({
                                message: res['msg'],
                                onClose() {
                                    location.href = '/?mod=recharge';
                                }
                            });
                            return false;
                        }
                        that.$toast.fail(res['msg']);
                    },
                    error() {
                        loading.clear();
                        that.$toast.fail('系统异常，请联系相关人员');
                    }
                });
            }
        }
    });
</script>
</body>

</html>
