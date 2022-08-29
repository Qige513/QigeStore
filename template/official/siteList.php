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
if ($userrow['power'] < 2) {
    exit('<script>alert("你没有权限使用此功能");history.go(-1);</script>');
}
$my = isset($_GET['act']) ? $_GET['act'] : null;
if ($my == 'add') {
    $domains = explode(',', $conf['fenzhan_domain']); // 分站可选域名列表
    $site_row = [];
} elseif ($my == 'list') {
    if (isset($_GET['zid'])) {
        $zid = intval($_GET['zid']);
        $where['AND'] = ['zid' => $zid, 'upzid' => $userrow['zid'], 'power' => 1];
    } elseif (isset($_GET['kw'])) {
        $kw = daddslashes($_GET['kw']);
        $where['AND'] = [
            'OR' => [
                'user' => $kw,
                'domain' => $kw,
                'qq' => $kw,
            ],
            'upzid' => $userrow['zid'],
            'power' => 1,
        ];
    } else {
        $where['AND'] = ['upzid' => $userrow['zid'], 'power' => 1];
    }
    $limit = 10;
    $pages = ceil($numrows / $limit);
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $offset = $limit * ($page - 1);
    $total = $DB->count('site', $where);
    $where['ORDER'] = ['zid' => 'DESC'];
    $where['LIMIT'] = [$offset, $limit];
    $data['list'] = $DB->select('site', '*', $where);
    $data['page'] = $page;
    $data['page_size'] = $limit;
    $data['total'] = $total;
    exitJson('success', 0, $data);
} elseif ($my == 'add_site') {
    $user = trim(htmlspecialchars(strip_tags(daddslashes($_POST['user']))));
    $pwd = trim(htmlspecialchars(strip_tags(daddslashes($_POST['pwd']))));
    $qz = trim(htmlspecialchars(strtolower(daddslashes($_POST['qz']))));
    $domain = trim(htmlspecialchars(strtolower(strip_tags(daddslashes($_POST['domain'])))));
    $qq = trim(htmlspecialchars(strip_tags(daddslashes($_POST['qq']))));
    $endtime = trim(htmlspecialchars(strip_tags(daddslashes($_POST['endTime']))));
    $sitename = trim(htmlspecialchars(strip_tags(daddslashes($_POST['siteName']))));
    $keywords = addslashes($conf['keywords']);
    $description = addslashes($conf['description']);
    $domain = $qz . '.' . $domain;
    $thtime = date('Y-m-d') . ' 00:00:00';
    if ($user == NULL or $pwd == NULL or $qz == NULL or $domain == NULL or $endtime == NULL) {
        exitJson('保存错误,请确保每项都不为空');
    } elseif (!in_array($_POST['domain'], explode(',', $conf['fenzhan_domain']))) {
        exitJson('域名后缀不存在');
    } elseif (strlen($qz) < 2 || strlen($qz) > 10 || !preg_match('/^[a-z0-9\-]+$/', $qz)) {
        exitJson('域名前缀不合格');
    } elseif (!preg_match('/^[a-zA-Z0-9]+$/', $user)) {
        exitJson('用户名只能为英文或数字');
    } elseif (!preg_match('/^[a-zA-Z0-9\_\-\.]+$/', $domain)) {
        exitJson('域名格式不正确');
    } elseif ($DB->has('site', ['user' => $user])) {
        exitJson('用户名已存在');
    } elseif (strlen($pwd) < 6) {
        exitJson('密码不能低于6位');
    } elseif (strlen($sitename) < 2) {
        exitJson('网站名称太短');
    } elseif (strlen($qq) < 5 || !preg_match('/^[0-9]+$/', $qq)) {
        exitJson('QQ格式不正确');
    } elseif ($DB->has('site', ['OR' => ['domain' => $domain, 'domain2' => $domain]]) || $qz == 'www' || $domain == $_SERVER['HTTP_HOST'] || in_array($domain, explode(',', $conf['fenzhan_remain']))) {
        exitJson('此前缀已被使用');
    } elseif ($DB->count('site', ['AND' => ['upzid' => $userrow['zid'], 'addtime[>]' => $thtime]]) > 20) {
        exitJson('你今天添加的分站较多，暂无法后台手动添加，请直接使用前台网址自助开通分站');
    } else {
        if ($conf['fenzhan_html'] == 1) {
            $anounce = addslashes($conf['anounce']);
            $alert = addslashes($conf['alert']);
        }
        $flag = $DB->insert('site', [
            'power' => 1,
            'upzid' => $userrow['zid'],
            'domain' => $domain,
            'domain2' => null,
            'user' => $user,
            'pwd' => $pwd,
            'rmb' => 0,
            'qq' => $qq,
            'sitename' => $sitename,
            'keywords' => $keywords,
            'description' => $description,
            'anounce' => $anounce,
            'alert' => $alert,
            'addtime' => $date,
            'endtime' => $endtime,
            'status' => 1,
        ]);
        if ($flag->rowCount()) {
            exitJson('添加分站成功', 0);
        } else {
            $err = $DB->error();
            exitJson('添加分站失败' . $err == '[]' ? '' : '，错误码：' . $err);
        }
    }
} elseif ($my == 'edit_site') {
    $zid = intval($_POST['zid']);
    $rows = $DB->get('site', '*', ['zid' => $zid, 'upzid' => $userrow['zid'], 'power' => 1]);
    if (!$rows) {
        exitJson('分站不存在');
    }
    $domain2 = trim(strtolower(htmlspecialchars(strip_tags(daddslashes($_POST['domain2'])))));
//                $qq       = trim(htmlspecialchars(strip_tags(daddslashes($_POST['qq']))));
    $endtime = trim(htmlspecialchars(strip_tags(daddslashes($_POST['endTime']))));
    $sitename = trim(htmlspecialchars(strip_tags(daddslashes($_POST['siteName']))));
    if ($sitename == NULL or $endtime == NULL) {
        exitJson('保存错误,请确保每项都不为空');
    } elseif (!empty($domain2) && !preg_match('/^[a-zA-Z0-9\_\-\.]+$/', $domain2)) {
        exitJson('域名格式不正确');
    } else {
        if (!empty($domain2) && $DB->has('site', ['OR' => ['domain' => $domain2, 'domain2' => $domain2, 'zid[!]' => $zid]]) || $domain2 == $_SERVER['HTTP_HOST'] || !empty($domain2) && (in_array($domain2, explode(',', $conf['fenzhan_remain'])) || in_array($domain2, explode(',', $conf['fenzhan_domain'])))) {
            exitJson('此域名已被使用');
        } elseif (strpos($domain2, 'www.') !== false) {
            $domain = str_replace('www.', '', $domain2);
            if (in_array($domain, explode(',', $conf['fenzhan_remain'])) || in_array($domain, explode(',', $conf['fenzhan_domain']))) {
                exitJson('此域名已被使用');
            }
        }
        $flag = $DB->update('site', ['domain2' => $domain2, 'sitename' => $sitename, 'endtime' => $endtime], ['zid' => $zid]);
        if ($flag->rowCount()) {
            exitJson('修改分站成功', 0);
        } else {
            $err = $DB->error();
            if ($err == '[]') {
                exitJson('未做任何修改', 1);
            }
            exitJson('修改分站失败，错误码：' . $err);
        }
    }
} elseif ($my == 'edit') {
    $domains = explode(',', $conf['fenzhan_domain']); // 分站可选域名列表
    $zid = intval($_GET['zid']);
    $site_row = $DB->get('site', [
        'zid', 'user', 'sitename', 'qq', 'rmb', 'addtime', 'endtime', 'domain', 'domain2'
    ], ['zid' => $zid, 'upzid' => $userrow['zid'], 'power' => 1]);
    if (empty($site_row)) {
        $site_row = [];
    } else {
        $site_row['endtime'] = date('Y-m-d', strtotime($site_row['endtime']));
    }
} else {
    if (isset($_GET['zid']) && !empty($_GET['zid'])) {
        $data = $DB->get('site', [
            'zid', 'user', 'sitename', 'qq', 'rmb', 'addtime', 'endtime', 'domain', 'domain2'
        ], ['zid' => trim($_GET['zid']), 'upzid' => $userrow['zid'], 'power' => 1]);
        if (!empty($data)) {
            $data['endtime'] = date('Y-m-d', strtotime($data['endtime']));
        }
    } else {
        $siteCount = $DB->count('site', ['upzid' => $userrow['zid'], 'power' => 1]);
    }
}
?>
<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>分站管理</title>
    <!-- 引入样式文件 -->
    <link rel="stylesheet" href="/assets/official/vant@2.8/lib/index.css"/>
    <style>
        [v-cloak] {
            display: none!important;
        }
    </style>
    <?php if ($my == 'add'): // 添加分站 ?>
        <style>
            section {
                margin-top: 46px;
            }

            #site_add {
                margin-top: 10px;
            }
        </style>
    <?php else: ?>
        <?php if (isset($_GET['zid']) && !empty($_GET['zid'])): ?>
            <style>
                section {
                    margin-top: 46px;
                }

                #app2 {
                    margin-top: 10px;
                }

                .site-edit {
                    margin: 10px 20px 0 20px;
                }
            </style>
        <?php else: ?>
            <style>
                section {
                    margin-top: 46px;
                }

                #app2 {
                    padding: 16px 16px 0 16px;
                    color: rgba(69, 90, 100, 0.6);
                    font-weight: normal;
                    font-size: 14px;
                    line-height: 16px;
                }

                .site-list {
                    margin-bottom: 10px;
                }
            </style>
        <?php endif;endif; ?>
