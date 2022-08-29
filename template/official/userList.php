<?php
if (!defined('IN_CRONLITE')) exit();
// 关闭钩子监听
disable_hook('homeLoaded', 'sendRedPack');
disable_hook('homeLoaded', 'testAdvert');
if ($islogin2 != 1) {
    exit("<script>window.location.href='/?mod=login';</script>");
}
if (!Template::isMobile()) {
    header('Location: /user/userlist.php');
    exit;
}
if ($userrow['power'] == 0) {
    exit('<script>alert("你没有权限使用此功能");history.go(-1);</script>');
}
?>
<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>用户管理</title>
    <!-- 引入样式文件 -->
    <link rel="stylesheet" href="/assets/official/vant@2.8/lib/index.css"/>
    <style>
        section {
            margin-top: 54px;
        }

        #app2 {
            padding: 16px 16px 0 16px;
            color: rgba(69, 90, 100, 0.6);
            font-weight: normal;
            font-size: 14px;
            line-height: 16px;
        }

        .order-search {
            position: fixed;
            top: 46px;
            width: 100%;
            z-index: 999;
        }

        #app2 span {
            padding: 0 3px;
            color: #1989fa;
        }

        .site-list {
            margin-bottom: 10px;
        }

        [v-cloak] {
            display: none!important;
        }
    </style>
</head>
<body style="background-color: #f7f8fa;">
<div id="app1" v-cloak>
    <van-nav-bar
            title="用户管理"
            left-text="返回"
            left-arrow
            fixed
            placeholder
            @click-left="onClickLeft"
    ></van-nav-bar>
</div>
<section>
    <div id="order_search" class="order-search" v-cloak>
        <van-search
                v-model="kw"
                show-action
                placeholder="请输入用户名或QQ"
                @search="onSearch"
                @cancel="onCancel"
        ></van-search>
    </div>
    <h2 id="app2" v-cloak>你共有<span>{{siteCount}}</span>个下级用户</h2>
    <div id="app3" v-cloak>
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
                <div class="site-list" v-for="item in list">
                    <van-cell-group>
                        <van-cell :title="'ZID：' + item['zid']"
                                  :value="item['zid']"
                                  :label="'用户名：' + (item['user'] ? item['user'] : '暂无')"
                                  center>
                            余额：￥{{item['rmb']}}
                        </van-cell>
                        <van-cell
                                :title="'QQ：' + item['qq']"
                                :label="'注册时间：' + item['addtime']"
                                center
                        >
                            <van-button type="info" size="small" @click="editUser(item['zid'])">编辑</van-button>
                        </van-cell>
                    </van-cell-group>
                </div>
            </van-list>
        </van-pull-refresh>
    </div>
</section>

<!-- 引入 Vue 和 Vant 的 JS 文件 -->
<script src="/assets/official/vue/dist/vue.min.js"></script>
<script src="/assets/official/vant@2.8/lib/vant.min.js"></script>
<script src="/assets/official/axios@0.19.2/dist/axios.min.js"></script>
<script src="/assets/jquery/2.1.4/jquery.min.js"></script>
<script>
    new Vue({
        el: '#app1',
        methods: {
            onClickLeft() {
                history.go(-1);
            }
        },
    });

    new Vue({
        el: '#order_search',
        data() {
            return {
                kw: ''
            }
        },
        methods: {
            onSearch(kw) {
                app3.kw = kw;
                app3.onRefresh();
            },
            onCancel() {
                this.kw = '';
            }
        }
    });

    const app2 = new Vue({
        el: '#app2',
        data() {
            return {
                siteCount: 0
            };
        }
    });

    const app3 = new Vue({
        el: '#app3',
        data() {
            return {
                loading: false,
                finished: false,
                refreshing: false,
                error: false,
                list: [],
                page: 1,
                page_size: 10,
                total: 0,
                activeName: '1',
                kw: ''
            };
        },
        methods: {
            editUser() {
                this.$dialog.alert({
                    title: '提示',
                    message: '暂无权限，请联系管理员'
                });
            },
            async getList() {
                let {data: res} = await this.informList({
                    page: this.page,
                    page_size: this.page_size,
                    kw: this.kw
                });
                if (res.length === 0) { // 判断获取数据条数若等于0
                    this.list = []; // 清空数组
                    this.finished = true; // 停止加载
                }
                // 若数据条数不等于0
                this.total = res.total;		// 给数据条数赋值
                app2.siteCount = res.total;
                this.list.push(...res.list)	// 将数据放入list中
                this.loading = false;			// 加载状态结束
                // 如果list长度大于等于总数据条数,数据全部加载完成
                if (this.list.length >= res.total) {
                    this.finished = true;		// 结束加载状态
                }
            },
            // 被 @load调用的方法
            onLoad() { // 若加载条到了底部
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
            async informList() {
                const {page, page_size, kw} = this;
                return new Promise((resolve, reject) => {
                    $.ajax({
                        url: '/ajax.php?act=getUserList',
                        data: {
                            'page': page,
                            'page_size': page_size,
                            'kw': kw
                        },
                        dataType: 'json',
                        success(res) {
                            resolve(res);
                        },
                        error(error) {
                            reject(error);
                        }
                    });
                });
            }
        }
    });
</script>
</body>
</html>