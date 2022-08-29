<?php
if (!defined('IN_CRONLITE')) exit();
if ($islogin2 != 1) {
    exit('<script>window.location.href=\'/?mod=login\';</script>');
}
if (!Template::isMobile()) {
    header('Location: /user/classlist.php');
    exit;
}
disable_hook('homeLoaded', 'sendRedPack');
disable_hook('homeLoaded', 'testAdvert');
if ($userrow['power'] == 0) {
    exit('<script>alert("你没有权限使用此功能");history.go(-1);</script>');
}
?>
<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,viewport-fit=cove">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>分类管理</title>
    <!-- 引入样式文件 -->
    <link rel="stylesheet" href="/assets/official/vant@2.8/lib/index.css"/>
    <style>
        .order-list-item {
            margin-top: 10px;
        }
    </style>
</head>

<body style="background-color: #f7f8fa;">
<!--导航-->
<div id="nav_bar">
    <van-nav-bar
        left-text="返回"
        left-arrow
        title="分类管理"
        fixed
        @click-left="onClickLeft"
    ></van-nav-bar>
</div>
<!--内容-->
<section>
    <div id="class_list" style="margin-top: 46px;">
        <div class="lass-list">
            <van-pull-refresh v-model="refreshing" @refresh="onRefresh">
                <van-list
                    v-model="loading"
                    :finished="finished"
                    finished-text="没有更多了"
                    @load="onLoad"
                >
                    <div v-for="item in list" class="order-list-item">
                        <van-cell :title="item['name']" :label="item['is_show'] ? '当前状态：显示' : '当前状态：隐藏'" center>
                            <template #right-icon>
                                <van-switch v-model="item['is_show']" size="24" @change="setActive" @click="switchClick(item['cid'])"></van-switch>
                            </template>
                        </van-cell>
                    </div>
                </van-list>
            </van-pull-refresh>
        </div>
    </div>
</section>
<!-- 引入 Vue 和 Vant 的 JS 文件 -->
<script src="/assets/official/vue/dist/vue.min.js"></script>
<script src="/assets/official/vant@2.8/lib/vant.min.js"></script>
<script src="/assets/official/axios@0.19.2/dist/axios.min.js"></script>
<script src="/assets/jquery/2.1.4/jquery.min.js"></script>

<script>
    new Vue({
        el: '#nav_bar',
        methods: {
            onClickLeft() {
                history.go(-1);
            }
        }
    });

    const class_list = new Vue({
        el: '#class_list',
        data() {
            return {
                loading: false,
                finished: false,
                refreshing: false,
                list: [],
                page: 1,
                page_size: 10,
                total: 0,
                cid: 0
            };
        },
        methods: {
            switchClick(cid) {
                this.$data.cid = cid;
            },
            setActive(status) {
                const that = this;
                setTimeout(() => {
                    if (!this.$data.cid) {
                        return false;
                    }
                    $.ajax({
                        type: 'POST',
                        url: '/ajax.php?act=postSetClassActive',
                        data: {
                            'cid': that.$data.cid,
                            'active': status ? 1 : 0
                        },
                        dataType: 'json',
                        success(res) {
                            if (res['code'] === 0) {
                                return false;
                            }
                            if (res['code'] === 1) {
                                that.$toast(res['msg']);
                                return false;
                            }
                            that.$toast.fail(res['msg']);
                        },
                        error() {
                            that.$toast.fail('系统异常，请联系相关人员');
                        }
                    });
                }, 50);
            },
            async getList() {
                let {data: res} = await this.informList({
                    page: this.page,
                    page_size: this.page_size,
                });
                if (res.length === 0) { // 判断获取数据条数若等于0
                    this.list = []; // 清空数组
                    this.finished = true; // 停止加载
                }
                // 若数据条数不等于0
                this.total = res.total;		// 给数据条数赋值
                this.list.push(...res.list)	// 将数据放入list中
                this.loading = false;			// 加载状态结束
                // 如果list长度大于等于总数据条数,数据全部加载完成
                if (this.list.length >= res.total) {
                    this.finished = true;		// 结束加载状态
                }
            },
            async informList(data) {
                data['act'] = 'getClassList';
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

    Vue.use(vant.Lazyload);
</script>
</body>

</html>