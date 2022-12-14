<?php
/**
 * 自助续期站点
 **/
include("../includes/common.php");
$title = '自助续期站点';
include './head.php';
if ($islogin2 == 1) {
} else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
<div class="wrapper">
    <div class="col-sm-12 col-md-8 col-lg-6 center-block" style="float: none;">
        <?php
        if ($userrow['power'] == 0) {
            showmsg('你没有权限使用此功能！', 3);
        }
        if ($userrow['power'] == 2) {
            $price = $conf['fenzhan_price2'];
            if ($userrow['upzid'] > 1) {
                $ktfz_price2 = $DB->get('site', 'ktfz_price2', ['zid' => $userrow['upzid']]);
                if ($ktfz_price2 && $ktfz_price2 > 0) {
                    $price = $ktfz_price2;
                }
            }
        } else {
            $price = $conf['fenzhan_price'];
            if ($userrow['upzid'] > 1) {
                $ktfz_price = $DB->get('site', 'ktfz_price', ['zid' => $userrow['upzid']]);
                if ($ktfz_price && $ktfz_price > 0) {
                    $price = $ktfz_price;
                }
            }
        }
        $fenzhan_expiry = $conf['fenzhan_expiry'] > 0 ? $conf['fenzhan_expiry'] : 12;
        if ($userrow['endtime'] > date("Y-m-d")) $endtime = date("Y-m-d", strtotime("+ {$fenzhan_expiry} months", strtotime($userrow['endtime'])));
        else $endtime = date("Y-m-d", strtotime("+ {$fenzhan_expiry} months"));
        if ($_GET['act'] == 'submit') {
            if ($price > $userrow['rmb']) exit("<script language='javascript'>alert('你的余额不足，请充值！');window.location.href='./';</script>");
            $DB->update('site', ['endtime' => $endtime, 'rmb[-]' => $price], ['zid' => $userrow['zid']]);
            addPointRecord($userrow['zid'], $price, '消费', '自助续期站点');
            exit("<script>alert('恭喜你成功续期到{$endtime}！');window.location.href='index.php';</script>");
        }
        ?>

        <div class="panel panel-default">
            <div class="panel-heading font-bold" style="background-color: #9999CC;color: white;">自助续期站点</h2>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            当前到期时间
                        </div>
                        <input name="endtime" class="form-control" value="<?php echo $userrow['endtime'] ?>" disabled/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            续期后到期时间
                        </div>
                        <input name="nendtime" class="form-control" value="<?php echo $endtime ?>" disabled/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            续期所需
                        </div>
                        <input name="need" class="form-control" value="<?php echo $price ?>" disabled/>
                        <div class="input-group-addon">
                            元
                        </div>
                    </div>
                </div>
                <div class="form-group text-center">
                    <a class="btn btn-success" href="?act=submit">立即购买</a>
                </div>
            </div>
        </div>
    </div>
</div>