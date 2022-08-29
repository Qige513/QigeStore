<?php

use ds\BasePluginModel as Base;

class testAdvertModel extends Base
{
    // 插件需要用到的钩子
    protected $hooks = ['homeLoaded'];

    public function install()
    {
        return $this->handle->action(function () {
            try {
                return $this->bindHoods('testAdvert', $this->hooks);
            } catch (\Exception $e) {
                log_result('插件管理', '插件安装异常', $e->getMessage(), 1);
                return false;
            }
        });
    }

    public function uninstall()
    {
        return $this->handle->action(function () {
            try {
                return $this->unbindHoods('testAdvert', $this->hooks);
            } catch (\Exception $e) {
                log_result('插件管理', '插件卸载异常', $e->getMessage(), 1);
                return false;
            }
        });
    }
}
