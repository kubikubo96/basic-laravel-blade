<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillCassoLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_casso_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('status')->comment('1: thanh toán ok, 2: thanh toán thiếu,  3: Id đã được xử lý trước đây, 4: Order không tồn tại');
            $table->integer('id_bill');
            $table->string('tid')->comment('mã giao dịch từ phía ngân hàng');
            $table->string('description')->comment('nội dung giao dịch');
            $table->bigInteger('amount')->comment('số tiền giao dịch');
            $table->bigInteger('cusum_balance')->comment('số tiền còn lại sau giao dịch');
            $table->timestamp('when')->comment('thời gian ghi có giao dịch ở ngân hàng');
            $table->string('bank_sub_acc_id')->comment('mã tài khoản ngân hàng được nhận tiền');
            $table->string('order_code');
            $table->string('customer_phone');
            $table->string('virtual_account')->nullable();
            $table->string('virtual_account_name')->nullable();
            $table->string('corresponsive_name')->nullable();
            $table->string('corresponsive_account')->nullable();
            $table->string('corresponsive_bank_id')->nullable();
            $table->string('corresponsive_bank_name')->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('orders_casso');
    }
}
