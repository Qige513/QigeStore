<?php
if (!defined('IN_CRONLITE')) exit;
// 关闭钩子监听
disable_hook('homeLoaded', 'sendRedPack');
disable_hook('homeLoaded', 'testAdvert');
if (!$islogin2) {
    exit('<script>window.location.href="/?mod=login";</script>');
}
if (!Template::isMobile()) {
    header('Location: /user/');
    exit;
}
// QQ 头像处理
if ($islogin2) {
    if (isset($userrow['qq_head_img_url']) && !empty($userrow['qq_head_img_url'])) {
        $user_img = $userrow['qq_head_img_url'];
    } else {
        $user_img = $userrow['qq'] ? '//q4.qlogo.cn/headimg_dl?dst_uin=' . $userrow['qq'] . '&spec=100' : '../assets/img/user.png';
    }
} else {
    $user_img = '/assets/img/user.png';
}
if (isset($_SESSION['qq_auth_' . $userrow['zid']])) {
    unset($_SESSION['qq_auth_' . $userrow['zid']]);
}
?>
<!DOCTYPE html>
<html lang="zh" style="font-size: 50px;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,viewport-fit=cove">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $conf['sitename'] ?> - <?php echo $conf['title'] ?></title>
    <meta name="keywords" content="<?php echo $conf['keywords'] ?>">
    <meta name="description" content="<?php echo $conf['description'] ?>">
    <script src="/assets/official/js/font-size.js"></script>
    <link rel="stylesheet" href="/assets/official/css/reset.css"/>
    <link rel="stylesheet" href="/assets/official/css/my/my.css"/>
    <link rel="stylesheet" href="/assets/official/css/common.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/user/css/app.css"/>
    <style>
        body {
            overflow-x: unset;
            background-color: rgb(244, 244, 244);
        }

        .content {
            padding: 0;
            margin-bottom: 60px;
        }

        .click-login a:active, .click-login a:hover, .click-login a:visited, .click-login a:focus {
            color: #fff;
        }
    </style>
</head>

