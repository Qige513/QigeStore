<?php
if (!defined('IN_CRONLITE')) exit();
$is_defend = true;
if ($islogin2 != 1) {
    exit("<script>window.location.href='/?mod=login';</script>");
}
if (!Template::isMobile()) {
    header('Location: /user/qiandao.php');
    exit;
}
disable_hook('homeLoaded', 'sendRedPack');
disable_hook('homeLoaded', 'testAdvert');
if (!isset($conf['qiandao_reward']) || empty($conf['qiandao_reward'])) {
    showmsg('当前站点未开启签到功能', 3);
}
// 保存用户签到会话
$_SESSION['isqiandao'] = $userrow['zid'];

$day = date('Y-m-d');
$last_day = date('Y-m-d', strtotime('-1 day'));
// 获取用户今天累计签到次数
$continue = $DB->get('qiandao', 'continue', ['zid' => $userrow['zid'], 'date' => $day, 'ORDER' => ['id' => 'DESC']]);
$isSign = false;
if (!empty($continue)) {
    $isSign = true; // 是否签到
} else {
    // 获取用户累计签到次数
    $continue = $DB->get('qiandao', 'continue', ['AND' => ['zid' => $userrow['zid'], 'date' => $last_day], 'ORDER' => ['id' => 'DESC']]);
    if (empty($continue)) {
        $continue = 0;
    }
}
// 获取所有用户最近 10 条签到数据
$sign_list = $DB->select('qiandao(a)', ['[><]site(b)' => ['a.zid' => 'zid']], ['a.zid', 'a.qq', 'a.continue', 'a.reward', 'a.time', 'b.qq_head_img_url'], ['ORDER' => ['a.id' => 'DESC'], 'GROUP' => 'a.zid', 'LIMIT' => 10]);
$qqRow = []; // 前 5 名的签到用户
foreach ($sign_list as $v) {
    if (count($qqRow) < 5) {
        if (!empty($v['qq'])) {
            $qqRow[] = 'http://q4.qlogo.cn/headimg_dl?dst_uin=' . $v['qq'] . '&spec=100';
        } elseif (!empty($v['qq_head_img_url'])) {
            $qqRow[] = $v['qq_head_img_url'];
        } else {
            $qqRow[] = '/assets/img/user.png';
        }
    }
}
// 防红短链接生成
$url = 'http://' . $userrow['domain'] . '/';
if ($conf['fanghong_api'] > 0) {
    $min_url = fanghongdwz($url);
    if (strpos($min_url, '/') === false) {
        $min_url = $url;
    }
} else {
    $min_url = $url;
}

// 连续签到时间集合
$isSignDayArr = $DB->select('qiandao', 'date', ['zid' => $userrow['zid'], 'date[<>]' => [date('Y-m-01'), date('Y-m-d')], 'ORDER' => ['id' => 'DESC'], 'LIMIT' => 31]);
foreach ($isSignDayArr as &$v) {
    $v = strtotime($v);
}
$isSignDayArr = json_encode($isSignDayArr);
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,viewport-fit=cove">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>分站</title>
    <link rel="stylesheet" href="/assets/official/css/reset.css"/>
    <link rel="stylesheet" href="/assets/official/css/substation/admin-substation.css"/>
    <link rel="stylesheet" href="/assets/official/css/common.css"/>
    <link rel="stylesheet" href="/assets/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="//lib.baomitu.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/user/css/app.css"/>
    <link rel="stylesheet" href="/assets/official/css/qian_dao/public.css"/>
    <link rel="stylesheet" href="/assets/official/css/qian_dao/signin.css"/>
    <style>
        .flex-top-black {
            height: 50px;
        }

        .flex-top-black span {
            line-height: 51px;
            font-size: 16px;
        }

        .flex-top-black .flex-left-img {
            width: 30px;
            height: 30px;
            font-size: 16px;
            top: 11px;
            left: 20px;
            bottom: 18px;
        }

        .flex-warp {
            margin-top: 50px;
        }

        .flex-js {
            left: 0;
            margin: 0;
            width: 100%;
        }

        .img-circle {
            width: 50px;
        }

        .Calendar {
            margin: 0.5rem auto;
            width: 94%;
        }

        .text-center {
            border: 1px solid #e7e7e7;
        }

        .flex-top-black .share-icon {
            position: absolute;
            right: 18px;
            top: 6px;
        }

        .flex-top-black a {
            color: #fff;
        }

        .flex-top-black i {
            font-size: 27px;
        }

        #rewards {
            padding: 0 5px;
        }
    </style>