</head>
<body style="background-color: #f7f8fa">
<?php if ($my == 'add' || $my == 'edit'): ?>
    <div id="app1" v-cloak>
        <van-nav-bar
                left-text="返回"
                left-arrow
                fixed
                :title="is_edit ? '修改分站' : '添加分站'"
                @click-left="onClickLeft"
        ></van-nav-bar>
    </div>
    <section>
        <div id="site_add" v-cloak>
            <van-form @submit="onSubmit">
                <van-field v-if="!is_edit" label-width="100px" v-model="user" name="user"
                           label="管理员用户名"
                           placeholder="用户名"
                           :rules="[{ required: true, message: '请填写管理员用户名' }]"
                ></van-field>
                <van-field v-if="!is_edit" label-width="100px" v-model="pwd" name="pwd"
                           label="管理员密码"
                           placeholder="管理员密码"
                           :rules="[{ required: true, message: '请填写管理员密码' }]"
                ></van-field>
                <van-field v-if="!is_edit" label-width="100px" v-model="qz" name="qz"
                           label="绑定域名"
                           placeholder="二级前缀域名"
                           :rules="[{ required: true, message: '请填写二级前缀' }]"
                ></van-field>
                <van-field v-if="is_edit" label-width="100px" v-model="domain" name="domain"
                           label="绑定域名"
                           disabled
                ></van-field>
                <van-field v-if="is_edit" label-width="100px" v-model="domain2" name="domain2"
                           label="额外域名"
                           placeholder="额外域名"
                ></van-field>
                <van-field
                        v-if="!is_edit"
                        label-width="100px"
                        readonly
                        clickable
                        name="domain"
                        :value="domain"
                        label="顶级域名"
                        placeholder="点击选择域名"
                        @click="showPicker = true"
                ></van-field>
                <van-popup v-if="!is_edit" v-model="showPicker" position="bottom">
                    <van-picker
                            show-toolbar
                            :columns="domains"
                            @confirm="onConfirm"
                            @cancel="showPicker = false"
                    ></van-picker>
                </van-popup>
                <van-field label-width="100px" v-model="siteName" name="siteName"
                           label="网站名称"
                           placeholder="网站名称"
                           :rules="[{ required: true, message: '请填写网站名称' }]"
                ></van-field>
                <van-field label-width="100px" v-model="qq" name="qq"
                           label="站长QQ"
                           placeholder="QQ号码"
                           :disabled="is_edit"
                           :rules="[{ required: true, message: '请填写站长QQ' }]"
                ></van-field>
                <van-field
                        label-width="100px"
                        readonly
                        clickable
                        name="endTime"
                        :value="endTime"
                        label="到期时间"
                        placeholder="点击选择日期"
                        @click="showCalendar = true"
                ></van-field>
                <van-calendar v-model="showCalendar" @confirm="onCalendarConfirm"></van-calendar>
                <div style="margin: 16px;">
                    <van-button round block type="info" native-type="submit">
                        {{is_edit ? '保存' : '添加'}}
                    </van-button>
                </div>
            </van-form>
        </div>
    </section>
