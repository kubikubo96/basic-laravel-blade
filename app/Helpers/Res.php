<?php

namespace App\Helpers;

/**
 * Response Class helper
 */
class Res
{
    public static function data($data = [], $total = 0, $message = 'Successfully', $status = 200): array
    {
        return [
            'status' => $status,
            'message' => $message,
            'data' => $data,
            'total' => $total
        ];
    }

    public static function error($message = 'Forbidden', $status = 403): array
    {
        return self::data([], 0, $message, $status);
    }
}
