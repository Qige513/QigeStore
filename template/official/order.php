<?php
if (!defined('IN_CRONLITE')) exit();
if ($islogin2 != 1) {
    exit('<script>window.location.href=\'/?mod=login\';</script>');
}
if (!Template::isMobile()) {
    header('Location: /user/list.php');
    exit;
}
disable_hook('homeLoaded', 'sendRedPack');
disable_hook('homeLoaded', 'testAdvert');
?>
<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,viewport-fit=cove">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>订单管理</title>
    <!-- 引入样式文件 -->
    <link rel="stylesheet" href="/assets/official/vant@2.8/lib/index.css"/>
    <style>
        section {
            margin-top: 46px;
        }

        #order_top {
            background-color: #ffffff;
            position: fixed;
            left: 0;
            top: 46px;
            width: 100%;
            z-index: 999;
        }

        .order-notice {
            background-color: #ffffff;
        }

        .order-list .order-list-item {
            margin-top: 10px;
        }

        .order-search {
            position: fixed;
            left: 0;
            width: 100%;
            z-index: 999;
        }

        .order-info {
            margin: 10px 20px 0 20px;
        }

        .order-item-desc {
            padding: 0 16px;
            font-size: 14px;
            background-color: #ffffff;
        }

        [v-cloak] {
            display: none!important;
        }
    </style>
</head>

<body style="background-color: #f7f8fa;">
<?php if (isset($_GET['info']) && isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['key']) && !empty($_GET['key'])): ?>
<!--导航-->
<div id="nav_bar" v-cloak>
    <van-nav-bar
            left-text="返回"
            left-arrow
            title="订单信息"
            fixed
            @click-left="onClickLeft"
    ></van-nav-bar>
</div>
<section>
    <div id="order_info" v-cloak>
        <div v-if="hasData">
            <van-cell title="订单编号" :value="item['id']"></van-cell>
            <van-cell title="商品名称" :value="item['name'] ? item['name'] : '暂无'"></van-cell>
            <van-cell title="订单金额" :value="item['money'] ? '￥' + item['money'] : '暂无'"></van-cell>
            <van-cell title="购买时间" :value="item['date'] ? item['date'] : '暂无'"></van-cell>
            <van-cell title="下单信息" :value="item['inputs'] ? item['inputs'] : '暂无'"></van-cell>
            <van-cell title="订单状态">
                <van-tag v-if="item['status_type']" :type="item['status_type']">{{item['status']}}
                </van-tag>
                <van-tag v-else>{{item['status']}}</van-tag>
            </van-cell>
            <div v-if="item['list'] && item['list']['order_state']">
                <br>
            </div>
            <van-collapse v-if="item['list'] && item['list']['order_state']" v-model="activeNames">
                <van-collapse-item title="订单实时状态" name="1">
                    <van-cell title="下单数量" :value="item['list']['num']"></van-cell>
                    <van-cell title="下单时间" :value="item['list']['add_time']"></van-cell>
                    <van-cell title="初始数量" :value="item['list']['start_num']"></van-cell>
                    <van-cell title="当前数量" :value="item['list']['now_num']"></van-cell>
                    <van-cell title="订单状态" :value="item['list']['order_state']"></van-cell>
                </van-collapse-item>
            </van-collapse>
            <van-collapse v-else-if="item['kminfo']" v-model="activeNames">
                <van-collapse-item title="卡密信息" name="1">
                    {{item['kminfo']}}
                </van-collapse-item>
            </van-collapse>
            <van-collapse v-else-if="item['result']" v-model="activeNames">
                <van-collapse-item title="处理结果" name="1">
                    {{item['result']}}
                </van-collapse-item>
            </van-collapse>
            <div v-if="item['alert']">
                <van-divider>商品简介</van-divider>
                <div class="order-item-desc" v-html="unescape(item['desc'])"></div>
            </div>
        </div>
        <div v-else>
            <van-empty description="订单信息不存在"></van-empty>
        </div>
    </div>
</section>
<?php else: ?>
<!--导航-->
<div id="nav_bar" v-cloak>
    <van-nav-bar
            left-text="返回"
            left-arrow
            title="订单管理"
            fixed
            @click-left="onClickLeft"
    ></van-nav-bar>
