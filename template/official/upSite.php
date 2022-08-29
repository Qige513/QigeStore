<?php
if (!defined('IN_CRONLITE')) exit();
if ($islogin2 != 1) {
    exit("<script>window.location.href='/?mod=login';</script>");
}
disable_hook('homeLoaded', 'sendRedPack');
disable_hook('homeLoaded', 'testAdvert');
if (!Template::isMobile()) {
    header('Location: /user/upsite.php');
    exit;
}
if (!$conf['fenzhan_upgrade']) {
    exit('<script>alert("当前站点未开启此功能");history.go(-1);</script>');
}
if ($userrow['power'] == 0) {
    exit('<script>alert("你没有权限使用此功能");history.go(-1);</script>');
}
$price = $conf['fenzhan_upgrade'];
if ($userrow['upzid'] > 1) {
    $up_site = $DB->get('site', ['zid', 'power', 'ktfz_price2'], ['zid' => $userrow['upzid']]);
    if ($up_site && $up_site['power'] == 2) {
        if ($up_site['ktfz_price2'] && $up_site['ktfz_price2'] > 0) {
            $price = $up_site['ktfz_price2'];
        }
        $tc_point = round($price - $conf['fenzhan_cost2'], 2);
    }
}
if (isset($_GET['act']) && $_GET['act'] == 'submit') {
    if ($price > $userrow['rmb']) {
        exitJson('你的余额不足，请充值', 1);
    }
    $DB->pdo->beginTransaction();
    $flag = $DB->update('site', ['power' => 2, 'rmb[-]' => $price], ['zid' => $userrow['zid']]);
    if (!$flag->rowCount()) {
        $DB->pdo->rollBack();
        exitJson('升级失败，请联系相关人员');
    }
    if (isset($tc_point) && $tc_point > 0) {
        $flag = $DB->update('site', ['rmb[+]' => $tc_point], ['zid' => $up_site['zid']]);
        if (!$flag->rowCount()) {
            $DB->pdo->rollBack();
            exitJson('升级失败，请联系相关人员');
        }
        addPointRecord($userrow['zid'], $price, '消费', '升级到专业版分站');
        addPointRecord($up_site['zid'], $tc_point, '提成', '你网站的用户升级分站获得' . $tc_point . '元提成');
    } else {
        addPointRecord($userrow['zid'], $price, '消费', '升级到专业版分站');
    }
    $DB->pdo->commit();
    exitJson('恭喜你成功升级站点版本', 0);
}
?>
<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>自助升级站点</title>
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
        title="自助升级站点"
        left-text="返回"
        left-arrow
        fixed
        placeholder
        @click-left="onClickLeft"
    ></van-nav-bar>
</div>

<section>
    <div id="app" v-cloak>
        <div class="introduce">
            <van-collapse v-model="activeNames">
                <van-collapse-item title="专业版介绍" name="1">
                    旗下分站管理功能,赚取下级分站提成
                    <van-divider></van-divider>
                    可自定义分站开通价格,下级商品成本价格
                    <van-divider></van-divider>
                    赠送专属APP客户端
                    <van-divider></van-divider>
                    更多特权开发中...
                </van-collapse-item>
            </van-collapse>
        </div>
        <van-divider>自助升级站点</van-divider>
        <div class="payment">
            <van-form @submit="onSubmit">
                <van-field v-model="rmb" type="number" label="账户余额" right-icon="gold-coin-o" error disabled></van-field>
                <van-field name="kind" label="升级版本" disabled>
                    <template #input>
                        <van-radio-group v-model="kind" direction="horizontal">
                            <van-radio name="2">专业版</van-radio>
                        </van-radio-group>
                    </template>
                </van-field>
                <van-field v-model="need" name="need" type="number" label="升级所需" right-icon="gold-coin-o" disabled></van-field>
                <div style="margin: 16px;">
                    <van-button round block type="info" native-type="submit">立即升级</van-button>
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
                kind: '2',
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
                    url: '/?mod=upSite&act=submit',
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
