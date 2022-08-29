<?php
if (!defined('IN_CRONLITE')) exit();
/**
 * 自助开通分站
 **/
$is_defend = true;
disable_hook('homeLoaded', 'sendRedPack');
disable_hook('homeLoaded', 'testAdvert');
if ($islogin2 == 0) {
    @header('Content-Type: text/html; charset=UTF-8');
    exit("<script>alert('请先登录！');window.location.href='./user/login.php';</script>");
}
if ($islogin2 == 1 && $userrow['power'] > 0) {
    @header('Content-Type: text/html; charset=UTF-8');
    exit("<script>alert('您已开通过分站！');window.location.href='./';</script>");
} elseif ($conf['fenzhan_buy'] == 0) {
    @header('Content-Type: text/html; charset=UTF-8');
    exit("<script>alert('当前站点未开启自助开通分站功能！');window.location.href='./';</script>");
}
if ($is_fenzhan == true && $siterow['power'] == 2) {
    if ($siterow['ktfz_price'] > 0) $conf['fenzhan_price'] = $siterow['ktfz_price'];
    if ($conf['fenzhan_cost2'] <= 0) $conf['fenzhan_cost2'] = $conf['fenzhan_price2'];
    if ($siterow['ktfz_price2'] > 0 && $siterow['ktfz_price2'] >= $conf['fenzhan_cost2']) $conf['fenzhan_price2'] = $siterow['ktfz_price2'];
}
$addsalt = md5(mt_rand(0, 999) . time());
$_SESSION['addsalt'] = $addsalt;
$x = new hieroglyphy();
$addsalt_js = $x->hieroglyphyString($addsalt);

$kind = isset($_GET['kind']) ? $_GET['kind'] : 0;

if ($is_fenzhan == true && $siterow['power'] == 2 && !empty($siterow['ktfz_domain'])) {
    $domains = explode(',', $siterow['ktfz_domain']);
} else {
    $domains = explode(',', $conf['fenzhan_domain']);
}
$select = '';
foreach ($domains as $domain) {
    $select .= '<option value="' . $domain . '">' . $domain . '</option>';
}
if (empty($select)) showmsg('请先到后台分站设置，填写可选分站域名', 3);

?>
<!DOCTYPE html>
<html lang="zh" style="font-size: 50px;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,viewport-fit=cove">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>分站</title>
    <script src="/assets/official/js/font-size.js"> </script>
    <link rel="stylesheet" href="/assets/official/css/reset.css" />
    <link rel="stylesheet" href="/assets/official/css/common.css" />
    <link rel="stylesheet" href="/assets/official/css/substation/open-substation.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
        body {
            background: #f4f4f4;
        }
        .input-group-addon {
            background-color: #fff;
            border: 1px solid #ccc;
        }
        #container {
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
<div class="flex-top-black">
    <img class="flex-left-img" src="/assets/official/image/substation/icon，houtui@2x.png" alt="">
    <span>自助开通分站</span>
</div>
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
        <div class="content-open">
            <ul>
                <li>
                    <div class="open-btn">
                        <a href="#about" data-toggle="modal">分站详细介绍</a>
                        <a href="/?mod=substation">分站版本介绍</a>
                    </div>
                </li>
                <li>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">分站版本</div>
                            <select name="kind" class="form-control">
                                <option value="1" <?php if ($kind == 0){ ?>selected<?php } ?>>
                                    普及版(<?php echo $conf['fenzhan_price'] ?>元)
                                </option>
                                <option value="2" <?php if ($kind == 1){ ?>selected<?php } ?>>
                                    专业版(<?php echo $conf['fenzhan_price2'] ?>元)
                                </option>
                            </select>
                        </div>
                        <small style="color:red"><i class="fa fa-info-circle"></i>&nbsp;专业版可以无限免费搭建下级网站并且别人在你下级网站下单你还有提成赚，专业版的商品比普通版更便宜，利润更多！</small>
                    </div>
                </li>
                <li>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                二级域名
                            </div>
                            <div class="input-group" style="width: 100%;">
                                <input type="text" onkeyup="value=value.replace(/[^\w\.\/]/ig,'')" name="qz"
                                       class="form-control" required data-parsley-length="[2,8]"
                                       placeholder="输入你想要的二级前缀可用字母数字，例如:123 abc">
                                <span class="input-group-btn">
                                <button class="btn btn-default" onclick="$('[name=\'qz\']').val(Math.random().toString(36).substr(6))" type="button">随机</button>
                            </span>
                            </div>
                            <select name="domain" class="form-control"><?php echo $select ?></select>
                        </div>
                        <small style="color:red"><i class="fa fa-info-circle"></i>&nbsp;可用字母，数字建议为2-5字，不能有标点符号（尽量简短,便于推广宣传）！</small>
                    </div>
                </li>
                <li>
                <?php if (!$islogin2) { ?>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                管理账号
                            </div>
                            <input type="text" name="user" class="form-control" required placeholder="输入要注册的用户名">
                        </div>
                        <small style="color:red"><i class="fa fa-info-circle"></i>&nbsp;建议填写您的QQ号，方便记住！</small>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                管理密码
                            </div>
                            <input type="text" name="pwd" class="form-control" required placeholder="输入管理员密码">
                        </div>
                        <small style="color:red"><i class="fa fa-info-circle"></i>&nbsp;可以用字母或数字，密码不能低于6位！</small>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                绑定ＱＱ
                            </div>
                            <input type="number" name="qq" class="form-control" required
                                   data-parsley-length="[5,10]"
                                   placeholder="输入你的QQ号" value="">
                        </div>
                        <small style="color:red"><i class="fa fa-info-circle"></i>&nbsp;输入您的QQ号，方便联系和找回密码！</small>
                    </div>
                <?php } ?>
                </li>
                <li>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                网站名称
                            </div>
                            <input type="text" name="name" class="form-control" required
                                   data-parsley-length="[2,10]"
                                   placeholder="输入网站名称">
                        </div>
                        <small style="color:red"><i
                                    class="fa fa-info-circle"></i>&nbsp;例如：XX业务网，XX代刷网，XX百货商城，XX换成您想要的名字！</small>
                    </div>
                </li>
            </ul>
        </div>

        <div class="open-ok">
            <button class="ok-btn" id="submit_buy">点击立刻拥有分站</button>
            <div class="back-text">
                    <span><i><img src="/assets/official/image/substation/icon，zhaohuimima@2x.png" alt=""></i><a
                            href="/?mod=findpwd">找回密码</a></span>
                <span><i><img src="/assets/official/image/substation/icon，fanhuidenglu@2x.png" alt=""></i><a
                        href="/?mod=login">登陆分站</a></span>
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
<script src="<?php echo $cdnpublic; ?>jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="<?php echo $cdnpublic; ?>layer/2.3/layer.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>
    const hashsalt =<?php echo $addsalt_js?>;
</script>
<script src="/assets/official/js/regsite.js?v=<?php echo VERSION; ?>"></script>
</body>
</html>