<?php else: ?>
    <?php if (isset($_GET['zid']) && !empty($_GET['zid'])): ?>
        <div id="app1" v-cloak>
            <van-nav-bar
                    title="分站信息"
                    left-text="返回"
                    left-arrow
                    fixed
                    @click-left="onClickLeft"
            ></van-nav-bar>
        </div>
        <section>
            <div id="app2" v-cloak>
                <div v-if="hasData">
                    <van-cell title="ZID" :value="item['zid']"></van-cell>
                    <van-cell title="用户名" :value="item['user'] ? item['user'] : '暂无'"></van-cell>
                    <van-cell title="站点名称" :value="item['sitename'] ? item['sitename'] : '暂无'"></van-cell>
                    <van-cell title="站长QQ" :value="item['qq'] ? item['qq'] : '暂无'"></van-cell>
                    <van-cell title="余额" :value="'￥' + item['rmb']"></van-cell>
                    <van-cell title="开通时间" :value="item['addtime'] ? item['addtime'] : ''"></van-cell>
                    <van-cell title="到期时间" :value="item['endtime'] ? item['endtime'] : '永久'"></van-cell>
                    <van-cell title="绑定域名" :value="item['domain'] ? item['domain'] : '未绑定'"
                              :label="item['domain2'] ? '第二域名：' + item['domain2'] : ''"></van-cell>
                    <div class="site-edit">
                        <van-button type="info" round block
                                    @click="location.href = '/?mod=siteList&act=edit&zid=' + item['zid']">修改
                        </van-button>
                    </div>
                </div>
                <div v-else>
                    <van-empty description="分站信息不存在"></van-empty>
                </div>
            </div>
        </section>
    <?php else: ?>
        <div id="app1" v-cloak>
            <van-nav-bar
                    title="分站管理"
                    left-text="返回"
                    right-text="添加分站"
                    left-arrow
                    fixed
                    @click-left="onClickLeft"
                    @click-right="onClickRight"
            ></van-nav-bar>
        </div>
        <section>
            <h2 id="app2" v-cloak>你共有{{siteCount}}个下级分站</h2>
            <div id="app3" v-cloak>
                <van-pull-refresh v-model="refreshing" @refresh="onRefresh" >
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
                            <van-cell :title="item['zid'] + '：' + (item['sitename'] ? item['sitename'] : '暂无')"
                                      :value="item['zid']"
                                      :label="'绑定域名：' + (item['domain'] ? item['domain'] : '暂无')" is-link center
                                      @click="siteInfo(item['zid'])">
                                余额：{{item['rmb']}}
                            </van-cell>
                        </div>
                    </van-list>
                </van-pull-refresh>
            </div>
        </section>
    <?php endif;endif; ?>

