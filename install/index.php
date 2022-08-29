<?php
error_reporting(0);

session_start();

header('Content-Type: text/html; charset=UTF-8');

$do = isset($_GET['do']) ? $_GET['do'] : '0';

if (file_exists('install.lock')) {
    $installed = true;
    $do        = '0';
}

/**
 * 封装过的检查函数
 * @param $fnName //函数名称
 * @return string //html字符
 */
function isExistsFn($fnName)
{
    if (function_exists($fnName)) {
        return '<span class="text-success">可用</span>';
    } else {
        return '<span class="text-danger">不支持</span>';
    }
}

/**
 * 生成随机字符串
 * @param $length //长度
 * @return string //字符串
 */
function random($length = 8)
{
    $str    = null;
    $strPol = 'ABCDEFGHIJKMNPQRSTUVWXYZ23456789abcdefghjkmnpqrstuvwxyz';
    $max    = strlen($strPol) - 1;
    for ($i = 0; $i < $length; $i++) {
        $str .= $strPol[rand(0, $max)];
    }
    return $str;
}

?>


<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no,minimal-ui">
    <title>自助下单系统</title>
    <link href="../assets/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <!-- Theme style -->
    <!--    <link rel="stylesheet" href="../assets/AdminLTE/AdminLTE.min.css">-->
    <link rel="stylesheet" href="../assets/layui/css/layui.css">
    <style>
        body {
            background-color: #d2d6de
        }

        iframe {
            border-radius: 5px;
            border: 1px solid #dedede;
        }

        .navbar-default {
            background-color: #3c8dbc;
        }

        .panel {
            border: none;
        }

        .panel-heading {
            border: none;
            background: #00c0ef !important;
        }

        .btn-primary {
            background-color: #1E9FFF;
            display: inline-block;
            height: 38px;
            line-height: 38px;
            padding: 0 18px;
            color: #fff;
            white-space: nowrap;
            text-align: center;
            font-size: 14px;
            border: none;
            border-radius: 2px;
            cursor: pointer;
        }

        .alert-success {
            background-color: #009688 !important;
        }

        .btn {
            display: inline-block;
            height: 38px;
            line-height: 38px;
            padding: 0 18px;
            color: #fff;
            white-space: nowrap;
            text-align: center;
            font-size: 14px;
            border: none;
            border-radius: 2px;
            cursor: pointer;
        }

        .btn-block {
            display: inline-block;
            height: 38px;
            line-height: 38px;
            padding: 0 18px;
            color: #fff;
            white-space: nowrap;
            text-align: center;
            font-size: 14px;
            border: none;
            border-radius: 2px;
            cursor: pointer;
        }

        .install-icon {
            width: 100px;
            text-align: center;
            margin: 0 auto;
        }

        .alert-info {
            background-color: #00c0ef !important;
            border: none;
        }

        .panel-heading {
            background-color: #515bd4 !important;
        }
    </style>
</head>
<body class="hold-transition login-page">
<nav class="navbar navbar-fixed-top navbar-default" hidden>
    <div class="container">
        <div class="navbar-header">
            <span class="navbar-brand" style="color: #fff;">安装向导</span>
        </div>
    </div>
