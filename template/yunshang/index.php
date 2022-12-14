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
    <link rel="stylesheet" href="<?php echo $cdnserver ?>assets/simple/css/plugins.css">
    <link rel="stylesheet" href="<?php echo $cdnserver ?>assets/simple/css/main.css">
    <link rel="stylesheet" href="<?php echo $cdnserver ?>assets/simple/css/oneui.css">
    <link rel="stylesheet" href="<?php echo $cdnserver ?>assets/css/common.css?ver=<?php echo VERSION ?>">
    <script src="<?php echo $cdnpublic ?>modernizr/2.8.3/modernizr.min.js"></script>
    <!--[if lt IE 9]>
    <script src="<?php echo $cdnpublic ?>html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="<?php echo $cdnpublic ?>respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .shuaibi-tip {
            background: #fafafa repeating-linear-gradient(-45deg, #fff, #fff 1.125rem, transparent 1.125rem, transparent 2.25rem);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
            margin: 20px 0px;
            padding: 15px;
            border-radius: 5px;
            font-size: 14px;
            color: #555555;
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
<img style="background: linear-gradient(to right,#49BDAD,#f2b9ca);color:#000;" class="full-bg full-bg-bottom"
     ondragstart="return false;" oncontextmenu="return false;" alt="">
<br>
<div class="col-xs-12 col-sm-10 col-md-8 col-lg-5 center-block" style="float: none;">
    <!--????????????-->
    <div class="modal fade" align="left" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header-tabs">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">??</span><span
                                class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo $conf['sitename'] ?></h4>
                </div>
                <div class="modal-body">
                    <?php echo $conf['modal'] ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">?????????</button>
                </div>
            </div>
        </div>
    </div>
    <!--????????????-->

    <!--??????????????????-->
    <div class="modal fade" align="left" id="anounce" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background:linear-gradient(120deg, #31B404 0%, #D7DF01 100%);">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"></span><span
                                class="sr-only">Close</span></button>
                    <center><h4 class="modal-title" id="myModalLabel"><b><font
                                        color="#fff"><?php echo $conf['sitename'] ?></font></b></h4></center>
                </div>
                <div class="widget flat radius-bordered">
                    <div class="widget-header bordered-top bordered-themesecondary">
                        <div class="modal-body">
                            <?php echo $conf['anounce'] ?></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">????????????</button>
                </div>
            </div>
        </div>
    </div>
    <!--??????-->
    <!--??????????????????-->
    <div class="modal fade" align="left" id="cxsm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
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
    <div class="widget">
        <!--logo-->
        <div class="widget-content themed-background-flat text-center"
             style="background-image:url(assets/simple/img/userbg.jpg);background-size: 100% 100%;">
            <a href="javascript:void(0)">
                <img src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['kfqq'] ?>&spec=100" alt="Avatar" width="80"
                     style="height: auto filter: alpha(Opacity=80);-moz-opacity: 0.80;opacity: 0.80;"
                     class="img-circle img-thumbnail img-thumbnail-avatar-1x animated zoomInDown">
            </a>
        </div>
        <!--logo-->
        <center>
            <h2>
                <a href="javascript:void(alert(&#39;<?php echo $conf['sitename'] ?>???????????????????????????????????????&#39;));"><b><?php echo $conf['sitename'] ?></b></a>
            </h2>
        </center>
        <!--logo????????????-->
        <div class="widget-content text-center">
            <div class="text-center text-muted">
                <div class="btn-group btn-group-justified">
                    <div class="btn-group">
                        <a class="btn btn-default" data-toggle="modal" href="#anounce"><i class="fa fa-wifi"></i> <span
                                    style="font-weight:bold"> ????????????</span></a>
                    </div>
                    <div class="btn-group">
                        <a class="btn btn-default" data-toggle="modal" href="#recommend"><font color="#ff0000"><i
                                        class="fa fa-bolt"></i> ????????????</font></a>
                    </div>
                </div>
            </div>
        </div>

        <!--logo????????????-->
        <!--????????????-->
        <div class="modal fade" align="left" id="circles" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">??</span><span
                                    class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">???????????????99+</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">?????????QQ</div>
                                <input type="text" name="qq" id="qq4" value="" class="form-control" required="">
                            </div>
                        </div>
                        <input type="submit" id="submit_lqq" class="btn btn-primary btn-block" value="????????????">
                        <div id="result3" class="form-group text-center" style="display:none;"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">??????</button>
                    </div>
                </div>
            </div>
        </div>
        <!--????????????-->
    </div>
    <div class="block full2">
        <!--TAB????????????-->
        <div class="block-title">
            <ul class="nav nav-tabs" data-toggle="tabs">
                <li style="width: 25%;" align="center" class="active"><a href="#shop"><i
                                class="fa fa-shopping-cart"></i> <b>??????</b></a></li>
                <li style="width: 25%;" align="center" class=""><a href="#search" id="tab-query"><i
                                class="fa fa-search"></i> <b>??????</b></a></li>
                <li style="width: 25%;" align="center" <?php if ($conf['fenzhan_buy'] == 0){ ?>class="hide"<?php } ?>><a
                            href="#Substation"><font color="#FF4000"><i class="fa fa-location-arrow fa-spin"></i>
                            <b>??????</b></font></a></li>
                <li style="width: 25%;" align="center"
                    <?php if ($conf['gift_open'] == 0 || $conf['fenzhan_buy'] == 1){ ?>class="hide"<?php } ?>><a
                            href="#gift" data-toggle="tab"><span style="font-weight:bold"><i
                                    class="fa fa-gift fa-fw"></i> ??????</span></a></li>
                <li style="width: 25%;" align="center"
                    <?php if ($conf['iskami'] == 0 || $conf['fenzhan_buy'] == 1 || $conf['gift_open'] == 1){ ?>class="hide"<?php } ?>>
                    <a href="#cardbuy" data-toggle="tab"><span style="font-weight:bold"><i
                                    class="glyphicon glyphicon-th"></i> ??????</span></a></li>
                <li style="width: 25%;" align="center" class=""><a href="#more"><i class="fa fa-list"></i> <b>??????</b></a>
                </li>

            </ul>
        </div>
        <!--TAB????????????-->
        <div class="tab-content">
            <!--????????????-->
            <div class="tab-pane active" id="shop">
                <center>
                    <div class="shuaibi-tip animated tada  text-center"><i class="fa fa-heart text-danger"></i>
                        <b>???<?= date("m???d???") ?>?????????????????????&nbsp;<a href="#anounce" data-toggle="modal"
                                                               class="label label-danger"><font
                                        color="#FFFFFF">????????????</font></a></b></div>
                </center>
                <?php include TEMPLATE_ROOT . 'default/shop.inc.php'; ?>
            </div>
            <!--????????????-->
            <!--????????????-->
            <div class="tab-pane" id="search">
                <table class="table table-striped table-borderless table-vcenter remove-margin-bottom">
                    <tbody>
                    <tr class="shuaibi-tip animation-bigEntrance">
                        <td class="text-center" style="width: 100px;">
                            <img src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['kfqq'] ?>&spec=100"
                                 alt="avatar" class="img-circle img-thumbnail img-thumbnail-avatar">
                        </td>
                        <td>
                            <h4><strong>??????</strong></h4>
                            <i class="fa fa-fw fa-qq text-primary"></i> <?php echo $conf['kfqq'] ?><br><i
                                    class="fa fa-fw fa-history text-danger"></i>?????????????????????????????????
                        </td>
                        <td class="text-right" style="width: 20%;">
                            <a href="#lxkf" target="_blank" data-toggle="modal" class="btn btn-sm btn-info">??????</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <br>
                <div class="col-xs-12 well well-sm animation-pullUp"
                     <?php if (empty($conf['gg_search'])){ ?>style="display:none;"<?php } ?>>
                    <?php echo $conf['gg_search'] ?>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-btn">
                            <select class="form-control" id="searchtype" style="padding: 6px 4px;width:90px">
                                <option value="0">????????????</option>
                                <option value="1">?????????</option>
                            </select>
                        </div>
                        <input type="text" name="qq" id="qq3" value="" class="form-control"
                               placeholder="????????????????????????????????????????????????????????????"
                               onkeydown="if(event.keyCode==13){submit_query.click()}" required="">
                        <span class="input-group-btn"><a href="#cxsm" target="_blank" data-toggle="modal"
                                                         class="btn btn-warning"><i
                                        class="glyphicon glyphicon-exclamation-sign"></i></a></span>
                    </div>
                </div>
                <input type="submit" id="submit_query" class="btn btn-primary btn-block btn-rounded"
                       style="background: linear-gradient(to right,#87CEFA,#6495ED);color:#fff;" value="????????????">
                <br>
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
            </div>
            <!--????????????-->
            <!--??????????????????-->
            <div class="tab-pane animation-fadeInQuick2" id="Substation">
                <table class="table table-borderless table-pricing">
                    <tbody>
                    <tr class="active">
                        <td class="btn-effect-ripple"
                            style="overflow: hidden; position: relative;width: 100%; height: 8em;display: block;color: white;margin: auto;background-color: lightskyblue;">
                            <span class="btn-ripple animate"
                                  style="height: 546px; width: 546px; top: -212.8px; left: 56.4px;"></span>
                            <h3 style="width:100%;font-size: 1.6em;">
                            </h3>
                            <h3 style="width:100%;font-size: 1.6em;">
                                <i class="fa fa-user-o fa-fw" style="margin-top: 0.7em;"></i><strong>?????????</strong> /<i
                                        class="fa fa-user-circle-o fa-fw"></i><strong>?????????</strong>
                            </h3>
                            <span style="width: 100%;text-align: center;margin-top: 0.8em;font-size: 1.1em;display: block;"><?php echo $conf['fenzhan_price'] ?>??? / <?php echo $conf['fenzhan_price2'] ?>???</span>
                        </td>
                    </tr>
                    <tr>
                        <td>???????????????????????????</td>
                    </tr>
                    <tr>
                        <td>???????????????????????????</td>
                    </tr>
                    <tr>
                        <td>???????????????<?php echo $conf['tixian_min']; ?>?????????</td>
                    </tr>
                    <tr>
                        <td><strong>????????????????????????????????????</strong></td>
                    </tr>
                    <tr class="active">
                        <td>
                            <a href="#userjs" data-toggle="modal" class="btn btn-effect-ripple  btn-info"
                               style="overflow: hidden; position: relative;"><i class="fa fa-align-justify"></i><span
                                        class="btn-ripple animate"
                                        style="height: 100px; width: 100px; top: -24.8px; left: 11.05px;"></span>
                                ????????????</a>
                            <a href="user/regsite.php" target="_blank" class="btn btn-effect-ripple  btn-danger"
                               style="overflow: hidden; position: relative;"><i class="fa fa-arrow-right"></i> ????????????</a>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>
            <!--??????????????????-->
            <!--??????-->
            <div class="tab-pane" id="gift">
                <div class="panel-body text-center">
                    <div id="roll">??????????????????????????????</div>
                    <hr>
                    <p>
                        <a class="btn btn-info" id="start" style="display:block;">????????????</a>
                        <a class="btn btn-danger" id="stop" style="display:none;">??????</a>
                    </p>
                    <div id="result"></div>
                    <br>
                    <div class="giftlist" style="display:none;"><strong>??????????????????</strong>
                        <ul id="pst_1"></ul>
                    </div>
                </div>
            </div>
            <!--??????-->
            <!--??????????????????-->
            <div class="tab-pane" id="more">
                <div class="row">
                    <div class="col-sm-6<?php if ($conf['gift_open'] == 0) { ?> hide<?php } ?>">
                        <a href="#gift" data-toggle="tab" class="widget">
                            <div class="widget-content themed-background-info text-right clearfix" style="color: #fff;">
                                <div class="widget-icon pull-left">
                                    <i class="fa fa-gift"></i>
                                </div>
                                <h2 class="widget-heading h3">
                                    <strong>??????</strong>
                                </h2>
                                <span>??????????????????????????????</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6<?php if (empty($conf['appurl']) || $conf['gift_open'] == 1) { ?> hide<?php } ?>">
                        <a href="<?php echo $conf['appurl']; ?>" target="_blank" class="widget">
                            <div class="widget-content themed-background-info text-right clearfix" style="color: #fff;">
                                <div class="widget-icon pull-left">
                                    <i class="fa fa-cloud-download"></i>
                                </div>
                                <h2 class="widget-heading h3">
                                    <strong>APP??????</strong>
                                </h2>
                                <span>??????APP??????????????????</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6<?php if (empty($conf['invite_tid'])) { ?> hide<?php } ?>">
                        <a href="./?mod=invite" target="_blank" class="widget">
                            <div class="widget-content themed-background-warning text-right clearfix"
                                 style="color: #fff;">
                                <div class="widget-icon pull-left">
                                    <i class="fa fa-paper-plane-o"></i>
                                </div>
                                <h2 class="widget-heading h3">
                                    <strong>????????????</strong>
                                </h2>
                                <span>?????????????????????????????????</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6<?php if (empty($conf['daiguaurl'])) { ?> hide<?php } ?>">
                        <a href="./?mod=daigua" class="widget">
                            <div class="widget-content themed-background-success text-right clearfix"
                                 style="color: #fff;">
                                <div class="widget-icon pull-left">
                                    <i class="fa fa-rocket"></i>
                                </div>
                                <h2 class="widget-heading h3">
                                    <strong>QQ????????????</strong>
                                </h2>
                                <span>???????????????QQ??????</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6<?php if (empty($conf['chatframe'])) { ?> hide<?php } ?>">
                        <a href="#chat" data-toggle="tab" class="widget">
                            <div class="widget-content themed-background-danger text-right clearfix"
                                 style="color: #fff;">
                                <div class="widget-icon pull-left">
                                    <i class="fa fa-comments"></i>
                                </div>
                                <h2 class="widget-heading h3">
                                    <strong>????????????</strong>
                                </h2>
                                <span>???????????????</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6<?php if ($conf['iskami'] == 0) { ?> hide<?php } ?>">
                        <a href="#cardbuy" data-toggle="tab" class="widget">
                            <div class="widget-content themed-background-warning text-right clearfix"
                                 style="color: #fff;">
                                <div class="widget-icon pull-left">
                                    <i class="fa fa-credit-card"></i>
                                </div>
                                <h2 class="widget-heading h3">
                                    <strong>????????????</strong>
                                </h2>
                                <span>????????????????????????</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <a href="./user/" target="_blank" class="widget">
                            <div class="widget-content themed-background-info text-right clearfix" style="color: #fff;">
                                <div class="widget-icon pull-left">
                                    <i class="fa fa-certificate"></i>
                                </div>
                                <h2 class="widget-heading h3">
                                    <strong>????????????</strong>
                                </h2>
                                <span>??????????????????</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!--??????????????????-->
            <!--????????????-->
            <div class="tab-pane" id="cardbuy">
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
                    <div id="km_alert_frame" class="alert alert-success animation-pullUp"
                         style="display:none;font-weight: bold;"></div>
                    <input type="submit" id="submit_card" class="btn btn-primary btn-block" value="????????????">
                    <div id="result1" class="form-group text-center" style="display:none;">
                    </div>
                </div>
                <br/>
            </div>
            <!--????????????-->
            <!--??????-->
            <div class="tab-pane" id="chat">
                <?php echo $conf['chatframe'] ?>
            </div>
            <!--??????-->
        </div>
    </div>

    <div class="panel panel-primary" <?php if ($conf['hide_tongji'] == 1){ ?>style="display:none;"<?php } ?>>
        <div class="panel-heading"><h3 class="panel-title"><font color="#000000"><i class="fa fa-bar-chart-o"></i>&nbsp;&nbsp;<b>????????????</b></font>
            </h3></div>
        <table class="table table-bordered">
            <tbody>
            <tr>
                <td align="center">
                    <font size="2"><span id="count_yxts"></span>???<br><font color="#65b1c9"><i
                                    class="fa fa-shield fa-2x"></i></font><br>????????????</font></td>
                <td align="center"><font size="2"><span id="count_money"></span>???<br><font color="#65b1c9"><i
                                    class="fa fa-shopping-cart fa-2x"></i></font><br>????????????</font></td>
                <td align="center"><font size="2"><span id="count_orders"></span>???<br><font color="#65b1c9"><i
                                    class="fa fa-check-square-o fa-2x"></i></font><br>????????????</font></td>
            </tr>
            <tr>
                <td align="center"><font size="2"><span id="count_site"></span>???<br><font color="#65b1c9"><i
                                    class="fa fa-sitemap fa-2x"></i></font><br>????????????</font></td>
                <td align="center"><font size="2"><span id="count_money1"></span>???<br><font color="#65b1c9"><i
                                    class="fa fa-pie-chart fa-2x"></i></font><br>????????????</font></td>
                <td align="center"><font size="2"><span id="count_orders2"></span>???<br><font color="#65b1c9"><i
                                    class="fa fa-check-square fa-2x"></i></font><br>????????????</font></td>
            </tr>
            </tbody>
        </table>
    </div>

    <!--????????????-->
    <div class="panel panel-default">
        <center>
            <div class="panel-body"><span style="font-weight:bold"><?php echo $conf['sitename'] ?> <i
                            class="fa fa-heart text-danger"></i> 2019 | </span> </span><a href="./"><span
                            style="font-weight:bold"><?php echo $_SERVER['HTTP_HOST'] ?></span></a>
            </div>
    </div>
    <!--????????????-->
</div>

<!--??????????????????-->
<div class="modal fade col-xs-12" align="left" id="lxkf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true"><br> <br>
    <div class="modal-dialog panel panel-primary  animation-fadeInQuick2">
        <div class="modal-content">
            <div class="list-group-item reed" style="background:linear-gradient(120deg, #5ED1D7 10%, #71D7A2 90%);">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"></span><span
                            class="sr-only">Close</span></button>
                <center><h4 class="modal-title" id="myModalLabel"><b><font color="#fff">???????????????</font></b></h4></center>
            </div>
            <div class="modal-body" id="accordion">
                <div class="panel panel-default" style="margin-bottom: 6px;">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion"
                               href="#collapseOne">??????????????????????????????????????????????????????</a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                        <div class="panel-body">
                            ?????????????????????????????????????????????????????????????????????????????????????????????<br>
                            ????????????????????????????????????????????????<br>
                            ??????????????????????????????????????????????????????
                        </div>
                    </div>
                </div>
                <div class="panel panel-default" style="margin-bottom: 6px;">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed">QQ??????/??????????????????????????????</a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" style="height: 0px;">
                        <div class="panel-body">
                            ????????????48????????????????????????????????????????????????48?????????????????????<br>
                            ????????????48????????????????????????????????????????????????QQ?????????
                        </div>
                    </div>
                </div>
                <div class="panel panel-default" style="margin-bottom: 6px;">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed">??????/CDK???????????????????????????</a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse" style="height: 0px;">
                        <div class="panel-body">???????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????<br>
                            ????????????????????????????????????????????????????????????????????????/cdk???
                        </div>
                    </div>
                </div>
                <div class="panel panel-default" style="margin-bottom: 6px;">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFourth" class="collapsed">???????????????????????????????????????</a>
                        </h4>
                    </div>
                    <div id="collapseFourth" class="panel-collapse collapse" style="height: 0px;">
                        <div class="panel-body" style="margin-bottom: 6px;">??????????????????????????????????????????????????????????????????????????????????????????????????????<br>???????????????????????????????????????????????????????????????????????????????????????????????????QQ????????????
                        </div>
                    </div>
                </div>
                <ul class="list-group" style="margin-bottom: 0px;">
                    <li class="list-group-item">
                        <div class="media">
                            <span class="pull-left thumb-sm"><img
                                        src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['kfqq'] ?>&spec=100"
                                        alt="..." class="img-circle img-thumbnail img-avatar"></span>
                            <div class="pull-right push-15-t">
                                <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq'] ?>&site=qq&menu=yes"
                                   target="_blank" class="btn btn-sm btn-info">??????</a>
                            </div>
                            <div class="pull-left push-10-t">
                                <div class="font-w600 push-5">??????????????????</div>
                                <div class="text-muted"><b>QQ???<?php echo $conf['kfqq'] ?></b>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        ????????????????????????????????????????????????????????????!<br>
                        ????????????+????????????+???????????????????????????????????????!<br>
                        ???????????????????????????????????????????????????????????????<br>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">??????</button>
            </div>
        </div>
    </div>
</div>
<!--??????????????????-->
<!--??????????????????-->
<div class="modal fade" align="left" id="recommend" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background:linear-gradient(120deg, #0174DF 30%, #DF01D7 70%);">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"></span><span
                            class="sr-only">Close</span></button>
                <center><h4 class="modal-title" id="myModalLabel"><b><font color="#fff">????????????</font></b></h4></center>
            </div>
            <br>
            <?php
            if ($islogin2 == 1) {
                $price_obj = new Price($userrow['zid'], $userrow);
            } elseif ($is_fenzhan == true) {
                $price_obj = new Price($siterow['zid'], $siterow);
            } else {
                $price_obj = new Price(1);
            }

            $rs = $DB->select('class', '*', ['AND' => ['cid' => 0, 'active' => 1], 'ORDER' => ['sort' => 'ASC']]);
            foreach ($rs as $row) {
                if (!empty($row["shopimg"])) {
                    $productimg = $row["shopimg"];
                } else {
                    $productimg = 'assets/img/Product/default.png';
                }
                if (isset($price_obj)) {
                    $price_obj->setToolInfo($row['tid'], $res);
                    if ($price_obj->getToolDel($row['tid']) == 1) continue;
                    $price = $price_obj->getToolPrice($row['tid']);
                } else $price = $row['price'];
                ?>
                <div class="col-xs-6 col-sm-3 col-md-4 layui-anim layui-anim-scaleSpring" data-anim="layui-anim-upbit">
                    <a href="javascript:void(0)" onclick="toTool(<?php echo $row["cid"] ?>,<?php echo $row["tid"] ?>)">
                        <div class="thumbnail" style="height:138px;">
                            <center style="margin-top:5%;">
                                <img src="<?php echo $productimg ?>" width="30" height="30" style="border-radius: 10px"
                                     alt="">
                                <hr class="layui-bg-blue" style="width:80%"><?php echo $row["name"] ?>
                                <br>
                                <font color="red">[???<?php echo $price ?>??? ]</font>
                            </center>
                        </div>
                    </a>
                </div>
            <?php } ?>
            <table class="table table-bordered table-striped">
                <tbody>
                <tr>
                </tr>
                </tbody>
            </table>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">??????</button>
            </div>
        </div>
    </div>
</div>
<!--??????????????????-->
<!--???????????????-->
<div class="modal fade" align="left" id="qqdzz" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="list-group-item reed" style="background:linear-gradient(120deg, #5ED1D7 10%, #71D7A2 90%);">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span><span
                            class="sr-only">Close</span></button>
                <center><h4 class="modal-title" id="myModalLabel"><b><font color="#fff">????????????</font></b></h4></center>
            </div>
            <br>
            <div class="modal-body">
                <center>
                    <p class="bg-primary" style="background-color:#424242;padding: 10px;">
                        ????????????<br>????????????:100,200,400,800,<br>1000,2000,4000,8000,10000,20000 </p>
                    <p class="bg-primary" style="background-color:#FF6666;padding: 10px;">
                        ????????????<br>????????????:1000,2000,4000,<br>8000,10000,20000,40000,80000</p></center>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">????????????</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--???????????????-->

<!--??????K???-->
<div class="modal fade" align="left" id="qmkg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="list-group-item reed" style="background:linear-gradient(120deg, #DF01A5 10%, #FF0080 90%);">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"></span><span
                            class="sr-only">Close</span></button>
                <center><h4 class="modal-title" id="myModalLabel"><b><font color="#fff">???????????????</font></b></h4></center>
            </div>
            <div class="modal-body">
                <center>
                    <p class="bg-primary" style="background-color:#424242;padding: 10px;">
                        0-6?????? ???????????????1000????????? </p>
                    <p class="bg-primary" style="background-color:#FF6666;padding: 10px;">
                        7-9?????? ???????????????1500?????????</p>
                    <p class="bg-primary" style="background-color:#0404B4;padding: 10px;">
                        10-12?????????????????????3500????????? </p>
                    <p class="bg-primary" style="background-color:#FF8000;padding: 10px;">
                        13-15?????????????????????26000?????????</p>
                    <p class="bg-primary" style="background-color:#04B431;padding: 10px;">
                        16-18?????????????????????45000?????????</p></center>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">????????????</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--??????K???-->
<!--??????-->
<div class="modal fade" align="left" id="spmz" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="list-group-item reed" style="background:linear-gradient(120deg, #0000FF 10%, #FE2EF7 90%);">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"></span><span
                            class="sr-only">Close</span></button>
                <center><h4 class="modal-title" id="myModalLabel"><b><font color="#fff">????????????</font></b></h4></center>
            </div>
            <br>
            <center>
                <img src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['kfqq'] ?>&spec=100" alt="avatar"
                     class="img-circle img-thumbnail img-thumbnail-avatar">
                <font color="red"> ?????????????????????????????????</font></center>
            <hr>
            <div class="modal-body">
                <p class="bg-primary" style="background-color:#424242;padding: 10px;">
                    ?????????1000???????????????5?????????5000????????????</p>
                <p class="bg-primary" style="background-color:#FF6666;padding: 10px;">
                    ???????????????????????????????????????????????????100???</p></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">????????????</button>
            </div>
        </div>
    </div>
</div>
<!--??????-->
<!--??????????????????-->
<div class="modal fade" align="left" id="userjs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="list-group-item reed" style="background:linear-gradient(120deg, #FE2EF7 10%, #71D7A2 90%);">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"></span><span
                            class="sr-only">Close</span></button>
                <center><h4 class="modal-title" id="myModalLabel"><b><font color="#fff">????????????</font></b></h4></center>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-borderless table-vcenter">
                        <thead>
                        <tr>
                            <th style="width: 100px;">??????</th>
                            <th class="text-center" style="width: 20px;">?????????/?????????</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="active">
                            <td>????????????/????????????</td>
                            <td class="text-center">
                                <span class="btn btn-effect-ripple btn-xs btn-success"
                                      style="overflow: hidden; position: relative;"><i class="fa fa-check"></i></span>
                                <span class="btn btn-effect-ripple btn-xs btn-success"
                                      style="overflow: hidden; position: relative;"><i class="fa fa-check"></i></span>
                            </td>
                        </tr>
                        <tr class="">
                            <td>????????????/????????????</td>
                            <td class="text-center">
                                <span class="btn btn-effect-ripple btn-xs btn-success"
                                      style="overflow: hidden; position: relative;"><i class="fa fa-check"></i></span>
                                <span class="btn btn-effect-ripple btn-xs btn-success"
                                      style="overflow: hidden; position: relative;"><i class="fa fa-check"></i></span>
                            </td>
                        </tr>
                        <tr class="info">
                            <td>????????????/????????????</td>
                            <td class="text-center">
                                <span class="btn btn-effect-ripple btn-xs btn-danger"
                                      style="overflow: hidden; position: relative;"><i class="fa fa-close"></i></span>
                                <span class="btn btn-effect-ripple btn-xs btn-success"
                                      style="overflow: hidden; position: relative;"><i class="fa fa-check"></i></span>
                            </td>
                        </tr>
                        <tr class="">
                            <td>????????????/????????????</td>
                            <td class="text-center">
                                <span class="btn btn-effect-ripple btn-xs btn-danger"
                                      style="overflow: hidden; position: relative;"><i class="fa fa-close"></i></span>
                                <span class="btn btn-effect-ripple btn-xs btn-success"
                                      style="overflow: hidden; position: relative;"><i class="fa fa-check"></i></span>
                            </td>
                        </tr>
                        <tr class="danger">
                            <td>????????????APP</td>
                            <td class="text-center">
                                <span class="btn btn-effect-ripple btn-xs btn-danger"
                                      style="overflow: hidden; position: relative;"><i class="fa fa-close"></i></span>
                                <span class="btn btn-effect-ripple btn-xs btn-success"
                                      style="overflow: hidden; position: relative;"><i class="fa fa-check"></i></span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">??????</button>
            </div>
        </div>
    </div>
</div>
<!--??????????????????-->

<!--??????-->
<div class="modal fade" align="left" id="zlsm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="list-group-item reed" style="background:linear-gradient(120deg, #0000FF 10%, #FE2EF7 90%);">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"></span><span
                            class="sr-only">Close</span></button>
                <center><h4 class="modal-title" id="myModalLabel"><b><font color="#fff">????????????</font></b></h4></center>
            </div>
            <br>
            <div class="modal-body">
                <p class="bg-primary" style="background-color:#04B45F;padding: 10px;">
                    ??????????????????????????????????????????????????????</p>
                <p class="bg-primary" style="background-color:#A8904B1;padding: 10px;">
                    ?????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????</p></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">????????????</button>
            </div>
        </div>
    </div>
</div>
<!--??????-->

<!--????????????-->
<div class="modal fade" id="tisk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="list-group-item reed" style="background:#FFD700;">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span><span
                            class="sr-only">Close</span></button>
                <center><h4 class="modal-title" id="myModalLabel"><b><font color="#fff">???????????????????????????????????????</font></b></h4>
                </center>
            </div>
            <br>
            <center>
                <font color="red">?????????????????????????????=??????????????????????????????1???</font>
                <hr>
                ??????????????????100???KF??????<br>???????????????5????????????????????????500?????????
                <hr>
                ??????????????????1000???QQ?????????<br>???????????????3????????????????????????3000????????????
                <hr>
                ??????????????????1000?????????K?????????<br>???????????????10????????????????????????10000?????????
                <hr>
                <font color="red">???????????? ??????????????????????????????????????????????????????????????????</font>
                <br>
            </center>
            <div class="modal-footer" style="background-color: white;">
                <button type="button" class="btn btn-default" data-dismiss="modal">????????????</button>
            </div>
        </div>
    </div>
</div>
<!--????????????-->

<div class="modal fade" align="left" id="ptyetz" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="list-group-item reed" style="background:linear-gradient(120deg, #FF8000 10%, #FF8000 90%);">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"></span><span
                            class="sr-only">Close</span></button>
                <center><h4 class="modal-title" id="myModalLabel"><b><font color="#fff">??????????????????</font></b></h4></center>
            </div>
            <div style="overflow:scroll; overflow-x:hidden;">
                <div class="modal-body">
                    <?php echo $conf['anounce'] ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">?????????</button>
            </div>
        </div>
    </div>
</div>
</center></div></div>
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
<script src="<?php echo $cdnserver ?>assets/appui/js/app.js"></script>
<!-- DT Time -->
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