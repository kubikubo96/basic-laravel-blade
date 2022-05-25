<?php

namespace App\Http\Controllers\Casso;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EndpointWebhookCasso extends Controller
{
    //GIÁ TIỀN TỔNG CỘNG CỦA ĐƠN HÀNG GIẢ ĐỊNH.
    const ORDER_MONEY = 100000;

    //Số tiền chuyển thiếu tối đa mà hệ thống vẫn chấp nhận để xác nhận đã thanh toán
    const ACCEPTABLE_DIFFERENCE = 10000;

    //Tiền tố điền trước mã đơn hàng để tạo mã cho khách hàng chuyển tiền
    //Không phân biệt hoa thường  : DH123, dh123, Dh123, dH123 đều dc.
    const MEMO_PREFIX = 'thu';

    //Key bảo mật đã cấu hình bên Casso để chứng thực request
    const API_KEY = 'elcom-payment';

    //Danh sách id đã xử lý trước đây
    const ID_SEND = [4, 5, 6, 7, 8, 9];

    function paymentHandler(Request $request): JsonResponse
    {
        $response = $request->all();
        $headers = $this->getHeader();
        Log::info('data-payment', $response);
        Log::info('data-header', $headers);

        if (!isset($headers['Secure-Token']) || $headers['Secure-Token'] != self::API_KEY) {
            Log::info('Error: Thiếu Secure Token hoặc secure token không khớp', [$headers, $response]);
            die();
        }
        if (empty($response) || empty($response['data'])) {
            return response()->json(['success' => false, 'message' => 'Có lỗi xay ra ở phía Casso, Yc gửi lại webhook']);
        }
        if ($response['error']) {
            return response()->json(['success' => false, 'message' => 'Có lỗi xay ra ở phía Casso, Yc gửi lại webhook']);
        }

        $data = $response['data'];
        foreach ($data as $transaction) {
            if (!isset($transaction['id'])) {
                Log::info('Error: Id không tồn tại', $transaction);
                continue;
            }
            if (in_array($transaction['id'], self::ID_SEND)) {
                Log::info('Error: Id đã được xử lý trước đây', $transaction);
                continue;
            }

            $des = $transaction['description'];
            $order_id = $this->parseOrderId($des);

            if (is_null($order_id)) {
                Log::info('Error: Không nhận dạng được order_id từ nội dung chuyển tiền: ', $transaction->description);
                continue;
            }

            $paid = $transaction['amount'];
            $order_note = "Casso thông báo nhận ".number_format($paid)." VND".". nội dung: ".$des.". chuyển vào "."STK ".$transaction['bank_sub_acc_id'];
            $ACCEPTABLE_DIFFERENCE = abs(self::ACCEPTABLE_DIFFERENCE);

            if ($paid < self::ORDER_MONEY - $ACCEPTABLE_DIFFERENCE) {
                echo($order_note . '. Trạng thái đơn hàng đã được chuyển từ Tạm giữ sang Thanh toán thiếu.');

            } else if ($paid <= self::ORDER_MONEY + $ACCEPTABLE_DIFFERENCE) {
                // $order->payment_complete();//
                // wc_reduce_stock_levels($order_id);
                // $order->update_status('paid', $order_note); // order note is optional, if you want to  add a note to order
                echo($order_note . '. Trạng thái đơn hàng đã được chuyển từ Tạm giữ sang Đã thanh toán.');

            } else {
                echo($order_note . '. Trạng thái đơn hàng đã được chuyển từ Tạm giữ sang Thanh toán dư.');
                // $order->payment_complete();
                // wc_reduce_stock_levels($order_id);//final
                // $order->update_status('overpaid', $order_note); // order note is optional, if you want to  add a note to order

            }
        }
        echo "<div>Xử lý hoàn tất</div>";
        die();
    }

    function parseOrderId($des)
    {
        return self::MEMO_PREFIX;
        $re = '/' . self::MEMO_PREFIX . '\d+/mi';
        preg_match_all($re, $des, $matches, PREG_SET_ORDER);

        if (count($matches) == 0)
            return null;
        // Print the entire match result
        $orderCode = $matches[0][0];

        $prefixLength = strlen(self::MEMO_PREFIX);

        $orderId = intval(substr($orderCode, $prefixLength));

        return $orderId;
    }

    function getHeader(): array
    {
        $headers = array();

        $copy_server = array(
            'CONTENT_TYPE' => 'Content-Type',
            'CONTENT_LENGTH' => 'Content-Length',
            'CONTENT_MD5' => 'Content-Md5',
        );

        foreach ($_SERVER as $key => $value) {
            if (substr($key, 0, 5) === 'HTTP_') {
                $key = substr($key, 5);
                if (!isset($copy_server[$key]) || !isset($_SERVER[$key])) {
                    $key = str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', $key))));
                    $headers[$key] = $value;
                }
            } elseif (isset($copy_server[$key])) {
                $headers[$copy_server[$key]] = $value;
            }
        }

        if (!isset($headers['Authorization'])) {
            if (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
                $headers['Authorization'] = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
            } elseif (isset($_SERVER['PHP_AUTH_USER'])) {
                $basic_pass = $_SERVER['PHP_AUTH_PW'] ?? '';
                $headers['Authorization'] = 'Basic ' . base64_encode($_SERVER['PHP_AUTH_USER'] . ':' . $basic_pass);
            } elseif (isset($_SERVER['PHP_AUTH_DIGEST'])) {
                $headers['Authorization'] = $_SERVER['PHP_AUTH_DIGEST'];
            }
        }

        return $headers;
    }
}
