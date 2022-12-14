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
    <link href="<?php echo $cdnserver ?>assets/css/nifty.min.css" rel="stylesheet">
    <link href="<?php echo $cdnserver ?>assets/css/magic-check.min.css" rel="stylesheet">
    <link href="<?php echo $cdnserver ?>assets/css/pace.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $cdnserver ?>assets/css/common.css?ver=<?php echo VERSION ?>">
    <!--[if lt IE 9]>
    <script src="<?php echo $cdnpublic ?>html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="<?php echo $cdnpublic ?>respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
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
                <button type="button" class="btn btn-default" data-dismiss="modal">?????????</button>
            </div>
        </div>
    </div>
</div>

<div id="container" class="effect aside-float aside-bright mainnav-lg">
    <header id="navbar">
        <div id="navbar-container" class="boxed">
            <div class="navbar-header">
                <a href="./" class="navbar-brand">
                    <img src="<?php echo $logo ?>" alt="<?php echo $conf['sitename'] ?>" class="brand-icon">
                    <div class="brand-title">
                        <span class="brand-text"><?php echo $conf['sitename'] ?></span>
                    </div>
                </a>
            </div>

            <div class="navbar-content clearfix">
                <ul class="nav navbar-top-links pull-left">
                    <li class="tgl-menu-btn">
                        <a class="mainnav-toggle" href="#">
                            <i class="fa fa-th-list"></i>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a data-toggle="modal" href="#kaurl" class="dropdown-toggle">
                            <i class="fa fa-credit-card"></i>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a data-toggle="modal" href="#cxdd" class="dropdown-toggle">
                            <i class="fa fa-search"></i>
                        </a>
                    </li>
                </ul>

                <ul class="nav navbar-top-links pull-right">
                    <li class="dropdown">
                        <a data-toggle="modal" href="#lqq" class="dropdown-toggle">
                            <i class="fa fa-circle-o-notch"></i>
                        </a>
                    </li>
                    <li class="dropdown" class="active-link" style="display:none;">
                        <a data-toggle="modal" href="#ltjl" class="dropdown-toggle">
                            <i class="fa fa-coffee"></i>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq'] ?>&site=qq&menu=yes">
                            <i class="fa fa-qq"></i>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </header>

    <div class="boxed">
        <div id="content-container">
            <div id="page-content">
                <div class="row">

                    <div class="row" <?php if ($conf['hide_tongji'] == 1){ ?>style="display:none;"<?php } ?>>
                        <div class="col-xs-6">
                            <div class="panel media middle">
                                <div class="media-left bg-primary pad-all">
                                    <span class="fa fa-shopping-cart fa-3x"></span>
                                </div>
                                <div class="media-body pad-lft">
                                    <p class="text-2x mar-no"><span id="count_orders_all"></span></p>
                                    <p class="text-muted mar-no">????????????</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel media middle">
                                <div class="media-left bg-primary pad-all">
                                    <i class="fa fa-check-square-o fa-3x"></i>
                                </div>
                                <div class="media-body pad-lft">
                                    <p class="text-2x mar-no"><span id="count_orders_today"></span></p>
                                    <p class="text-muted mar-no">????????????</p>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="panel panel-success">
                        <div class="panel-heading"><h3 class="panel-title"><font color="#fff"><i
                                            class="fa fa-volume-up"></i>&nbsp;&nbsp;<b>????????????</b></font></h3></div>
                        <div>
                            <?php echo $conf['anounce'] ?>
                        </div>
                    </div>

                    <div class="tab-content">
                        <div id="demo-tabs-box-1" class="tab-pane fade active in">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><font color="#fff"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;<b>????????????</b></font><span
                                                class="pull-right"><a data-toggle="tab" href="#demo-tabs-box-2"
                                                                      aria-expanded="true"
                                                                      class="btn btn-warning btn-rounded"><i
                                                        class="fa fa-warning"></i> ??????</a></span></h3>
                                </div>
                                <div class="panel-body">
                                    <div class="tab-pane fade in active" id="onlinebuy">
                                        <?php include TEMPLATE_ROOT . 'default/shop.inc.php'; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="demo-tabs-box-2" class="tab-pane fade">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><font color="#fff"><i
                                                    class="fa fa-warning"></i>&nbsp;&nbsp;<b>????????????</b></font><span
                                                class="pull-right"><a
                                                    data-toggle="tab" href="#demo-tabs-box-1" aria-expanded="false"
                                                    class="btn btn-warning btn-rounded"><i
                                                        class="fa fa-shopping-cart"></i> ??????</a>
				</span></h3>
                                </div>
                                <div class="panel-body">
                                    <!--????????????-->
                                    <div id="demo-acc-faq" class="panel-group accordion">
                                        <div class="panel panel-trans pad-top"><a href="#demo-acc-faq1"
                                                                                  class="text-semibold text-lg text-main"
                                                                                  data-toggle="collapse"
                                                                                  data-parent="#demo-acc-faq">????????????????????????????????????????????????</a>
                                            <div id="demo-acc-faq1" class="mar-ver collapse in">
                                                ??????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????24?????????????????????????????????
                                            </div>
                                        </div>
                                        <div class="panel panel-trans pad-top"><a href="#demo-acc-faq2"
                                                                                  class="text-semibold text-lg text-main"
                                                                                  data-toggle="collapse"
                                                                                  data-parent="#demo-acc-faq">??????????????????????????????</a>
                                            <div id="demo-acc-faq2" class="mar-ver collapse">
                                                1.?????????????????????????????????????????????,????????????1~4???????????????!<br>2.????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????
                                            </div>
                                        </div>
                                        <div class="panel panel-trans pad-top"><a href="#demo-acc-faq3"
                                                                                  class="text-semibold text-lg text-main"
                                                                                  data-toggle="collapse"
                                                                                  data-parent="#demo-acc-faq">?????????????????????????????????</a>
                                            <div id="demo-acc-faq3" class="mar-ver collapse">
                                                1.?????????????????????????????????????????????,????????????1???????????????!???????????????????????????<br>2.??????QQ?????????????????????QQ????????????????????????????????????ID?????????????????????????????????ID??????????????????<br>3.????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????
                                            </div>
                                        </div>
                                        <div class="panel panel-trans pad-top"><a href="#demo-acc-faq4"
                                                                                  class="text-semibold text-lg text-main"
                                                                                  data-toggle="collapse"
                                                                                  data-parent="#demo-acc-faq">??????????????????????????????</a>
                                            <div id="demo-acc-faq4" class="mar-ver collapse">1.??????????????????k???<br>2.???????????????k????????????????????????????????????<br>3.??????????????????????????????<font
                                                        color="#ff0000">https://kg.qq.com/node/play?s= <font
                                                            color="green">881Zbk8aCfIwA8U3</font>
                                                    &g_f=personal</font><br>4.?????????s=????????? <font color="green">881Zbk8aCfIwA8U3</font>
                                                ?????????????????????ID??????????????????????????????
                                            </div>
                                        </div>
                                        <div class="panel panel-trans pad-top"><a href="#demo-acc-faq5"
                                                                                  class="text-semibold text-lg text-main"
                                                                                  data-toggle="collapse"
                                                                                  data-parent="#demo-acc-faq">KF????????????????????????</a>
                                            <div id="demo-acc-faq5" class="mar-ver collapse">1.??????????????????ID?????????ID?????????<font
                                                        color="#ff0000">http://www.kuaishou.com/i/photo/lwx?userId=
                                                    <font color="green">294200023</font> &photoId= <font color="green">1071823418</font></font>
                                                (????????????????????????????????????????????????)<br>2.??????ID?????? <font color="green">294200023</font>
                                                ??????ID?????? <font color="green">1071823418</font>
                                                ???????????????????????????ID?????????ID????????????????????????????????????????????????????????????
                                            </div>
                                        </div>
                                        <div class="panel panel-trans pad-top"><a href="#demo-acc-faq6"
                                                                                  class="text-semibold text-lg text-main"
                                                                                  data-toggle="collapse"
                                                                                  data-parent="#demo-acc-faq">Q??????/?????????????????????</a>
                                            <div id="demo-acc-faq6" class="mar-ver collapse">
                                                1.?????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????<br>2.Q??????/????????????????????????????????????????????????????????????24??????-48??????????????????
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="panel panel-success panel-colorful">
                                <div class="pad-all media">
                                    <div class="media-left">
                                        <i class="demo-pli-coin icon-3x icon-fw"></i>
                                    </div>
                                    <div class="media-body">
                                        <p class="h3 text-light mar-no media-heading"><span id="count_money"></span>???
                                        </p>
                                        <span>??????????????????</span>
                                    </div>
                                </div>
                                <div class="progress progress-xs progress-success mar-no">
                                    <div class="progress-bar progress-bar-light" style="width: 100%"></div>
                                </div>
                                <div class="pad-all text-sm">
                                    ?????????????????? <span class="text-semibold" id="count_money1"></span> ???
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="panel panel-info panel-colorful">
                                <div class="pad-all media">
                                    <div class="media-left">
                                        <i class="demo-pli-add-cart icon-3x icon-fw"></i>
                                    </div>
                                    <div class="media-body">
                                        <p class="h3 text-light mar-no media-heading"><span id="count_orders"></span>???
                                        </p>
                                        <span>??????????????????</span>
                                    </div>
                                </div>
                                <div class="progress progress-xs progress-dark-base mar-no">
                                    <div class="progress-bar progress-bar-light" style="width: 100%"></div>
                                </div>
                                <div class="pad-all text-sm bg-trans-dark">
                                    ?????????????????? <span class="text-semibold" id="count_orders2"></span> ???
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-primary"
                         <?php if ($conf['bottom'] == ''){ ?>style="display:none;"<?php } ?>>
                        <div class="panel-heading"><h3 class="panel-title"><font color="#fff"><i
                                            class="fa fa-skyatlas"></i>&nbsp;&nbsp;<b>????????????</b></font></h3></div>
                        <?php echo $conf['bottom'] ?>
                    </div>
                </div>
            </div>
        </div>

        <nav id="mainnav-container">
            <div id="mainnav">
                <div id="mainnav-menu-wrap">
                    <div class="nano">
                        <div class="nano-content">
                            <div id="mainnav-profile" class="mainnav-profile">
                                <div class="profile-wrap">
                                    <div class="pad-btm">
                                        <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq'] ?>&site=qq&menu=yes"
                                           class="label label-success pull-right">????????????</a>
                                        <img class="img-circle img-sm img-border"
                                             src="http://q2.qlogo.cn/headimg_dl?bs=qq&dst_uin=<?php echo $conf['kfqq'] ?>&src_uin=<?php echo $conf['kfqq'] ?>&fid=<?php echo $conf['kfqq'] ?>&spec=100&url_enc=0&referer=bu_interface&term_type=PC"
                                             alt="Profile Picture">
                                    </div>
                                    <p class="mnp-name">??????QQ???<?php echo $conf['kfqq'] ?></p>
                                </div>
                            </div>

                            <ul id="mainnav-menu" class="list-group">
                                <li class="list-header"><?php echo $_SERVER['HTTP_HOST'] ?></li>
                                <li class="active-link">
                                    <a href="./">
                                        <i class="fa fa-th-large"></i>
                                        <span class="menu-title">
												<strong>????????????</strong>
											</span>
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="modal" href="#kaurl">
                                        <i class="fa fa-credit-card"></i>
                                        <span class="menu-title">
												<strong>????????????</strong>
											</span>
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="modal" href="#cxdd">
                                        <i class="fa fa-search"></i>&nbsp;
                                        <span class="menu-title">
												<strong>????????????</strong>
											</span>
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="modal" href="#gift">
                                        <i class="fa fa-gift"></i>&nbsp;
                                        <span class="menu-title">
												<strong>????????????</strong>
											</span>
                                    </a>
                                </li>
                                <li <?php if (empty($conf['daiguaurl'])){ ?>style="display:none;"<?php } ?>>
                                    <a href="./?mod=daigua">
                                        <i class="fa fa-rocket"></i>&nbsp;
                                        <span class="menu-title">
												<strong>????????????</strong>
											</span>
                                    </a>
                                </li>
                                <li <?php if (empty($conf['chatframe'])){ ?>style="display:none;"<?php } ?>>
                                    <a data-toggle="modal" href="#ltjl">
                                        <i class="fa fa-coffee"></i>&nbsp;
                                        <span class="menu-title">
												<strong>????????????</strong>
											</span>
                                    </a>
                                </li>
                                <?php if ($conf['fenzhan_buy'] == 1) { ?>
                                    <li>
                                        <a data-toggle="modal" href="./user/regsite.php">
                                            <i class="fa fa-diamond"></i>&nbsp;
                                            <span class="diamond">
												<strong>????????????</strong>
											</span>
                                        </a>
                                    </li>
                                <?php } ?>
                                <?php if ($islogin2 == 1) { ?>
                                    <li>
                                        <a data-toggle="modal" href="./user">
                                            <i class="fa fa-expeditedssl"></i>&nbsp;
                                            <span class="menu-title">
												<strong>????????????</strong>
											</span>
                                        </a>
                                    </li>
                                <?php } else { ?>
                                    <li>
                                        <a data-toggle="modal" href="./user">
                                            <i class="fa fa-expeditedssl"></i>&nbsp;
                                            <span class="menu-title">
												<strong>????????????</strong>
											</span>
                                        </a>
                                    </li>
                                <?php } ?>
                                <li>
                                    <a href="index.php?mod=gywm">
                                        <i class="fa fa fa-heart-o"></i>&nbsp;
                                        <span class="menu-title">
												<strong>????????????</strong>
											</span>
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="modal"
                                       href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq'] ?>&site=qq&menu=yes">
                                        <i class="fa fa-user-o"></i>&nbsp;
                                        <span class="menu-title">
												<strong>????????????</strong>
											</span>
                                    </a>
                                </li>


                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <div class="modal fade" id="kaurl" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i>
                    </button>
                    <h4 class="modal-title"><i class="fa fa-credit-card"></i> ????????????</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="btn-group btn-group-justified">
                            <a class="btn btn-primary" href="<?php echo $conf['kaurl'] ?>" target="_blank"/><span
                                    class="fa fa-cart-plus fa-3x"></span></br><b>??????????????????</b></a>                <a
                                    class="btn btn-info"
                                    href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq'] ?>&site=qq&menu=yes"><span
                                        class="fa fa-qq fa-3x"></span></br><b>??????????????????</b></a>
                        </div>
                    </div>
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
                                <div class="input-group-addon" id="inputname">????????????</div>
                                <input type="text" name="name" id="km_name" value="" class="form-control" disabled/>
                            </div>
                        </div>
                        <div id="km_inputsname"></div>
                        <div id="km_alert_frame" class="alert alert-warning"
                             style="display:none;font-weight: bold;"></div>
                        <input type="submit" id="submit_card" class="btn btn-primary btn-block" value="????????????">
                        <div id="result1" class="form-group text-center" style="display:none;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">??????</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cxdd" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i>
                    </button>
                    <h4 class="modal-title"><i class="fa fa-search"></i> ????????????</h4>
                </div>
                <div class="modal-body">
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
                            <input type="text" name="qq" id="qq3" value="" class="form-control"
                                   placeholder="????????????????????????????????????????????????????????????"
                                   onkeydown="if(event.keyCode==13){submit_query.click()}" required/>
                            <span class="input-group-btn"><a href="#cxsm" data-toggle="modal" class="btn btn-warning"><i
                                            class="glyphicon glyphicon-exclamation-sign"></i></a></span>
                        </div>
                    </div>
                    <input type="submit" id="submit_query" class="btn btn-primary btn-block" value="????????????">
                    <div id="result2" class="form-group text-center" style="display:none;">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>??????</th>
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
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">??????</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="lqq" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i>
                    </button>
                    <h4 class="modal-title"><i class="fa fa-circle-o"></i> ???????????????99+</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success">????????????QQ???????????????99+?????????QQ?????????????????????</div>
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
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">??????</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="gift" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i>
                    </button>
                    <h4 class="modal-title"><i class="fa fa-comments-o"></i> ??????</h4>
                </div>
                <div class="modal-body">
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
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">??????</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ltjl" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i>
                    </button>
                    <h4 class="modal-title"><i class="fa fa-comments-o"></i> ????????????</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">????????????????????????????????????Bug???????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????
                    </div>
                    <?php echo $conf['chatframe'] ?>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">??????</button>
                </div>
            </div>
        </div>
    </div>
    <!--??????????????????-->
    <div class="modal fade" align="left" id="cxsm" tabindex="-1" role="dialog" aria-labelledby="demo-default-modal"
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

    <footer id="footer">
        <div class="hide-fixed pull-right pad-rgt">
            <strong></strong>
        </div>
        <p class="pad-lft">&#0169; 2019 <?php echo $conf['sitename'] ?></p>

    </footer>

    <button class="scroll-top btn">
        <i class="pci-chevron chevron-up"></i>
    </button>

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
<script src="<?php echo $cdnserver ?>assets/js/pace.min.js"></script>
<script src="<?php echo $cdnserver ?>assets/js/nifty.min.js"></script>

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