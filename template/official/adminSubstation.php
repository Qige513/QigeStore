<?php
if (!defined('IN_CRONLITE')) exit();
if (!Template::isMobile()) {
    header('Location: /user/');
    exit;
}
disable_hook('homeLoaded', 'sendRedPack');
disable_hook('homeLoaded', 'testAdvert');
?>
<!DOCTYPE html>
<html lang="zh" style="font-size: 50px;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,viewport-fit=cove">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>分站</title>
    <script src="/assets/official/js/font-size.js"></script>
    <link rel="stylesheet" href="/assets/official/css/reset.css"/>
    <link rel="stylesheet" href="/assets/official/css/substation/admin-substation.css"/>
    <link rel="stylesheet" href="/assets/official/css/common.css"/>
    <!--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">-->
    <link rel="stylesheet" href="/assets/user/css/app.css"/>
</head>

<body>
<div class="flex-top-black">
    <img class="flex-left-img" src="/assets/official/image/substation/icon，houtui@2x.png" alt="">
    <span>分站管理中心</span>
</div>
<div id="container" class="container">
    <?php if ($userrow['power'] <= 0): ?>
        <div class="content">
            <div class="content-admin">
                <div class="admin-content">
                    <div style="padding: 10px;text-align: center;">
                        <h1 style="color: orangered;">你还未开通分站哦</h1>
                        <br>
                        <p style="text-align: center">
                            <a
                                    href="/?mod=substation"
                                    style="color: #ffffff;background-color: #0acf97;border: 1px solid #0acf97;border-radius: 3px;padding: 3px 5px;">点此开通分站</a>
                        </p>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="content">
            <div class="content-admin">
                <div class="admin-nav">
                    <a href="/"><img src="/assets/official/image/substation/icon，dijia@2x.png" alt="低价下单">
                        <p>低价下单</p>
                    </a>
                    <a href="<?php
                    if (!Template::isMobile()) {
                        echo '/user/record.php';
                    } else {
                        echo '/?mod=moneyRecord';
                    }
                    ?>"><img src="/assets/official/image/substation/icon,ticheng@2x.png"
                                                    alt="提成明细">
                        <p>提成明细</p>
                    </a>
                    <a href="<?php
                    if (!Template::isMobile()) {
                        echo '/user/list.php';
                    } else {
                        echo '/?mod=order';
                    }
                    ?>"><img src="/assets/official/image/substation/icon,wangzhan@2x.png"
                                                  alt="网站订单">
                        <p>网站订单</p>
                    </a>
                    <a href="<?php
                    if (!Template::isMobile()) {
                        echo '/user/shoplist.php';
                    } else {
                        echo '/?mod=shopList';
                    }
                    ?>"><img src="/assets/official/image/substation/icon,shangpin@2x.png"
                                                      alt="商品加价">
                        <p>商品加价</p>
                    </a>
                    <a href="<?php
                    if (!Template::isMobile()) {
                        echo '/user/message.php';
                    } else {
                        echo '/?mod=adminMessage';
                    }
                    ?>"><img src="/assets/official/image/substation/icon,tongzhi@2x.png"
                                                     alt="站内通知">
                        <p>站内通知</p>
                    </a>
                </div>
                <div class="admin-content">
                    <div class="admin-content-header">
                        我的站点信息
                    </div>
                    <ul>
                        <li>
                            <span>提醒通知：</span>
                            <div class="header-right">
                                <p>你当前有 <strong class="yellow" style="font-weight: bold;" id="tiaosu">0</strong> 信息未阅读
                                </p>
                                <a class="header-right-p" href="<?php
                                if (!$islogin2) {
                                    echo '/?mod=login';
                                } else {
                                    if (!Template::isMobile()) {
                                        echo '/user/message.php';
                                    } else {
                                        echo '/?mod=adminMessage';
                                    }
                                }
                                ?>">立刻查看</a>
                            </div>
                        </li>
                        <li>
                            <span>我的域名：</span>
                            <div class="header-right">
                                <p><b><a href="//<?php echo $userrow['domain']; ?>/" target="_blank"
                                         rel="noreferrer"><?php echo $userrow['domain'] ?></a></b></p>
                                <a href="<?php
                                if (!$islogin2) {
                                    echo '/?mod=login';
                                } else {
                                    if (!Template::isMobile()) {
                                        echo '/user/uset.php?mod=site';
                                    } else {
                                        echo '/?mod=userSet&status=site';
                                    }
                                }
                                ?>" class="yellowbg header-right-p">编辑信息</a>
                            </div>
                        </li>
                        <?php if ($conf['fanghong_api']): ?>
                            <li>
                                <span>防红链接：</span>
                                <div class="header-right">
                                    <p style="font-weight: bold;" data-clipboard-text="" id="copy-btn">Loading...</p>
                                    <a href="javascript:" id="url_tips" class="header-right-p">说明</a>
                                </div>
                            </li>
                        <?php endif; ?>
                        <li>
                            <span>网站名称：</span>
                            <div class="header-right">
                                <p><b><?php echo $userrow['sitename']; ?></b></p>
                            </div>
                        </li>
                        <li>
                            <span>站点类型：</span>
                            <div class="header-right">
                                <p class="yellow"><?php echo($userrow['power'] == 2 ? '<span style="color: red;">专业版</span>' : '<span style="color: red;">普及版</span>'); ?></p>
                                <?php if ($conf['fenzhan_upgrade'] > 0 && $userrow['power'] == 1): ?>
                                    <a href="<?php
                                    if (!$islogin2) {
                                        echo '/?mod=login';
                                    } else {
                                        if (!Template::isMobile()) {
                                            echo '/user/upsite.php';
                                        } else {
                                            echo '/?mod=upSite';
                                        }
                                    }
                                    ?>" class="header-right-p" style="background-color: red;">升级站点</a>
                                <?php else: ?>
                                    <a href="<?php
                                    if (!$islogin2) {
                                        echo '/?mod=login';
                                    } else {
                                        if (!Template::isMobile()) {
                                            echo '/user/sitelist.php';
                                        } else {
                                            echo '/?mod=siteList';
                                        }
                                    }
                                    ?>" class="header-right-p" style="background-color: red;">下级管理</a>
                                <?php endif; ?>
                            </div>
                        </li>
                        <?php if ($conf['fenzhan_expiry'] > 0): ?>
                            <li>
                                <span>到期时间：</span>
                                <div class="header-right">
                                    <p style="color: orange;"><?php echo $userrow['endtime']; ?></p>
                                    <a href="<?php
                                    if (!$islogin2) {
                                        echo '/?mod=login';
                                    } else {
                                        if (!Template::isMobile()) {
                                            echo '/user/renew.php';
                                        } else {
                                            echo '/?mod=renew';
                                        }
                                    }
                                    ?>" class="header-right-p" style="background-color: #ff9d34;">立即续期</a>
                                </div>
                            </li>
                        <?php endif; ?>
                        <li>
                            <span>当前状态：</span>
                            <div class="header-right">
                                <p>
                                    <?php if ($conf['fenzhan_expiry'] > 0 && $userrow['endtime'] < $date): ?>
                                        <span style="color: red;">已到期</span>
                                    <?php else: ?>
                                        <span style="color: green;">正常运行</span>
                                    <?php endif; ?>
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
                <!--            <div class="admin-a-btn">-->
                <!--                <a href="/?mod=login&logout">-->
                <!--                    <img src="/assets/official/image/substation/icon，anquanyuichu@2x.png" alt="">-->
                <!--                    <span>安全退出</span>-->
                <!--                </a>-->
                <!--            </div>-->
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
                                <img src="/assets/official/image/icon，fenzhan-shi@2x.png" alt="">
                                <span class="active">分站</span>
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
                                <img src="/assets/official/image/icon，wode@2x.png" alt="">
                                <span>我的</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<script src="/assets/jquery/2.1.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic ?>layer/2.3/layer.js"></script>