</head>

<body>
<!--复制广告词分享开始-->
<div class="modal fade col-xs-12 " align="left" id="share" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <br>
    <br>
    <br>
    <div class="modal-dialog animation-fadeInQuick2">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close " data-dismiss="modal">
                  <span aria-hidden="true">
                    <i class="fa fa-times-circle"></i>
                  </span>
                    <span class="sr-only">Close</span></button>
                将网站分享给好友
            </div>
            <ul>
                <li class="list-group-item">
                    <div class="input-group">
                        <div class="input-group-addon">广告语</div>
                        <label for="fxggc"></label>
                        <textarea id="fxggc" class="form-control" rows="5" cols="30" readonly="" unselectable="on">
网站 <?php echo $conf['sitename']; ?>

每天签到奖励现金哦！
快来和我一起领取吧！
网址:<?php echo $min_url; ?>

每天免费领取100名片赞
建议收藏网站可天天领取
                    </textarea>
                    </div>
                </li>
                <li class="list-group-item">
                    <button data-clipboard-target="#fxggc" class="btn btn-sm btn-block btn-info share-text">点击一键复制分享语
                    </button>
                </li>
                <li class="list-group-item">将网站分享给你的好友，有机会获取10W名片赞或者永久超级会员哟！</li>
            </ul>
        </div>
    </div>
</div>
<!--复制广告词分享结束-->
<div class="flex-top-black">
    <img class="flex-left-img" src="/assets/official/image/substation/icon，houtui@2x.png" alt="">
    <span class="share-icon">
        <a href="#share" data-toggle="modal" title="点击分享本站"><i class="fa fa-external-link share"></i></a>
    </span>
</div>

<div class="top flex flex-align-end flex-pack-center flex-warp">
    <div class="out-1 flex flex-align-center flex-pack-center" id="signIn">
        <div class="out-2 flex flex-align-center flex-pack-center">
            <div class="signBtn">
                <strong id="sign-txt"><?php echo $isSign == true ? '已签到' : '签到'; ?></strong>
                <span>连续<em id="sign_count"><?php echo $continue; ?></em>天</span>
            </div>
        </div>
    </div>
    <div class="tips"><?php echo $isSign == true ? '今天已签到，' : ''; ?>累计获得<span id="rewards">0.00</span>元</div>
</div>
<div class="Calendar">
    <div id="toyear" class="flex flex-pack-center">
        <div id="idCalendarPre">&lt;</div>
        <div class="year-month">
            <span id="idCalendarYear">2020</span>年<span id="idCalendarMonth">5</span>月
        </div>
        <div id="idCalendarNext">&gt;</div>
    </div>
    <table>
        <thead>
        <tr class="tou">
            <td>日</td>
            <td>一</td>
            <td>二</td>
            <td>三</td>
            <td>四</td>
            <td>五</td>
            <td>六</td>
        </tr>
        </thead>
        <tbody id="idCalendar"></tbody>
    </table>

    <small style="display: block;text-align: center;">只标注本月签到的日期</small>

