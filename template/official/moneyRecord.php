<?php
if (!defined('IN_CRONLITE')) exit();
if (!Template::isMobile()) {
    header('Location: /user/record.php');
    exit;
}
disable_hook('homeLoaded', 'sendRedPack');
disable_hook('homeLoaded', 'testAdvert');
?>
<!DOCTYPE html>
<html lang="zh" style="font-size: 50px;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,viewport-fit=cove">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>资金明细</title>

    <!-- 引入样式文件 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vant@2.8/lib/index.css"/>

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
            color: rgba(69, 90, 100, 0.6);
            font-weight: normal;
            font-size: 14px;
            line-height: 14px;
        }

        .content {
            padding: 16px;
            font-size: 16px;
        }

        .a {
            font-size: 24px;
            text-align: center;
        }

        .fz14 {
            font-size: 14px;
        }

        .fz16 {
            font-size: 16px;
        }

        [v-cloak] {
            display: none!important;
        }
    </style>
</head>
<body>
<div id="container" v-cloak class="container" style="padding-top: 50px;">
    <van-grid :column-num="2">
        <van-grid-item @click="getTradeStatistics(today)">
            <span class="fz16">{{today}}</span>
            <span class="tips">（点击查看收益消费）</span>
        </van-grid-item>
        <van-grid-item @click="getTradeStatistics(yesterday)">
            <span class="fz16">{{yesterday}}</span>
            <span class="tips">（点击查看收益消费）</span>
        </van-grid-item>
    </van-grid>
    <div class="record-list">
        <van-pull-refresh v-model="refreshing" @refresh="onRefresh">
            <van-list
                    v-model="loading"
                    :finished="finished"
                    finished-text="没有更多了"
                    offset="300"
                    :error.sync="error"
                    error-text="请求失败，点击重新加载"
                    @load="onLoad"
            >
                <van-collapse v-model="activeNames">
                    <van-collapse-item v-for="item in messageList" :key="item.id" :name="item.id">
                        <template #title>
                            <div>
                                <van-tag type="success" v-if="redArray.indexOf(item.action) ===-1">{{item.action}}</van-tag>
                                <van-tag type="danger" v-if="redArray.indexOf(item.action) !== -1">{{item.action}}</van-tag>
                                <span><span>{{item.point}}</span> 元</span>
                            </div>
                        </template>
                        [{{item.addtime}}] {{item.bz}}
                    </van-collapse-item>
                </van-collapse>
            </van-list>
        </van-pull-refresh>
    </div>
    <van-action-sheet v-model="tradeStatisticsShow" title="交易统计">
        <div class="content">
            <div class="a">
                {{tradeMoney['outcomeMoney']}} <span class="fz14">元</span>
            </div>
            <van-divider dashed>当日消费</van-divider>
            <div class="a">
                {{tradeMoney['incomeMoney']}} <span class="fz14">元</span>
            </div>
            <van-divider dashed>当日收益</van-divider>
        </div>
    </van-action-sheet>
    <van-nav-bar
            @click-left="window.history.back(-1);"
            title="资金明细"
            left-text="返回"
            fixed="true"
            left-arrow
    ></van-nav-bar>
</div>

<!-- 引入 Vue 和 Vant 的 JS 文件 -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vant@2.8/lib/vant.min.js"></script>
<script src="https://cdn.staticfile.org/jquery/3.5.1/jquery.min.js"></script>

<script>

    function GetDateStr(AddDayCount) {
        let dd = new Date();
        dd.setDate(dd.getDate() + AddDayCount);
        let y = dd.getFullYear();
        let m = dd.getMonth() + 1;
        let d = dd.getDate();

        if (m < 10) {
            m = '0' + m;
        }
        if (d < 10) {
            d = '0' + d;
        }
        return y + "-" + m + "-" + d;
    }

    new Vue({
        el: '#container',
        data() {
            return {
                tradeMoney: {
                    incomeMoney: 0,
                    outcomeMoney: 0
                },
                today: GetDateStr(0),
                yesterday: GetDateStr(-1),
                messageList: [],
                loading: false,
                finished: false,
                refreshing: false,
                error: false,
                nowPage: 0,
                tradeStatisticsShow: false,
                isAwait: false,
                activeNames: [],
                redArray: ['提成', '赠送', '退款', '退回', '充值', '加款'],
            }
        },
        methods: {
            onLoad() {
                let timer = setTimeout(() => {	// 定时器仅针对本地数据渲染,axios请求不需要定时器
                    if (this.refreshing) {
                        this.messageList = [];
                        this.refreshing = false;
                    }
                    this.getList();					// 调用上面方法,请求数据
                    this.finished && clearTimeout(timer);//清除计时器
                }, 100);
            },
            getList() {
                this.nowPage++;
                $.getJSON('ajax.php', {
                    'act': 'getUserTradeList',
                    'page': this.nowPage
                }, (data) => {
                    this.loading = false;
                    if (data['code'] === 0) {
                        if (data['data'].length === 0) {
                            this.finished = true;
                            this.loading = false;
                            vant.Toast('您已经翻到最底部啦~');
                            return true;
                        }

                        let tempData = [];

                        $.each(data['data'], function (key, value) {
                            tempData.push(value['id']);
                        });
                        this.activeNames = $.merge(this.activeNames, tempData);


                        this.messageList = $.merge(this.messageList, data['data']);
                    } else {
                        vant.Toast(data['msg']);
                        this.finished = true;
                        this.loading = false;
                    }
                });
            },
            onRefresh() {
                this.finished = false; 		// 清空列表数据
                this.loading = true; 			// 将 loading 设置为 true，表示处于加载状态
                this.nowPage = 0;				// 分页数赋值为1
                this.messageList = [];				// 清空数组
                this.onLoad(); 				// 重新加载数据
            },
            getTradeStatistics(date) {
                if (this.isAwait) {
                    vant.Toast('正在努力请求中，请耐心等候...');
                    return;
                }
                vant.Toast('正在努力请求中，请耐心等候...');
                this.isAwait = true;
                $.getJSON('ajax.php',
                    {
                        act: 'getUserTradeStatistics',
                        date: date
                    },
                    (data) => {
                        this.isAwait = false;
                        if (data['code'] === 0) {
                            this.tradeMoney = data['data'];
                            this.tradeStatisticsShow = true;
                        } else {
                            vant.Toast(data['msg']);
                        }
                    }
                );
            }
        }
    });

    Vue.use(vant.Lazyload);
</script>
</body>

</html>
