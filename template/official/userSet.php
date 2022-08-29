<?php
if (!defined('IN_CRONLITE')) exit();
// 关闭钩子监听
disable_hook('homeLoaded', 'sendRedPack');
disable_hook('homeLoaded', 'testAdvert');
if($islogin2 != 1){
    exit('<script>window.location.href="/?mod=login";</script>');
}
?>
<!DOCTYPE html>
<html lang="zh" style="font-size: 50px;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>用户资料设置</title>

    <!-- 引入样式文件 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vant@2.8/lib/index.css"/>

    <script src="https://cdn.staticfile.org/jquery/3.5.1/jquery.min.js"></script>
    <!-- 引入 Vue 和 Vant 的 JS 文件 -->
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vant@2.8/lib/vant.min.js"></script>


    <style>
        .plugin-share-back-img {
            display: none;
        }

        html,
        body {
            height: 100%;
        }

        body {
            background-color: #f7f8fa;
        }

        .tips {
            margin: 0;
            padding: 14px;
            color: rgba(69, 90, 100, 0.6);
            font-weight: normal;
            font-size: 14px;
            line-height: 14px;
        }

        [v-cloak] {
            display: none!important;
        }
    </style>
</head>

<body>
<?php
$status = $_GET['status'];
if ($status == 'site'):
    if (!Template::isMobile()) {
        header('Location: /user/uset.php?mod=logo');
        exit;
    }
?>
    <div id="container" v-cloak class="container" style="padding-top: 50px;">
        <van-nav-bar
                @click-left="window.history.back(-1);"
                title="用户资料设置"
                left-text="返回"
                fixed="true"
                left-arrow>
        </van-nav-bar>
        <?php if ($userrow['power'] > 0): ?>
        <van-form @submit="uploadSiteSet">
            <van-field name="subSiteLogo" label="网站Logo">
                <template #input>
                    <van-uploader v-model="logoImg" :max-count="1" :max-size="2 * 1024 * 1024"></van-uploader>
                </template>
            </van-field>
            <van-field
                    v-model="sitename"
                    name="sitename"
                    label="网站名称"
                    placeholder="请输入需要修改的网站名称"
            ></van-field>
            <van-field
                    v-model="keywords"
                    name="keywords"
                    label="关键字"
                    placeholder="请输入需要修改的关键字"
            ></van-field>
            <van-field
                    v-model="description"
                    name="description"
                    label="网站描述"
                    placeholder="请输入需要修改的网站描述"
                    rows="3"
                    type="textarea"
                    autosize
            ></van-field>
            <van-field
                    v-model="anounce"
                    name="anounce"
                    label="首页公告"
                    placeholder="请输入需要修改的首页公告"
                    rows="3"
                    type="textarea"
                    autosize
            ></van-field>
            <van-field
                    v-model="modal"
                    name="modal"
                    label="首页弹出公告"
                    placeholder="请输入需要修改的首页弹出公告"
                    rows="3"
                    type="textarea"
                    autosize
            ></van-field>
            <van-field
                    v-model="bottom"
                    name="bottom"
                    label="首页底部排版"
                    placeholder="请输入需要修改的首页底部排版"
                    rows="3"
                    type="textarea"
                    autosize
            ></van-field>
            <van-field
                    v-model="alert"
                    name="alert"
                    label="在线下单提示"
                    placeholder="请输入需要修改的在线下单提示"
                    rows="3"
                    type="textarea"
                    autosize
            ></van-field>
            <?php if ($userrow['power'] == 2): ?>
                <van-field
                        v-model="ktfz_price"
                        name="ktfz_price"
                        label="普通分站价格"
                        placeholder="前台自助开通分站的价格"
                ></van-field>

                <van-field
                        v-model="ktfz_price2"
                        name="ktfz_price2"
                        label="专业分站价格"
                        placeholder="前台自助开通分站的价格，不能低于成本价 <?php echo $conf['fenzhan_cost2'] ?>元"
                ></van-field>

                <van-field
                        v-model="ktfz_domain"
                        name="ktfz_domain"
                        label="分站可选择域名"
                        placeholder="默认使用主站域名，没有请留空，不要乱填写！多个域名用,隔开！"
                ></van-field>
            <?php endif; ?>
            <?php if ($conf['fenzhan_template'] == 1): ?>
                <!--首页模板选择 开始-->
                <van-field
                        label-width="100px"
                        readonly
                        clickable
                        name="template"
                        label="首页模板选择"
                        :value="template['name']"
                        placeholder="请选择首页模板"
                        @click="template['isShow'] = true"
                ></van-field>
                <van-popup v-model="template['isShow']" position="bottom">
                    <van-picker
                            show-toolbar
                            :columns="template['columns']"
                            @confirm="changeTemplate"
                            @cancel="template['isShow'] = false"
                    ></van-picker>
                </van-popup>
                <!--首页模板选择 结束-->
            <?php endif; ?>
            <?php if ($conf['fenzhan_editd'] > 0): ?>
                <van-field
                        v-model="domain"
                        center
                        label="本站域名"
                        disabled
                >
                    <template #button>
                        <a @click="loadChangeDomainPanel" style="color: #1989fa;">自助更换域名</a>
                    </template>
                </van-field>
            <?php endif; ?>
            <div style="margin: 16px;">
                <van-button round block type="info" native-type="submit">
                    提交
                </van-button>
            </div>
        </van-form>
        <van-action-sheet v-model="changeDomain['isShow']" title="更换分站域名">
            <van-form>
                <!--新域名选择 开始-->
                <van-field
                        label-width="100px"
                        readonly
                        clickable
                        name="newDomain"
                        label="首页模板选择"
                        :value="changeDomain['newDomain']['value']"
                        placeholder="请选择新域名"
                        @click="changeDomain['newDomain']['isShow'] = true"
                ></van-field>
                <van-popup v-model="changeDomain['newDomain']['isShow']" position="bottom">
                    <van-picker
                            show-toolbar
                            :columns="changeDomain['data']['domains']"
                            @confirm="changeNewDomain"
                            @cancel="changeDomain['newDomain']['isShow'] = false"
                    ></van-picker>
                </van-popup>
                <!--新域名选择 结束-->
                <van-field
                        v-model="changeDomain['newPrefix']"
                        name="newPrefix"
                        label="新域名前缀"
                        placeholder="请输入新域名前缀"
                ></van-field>
                <van-field
                        v-model="changeDomain['data']['selfDomain']"
                        name="selfDomain"
                        label="当前域名"
                        disabled
                ></van-field>
                <van-field
                        v-model="changeDomain['data']['price']"
                        name="price"
                        label="更换费用"
                        disabled
                ></van-field>
                <div style="margin: 16px;">
                    <van-button round block type="info" @click="updateNewDomain" native-type="submit">
                        提交
                    </van-button>
                </div>
            </van-form>
        </van-action-sheet>
        <?php else: ?>
            <van-empty image="error" description="暂无权限，开通分站拥有此功能">
                <van-button round type="info" class="bottom-button" @click="location.href = '/?mod=substation'">
                    点击开通分站
                </van-button>
            </van-empty>
        <?php endif; ?>
    </div>
