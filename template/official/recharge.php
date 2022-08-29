<?php
if (!defined('IN_CRONLITE')) exit();
if ($islogin2 != 1) {
    exit('<script>window.location.href=\'/?mod=login\';</script>');
}
disable_hook('homeLoaded', 'sendRedPack');
disable_hook('homeLoaded', 'testAdvert');
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,viewport-fit=cove">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>分站</title>
    <script src="/assets/official/js/font-size.js"></script>
    <link rel="stylesheet" href="/assets/official/css/reset.css"/>
    <link rel="stylesheet" href="/assets/official/css/substation/admin-substation.css"/>
    <link rel="stylesheet" href="/assets/official/css/common.css"/>
    <link rel="stylesheet" href="/assets/twitter-bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/assets/user/css/app.css"/>
    <style>
        .content-admin .admin-nav img {
            margin-bottom: 4px;
        }

        .content-admin .admin-nav p {
            margin: 0;
        }

        .wrapper {
            margin-top: .5rem;
        }

        .panel-default {
            border-radius: 5px;
        }

        .selectPayMoney {
            margin-bottom: 15px;
        }

        .selectPayMoney a {
            width: 25%;
            margin-right: 3%;
            margin-left: 3%;
        }

        .btn-outline-success {
            color: #2dce89;
            border-color: #2dce89;
            background-color: transparent;
            background-image: none;
        }

        .btn-outline-success:hover {
            color: #fff;
            border-color: #2dce89;
            background-color: #2dce89;
        }

        .btn-outline-success:focus,
        .btn-outline-success.focus {
            box-shadow: 0 0 0 0 rgba(45, 206, 137, .5);
        }

        .btn-outline-success.disabled,
        .btn-outline-success:disabled {
            color: #2dce89;
            background-color: transparent;
        }

        .btn-outline-success:not(:disabled):not(.disabled):active,
        .btn-outline-success:not(:disabled):not(.disabled).active,
        .show > .btn-outline-success.dropdown-toggle {
            color: #fff;
            border-color: #2dce89;
            background-color: #2dce89;
        }

        .btn-outline-success:not(:disabled):not(.disabled):active:focus,
        .btn-outline-success:not(:disabled):not(.disabled).active:focus,
        .show > .btn-outline-success.dropdown-toggle:focus {
            box-shadow: 0 0 0 0 rgba(45, 206, 137, .5);
        }

        .flex-left-img {
            cursor: pointer;
        }
    </style>
</head>

<body>
<div class="flex-top-black">
    <img class="flex-left-img" src="/assets/official/image/substation/icon，houtui@2x.png" alt="back">
    <span>余额充值</span>
