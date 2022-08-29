<?php
if (!defined('IN_CRONLITE')) exit();
if ($islogin2 != 1) {
    exit("<script>window.location.href='/?mod=login';</script>");
}
if (!Template::isMobile()) {
    header('Location: /user/message.php');
    exit;
}
disable_hook('homeLoaded', 'sendRedPack');
disable_hook('homeLoaded', 'testAdvert');
?>
<!DOCTYPE html>
<html lang="zh" style="font-size: 50px;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,viewport-fit=cove">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>分站管理中心</title>

    <!-- 引入样式文件 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vant@2.8/lib/index.css"/>

    <style>
        html, body {
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
<?php if ($userrow['power'] <= 0): ?>
    <div id="container" v-cloak class="container">
        <div class="content">
            <van-empty image="search" description="你还未开通分站哦">
                <van-button type="info" size="large" style="width: 200px;"
                            @click="window.location.href='/?mod=substation'">开通分站
                </van-button>
            </van-empty>
            <van-nav-bar
                    title="分站消息"
                    left-text="返回"
                    fixed="true"
                    left-arrow
                    @click-left="window.history.back(-1);"
            ></van-nav-bar>
        </div>
    </div>
<?php else: ?>
    <div id="container" v-cloak class="container" style="padding-top: 50px;">
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
                <van-cell v-for="item in messageList" :key="item.id" @click="getMessageContent(item.id, item)">
                    <div class="van-ellipsis">
                        <van-tag type="success" v-if="item.read">已读</van-tag>
                        <van-tag type="primary" v-else>未读</van-tag>
                        {{item.title}}
                    </div>
                </van-cell>
            </van-list>
        </van-pull-refresh>
        <van-nav-bar
                title="分站消息"
                left-text="返回"
                fixed="true"
                left-arrow
                @click-left="window.history.back(-1);"
        ></van-nav-bar>
        <!--        <van-tabbar v-model="active">-->
        <!--            <van-tabbar-item name="home" icon="home-o">首页</van-tabbar-item>-->
        <!--            <van-tabbar-item name="subSite" icon="friends-o">分站</van-tabbar-item>-->
        <!--            <van-tabbar-item name="activity" icon="point-gift-o">活动</van-tabbar-item>-->
        <!--            <van-tabbar-item name="person" icon="setting-o">我的</van-tabbar-item>-->
        <!--        </van-tabbar>-->
    </div>

<?php endif; ?>

<script src="https://cdn.staticfile.org/jquery/3.5.1/jquery.min.js"></script>
<!-- 引入 Vue 和 Vant 的 JS 文件 -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vant@2.8/lib/vant.min.js"></script>

<script>
    // 在 #app 标签下渲染一个按钮组件
    new Vue({
        el: '#container',
        data() {
            return {
                messageList: [],
                loading: false,
                finished: false,
                refreshing: false,
                nowPage: 0,
                error: false,
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
                $.getJSON('/user/ajax.php', {
                    'act': 'msglist',
                    'page': this.nowPage
                }, (data) => {
                    this.loading = false;
                    if (data['code'] === 0) {
                        if (data['data'].length === 0) {
                            this.finished = true;
                            this.loading = false;
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
            onRefresh() {
                this.finished = false; 		// 清空列表数据
                this.loading = true; 			// 将 loading 设置为 true，表示处于加载状态
                this.nowPage = 0;				// 分页数赋值为1
                this.messageList = [];				// 清空数组
                this.onLoad(); 				// 重新加载数据
            },
            getMessageContent(id, item) {
                const that = this;
                $.getJSON('/user/ajax.php', {
                    'act': 'msginfo',
                    'id': id
                }, function (data) {
                    if (data['code'] === 0) {
                        vant.Dialog.alert({
                            message: data['content'],
                        });
                    } else {
                        vant.Toast(data['msg']);
                    }
                });
            }
        }
    });

    Vue.use(vant.Lazyload);
</script>
</body>

</html>