</nav>
<div class="container" style="padding-top:60px;">
    <div class="col-xs-10 col-sm-10 col-lg-8 center-block" style="float: none;">
        <?php if ($do == '0'){
            $_SESSION['checksession'] = 1;
            ?>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">自助下单系统</h3>
                </div>
                <div class="panel-body">
                    <p>
                        <iframe id="frame" src="../readme.txt?r=<?php echo time() ?>"
                                style="width:100%;height:465px;"></iframe>
                    </p>
                    <?php if ($installed) { ?>
                        <div class="alert alert-warning" style="margin-top: 1rem;">
                            您已经安装过，如需重新安装请删除目录中的
                            <span class="text-danger">install/install.lock</span>
                            文件后再安装！
                        </div>
                    <?php } else { ?>
                        <br>
                        <p class="text-center">
                            <a class="btn btn-primary" href="index.php?do=1">开始安装</a>
                        </p>
                    <?php } ?>
                </div>
            </div>

        <?php }elseif ($do == '1'){ ?>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title text-center">环境检查</h3>
            </div>
            <div class="progress progress-striped active" style="margin: 10px;">
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0"
                     aria-valuemax="100" style="width: 10%">
                    <span class="sr-only">10%</span>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-lg-6" style="width: 97%;margin-left: 1.5%;">
                    <table class="layui-table">
                        <colgroup>
                            <col width="150">
                            <col width="200">
                            <col>
                            <col>
                        </colgroup>
                        <thead>
                        <tr>
                            <th>函数检测</th>
                            <th>需求</th>
                            <th>当前</th>
                            <th>用途</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>PHP 5.4+</td>
                            <td>必须</td>
                            <td><?php echo version_compare(PHP_VERSION, '5.4.0', '>') ? '<span class="text-success">' . PHP_VERSION . '</span>' : '<span class="text-danger">' . PHP_VERSION . '</span>'; ?></td>
                            <td>PHP版本支持</td>
                        </tr>
                        <tr>
                            <td>Curl</td>
                            <td>必须</td>
                            <td><?php echo isExistsFn('curl_exec'); ?></td>
                            <td>抓取网页</td>
                        </tr>
                        <tr>
                            <td>file_get_contents()</td>
                            <td>必须</td>
                            <td><?php echo isExistsFn('file_get_contents'); ?></td>
                            <td>读取文件</td>
                        </tr>
                        <tr>
                            <td>session</td>
                            <td>必须</td>
                            <td><?php echo $_SESSION['checksession'] == 1 ? '<span class="text-success">可用</span>' : '<span class="text-danger">不支持</span>'; ?></td>
                            <td>PHP必备功能</td>
                        </tr>
                        <tr>
                            <td>Pdo_mysql</td>
                            <td>必须</td>
                            <td><?php echo class_exists('PDO') ? '<span class="text-success">可用</span>' : '<span class="text-danger">不支持</span>'; ?></td>
                            <td>数据库链接</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-8 col-sm-8 col-lg-6 col-xs-offset-2 col-sm-offset-2 col-lg-offset-3"
                     style="margin-bottom: 20px;">
                    <p>
                        <span>
                            <a class="btn btn-primary" href="index.php?do=0">
                                &lt;&lt;上一步
                            </a>
                        </span>
                        <span class="pull-right">
                            <a class="btn btn-primary text-right" href="index.php?do=2">下一步&gt;&gt;</a>
                        </span>
                    </p>
                </div>
            </div>

            <?php } elseif ($do == '2') { ?>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">数据库配置</h3>
                    </div>
                    <div class="progress progress-striped active" style="margin: 10px 15px;">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
                             aria-valuemin="0" aria-valuemax="100" style="width: 30%">
                            <span class="sr-only">30%</span>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php
                        if (defined("SAE_ACCESSKEY"))
                            echo <<<HTML
检测到您使用的是SAE空间，支持一键安装，请点击 <a href="?do=3">下一步</a>
HTML;
                        else
                            echo <<<HTML
		<form action="?do=3" class="form-sign" method="post">
		<label for="name">数据库地址:</label>
		<input type="text" class="form-control" name="db_host" value="localhost">
		<label for="name">数据库端口:</label>
		<input type="text" class="form-control" name="db_port" value="3306">
		<label for="name">数据库用户名:</label>
		<input type="text" class="form-control" name="db_user">
		<label for="name">数据库密码:</label>
		<input type="text" class="form-control" name="db_pwd">
		<label for="name">数据库名:</label>
		<input type="text" class="form-control" name="db_name">
		<label for="name">数据表前缀:</label>
		<input type="text" class="form-control" name="db_qz" value="store">
		<br><input type="submit" class="btn btn-primary btn-block" name="submit" value="保存配置">
		</form><br/>
		（如果事先在config.php中填写好相关数据库配置，请 <a href="?do=3&jump=1" class="layui-btn layui-btn-warm layui-btn-xs">点击此处</a> 跳过这一步！）
HTML;
                        ?>
                    </div>
                </div>

            <?php } else if ($do == '3') {
                ?>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">保存数据库</h3>
                    </div>
                    <div class="progress progress-striped active" style="margin: 10px 15px;">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
                             aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                            <span class="sr-only">50%</span>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php
                        require './db.class.php';
                        if (defined("SAE_ACCESSKEY") || $_GET['jump'] == 1) {
                            include_once '../config.php';
                            if (!$dbconfig['user'] || !$dbconfig['pwd'] || !$dbconfig['dbname']) {
                                echo '<div class="alert alert-danger">请先填写好数据库并保存后再安装！<hr/><a href="javascript:history.back(-1)"><< 返回上一页</a></div>';
                            } else {
                                if (!$con = DB::connect($dbconfig['host'], $dbconfig['user'], $dbconfig['pwd'], $dbconfig['dbname'], $dbconfig['port'])) {
                                    if (DB::connect_errno() == 2002)
                                        echo '<div class="alert alert-warning">连接数据库失败，数据库地址填写错误！</div>';
                                    elseif (DB::connect_errno() == 1045)
                                        echo '<div class="alert alert-warning">连接数据库失败，数据库用户名或密码填写错误！</div>';
                                    elseif (DB::connect_errno() == 1049)
                                        echo '<div class="alert alert-warning">连接数据库失败，数据库名不存在！</div>';
                                    else
                                        echo '<div class="alert alert-warning">连接数据库失败，[' . DB::connect_errno() . ']' . DB::connect_error() . '</div>';
                                } else {
                                    echo '<div class="alert alert-success" style="background-color: #00c0ef!important;border: none;">数据库配置文件保存成功！</div>';
                                    if (DB::query("SELECT * FROM `{$dbconfig['dbqz']}_config` WHERE 1") == FALSE)
                                        echo '<p align="right"><a class="btn btn-primary btn-block" href="?do=4">创建数据表>></a></p>';
                                    else
                                        echo '<div class="list-group-item list-group-item-info">系统检测到你已安装过Qige Store自助下单系统</div>
				<div class="list-group-item">
					<a href="?do=6" class="btn btn-block alert-success">跳过安装</a>
				</div>
				<div class="list-group-item">
					<a href="?do=4" onclick="if(!confirm(\'全新安装将会清空所有数据，是否继续？\')){return false;}" class="btn btn-block btn-warning">强制全新安装</a>
				</div>';
                                }
                            }
                        } else {
                            $db_host = isset($_POST['db_host']) ? $_POST['db_host'] : NULL;
                            $db_port = isset($_POST['db_port']) ? $_POST['db_port'] : NULL;
                            $db_user = isset($_POST['db_user']) ? $_POST['db_user'] : NULL;
                            $db_pwd  = isset($_POST['db_pwd']) ? $_POST['db_pwd'] : NULL;
                            $db_name = isset($_POST['db_name']) ? $_POST['db_name'] : NULL;
                            $db_qz   = isset($_POST['db_qz']) ? $_POST['db_qz'] : 'store';

                            if ($db_host == null || $db_port == null || $db_user == null || $db_pwd == null || $db_name == null || $db_qz == null) {
                                echo '<div class="alert alert-danger">保存错误,请确保每项都不为空<hr/><a href="javascript:history.back(-1)"><< 返回上一页</a></div>';
                            } else {
                                $config = "<?php
/*数据库配置*/
\$dbconfig=array(
	'host' => '{$db_host}', //数据库服务器
	'port' => {$db_port}, //数据库端口
	'user' => '{$db_user}', //数据库用户名
	'pwd' => '{$db_pwd}', //数据库密码
	'dbname' => '{$db_name}', //数据库名
	'dbqz' => '{$db_qz}' //数据表前缀
);";
                                if (!$con = DB::connect($db_host, $db_user, $db_pwd, $db_name, $db_port)) {
                                    if (DB::connect_errno() == 2002)
                                        echo '<div class="alert alert-warning">连接数据库失败，数据库地址填写错误！</div>';
                                    elseif (DB::connect_errno() == 1045)
                                        echo '<div class="alert alert-warning">连接数据库失败，数据库用户名或密码填写错误！</div>';
                                    elseif (DB::connect_errno() == 1049)
                                        echo '<div class="alert alert-warning">连接数据库失败，数据库名不存在！</div><a href="javascript:history.back(-1)"><< 返回上一页</a>';
                                    else
                                        echo '<div class="alert alert-warning">连接数据库失败，[' . DB::connect_errno() . ']' . DB::connect_error() . '</div>';
                                } elseif (file_put_contents('../config.php', $config)) {
                                    if (function_exists("opcache_reset")) @opcache_reset();
                                    echo '<div class="alert alert-success" style="background-color: #00c0ef;">数据库配置文件保存成功！</div>';
                                    if (DB::query("select * from " . $db_qz . "_config where 1") == FALSE)
                                        echo '<p align="right"><a class="btn btn-primary btn-block" href="?do=4">创建数据表>></a></p>';
                                    else
                                        echo '<div class="list-group-item list-group-item-info">系统检测到你已安装过Qige Store系统自助下单系统</div>
				<div class="list-group-item">
					<a href="?do=6" class="btn btn-block alert-success">跳过安装</a>
				</div>
				<div class="list-group-item">
					<a href="?do=4" onclick="if(!confirm(\'全新安装将会清空所有数据，是否继续？\')){return false;}" class="btn btn-block btn-warning">强制全新安装</a>
				</div>';
                                } else
                                    echo '<div class="alert alert-danger">保存失败，请确保网站根目录有写入权限<hr/><a href="javascript:history.back(-1)"><< 返回上一页</a></div>';
                            }
                        }
                        ?>
                    </div>
                </div>
            <?php } elseif ($do == '4') { ?>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title" align="center">创建数据表</h3>
                    </div>
                    <div class="progress progress-striped active" style="margin: 10px 15px;">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
                             aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                            <span class="sr-only">70%</span>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php
                        include_once '../config.php';
                        if (!$dbconfig['user'] || !$dbconfig['pwd'] || !$dbconfig['dbname']) {
                            echo '<div class="alert alert-danger">请先填写好数据库并保存后再安装！<hr/><a href="javascript:history.back(-1)"><< 返回上一页</a></div>';
                        } else {
                            require './db.class.php';
                            $sql = file_get_contents('install.sql');
                            $sql = explode(';', trim($sql));

                            $cn = DB::connect($dbconfig['host'], $dbconfig['user'], $dbconfig['pwd'], $dbconfig['dbname'], $dbconfig['port']);
                            if (!$cn)
                                die('err:' . DB::connect_error());
                            DB::query("set sql_mode = ''");
                            DB::query("set names utf8mb4");
                            DB::query("ALTER DATABASE `{$dbconfig['dbname']}` CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci'");
                            $t     = 0;
                            $e     = 0;
                            $error = '';
                            for ($i = 0; $i < count($sql); $i++) {
                                if (empty($sql[$i]))
                                    continue;
                                if (DB::executeSql($sql[$i], $dbconfig['dbqz'] . '_')) {
                                    ++$t;
                                } else {
                                    ++$e;
                                    $error .= DB::error() . '<br/>';
                                }
                            }
                            date_default_timezone_set('PRC');
                            $date = date('Y-m-d');
                            DB::executeSql("INSERT INTO `store_config` VALUES ('build', '" . $date . "')", $dbconfig['dbqz'] . '_');
                            DB::executeSql("INSERT INTO `store_config` VALUES ('cronkey', '" . rand(100000, 999999) . "')", $dbconfig['dbqz'] . '_');
                            DB::executeSql("INSERT INTO `store_config` VALUES ('syskey', '" . random(32) . "')", $dbconfig['dbqz'] . '_');
                        }
                        if ($e == 0) {
                            echo '<div class="alert alert-success" style="color: #ffffff;">安装成功！<br/>SQL成功' . $t . '句/失败' . $e . '句</div><p align="right"><a class="btn btn-block btn-primary" href="index.php?do=5">下一步>></a></p>';
                        } else {
                            echo '<div class="alert alert-danger" style="color: #ffffff;">安装失败<br/>SQL成功' . $t . '句/失败' . $e . '句<br/>错误信息：' . $error . '</div><p align="right"><a class="btn btn-block btn-primary" href="index.php?do=4">点此进行重试</a></p>';
                        }
                        ?>
                    </div>
                </div>

            <?php } elseif ($do == '5') { ?>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title" align="center">安装完成</h3>
                    </div>
                    <div class="progress progress-striped active" style="margin: 10px 15px;">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
                             aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                            <span class="sr-only">100%</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="layui-col-sm-6">
                            <div class="install-icon">
                                <i class="layui-icon" style="font-size: 100px; color: #00a65a;text-align: center;">&#x1005;</i>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php
                        @file_put_contents("install.lock", '安装锁');
                        echo '<div class="alert alert-info"><span style="color: yellow;">安装完成！管理账号和密码是:admin/123456</span><br/><br/><a href="../">>>网站首页</a>｜<a href="../admin/">>>后台管理</a><hr/>更多设置选项请登录后台管理进行修改。<br/><br/><span style="color: #FF5722;">如果你的空间不支持本地文件读写，请自行在install/ 目录建立 install.lock 文件！</span></div>';
                        ?>
                    </div>
                </div>

            <?php } elseif ($do == '6') { ?>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title" align="center">安装完成</h3>
                    </div>
                    <div class="progress progress-striped active" style="margin: 10px 15px;">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
                             aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                            <span class="sr-only">100%</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="layui-col-sm-6">
                            <div class="install-icon">
                                <i class="layui-icon" style="font-size: 100px; color: #00a65a;text-align: center;">&#x1005;</i>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php
                        @file_put_contents("install.lock", '安装锁');
                        echo '<div class="alert alert-info"><span style="color: yellow;">安装完成！管理账号和密码是:admin/123456</span><br/><br/><a href="../">>>网站首页</a>｜<a href="../admin/">>>后台管理</a><hr/>更多设置选项请登录后台管理进行修改。<br/><br/><span style="color: #FF5722;">如果你的空间不支持本地文件读写，请自行在install/ 目录建立 install.lock 文件！</span></div>';
                        ?>
                    </div>
                </div>

            <?php } ?>

        </div>
        <script>
            window.onload = function () {
                var test = document.getElementById('frame').contentWindow.document.getElementsByTagName('body');
                test[0].style.overflowY = 'auto';
                test[0].className = 'scrollbar';
                // test[0].style.overflowY = 'auto';
            }
        </script>
</body>
</html>