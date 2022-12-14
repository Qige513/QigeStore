<?php
if (!defined('IN_CRONLITE')) exit();

$thtime = date("Y-m-d") . ' 00:00:00';
$count1 = $DB->count('site');
$count2 = $DB->count('site', ['addtime[>=]' => $thtime]);
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
    <link href="<?php echo $cdnserver ?>assets/css/nifty.min.css" rel="stylesheet">
    <link href="<?php echo $cdnserver ?>assets/css/magic-check.min.css" rel="stylesheet">
    <link href="<?php echo $cdnserver ?>assets/css/pace.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="<?php echo $cdnpublic ?>html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="<?php echo $cdnpublic ?>respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
    <style>
        img.logo {
            width: 14px;
            height: 14px;
            margin: 0 5px 0 3px;
        }

        .onclick {
            cursor: pointer;
            touch-action: manipulation;
        }
    </style>
</head>
<body>

<div id="container" class="effect aside-float aside-bright mainnav-lg">
    <header id="navbar">
        <div id="navbar-container" class="boxed">
            <div class="navbar-header">
                <a href="./" class="navbar-brand">
                    <img src="<?php echo $logo; ?>" alt="<?php echo $conf['sitename'] ?>" class="brand-icon">
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

                    <div class="panel">
                        <div class="panel-body text-center">
                            <img alt="Profile Picture" class="img-lg img-circle mar-btm" src="assets/img/logo2.png">
                            <p class="text-lg text-semibold mar-no text-main"><?php echo $conf['sitename'] ?></p>
                            <p class="text-muted">???????????????<?php echo $_SERVER['HTTP_HOST'] ?></p>
                            <div class="mar-top">
                                <ul class="list-unstyled text-center bord-top pad-top mar-no row">
                                    <li class="col-xs-4">
                                        <span class="text-lg text-semibold text-main" id="count_yxts"></span>???
                                        <p class="text-muted mar-no">????????????</p>
                                    </li>
                                    <li class="col-xs-4">
                                        <span class="text-lg text-semibold text-main"><?php echo $count2 ?></span>???
                                        <p class="text-muted mar-no">????????????</p>
                                    </li>
                                    <li class="col-xs-4">
                                        <span class="text-lg text-semibold text-main"><?php echo $count1 ?></span>???
                                        <p class="text-muted mar-no">????????????</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row" <?php if ($conf['hide_tongji'] == 1){ ?>style="display:none;"<?php } ?>>
                    <div class="panel panel-success panel-colorful">
                        <div class="pad-all media">
                            <div class="media-left">
                                <i class="demo-pli-coin icon-3x icon-fw"></i>
                            </div>
                            <div class="media-body">
                                <p class="h3 text-light mar-no media-heading"><span id="count_money"></span>???</p>
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
                <div class="row">
                    <div class="panel panel-info panel-colorful">
                        <div class="pad-all media">
                            <div class="media-left">
                                <i class="demo-pli-add-cart icon-3x icon-fw"></i>
                            </div>
                            <div class="media-body">
                                <p class="h3 text-light mar-no media-heading"><span id="count_orders"></span>???</p>
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
                <div class="row">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">????????? <font color="#FFFFFF"><i class="fa fa-heart-o fa-lg"></i></font>
                                ??????
                                <div class="hide-fixed pull-right pad-rgt"><em>????????????<?php echo $conf['build'] ?></em>
                                </div>
                            </h3>
                        </div>
                        <div class="panel-body">
                            ????????????????????????????????????????????????????????????????????????????????????????????????
                            <hr>
                            ????????????????????????????????????????????????????????????????????????????????????????????????
                        </div>
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
                                <li>
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
                                <li>
                                    <a data-toggle="modal" href="./user/regsite.php">
                                        <i class="fa fa-diamond"></i>&nbsp;
                                        <span class="diamond">
												<strong>????????????</strong>
											</span>
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="modal" href="./user">
                                        <i class="fa fa-expeditedssl"></i>&nbsp;
                                        <span class="menu-title">
												<strong>????????????</strong>
											</span>
                                    </a>
                                </li>
                                <li class="active-link">
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
                            <a class="btn btn-primary" href="/" target="_blank"/><span
                                    class="fa fa-cart-plus fa-3x"></span></br><b>??????????????????</b></a>                <a
                                    class="btn btn-info"
                                    href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq'] ?>&site=qq&menu=yes"><span
                                        class="fa fa-qq fa-3x"></span></br><b>??????????????????</b></a>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">????????????</div>
                            <input type="text" name="km" id="km" value="" class="form-control" required/>
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
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon" id="inputname">????????????</div>
                                <input type="text" name="inputvalue" id="km_inputvalue" value="" class="form-control"
                                       required/>
                            </div>
                        </div>
                        <div id="km_inputsname"></div>
                        <div id="km_alert_frame" class="alert alert-warning" style="display:none;"></div>
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
                        <label for="password"><font color="#808080"><b>????????????</b></font></label>
                        <input type="text" name="qq" id="qq3" value="" class="form-control"
                               placeholder="????????????????????????????????????????????????????????????" required/>
                    </div>
                    <input type="submit" id="submit_query" class="btn btn-primary btn-block" value="????????????">
                    <div id="result2" class="form-group text-center" style="display:none;">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>??????</th>
                                <th>????????????</th>
                                <th>??????</th>
                                <th>????????????</th>
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

    <footer id="footer">
        <div class="hide-fixed pull-right pad-rgt">
            <strong></strong>
        </div>
        <p class="pad-lft">&#0169; 2017 <?php echo $conf['sitename'] ?></p>

    </footer>

    <button class="scroll-top btn">
        <i class="pci-chevron chevron-up"></i>
    </button>

</div>


<script src="<?php echo $cdnpublic ?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic ?>twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo $cdnpublic ?>jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="<?php echo $cdnpublic ?>layer/2.3/layer.js"></script>
<script src="<?php echo $cdnserver ?>assets/js/pace.min.js"></script>
<script src="<?php echo $cdnserver ?>assets/js/nifty.min.js"></script>

<script type="text/javascript">
    var isModal = false;
    var homepage = true;
    var hashsalt = '<?php echo $addsalt?>';
</script>
<script src="assets/js/main.js?ver=<?php echo VERSION ?>"></script>
</body>
</html>