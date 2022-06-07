<?php

namespace App\Services\Debug;

use GuzzleHttp\Client;

class TelegramService
{
    private static $_url = 'https://api.telegram.org/bot';
    private static $_token = '5331786755:AAGyyeSns6rrcsMPRWr8Za_IFOmxnnwLVLI';
    private static $_chat_id = '-667596845';

    public static function sending($text)
    {
        $uri = self::$_url . self::$_token . '/sendMessage?parse_mode=html';
        $params = [
            'chat_id' => self::$_chat_id,
            'text' => $text,
        ];
        $option['verify'] = false;
        $option['form_params'] = $params;
        $option['http_errors'] = false;
        $client = new Client();
        $response = $client->request("POST", $uri, $option);
        return json_decode($response->getBody(), true);
    }

    public static function sendError($e)
    {
        $html = '<b>[Lỗi] : </b><code>' . $e->getMessage() . '</code>';
        $html .= '<b>[File] : </b><code>' . $e->getFile() . '</code>';
        $html .= '<b>[Line] : </b><code>' . $e->getLine() . '</code>';
        $html .= '<b>[Request] : </b><code>' . json_encode(request()->all()) . '</code>';
        $html .= '<b>[URL] : </b><a href="' . url()->full() . '">' . url()->full() . '</a>';
        self::sending($html);
    }
}
