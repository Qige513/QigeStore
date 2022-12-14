<?php
include_once 'head.php';
?>

<body>
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
                <button type="button" class="btn btn-default" data-dismiss="modal">知道啦</button>
            </div>
        </div>
    </div>
</div>
<!--查单说明开始-->
<div class="modal fade" align="left" id="cxsm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">查询内容是什么？该输入什么？</h4>
            </div>
            <li class="list-group-item"><font color="red">请在右侧的输入框内输入您下单时，在第一个输入框内填写的信息</font></li>
            <li class="list-group-item">例如您购买的是QQ名片赞，输入下单的QQ账号即可查询订单</li>
            <li class="list-group-item">例如您购买的是邮箱类商品，需要输入您的邮箱号，输入QQ号是查询不到的</li>
            <li class="list-group-item">例如您购买的是KF商品，需要输入作品链接里“userid=”后面的数字，输入KF号是一般是查询不到的</li>
            <li class="list-group-item">例如您购买的是全民K歌商品，需要输入歌曲链接里“shareuid=”后面的，&amp;前面的一串英文数字，输入歌曲链接是查询不到的</li>
            <li class="list-group-item"><font color="red">如果您不知道下单账号是什么，可以不填写，直接点击查询，则会根据浏览器缓存查询</font></li>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>
<!--查单说明结束-->
<!--版本介绍-->
<div class="modal fade" id="userjs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
     style="display: none;" align="left">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">版本介绍</h4></div>
            <div class="block">
                <div class="table-responsive">
                    <table class="table table-borderless table-vcenter">
                        <thead>
                        <tr>
                            <th style="width: 100px;">功能</th>
                            <th class="text-center" style="width: 20px;">普及版/专业版</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="active">
                            <td>专属代刷平台</td>
                            <td class="text-center"><span style="overflow: hidden; position: relative;"><i
                                            class="fa fa-check"></i></span><span
                                        style="overflow: hidden; position: relative;"><i class="fa fa-check"></i></span>
                            </td>
                        </tr>
                        <tr class="">
                            <td>三种在线支付接口</td>
                            <td class="text-center"><span style="overflow: hidden; position: relative;"><i
                                            class="fa fa-check"></i></span><span
                                        style="overflow: hidden; position: relative;"><i class="fa fa-check"></i></span>
                            </td>
                        </tr>
                        <tr class="success">
                            <td>专属网站域名</td>
                            <td class="text-center"><span style="overflow: hidden; position: relative;"><i
                                            class="fa fa-check"></i></span><span
                                        style="overflow: hidden; position: relative;"><i class="fa fa-check"></i></span>
                            </td>
                        </tr>
                        <tr class="">
                            <td>赚取用户提成</td>
                            <td class="text-center"><span style="overflow: hidden; position: relative;"><i
                                            class="fa fa-check"></i></span><span
                                        style="overflow: hidden; position: relative;"><i class="fa fa-check"></i></span>
                            </td>
                        </tr>
                        <tr class="info">
                            <td>赚取下级分站提成</td>
                            <td class="text-center"><span style="overflow: hidden; position: relative;"><i
                                            class="fa fa-close"></i></span><span
                                        style="overflow: hidden; position: relative;"><i class="fa fa-check"></i></span>
                            </td>
                        </tr>
                        <tr class="">
                            <td>设置商品价格</td>
                            <td class="text-center"><span style="overflow: hidden; position: relative;"><i
                                            class="fa fa-check"></i></span><span
                                        style="overflow: hidden; position: relative;"><i class="fa fa-check"></i></span>
                            </td>
                        </tr>
                        <tr class="warning">
                            <td>设置下级分站商品价格</td>
                            <td class="text-center"><span style="overflow: hidden; position: relative;"><i
                                            class="fa fa-close"></i></span><span
                                        style="overflow: hidden; position: relative;"><i class="fa fa-check"></i></span>
                            </td>
                        </tr>
                        <tr class="">
                            <td>搭建下级分站</td>
                            <td class="text-center"><span style="overflow: hidden; position: relative;"><i
                                            class="fa fa-close"></i></span><span
                                        style="overflow: hidden; position: relative;"><i class="fa fa-check"></i></span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <center style="color: #b2b2b2;"><small><em>* 自己的能力决定着你的收入！</em></small></center>
            </div>
        </div>
    </div>
