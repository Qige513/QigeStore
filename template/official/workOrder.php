<?php
if (!defined('IN_CRONLITE')) exit();
// 关闭钩子监听
disable_hook('homeLoaded', 'sendRedPack');
disable_hook('homeLoaded', 'testAdvert');
if (!Template::isMobile()) {
    header('Location: /user/workorder.php');
    exit;
}
$status   = $_GET['status'];
$orderIDs = [];
?>
<!DOCTYPE html>
<html lang="zh" style="font-size: 50px;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,viewport-fit=cove">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>工单列表</title>

    <!-- 引入样式文件 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vant@2.8/lib/index.css"/>

    <script src="https://cdn.staticfile.org/jquery/3.5.1/jquery.min.js"></script>
    <!-- 引入 Vue 和 Vant 的 JS 文件 -->
    <script src="https://cdn.staticfile.org/vue/2.6.11/vue.min.js"></script>
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

        .a-inline-block {
            display: inline-block;
        }

        .b {
            display: inline-block;
            position: relative;
            top: -8px;
            left: 10px;
        }

        .b .name {
            display: block;
            font-size: 12px;
        }

        .b .createTime {
            display: block;
            font-size: 12px;
            color: #969799;
        }

        .van-loading--vertical {
            color: rgb(252, 253, 253);
            padding-top: 6rem;
        }

        .van-loading__text {
            color: hsla(0, 0%, 100%, .9);
        }

        .d {
            display: block;
            font-size: 12px;
        }

        .e {
            color: #323233;
        }
    </style>
</head>

<body>
<?php if ($status == 'view'): ?>
    <div id="container" class="container" style="padding-top: 50px;">
        <van-nav-bar
                @click-left="window.history.back(-1);"
                @click-right="completeWorkOrder()"
                title="工单详细"
                left-text="返回"
                :right-text="workOrderMessage['data']['status'] !== '2'?'关闭工单':''"
                fixed="true"
                left-arrow
        >


        </van-nav-bar>

        <van-overlay :show="!workOrderMessage['isShow']">
            <van-loading size="24px" vertical>加载中...</van-loading>
        </van-overlay>
        <van-cell-group v-if="workOrderMessage['isShow']">
            <van-cell size="large">
                <template #title>
                    <div class="a-inline-block">
                        <van-image
                                width="48"
                                height="48"
                                round="true"
                                :src="workOrderMessage['data']['messages']['0']['img']"
                        ></van-image>
                    </div>
                    <div class="b">
                        <span class="name">问题描述</span>
                        <span class="createTime">{{workOrderMessage['data']['messages']['0']['createTime']}}</span>
                    </div>
                </template>
                <template #label>
                    <p class="e">{{workOrderMessage['data']['messages']['0']['content']}}</p>
                    <div>
                        <span class="d">订单编号：{{workOrderMessage['data']['orderID'] === '0'?'无订单号':workOrderMessage['data']['orderID']}}</span>
                        <span class="d">问题类型：{{converWorkOrderType(workOrderMessage['data']['type'])}}</span>
                    </div>
                </template>
            </van-cell>
            <van-cell size="large" v-for="(content,index) in workOrderMessage['data']['messages']" v-if="index !== 0">
                <template #title>
                    <div class="a-inline-block">
                        <van-image
                                width="48"
                                height="48"
                                round="true"
                                :src="content['img']"
                        ></van-image>
                    </div>
                    <div class="b">
                        <span class="name">{{content['name']}}</span>
                        <span class="createTime">{{content['createTime']}}</span>
                    </div>
                </template>
                <template #label>
                    <p class="e">{{content['content']}}</p>
                </template>
            </van-cell>

        </van-cell-group>
        <van-divider dashed v-if="workOrderMessage['data']['status'] === '2'">此工单已经结单</van-divider>
        <van-divider dashed v-if="workOrderMessage['data']['status'] === '0'">请耐心等待客服处理</van-divider>
        <van-cell-group style="margin-top: 15px;" v-if="workOrderMessage['data']['status'] === '1'">
            <!--留言 开始-->
            <van-field
                    v-model="workOrderMessage['replyContent']"
                    label-width="100px"
                    rows="3"
                    autosize
                    label="回复消息"
                    type="textarea"
                    maxlength="500"
                    placeholder="可输入需要补充的内容，回复后官方客服将会收到你的消息！"
                    show-word-limit
            ></van-field>
            <!--留言 结束-->
            <div style="padding:24px;">
                <van-button round block type="info" native-type="submit" @click="replyWorkOrder">
                    回复
                </van-button>
            </div>
        </van-cell-group>
    </div>
