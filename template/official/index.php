<?php
if (!defined('IN_CRONLITE')) exit();
?>
<!DOCTYPE html>
<html lang="zh" style="font-size: 50px;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,viewport-fit=cove">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php if($seo_info[0]['seo_title']){ echo $seo_info[0]['seo_title'];}else{   echo $conf['sitename'].'-'.$conf['title'];} ?></title>
    <?php
    if($seo_info[0]['seo_keywords']){
        echo '<meta name="keywords" content="'.$seo_info[0]['seo_keywords'].'">';
    }else{
        echo '<meta name="keywords" content="'.$conf['keywords'].'">';
    }
    ?>
    <?php
    if($seo_info[0]['seo_description']){
        echo '<meta name="description" content="'.$seo_info[0]['seo_description'].'">';
    }else{
        echo '<meta name="description" content="'.$conf['description'].'">';
    }
    ?>
    <script src="/assets/official/js/font-size.js"></script>
    <link rel="stylesheet" href="/assets/official/css/reset.css"/>
    <link rel="stylesheet" href="/assets/official/css/index.css"/>
    <link rel="stylesheet" href="/assets/official/css/common.css"/>
    <link rel="stylesheet" href="<?php echo $cdnpublic; ?>twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $cdnserver ?>assets/css/common.css?ver=<?php echo VERSION ?>">
    <style>
        .input-group-addon {
            background-color: #fff;
            border: 1px solid #ccc;
        }
        @media only screen and (min-width: 768px) {
            .self-container {
                background: url('/assets/official/image/beijing@2x.png') no-repeat;
                background-size: contain;
            }
            .self-container .content {
                background-color: unset;
            }
        }
    </style>
</head>