</div>
<section>
    <!--订单通知-->
    <div id="order_top" v-cloak>
        <van-notice-bar :text="notify_text" left-icon="volume-o"></van-notice-bar>
        <div class="order-notice">
            <van-notice-bar color="#1989fa" background="#ecf9ff" left-icon="info-o" mode="closeable"
                            @close="statusNoticeClose">
                <van-tag type="primary">待处理</van-tag>
                说明订单还未开始处理，请耐心等待处理！
                <van-tag type="success">已完成</van-tag>
                说明提提交到服务器了，请耐心等待刷完！
                <van-tag type="danger">异常</van-tag>
                说明下单账号信息错误，请联系客服处理！
            </van-notice-bar>
        </div>
        <div class="order-search">
            <van-search
                    v-model="kw"
                    show-action
                    placeholder="请输入下单账号"
                    @search="onSearch"
                    @cancel="onCancel"
            ></van-search>
        </div>
    </div>
    <div id="order_list" v-cloak :style="'margin-top: ' + list_top + 'px;'">
        <div class="order-list">
            <van-pull-refresh v-model="refreshing" @refresh="onRefresh">
                <van-list
                        v-model="loading"
                        :finished="finished"
                        finished-text="没有更多了"
                        @load="onLoad"
                >
                    <div v-for="item in list" class="order-list-item">
                        <van-cell-group>
                            <van-cell
                                    :title="item['order_type'] === 1 ? '分站订单' : '自助下单'"
                                    :value="item['id']"
                                    :label="'商品：' + item['good_name']"
                                    :is-link="item['order_type'] === 1"
                                    center
                                    @click="orderInfo(item['id'], item['order_type'], item['order_key'])"
                            >
                                {{item['addtime']}}
                                <van-tag v-if="item['status_type']" :type="item['status_type']">{{item['status']}}
                                </van-tag>
                                <van-tag v-else>{{item['status']}}</van-tag>
                            </van-cell>
                            <van-cell title="下单信息" :label="item['input']" center>份数：{{item['value']}}</van-cell>
                        </van-cell-group>
                    </div>
                </van-list>
            </van-pull-refresh>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- 引入 Vue 和 Vant 的 JS 文件 -->
