<div class="block adminDiscountMenu">
    <div class="block-title">
        <h3 class="panel-title">商品折扣优惠活动</h3>
    </div>
    <div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label>折扣类型:</label><br>
                    <select class="form-control" name="discount_type">
                        <option value="0">百分比减免</option>
                        <option value="1">固定金额减免</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>折扣值:</label><br>
                    <input type="text" class="form-control" name="discount_value" placeholder="例如 98">
                </div>
            </div>
            <pre><span style="color: red">百分比减免填写98 就是98折，70就是7折,如果超过100则为增加金额</span></pre>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label>优惠开始时间:</label><br>
                    <input type="datetime-local" class="form-control" name="discount_start_time">
                </div>
                <div class="col-md-6">
                    <label>优惠结束时间:</label><br>
                    <input type="datetime-local" class="form-control" name="discount_end_time">
                </div>
            </div>
            <pre><span style="color: red">开始时间不填默认现在开始，结束时间不填默认不结束，两个时间都不填默认不限制结束时间。</span></pre>
        </div>
        <span style="display: block;">适用支付类型</span>
        <div class="form-inline checkbox" style="display: inline-block;margin-right: 10px;">
            <label>
                <input type="checkbox" class="form-control" name="discount_is_alipay">
                <span>
                    支付宝支付
                </span>
            </label>
        </div>
        <div class="form-inline checkbox" style="display: inline-block;margin-right: 10px;">
            <label>
                <input type="checkbox" class="form-control" name="discount_is_wxpay">
                <span>
                    微信支付
                </span>
            </label>
        </div>
        <div class="form-inline checkbox" style="display: inline-block;margin-right: 10px;">
            <label>
                <input type="checkbox" class="form-control" name="discount_is_qqpay">
                <span>
                     QQ钱包
                </span>
            </label>
        </div>
        <span style="display: block">适用范围用户</span>
        <div class="form-inline checkbox" style="display: inline-block;margin-right: 10px;">
            <label>
                <input type="checkbox" class="form-control" name="discount_is_user_type_0">
                <span>
                    未注册用户
                </span>
            </label>
        </div>
        <div class="form-inline checkbox" style="display: inline-block;margin-right: 10px;">
            <label>
                <input type="checkbox" class="form-control" name="discount_is_user_type_1">
                <span>
                普通版用户
            </span>
            </label>
        </div>
        <div class="form-inline checkbox" style="display: inline-block;margin-right: 10px;">
            <label>
                <input type="checkbox" class="form-control" name="discount_is_user_type_2">
                <span>
                专业版用户
            </span>
            </label>
        </div>
    </div>
</div>
<style>
    .adminDiscountMenu .form-inline.checkbox > label > input[type="checkbox"] {
        width: 18px;
        margin-top: -6px;
    }

    .adminDiscountMenu .checkbox label, .radio label {
        margin-bottom: 5px;
    }
</style>
<script>
    const discountData = '%tempData%';
    $(function ($) {
        $.each(discountData, function (key, value) {
            let dom = $('[name="' + key + '"]');

            if (dom.is('[type="checkbox"]')) {
                dom.attr('checked', value);
            } else if (dom.is('[type="datetime-local"]')) {
                let date = new Date(value * 1000);
                let strDate = date.getFullYear() + '-';

                if (date.getMonth() < 10)
                    strDate += '0' + date.getMonth() + '-';
                else
                    strDate += date.getMonth() + '-';

                if (date.getDate() < 10)
                    strDate += '0' + date.getDate() + 'T';
                else
                    strDate += date.getDate() + 'T';


                if (date.getHours() < 10)
                    strDate += '0' + date.getHours() + ':';
                else
                    strDate += date.getHours() + ':';

                if (date.getMinutes() < 10)
                    strDate += '0' + date.getMinutes();
                else
                    strDate += date.getMinutes();

                dom.val(strDate);
            } else {
                dom.val(value);
            }
        });
    });
</script>
