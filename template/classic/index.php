<?php
if (!defined('IN_CRONLITE')) exit();
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
    <title><?php echo $conf['sitename'] ?> - <?php echo $conf['title'] ?></title>
    <meta name="keywords" content="<?php echo $conf['keywords'] ?>">
    <meta name="description" content="<?php echo $conf['description'] ?>">
    <link href="<?php echo $cdnpublic ?>twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="<?php echo $cdnpublic ?>font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link type="text/css" href="/assets/user/css/load.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?php echo $cdnserver ?>assets/css/common.css?ver=<?php echo VERSION ?>">
    <!--[if lt IE 9]>
    <script src="<?php echo $cdnpublic ?>html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="<?php echo $cdnpublic ?>respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
    <style>
        body {
            background: #ecedf0 url("<?php echo $background_image?>") fixed;
        <?php echo $repeat?>
        }
    </style>
</head>
<body>
<div class="loading-back" id="sk-three-bounce">
    <div class="sk-three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
    </div>
</div>
<div class="modal fade" align="left" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $conf['sitename'] ?></h4>
            </div>
            <div class="modal-body">
                <?php echo $conf['modal'] ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--??????????????????-->
<div class="modal fade" align="left" id="cxsm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">??????????????????????????????????????????</h4>
            </div>
            <li class="list-group-item"><font color="red">???????????????????????????????????????????????????????????????????????????????????????</font></li>
            <li class="list-group-item">?????????????????????QQ???????????????????????????QQ????????????????????????</li>
            <li class="list-group-item">???????????????????????????????????????????????????????????????????????????QQ?????????????????????</li>
            <li class="list-group-item">?????????????????????KF???????????????????????????????????????userid=???????????????????????????KF??????????????????????????????</li>
            <li class="list-group-item">???????????????????????????K??????????????????????????????????????????shareuid=???????????????&amp;??????????????????????????????????????????????????????????????????</li>
            <li class="list-group-item"><font color="red">??????????????????????????????????????????????????????????????????????????????????????????????????????????????????</font></li>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">??????</button>
            </div>
        </div>
    </div>
