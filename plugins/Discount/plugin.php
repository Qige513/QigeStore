<?php
// 必须继承插件接口类
use plugin\PluginInterface;

class DiscountPlugin extends PluginInterface
{
    // 插件的基础信息
    public $info = [
        'name'        => 'Discount', // 插件标识
        'title'       => '打五折插件', // 插件名称
        'description' => '智能折扣插件', // 插件简介
        'status'      => 0,  // 默认安装状态
        'author'      => '尐 〃呆萌',
        'version'     => '1.0.0',
    ];

    private static $productData = [];


    /**
     * @var DiscountModel
     */
    private static $model;

    public function _initialize()
    {
        if (!$this::$model instanceof DiscountModel) {
            if (class_exists('DiscountModel')) {
                $this::$model = new \DiscountModel();
            }
        }
    }


    public function productEditDetail()
    {
        $tid = intval($_GET['tid']);
        if (empty($tid))
            $tid = 0;

        $path = dirname(__FILE__) . DS . 'template/adminDiscountMenu.php';

        $html = file_get_contents($path);


        if ($tid != 0) {
            do {
                $tempData = self::$model->getDiscountData($tid);
                if ($tempData[0] == false)
                    break;

                $tempData = $tempData[1];

                $html = str_replace('\'%tempData%\'', json_encode($tempData), $html);
            } while (false);
        }
        $html = str_replace('\'%tempData%\'', json_encode([]), $html);

        echo $html;
    }

    public function beforeProductEdit($param)
    {
        $tempData = $param['data'];

        self::$productData = [
            'discount_type'           => $tempData['discount_type'],
            'discount_value'          => $tempData['discount_value'],
            'discount_start_time'     => strtotime($tempData['discount_start_time']),
            'discount_end_time'       => strtotime($tempData['discount_end_time']),
            'discount_is_alipay'      => $tempData['discount_is_alipay'] == 'on',
            'discount_is_wxpay'       => $tempData['discount_is_wxpay'] == 'on',
            'discount_is_qqpay'       => $tempData['discount_is_qqpay'] == 'on',
            'discount_is_user_type_0' => $tempData['discount_is_user_type_0'] == 'on',
            'discount_is_user_type_1' => $tempData['discount_is_user_type_1'] == 'on',
            'discount_is_user_type_2' => $tempData['discount_is_user_type_2'] == 'on'
        ];

        foreach (self::$productData as $k => $v) {
            unset($param['data'][$k]);
        }
    }

    public function afterProductEdit($param)
    {
        self::$model->updateDiscountData($param['tid'], self::$productData);
    }


    public function install()
    {
        $flag = $this::$model->install();
        if ($flag) { // 安装成功后务必更新缓存
            global $CACHE;
            $CACHE->clear('plugins');
        }
        return true;
    }

    public function uninstall()
    {
        $flag = $this::$model->uninstall();
        if ($flag) { // 卸载成功后务必更新缓存
            global $CACHE;
            $CACHE->clear('plugins');
        }
        return true;
    }

    public function enable()
    {
        global $CACHE;
        $CACHE->clear('plugins');
        return true;
    }

    public function disable()
    {
        global $CACHE;
        $CACHE->clear('plugins');
        return true;
    }

    public function saveConfig($data = [])
    {
        return true;
    }
}
