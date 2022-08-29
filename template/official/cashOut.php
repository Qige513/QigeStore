<?php
if (!defined('IN_CRONLITE')) exit();
disable_hook('homeLoaded', 'sendRedPack');
disable_hook('homeLoaded', 'testAdvert');
if ($islogin2 != 1) {
    exit("<script>window.location.href='/?mod=login';</script>");
}
if (!Template::isMobile()) {
    header('Location: /user/sitelist.php');
    exit;
}
$act = isset($_GET['act']) ? $_GET['act'] : false;
if ($conf['fenzhan_tixian'] == 0) {
    exit('<script>alert("当前站点未开放提现功能");history.go(-1);</script>');
}
if ($userrow['power'] == 0) {
    exit('<script>alert("您没有权限使用此功能，请搭建分站后操作");history.go(-1);</script>');
}
function display_type($type)
{
    if ($type == 1)
        return '微信';
    elseif ($type == 2)
        return 'QQ钱包';
    else
        return '支付宝';
}
?>
<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php if ($act == 'advance'): ?>
        <title>余额提现</title>
    <?php elseif ($act == 'list'): ?>
        <title>提现明细</title>
    <?php else: ?>
        <title>用户余额</title>
    <?php endif; ?>
    <!-- 引入样式文件 -->
    <link rel="stylesheet" href="/assets/official/vant@2.8/lib/index.css"/>
    <style>
        body {
            background-color: #f7f8fa;
        }
        [v-cloak] {
            display: none!important;
        }
        .cash-balance-icon {
            width: 80px;
            padding-top: 80px;
            margin: 0 auto;
        }
        .cash-balance-icon p {
            text-align: center;
        }
        .cash-balance-num {
            font-weight: bold;
            font-size: 20px;
            text-align: center;
        }
        .cash-balance-num span {
            font-size: 40px;
        }
        .cash-balance-submit {
            margin-top: 100px;
            padding: 0 25%;
        }
        .bottom-button {
            width: 160px;
            height: 40px;
        }
        .cash-list {
            background-color: #f7f8fa;
        }
        .cash-list-item {
            margin-top: 10px;
        }
    </style>
</head>