</div>
<div class="row">
    <div class="col-sm-12 col-md-8 col-lg-6 center-block" style="margin: 0 3%;">
        <div class="panel panel-default text-center">
            <div class="panel-heading"><h3 class="panel-title">最新签到榜</h3></div>
            <div class="panel-body">
                <div class="avatar-group">
                    <?php foreach ($qqRow as $row): ?>
                        <img alt="img-circle" src="<?php echo $row; ?>"
                             class="img-rounded img-circle img-thumbnail">
                    <?php endforeach; ?>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="font-size: 13px;" class="text-center">
                        <i class="fa fa-user-circle-o"></i> 今日签到<br><span id="count1"></span>人
                    </th>
                    <th style="font-size: 13px;" class="text-center">
                        <i class="fa fa-user-circle"></i> 昨日签到<br><span id="count2"></span>人
                    </th>
                    <th style="font-size: 13px;" class="text-center">
                        <i class="fa fa-pie-chart"></i> 累计签到<br><span id="count3"></span>人
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php if (is_array($sign_list)): if (count($sign_list) == 0): ?>
                    <tr>
                        <th colspan="3" style="font-size: 13px;">
                            <span style="display: block;text-align: center;">暂无数据</span>
                        </th>
                    </tr>
                <?php else: foreach ($sign_list as $row): ?>
                    <tr>
                        <th colspan="3" style="font-size: 13px;">
                            <span class="pull-right label label-info" style="background-color: #1a99f2;"><small>连续<?php echo $row['continue']; ?>天</small></span>
                            <i class="fa fa-user"></i> ZID:<?php echo $row['zid']; ?>
                            在 <?php echo date('H:i', strtotime($row['time'])); ?> 签到获得 <?php echo $row['reward']; ?> 元
                        </th>
                    </tr>
                <?php endforeach; ?>
                    <tr>
                        <th colspan="3" style="font-size: 13px;">
                            <span style="display: block;text-align: center;">仅展示前10条数据</span>
                        </th>
                    </tr>
                <?php endif; endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="/assets/jquery/2.1.4/jquery.min.js"></script>
<script src="/assets/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo $cdnpublic ?>layer/2.3/layer.js"></script>
<script src="<?php echo $cdnpublic ?>clipboard.js/1.7.1/clipboard.min.js"></script>
<script type="text/javascript" src="/assets/official/js/rili.js"></script>
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

        let isSign = <?php echo $isSign ? 'true' : 'false'; ?>;
        const _continue = parseInt('<?php echo $continue; ?>'); // 连续签到天数
        let myDay = JSON.parse('<?php echo $isSignDayArr; ?>'); //已签到的数组

        const cale = new Calendar("idCalendar", {
            qdDay: myDay,
            onToday: function (o) {
                o.className = "onToday";
            },
            onFinish: function () {
                $("sign_count").text(_continue); //已签到次数
                $$("idCalendarYear").innerHTML = this.Year;
                $$("idCalendarMonth").innerHTML = this.Month; //表头年份
            }
        });

        $$("idCalendarPre").onclick = function () {
            cale.PreMonth();
        }

        $$("idCalendarNext").onclick = function () {
            cale.NextMonth();
        }
        const clipboard = new Clipboard('.share-text');

        clipboard.on('success', function () {
            layer.msg("复制成功,快去分享给朋友一起来领免费名片赞吧！", {icon: 1});
        });

        clipboard.on('error', function () {
            layer.msg("复制失败，请长按链接后手动复制", {icon: 2});
        });

        // 点击签到
        $("#signIn").click(function () {
            if (!isSign) {
                let res = cale.SignIn();
                layer.load(2);
                $.ajax({
                    type: "get",
                    url: "/user/ajax.php?act=qiandao",
                    dataType: "json",
                    success: function (data) {
                        layer.closeAll('loading');
                        if (res === 1 && data.code === 0) {
                            $("sign-txt").text('已签到');
                            const sign_count_dom = $("sign_count");
                            let sign_count = parseInt(sign_count_dom.text());
                            sign_count_dom.text(sign_count++);
                            isSign = true;
                            layer.alert(data.msg, {icon: 6}, function () {
                                window.location.reload();
                            });
                        } else if (res === 2) {
                            $("sign-txt").text('已签到');
                            layer.alert('今天已经签到了');
                        } else {
                            layer.alert(data.msg, {icon: 5});
                        }
                    },
                    error: function () {
                        layer.closeAll('loading');
                        layer.alert('签到失败，请稍后刷新重试');
                    }
                });
            } else {
                layer.alert('今天已经签到了');
            }
        });
        $.ajax({
            type: "GET",
            url: "/user/ajax.php?act=qdcount",
            dataType: 'json',
            success: function (data) {
                $('#count1').html(data['count1']);
                $('#count2').html(data['count2']);
                $('#count3').html(data['count3']);
                $('#rewards').text(data['rewardcount'].toFixed(2));
            }
        });
    });
</script>
</body>

</html>
