<?php
/**
 * 余额提现
 **/
include '../includes/common.php';
$title = '余额提现';
include './head.php';
if ($islogin2 != 1) {
    exit("<script>window.location.href='./login.php';</script>");
}
?>
<div class="wrapper">
    <div class="col-sm-6">
        <?php

        if ($conf['fenzhan_tixian'] == 0) showmsg('当前站点未开放提现功能！');
        if ($userrow['power'] == 0) {
            showmsg('您没有权限使用此功能，请搭建分站后操作', 3);
        }

        function display_zt($zt)
        {
            if ($zt == 1)
                return '<font color=green>已完成</font>';
            else
                return '<font color=blue>未完成</font>';
        }

        function display_type($type)
        {
            if ($type == 1)
                return '微信';
            elseif ($type == 2)
                return 'QQ钱包';
            else
                return '支付宝';
        }


        if (isset($_POST['money'])) {
            $money = daddslashes(strip_tags($_POST['money']));
            if (!is_numeric($money) || !preg_match('/^[0-9.]+$/', $money)) showmsg('提现金额输入不规范', 3);
            $realmoney = round($money * $conf['tixian_rate'] / 100, 2);
            $DB->pdo->beginTransaction(); // 开启事务
            $userrow = $DB->query("select * from `{$dbconfig['dbqz']}_site` where `zid` = :zid for update", [':zid' => $zid])->fetch(2);
            if ($conf['fenzhan_skimg'] == 1 && !file_exists(ROOT . 'assets/img/skimg/sk_' . $userrow['zid'] . '.png')) {
                exit("<script>alert('您还未上传收款图！');window.location.href='uset.php?mod=skimg';</script>");
            } elseif (empty($userrow['pay_account']) || empty($userrow['pay_name'])) {
                exit("<script>alert('您还未设置收款账号！');history.go(-1);</script>");
            }
            if ($money > $userrow['rmb'] || $money <= 0) {
                exit("<script>alert('所输入的提现金额大于你所拥有的余额！');history.go(-1);</script>");
            }
            if ($money < $conf['tixian_min']) {
                exit("<script>alert('单笔提现金额不能低于{$conf['tixian_min']}元！');history.go(-1);</script>");
            }
            $flag = $DB->insert('tixian', [
                'zid' => $userrow['zid'],
                'money' => $money,
                'realmoney' => $realmoney,
                'pay_type' => $userrow['pay_type'],
                'pay_account' => $userrow['pay_account'],
                'pay_name' => $userrow['pay_name'],
                'status' => 0,
                'addtime' => date('Y-m-d H:i:s'),
            ]);
            if ($flag->rowCount() > 0) {
                $flag = $DB->update('site', ['rmb[-]' => $money], ['zid' => $userrow['zid']]);
                if ($flag->rowCount() > 0) {
                    addPointRecord($userrow['zid'], $money, '提现', '站点余额提现' . $money . '元');
                    $DB->pdo->commit(); // 提交事务
                    exit("<script>alert('提现操作成功，本次实际到账金额:{$realmoney}元，请等待管理员人工转账！');location.href='tixian.php';</script>");
                }
                $DB->pdo->rollBack(); // 事务回滚，以上所有操作不生效
                exit("<script>alert('提现操作失败！');location.href='tixian.php';</script>");
            } else {
                exit("<script>alert('提现失败！');history.go(-1);</script>");
            }
        }
        $numrows = $DB->count('tixian', ['zid' => $userrow['zid']]);
        ?>
        <div class="panel panel-default">
            <div class="panel-heading font-bold" style="background-color: #9999CC;color: white;">
                余额提现
            </div>
            <div class="list-group-item list-group-item-info">
                <?php if ($conf['fenzhan_skimg'] == 1 && file_exists(ROOT . 'assets/img/skimg/sk_' . $userrow['zid'] . '.png')) { ?>
                    已绑定结算账号信息：结算方式：<?php echo display_type($userrow['pay_type']); ?>
                    <br>
                    当前收款图：<img onclick="img('<?php echo $userrow['zid'] ?>')" width="100"
                               src="<?php echo '../assets/img/skimg/sk_' . $userrow['zid'] . '.png' ?>">
                    <hr>
                    <a href="uset.php?mod=skimg" class="btn btn-warning btn-sm">修改收款图</a>&nbsp;&nbsp;<a
                            href="uset.php?mod=user" class="btn btn-info btn-sm">修改提现方式</a>
                <?php } elseif ($conf['fenzhan_skimg'] == 1) { ?>
                    请先上传收款图！ <a href="uset.php?mod=skimg" class="btn btn-warning btn-sm">点此上传</a>
                <?php } elseif (!empty($userrow['pay_account']) && !empty($userrow['pay_name'])) { ?>
                    已绑定结算账号信息：结算方式：<?php echo display_type($userrow['pay_type']); ?> 账号：<?php echo $userrow['pay_account']; ?> 姓名：<?php echo $userrow['pay_name']; ?>
                    <a href="uset.php?mod=user" class="btn btn-warning btn-sm">修改绑定</a>
                <?php } else { ?>
                    请先绑定收款支付宝账号！ <a href="uset.php?mod=user" class="btn btn-warning btn-sm">点此设置</a>
                <?php } ?>
            </div>
            <div class="list-group-item list-group-item-warning">
                单笔提现金额最低<?php echo $conf['tixian_min']; ?>元。提现手续费<?php echo(100 - $conf['tixian_rate']) ?>%。
            </div>
            <div class="panel-body">
                <form method="post" class="form-horizontal">
                    <input type="hidden" name="action" value="tixian">
                    <div class="form-group">
                        <label class="col-lg-3 control-label">账户余额</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" value="<?php echo $userrow['rmb'] ?>元" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">提现金额</label>
                        <div class="col-lg-8">
                            <input type="number" name="money" class="form-control" placeholder="输入要提现金额">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-8">
                            <button class="btn btn-primary" type="submit">确认提现</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading font-bold" style="background-color: #9999CC;color: white;">提现记录</div>
            <div class="panel-body">

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>金额</th>
                            <th>实际到账</th>
                            <th>提现方式</th>
                            <th>提现账号</th>
                            <th>姓名</th>
                            <th>申请时间</th>
                            <th>完成时间</th>
                            <th>状态</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $rs = $DB->select('tixian', '*', ['zid' => $userrow['zid'], 'ORDER' => ['id' => 'DESC'], 'LIMIT' => 10]);
                        foreach ($rs as $res) {
                            echo '<tr><td><b>' . $res['id'] . '</b></td><td>' . $res['money'] . '</td><td>' . $res['realmoney'] . '</td><td>' . display_type($res['pay_type']) . '</td><td>' . $res['pay_account'] . '</td><td>' . $res['pay_name'] . '</td><td>' . $res['addtime'] . '</td><td>' . ($res['status'] == 1 ? $res['endtime'] : null) . '</td><td>' . display_zt($res['status']) . '</td></tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>