<script src="<?php echo $cdnpublic ?>clipboard.js/1.7.1/clipboard.min.js"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>-->
<script>
    $(document).ready(function () {

        function fiexdTop() {
            const flex_top_black = document.getElementsByClassName('flex-top-black')[0];
            const docH = document.documentElement.clientHeight;
            const docW = document.documentElement.clientWidth;
            if (docW / docH > 1) {
                flex_top_black.classList.add('flex-js');
            }
        }

        fiexdTop();

        function historyGo() {
            const flex_left_img = document.getElementsByClassName('flex-left-img')[0];
            flex_left_img.onclick = function () {
                window.history.go(-1)
            }
        }

        historyGo();

        // 加载防红链接
        $.ajax({
            type: "GET",
            url: "/user/ajax.php?act=create_url",
            dataType: 'json',
            async: true,
            success: function (data) {
                if (data.code === 0) {
                    $("#copy-btn").html(data.url).attr('data-clipboard-text', data.url);
                } else {
                    $("#copy-btn").html(data.msg);
                }
            }
        });

        const clipboard = new Clipboard('#copy-btn');
        clipboard.on('success', function () {
            layer.msg('复制成功！', {icon: 1});
        });
        clipboard.on('error', function () {
            layer.msg('复制失败，请长按链接后手动复制', {icon: 2});
        });

        $('#url_tips').click(function () {
            layer.alert('防红链接：该链接可以在QQ直接打开的您的网站，方便推广！<br />Tips：点击短网址即可复制哦~', {
                icon: 3,
                title: '小提示'
            });
        });
    });
</script>
</body>

</html>