<?php if ($userrow['power'] > 0): ?>
    <script>
        // 在 #app 标签下渲染一个按钮组件
        new Vue({
            el: '#container',
            data: {
                logoImg: [<?php
                    if (is_file(ROOT . 'assets/img/logo_' . $userrow['zid'] . '.png')) {
                        echo '{url:"assets/img/logo_' . $userrow['zid'] . '.png"}';
                    }
                    ?>],
                sitename: '',
                title: '',
                keywords: '',
                description: '',
                anounce: '',
                modal: '',
                bottom: '',
                alert: '',
                ktfz_price: '',
                ktfz_price2: '',
                ktfz_domain: '',
                domain: '',
                template: {
                    name: '',
                    isShow: false,
                    columns: JSON.parse(window.atob('<?php echo base64_encode(json_encode(Template::getList())); ?>'))
                },
                changeDomain: {
                    isShow: false,
                    data: {
                        'domains': []
                    },
                    newPrefix: '',
                    newDomain: {
                        value: '',
                        isShow: false
                    }
                }
            },
            created: function () {
                const loading = this.$toast.loading({
                    message: '努力请求中...',
                    forbidClick: true,
                    duration: 0
                });

                $.getJSON('ajax.php', {
                    'act': 'getSubSiteInfo'
                }, (data) => {
                    loading.clear();
                    if (data['code'] !== 0) {
                        vant.Dialog({
                            message: data['msg'],
                        }).then(() => {
                            window.location.reload();
                        });
                    }
                    $.each(data['data'], (index, content) => {
                        if (index === 'template') {
                            this[index]['name'] = content;
                        } else {
                            this[index] = content;
                        }
                    });
                });
            },
            methods: {
                uploadSiteSet: function (values) {
                    const loading = this.$toast.loading({
                        message: '努力请求中...',
                        forbidClick: true,
                        duration: 0
                    });
                    let postData = new FormData();

                    $.each(values, (key, value) => {
                        if(key === 'subSiteLogo'){
                            if (!$.isEmptyObject(this.logoImg[0]))
                                postData.append('logoImg', this.logoImg[0]['file']);
                        }else{
                            postData.append(key,value);
                        }
                    });

                    $.ajax({
                        'url': 'ajax.php?act=postUpdateSiteInfo',
                        'data': postData,
                        'type': 'post',
                        'processData': false,
                        'contentType': false,
                        'success': (data) => {
                            loading.clear();

                            vant.Dialog({
                                message: data['msg'],
                            }).then(() => {
                                window.location.reload();
                            });
                        }
                    });
                },
                updateNewDomain: function () {
                    const loading = this.$toast.loading({
                        message: '努力请求中...',
                        forbidClick: true,
                        duration: 0
                    });
                    $.post('ajax.php', {
                        'act': 'postUpdateDomainInfo',
                        'prefix': this.changeDomain['newPrefix'],
                        'domain': this.changeDomain['newDomain']['value']
                    }, (data) => {
                        loading.clear();
                        if (data['code'] !== 0) {
                            vant.Dialog({
                                message: data['msg'],
                            });
                            return;
                        }
                        this.changeDomain['isShow'] = false;
                        this.domain = this.changeDomain['newPrefix'] + '.' + this.changeDomain['newDomain']['value'];
                        vant.Toast('修改分站域名成功');
                    });
                },
                changeTemplate: function (content, index) {
                    this.template['name'] = content;
                    this.template['isShow'] = false;
                },
                changeNewDomain: function (content, index) {
                    this.changeDomain['newDomain']['value'] = content;
                    this.changeDomain['newDomain']['isShow'] = false;
                },
                loadChangeDomainPanel() {
                    const loading = this.$toast.loading({
                        message: '努力请求中...',
                        forbidClick: true,
                        duration: 0
                    });
                    $.getJSON('ajax.php', {
                        'act': 'getChangeDomainInfo'
                    }, (data) => {
                        loading.clear();
                        if (data['code'] !== 0) {
                            vant.Dialog({
                                message: data['msg'],
                            }).then(() => {
                                window.location.reload();
                            });
                            return;
                        }
                        this.changeDomain.data = data['data'];
                        this.changeDomain.isShow = true;
                    });
                }
            }
        });

        Vue.use(vant.Lazyload);
    </script>