<body style="background-color: #f4f4f4;">
<div id="container" class="self-container">
    <div class="content">
        <div class="content-top">
            <!--            <div class="search">-->
            <!--                <input type="text" placeholder="?????????????????????????????????????????????????????????">-->
            <!--                <i></i>-->
            <!--            </div>-->
            <?php if($conf['logo_status'] == 1){?>
                <div style="background:white;height:100px;text-align:center;">
                    <img src="/assets/img/logo.png" alt="logo" style="max-width:80px;max-height:80px;margin-top:10px;">
                </div>
            <?php } ?>
            <div class="banner">
                <img src="/assets/official/image/Banner@2x.png" alt="">
            </div>

        </div>
        <div class="content-middle">
            <div class="middle" id="ipho">
                <?php
                if (isset($conf['template_config_official']) && !empty($conf['template_config_official'])) {
                    $alert = json_decode($conf['template_config_official'], true);
                }?>
                <?php if (isset($alert['alert']) && !empty($alert['alert'])): ?>
                    <div style="background-color: #ffffff;padding: 10px;border-radius: 3px;">
                        <?php echo $alert['alert']; ?>
                    </div>
                <? else: ?>
                    <div class="notice">
                        <ul id="iphNotie" style="line-height: 0.35rem">
                            <!--                        <li id="noticBox">-->
                            <!--                            <i class="rightI"></i>-->
                            <!--                            ??????-->
                            <!--                            <i class="rightR"></i>-->
                            <!--                        </li>-->
                            <!--                        -->
                            <li>
                                <i class="rightN">1</i>
                                <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo$conf['kfqq']?>&site=qq&menu=yes"> <span>??????QQ??????</span></a>
                            </li>
                            <li>
                                <i class="rightN">2</i>
                                <a href="/?mod=substation" style="text-decoration: none;"><span>???????????????????????????0???????????????????????????????????????</span></a>
                            </li>
                            <li>
                                <i class="rightN">3</i>
                                <span>????????????????????????????????????????????????????????????????????????</span>
                            </li>
                            <li>
                                <i class="rightN">4</i>
                                <span>?????????????????????????????? ??????????????????</span><span class="rightN" style="background-color: red;padding: 2px 4px;text-align: center;margin-top: -2px;">???</span>
                            </li>
                            <li>
                                <i class="rightN">5</i>
                                <span>???????????????????????????,???????????????,????????????????????? </span><span class="rightN" style="background-color: red;padding: 2px 4px;text-align: center;margin-top: -2px;">???</span>
                            </li>
                        </ul>
                    </div>
                <?php endif; ?>
                <div class="select">
                    <ul class="select-top create-order-box">
                        <div class="tab-pane active" id="shop" style="margin-top: 10px;">
                            <?php include TEMPLATE_ROOT . 'default/shop.official.php'; ?>
                        </div>
                    </ul>
                    <ul class="select-top search-order-box" style="display: none;">
                        <!--????????????-->
                        <div class="tab-pane" id="search" style="margin-top: 10px;">
                            <div class="col-xs-12 well well-sm animation-pullUp"
                                 <?php if (empty($conf['gg_search'])){ ?>style="display:none;"<?php } ?>><?php echo $conf['gg_search'] ?></div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <select class="form-control" id="searchtype"
                                                style="padding: 6px 4px;width:90px">
                                            <option value="0">????????????</option>
                                            <option value="1">?????????</option>
                                        </select>
                                    </div>
                                    <input type="text" name="qq" id="qq3" value="<?php echo $qq ?>" class="form-control"
                                           placeholder="????????????????????????????????????????????????????????????"
                                           onkeydown="if(event.keyCode==13){submit_query.click()}" required/>
                                    <span class="input-group-btn"><a href="#cxsm" data-toggle="modal"
                                                                     class="btn btn-warning"><i
                                                    class="glyphicon glyphicon-exclamation-sign"></i></a></span>
                                </div>
                            </div>
                            <input type="submit" id="submit_query" class="btn btn-primary btn-block" value="????????????">
                            <div id="result2" class="form-group" style="display:none;">
                                <center><small><font color="#ff0000">??????????????????????????????</font></small></center>
                                <div class="table-responsive">
                                    <table class="table table-vcenter table-condensed table-striped">
                                        <thead>
                                        <tr>
                                            <th>????????????</th>
                                            <th>????????????</th>
                                            <th>??????</th>
                                            <th class="hidden-xs">????????????</th>
                                            <th>??????</th>
                                            <th>??????</th>
                                        </tr>
                                        </thead>
                                        <tbody id="list">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br/>
                        </div>
                    </ul>
                    <ul class="select-foot" id="iphFoot">
                        <li class="search-order">
                            <span><i class="left zd"></i>??????</span>
                            <span>??????<i class="right"></i></span>
                        </li>
                        <!--                        <li>-->
                        <!--                            <span><i class="left cj"></i>??????</span>-->
                        <!--                            <span>??????<i class="right"></i></span>-->
                        <!--                        </li>-->
                        <!--                        <li>-->
                        <!--                            <span><i class="left tg"></i>??????</span>-->
                        <!--                            <span>??????<i class="right"></i></span>-->
                        <!--                        </li>-->
                        <!--                        <li>-->
                        <!--                            <span><i class="left yw"></i>??????</span>-->
                        <!--                            <span>??????<i class="right"></i></span>-->
                        <!--                        </li>-->
                    </ul>
                    <!--????????????????????????-->
                    <!--                    <ul class="select-number">-->
                    <!--                        <li>-->
                    <!--                            <span>????????????</span>-->
                    <!--                            <span id="order_count">?????????...</span>-->
                    <!--                        </li>-->
                    <!--                        <li>|</li>-->
                    <!--                        <li>-->
                    <!--                            <span>????????????</span>-->
                    <!--                            <span id="today_order_count">?????????...</span>-->
                    <!--                        </li>-->
                    <!--                        <li>|</li>-->
                    <!--                        <li>-->
                    <!--                            <span>????????????</span>-->
                    <!--                            <span id="money_count">?????????...</span>-->
                    <!--                        </li>-->
                    <!--                        <li>|</li>-->
                    <!--                        <li>-->
                    <!--                            <span>????????????</span>-->
                    <!--                            <span id="today_money_count">?????????...</span>-->
                    <!--                        </li>-->
                    <!--                    </ul>-->
                    <!--????????????????????????-->
                </div>
                <link rel="stylesheet" href="/assets/official/css/activity/activity.css">
                <div class="content-activity" style="margin-top: 10px;">
                    <div class="activity-banner" style="width: 60%;margin: 10px auto;display: none;"></div>
                    <div class="activety-input" style="display: none">
                        <i></i>
                        <input type="text" placeholder="???????????????????????????????????????"
                               value="<?php echo isset($_GET['key_works']) ? htmlspecialchars($_GET['key_works']) : ''; ?>"
                               class="search-article">
                    </div>
                    <div class="activety-ul">
                        <span class="span-cative">????????????</span>
                    </div>
                    <div class="activety-li">
                        <ul>
                            <?php
                            $where = [
                                'status' => 1,
                                'ORDER' => ['id' => 'DESC'],
                                'LIMIT' => 5
                            ];
                            if (isset($_GET['key_works']) && !empty($_GET['key_works'])) {
                                $where['title[~]'] = daddslashes(htmlspecialchars(trim($_GET['key_works'])));
                            }
                            $contents = $DB->select('article_list', [
                                'title', 'content', 'id', 'createTime'
                            ], $where);
                            if (empty($contents)) { ?>
                                <li>
                                    <div class="li-content">
                                        <div class="li-div col">
                                            <span style="display: block;text-align: center;padding-top: 20px;">????????????</span>
                                        </div>
                                    </div>
                                </li>
                            <?php } else {
                                foreach ($contents as $content) {
                                    $info = strip_tags($content['content']);
                                    if (mb_strlen($info) > 256)
                                        $info = mb_substr($info, 0, 90) . '......';
                                    ?>
                                    <li>
                                        <a target="_blank" href="/route.php?s=index/<?php echo $content['id'] . '.html'; ?>">
                                            <div class="li-content">
                                                <!--                                <img src="" alt="" class="li-img col">-->
                                                <div class="li-div col">
                                                    <span><?php echo strip_tags($content['title']); ?></span>
                                                </div>

                                                <p class="li-p col"><?php echo substr($content['createTime'], 0, 10); ?></p>
                                            </div>
                                        </a>
                                    </li>
                                <?php }
                            } ?>
                        </ul>
                        <div class="activety-bottom">
                            <a href="/route.php?s=index/zy/" title="?????????" target="_blank">
                                <img src="/assets/official/image/icon,chakan@2x.png" alt="">
                            </a>
                        </div>
                    </div>
                </div>

                <div class="success-zz" id="success-zz">
                    <div class="success-box">
                        <p>??????????????????</p>
                        <div class="success-content">
                            <div class="success-content-text">
                                ???8888
                            </div>
                            <div class="success-content-img">
                                <ul>
                                    <li><img src="/assets/official/image/icon???zhifubao@2x.png" alt=""><span>?????????</span>
                                    </li>
                                    <li><img src="/assets/official/image/icon???weixin@2x.png" alt=""><span>??????</span></li>
                                    <li><img src="/assets/official/image/icon???qq@2x.png" alt=""><span>QQ</span></li>
                                </ul>
                            </div>
                            <div class="success-content-btn" id="success-off">
                                ??????
                            </div>
                        </div>
                    </div>
                </div>
                <div class="notice-show-zz" style="display: none;">
                    <div class="notice-show">
                        <div class="notice-show-top">
                            <span>??????</span>
                        </div>
                        <div class="notice-show-middle">
                            <div class="middle-ul">
                                <ul>
                                    <li><i>1</i><span>???????????????????????????????????????-????????????????????????</span></li>
                                    <li><i>1</i><span>???????????????????????????????????????-????????????????????????</span></li>
                                    <li><i>1</i><span>???????????????????????????????????????-????????????????????????</span></li>
                                    <li><i>1</i><span>???????????????????????????????????????-????????????????????????</span></li>
                                    <li><i>1</i><span>???????????????????????????????????????-????????????????????????</span></li>
                                    <li>
                                        <span><a href="">??????</a></span>
                                        <span>|</span>
                                        <span><a href="">??????</a></span>
                                        <span>|</span>
                                        <span><a href="">??????</a></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="notice-show-foot">
                            <img class="showfalg" src="/assets/official/image/icon???guanbi@2x.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-foot-box" id="foot">
            <div class="content-foot">
                <ul>
                    <li>
                        <a href="/">
                            <img src="/assets/official/image/icon???shouye@2x (2).png" alt="">
                            <span class="active">??????</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php
                        if ($userrow['power'] > 0) { // ????????????
                            echo '?mod=adminSubstation';
                        } else {
                            echo '?mod=substation';
                        }
                        ?>">
                            <img src="/assets/official/image/icon???fenzhan@2x.png" alt="">
                            <span>??????</span>
                        </a>
                    </li>
                    <li>
                        <a href="?mod=activity">
                            <img src="/assets/official/image/icon???huodong.png" alt="">
                            <span>??????</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $islogin2 ? '?mod=user' : '?mod=login'; ?>">
                            <img src="/assets/official/image/icon???wode@2x.png" alt="">
                            <span>??????</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="fixed-box">
        <div class="right-ul" style="display: none;">
            <ul>
                <li>
                    <img src="/assets/official/image/icon???kefu@2x.png" alt="">
                    <span>????????????</span>
                </li>
                <li>
                    <img src="/assets/official/image/icon???jiaoliuqun@2x.png" alt="">
                    <span>???????????????</span>
                </li>
                <li>
                    <img class="btn-info" src="/assets/official/image/fenzan 11@2x.png" alt="">
                    <span>????????????</span>
                </li>
            </ul>
        </div>
    </div>