<body>
<!--导航-->
<?php if ($act == 'advance'): ?>
    <div id="nav_bar" v-cloak>
        <van-nav-bar
            left-text="返回"
            right-text="提现明细"
            left-arrow
            title="余额提现"
            fixed
            placeholder
            @click-left="onClickLeft"
            @click-right="onClickRight"
        ></van-nav-bar>
    </div>
    <section>
        <div id="app" v-cloak>
            <van-notice-bar text="单笔提现金额最低<?php echo $conf['tixian_min']; ?>元。提现手续费<?php echo (100 - $conf['tixian_rate']) ?>%" left-icon="volume-o"></van-notice-bar>
            <?php if ($conf['fenzhan_skimg'] == 1 && file_exists(ROOT . 'assets/img/skimg/sk_' . $userrow['zid'] . '.png')): ?>
                <van-divider>结算信息</van-divider>
                <van-cell icon="gold-coin-o" title="账户余额" value="￥<?php echo $userrow['rmb'];?>"></van-cell>
                <van-cell icon="cash-back-record" title="结算方式" value="<?php echo display_type($userrow['pay_type']); ?>"></van-cell>
                <van-cell icon="photo-o" title="收款图" center>
                    <van-image
                            width="5rem"
                            height="5rem"
                            fit="contain"
                            :src="'/assets/img/skimg/sk_' + zid + '.png'"
                            @click="imagePreview"
                    >
                    </van-image>
                </van-cell>
                <van-form @submit="onSubmit">
                    <van-field
                            v-model="money"
                            name="money"
                            type="number"
                            left-icon="after-sale"
                            label="提现金额"
                            placeholder="填写提现金额"
                            :rules="[{ required: true, message: '请填写需要提现金额' }]"
                    ></van-field>
                    <div style="margin: 16px;">
                        <van-button round block type="info" native-type="submit" :disabled="money <= 0">
                            提现
                        </van-button>
                    </div>
                </van-form>
            <?php elseif ($conf['fenzhan_skimg'] == 1): ?>
                <van-empty image="error" description="请先上传收款图">
                    <van-button round type="danger" class="bottom-button" url="/?mod=userSet">
                        上传
                    </van-button>
                </van-empty>
            <?php elseif (!empty($userrow['pay_account']) && !empty($userrow['pay_name'])): ?>
                <van-divider>结算信息</van-divider>
                <van-cell icon="gold-coin-o" title="账户余额" value="￥<?php echo $userrow['rmb'];?>"></van-cell>
                <van-cell icon="cash-back-record" title="结算方式" value="<?php echo display_type($userrow['pay_type']); ?>"></van-cell>
                <van-cell title="账号" value="<?php echo $userrow['pay_account']; ?>"></van-cell>
                <van-cell title="姓名" value="<?php echo $userrow['pay_name']; ?>"></van-cell>
                <van-cell icon="photo-o" title="收款图" center>
                    <van-image
                            width="5rem"
                            height="5rem"
                            fit="contain"
                            :src="'/assets/img/skimg/sk_' + zid + '.png'"
                            @click="imagePreview"
                    >
                    </van-image>
                </van-cell>
                <van-form @submit="onSubmit">
                    <van-field
                            v-model="money"
                            name="money"
                            type="number"
                            left-icon="after-sale"
                            label="提现金额"
                            placeholder="填写提现金额"
                            :rules="[{ required: true, message: '请填写需要提现金额' }]"
                    ></van-field>
                    <div style="margin: 16px;">
                        <van-button round block type="info" native-type="submit" :disabled="money <= 0">
                            提现
                        </van-button>
                    </div>
                </van-form>
            <?php else: ?>
                <van-empty image="error" description="请先绑定收款账号">
                    <van-button round type="danger" class="bottom-button" url="/?mod=userSet">
                        点此设置
                    </van-button>
                </van-empty>
            <?php endif; ?>
        </div>
    </section>

    <!-- 引入 Vue 和 Vant 的 JS 文件 -->
    <script src="/assets/official/vue/dist/vue.min.js"></script>
    <script src="/assets/official/vant@2.8/lib/vant.min.js"></script>
    <script src="/assets/jquery/2.1.4/jquery.min.js"></script>

    <script>
        const zid = <?php echo $userrow['zid']; ?>;

        new Vue({
            el: '#nav_bar',
            methods: {
                onClickLeft() {
                    history.go(-1);
                },
                onClickRight() {
                    location.href = '/?mod=cashOut&act=list';
                }
            }
        });

        new Vue({
            el: '#app',
            data() {
                return {
                    zid : zid,
                    money: ''
                }
            },
            methods: {
                imagePreview() {
                    vant.ImagePreview([
                        '/assets/img/skimg/sk_' + zid + '.png'
                    ]);
                },
                onSubmit(values) {
                    const loading = this.$toast.loading({
                        duration: 0,
                        message: '请稍后...',
                        forbidClick: true,
                    });
                    const that = this;
                    $.ajax({
                        type: 'POST',
                        url: '/ajax.php?act=postBalanceAdvance',
                        data: {
                            'money': values['money'],
                        },
                        dataType: 'json',
                        success(res) {
                            loading.clear();
                            if (res['code'] === 1) {
                                that.$toast.fail({
                                    message: res['msg'],
                                    onClose() {
                                        location.href = '/?mod=userSet';
                                    }
                                });
                                return false;
                            }
                            if (res['code'] !== 0) {
                                that.$toast.fail(res['msg']);
                                return false;
                            }
                            that.$toast.success({
                                message: res['msg'],
                                onClose() {
                                    history.go(-1);
                                }
                            });
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
<?php elseif ($act == 'list'): ?>
    <div id="nav_bar" v-cloak>
        <van-nav-bar
                left-text="返回"
                left-arrow
                title="提现明细"
                fixed
                placeholder
                @click-left="onClickLeft"
        ></van-nav-bar>
    </div>
    <section>
        <div id="app" v-cloak>
            <div class="cash-list">
                <van-pull-refresh v-model="refreshing" @refresh="onRefresh">
                    <van-list
                            v-model="loading"
                            :finished="finished"
                            finished-text="没有更多了"
                            @load="onLoad"
                    >
                        <div v-for="item in list" class="cash-list-item">
                            <van-cell-group>
                                <van-cell
                                        :title="'金额：￥' + item['money']"
                                        :value="item['id']"
                                        :label="'申请时间：' + item['addtime']"
                                        center
                                >
                                    实际到账：￥{{ item['realmoney'] }}<br>
                                    <van-tag v-if="item['status_type']" :type="item['status_type']">{{item['status_text']}}
                                    </van-tag>
                                    <van-tag v-else>{{item['status_text']}}</van-tag>
                                </van-cell>
                                <van-cell
                                        :title="'提现方式：' + item['pay_type_text']"
                                        :label="'完成时间：' + (item['endtime'] ? item['endtime'] : '暂无')"
                                        center
                                >
                                    提现账号：{{ item['pay_account'] }}<br>姓名：{{ item['pay_name'] }}
                                </van-cell>
                            </van-cell-group>
                        </div>
                    </van-list>
                </van-pull-refresh>
            </div>
        </div>
    </section>
    <!-- 引入 Vue 和 Vant 的 JS 文件 -->
    <script src="/assets/official/vue/dist/vue.min.js"></script>
    <script src="/assets/official/vant@2.8/lib/vant.min.js"></script>
    <script src="/assets/jquery/2.1.4/jquery.min.js"></script>

    <script>
        new Vue({
            el: '#nav_bar',
            methods: {
                onClickLeft() {
                    history.go(-1);
                },
                onClickRight() {
                    location.href = '/?mod=cashOut&act=list';
                }
            }
        });

        new Vue({
            el: '#app',
            data() {
                return {
                    loading: false,
                    finished: false,
                    refreshing: false,
                    list: [],
                    page: 1,
                    page_size: 10,
                    total: 0,
                }
            },
            methods: {
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
                    for (let i in res.list) {
                        if (res.list.hasOwnProperty(i)) {
                            const status = parseInt(res.list[i]['status']);
                            if (status === 1) {
                                res.list[i]['status_text'] = '已完成';
                                res.list[i]['status_type'] = 'success';
                            } else {
                                res.list[i]['status_text'] = '未完成';
                                res.list[i]['status_type'] = '';
                            }
                            const pay_type = parseInt(res.list[i]['pay_type']);
                            if (pay_type === 1) {
                                res.list[i]['pay_type_text'] = '微信';
                            } else if (pay_type === 2) {
                                res.list[i]['pay_type_text'] = 'QQ钱包';
                            } else {
                                res.list[i]['pay_type_text'] = '支付宝';
                            }
                        }
                    }
                    this.list.push(...res.list)	// 将数据放入list中
                    this.loading = false;			// 加载状态结束
                    // 如果list长度大于等于总数据条数,数据全部加载完成
                    if (this.list.length >= res.total) {
                        this.finished = true;		// 结束加载状态
                    }
                },
                async informList(data) {
                    data['act'] = 'getCashList';
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
                }
            }
        });
    </script>
<?php else: ?>
    <div id="nav_bar" v-cloak>
        <van-nav-bar
                left-text="返回"
                left-arrow
                title="余额"
                fixed
                placeholder
                @click-left="onClickLeft"
        ></van-nav-bar>
    </div>
    <section>
        <div id="app" v-cloak>
            <div class="cash-balance-icon">
                <van-icon name="balance-o" size="80px" color="#FFB800"></van-icon>
                <p>我的余额</p>
            </div>
            <div class="cash-balance-num">
                <p>￥<span><?php echo $userrow['rmb']; ?></span></p>
            </div>
            <div class="cash-balance-submit">
                <van-button type="primary" block color="#1989fa" url="/?mod=recharge">充值</van-button>
                <br>
                <van-button plain type="default" block url="/?mod=cashOut&act=advance"><span style="color: #1989fa;">提现</span></van-button>
            </div>
        </div>
    </section>
    <!-- 引入 Vue 和 Vant 的 JS 文件 -->
    <script src="/assets/official/vue/dist/vue.min.js"></script>
    <script src="/assets/official/vant@2.8/lib/vant.min.js"></script>
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

        new Vue({
            el: '#app'
        });
    </script>
<?php endif ;?>
</body>

</html>