<?php
if (!defined('IN_CRONLITE')) exit();
if($islogin2 != 1){
    exit('<script>window.location.href="/?mod=login";</script>');
}
if (!Template::isMobile()) {
    header('Location: /user/faq.php');
    exit;
}
disable_hook('homeLoaded', 'sendRedPack');
disable_hook('homeLoaded', 'testAdvert');
?>
<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,viewport-fit=cove">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>常见问题</title>
    <!-- 引入样式文件 -->
    <link rel="stylesheet" href="/assets/official/vant@2.8/lib/index.css"/>
    <style>
        body {
            background-color: #f7f8fa;
        }
        section {
            padding: 10px 10px 0 10px;
        }
        [v-cloak] {
            display: none!important;
        }
    </style>
</head>

<body>
<!--导航-->
<div id="nav_bar">
    <van-nav-bar
        left-text="返回"
        left-arrow
        title="常见问题"
        fixed
        placeholder
        @click-left="onClickLeft"
    ></van-nav-bar>
</div>
<section>
    <div id="app" v-cloak>
        <van-collapse v-model="activeNames">
            <van-collapse-item title="怎么获取收益提成的？" name="1">
                你只需要把你的网址发给你的用户让他下单，一旦下单付款成功，你的账户就会增加你所赚差价的金额，自己是可以设置销售价格的哦！<br>
                差价提成算法：销售价格-拿货价格=提成
            </van-collapse-item>
            <van-collapse-item title="怎么去推广自己的站点？" name="2">
                你也可以通过（<a href="/?mod=shopList"><font color="#337ab7">商品管理</font></a>）把商品售价提高，那样利润就会更高，但是也要有分寸。<br>
                最简单的方法就是QQ群，多加点互赞、名片赞群，发名片赞广告。空间互踩群，发空间人气、说说赞等相关广告。<br>
                KF相关群打KF双击、播放等广告。等等以此类推，效果还是挺好的。<br>
                当然还有百度贴吧、网上各大论坛，你都可以去推广，付出越多，收益越大！不要局限在自己那几十个或者几百个QQ好友里面，互联网的陌生人才是你赚钱的方向！
            </van-collapse-item>
            <van-collapse-item title="账户提现需要注意什么？" name="3">
                只要你的账户达到 <?php echo $conf['tixian_min']; ?> 元，即可提现，提现会扣取<?php echo (100 - $conf['tixian_rate']); ?>%的手续费，提现一般会在24小时内审核成功后并打款！<br>
                提现方式支持：支付宝 QQ  微信，需要上传相关的收款二维码（没有上传的提现不会到账）！
            </van-collapse-item>
            <van-collapse-item title="下单前需要充值余额吗？" name="4">
                完全不需要的哈，用户在你网站下单后，差价一样会到达你的账户里面，而且你赚取的钱还可以在后台以代理价格开单或者提现！<br>
                除非你自己在后台下单，后台下单是按拿货价格下单的！
            </van-collapse-item>
            <van-collapse-item title="下单需要注意什么问题？" name="5">
                下单前不管是你还是你的用户，必须的提醒他，看清楚商品说明，避免刷单不到账的情况！<br>
                订单有什么问题直接发给客服QQ，让客服处理！
            </van-collapse-item>
            <van-collapse-item title="网址给QQ或微信爆毒拦截？" name="6">
                在用户中心会看到域名防红链接<br>
                复制即可发给QQ或微信好友，通过短网址在QQ或微信访问是不会报毒的。<br>
            </van-collapse-item>
            <van-collapse-item title="售后和处理订单需要自己来嘛？" name="7">
                把你网站分享出去，别人下单后你就会有钱赚！或者你在外面接单，自己到后台下单！<br>
                你只需要宣传或者接单就行了，订单处理和售后等有我们的客服来解决！
            </van-collapse-item>
        </van-collapse>
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
                activeNames: ['1']
            }
        }
    });
</script>
</body>

</html>