</div>
<!--????????????-->
<div id="audio-play" <?php if (empty($conf['musicurl'])){ ?>style="display:none;"<?php } ?>>
    <div id="audio-btn" class="on" onclick="audio_init.changeClass(this,'media')">
        <audio loop="loop" src="<?php echo $conf['musicurl'] ?>" id="media" preload="preload"></audio>
    </div>
</div>
<!--????????????-->
<script src="<?php echo $cdnpublic; ?>jquery/2.1.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic; ?>jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="<?php echo $cdnpublic; ?>layer/2.3/layer.js"></script>
<script src="<?php echo $cdnpublic; ?>twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="/assets/official/js/main.js?ver=<?php echo VERSION; ?>"></script>
<script>
    let homepage = true;
    let isModal = false;
    const hashsalt = <?php echo $addsalt_js; ?>;

    const is_search_order = <?php echo isset($_GET['search_order']) ? 'true' : 'false'; ?>;

    $(document).ready(function () {

        let type = 0;
        const search_order_dom = $('.search-order');

        if (is_search_order) {
            type = 1;
            $('.create-order-box').hide();
            $('.search-order-box').show();
            search_order_dom.html('<span><i class="left zd"></i>??????</span><span><i class="right"></i>??????</span>');
        }

        search_order_dom.click(function () {
            if (type === 1) { // ??????
                $('.create-order-box').show();
                $('.search-order-box').hide();
                search_order_dom.html('<span><i class="left zd"></i>??????</span><span><i class="right"></i>??????</span>');
                type = 0;
                window.history.replaceState(null, {}, '/');
            } else { // ??????
                $('.create-order-box').hide();
                $('.search-order-box').show();
                search_order_dom.html('<span><i class="left zd"></i>??????</span><span><i class="right"></i>??????</span>');
                type = 1;
                window.history.replaceState(null, {}, '/?search_order=1');
            }
        });
    });
</script>

<!--????????????-->
<?php echo $conf['chatframe']; ?>
</body>
</html>