<!-- 引入 Vue 和 Vant 的 JS 文件 -->
<script src="/assets/official/vue/dist/vue.min.js"></script>
<script src="/assets/official/vant@2.8/lib/vant.min.js"></script>
<script src="/assets/official/axios@0.19.2/dist/axios.min.js"></script>
<script src="/assets/jquery/2.1.4/jquery.min.js"></script>
<?php if ($my == 'add' || $my == 'edit'): ?>
    <script>
        const _domains = <?php echo json($domains); ?>;

        const defaultData = <?php echo json($site_row); ?>;

        new Vue({
            el: '#app1',
            data() {
                return {
                    is_edit: defaultData.length !== 0
                }
            },
            methods: {
                onClickLeft() {
                    history.go(-1);
                }
            }
        });

        const date = new Date();

        new Vue({
            el: '#site_add',
            data() {
                if (defaultData.length === 0) {
                    return {
                        user: '',
                        pwd: '123456',
                        qz: '',
                        domain: _domains[0] ? _domains[0] : '',
                        domains: _domains,
                        siteName: '',
                        qq: '',
                        showPicker: false,
                        endTime: `${date.getFullYear()}-${date.getMonth() + 1}-${date.getDate()}`,
                        showCalendar: false,
                        is_edit: false
                    }
                }
                return {
                    zid: defaultData['zid'],
                    user: defaultData['user'],
                    pwd: defaultData['pwd'],
                    qz: defaultData['pwd'],
                    domain: defaultData['domain'],
                    domains: _domains,
                    siteName: defaultData['sitename'],
                    qq: defaultData['qq'],
                    showPicker: false,
                    endTime: defaultData['endtime'],
                    showCalendar: false,
                    is_edit: true,
                    domain2: ''
                };
            },
            methods: {
                async onSubmit(values) {
                    const is_edit = defaultData.length !== 0;
                    if (is_edit) { // 编辑
                        values['zid'] = defaultData['zid'];
                    }
                    if (!is_edit && (!values['domain'] || values['domain'].length === 0)) {
                        this.$notify({type: 'danger', message: '请选择顶级域名'});
                        return false;
                    }
                    if (is_edit) {
                        delete values['domain'];
                    }
                    const that = this;
                    const loading = this.$toast.loading({
                        duration: 0,
                        message: '请稍后...',
                        forbidClick: true,
                        overlay: true
                    });
                    $.ajax({
                        type: 'POST',
                        url: '/?mod=siteList&act=' + (is_edit ? 'edit_site' : 'add_site'),
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
                },
                onConfirm(value) {
                    this.domain = value;
                    this.showPicker = false;
                },
                onCalendarConfirm(date) {
                    this.endTime = `${date.getFullYear()}-${date.getMonth() + 1}-${date.getDate()}`;
                    this.showCalendar = false;
                }
            }
        });

        Vue.use(vant.Lazyload);
    </script>
<?php else: ?>
<?php if (isset($_GET['zid']) && !empty($_GET['zid'])): ?>
    <script>
        const siteData = <?php echo json($data); ?>;
        new Vue({
            el: '#app1',
            methods: {
                onClickLeft() {
                    history.go(-1);
                },
            },
        });

        new Vue({
            el: '#app2',
            data() {
                return {
                    hasData: !!siteData,
                    item: siteData ? siteData : {}
                };
            }
        });

        // 通过 CDN 引入时不会自动注册 Lazyload 组件
        // 可以通过下面的方式手动注册
        Vue.use(vant.Lazyload);
    </script>
<?php else: ?>
    <script>
        new Vue({
            el: '#app1',
            methods: {
                onClickLeft() {
                    history.go(-1);
                },
                onClickRight() {
                    location.href = '/?mod=siteList&act=add';
                },
            },
        });

        new Vue({
            el: '#app2',
            data() {
                return {
                    siteCount: <?php echo $siteCount; ?>
                };
            }
        });

        new Vue({
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
                    activeName: '1'
                };
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
                    const {page, page_size} = this;
                    return new Promise((resolve, reject) => {
                        $.ajax({
                            url: '/?mod=siteList&act=list',
                            data: {
                                'page': page,
                                'limit': page_size,
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
                },
                siteInfo(zid) {
                    if (zid) {
                        location.href = '/?mod=siteList&zid=' + zid;
                    }
                }
            }
        });

        // 通过 CDN 引入时不会自动注册 Lazyload 组件
        // 可以通过下面的方式手动注册
        Vue.use(vant.Lazyload);
    </script>
<?php endif;
endif ?>
</body>
</html>