<?php elseif ($status == 'add'): ?>
    <?php
    if (isset($_GET['orderID']) && $_GET['orderID'] && md5($_GET['orderID'] . SYS_KEY . $_GET['orderID']) === $_GET['skey']) {
        $orderid    = intval($_GET['orderID']);
        $res        = $DB->get('orders', ['id', 'tid', 'input'], ['id' => $orderid]);
        $toolname   = $DB->get('tools', 'name', ['tid' => $res['tid']]);
        $orderIDs[] = [
            'value' => $orderid,
            'name'  => $orderid . '_' . $toolname . '_' . $res['input']
        ];
    } else {
        $orderIDs[] = [
            'value' => 0,
            'name'  => '选择异常的订单（非订单问题不用选）'
        ];
        $rs         = $DB->select('orders', ['id', 'tid', 'input'], [
            'OR'    => ['zid' => $userrow['zid'], 'userid' => $userrow['zid']],
            'ORDER' => ['id' => 'DESC'],
            'LIMIT' => 20,
        ]);
        foreach ($rs as $res) {
            $toolname   = $DB->get('tools', 'name', ['tid' => $res['tid']]);
            $orderIDs[] = [
                'value' => $res['id'],
                'name'  => $res['id'] . '_' . $toolname . '_' . $res['input']
            ];
        }
    }
    $orderIDs = base64_encode(json_encode($orderIDs));
    ?>
    <div id="container" class="container" style="padding-top: 50px;">
        <van-notice-bar left-icon="info-o">
            找不到要提交的订单？点击进入查询订单，在订单详情页面点击【投诉订单】可以直接提交工单。
        </van-notice-bar>
        <van-form>
            <!--订单编号选择 开始-->
            <van-field
                    label-width="100px"
                    readonly
                    clickable
                    name="issueType"
                    label="订单编号"
                    :value="order['selected']['name']"
                    placeholder="请选择问题类型"
                    @click="order['isShow'] = true"
            ></van-field>
            <van-popup v-model="order['isShow']" position="bottom">
                <van-picker
                        show-toolbar
                        value-key="name"
                        :columns="order['columns']"
                        @confirm="changeOrderID"
                        @cancel="order['isShow'] = false"
                ></van-picker>
            </van-popup>
            <!--订单编号选择 结束-->

            <!--问题类型 开始-->
            <van-field
                    label-width="100px"
                    readonly
                    clickable
                    name="issueType"
                    label="问题类型"
                    :value="issueTypes['selected']['value']"
                    placeholder="请选择问题类型"
                    @click="issueTypes['isShow'] = true"
            ></van-field>
            <van-popup v-model="issueTypes['isShow']" position="bottom">
                <van-picker
                        show-toolbar
                        :columns="issueTypes['columns']"
                        @confirm="changeIssueType"
                        @cancel="issueTypes['isShow'] = false"
                ></van-picker>
            </van-popup>
            <!--问题类型 结束-->

            <!--留言 开始-->
            <van-field
                    v-model="content"
                    label-width="100px"
                    rows="3"
                    autosize
                    label="描述信息"
                    type="textarea"
                    maxlength="500"
                    placeholder="填写描述信息"
                    show-word-limit
            ></van-field>
            <!--留言 结束-->
            <div style="margin: 18px;">
                <van-button round block type="info" native-type="submit" @click="addWorkOrder">
                    提交
                </van-button>
            </div>
        </van-form>
        <van-nav-bar
                @click-left="window.history.back(-1);"
                title="发起工单"
                left-text="返回"
                fixed="true"
                left-arrow
        >
        </van-nav-bar>
    </div>
<?php else: ?>
    <div id="container" class="container" style="padding-top: 50px;">
        <van-pull-refresh v-model="refreshing" @refresh="onRefresh">
            <van-list
                    v-model="loading"
                    :finished="finished"
                    @load="onLoad"
            >
                <van-cell v-for="item in messageList" :title="converTypeName(item['type'])"
                          @click="viewWorkOrder(item['id'])" is-link center>
                    <template #label>
                        <div style="height: 16px;">
                            <div class="van-ellipsis" style="position: fixed;max-width: 60%">
                                {{item['content']}}
                            </div>
                        </div>
                    </template>
                    <div v-if="item['status'] === '1'">
                        <van-tag type="warning">待补充</van-tag>
                    </div>
                    <div v-else-if="item['status'] === '2'">
                        <van-tag type="success">已结单</van-tag>
                    </div>
                    <div v-else>
                        <van-tag type="primary">待处理</van-tag>
                    </div>
                </van-cell>
            </van-list>
        </van-pull-refresh>
        <van-nav-bar
                @click-left="window.history.back(-1);"
                @click-right="window.location.href = '?mod=workOrder&status=add'"
                title="工单列表"
                left-text="返回"
                right-text="发起工单"
                fixed="true"
                left-arrow
        />
    </div>

