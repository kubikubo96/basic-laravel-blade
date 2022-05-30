<?php

namespace App\Http\Controllers\Casso;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\BillCassoLog;
use App\Models\Order;
use App\Repositories\BillCassoLogRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EndpointWebhookCasso extends Controller
{
    const API_KEY = 'elcom-payment';

    //Danh sách id đã xử lý trước đây
    const ID_SEND = [4, 5, 6, 7, 8, 9];
    public $buillCassoLogRepo;

    public function __construct(BillCassoLogRepository $buillCassoLogRepo)
    {
        $this->buillCassoLogRepo = $buillCassoLogRepo;
    }

    function paymentHandler(Request $request): JsonResponse
    {
        $response = $request->all();
        $header = Helper::getHeader();
        Log::error('payment:', $response);
        Log::error('header:', $header);

        $secure_token = $header['Secure-Token'] ?? $header['secure-token'] ?? null;
        if ($secure_token != self::API_KEY) {
            Log::error('Error: Thiếu secure token hoặc secure token không khớp', $header);
            die();
        }
        if (empty($response) || empty($response['data'])) {
            Log::error('Error: Data rỗng', $response);
            die();
        }
        if ($response['error']) {
            Log::error('Error: Có lỗi xay ra ở phía Casso', $response);
            die();
        }

        $data = $response['data'];
        $params = [];
        foreach ($data as $key => $item) {
            $parse_desc = Helper::parseBillMessage($item['description']);
            $order_code = $parse_desc['order_code'];
            $customer_phone = $parse_desc['phone'];

            $params[$key]['id_bill'] = (int)$item['id'];
            $params[$key]['tid'] = $item['tid'];
            $params[$key]['description'] = $item['description'];
            $params[$key]['amount'] = (int)$item['amount'];
            $params[$key]['cusum_balance'] = (int)$item['cusum_balance'];
            $params[$key]['when'] = $item['when'];
            $params[$key]['bank_sub_acc_id'] = $item['bank_sub_acc_id'];
            $params[$key]['order_code'] = $order_code;
            $params[$key]['customer_phone'] = $customer_phone;
            $params[$key]['virtual_account'] = $item['virtualAccount'] ?? null;
            $params[$key]['virtual_account_name'] = $item['virtualAccountName']  ?? null;
            $params[$key]['corresponsive_name'] = $item['corresponsiveName'] ?? null;
            $params[$key]['corresponsive_account'] = $item['corresponsiveAccount'] ?? null;
            $params[$key]['corresponsive_bank_id'] = $item['corresponsiveBankId'] ?? null;
            $params[$key]['corresponsive_bank_name'] = $item['corresponsiveBankName'] ?? null;
            $params[$key]['created_at'] = $params[$key]['updated_at'] = Carbon::now();

            $bill_log = $this->buillCassoLogRepo->query(['id_bill' => (int)$item['id']])->first();
            if ($bill_log) {
                //order bị trùng lặp, do đã xử lý trước đây
                $params[$key]['status'] = BillCassoLog::STATUS_DUPLICATE;
            } else {
                $order = $this->orderRepository->getByCode($order_code);
                if(!$order) {
                    //không tìm thấy order
                    $params[$key]['status'] = BillCassoLog::STATUS_NO_ORDER;
                } else {
                    $order_money = abs($order['amount']);
                    $paid = $item['amount'];
                    if($paid < $order_money) {
                        //thanh toán bị thiếu
                        $params[$key]['status'] = BillCassoLog::STATUS_LACK;
                    } else {
                        //thanh toán thành công
                        $params[$key]['status'] = BillCassoLog::STATUS_SUCCESS;
                        $this->orderRepository->update(['status' => Order::STATUS_PAID]);
                    }
                }
            }

            try {
                $this->buillCassoLogRepo->create($params);
            } catch (Exception $e) {
                Log::error('Error khi lưu bills log: '. $e->getMessage(), $response);
            }
        }
    }
}