<?php else: ?>
    <script>
        new Vue({
            el: '#container',
        });
        Vue.use(vant.Lazyload);
    </script>
<?php endif; ?>
<?php else:
if (!Template::isMobile()) {
    header('Location: /user/uset.php?mod=user');
    exit;
}
?>
    <div id="container" v-cloak class="container" style="padding-top: 50px;">
        <van-nav-bar
                @click-left="window.history.back(-1);"
                title="用户资料设置"
                left-text="返回"
                fixed="true"
                left-arrow>
        </van-nav-bar>
        <van-form @submit="uploadUserInfo">
            <p class="tips">基础资料</p>
            <van-cell
                    is-link
                    center
                    label="<?php echo empty($userrow['qq_nickname']) ? '' : '昵称：' . $userrow['qq_nickname']; ?>"
                    :value="userData['qq_bind'] ? '解绑' : '绑定'"
                    @click="qqBind">
                <template #title>
                    <span class="custom-title">绑定QQ</span>
                    <van-tag v-if="userData['qq_bind']" type="success">已绑定</van-tag>
                    <van-tag v-else type="danger">未绑定</van-tag>
                </template>
            </van-cell>
            <van-field
                    v-model="userData['password']"
                    type="password"
                    name="密码"
                    label="重置密码"
                    placeholder="不修改请留空"
            ></van-field>

            <?php if ($userrow['power'] > 0 && $conf['fenzhan_tixian'] != 0): ?>
            <p class="tips">提现资料</p>
            <!--提现类型选择 开始-->
            <van-field
                    label-width="100px"
                    readonly
                    clickable
                    name="settleType"
                    label="提现类型"
                    :value="settleInfo['type']['name']"
                    placeholder="请选择提现类型"
                    @click="settleInfo['type']['isShow'] = true"
            ></van-field>
            <van-popup v-model="settleInfo['type']['isShow']" position="bottom">
                <van-picker
                        show-toolbar
                        value-key="name"
                        :columns="settleInfo['type']['columns']"
                        @confirm="changeSettleType"
                        @cancel="settleInfo['type']['isShow'] = false"
                ></van-picker>
            </van-popup>
            <!--提现类型选择 结束-->
            <van-field
                    v-model="settleInfo['account']"
                    name="提现账户"
                    label="提现账户"
                    placeholder="请输入需要修改的提现账户"
                    :rules="[{ required: true, message: '此项不能为空' }]"
            ></van-field>
            <van-field
                    v-model="settleInfo['name']"
                    name="提现姓名"
                    label="提现姓名"
                    placeholder="请输入需要修改的提现姓名"
                    :rules="[{ required: true, message: '此项不能为空' }]"
            ></van-field>
            <van-field name="settleQrImg" label="提现收款图（收款二维码）">
                <template #input>
                    <van-uploader v-model="settleInfo['qrImg']" :max-count="1"
                                  :max-size="2 * 1024 * 1024"></van-uploader>
                </template>
            </van-field>
            <?php endif; ?>

            <div style="margin: 16px;">
                <van-button round block type="info" native-type="submit">
                    修改
                </van-button>
            </div>
            <?php if (isset($_GET['tixian'])): ?>
            <?php if ($conf['fenzhan_tixian'] == 0): ?>
                <van-empty image="error" description="当前站点未开放提现功能">
                </van-empty>
            <?php elseif ($userrow['power'] == 0): ?>
                <van-empty image="error" description="暂无提现权限，开通分站拥有此功能">
                    <van-button round type="info" class="bottom-button" @click="location.href = '/?mod=substation'">
                        点击开通分站
                    </van-button>
                </van-empty>
            <?php endif;endif; ?>
        </van-form>
    </div>
    <script>
        // 在 #app 标签下渲染一个按钮组件
        new Vue({
            el: '#container',
            data() {
                return {
                    settleInfo: {
                        type: {
                            value: '',
                            name: '',
                            isShow: false,
                            columns: [
                                {
                                    name: '支付宝',
                                    value: '0'
                                }, {
                                    name: '微信',
                                    value: '1'
                                }, {
                                    name: 'QQ钱包',
                                    value: '2'
                                }
                            ]
                        },
                        name: '',
                        account: '',
                        qrImg: []
                    },
                    userData: {
                        password: '',
                        qq_bind: false
                    }
                }
            },
            created: function () {
                this.ajaxLoadUserInfo.bind(this)();
            },
            methods: {
                qqBind() {
                    location.href = '/?mod=qqBind';
                },
                changeSettleType: function (content, index) {
                    this.settleInfo['type']['value'] = content['value'];
                    this.settleInfo['type']['name'] = content['name'];

                    this.settleInfo['type']['isShow'] = false;
                },
                ajaxLoadUserInfo: function () {
                    const loading = this.$toast.loading({
                        message: '加载中...',
                        forbidClick: true,
                        duration: 0
                    });
                    $.getJSON('ajax.php', {
                        act: 'getUserInfo'
                    }, (data) => {
                        loading.clear();
                        if (data['code'] !== 0) {
                            vant.Dialog({
                                message: data['msg'],
                            }).then(() => {
                                window.history.go(-1);
                            });
                            return;
                        }

                        this.userData['qq_bind'] = data['data']['user']['qq_bind'];
                        this.settleInfo['name'] = data['data']['settle']['name'];
                        this.settleInfo['account'] = data['data']['settle']['account'];
                        if (data['data']['settle']['qrImg'].length !== 0) {
                            this.settleInfo['qrImg'].push({
                                'url': data['data']['settle']['qrImg']
                            })
                        }
                        $.each(this.settleInfo['type']['columns'], (index, content) => {
                            if (content['value'] === data['data']['settle']['type']) {
                                this.settleInfo['type']['value'] = content['value'];
                                this.settleInfo['type']['name'] = content['name'];
                            }
                        });
                    });
                },
                uploadUserInfo: function (values) {
                    const loading = this.$toast.loading({
                        message: '努力请求中...',
                        forbidClick: true,
                        duration: 0
                    });
                    let postData = new FormData();

                    if (!$.isEmptyObject(this.userData['password']))
                        postData.append('password', this.userData['password']);

                    if (!$.isEmptyObject(this.settleInfo['qrImg'][0]))
                        postData.append('settleQrImg', this.settleInfo['qrImg'][0]['file']);

                    postData.append('settleType', this.settleInfo['type']['value']);
                    postData.append('settleName', this.settleInfo['name']);
                    postData.append('settleAccount', this.settleInfo['account']);

                    $.ajax({
                        'url': 'ajax.php?act=postUpdateUserInfo',
                        'data': postData,
                        'type': 'post',
                        processData: false,
                        contentType: false,
                        'success': (data) => {
                            loading.clear();

                            vant.Dialog({
                                message: data['msg'],
                            }).then(() => {
                                window.location.reload();
                            });
                        }
                    });
                }
            }
        });

        Vue.use(vant.Lazyload);
    </script>
<?php endif; ?>
</body>

</html>
