<?php
// 必须继承插件接口类
use plugin\PluginInterface;

class PayToolsPlugin extends PluginInterface
{
    // 插件的基础信息
    public $info = [
        'name' => 'PayTools', // 插件标识
        'title' => '支付工具箱', // 插件名称
        'description' => '可以将自己需要提示的内容显示在首页下单选择支付弹窗页面上，给用户一个支付的提示，提升用户体验，解决一些用户支付时遇到的问题', // 插件简介
        'status' => 0,  // 默认安装状态
        'author' => '尐 〃呆呆',
        'version' => '1.0.0',
    ];

    /**
     * @var PayToolsModel
     */
    private static $model;

    public function _initialize()
    {
        if (!$this::$model instanceof PayToolsModel) {
            if (class_exists('PayToolsModel')) {
                $this::$model = new \PayToolsModel();
            }
        }
    }

    public function beforeOrderSubmit($param)
    {
        if ($param['only_balance'] == 1) { // 只能余额下单，全部不显示
            return false;
        }
        global $conf;
        $result = [];
        $p_config = $this::$model->getConf('PayTools');
        if ($conf['alipay_api'] != 0) {
            $result['alipay'] = [
                'btn_text' => isset($p_config['alipay_btn_text']) && !empty($p_config['alipay_btn_text']) ? htmlspecialchars($p_config['alipay_btn_text']) : false,
                'btn_type' => isset($p_config['alipay_btn_type']) && !empty($p_config['alipay_btn_type']) ? htmlspecialchars($p_config['alipay_btn_type']) : false,
                'btn_href' => isset($p_config['alipay_btn_href']) && !empty($p_config['alipay_btn_href']) ? htmlspecialchars($p_config['alipay_btn_href']) : false,
            ];
        }
        if ($conf['wxpay_api'] != 0) {
            $result['wxpay'] = [
                'btn_text' => isset($p_config['wxpay_btn_text']) && !empty($p_config['wxpay_btn_text']) ? htmlspecialchars($p_config['wxpay_btn_text']) : false,
                'btn_type' => isset($p_config['wxpay_btn_type']) && !empty($p_config['wxpay_btn_type']) ? htmlspecialchars($p_config['wxpay_btn_type']) : false,
                'btn_href' => isset($p_config['wxpay_btn_href']) && !empty($p_config['wxpay_btn_href']) ? htmlspecialchars($p_config['wxpay_btn_href']) : false,
            ];
        }
        if ($conf['qqpay_api'] != 0) {
            $result['qqpay'] = [
                'btn_text' => isset($p_config['qqpay_btn_text']) && !empty($p_config['qqpay_btn_text']) ? htmlspecialchars($p_config['qqpay_btn_text']) : false,
                'btn_type' => isset($p_config['qqpay_btn_type']) && !empty($p_config['qqpay_btn_type']) ? htmlspecialchars($p_config['qqpay_btn_type']) : false,
                'btn_href' => isset($p_config['qqpay_btn_href']) && !empty($p_config['qqpay_btn_href']) ? htmlspecialchars($p_config['qqpay_btn_href']) : false,
            ];
        }
        if (isset($p_config['desc']) && !empty($p_config['desc'])) {
            $result['desc'] = htmlspecialchars($p_config['desc']);
        } else {
            $result['desc'] = '';
        }
        if (isset($p_config['url_href']) && !empty($p_config['url_href']) && isset($p_config['url_title']) && !empty($p_config['url_title'])) {
            $result['url_href'] = htmlspecialchars($p_config['url_href']);
            $result['url_title'] = htmlspecialchars($p_config['url_title']);
        } else {
            $result['url_href'] = '';
            $result['url_title'] = '';
        }
        return empty($result) ? false : ['pay_tools' => $result];
    }

    public function install()
    {
        $flag = $this::$model->install();
        if ($flag) { // 安装成功后务必更新缓存
            global $CACHE;
            $CACHE->clear('plugins');
        }
        $old_path = str_replace(['/', '\\'], DS, $this->plugin_path . 'template/assets');
        $new_path = str_replace(['/', '\\'], DS, ROOT . 'assets/plugins/' . $this->getName());
        return xCopy($old_path, $new_path); // 复制静态资源文件
    }

    public function uninstall()
    {
        $flag = $this::$model->uninstall();
        if ($flag) { // 卸载成功后务必更新缓存
            global $CACHE;
            $CACHE->clear('plugins');
        }
        $this::$model->clearConf($this->info['name']);
        $path = str_replace(['/', '\\'], DS, ROOT . 'assets/plugins/' . $this->info['name']);
        recursiveDelete($path); // 删除静态资源文件
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
        global $CACHE;
        return $CACHE->save('PLUGINS_' . $this->info['name'], $data);
    }
}