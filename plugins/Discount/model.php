<?php

use ds\BasePluginModel as Base;

class DiscountModel extends Base
{
    // 插件需要用到的钩子
    protected $hooks = ['productEditDetail', 'afterProductEdit', 'beforeProductEdit'];

    public function install()
    {
        return $this->handle->action(function () {
            try {
                installSql('Discount');
                return $this->bindHoods('Discount', $this->hooks);
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
                uninstallSql('Discount');
                return $this->unbindHoods('Discount', $this->hooks);
            } catch (\Exception $e) {
                log_result('插件管理', '插件卸载异常', $e->getMessage(), 1);
                return false;
            }
        });
    }

    /**
     * 获取折扣数据
     * @param $tid
     * @return array
     */
    public function getDiscountData($tid)
    {
        $data = $this->handle->get('plugin_discount_tools', ['data'], ['tid' => $tid]);
        if (empty($data))
            return [false, [], 404];
        $data = json_decode($data['data'], true);
        return [true, $data, 200];
    }

    public function updateDiscountData($tid, $data)
    {
        $tempData = $this->handle->get('plugin_discount_tools', ['id'], ['tid' => $tid]);

        if (empty($tempData))
            $tempData = [];

        if (empty($data['discount_value']) && $tempData != []) {
            $this->handle->delete('plugin_discount_tools', ['tid' => $tid]);
            return;
        }

        if ($data['discount_type'] != 0 && $data['discount_type'] != 1)
            showmsgAuto('[打五折]折扣类型错误，请刷新页面后重试', '-2');

        if (!empty($data['discount_start_time']) && !empty($data['discount_end_time'])) {
            if ($data['discount_end_time'] < $data['discount_end_time'])
                showmsgAuto('[打五折]优惠活动结束时间日期不能小于开始时间，请刷新页面后重试', '-2');
        }

        $updateData = json_encode($data);

        $updateTime = time();

        if ($tempData == [])
            $this->handle->insert('plugin_discount_tools', [
                'tid'        => $tid,
                'data'       => $updateData,
                'createTime' => $updateTime,
                'updateTime' => $updateTime
            ]);
        else
            $this->handle->update('plugin_discount_tools', [
                'data'       => $updateData,
                'updateTime' => $updateTime
            ], [
                'tid' => $tid
            ]);
    }

}
