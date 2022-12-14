<?php
if (!defined('IN_CRONLITE')) exit();
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8"/>
    <title><?php echo $conf['sitename'] ?> - <?php echo $conf['title'] ?></title>
    <meta name="keywords" content="<?php echo $conf['keywords'] ?>">
    <meta name="description" content="<?php echo $conf['description'] ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>

    <link href="<?php echo $cdnpublic ?>twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="<?php echo $cdnpublic ?>font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link type="text/css" href="/assets/user/css/load.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?php echo $cdnpublic ?>animate.css/3.5.2/animate.min.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo $cdnpublic ?>simple-line-icons/2.4.1/css/simple-line-icons.min.css"
          type="text/css"/>
    <link rel="stylesheet" href="https://template.down.swap.wang/ui/angulr_2.0.1/html/css/font.css" type="text/css"/>
    <link rel="stylesheet" href="https://template.down.swap.wang/ui/angulr_2.0.1/html/css/app.css" type="text/css"/>
    <link rel="stylesheet" href="https://admin.down.swap.wang/assets/plugins/toastr/toastr.min.css" type="text/css"/>
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
<div class="app app-header-fixed  ">
    <!-- header -->
    <header id="header" class="app-header navbar" role="menu">
        <!-- navbar header -->
        <div class="navbar-header bg-dark">
            <button class="pull-right visible-xs dk" ui-toggle="show" target=".navbar-collapse">
                <i class="glyphicon glyphicon-cog"></i>
            </button>
            <button class="pull-right visible-xs" ui-toggle="off-screen" target=".app-aside" ui-scroll="app">
                <i class="glyphicon glyphicon-align-justify"></i>
            </button>
            <!-- brand -->
            <a href="/" class="navbar-brand text-lt">

                <i class="fa fa-qq"></i>
                <span class="hidden-folded m-l-xs"><?php echo $conf['sitename'] ?></span>
            </a>
            <!-- / brand -->
        </div>
        <!-- / navbar header -->
        <!-- navbar collapse -->
        <div class="collapse pos-rlt navbar-collapse box-shadow bg-white-only">
            <!-- buttons -->
            <div class="nav navbar-nav hidden-xs">
                <a href="#" class="btn no-shadow navbar-btn" ui-toggle="app-aside-folded" target=".app">
                    <i class="fa fa-dedent fa-fw text"></i>
                    <i class="fa fa-indent fa-fw text-active"></i>
                </a>
            </div>

            <!-- / buttons -->

            <!-- nabar right -->
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle clear" data-toggle="dropdown">
              <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">
                <img src="<?php echo ($islogin2 == 1) ? '//q2.qlogo.cn/headimg_dl?bs=qq&dst_uin=' . $userrow['qq'] . '&src_uin=' . $userrow['qq'] . '&fid=' . $userrow['qq'] . '&spec=100&url_enc=0&referer=bu_interface&term_type=PC' : 'assets/img/user.png' ?>">
                <i class="on md b-white bottom"></i>
              </span>
                        <span class="hidden-sm hidden-md"
                              style="text-transform:uppercase;"><?php echo $conf['sitename'] ?></span> <b
                                class="caret"></b>
                    </a>
                    <!-- dropdown -->
                    <ul class="dropdown-menu animated fadeInRight w">
                        <?php if ($islogin2 == 1) { ?>
                            <li>
                                <a href="./user/">
                                    <i class="fa fa-user fa-fw pull-right"></i>
                                    ????????????
                                </a>
                            </li>
                            <li>
                                <a href="./user/uset.php?mod=user">
                                    <i class="fa fa-pencil-square fa-fw pull-right"></i>
                                    ????????????
                                </a>
                            </li>
                            <li class="divider">
                            </li>
                            <li>
                                <a href="./user/login.php?logout">
                                    <i class="fa fa-power-off fa-fw pull-right"></i>
                                    ????????????
                                </a>
                            </li>
                        <?php } else { ?>
                            <li>
                                <a href="./user/login.php">
                                    <i class="fa fa-user fa-fw pull-right"></i>
                                    ??????
                                </a>
                            </li>
                            <li>
                                <a href="./user/reg.php">
                                    <i class="fa fa-plus-circle fa-fw pull-right"></i>
                                    ??????
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                    <!-- / dropdown -->
                </li>
            </ul>
            <!-- / navbar right -->
        </div>
        <!-- / navbar collapse -->
    </header>
    <!-- / header -->
    <!-- aside -->
    <aside id="aside" class="app-aside hidden-xs bg-dark">
        <div class="aside-wrap">
            <div class="navi-wrap">

                <!-- nav -->
                <nav ui-nav class="navi clearfix">
                    <ul class="nav">
                        <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                            <span>??????</span>
                        </li>
                        <li>
                            <a href="./">
                                <i class="glyphicon glyphicon-home icon text-primary-dker"></i>
                                <b class="label bg-info pull-right">???</b>
                                <span class="font-bold">????????????</span>
                            </a>
                        </li>

                        <li>
                            <a href class="auto">
                  <span class="pull-right text-muted">
                    <i class="fa fa-fw fa-angle-right text"></i>
                    <i class="fa fa-fw fa-angle-down text-active"></i>
                  </span>
                                <i class="glyphicon glyphicon-leaf icon text-success-lter"></i>
                                <span>????????????</span>
                            </a>
                            <ul class="nav nav-sub dk">
                                <li class="nav-sub-header">
                                    <a href>
                                        <span>????????????</span>
                                    </a>
                                </li>
                                <li><a href="./user"><span class="sidebar-nav-mini-hide">????????????</span></a></li>
                                <li><a href="./admin"><span class="sidebar-nav-mini-hide">????????????</span></a></li>
                            </ul>
                        </li>


                        <li class="line dk"></li>
                        <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                            <span>??????</span>
                            <?php if ($conf['fenzhan_buy'] == 1){ ?>
                        </li>
                        <li>
                            <a href="index.php?mod=fzjs">
                                <i class="glyphicon glyphicon-send"></i>
                                <span>????????????</span>
                            </a>
                        </li>
                        </li>
                        <li>
                            <a href="user/regsite.php">
                                <i class="glyphicon glyphicon-shopping-cart"></i>
                                <span>????????????</span>
                            </a>
                        </li>
                        <?php } ?>
                        <?php if (!empty($conf['invite_tid'])) { ?>
                            <li><a target="_blank" href="./?mod=invite"><i class="fa fa-gift sidebar-nav-icon"></i><span
                                            class="sidebar-nav-mini-hide">????????????</span></a></li>
                        <?php } ?>
                        <?php if (!empty($conf['appurl'])) { ?>
                            <li><a target="_blank" href="<?php echo $conf['appurl']; ?>"><i
                                            class="fa fa-android sidebar-nav-icon"></i><span
                                            class="sidebar-nav-mini-hide">APP??????</span></a></li>
                        <?php } ?>
                        <li class="line dk hidden-folded"></li>

                        <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                            <span>??????</span>
                        </li>
                        <li>
                            <a href="//wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['qq'] ? $conf['qq'] : $conf['kfqq'] ?>&site=qq&menu=yes">
                                <i class="glyphicon glyphicon-info-sign"></i>
                                <span>????????????</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- nav -->
                <!-- aside footer -->
                <div class="wrapper m-t">
                    <div class="text-center-folded">
                        <span class="pull-right pull-none-folded">60%</span>
                        <span class="hidden-folded">Milestone</span>
                    </div>
                    <div class="progress progress-xxs m-t-sm dk">
                        <div class="progress-bar progress-bar-info" style="width: 60%;">
                        </div>
                    </div>
                    <div class="text-center-folded">
                        <span class="pull-right pull-none-folded">35%</span>
                        <span class="hidden-folded">Release</span>
                    </div>
                    <div class="progress progress-xxs m-t-sm dk">
                        <div class="progress-bar progress-bar-primary" style="width: 35%;">
                        </div>
                    </div>
                </div>
                <!-- / aside footer -->
            </div>
        </div>
    </aside>
    <!-- / aside -->
    <!-- content -->
    <div id="content" class="app-content" role="main">
        <div class="app-content-body ">
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
                        <li class="list-group-item">???????????????????????????K??????????????????????????????????????????shareuid=???????????????&amp;??????????????????????????????????????????????????????????????????
                        </li>
                        <li class="list-group-item"><font color="red">??????????????????????????????????????????????????????????????????????????????????????????????????????????????????</font></li>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">??????</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--??????????????????-->

            <div class="bg-light lter b-b wrapper-md hidden-print">
                <h1 class="m-n font-thin h3">????????????</h1>
            </div>
            <div class="wrapper-md" ng-controller="FlotChartDemoCtrl">
                <div class="modal fade" align="left" id="myModal" tabindex="-1" role="dialog"
                     aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><i
                                            class="pci-cross pci-circle"></i></button>
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
                <!-- stats -->
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="panel panel-info" draggable="true">
                            <div class="panel-heading font-bold">????????????</div>
                            <div class="panel-body">
                                <?php echo $conf['anounce'] ?>                             </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">

                        <div class="panel panel-info" draggable="true">
                            <div class="panel-heading font-bold">????????????</div>
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#onlinebuy" data-toggle="tab">????????????</a></li>
                                <li <?php if ($conf['iskami'] == 0){ ?>class="hide"<?php } ?>><a href="#cardbuy"
                                                                                                 data-toggle="tab">????????????</a>
                                </li>
                                <li><a href="#query" data-toggle="tab" id="tab-query">????????????</a></li>
                                <li <?php if ($conf['gift_open'] == 0){ ?>class="hide"<?php } ?>><a href="#gift"
                                                                                                    data-toggle="tab">??????</a>
                                </li>
                            </ul>
                            <div class="list-group-item">
                                <div id="myTabContent" class="tab-content">
                                    <div class="tab-pane fade in active" id="onlinebuy">
                                        <?php include TEMPLATE_ROOT . 'default/shop.inc.php'; ?>
                                    </div>
                                    <div class="tab-pane fade in" id="cardbuy">
                                        <?php if (!empty($conf['kaurl'])) { ?>
                                            <div class="form-group">
                                                <a href="<?php echo $conf['kaurl'] ?>" class="btn btn-default btn-block"
                                                   target="_blank"/>????????????????????????</a>
                                            </div>
                                        <?php } ?>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">????????????</div>
                                                <input type="text" name="km" id="km" value="" class="form-control"
                                                       onkeydown="if(event.keyCode==13){submit_checkkm.click()}"
                                                       required/>
                                            </div>
                                        </div>
                                        <input type="submit" id="submit_checkkm" class="btn btn-primary btn-block"
                                               value="????????????">
                                        <div id="km_show_frame" style="display:none;">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon">????????????</div>
                                                    <input type="text" name="name" id="km_name" value=""
                                                           class="form-control" disabled/>
                                                </div>
                                            </div>
                                            <div id="km_inputsname"></div>
                                            <div id="km_alert_frame" class="alert alert-warning"
                                                 style="display:none;"></div>
                                            <input type="submit" id="submit_card" class="btn btn-primary btn-block"
                                                   value="????????????">
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
                                                    <select class="form-control" id="searchtype"
                                                            style="padding: 6px 4px;width:90px">
                                                        <option value="0">????????????</option>
                                                        <option value="1">?????????</option>
                                                    </select>
                                                </div>
                                                <input type="text" name="qq" id="qq3" value="<?php echo $qq ?>"
                                                       class="form-control" placeholder="????????????????????????????????????????????????????????????"
                                                       onkeydown="if(event.keyCode==13){submit_query.click()}"
                                                       required/>
                                                <span class="input-group-btn"><a href="#cxsm" data-toggle="modal"
                                                                                 class="btn btn-warning"><i
                                                                class="glyphicon glyphicon-exclamation-sign"></i></a></span>
                                            </div>
                                        </div>
                                        <input type="submit" id="submit_query" class="btn btn-primary btn-block"
                                               value="????????????">
                                        <div id="result2" class="form-group text-center" style="display:none;">
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
                                                <input type="text" name="qq" id="qq4" value="" class="form-control"
                                                       required/>
                                            </div>
                                        </div>
                                        <input type="submit" id="submit_lqq" class="btn btn-primary btn-block"
                                               value="????????????">
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
                                    <div class="tab-pane fade in" id="kg">
                                        <div class="tab-pane fade in active">
                                            <div class="form-group">
                                                <input type="text" name="url" id="url" value="" class="form-control"
                                                       placeholder="??????????????????????????????" required="">
                                            </div>
                                            <div class="form-group" style="display:none;" id="song_v">
                                                <div class="input-group">
                                                    <div class="input-group-addon">??????ID</div>
                                                    <input type="text" id="songid" value="" class="form-control"
                                                           required="">
                                                </div>
                                            </div>
                                            <input type="submit" onclick="getsongid()" id="getsongid"
                                                   class="btn btn-info btn-block" value="????????????">
                                        </div>
                                        <div class="panel-footer">
                                            <span class="glyphicon glyphicon-info-sign"></span>
                                            ????????????K???-????????????-??????-????????????
                                        </div>
                                        <div class="tab-pane fade in" id="ks">
                                            <div class="tab-pane fade in active">
                                                <div class="form-group">
                                                    <input type="text" id="kuaishou_url" value="" class="form-control"
                                                           placeholder="?????????KF????????????" required="">
                                                </div>
                                                <div style="display:none;" id="kuaishou_v">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">??????ID</div>
                                                            <input type="text" id="anotherid" value=""
                                                                   class="form-control" required="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">??????ID</div>
                                                            <input type="text" id="videoid" value=""
                                                                   class="form-control" required="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="submit" onclick="getkuaishouid()" id="getkuaishouid"
                                                       class="btn btn-danger btn-block" value="????????????">
                                            </div>
                                            <div class="panel-footer">
                                                <span class="glyphicon glyphicon-info-sign"></span>
                                                ??????KF?????????????????????????????????????????????

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6"
                         <?php if ($conf['hide_tongji'] == 1){ ?>style="display:none;"<?php } ?>>
                        <div class="panel panel-info" draggable="true">
                            <div class="panel-heading font-bold">??????????????????</div>
                            <div class="panel-body text-center">

                                <div class="col-sm-6">
                                    <div class="block panel padder-v bg-primary item">
                                        <span class="text-white font-thin h1 block" id="count_yxts"></span>
                                        <span class="text-muted text-xs">????????????</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="block panel padder-v bg-info item">
                                        <span class="text-white font-thin h1 block" id="count_orders"></span>
                                        <span class="text-muted text-xs">????????????</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="block panel padder-v bg-success item">
                                        <span class="text-white font-thin h1 block" id="count_orders1"></span>
                                        <span class="text-muted text-xs">????????????</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="block panel padder-v bg-dark item">
                                        <span class="text-white font-thin h1 block" id="count_money"></span>
                                        <span class="text-muted text-xs">????????????</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="col-lg-6 col-md-6" <?php if ($conf['bottom'] == ''){ ?>style="display:none;"<?php } ?>>
                        <div class="panel panel-info" draggable="true">
                            <div class="panel-heading font-bold">????????????</div>
                            <?php echo $conf['bottom'] ?>
                        </div>
                    </div>

                    <!-- / stats -->
                </div>
            </div>
            <!-- footer -->
            <footer id="footer" class="app-footer" role="footer">
                <div class="wrapper b-t bg-light">
                    <span class="pull-right">Powered by <a href="/" target="_blank"><?php echo $conf['sitename'] ?></a></span>
                    &copy; 2019 Copyright.
                </div>
            </footer>
            <!-- / footer -->

        </div>
    </div>
    <!--????????????-->
    <section class="u-audio hidden" data-src="<?php echo $conf['musicurl'] ?>"></section>
    <div id="audio-play" <?php if (empty($conf['musicurl'])){ ?>style="display:none;"<?php } ?>>
        <div id="audio-btn" class="on" onclick="audio_init.changeClass(this,'media')">
            <audio loop="loop" src="<?php echo $conf['musicurl'] ?>" id="media" preload="preload"></audio>
        </div>
    </div>
    <!--????????????-->
    <script src="<?php echo $cdnpublic ?>jquery/2.2.4/jquery.min.js"></script>
    <script src="<?php echo $cdnpublic ?>jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script>
    <script src="<?php echo $cdnpublic ?>twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://template.down.swap.wang/ui/angulr_2.0.1/html/js/ui-load.js"></script>
    <script src="https://template.down.swap.wang/ui/angulr_2.0.1/html/js/ui-jp.config.js"></script>
    <script src="https://template.down.swap.wang/ui/angulr_2.0.1/html/js/ui-jp.js"></script>
    <script src="https://template.down.swap.wang/ui/angulr_2.0.1/html/js/ui-nav.js"></script>
    <script src="https://template.down.swap.wang/ui/angulr_2.0.1/html/js/ui-toggle.js"></script>

    <script src="<?php echo $cdnpublic ?>jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="<?php echo $cdnpublic ?>layer/2.3/layer.js"></script>
    <script type="text/javascript">
        function getsongid() {
            var songurl = $("#url").val();
            if (songurl == '') {
                alert('??????????????????????????????');
                return false;
            }
            if (songurl.indexOf('.qq.com') < 0) {
                alert('??????????????????????????????????????????');
                return false;
            }
            $('#song_v').hide();
            var songid = songurl.split('s=')[1].split('&')[0];
            $('#songid').val(songid);
            $('#song_v').slideDown();
        }

        function getkuaishouid() {
            var kuauishouurl = $("#kuaishou_url").val();
            if (kuauishouurl == '') {
                alert('??????????????????????????????');
                return false;
            }
            if (kuauishouurl.indexOf('gifshow.com') < 0 && kuauishouurl.indexOf('kuaishou.com') < 0) {
                alert('??????????????????KF???????????????');
                return false;
            }
            $('#kuaishou_v').hide();
            if (kuauishouurl.indexOf('userId=') > 0) {
                var anotherid = kuauishouurl.split('userId=')[1].split('&')[0];
            } else {
                var anotherid = kuauishouurl.split('photo/')[1].split('/')[0];
            }
            if (kuauishouurl.indexOf('photoId=') > 0) {
                var videoid = kuauishouurl.split('photoId=')[1].split('&')[0];
            } else {
                var videoid = kuauishouurl.split('photo/')[1].split('/')[1].split('?')[0];
            }
            $('#anotherid').val(anotherid);
            $('#videoid').val(videoid);
            $('#kuaishou_v').slideDown();
        }
    </script>

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