</div>
<!--版本介绍-->
<div id="page-container" class="header-fixed-top sidebar-visible-lg-full ">
    <div id="sidebar">
        <div id="sidebar-brand" class="themed-background">
            <a href="index.php" class="sidebar-title"> <i class="fa fa-qq"></i><span
                        class="sidebar-nav-mini-hide"><?php echo mb_substr($conf['sitename'], 0, 10, 'utf-8') ?></span></a>
        </div>
        <div id="sidebar-scroll">
            <div class="sidebar-content">
                <ul class="sidebar-nav">
                    <li><a href="./" class=" active">　<i class="icon">&#xe664;</i><span class="sidebar-nav-mini-hide">　网站首页</span></a>
                    </li>
                    <?php if ($conf['fenzhan_buy'] == 1) { ?>
                        <li><a href="./user/regsite.php">　<i class="fa fa-star sidebar-nav-icon"></i><span
                                        class="sidebar-nav-mini-hide">开通分站</span></a></li>
                    <?php } ?>
                    <li><a href="./user/">　<i class="icon">&#xe601;</i><span class="sidebar-nav-mini-hide">　管理后台</span></a>
                    </li>
                    <?php if (!empty($conf['invite_tid'])) { ?>
                        <li><a target="_blank" href="./?mod=invite">　<i class="fa fa-gift sidebar-nav-icon"></i><span
                                        class="sidebar-nav-mini-hide">推广中心</span></a></li>
                    <?php } ?>
                    <?php if (!empty($conf['appurl'])) { ?>
                        <li><a target="_blank" href="<?php echo $conf['appurl']; ?>">　<i
                                        class="fa fa-android sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">APP下载</span></a>
                        </li>
                    <?php } ?>
                    <li><a href="./?mod=tools">　<i class="icon">&#xe608;</i><span
                                    class="sidebar-nav-mini-hide">　实用工具</span></a></li>
                    <li><a href="./?mod=about">　<i class="icon">&#xe6f6;</i><span
                                    class="sidebar-nav-mini-hide">　关于我们</span></a></li>
                </ul>
            </div>
        </div>
        <div id="sidebar-extra-info" class="sidebar-content sidebar-nav-mini-hide">
            <div class="text-center">
                <small>2019 <i class="fa fa-heart text-danger"></i> <a
                            href="./"> <?php echo $conf['sitename'] ?></a></small><br>
            </div>
        </div>
    </div>
    <div id="main-container">
        <header class="navbar navbar-inverse navbar-fixed-top">
            <ul class="nav navbar-nav-custom">
                <li><a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');this.blur();"> <i
                                class="fa fa-ellipsis-v fa-fw animation-fadeInRight" id="sidebar-toggle-mini"></i><i
                                class="fa fa-bars fa-fw" id="sidebar-toggle-full"></i> 菜单</a></li>
            </ul>
            <ul class="nav navbar-nav-custom pull-right">
                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo ($islogin2 == 1) ? '//q2.qlogo.cn/headimg_dl?bs=qq&dst_uin=' . $userrow['qq'] . '&src_uin=' . $userrow['qq'] . '&fid=' . $userrow['qq'] . '&spec=100&url_enc=0&referer=bu_interface&term_type=PC' : 'assets/img/user.png' ?>"
                             alt="avatar">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <?php if ($islogin2 == 1) { ?>
                            <li class="dropdown-header text-center">
                                <strong><?php echo $userrow['user'] ?></strong>
                            </li>
                            <li>
                                <a href="./user/">
                                    <i class="fa fa-user fa-fw pull-right"></i>
                                    用户中心
                                </a>
                            </li>
                            <li>
                                <a href="./user/uset.php?mod=user">
                                    <i class="fa fa-pencil-square fa-fw pull-right"></i>
                                    密码修改
                                </a>
                            </li>
                            <li class="divider">
                            </li>
                            <li>
                                <a href="./user/login.php?logout">
                                    <i class="fa fa-power-off fa-fw pull-right"></i>
                                    退出登录
                                </a>
                            </li>
                        <?php } else { ?>
                            <li class="dropdown-header text-center">
                                <strong>未登录</strong>
                            </li>
                            <li>
                                <a href="./user/login.php">
                                    <i class="fa fa-user fa-fw pull-right"></i>
                                    登录
                                </a>
                            </li>
                            <li>
                                <a href="./user/reg.php">
                                    <i class="fa fa-plus-circle fa-fw pull-right"></i>
                                    注册
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
            </ul>
        </header>

        <div id="page-content">
            <div class="col-sm-12 col-md-9 col-lg-6 center-block" style="float: none;">
                <div class="widget-content themed-background-flat img-logo-about">
                    <p class="desc"><?php echo $conf['sitename'] ?></p>
                    <p class="descp">　最专业的空间业务代刷平台</p>
                </div>
                <div class="widget-content themed-background-muted text-center" style="margin: 0 0 10px;">

                    <div class="btn-group btn-group-justified">
                        <div class="btn-group">
                            <a class="btn btn-default" href="#ptgg" data-toggle="modal"><font color="#ff0000"><i
                                            class="icon">&#xe6df;</i> 平台公告</font></a>
                        </div>
                        <div class="btn-group">
                            <a class="btn btn-default" href="#help" data-toggle="modal"><i class="icon">&#xe606;</i>
                                客服与帮助</font></a>
                        </div>
                    </div>
                    <div class="modal fade" align="left" id="ptgg" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header-tabs">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                                                class="sr-only">Close</span></button>
                                    <ul class="nav nav-tabs" data-toggle="tabs">
                                        <li class="active"><a href="#zhu-modal">系统公告</a></li>
                                        <li><a href="#modal">网站公告</a></li>
                                    </ul>
                                </div>
                                <div class="modal-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="zhu-modal"><?php echo $conf['anounce'] ?></div>
                                        <div class="tab-pane" id="modal"><?php echo $conf['modal'] ?></div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">知道啦</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="modal fade" align="left" id="help" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span
                                                aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" id="myModalLabel">客服与帮助</h4>
                                </div>
                                <div class="modal-body" id="accordion">
                                    <div class="panel panel-default" style="margin-bottom: 6px;">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">为什么订单显示已完成了却一直没到账？</a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                                            <div class="panel-body">
                                                订单显示（已完成）就证明已经提交到服务器内！并不是订单已刷完。<br>
                                                如果长时间没到账请联系客服处理！<br>
                                                订单长时间显示（待处理）请联系客服！
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default" style="margin-bottom: 6px;">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"
                                                   class="collapsed">QQ会员/钻类等什么时候到账？</a>
                                            </h4>
                                        </div>
                                        <div id="collapseTwo" class="panel-collapse collapse" style="height: 0px;">
                                            <div class="panel-body">
                                                下单后的48小时内到账（会员或钻全部都是一样48小时内到账）！<br>
                                                如果超过48小时，请联系客服退款或补单，提供QQ号码！
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default" style="margin-bottom: 6px;">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"
                                                   class="collapsed">卡密/CDK没有发送我的邮箱？</a>
                                            </h4>
                                        </div>
                                        <div id="collapseThree" class="panel-collapse collapse" style="height: 0px;">
                                            <div class="panel-body">没有收到请检查自己邮箱的垃圾箱！也可以去查单区：输入自己下单时填写的邮箱进行查单。<br>
                                                查询到订单后点击（详细）就可以看到自己购买的卡密/cdk！
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default" style="margin-bottom: 6px;">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion"
                                                   href="#collapseFourth" class="collapsed">已付款了没有查询到我订单？</a>
                                            </h4>
                                        </div>
                                        <div id="collapseFourth" class="panel-collapse collapse" style="height: 0px;">
                                            <div class="panel-body" style="margin-bottom: 6px;">
                                                联系客服处理，请提供（付款详细记录截图）（下单商品名称）（下单账号）<br>直接把三个信息发给客服，然后等待客服回复处理（请不要发抖动窗口或者QQ电话）！
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-group" style="margin-bottom: 0px;">
                                        <li class="list-group-item">
                                            <div class="media">
                                                <span class="pull-left thumb-sm"><img
                                                            src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['kfqq'] ?>&spec=100"
                                                            alt="..." class="img-circle img-thumbnail img-avatar"
                                                            width="66px"></span>
                                                <div class="pull-right push-15-t">
                                                    <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq'] ?>&site=qq&menu=yes"
                                                       target="_blank" class="btn btn-sm btn-info">联系</a>
                                                </div>
                                                <div class="pull-left push-10-t">
                                                    <div class="font-w600 push-5">订单售后客服</div>
                                                    <div class="text-muted"><b>QQ：<?php echo $conf['kfqq'] ?></b>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            想要快速回答你的问题就请把问题描述讲清楚!<br>
                                            下单账号+业务名称+问题，直奔主题，按顺序回复!<br>
                                            有问题直接留言，请勿抖动语音否则直接无视。<br>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="block" style="min-height: 310px;">
                    <div class="block-title">
                        <ul class="nav nav-tabs"
                            style="background: linear-gradient(to right,pink ,#5ccdde,#8ae68a,#e0e0e0);">
                            <li class="active"><a href="#onlinebuy" data-toggle="tab"><i class="icon">&#xe658;</i> 下单
                                </a></li>
                            <li><a href="#query" data-toggle="tab"><i class="icon">&#xe607;</i> 查询 </a></li>
                            <li <?php if ($conf['gift_open'] == 0){ ?>class="hide"<?php } ?>><a href="#gift"
                                                                                                data-toggle="tab"><i
                                            class="icon">&#xe6c8;</i> 抽奖</a></li>
                            <li><a href="#fenzhan" data-toggle="tab"><i class="icon">&#xe642;</i> 赚钱 </a></li>
                            <li class="dropdown pull-right">
                                <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown">更多 <i
                                            class="icon">&#xe60c;</i></a>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="myTabDrop1"
                                    style="margin-top: 4px;">
                                    <li class="dropdown-header">More</li>
                                    <li class="divider"></li>
                                    <li <?php if ($conf['iskami'] == 0) echo 'class="hide"' ?>><a href="#kami"
                                                                                                  tabindex="-1"
                                                                                                  data-toggle="tab">卡密下单</a>
                                    </li>
                                    <li <?php if (empty($conf['chatframe'])) echo 'class="hide"' ?>><a href="#chat"
                                                                                                       tabindex="-1"
                                                                                                       data-toggle="tab">在线聊天</a>
                                    </li>
                                    <li <?php if (empty($conf['daiguaurl'])) echo 'class="hide"' ?>><a
                                                href="./?mod=daigua">QQ等级代挂</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade fade-up in active" id="onlinebuy">
                            <?php include TEMPLATE_ROOT . 'default/shop.inc.php'; ?>
                        </div>
                        <div class="tab-pane fade fade-up in" id="query">
                            <div class="col-xs-12 well well-sm animation-pullUp"
                                 <?php if (empty($conf['gg_search'])){ ?>style="display:none;"<?php } ?>><?php echo $conf['gg_search'] ?></div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <select class="form-control" id="searchtype"
                                                style="padding: 6px 4px;width:90px">
                                            <option value="0">下单账号</option>
                                            <option value="1">订单号</option>
                                        </select>
                                    </div>
                                    <input type="text" name="qq" id="qq3" value="" class="form-control"
                                           placeholder="请输入要查询的内容（留空则显示最新订单）"
                                           onkeydown="if(event.keyCode==13){submit_query.click()}" required/>
                                    <span class="input-group-btn"><a href="#cxsm" data-toggle="modal"
                                                                     class="btn btn-warning"><i
                                                    class="glyphicon glyphicon-exclamation-sign"></i></a></span>
                                </div>
                            </div>
                            <input type="submit" id="submit_query" class="btn btn-primary btn-block" value="立即查询"><br/>
                            <div id="result2" class="form-group" style="display:none;">
                                <center>
                                    <small><font color="#ff0000">手机用户可以左右滑动</font></small>
                                </center>
                                <div class="table-responsive">
                                    <table class="table table-vcenter table-condensed table-striped">
                                        <thead>
                                        <tr>
                                            <th>下单账号</th>
                                            <th>商品名称</th>
                                            <th>数量</th>
                                            <th class="hidden-xs">购买时间</th>
                                            <th>状态</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody id="list">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade fade-up in" id="gift">
                            <div class="widget-content themed-background-flat text-right clearfix animation-pullup">
                                <a id="start" style="display:block;"><img
                                            src="http://img.zcool.cn/community/01551058b02bfda801219c77b73408.gif"
                                            alt="avatar"
                                            class="img-circle img-thumbnail img-thumbnail-avatar pull-left">
                                </a>
                                <a id="stop" style="display:none;"><img
                                            src="http://pic.58pic.com/58pic/14/79/67/04q58PICzcN_1024.jpg" alt="avatar"
                                            class="img-circle img-thumbnail img-thumbnail-avatar pull-left">
                                </a>
                                <p></p>
                                <h4 id="roll" class="widget-heading h4"><i class="icon">&#xe600;</i>猛击小人进行抽奖</h4>
                            </div>
                            <hr>
                            <li class="list-group-item bord-top">奖品内容：<br>　　个性标签赞、QQ名片赞、空间访客、全民K歌粉丝、超级会员、好莱坞会员<br></li>
                            <div id="result"></div>
                            <br/>
                            <div class="giftlist" style="display:none;"><strong>最近中奖记录</strong>
                                <ul id="pst_1"></ul>
                            </div>
                        </div>
                        <div class="tab-pane fade fade-up in" id="fenzhan">

                            <div class="tab-pane active in" id="Substation">
                                <table class="table table-borderless table-pricing" style="margin-bottom: 0px;">
                                    <tbody>
                                    <tr class="active">
                                        <td>
                                            <h4>
                                                <i class="fa fa-cny fa-fw"></i><strong><?php echo $conf['fenzhan_price'] ?></strong>
                                                /
                                                <i class="fa fa-cny fa-fw"></i><strong><?php echo $conf['fenzhan_price2'] ?></strong><br><small>普及版
                                                    / 专业版两种分站供你选择</small></h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>宝妈、学生等网络兼职首选</td>
                                    </tr>
                                    <tr>
                                        <td><strong>轻轻松松日赚100+不是梦</strong></td>
                                    </tr>
                                    <tr class="active">
                                        <td>
                                            <a href="#userjs" data-toggle="modal"
                                               class="btn btn-effect-ripple  btn-info"
                                               style="overflow: hidden; position: relative;"><span
                                                        class="btn-ripple animate"
                                                        style="height: 100px; width: 100px; top: -21.1px; left: 13px;"></span><i
                                                        class="fa fa-th-list"></i> 功能介绍</a>
                                            <a href="user/regsite.php" target="_blank"
                                               class="btn btn-effect-ripple  btn-danger"
                                               style="overflow: hidden; position: relative;"><span
                                                        class="btn-ripple animate"
                                                        style="height: 98px; width: 98px; top: -33.1px; left: 16px;"></span><i
                                                        class="fa fa-arrow-right"></i> 马上开通</a>
                                            <a href="user/" target="_blank" class="btn btn-effect-ripple btn-primary"><i
                                                        class="fa fa-arrow-right"></i> 分站后台</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <div class="tab-pane fade fade-right in" id="kami">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">输入卡密</div>
                                    <input name="km" id="km" value="" class="form-control" required=""
                                           onkeydown="if(event.keyCode==13){submit_checkkm.click()}" type="text">
                                </div>
                            </div>
                            <input id="submit_checkkm" class="btn btn-primary btn-block" value="检查卡密" type="submit">
                            <div id="km_show_frame" style="display:none;">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">商品名称</div>
                                        <input name="name" id="km_name" value="" class="form-control" disabled=""
                                               type="text">
                                    </div>
                                </div>
                                <div id="km_inputsname"></div>
                                <div id="km_alert_frame" class="alert alert-warning" style="display:none;"></div>
                                <input id="submit_card" class="btn btn-primary btn-block" value="立即购买" type="submit">
                                <div id="result1" class="form-group text-center" style="display:none;">
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade fade-right in" id="lqq">
                            <div class="alert alert-success">免费拉取QQ名片圈圈赞99+，输入QQ号并提交即可！</div>
                            <div class="tab-pane fade in" id="lqq">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">请输入QQ</div>
                                        <input type="text" name="qq" id="qq4" value="" class="form-control" required/>
                                    </div>
                                </div>
                                <input type="submit" id="submit_lqq" class="btn btn-primary btn-block" value="立即提交"><br>
                                <div id="result3" class="form-group text-center" style="display:none;"></div>
                            </div>
                        </div>
                        <div class="tab-pane fade fade-right in" id="chat">
                            <?php echo $conf['chatframe'] ?>
                        </div>

                    </div>
                </div>

                <div class="col-md-auto box" <?php if ($conf['hide_tongji'] == 1){ ?>style="display:none;"<?php } ?>>
                    <div class="panel panel-default layui-anim layui-anim-scaleSpring">
                        <div class="panel-heading text-center"
                             style="background: linear-gradient(to right,#14b7ff,#5ccdde,#b221ff);">
                            <font color="#fff">站点统计</font>
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered">
                                <tbody>
                                <div class="row text-center">
                                    <div class="col-xs-3">
                                        <h5 class="widget-heading"><small>订单总数</small><br><a href="javascript:void(0)"
                                                                                             class="themed-color-flat"><span
                                                        id="count_orders"></span>条</a></h5>
                                    </div>
                                    <div class="col-xs-3">
                                        <h5 class="widget-heading"><small>今日订单</small><br><a href="javascript:void(0)"
                                                                                             class="themed-color-flat"><span
                                                        id="count_orders2"></span>条</a></h5>
                                    </div>
                                    <div class="col-xs-3">
                                        <h5 class="widget-heading"><small>累计交易额</small><br><a href="javascript:void(0)"
                                                                                              class="themed-color-flat"><span
                                                        id="count_money"></span>元</a></h5>
                                    </div>
                                    <div class="col-xs-3">
                                        <h5 class="widget-heading"><small>今日交易额</small><br><a href="javascript:void(0)"
                                                                                              class="themed-color-flat"><span
                                                        id="count_money1"></span>元</a></h5>
                                    </div>
                                </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!--音乐代码-->
        <div id="audio-play" <?php if (empty($conf['musicurl'])){ ?>style="display:none;"<?php } ?>>
            <div id="audio-btn" class="on" onclick="audio_init.changeClass(this,'media')">
                <audio loop="loop" src="<?php echo $conf['musicurl'] ?>" id="media" preload="preload"></audio>
            </div>
        </div>
        <!--音乐代码-->

        <script src="<?php echo $cdnpublic ?>jquery/1.12.4/jquery.min.js"></script>
        <script src="<?php echo $cdnpublic ?>jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script>
        <script src="<?php echo $cdnpublic ?>twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="<?php echo $cdnpublic ?>jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
        <script src="<?php echo $cdnpublic ?>layer/2.3/layer.js"></script>
        <script src="<?php echo $cdnserver ?>assets/appui/js/app.js"></script>
        <script src="<?php echo $cdnserver ?>assets/maidong/js/marquee.js"></script>
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