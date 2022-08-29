<?php
if (!defined('IN_CRONLITE')) exit();
if (!Template::isMobile()) {
    $url = '/user/regok.php?';

    if (isset($_GET['orderid'])) {
        $url .= 'orderid=' . $_GET['orderid'];
    } else if (isset($_GET['zid'])) {
        $url .= 'zid=' . $_GET['zid'];
    }

    header('Location: ' . $url);
    exit;
}
disable_hook('homeLoaded', 'sendRedPack');
disable_hook('homeLoaded', 'testAdvert');

$retData = [
    'isSuccess' => false,
    'msg'       => '',
    'data'      => []
];

if (isset($_GET['orderid'])) {
    $orderid = addslashes($_GET['orderid']);
    $row     = $DB->get('pay', '*', ['trade_no' => $orderid]);
    if (!$row || $row['status'] == 0 || $row['tid'] != -2) {
        $retData['msg'] = '订单不存在或未完成支付！';
    } else {
        if (!$cookiesid || $row['userid'] != $cookiesid) {
            $retData['msg'] = '仅限查看自己开通的分站信息';
        } else {
            $input = explode('|', $row['input']);
            $type  = $input[0];
            if ($type == 'update') {
                $zid = intval($input[1]);
                $row = $DB->get('site', '*', ['zid' => $zid]);

                $retData['data']['kind']     = intval($row['power']);
                $retData['data']['domain']   = $row['domain'];
                $retData['data']['user']     = $row['user'];
                $retData['data']['pwd']      = $row['pwd'];
                $retData['data']['sitename'] = $row['sitename'];
                $retData['data']['qq']       = $row['qq'];
                $retData['data']['endtime']  = $row['endtime'];
            } else {
                $retData['data']['kind']     = intval($input[1]);
                $retData['data']['domain']   = daddslashes($input[2]);
                $retData['data']['user']     = daddslashes($input[3]);
                $retData['data']['pwd']      = daddslashes($input[4]);
                $retData['data']['sitename'] = daddslashes($input[5]);
                $retData['data']['qq']       = daddslashes($input[6]);
                $retData['data']['endtime']  = daddslashes($input[7]);
            }
            $retData['data']['url'] = 'http://' . $domain . '/';
            $retData['isSuccess']   = true;
        }
    }
} elseif (isset($_GET['zid'])) {
    $zid = intval($_GET['zid']);
    $row = $DB->get('site', '*', ['zid' => $zid]);
    if (!$row || !$_SESSION['newzid'] || $_SESSION['newzid'] != $zid) {
        $retData['msg'] = '你所开通的分站信息不存在!';
    } else {
        $retData['data']['kind']     = intval($row['power']);
        $retData['data']['domain']   = $row['domain'];
        $retData['data']['user']     = $row['user'];
        $retData['data']['pwd']      = $row['pwd'];
        $retData['data']['sitename'] = $row['sitename'];
        $retData['data']['qq']       = $row['qq'];
        $retData['data']['endtime']  = $row['endtime'];
        $retData['data']['url']      = 'http://' . $domain . '/';
        $retData['isSuccess']        = true;
    }
} else {
    $retData['msg'] = '缺少参数!';
}

if($retData['isSuccess']){
    $userToken = hash('sha256', md5($retData['data']['user'] . $retData['data']['pwd'] . SYS_KEY));
    //进行不可逆加密用户密码
    $userTokenEncode = aesEncrypt($zid . PHP_EOL . $userToken, SYS_KEY);
    //加密userToken
    setcookie('userToken', $userTokenEncode, time() + 604800, '/');
    //存储Token
    $result = siteAttr($zid, 'loginToken', $userToken);

    log_result('分站登录', 'User:' . $user . ' IP:' . $clientip, null, 1);
    $DB->update('site', ['lasttime' => $date], ['zid' => $row['zid']]);
}
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,viewport-fit=cove">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>开通分站成功</title>
    <!-- 引入样式文件 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vant@2.8/lib/index.css"/>
    <style>
        body {
            background-color: #f7f8fa;
        }

        .bottom-button {
            width: 160px;
        }

        [v-cloak] {
            display: none!important;
        }
    </style>
</head>

<body>
<?php if (!$retData['isSuccess']): ?>
    <div id="container" v-cloak class="container">
        <div class="content">
            <van-empty image="error" description="<?php echo $retData['msg']; ?>">
                <van-button
                        round
                        type="info"
                        size="large"
                        class="bottom-button"
                        @click="window.location.href='/?mod=substation'"
                >
                    开通分站
                </van-button>
            </van-empty>
            <van-nav-bar
                    title="系统异常"
                    left-text="返回"
                    fixed="true"
                    left-arrow
                    @click-left="window.history.go(-1);"
            ></van-nav-bar>
        </div>
    </div>
<?php else: ?>
    <div id="container" v-cloak class="container" style="padding-top: 50px;">
        <van-nav-bar
                title="开通分站成功"
                left-text="返回"
                fixed="true"
                left-arrow
                @click-left="window.history.go(-1);"
        >
        </van-nav-bar>
        <van-divider>以下是您的分站信息，请妥善保管</van-divider>
        <van-cell-group>
            <van-cell title="分站网址" value="<?php echo $retData['data']['url']; ?>" @click="homeLocation"></van-cell>
            <van-cell title="分站管理后台" value="<?php echo $retData['data']['url'] . 'user/'; ?>" @click="userLocation"></van-cell>
            <van-cell title="管理员用户名" value="<?php echo $retData['data']['user']; ?>"></van-cell>
            <van-cell title="管理员密码" value="<?php echo $retData['data']['pwd']; ?>"></van-cell>
        </van-cell-group>
    </div>

<?php endif; ?>
<!-- 引入 Vue 和 Vant 的 JS 文件 -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vant@2.8/lib/vant.min.js"></script>
<script src="https://cdn.staticfile.org/jquery/3.5.1/jquery.min.js"></script>
<script>
    // 在 #app 标签下渲染一个按钮组件
    new Vue({
        el: '#container',
        data() {
            return {}
        },
        methods: {
            homeLocation(event) {
                location.href = event.target.outerText;
            },
            userLocation(event) {
                location.href = event.target.outerText;
            }
        }
    });

    Vue.use(vant.Lazyload);
</script>
</body>

</html>
