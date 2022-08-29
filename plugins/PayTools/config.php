<?php

return [
    'title' => [
        'title' => '<span style="color: red;font-weight: initial;">温馨提示</span>
<span style="font-weight: initial;">：可以将自己需要提示的内容显示在首页下单选择支付弹窗页面上，给用户一个支付的提示，提升用户体验，解决一些用户支付时遇到的问题。如果后台设置只能余额下单，前台该插件将不生效，用户余额充值依然生效</span><br>
<span>示例效果图：</span><br>
<div id="layer-photos-demo" class="layer-photos-demo" style="cursor: pointer;" title="点击看大图">
<img layer-src="/assets/plugins/PayTools/images/desc.png" style="border: 1px solid red;width: 100px;" src="/assets/plugins/PayTools/images/desc.png" alt="案例图" />
</div>
<script>
layer.photos({
  photos: \'#layer-photos-demo\'
  ,shift: 0 //0-6的选择，指定弹出图片动画类型，默认随机（请注意，3.0之前的版本用shift参数）
}); 
</script>
',
    ],
    'desc' => [
        'title' => '提示信息<span style="color: red;">（不填不显示）</span>',
        'type' => 'text',
        'value' => '',
        'tips' => '<span style="color: red;margin-left: 10px;">提示语（如上图红色字）</span>',
    ],
    'url_href' => [
        'title' => '跳转链接<span style="color: red;">（不填不显示）</span>',
        'type' => 'text',
        'value' => '',
        'tips' => '<span style="color: red;">（引导用户教程链接）例：https://www.baidu.com（如上图蓝色字跳转地址）</span>',
    ],
    'url_title' => [
        'title' => '链接文本<span style="color: red;">（不填不显示）</span>',
        'type' => 'text',
        'value' => '',
        'tips' => '<span style="color: red;margin-left: 10px;">引导用户点击链接文本（如上图蓝色字）</span>',
    ],
    'tools_tips1' => [
        'title' => '<br>',
        'type' => 'hidden',
        'value' => '',
    ],
    'group' => [
        'type' => 'group',
        'options' => [
            'ali' => [
                'title' => '支付宝',
                'options' => [
                    'alipay_btn_type' => [
                        'title' => '按钮操作',
                        'type' => 'select',
                        'options' => [
                            '1' => '默认（拉起支付）',
                            '2' => '链接跳转',
                        ],
                        'value' => '1',
                    ],
                    'alipay_btn_text' => [
                        'title' => '按钮文字<span style="color: red;">（按钮操作为“链接跳转”且不为空时生效，不填默认显示“支付宝”）</span>',
                        'type' => 'text',
                        'value' => '',
                        'tips' => '',
                    ],
                    'alipay_btn_href' => [
                        'title' => '链接跳转地址<span style="color: red;">（按钮操作为“链接跳转”且不为空时生效）</span>',
                        'type' => 'text',
                        'value' => '',
                    ],
                ],
            ],
            'wx' => [
                'title' => '微信',
                'options' => [
                    'wxpay_btn_type' => [
                        'title' => '按钮操作',
                        'type' => 'select',
                        'options' => [
                            '1' => '默认（拉起支付）',
                            '2' => '链接跳转',
                        ],
                        'value' => '1',
                    ],
                    'wxpay_btn_text' => [
                        'title' => '微信按钮文字<span style="color: red;">（按钮操作为“链接跳转”且不为空时生效，不填默认显示“微信支付”）</span>',
                        'type' => 'text',
                        'value' => '',
                        'tips' => '',
                    ],
                    'wxpay_btn_href' => [
                        'title' => '链接跳转地址<span style="color: red;">（按钮操作为“链接跳转”且不为空时生效）</span>',
                        'type' => 'text',
                        'value' => '',
                    ],
                ],
            ],
            'qq' => [
                'title' => 'QQ钱包',
                'options' => [
                    'qqpay_btn_type' => [
                        'title' => '按钮操作',
                        'type' => 'select',
                        'options' => [
                            '1' => '默认（拉起支付）',
                            '2' => '链接跳转',
                        ],
                        'value' => '1',
                    ],
                    'qqpay_btn_text' => [
                        'title' => 'QQ钱包按钮文字<span style="color: red;">（按钮操作为“链接跳转”且不为空时生效，不填默认显示“QQ钱包”）</span>',
                        'type' => 'text',
                        'value' => '',
                        'tips' => '',
                    ],
                    'qqpay_btn_href' => [
                        'title' => '链接跳转地址<span style="color: red;">（按钮操作为“链接跳转”且不为空时生效）</span>',
                        'type' => 'text',
                        'value' => '',
                    ],
                ],
            ],
        ],
    ],
];