<body>
<div class="wrapper" id="container">
    <div class="content">
        <?php
        if ($userrow['rmb'] > 4) {
            if (strlen($userrow['pwd']) < 6 || is_numeric($userrow['pwd'])
                && strlen($userrow['pwd']) <= 10 || $userrow['pwd'] === $userrow['qq']) { ?>
                <div class="row" style="width: 6.9rem;margin: 0.2rem auto;">
                    <div class="col-sm-12" style="padding: 0;">
                        <div class="alert alert-danger"
                             style="margin-bottom: 0;background-color: #f05050ab;border: none;box-shadow: unset;">
                            <p style="color: white">
                                <span class="btn-sm btn-danger" style="display: inline-block;">重要</span>
                                你的密码过于简单，请不要使用较短的纯数字或自己的QQ号当做密码，以免造成资金损失！
                                <a href="/?mod=userSet" class="alert-link" style="color: #FFB800">点此修改密码</a>
                            </p>
                        </div>
                    </div>
                </div>
            <?php } elseif ($userrow['user'] === $userrow['pwd']) { ?>
                <div class="row" style="width: 6.9rem;margin: 0.2rem auto;">
                    <div class="col-sm-12" style="padding: 0;">
                        <div class="alert alert-danger"
                             style="margin-bottom: 0;background-color: #f05050ab;border: none;box-shadow: unset;">
                            <p>
                                <span class="btn-sm btn-danger" style="display: inline-block;">重要</span>
                                你的用户名与密码相同，极易被黑客破解，请及时修改密码
                                <a href="/user/uset.php?mod=user" class="alert-link" style="color: #FFB800;">点此修改密码</a>
                            </p>
                        </div>
                    </div>
                </div>
            <?php }
        } ?>
        <div class="userInfo">
            <div class="left">
                <div class="img"
                     style="background-image: url('<?php echo $user_img; ?>');background-size: 100%;"></div>
                <?php if ($islogin2): ?><p><?php echo $userrow['user']; ?></p><?php endif; ?>
                <?php if (!$islogin2): ?>
                    <div class="click-login"><a href="/?mod=login">点击登录</a></div>
                <?php else: ?>
                    <p>UID：<?php echo $userrow['zid']; ?></p>
                <?php endif; ?>
            </div>
            <div class="right">
                <div class="top">
                    <ul>
                        <li class="click-href" data-href="">
                            <p>￥<?php echo !$islogin2 ? '0.00' : $userrow['rmb']; ?>元</p>
                            <p>可用余额</p>
                        </li>
                        <li class="click-href" data-href="">
                            <p>￥<span id="income_today">0.00</span>元</p>
                            <p>今日收益</p>
                        </li>
                    </ul>
                </div>
                <div class="bottom">
                    <ul>
                        <li class="click-href"
                            data-href="<?php echo !$islogin2 ? '/?mod=login' : '?mod=recharge'; ?>"
                        >充值</li>
                        <li class="click-href"
                            data-href="<?php
                                if (!$islogin2) {
                                    echo '/?mod=login';
                                } else {
                                    if (!Template::isMobile()) {
                                        echo '/user/shoplist.php';
                                    } else {
                                        echo '/?mod=cashOut';
                                    }
                                }
                            ?>"
                        >提现</li>
                        <li class="click-href"
                            data-href="<?php
                            if (!$islogin2) {
                                echo '/?mod=login';
                            } else {
                                if (!Template::isMobile()) {
                                    echo '/user/uset.php?mod=user';
                                } else {
                                    echo '/?mod=userSet';
                                }
                            }
                            ?>"
                        >修改密码</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="itemList">
            <ul>
                <?php if ($conf['qiandao_reward']) { ?>
                    <li class="click-href" data-href="/?mod=qiandao">
                        <div>
                            <img src="/assets/official/image/icon,qiandao@2x.png" alt="">
                        </div>
                        <p>每日签到</p>
                    </li>
                <?php } ?>
                <li class="click-href" data-href="/?mod=adminMessage">
                    <div>
                        <img src="/assets/official/image/icon，tousu@2x(1).png" alt="">
                    </div>
                    <p>站内通知</p>
                </li>
                <li class="click-href"
                    data-href="/?search_order=1">
                    <div>
                        <img src="/assets/official/image/icon，chaxun@2x.png" alt="">
                    </div>
                    <p>自助查单</p>
                </li>
                <li class="click-href" data-href="?mod=workOrder">
                    <div>
                        <img src="/assets/official/image/icon，tousu@2x(1).png" alt="">
                    </div>
                    <p>我的工单</p>
                </li>
                <li class="click-href" data-href="?mod=moneyRecord">
                    <div>
                        <img src="/assets/official/image/icon，zijin@2x.png" alt="">
                    </div>
                    <p>资金明细</p>
                </li>
                <?php if ($userrow['power'] > 0) { ?>
                    <li class="click-href" data-href="/?mod=shopList">
                        <div>
                            <img src="/assets/official/image/icon，chaxun@2x.png" alt="">
                        </div>
                        <p>商品管理</p>
                    </li>
                    <li class="click-href" data-href="?mod=order">
                        <div>
                            <img src="/assets/official/image/icon，tousu@2x(1).png" alt="">
                        </div>
                        <p>订单管理</p>
                    </li>
                    <?php if ($userrow['power'] == 2) { ?>
                        <li class="click-href" data-href="/?mod=siteList">
                            <div>
                                <img src="/assets/official/image/icon，houtai@2x.png" alt="">
                            </div>
                            <p>分站管理</p>
                        </li>
                    <?php }
                } ?>
            </ul>
        </div>
        <div class="manage">
            <div class="manageTitle">系统管理中心</div>
            <div class="manageBox">
                <?php if ($userrow['power'] > 0) { ?>
                    <div class="group click-menu" data-open_menu="0">
                        <div class="group_left">
                            <img src="/assets/official/image/icon，shouye@2x (2).png" alt="">
                        </div>
                        <div class="group_center">网站管理</div>
                        <div class="group_right">
                            <img src="/assets/official/image/icon,gengduo@2x.png" alt="">
                        </div>
                    </div>
                    <ul style="padding-left: 5%;display: none;">
                        <li>
                            <div class="group click-href" data-href="/?mod=classList">
                                <div class="group_left">
                                    <!--                                    <img src="/assets/official/image/icon,dingdan@2x.png" alt="">-->
                                </div>
                                <div class="group_center">分类管理</div>
                                <div class="group_right">
                                    <img src="/assets/official/image/icon,gengduo@2x.png" alt="">
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="group click-href" data-href="/?mod=shopList">
                                <div class="group_left">
                                    <!--                                    <img src="/assets/official/image/icon,dingdan@2x.png" alt="">-->
                                </div>
                                <div class="group_center">商品管理</div>
                                <div class="group_right">
                                    <img src="/assets/official/image/icon,gengduo@2x.png" alt="">
                                </div>
                            </div>
                        </li>
                        <?php if ($userrow['power'] == 2) { ?>
                            <li>
                                <div class="group click-href" data-href="/?mod=siteList">
                                    <div class="group_left">
                                        <!--                                        <img src="/assets/official/image/icon,dingdan@2x.png" alt="">-->
                                    </div>
                                    <div class="group_center">分站列表</div>
                                    <div class="group_right">
                                        <img src="/assets/official/image/icon,gengduo@2x.png" alt="">
                                    </div>
                                </div>
                            </li>
                        <?php } ?>
                        <li>
                            <div class="group click-href" data-href="/?mod=userList">
                                <div class="group_left">
                                    <!--                                    <img src="/assets/official/image/icon,dingdan@2x.png" alt="">-->
                                </div>
                                <div class="group_center">用户列表</div>
                                <div class="group_right">
                                    <img src="/assets/official/image/icon,gengduo@2x.png" alt="">
                                </div>
                            </div>
                        </li>
                    </ul>
                <?php } ?>
                <div class="group click-menu" data-open_menu="0">
                    <div class="group_left">
                        <img src="/assets/official/image/icon,shangpin@2x.png" alt="">
                    </div>
                    <div class="group_center">系统设置</div>
                    <div class="group_right">
                        <img src="/assets/official/image/icon,gengduo@2x.png" alt="">
                    </div>
                </div>
                <ul style="padding-left: 5%;display: none;">
                    <li>
                        <div class="group click-href" data-href="?mod=userSet">
                            <div class="group_left">
                            </div>
                            <div class="group_center">用户资料设置</div>
                            <div class="group_right">
                                <img src="/assets/official/image/icon,gengduo@2x.png" alt="">
                            </div>
                        </div>
                    </li>
                    <?php if ($userrow['power'] > 0): ?>
                    <li>
                        <div class="group click-href" data-href="?mod=userSet&status=site">
                            <div class="group_left"></div>
                            <div class="group_center">网站信息设置</div>
                            <div class="group_right">
                                <img src="/assets/official/image/icon,gengduo@2x.png" alt="">
                            </div>
                        </div>
                    </li>
                    <?php endif; ?>
                </ul>

                <div class="group click-href" data-href="/?mod=help">
                    <div class="group_left">
                        <img src="/assets/official/image/icon，tousu@2x.png" alt="">
                    </div>
                    <div class="group_center">常见问题</div>
                    <div class="group_right">
                        <img src="/assets/official/image/icon,gengduo@2x.png" alt="">
                    </div>
                </div>
            </div>
            <?php if ($islogin2): ?>
                <div class="loginout">退出登录</div>
            <?php endif; ?>
        </div>
        <div id="foot" class="content-foot-box">
            <div class="content-foot">
                <ul>
                    <li>
                        <a href="/">
                            <img src="/assets/official/image/icon，shouye@2x.png" alt="">
                            <span>首页</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php
                        if ($userrow['power'] > 0) { // 开通分站
                            echo '?mod=adminSubstation';
                        } else {
                            echo '?mod=substation';
                        }
                        ?>">
                            <img src="/assets/official/image/icon，fenzhan@2x.png" alt="">
                            <span>分站</span>
                        </a>
                    </li>
                    <li>
                        <a href="?mod=activity">
                            <img src="/assets/official/image/icon，huodong.png" alt="">
                            <span>抽奖</span>
                        </a>
                    </li>
                    <li>
                        <a href="?mod=user">
                            <img src="/assets/official/image/icon，wode@2x(1).png" alt="">
                            <span class="active">我的</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<script src="/assets/jquery/2.1.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic; ?>jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script src="<?php echo $cdnpublic; ?>layer/2.3/layer.js"></script>
<script src="<?php echo $cdnpublic; ?>clipboard.js/1.7.1/clipboard.min.js"></script>
<script src="<?php echo $cdnpublic; ?>toastr.js/latest/toastr.min.js"></script>
<script>
    let homepage = true;
    let isModal = false;
    const hashsalt = <?php echo $addsalt_js; ?>;
    const _is_login = <?php echo !$islogin2 ? 'false' : 'true'; ?>;
</script>
<script src="/assets/official/js/user.js"></script>
</body>
</html>
