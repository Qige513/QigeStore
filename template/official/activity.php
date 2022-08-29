<?php
if (!defined('IN_CRONLITE')) exit;
// 关闭钩子监听
disable_hook('homeLoaded', 'sendRedPack');
disable_hook('homeLoaded', 'testAdvert');
?>
<!DOCTYPE html>
<html lang="zh" style="font-size: 50px;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,viewport-fit=cove">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>活动</title>
    <link rel="stylesheet" href="/assets/official/css/reset.css"/>
    <link rel="stylesheet" href="/assets/official/css/activity/activity.css">
    <link rel="stylesheet" href="/assets/official/css/common.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/user/css/app.css"/>
    <!-- 引入样式文件 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vant@2.8/lib/index.css"/>
    <style>
        body {
            background-color: rgb(244, 244, 244);
        }

        .game-iframe {
            margin: 0;
            padding: 0;
            border: none;
            height: 812px;
        }

        .container .content {
            padding: 0;
            margin: 0;
        }

        @media (min-width: 1200px) {
            body {
                margin: 0;
                padding: 0;
            }
            .container {
                width: 100%;
                margin: 0;
                padding: 0;
            }
            .content {
                margin: 0;
                padding: 0;
                height: 100%;
            }
            .game-iframe {
                margin: 0;
                padding: 0;
            }
        }

        @media only screen and (max-width: 768px) {
            .container {
                width: 100%;
            }
            .game-iframe {
                width: 100%;
                height: auto;
            }

        }
        @media only screen and (max-width: 414px) {
            .game-iframe {
                height: 690px;
            }
        }
        @media only screen and (max-height: 667px) {
            .game-iframe {
                height: 621px;
            }
        }
        @media only screen and (max-width: 375px) {
            .game-iframe {
                height: 736px;
            }
        }
        @media only screen and (max-width: 320px) {
            .game-iframe {
                height: 522px;
            }
        }
        #container {
            margin: 0;
            padding: 0;
        }
        .content {
            margin: 0;
            padding: 0;
        }
        [v-cloak] {
            display: none!important;
        }
    </style>
</head>

<body>
<div id="container" v-cloak class="container" style="background: none;">
    <div class="content">
        <van-empty description="程序猿正在加班赶工中，敬请期待..."></van-empty>
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
                            <img src="/assets/official/image/icon，huodong,shi.png" alt="">
                            <span class="active">抽奖</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $islogin2 ? '?mod=user' : '?mod=login'; ?>">
                            <img src="/assets/official/image/icon，wode@2x.png" alt="">
                            <span>我的</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo $cdnpublic ?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic ?>jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="/assets/official/js/font-size.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!-- 引入 Vue 和 Vant 的 JS 文件 -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vant@2.8/lib/vant.min.js"></script>
<script>
    new Vue({
        el: '#container'
    });

    $(window).resize(function () {
        $('.game-iframe').height($(document).height());
        location.reload();
    });
    $('.game-iframe').height($(document).height());
    $(document).ready(function () {
        function clickSpan() {
            const activetyul = document.getElementsByClassName('activety-ul')[0];
            let span = activetyul.getElementsByTagName('span');
            for (let i = 0; i < span.length; i++) {
                span[i].onclick = function () {
                    // for (let j = 0; j < span.length; j++) {
                    //     if (i != j) {
                    //         span[j].classList.remove('span-cative')
                    //     }
                    // }
                    // this.classList.add('span-cative');
                    activetyul.getElementsByClassName('span-cative')[0].className = '';
                    this.className = 'span-cative';
                }
            }
        }

        // clickSpan();

        function updateQueryStringParameter(uri, key, value) {
            if (!value) {
                return uri;
            }
            var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
            var separator = uri.indexOf('?') !== -1 ? "&" : "?";
            if (uri.match(re)) {
                return uri.replace(re, '$1' + key + "=" + value + '$2');
            } else {
                return uri + separator + key + "=" + value;
            }
        }

        function remove_arg_from_url(name) {
            //从当前URL的?号开始的字符串
            //如:http://www.baidu.com/s?wd=baidu&cl=3 它的search就是?wd=baidu&cl=3
            var query_string = window.location.search.substr(1);
            //如果没有参数则返回空
            if (query_string !== undefined) {
                var reg = new RegExp('(^|&)' + name + '=([^&]*)(&|$)');
                return query_string.replace(reg, '');
            }
            return '';
        }

        $('.search-article').blur(function () {
            var v = $(this).val()
            if (v.length <= 0) {
                location.href = '?' + remove_arg_from_url('key_works')
                return false
            }
            location.href = updateQueryStringParameter(window.location.href, 'key_works', v.trim())
        });
    });
</script>
</body>

</html>