<?php endif; ?>
<script>
    // 在 #app 标签下渲染一个按钮组件
    new Vue({
        el: '#container',
        data: {
            messageList: [],
            loading: false,
            finished: false,
            refreshing: false,
            nowPage: 0,
            issueTypes: {
                'columns': [
                    '业务补单',
                    '卡密错误',
                    '充值没到账',
                    '订单中途改了密码',
                    '其它问题'
                ],
                'isShow': false,
                'selected': {
                    'value': '',
                    'index': 0
                }
            },
            order: {
                'columns':
                <?php if(!empty($orderIDs)): ?>
                    JSON.parse(window.atob(<?php echo empty($orderIDs) ? '"[]"' : ('"' . $orderIDs . '"'); ?>))
                    <?php else: ?>
                        []
                <?php endif; ?>
                ,
                'isShow': false,
                'selected': {
                    'value': 0,
                    'name': '选择异常的订单（非订单问题不用选）',
                },
                'loading': true
            },
            content: '',
            isAwait: false,
            status: '<?php echo filterParam($_GET['status']);?>',
            workOrderMessage: {
                'id': '<?php echo filterParam($_GET['id']); ?>',
                'isShow': false,
                'data': {},
                'replyContent': ''
            }
        },
        created: function () {
            if (this.status === 'view') {
                this.loadWorkOrderMessage.bind(this)(this.workOrderMessage['id']);
            }
        },

        methods: {
            completeWorkOrder: function () {
                if (this.isAwait)
                    return;
                vant.Toast('正在玩命加载中。。。');
                this.isAwait = true;
                $.post('ajax.php', {
                    act: 'postCompleteWorkOrder',
                    id: this.workOrderMessage['id'],
                }, (data) => {
                    this.isAwait = false;

                    vant.Dialog({
                        message: data['msg'],
                    }).then(() => {
                        window.location.reload();
                    });
                });
            },
            replyWorkOrder: function () {
                if (this.isAwait)
                    return;
                if (this.workOrderMessage['replyContent'].length < 10) {
                    vant.Toast('工单描述不能低于10字');
                    return;
                }
                vant.Toast('正在玩命加载中。。。');
                this.isAwait = true;
                $.post('ajax.php', {
                    act: 'postReplyWorkOrder',
                    id: this.workOrderMessage['id'],
                    content: this.workOrderMessage['replyContent']
                }, (data) => {
                    this.isAwait = false;

                    vant.Dialog({
                        message: data['msg'],
                    }).then(() => {
                        window.location.reload();
                    });
                });
            },
            loadWorkOrderMessage: function (workOrderID) {
                $.getJSON('ajax.php', {
                    act: 'getWorkOrderInfo',
                    id: workOrderID
                }, (data) => {
                    if (data['code'] !== 0) {
                        vant.Dialog({
                            message: data['msg'],
                        }).then(() => {
                            window.history.back(-1);
                        });
                        return;
                    }
                    this.workOrderMessage['data'] = data['data'];
                    this.workOrderMessage['isShow'] = true;
                });
            },
            converWorkOrderType: function (type) {
                if (type === '1')
                    return '业务补单';
                else if (type === '2')
                    return '卡密错误';
                else if (type === '3')
                    return '充值没到账';
                else if (type === '4')
                    return '中途改了密码';
                else
                    return '其它问题';
            },

            addWorkOrder: function () {
                if (this.isAwait)
                    return;
                if (this.content.length < 10) {
                    vant.Toast('工单描述不能低于10字');
                    return;
                }
                if (this.issueTypes['selected']['value'].length === 0) {
                    vant.Toast('问题类型必须选择');
                    return;
                }
                vant.Toast('正在玩命加载中。。。');
                this.isAwait = true;
                $.post('ajax.php', {
                    'act': 'postAddWorkOrder',
                    'orderID': this.order['selected']['value'],
                    'type': this.issueTypes['selected']['index'],
                    'content': this.content
                }, (data) => {
                    this.isAwait = false;
                    vant.Toast(data['msg']);
                    if (data['code'] !== 0)
                        return;
                    vant.Dialog({
                        message: data['msg'],
                    }).then(() => {
                        window.history.back(-1);
                    });
                }, 'json');
            },
            changeIssueType: function (value, index) {
                if (value === '其它问题')
                    index = 0;
                else
                    index++;

                this.issueTypes['selected'] = {
                    'value': value,
                    'index': index
                }
                this.issueTypes['isShow'] = false;
            },
            changeOrderID: function (value, index) {
                this.order['selected'] = value;
                this.order['isShow'] = false;
            },


            onLoad: function () {
                this.nowPage++;
                $.getJSON('ajax.php', {
                    'act': 'getWorkOrderList',
                    'page': this.nowPage
                }, (data) => {
                    this.loading = false;
                    $('.van-pull-refresh__track').removeAttr('style');
                    $('.van-pull-refresh__head').hide();
                    if (data['code'] === 0) {
                        if (data['data'].length === 0) {
                            this.finished = true;
                            this.loading = false;
                            vant.Toast('您已经翻到最底部啦~');
                            return true;
                        }
                        this.messageList = $.merge(this.messageList, data['data']);
                    } else {
                        vant.Toast(data['msg']);
                        this.finished = true;
                        this.loading = false;
                    }
                });
            },
            onRefresh: function () {
                if (!this.finished)
                    this.onLoad();
            },
            viewWorkOrder: function (id) {
                window.location.href = '?mod=workOrder&status=view&id=' + id;
            },
            converTypeName: function (type) {
                if (type === '1') {
                    return '业务补单';
                } else if (type === '2') {
                    return '卡密错误';
                } else if (type === '3') {
                    return '充值没到账';
                } else if (type === '4') {
                    return '中途改了密码';
                } else {
                    return '其它问题';
                }
            },
        }
    });
</script>
</body>

</html>