</div>
<div class="wrapper container" id="container">
    <div class="wrapper">
        <div class="col-sm-12 col-md-8 col-lg-8 col-lg-offset-2">
            <div class="panel panel-default">
                <div class="modal-body text-center">
                    <b>我当前的账户余额：<span style="font-size:16px; color:#FF6133;"><?php echo $userrow['rmb']; ?></span> 元</b>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="selectPayMoney">
                                <a href="javascript:" data-money="10"
                                   class="btn btn-outline-success select-pay-money"
                                   style="margin: ">￥10</a>
                                <a href="javascript:" data-money="30"
                                   class="btn btn-outline-success select-pay-money">￥30</a>
                                <a href="javascript:" data-money="50"
                                   class="btn btn-outline-success select-pay-money">￥50</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="selectPayMoney">
                                <a href="javascript:" data-money="100"
                                   class="btn btn-outline-success select-pay-money"
                                   style="margin: ">￥100</a>
                                <a href="javascript:" data-money="200"
                                   class="btn btn-outline-success select-pay-money">￥200</a>
                                <a href="javascript:" data-money="300"
                                   class="btn btn-outline-success select-pay-money">￥300</a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin: 0 5%;">
                        <input type="number" class="form-control" name="value" autocomplete="off"
                               placeholder="请填写自定义充值金额">
                    </div>
                    <br>
                    <div class="form-group">
                        <?php if ($conf['alipay_api']): ?>
                            <button type="submit" class="btn btn-default" id="buy_ali_pay">
                                <img alt="alipay_logo" src="/assets/icon/alipay.ico" style="width: 16px;height: 16px;"
                                     class="logo">
                                支付宝
                            </button>
                        <?php endif;
                        if ($conf['qqpay_api']): ?>
                            <button type="submit" class="btn btn-default" id="buy_qq_pay">
                                <img alt="qqpay_logo" src="/assets/icon/qqpay.ico" style="width: 16px;height: 16px;"
                                     class="logo">
                                QQ钱包
                            </button>
                        <?php endif;
                        if ($conf['wxpay_api']): ?>
                            <button type="submit" class="btn btn-default" id="buy_wx_pay">
                                <img alt="wechat_logo" src="/assets/icon/wechat.ico" style="width: 16px;height: 16px;"
                                     class="logo">
                                微信支付
                            </button>
                        <?php endif; ?>
                    </div>
                    <?php if (!empty($conf['recharge_wx_min']) || !empty($conf['recharge_ali_min']) || !empty($conf['recharge_qq_min'])): ?>
                        <div class="alert alert-info" style="text-align: left;">
                            <?php
                            if ($conf['recharge_ali_min'] > 0) {
                                echo '支付宝：最低充值金额：￥' . $conf['recharge_ali_min'] . ' 起<br>';
                            }
                            if ($conf['recharge_qq_min'] > 0) {
                                echo 'QQ钱包：最低充值金额：￥' . $conf['recharge_qq_min'] . ' 起<br>';
                            }
                            if ($conf['recharge_wx_min'] > 0) {
                                echo '微信支付：最低充值金额：￥' . $conf['recharge_wx_min'] . ' 起<br>';
                            }
                            ?>
                        </div>
                    <?php endif; ?>
                    <div class="alert alert-warning">
                        <small style="color:red;font-weight: bold;">系统提示：<br>
                            本充值仅限于网站消费下单使用，谨防上当受骗！！！</small>
                    </div>
                    <hr>
                    <small style="color:#999;">付款后自动充值，刷新此页面即可查看余额。</small>
                </div>
            </div>
        </div>
    </div>
    <script src="/assets/jquery/2.1.4/jquery.min.js"></script>
    <script src="/assets/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="/assets/layer/2.3/layer.js"></script>
    <script>
        const hashsalt = <?php echo $addsalt_js; ?>;
        const recharge_conf = {
            'wx_min': <?php echo empty($conf['recharge_wx_min']) ? 0 : htmlspecialchars($conf['recharge_wx_min']); ?>,
            'ali_min': <?php echo empty($conf['recharge_ali_min']) ? 0 : htmlspecialchars($conf['recharge_ali_min']); ?>,
            'qq_min': <?php echo empty($conf['recharge_qq_min']) ? 0 : htmlspecialchars($conf['recharge_qq_min']); ?>,
        };
    </script>
    <script>
        function StandardPost(url, args) {
            const form = $("<form method='post'></form>");
            form.attr({"action": url});
            for (let arg in args) {
                if (args.hasOwnProperty(arg)) {
                    const input = $("<input type='hidden'>");
                    input.attr({"name": arg});
                    input.val(args[arg]);
                    form.append(input);
                }
            }
            form.submit();
        }

        function doPay(type) {
            let value = $('input[name=value]').val();
            if (!value) {
                layer.alert('充值金额不能为空');
                return false;
            }
            value = parseFloat(value);
            if (value <= 0) {
                layer.alert('充值金额不能小于等于 0.00');
                return false;
            }
            if (type === 'wxpay' && value < recharge_conf['wx_min']) {
                layer.alert('最低充值金额为￥' + recharge_conf['wx_min'] + ' 元');
                return false;
            }
            if (type === 'alipay' && value < recharge_conf['ali_min']) {
                layer.alert('最低充值金额为￥' + recharge_conf['ali_min'] + ' 元');
                return false;
            }
            if (type === 'qqpay' && value < recharge_conf['qq_min']) {
                layer.alert('最低充值金额为￥' + recharge_conf['qq_min'] + ' 元');
                return false;
            }
            layer.load(2);
            $.ajax({
                url: '/user/ajax.php',
                data: {
                    'act': 'recharge',
                    'type': type,
                    'value': value,
                },
                dataType: 'json',
                success(res) {
                    layer.closeAll('loading');
                    if (res['code'] === 0) {
                        location.href = '/other/submit.php?type=' + type + '&orderid=' + res['trade_no'];
                    } else {
                        layer.alert(res['msg']);
                    }
                },
                error() {
                    layer.closeAll('loading');
                    layer.alert('系统异常，请联系相关人员处理');
                }
            });
        }

        $('.select-pay-money').click(function () {
            const v = $(this).data('money');
            $('input[name=value]').val(v);
        });

        $("#buy_ali_pay").click(function () {
            doPay('alipay');
        });

        $("#buy_qq_pay").click(function () {
            doPay('qqpay');
        });

        $("#buy_wx_pay").click(function () {
            doPay('wxpay');
        });

        $(document).ready(function () {
            $('.flex-left-img').click(function () {
                window.history.go(-1);
            });
        });
    </script>
</body>

</html>