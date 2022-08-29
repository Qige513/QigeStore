<?php
if (!defined('IN_CRONLITE')) exit();
if ($islogin2 != 1) {
    exit('<script>window.location.href=\'/?mod=login\';</script>');
}
if (!Template::isMobile()) {
    header('Location: /user/shoplist.php');
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
    <title>商品管理</title>
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

        .order-list {
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

        .shop-dialog-price {
            background-color: #f7f8fa;
            padding: 10px 0;
        }

        .order-list-btn {
            height: 30px;
        }
        .order-list-btn button {
            margin-left: 10px;
            float: right;
        }

        [v-cloak] {
            display: none!important;
        }
    </style>
</head>

<body style="background-color: #f7f8fa;">
<?php if (isset($_GET['edit']) && isset($_GET['tid']) && !empty($_GET['tid'])):
    $tid = intval($_GET['tid']);
    $row = $DB->get('tools', '*', ['tid' => $tid]);
    if (!empty($row)) {;
        $priceModel = new Price($userrow['zid'], $userrow);
        $priceModel->setToolInfo($tid, $row);
        if ($userrow['power'] == 2) {
            $row['cost2'] = $priceModel->getToolCost2($tid); // 成本价格
            $row['cost'] = $priceModel->getToolCost($tid); // 下级分站代理价格
        } else {
            $row['cost2'] = false;
            $row['cost'] = $priceModel->getToolCost($tid); // 成本价格
        }
        $row['price'] = $priceModel->getToolPrice($tid,0,true);
        $row['del'] = empty($priceModel->getToolDel($tid));
    } else {
        $row = [];
    }
?>
    <!--导航-->
    <div id="nav_bar" v-cloak>
        <van-nav-bar
            left-text="返回"
            left-arrow
            title="修改商品信息"
            fixed
            @click-left="onClickLeft"
        ></van-nav-bar>
    </div>
    <section>
        <div id="shop_info" v-cloak>
            <div v-if="hasData">
                <van-cell title="商品名称" :value="item['name'] ? item['name'] : '暂无'"></van-cell>
                <van-cell title="成本价格" :value="item['cost2'] ? '￥' + item['cost2'] : '暂无'"></van-cell>
                <van-form @submit="onSubmit">
                    <van-field v-if="item['cost2']" label-width="100px" v-model="item['cost']" name="cost"
                               label="代理价格"
                               placeholder="下级分站代理价格"
                               type="number"
                               :rules="[{ required: true, message: '请填写下级分站代理价格' }]"
                    ></van-field>
                    <van-field label-width="100px" v-model="item['price']" name="price"
                               label="销售价格"
                               placeholder="销售价格"
                               type="number"
                               :rules="[{ required: true, message: '请填写销售价格' }]"
                    ></van-field>
                    <van-field name="del" label="是否上架">
                        <template #input>
                            <van-switch v-model="item['del']" size="20"></van-switch>
                        </template>
                    </van-field>
                    <div style="margin: 16px;">
                        <van-button round block type="info" native-type="submit">
                            提交
                        </van-button>
                    </div>
                </van-form>
            </div>
            <div v-else>
                <van-empty description="商品信息不存在"></van-empty>
            </div>
        </div>
    </section>
<?php else: ?>
    <!--导航-->
    <div id="nav_bar" v-cloak>
        <van-nav-bar
            left-text="返回"
            right-text="更多"
            left-arrow
            title="商品管理"
            fixed
            @click-left="onClickLeft"
            @click-right="onClickRight"
        ></van-nav-bar>
    </div>
    <section>
        <!--订单通知-->
        <div id="order_top" v-cloak>
            <van-notice-bar :text="notify_text" :scrollable="false" wrapable left-icon="volume-o"></van-notice-bar>
            <div class="order-search">
                <van-dropdown-menu>
                    <van-dropdown-item v-model="value1" :options="option1" :title="option1[value1]" @change="changeToolClass"></van-dropdown-item>
                </van-dropdown-menu>
            </div>
            <van-action-sheet
                v-model="show"
                :actions="actions"
                cancel-text="取消"
                @select="onSelect"
                @cancel="onCancel"
            ></van-action-sheet>
            <van-dialog
                v-model="promote_price_show"
                className="shop-dialog-price"
                title="提升售价" 
                show-cancel-button
                :before-close="promotePriceBeforeClose"
            >
<!--                <h5>价格提升百分比，例如：5%，最好不要超过 10%</h5>-->
                <div class="shop-dialog-price">
                    <van-divider>价格提升百分比，例如：5%，最好不要超过 10%</van-divider>
                    <van-field 
                        v-model="promote_price"
                        type="digit" 
                        label="百分比" 
                        placeholder="请输入值"
                        maxlength="3"
                    ></van-field>
                </div>
            </van-dialog>
        </div>
        <div id="order_list" v-cloak style="margin-top: 158px;">
            <div class="order-list">
                <van-pull-refresh v-model="refreshing" @refresh="onRefresh">
                    <van-list
                        v-model="loading"
                        :finished="finished"
                        finished-text="没有更多了"
                        @load="onLoad"
                    >
                        <div v-for="item in list" class="order-list-item">
                            <van-card
                                    :num="item['value']"
                                    :price="item['cost_price']"
                                    desc=""
                                    :title="item['name']"
                                    :thumb="item['shopimg'] ? item['shopimg'] : '/assets/img/Product/default.png'"
                                    :thumb-link="'/?cid=' + item['cid'] + '&tid=' + item['tid']"
                            >
                                <template #title>
                                    <van-tag v-if="item['put_shelf']" plain type="success">上架中</van-tag>
                                    <van-tag v-else plain type="danger">已下架</van-tag>
                                    {{item['name']}}
                                </template>
                                <template #bottom>
                                    <br>
                                    <span v-if="item['sub_price']">下级价格：￥{{item['sub_price']}}</span><br>
                                    <span v-if="item['sale_price']">销售价格：￥{{item['sale_price']}}</span>
                                </template>
<!--                                <template #tags>-->
<!--                                    <van-tag v-if="item['put_shelf']" plain type="success">上架中</van-tag>-->
<!--                                    <van-tag v-else plain type="danger">已下架</van-tag>-->
<!--                                </template>-->
                                <template #footer>
                                    <van-button size="mini" @click="goodEdit(item['tid'])">编辑</van-button>
                                </template>
                            </van-card>
<!--                            <van-panel title="标题" desc="描述信息">-->
<!--                                <div>内容</div>-->
<!--                                <template #footer>-->
<!--                                    <div class="order-list-btn">-->
<!--                                        <van-button size="small" type="info">编辑</van-button>-->
<!--                                        <van-button size="small">按钮</van-button>-->
<!--                                    </div>-->
<!--                                </template>-->
<!--                            </van-panel>-->
<!--                            <van-cell-group>-->
<!--                                <van-cell-->
<!--                                    :title="item['order_type'] === 1 ? '分站订单' : '自助下单'"-->
<!--                                    :value="item['id']"-->
<!--                                    :label="'商品：' + item['good_name']"-->
<!--                                    :is-link="item['order_type'] === 1"-->
<!--                                    center-->
<!--                                    @click="orderInfo(item['id'], item['order_type'], item['order_key'])"-->
<!--                                >-->
<!--                                    {{item['addtime']}}-->
<!--                                    <van-tag v-if="item['status_type']" :type="item['status_type']">{{item['status']}}-->
<!--                                    </van-tag>-->
<!--                                    <van-tag v-else>{{item['status']}}</van-tag>-->
<!--                                </van-cell>-->
<!--                                <van-cell title="下单信息" :label="item['input']" center>份数：{{item['value']}}</van-cell>-->
<!--                            </van-cell-group>-->
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
<?php if (isset($_GET['edit']) && isset($_GET['tid']) && !empty($_GET['tid'])): ?>
    <script>
        const _item = <?php echo empty($row) ? 'false' : json($row); ?>;
        new Vue({
            el: '#nav_bar',
            methods: {
                onClickLeft() {
                    history.go(-1);
                }
            }
        });
        new Vue({
            el: '#shop_info',
            data() {
                return {
                    hasData: _item !== false,
                    item: _item,
                    activeNames: []
                };
            },
            methods: {
                onSubmit(values) {
                    const that = this;
                    const loading = this.$toast.loading({
                        duration: 0,
                        message: '请稍后...',
                        forbidClick: true,
                        overlay: true
                    });
                    values['tid'] = _item['tid'];
                    values['del'] = values['del'] ? 0 : 1;
                    $.ajax({
                        type: 'POST',
                        url: '/ajax.php?act=postEditToolsPrice',
                        data: values,
                        dataType: 'json',
                        success(res) {
                            loading.clear();
                            if (res['code'] === 0) {
                                that.$toast.success({
                                    message: res['msg'],
                                    onClose() {
                                        history.go(-1);
                                    }
                                });
                                return false;
                            }
                            if (res['code'] === 1) {
                                that.$toast(res['msg']);
                                return false;
                            }
                            that.$toast.fail(res['msg']);
                        },
                        error() {
                            loading.clear();
                            that.$toast.fail('系统异常，请联系相关人员');
                        }
                    });
                }
            }
        });

        Vue.use(vant.Lazyload);
    </script>
<?php else: ?>
    <script>
        new Vue({
            el: '#nav_bar',
            methods: {
                onClickLeft() {
                    history.go(-1);
                },
                onClickRight() {
                    order_top.$data.show = true;
                }
            }
        });

        const order_list = new Vue({
            el: '#order_list',
            data() {
                return {
                    cid: 0,
                    loading: false,
                    finished: false,
                    refreshing: false,
                    list: [],
                    page: 1,
                    page_size: 10,
                    total: 0
                };
            },
            methods: {
                goodEdit(id) {
                    if (id) {
                        location.href = '/?mod=shopList&edit&tid=' + id;
                    }
                },
                async getList() {
                    let {data: res} = await this.informList({
                        page: this.page,
                        page_size: this.page_size,
                        cid: this.cid,
                    });
                    if (res.length === 0) { // 判断获取数据条数若等于0
                        this.list = []; // 清空数组
                        this.finished = true; // 停止加载
                    }
                    // 若数据条数不等于0
                    this.total = res.total;		// 给数据条数赋值
                    this.list.push(...res.list)	// 将数据放入list中
                    this.loading = false;			// 加载状态结束
                    order_top.$data.notify_text = '系统共有 ' + res.total + ' 个商品 - 提升价格赚的更多哦！提高价格最好不要太贵了否则没人买的哦';
                    // 如果list长度大于等于总数据条数,数据全部加载完成
                    if (this.list.length >= res.total) {
                        this.finished = true;		// 结束加载状态
                    }
                },
                async informList(data) {
                    data['act'] = 'getToolsList';
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
                    value1: 0,
                    option1: [
                        { text: '全部分类', value: 0}
                    ],
                    notify_text: '系统共有 0 个商品 - 提升价格赚的更多哦！提高价格最好不要太贵了否则没人买的哦',
                    show: false,
                    promote_price_show: false,
                    promote_price: '',
                    actions: [
                        { name: '恢复价格', type: 'recovery_price'},
                        { name: '提升售价', type: 'promote_price'}
                    ],
                }
            },
            mounted() {
                this.getGoodClass();
            },
            methods: {
                changeToolClass(value) {
                    order_list.$data.cid = value;
                    order_list.onRefresh();
                },
                promotePriceBeforeClose(action, done) { // 提升售价事件
                    const that = this;
                    if (action === 'confirm') {
                        if (!this.promote_price) {
                            this.$toast.fail('请输入价格提升百分比');
                            return done(false);
                        }
                        $.ajax({
                            type: 'POST',
                            url: '/ajax.php?act=postToolsUpPrice',
                            data: {
                                'zid': '<?php echo $userrow['zid']; ?>',
                                'up': this.promote_price
                            },
                            dataType: 'json',
                            success(res) {
                                if (res['code'] !== 0) {
                                    that.$toast.fail(res['msg']);
                                    return done(false);
                                }
                                that.$toast.success({
                                    message: '价格提升成功',
                                    onClose() {
                                        order_list.onRefresh();
                                    }
                                });
                                return done();
                            },
                            error() {
                                this.$toast.fail('系统异常，请联系相关人员');
                                return done(false);
                            }
                        });
                    } else {
                        return done();
                    }
                },
                onSelect(item) {
                    this.show = false;
                    const that = this;
                    if (item.type === 'recovery_price') { // 恢复价格
                        this.$dialog.confirm({
                            title: '温馨提示',
                            message: '是否要重置所有商品价格设定，恢复到最初状态',
                        }).then(() => {
                            const loading = that.$toast.loading({
                                duration: 0,
                                message: '请稍后...',
                                forbidClick: true,
                                overlay: true
                            });
                            $.ajax({
                                type: 'POST',
                                url: '/ajax.php?act=postResetToolsPrice',
                                dataType: 'json',
                                success(res) {
                                    loading.clear();
                                    if (res['code'] === 0) {
                                        that.$toast.success({
                                            message: res['msg'],
                                            onClose() {
                                                order_list.onRefresh();
                                            }
                                        });
                                        return false;
                                    }
                                    if (res['code'] === 1) {
                                        that.$toast(res['msg']);
                                        return false;
                                    }
                                    that.$toast.fail(res['msg']);
                                },
                                error() {
                                    loading.clear();
                                    that.$toast.fail('系统异常，请联系相关人员');
                                }
                            });
                        }).catch(() => {

                        });
                    } else if (item.type === 'promote_price') { // 提升售价
                        this.promote_price_show = true;
                    }
                },
                onCancel() {
                    this.show = false;
                },
                async getGoodClass() {
                    const that = this;
                    $.ajax({
                        url: '/ajax.php?act=getToolsClass',
                        cache: true,
                        dataType: 'json',
                        success(res) {
                            if (res['code'] !== 0) {
                                that.$toast(res['msg']);
                                return false;
                            }
                            if (res['data']) {
                                for (let item of res['data']) {
                                    that.option1.push(item);
                                }
                            }
                        },
                        error() {
                            that.$toast('系统异常，请联系相关人员');
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
