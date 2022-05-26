<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillCassoLog extends Model
{
    use SoftDeletes;

    protected $table = "bill_casso_logs";

    const STATUS_SUCCESS = 1; //thanh toán thành công
    const STATUS_LACK = 2; //thanh toán thiếu
    const STATUS_DUPLICATE = 3; //Id đã được xử lý trước đây
    const STATUS_NO_ORDER = 4; //Order không tồn tại
}
