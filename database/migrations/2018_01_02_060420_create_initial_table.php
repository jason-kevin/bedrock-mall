<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInitialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * 系统管理员表
         */
        Schema::create('managers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('管理员姓名')->index();
            $table->string('ent_key')->comment('所属企业 KEY')->index();
            $table->string('status')->default('NORMAL')->comment('管理员状态');
            $table->string('mobile')->comment('管理员手机号')->index();
            $table->string('password')->comment('管理员密码');
            $table->timestamps();
        });

        /**
         * 企业店铺表
         */
        Schema::create('stores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ent_key')->comment('店铺所属企业 KEY')->index();
            $table->string('short_id')->comment('店铺短 ID')->index();
            $table->string('name')->comment('店铺名称')->index();
            $table->string('logo')->comment('店铺 LOGO');
            $table->string('real_name')->comment('所有人姓名');
            $table->string('mobile')->comment('店铺电话');
            $table->smallInteger('level')->nullable()->comment('店铺等级');
            $table->string('province')->comment('所属省');
            $table->string('city')->comment('所属市');
            $table->string('district')->comment('所属县');
            $table->string('address')->comment('具体地址');
            $table->string('status')->default('NORMAL')->comment('店铺状态');
            $table->text('desc')->nullable()->comment('店铺说明');
            $table->timestamps();
            $table->softDeletes();
        });

        /**
         * 企业会员表
         */
        Schema::create('buyers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ent_key')->comment('所属企业 KEY')->index();
            $table->string('openid')->comment('会员微信 openid');
            $table->string('real_name')->comment('会员真名')->index();
            $table->string('mobile')->comment('会员手机号')->index();
            $table->string('password')->comment('会员密码')->index();
            $table->string('nick_name')->comment('会员昵称')->index();
            $table->string('avatar')->comment('会员头像');
            $table->string('gender')->comment('会员性别');
            $table->date('birthday')->comment('会员生日');
            $table->smallInteger('age')->comment('会员年龄');
            $table->smallInteger('company_id')->default(0)->comment('所属公司');
            $table->string('status')->default('NORMAL')->comment('会员状态');
            $table->string('province')->comment('所属省');
            $table->string('city')->comment('所属市');
            $table->timestamps();
            $table->softDeletes();
        });

        /**
         * 企业详情表
         */
        Schema::create('enterprises', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ent_key')->comment('企业唯一 KEY')->index();
            $table->string('name')->comment('企业名称');
            $table->string('phone')->comment('企业联系电话');
            $table->string('email')->comment('企业联系邮箱');
            $table->string('province')->comment('企业所属省');
            $table->string('city')->comment('企业所属市');
            $table->string('country')->comment('企业所属区、县');
            $table->string('address')->comment('企业具体地址');
            $table->string('status')->comment('企业状态');
            $table->timestamps();
            $table->softDeletes();
        });

        /**
         * 公司表
         */
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ent_key')->comment('所属企业 KEY')->index();
            $table->string('name')->comment('公司名称')->index();
            $table->string('status')->comment('公司状态');
            $table->timestamps();
        });

        /**
         * 会员地址表
         */
        Schema::create('buyer_address', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('buyer_id')->comment('会员 ID')->index();
            $table->string('receiver')->comment('收件人姓名');
            $table->string('mobile')->comment('收件人电话');
            $table->integer('country_id')->comment('区县 ID');
            $table->tinyInteger('is_default')->comment('是否为默认');
            $table->string('postcode')->nullable()->comment('邮编');
            $table->string('address')->comment('详细地址');
            $table->timestamps();
        });

        /**
         * 商城订单表
         */
        Schema::create('orders', function (Blueprint $table) {
            $table->string('order_no')->comment('订单号')->primary('order_no');
            $table->string('ent_key')->comment('所属企业 KEY');
            $table->string('title')->comment('订单名称');
            $table->integer('buyer_id')->comment('会员 ID')->index();
            $table->string('buyer_nick')->comment('买家姓名');
            $table->string('buyer_avatar')->comment('买家头像');
            $table->string('checkout_method')->comment('购物类型');
            $table->string('store_short_id')->comment('店铺 short_id');
            $table->string('paren_order_no')->comment('父类订单号');
            $table->string('shipper_type')->comment('发货类型');
            $table->smallInteger('item_quantity')->comment('商品数量');
            $table->integer('total_fee')->comment('商品总价');
            $table->integer('discounted_price')->comment('商品总优惠价');
            $table->integer('post_fee')->comment('订单邮费');
            $table->integer('amount')->comment('订单总价');
            $table->integer('express_id')->nullable()->comment('物流 ID');
            $table->string('express_name')->nullable()->comment('物流名称');
            $table->string('express_number')->nullable()->comment('物流单号');
            $table->string('buyer_message')->nullable()->comment('买家留言');
            $table->integer('receiver_county_id')->comment('收件人县 ID');
            $table->string('receiver_province')->comment('收件人省');
            $table->string('receiver_city')->comment('收件人市');
            $table->string('receiver_county')->comment('收件人县');
            $table->string('receiver_address')->comment('收件人详细地址');
            $table->string('receiver')->comment('收件人详细地址');
            $table->string('receiver_mobile')->comment('收件人电话');
            $table->string('payment_no')->nullable()->comment('支付订单号');
            $table->string('payment_type')->nullable()->comment('支付类型');
            $table->timestamp('paid_at')->nullable()->comment('支付时间');
            $table->timestamp('consigned_at')->nullable()->comment('发货时间');
            $table->string('consigned_by')->nullable()->comment('发货人');
            $table->timestamp('receiver_at')->nullable()->comment('签收时间');
            $table->timestamp('closed_at')->nullable()->comment('订单关闭时间');
            $table->tinyInteger('objection')->default(0)->comment('是否为异议订单');
            $table->string('status')->comment('订单状态');
            $table->string('refund_no')->nullable()->comment('订单退款号');
            $table->string('refund_status')->nullable()->comment('订单退款状态');
            $table->timestamp('refund_at')->nullable()->comment('退款时间');
            $table->timestamps();
            $table->softDeletes();
        });

        /**
         * 商品订单表
         */
        Schema::create('order_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_no')->comment('所属订单号')->index();
            $table->integer('item_id')->comment('商品 id')->index();
            $table->string('store_short_id')->comment('订单所属店铺 short_id');
            $table->string('item_name')->comment('商品名称');
            $table->integer('price')->comment('商品单价');
            $table->integer('original_price')->comment('商品原价');
            $table->integer('quantity')->comment('商品数量');
            $table->string('image_url')->comment('商品主图');
            $table->string('image_thumb_url')->comment('商品缩略图');
            $table->integer('sku_id')->comment('商品 SKU ID');
            $table->integer('total_fee')->comment('商品总价');
            $table->integer('discounted_price')->default(0)->comment('商品优惠总额');
            $table->timestamps();
            $table->softDeletes();
        });

        /**
         * 订单支付表
         */
        Schema::create('payments', function (Blueprint $table) {
            $table->string('payment_no')->comment('支付流水号')->primary('payment_no');
            $table->string('ent_key')->comment('所属企业 KEY')->index();
            $table->string('order_no')->comment('所属订单号')->index();
            $table->string('title')->comment('支付订单名称');
            $table->string('third_gateway')->comment('第三方支付网关');
            $table->string('third_no')->nullable()->comment('第三方支付单号');
            $table->integer('buyer_id')->comment('支付会员 ID');
            $table->integer('amount')->comment('支付总额');
            $table->timestamps();
            $table->softDeletes();
        });

        /**
         * 商品表
         */
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ent_key')->comment('商品所属企业 key')->index();
            $table->integer('category_id')->comment('商品种类 ID');
            $table->string('name')->comment('商品名称')->index();
            $table->string('sub_name')->comment('商品副名称');
            $table->integer('min_price')->comment('商品最低价');
            $table->integer('original_price')->comment('商品原价');
            $table->integer('total_stock')->comment('商品总库存');
            $table->integer('sales')->comment('商品售卖量');
            $table->integer('original_price')->comment('商品原价');
            $table->string('image_url')->comment('商品主图');
            $table->string('image_thumb_url')->comment('商品缩略图');
            $table->string('short_url')->comment('商品短网址');
            $table->string('sn')->comment('商品货号');
            $table->tinyInteger('is_multi_specifications')->default(0)->comment('商品是否为多规格商品');
            $table->tinyInteger('is_purchase_limited')->default(0)->comment('商品是否为限购商品');
            $table->smallInteger('purchase_limited_num')->default(0)->comment('商品限购商量');
            $table->tinyInteger('is_selling')->default(0)->comment('商品是否在售');
            $table->string('store_short_id')->comment('商品所属店铺');
            $table->timestamps();
            $table->softDeletes();
        });

        /**
         * 商品 SKU 表
         */
        Schema::create('skus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ent_key')->comment('商品所属企业 key');
            $table->string('sn')->comment('商品规格');
            $table->integer('item_id')->comment('所属商品 ID');
            $table->integer('min_price')->comment('商品最低价');
            $table->integer('original_price')->comment('商品原价');
            $table->integer('total_stock')->comment('商品总库存');
            $table->integer('sales')->comment('商品售卖量');
            $table->string('speci_identifier')->comment('商品规格列表');
            $table->timestamps();
            $table->softDeletes();
        });

        /**
         * 商品种类表
         */
        Schema::create('categories', function (Blueprint $table){
            $table->increments('id');
            $table->string('ent_key')->comment('种类品所属企业 key');
            $table->string('name')->comment('种类名称');
            $table->integer('parent_id')->comment('父类 ID');
            $table->timestamps();
        });

        /**
         * 商品规格名称表
         */
        Schema::create('specifications', function (Blueprint $table){
            $table->increments('id');
            $table->string('name')->comment('特性名称');
            $table->integer('sort')->comment('排序');
            $table->timestamps();
        });

        /**
         * 商品规格名称值表
         */
        Schema::create('specification_values', function (Blueprint $table){
            $table->increments('id');
            $table->string('name')->comment('特性名称');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('managers');
        Schema::dropIfExists('stores');
        Schema::dropIfExists('buyers');
        Schema::dropIfExists('enterprises');
        Schema::dropIfExists('companies');
        Schema::dropIfExists('buyer_address');
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('items');
        Schema::dropIfExists('skus');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('specifications');
        Schema::dropIfExists('specification_values');
    }
}
