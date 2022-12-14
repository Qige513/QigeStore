<?php
if (!defined('IN_CRONLITE')) exit();
?>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport"
          content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width">
    <title><?php echo $conf['sitename'] ?> - <?php echo $conf['title'] ?></title>
    <meta name="keywords" content="<?php echo $conf['keywords'] ?>">
    <meta name="description" content="<?php echo $conf['description'] ?>">
    <link href="<?php echo $cdnpublic ?>twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="<?php echo $cdnpublic ?>font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $cdnserver ?>assets/qiuqiu/css/con_index.css">
    <script src="<?php echo $cdnpublic ?>jquery/1.12.4/jquery.min.js"></script>

    <style media="screen">
        .art-header {
            z-index: 99999;
            width: 100%;
            height: 42px;
            background: #1787e6;
            position: fixed;
            top: 0;
            color: #fff;
            border-bottom: 1px solid #ccc;
        }

        .art-back {
            display: inline-block;
            float: left;
            height: 43px;
            padding-left: 10px;
            line-height: 43px;
            color: #fff;
            position: relative;
            font-size: 22px;
        }

        .art-title-top {
            width: 80%;
            overflow: hidden;
            height: 43px;
            position: absolute;
            left: 50%;
            font-size: 14px;
            font-weight: 800;
            transform: translateX(-50%);
            -webkit-transform: translateX(-50%);
            -moz-transform: translateX(-50%);
            text-align: center;
            line-height: 43px;
        }

        .art-tools {
            display: inline-block;
            float: right;
            height: 43px;
            line-height: 43px;
            padding: 0 20px;
            text-align: center;
            font-size: 22px;
        }

        .art-article {
            padding-top: 42px
        }

        .art-article-title {
            margin-top: 22px;
            padding: 0 16px;
        }

        .art-article-title > h1 {
            font-weight: bold;
            font-size: 22px;
            padding: 0;
            margin: 0;
        }

        .art-information {
            padding: 10px 16px;
            line-height: 13px;
            font-size: 14px;
        }

        .art-information > span {
            color: #999;
            font-size: 13px;
            margin-right: 4px;
        }

        .art-data {
            color: #000;
            line-height: 18px;
        }

        @media screen and (min-width: 901px) {
            html {
                width: 640px;
                margin: 0 auto;
            }

            .art-header {
                width: 641px !important;
            }
        }

    </style>
</head>
<body>
<div class="art-header">

    <span class="art-back"><i class="iconfont">???</i></span>
    <span class="art-title-top">??????<?php echo $conf['sitename'] ?>????????????</span>
    <span class="art-tools"><i class="iconfont">???</i></span>
</div>
<div class="art-article">
    <div class="art-article-title">
        <h3>??????<?php echo $conf['sitename'] ?>????????????</h3>
    </div>
    <div class="art-information">
        <span>????????????admin</span>
        <span> | </span>
        <span>??????QQ:<a style="font-weight: 800;color: #09f;" target="_blank"
                      href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq'] ?>&site=qq&menu=yes"><?php echo $conf['kfqq'] ?></a></span>


        <hr color=red>
        <div style="min-height: 300px; font-size: 14px; line-height:2;max-width: 99%;margin: 0 auto;">

            ???????????????8.88???/?????????????????????????????????????????????????????????<br>???????????????<a target="_blank" href="./user/regsite.php"
                                                      class="btn btn-success btn-xs"> ????????????</a>
            <br>????????????????????????????????????????????????????????????????????????????????????????????????????????????QQ???????????????????????????????????????????????????????????????????????????????????????????????????????????????123abc??????????????????????????????
            123abc.<?php echo $_SERVER['HTTP_HOST'] ?>?????????????????????????????????????????? <img
                    src="<?php echo $cdnserver ?>assets/qiuqiu/images/fz.png" width="100%"></div>
        <br>?????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????<br><br>?????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????<br><br>??????????????????????????????????????????????????????????????????????????????????????????????????????????????????<br><br><img
                src="<?php echo $cdnserver ?>assets/qiuqiu/images/tc.png" width="100%"> <br><br>????????????????????????????????????????????????10?????????????????????????????????QQ????????????????????????????????????
        <br><br>

        <center>
            <td align="center"><a href="./" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-home"></i>????????????</a>
            </td>
        </center>
    </div>
    ???
    <script type="text/javascript">
        $(".art-back").click(function () {
            window.location = "./";
            //??????
        });
        $(".art-tools").click(function () {
            //??????

        });
    </script>

</div>
</div>
</div>
</body>