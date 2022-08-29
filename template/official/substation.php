<?php
if (!defined('IN_CRONLITE')) exit();
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
    <link rel="stylesheet" href="/assets/official/css/substation/substation.css"/>
    <link rel="stylesheet" href="/assets/official/css/common.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!--    <link rel="stylesheet" href="/assets/user/css/app.css"/>-->
    <style>
        body {
            background-color: rgb(244, 244, 244);
        }
        #container {
            width: 100%;
        }
        #container {
            width: 100%;
        }
    </style>
</head>
<body>
<div id="container" class="container">
    <div class="modal fade" align="left" id="about" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">详细介绍</h4>
                </div>
                <div class="modal-body">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                                       aria-expanded="false" class="collapsed">分站是怎么获取收益的？</a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse" style="height: 0px;"
                                 aria-expanded="false">
                                <div class="panel-body">
                                    其实很简单，你只需要把你的分站域名发给你的用户让他下单，一旦下单付款成功，你的账户就会增加你所赚差价的金额，自己是可以设置销售价格的哦！
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"
                                       class="collapsed" aria-expanded="false">赚到的钱在哪里？我如何得到？</a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" style="height: 0px;"
                                 aria-expanded="false">
                                <div class="panel-body">
                                    分站后台有完整的消费明细和余额信息，后台余额可供您在平台消费，满<?php echo $conf['tixian_min']; ?>
                                    元可以在后台提现到QQ钱包微信或者支付宝中。
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"
                                       class="collapsed" aria-expanded="false">需要我自己供货吗？哪来的商品货源？</a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" style="height: 0px;"
                                 aria-expanded="false">
                                <div class="panel-body">
                                    所有商品全部由主站提供，您无需当心货源问题，所有订单由我们来处理，如果网站没有您想要的商品可联系主站客服添加即可！
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseFourth"
                                       class="collapsed" aria-expanded="false">这个和卡盟一样吗？有什么区别？</a>
                                </h4>
                            </div>
                            <div id="collapseFourth" class="panel-collapse collapse" style="height: 0px;"
                                 aria-expanded="false">
                                <div class="panel-body">
                                    完全不同，销售提成最高享受商品售价的30%，货源更精，无需注册,无需预存，在线支付，更简单快捷！
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive"
                                       class="collapsed" aria-expanded="false">可以自己上架商品吗？可以修改售价吗？</a>
                                </h4>
                            </div>
                            <div id="collapseFive" class="panel-collapse collapse" style="height: 0px;"
                                 aria-expanded="false">
                                <div class="panel-body">
                                    所有分站暂时都不支持自己上架商品，但可以修改销售价格，我们会在这方面后期做出相对于的更新服务！
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseSix"
                                       class="collapsed" aria-expanded="false">那么多代刷网有分站，为什么选择你们呢？</a>
                                </h4>
                            </div>
                            <div id="collapseSix" class="panel-collapse collapse" style="height: 0px;"
                                 aria-expanded="false">
                                <div class="panel-body">
                                    全网最专业的代刷系统，商品齐全、货源稳定、价格低廉、售后保障。实体工作室运营，拥有丰富的人脉和资源，我们的货源全部精挑细选全网性价比最高的，实时掌握代刷市场的动态，加入我们，只要你坚持，你不用担心不赚钱，不用担心货源不好，更不用担心我们跑路，我们即使不敢保证你月入上万，在网上赚个零花钱绝对没问题！
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="content-box">
            <div class="content-box-paddin">
                <div class="content-top-banner">
                    <div class="banner-btn">
                        <span>￥<?php echo $conf['fenzhan_price']; ?>元普及版</span>
                        <span>￥<?php echo $conf['fenzhan_price2']; ?>元专业版</span>
                    </div>
                </div>
                <div class="content-middle" id="iphNotie">
                    <div class="middle-text">
                        <div class="text-header">
                            <p>版本功能介绍</p>
                            <span>普及/专业</span>
                        </div>
                        <div class="text-ul">
                            <ul>
                                <li>
                                    <span>专属代刷平台</span>
                                    <span>
                                            <img src="/assets/official/image/substation/fenzanimg1.png" alt="">
                                            <img src="/assets/official/image/substation/fenzanimg1.png" alt="">
                                        </span>
                                </li>
                                <li>
                                    <span>三种在线支付接口</span>
                                    <span>
                                            <img src="/assets/official/image/substation/fenzanimg1.png" alt="">
                                            <img src="/assets/official/image/substation/fenzanimg1.png" alt="">
                                        </span>
                                </li>
                                <li>
                                    <span>专属网站域名</span>
                                    <span>
                                            <img src="/assets/official/image/substation/fenzanimg1.png" alt="">
                                            <img src="/assets/official/image/substation/fenzanimg1.png" alt="">
                                        </span>
                                </li>
                                <li>
                                    <span>赚取用户提成</span>
                                    <span>
                                            <img src="/assets/official/image/substation/fenzanimg1.png" alt="">
                                            <img src="/assets/official/image/substation/fenzanimg1.png" alt="">
                                        </span>
                                </li>
                                <li>
                                    <span>赚取下级分站提成</span>
                                    <span>
                                            <img src="/assets/official/image/substation/fenzanimg.png" alt="">
                                            <img src="/assets/official/image/substation/fenzanimg1.png" alt="">
                                        </span>
                                </li>
                                <li>
                                    <span>设置商品价格</span>
                                    <span>
                                            <img src="/assets/official/image/substation/fenzanimg1.png" alt="">
                                            <img src="/assets/official/image/substation/fenzanimg1.png" alt="">
                                        </span>
                                </li>
                                <li>
                                    <span>设置下级分站商品价格</span>
                                    <span>
                                            <img src="/assets/official/image/substation/fenzanimg.png" alt="">
                                            <img src="/assets/official/image/substation/fenzanimg1.png" alt="">
                                        </span>
                                </li>
                                <li>
                                    <span>搭建下级分站</span>
                                    <span>
                                            <img src="/assets/official/image/substation/fenzanimg.png" alt="">
                                            <img src="/assets/official/image/substation/fenzanimg1.png" alt="">
                                        </span>
                                </li>
                                <li>
                                    <span>赠送专属精致APP</span>
                                    <span>
                                            <img src="/assets/official/image/substation/fenzanimg.png" alt="">
                                            <img src="/assets/official/image/substation/fenzanimg1.png" alt="">
                                        </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="content-foot-btn" id="iphFoot">
                    <ul>
<!--                        <li>-->
<!--                            <p class="yellow"><a class="yellow" href="#about" data-toggle="modal">分站详情介绍</a></p>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <div class="foot-span">-->
<!--                                <span>无聊时可以赚点零钱花</span>-->
<!--                                <span>无聊时可以赚点零钱花</span>-->
<!--                                <span>无聊时可以赚点零钱花</span>-->
<!--                                <span>无聊时可以赚点零钱花</span>-->
<!--                            </div>-->
<!---->
<!--                        </li>-->
                        <li>
                            <?php if ($islogin2 == 1 && $userrow['power'] > 0): ?>
                                <p style="color: green;">你已开通分站</p>
                            <?php else: ?>
                                <p>普及/专业版两种分站供你选择</p>
                            <?php endif; ?>
                        </li>
                        <li>
                            <div class="substation-btn">
                                <?php if ($islogin2 == 1 && $userrow['power'] > 0): ?>
                                <a href="/?mod=adminSubstation">分站管理</a>
                                <?php else: ?>
                                <a href="/?mod=openSubstation">开通分站</a>
                                <?php endif; ?>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
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
                        <a href="?mod=substation">
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
<script src="/assets/jquery/2.1.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>