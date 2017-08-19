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
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('gender')->nullable();
            $table->string('referer')->nullable();
            $table->string('wechat')->nullable();
            $table->string('phone',20)->unique();
            $table->string('package')->nullable();
            $table->string('notes')->nullable();
            $table->string('operate')->nullable();
            $table->string('drainreason')->nullable();
            $table->string('inputer')->nullable();
            $table->string('advertisement')->nullable();
            $table->timestamp('allocated_at')->nullable();
            $table->timestamp('visit_at')->nullable();
            $table->string('status')->default('未分配');
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
