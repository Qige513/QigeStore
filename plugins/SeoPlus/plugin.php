<?php
// 必须继承插件接口类
use plugin\PluginInterface;

class SeoPlusPlugin extends PluginInterface
{
    // 插件的基础信息
    public $info = [
        'name'        => 'SeoPlus', // 插件标识
        'title'       => 'Seo 优化增强', // 插件名称
        'description' => '使您的网站更加利于搜索引擎收录', // 插件简介
        'status'      => 0,  // 默认安装状态
        'author'      => '尐 〃呆萌',
        'version'     => '1.0.0',
    ];

    /**
     * @var SeoPlusModel
     */
    private static $model;

    public function _initialize()
    {
        if (!$this::$model instanceof SeoPlusModel) {
            if (class_exists('SeoPlusModel')) {
                $this::$model = new \SeoPlusModel();
            }
        }
    }

    /**
     * 首页加载之前事件
     */
    public function homeLoadBefore()
    {
        ob_start();
    }

    /**
     * 首页加载完成事件
     */
    public function homeLoaded()
    {
        $outputData = ob_get_contents();
        ob_end_clean();

        $outputData .= '<script src="/plugins/SeoPlus/assets/main.js?ver=' . $this->info['version'] . '"></script>';

        echo $outputData;
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