</div>
<!--??????????????????-->
<br/>
<div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 center-block" style="float: none;">
    <div class="panel panel-default">
        <div class="panel-body" style="text-align: center;">
            <img src="<?php echo $logo; ?>" style="max-width: 100%;" alt="logo">
        </div>
    </div>
    <div class="panel panel-info">
        <div class="list-group-item reed" style="background:#64b2ca;"><h3 class="panel-title"><font color="#fff"><i
                            class="fa fa-volume-up"></i>&nbsp;&nbsp;<b>????????????</b></font></h3></div>
        <?php echo $conf['anounce'] ?>
    </div>

    <div class="panel panel-info">
        <div class="list-group-item reed" style="background:#64b2ca;"><h3 class="panel-title"><font color="#fff"><i
                            class="fa fa-shopping-cart"></i>&nbsp;&nbsp;<b>????????????</b></font></h3></div>
        <ul class="nav nav-tabs">
            <li class="active"><a href="#onlinebuy" data-toggle="tab">??????</a></li>
            <li <?php if ($conf['iskami'] == 0){ ?>class="hide"<?php } ?>><a href="#cardbuy" data-toggle="tab">??????</a>
            </li>
            <li><a href="#query" data-toggle="tab" id="tab-query">??????</a></li>
            <li <?php if ($conf['gift_open'] == 0){ ?>class="hide"<?php } ?>><a href="#gift" data-toggle="tab">??????</a>
            </li>
            <li <?php if (empty($conf['daiguaurl'])){ ?>class="hide"<?php } ?>><a href="./?mod=daigua">??????</a></li>
            <li <?php if (empty($conf['chatframe'])){ ?>class="hide"<?php } ?>><a href="#chat" data-toggle="tab">??????</a>
            </li>
            <li <?php if ($conf['fenzhan_buy'] == 0){ ?>class="hide"<?php } ?>><a href="./user/regsite.php"
                                                                                  style="color:red">????????????</a></li>
            <?php if ($islogin2 == 1) { ?>
                <li <?php if ($conf['fenzhan_buy'] == 0){ ?>class="hide"<?php } ?>><a href="./user/">????????????</a></li>
            <?php } else { ?>
                <li <?php if ($conf['fenzhan_buy'] == 0){ ?>class="hide"<?php } ?>><a href="./user/login.php">????????????</a>
                </li>
            <?php } ?>
        </ul>
        <div class="list-group-item">
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade in active" id="onlinebuy">
                    <?php include TEMPLATE_ROOT . 'default/shop.inc.php'; ?>
                </div>
                <div class="tab-pane fade in" id="cardbuy">
                    <?php if (!empty($conf['kaurl'])) { ?>
                        <div class="form-group">
                            <a href="<?php echo $conf['kaurl'] ?>" class="btn btn-default btn-block" target="_blank"/>????????????????????????</a>
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">????????????</div>
                            <input type="text" name="km" id="km" value="" class="form-control"
                                   onkeydown="if(event.keyCode==13){submit_checkkm.click()}" required/>
                        </div>
                    </div>
                    <input type="submit" id="submit_checkkm" class="btn btn-primary btn-block" value="????????????">
                    <div id="km_show_frame" style="display:none;">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">????????????</div>
                                <input type="text" name="name" id="km_name" value="" class="form-control" disabled/>
                            </div>
                        </div>
                        <div id="km_inputsname"></div>
                        <div id="km_alert_frame" class="alert alert-warning" style="display:none;"></div>
                        <input type="submit" id="submit_card" class="btn btn-primary btn-block" value="????????????">
                        <div id="result1" class="form-group text-center" style="display:none;">
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade in" id="query">
                    <div class="alert alert-info"
                         <?php if (empty($conf['gg_search'])){ ?>style="display:none;"<?php } ?>><?php echo $conf['gg_search'] ?></div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <select class="form-control" id="searchtype" style="padding: 6px 4px;width:90px">
                                    <option value="0">????????????</option>
                                    <option value="1">?????????</option>
                                </select>
                            </div>
                            <input type="text" name="qq" id="qq3" value="<?php echo $qq ?>" class="form-control"
                                   placeholder="????????????????????????????????????????????????????????????"
                                   onkeydown="if(event.keyCode==13){submit_query.click()}" required/>
                            <span class="input-group-btn"><a href="#cxsm" data-toggle="modal" class="btn btn-warning"><i
                                            class="glyphicon glyphicon-exclamation-sign"></i></a></span>
                        </div>
                    </div>
                    <input type="submit" id="submit_query" class="btn btn-primary btn-block" value="????????????">
                    <div id="result2" class="form-group" style="display:none;">
                        <table class="table table-striped">
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
                <div class="tab-pane fade in" id="lqq">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">?????????QQ</div>
                            <input type="text" name="qq" id="qq4" value="" class="form-control" required/>
                        </div>
                    </div>
                    <input type="submit" id="submit_lqq" class="btn btn-primary btn-block" value="????????????">
                    <div id="result3" class="form-group text-center" style="display:none;"></div>
                </div>
                <div class="tab-pane fade in" id="gift">
                    <div class="panel-body text-center">
                        <div id="roll">??????????????????????????????</div>
                        <hr>
                        <p>
                            <a class="btn btn-info" id="start" style="display:block;">????????????</a>
                            <a class="btn btn-danger" id="stop" style="display:none;">??????</a>
                        </p>
                        <div id="result"></div>
                        <br/>
                        <div class="giftlist" style="display:none;"><strong>??????????????????</strong>
                            <ul id="pst_1"></ul>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade in" id="chat">
                    <?php echo $conf['chatframe'] ?>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-info" <?php if ($conf['hide_tongji'] == 1){ ?>style="display:none;"<?php } ?>>
        <div class="list-group-item reed" style="background:#64b2ca;"><h3 class="panel-title"><font color="#fff"><i
                            class="fa fa-bar-chart"></i>&nbsp;&nbsp;<b>????????????</b></font></h3></div>
        <table class="table table-bordered">
            <tbody>
            <tr>
                <td align="center"><font color="#808080"><b>??????????????????</b></br><i class="fa fa-hourglass-2 fa-2x"></i></br>
                        <span id="count_yxts"></span>???</font></td>
                <td align="center"><font color="#808080"><b>??????????????????</b></br><span
                                class="fa fa-shopping-cart fa-2x"></span></br><span id="count_orders"></span>???</font>
                </td>
            </tr>
            <tr height=50>
                <td align="center"><font color="#808080"><b>??????????????????</b></br><i
                                class="fa fa-check-square-o fa-2x"></i></span></br><span
                                id="count_orders1"></span>???</font></td>
                <td align="center"><font color="#808080"><b>??????????????????</b></br><i
                                class="fa fa-internet-explorer fa-2x"></i></span></br><span
                                id="counter">1</span>???</font></td>
            <tbody>
        </table>
    </div>

    <div class="panel panel-info" <?php if ($conf['bottom'] == ''){ ?>style="display:none;"<?php } ?>>
        <?php echo $conf['bottom'] ?>
    </div>
    <p style="text-align:center"><span style="font-weight:bold">CopyRight <i
                    class="fa fa-heart text-danger"></i> 2019 <a href="/"><?php echo $conf['sitename'] ?></a></span></p>
</div>
</div>
<!--????????????-->
<div id="audio-play" <?php if (empty($conf['musicurl'])){ ?>style="display:none;"<?php } ?>>
    <div id="audio-btn" class="on" onclick="audio_init.changeClass(this,'media')">
        <audio loop="loop" src="<?php echo $conf['musicurl'] ?>" id="media" preload="preload"></audio>
    </div>
</div>
<!--????????????-->
<script src="<?php echo $cdnpublic ?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic ?>jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script>
<script src="<?php echo $cdnpublic ?>twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo $cdnpublic ?>jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="<?php echo $cdnpublic ?>layer/2.3/layer.js"></script>

<script type="text/javascript">
    var isModal =<?php echo empty($conf['modal']) ? 'false' : 'true';?>;
    var homepage = true;
    var hashsalt =<?php echo $addsalt_js?>;
    $(function () {
        $("img.lazy").lazyload({effect: "fadeIn"});
    });
</script>
<script src="assets/js/main.js?ver=<?php echo VERSION ?>"></script>
<script src="/assets/user/js/load.js"></script>
</body>
</html>