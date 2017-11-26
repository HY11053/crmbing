<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');//id
            $table->string('name')->nullable(); //姓名
            $table->string('gender')->nullable(); //性别
            $table->string('referer')->nullable(); //信息来源
            $table->string('wechat')->nullable();//微信
            $table->string('phone',20)->unique();//手机
            $table->string('package')->nullable();//套餐类型
            $table->string('advertisement')->nullable();//广告来源
            $table->string('notes')->nullable();//客户备注信息
            $table->string('status')->default('未分配');//客户分配状态
            $table->string('storestatus')->default('未接待');//客户接待状态
            $table->timestamp('allocated_at')->nullable();//电话客服领取时间
            $table->timestamp('reception_at')->nullable();//门店客服领取客户时间
            $table->timestamp('visit_at')->nullable();//客户来店时间
            $table->timestamp('successed_at')->nullable();//成单时间
            $table->string('inputer')->nullable();//信息录入者
            $table->string('operate')->nullable();//电话客服接待者
            $table->string('receptionist')->nullable();//门店客服接待者
            $table->string('finishuser')->nullable();//成单人员
            $table->integer('dealstatus')->default(0);//订单状态
            $table->integer('payment')->nullable();//已交金额
            $table->string('drainreason')->nullable();//退单原因
            $table->integer('follownum')->default(0);//跟进次数
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
        Schema::dropIfExists('customers');
    }
}