<script src="/assets/official/vue/dist/vue.min.js"></script>
<script src="/assets/official/vant@2.8/lib/vant.min.js"></script>
<script src="/assets/official/axios@0.19.2/dist/axios.min.js"></script>
<script src="/assets/jquery/2.1.4/jquery.min.js"></script>
<?php if (isset($_GET['info']) && isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['key']) && !empty($_GET['key'])): ?>
<script>
    new Vue({
        el: '#nav_bar',
        methods: {
            onClickLeft() {
                history.go(-1);
            }
        }
    });
    new Vue({
        el: '#order_info',
        data() {
            return {
                hasData: false,
                item: {},
                activeNames: []
            };
        },
        mounted() {
            this.getOrderInfo();
        },
        methods: {
            unescape(html) {
                return html
                    .replace(html ? /&(?!#?\w+;)/g : /&/g, '&amp;')
                    .replace(/&lt;/g, "<")
                    .replace(/&gt;/g, ">")
                    .replace(/&quot;/g, "\"")
                    .replace(/&#39;/g, "\'");
            },
            getOrderInfo() {
                const loading = this.$toast.loading({
                    duration: 0,
                    message: '加载中...',
                    forbidClick: true,
                });
                const that = this;
                const order_id = '<?php echo trim(htmlspecialchars($_GET['id'])); ?>';
                $.ajax({
                    url: '/ajax.php?act=getOrderInfo',
                    data: {
                        'id': order_id,
                        'key': '<?php echo trim(htmlspecialchars($_GET['key'])); ?>'
                    },
                    dataType: 'json',
                    success(res) {
                        loading.clear();
                        if (res['code'] !== 0) {
                            that.$toast.fail(res['msg']);
                            return false;
                        }
                        that.$data.hasData = true;
                        const status = parseInt(res['status']);
                        switch (status) {
                            case 1:
                                res['status'] = '已完成';
                                res['status_type'] = 'success';
                                break;
                            case 2:
                                res['status'] = '正在处理';
                                res['status_type'] = 'primary';
                                break;
                            case 3:
                                res['status'] = '异常';
                                res['status_type'] = 'danger';
                                break;
                            case 4:
                                res['status'] = '已退款';
                                res['status_type'] = 'warning';
                                break;
                            default:
                                res['status'] = '待处理';
                                res['status_type'] = '';
                                break;
                        }
                        res['id'] = order_id;
                        that.$data.item = res;
                    },
                    error() {
                        loading.clear();
                        that.$toast.fail('系统异常，请联系相关人员');
                    }
                });
            }
        }
    });
</script>
<?php else: ?>
<script>
    new Vue({
        el: '#nav_bar',
        methods: {
            onClickLeft() {
                history.go(-1);
            }
        }
    });

    const order_list = new Vue({
        el: '#order_list',
        data() {
            return {
                kw: '',
                loading: false,
                finished: false,
                refreshing: false,
                list: [],
                page: 1,
                page_size: 10,
                total: 0,
                list_top: 180
            };
        },
        methods: {
            orderInfo(order_id, order_type, order_key) {
                if (parseInt(order_type) === 1 && order_id && order_key) {
                    location.href = '/?mod=order&info&id=' + order_id + '&key=' + order_key;
                }
            },
            async getList() {
                let {data: res} = await this.informList({
                    page: this.page,
                    page_size: this.page_size,
                    kw: this.kw,
                });
                if (res.length === 0) { // 判断获取数据条数若等于0
                    this.list = []; // 清空数组
                    this.finished = true; // 停止加载
                }
                // 若数据条数不等于0
                this.total = res.total;		// 给数据条数赋值
                for (let i in res.list) {
                    if (res.list.hasOwnProperty(i)) {
                        const status = parseInt(res.list[i]['status']);
                        switch (status) {
                            case 1:
                                res.list[i]['status'] = '已完成';
                                res.list[i]['status_type'] = 'success';
                                break;
                            case 2:
                                res.list[i]['status'] = '正在处理';
                                res.list[i]['status_type'] = 'primary';
                                break;
                            case 3:
                                res.list[i]['status'] = '异常';
                                res.list[i]['status_type'] = 'danger';
                                break;
                            case 4:
                                res.list[i]['status'] = '已退款';
                                res.list[i]['status_type'] = 'warning';
                                break;
                            default:
                                res.list[i]['status'] = '待处理';
                                res.list[i]['status_type'] = '';
                                break;
                        }
                    }
                }
                this.list.push(...res.list)	// 将数据放入list中
                this.loading = false;			// 加载状态结束
                order_top.$data.notify_text = '共有 ' + res.total + ' 个订单' + (res['order_done'] === false || res['order_handle'] === false ? '' : '，其中已完成的有 ' + res['order_done'] + ' 个，正在处理的有 ' + res['order_handle'] + ' 个');
                // 如果list长度大于等于总数据条数,数据全部加载完成
                if (this.list.length >= res.total) {
                    this.finished = true;		// 结束加载状态
                }
            },
            async informList(data) {
                data['act'] = 'getOrderList';
                return new Promise((resolve, reject) => {
                    $.ajax({
                        url: '/ajax.php',
                        data: data,
                        dataType: 'json',
                        success(res) {
                            resolve(res)
                        },
                        error(err) {
                            reject(err)
                        }
                    })
                });
            },
            async onLoad() {
                let timer = setTimeout(() => {	// 定时器仅针对本地数据渲染,axios请求不需要定时器
                    if (this.refreshing) {
                        this.list = [];
                        this.refreshing = false;
                    }
                    this.getList();					// 调用上面方法,请求数据
                    this.page++;					// 分页数加一
                    this.finished && clearTimeout(timer);//清除计时器
                }, 100);
            },
            // 加载失败调用方法
            onRefresh() {
                this.finished = false; 		// 清空列表数据
                this.loading = true; 			// 将 loading 设置为 true，表示处于加载状态
                this.page = 1;				// 分页数赋值为1
                this.list = [];				// 清空数组
                this.onLoad(); 				// 重新加载数据
            },
        }
    });

    const order_top = new Vue({
        el: '#order_top',
        data() {
            return {
                kw: '',
                notify_text: '共有 0 个订单，其中已完成的有 0 个，正在处理的有 0 个',
            }
        },
        methods: {
            onSearch(kw) {
                order_list.$data.kw = kw.trim();
                order_list.onRefresh();
            },
            onCancel() {
                this.kw = '';
            },
            statusNoticeClose() {
                order_list.list_top = 140;
            }
        }
    });
</script>
<?php endif; ?>
</body>

</html>