<?php
/* *
 * 功能：易支付服务器异步通知页面
 * 版本：3.3
 * 日期：2012-07-23
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。


 *************************页面功能说明*************************
 * 创建该页面文件时，请留心该页面文件中无任何HTML代码及空格。
 * 该页面不能在本机电脑测试，请到服务器上做测试。请确保外部可以访问该页面。
 * 该页面调试工具请使用写文本函数logResult，该函数已被默认关闭，见alipay_notify_class.php中的函数verifyNotify
 * 如果没有收到该页面返回的 success 信息，支付宝会在24小时内按一定的时间策略重发通知
 */

require_once 'inc.php';
require_once SYSTEM_ROOT . 'epay/epay.config.php';
require_once ROOT . 'includes/EpayV1Model.php';

//计算得出通知验证结果
$model = new EpayV1Model($alipay_config['apiurl'], $alipay_config['partner'], $alipay_config['key']);

$verify_result = $model->signParam($_GET) == $_GET['sign'];

if ($verify_result && ($conf['alipay_api'] == 2 || $conf['qqpay_api'] == 2 || $conf['wxpay_api'] == 2 || $conf['tenpay_api'] == 2)) {//验证成功
    //商户订单号

    $out_trade_no = daddslashes($_GET['out_trade_no']);
    //支付宝交易号

    $trade_no = $_GET['trade_no'];

    //交易状态
    $trade_status = $_GET['trade_status'];

    //金额
    $money = $_GET['money'];

    $DB->pdo->beginTransaction();
    $srow = $DB->query('SELECT * FROM `' . $dbconfig['dbqz'] . '_pay` WHERE `trade_no` = :outTradeNo LIMIT 1 FOR UPDATE', [':outTradeNo' => $out_trade_no])->fetch(PDO::FETCH_ASSOC);

    if ($srow === false)
        exit('order not found');

    if ($srow['status'] == 1) {
        $DB->pdo->rollBack();
        exit('success');
    }

    // 根据订单支付类型选择是否校验订单回调验证
    if ($srow['type'] == 'wxpay') {
        $isVerify = isset($conf['epay_wx_notify_verify']) && !empty($conf['epay_wx_notify_verify']);
    } elseif ($srow['type'] == 'qqpay') {
        $isVerify = isset($conf['epay_qq_notify_verify']) && !empty($conf['epay_qq_notify_verify']);
    } elseif ($srow['type'] == 'alipay') {
        $isVerify = isset($conf['epay_ali_notify_verify']) && !empty($conf['epay_ali_notify_verify']);
    } else {
        $isVerify = false;
    }
    $verifyNum = 0;
    // 订单回调验证
    while ($isVerify) {
        $orderInfo = $model->getOrderInfo($out_trade_no, 'out_trade_no');
        $verifyNum++; // 校验次数
        if ($orderInfo[0] === false) {
            if ($verifyNum == 2) { // 两次不成功
                $orderInfo = [
                    true,
                    [
                        'status' => 1,
                        'money' => $srow['money']
                    ]
                ];
            } else {
                usleep(200000); // 降低频繁，等待一下 200ms
                continue;
            }
        }
        $orderInfo = $orderInfo[1];

        if ($orderInfo['status'] != 1 || $orderInfo['money'] != $srow['money']) {
            $DB->pdo->rollBack();
            exit('system notify verify fail');
        }
        break;
    }

    if ($_GET['trade_status'] == 'TRADE_SUCCESS' && $srow['status'] == 0 && $srow['money'] == $money) {
        //付款完成后，支付宝系统发送该交易状态通知
        $updateResult = $DB->update('pay', ['status' => 1], ['trade_no' => $out_trade_no, 'LIMIT' => 1]);
        if ($updateResult->rowCount() > 0) {
            $DB->update('pay', ['endtime' => $date], ['trade_no' => $out_trade_no, 'LIMIT' => 1]);
            $DB->pdo->commit();
            processOrder($srow);
        } else {
            $DB->pdo->rollBack();
        }
    }
    echo 'success';
} else {
    //验证失败
    echo 'system sign error';
}
