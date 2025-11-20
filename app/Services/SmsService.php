<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SmsService
{
    protected $apiKey;
    protected $senderId;

    public function __construct()
    {
        $this->apiKey = "VBcQnYEQrG5Oa6fujqSC";
        $this->senderId = "Pahar Theke";
    }

    /**
     * Send SMS
     */
    public function sendSms($number, $message)
    {
        $url = "http://bulksmsbd.net/api/smsapi";

        $response = Http::asForm()->post($url, [
            'api_key' => $this->apiKey,
            'type' => 'text',
            'senderid' => $this->senderId,
            'number' => $number,
            'message' => $message,
        ]);

        return $response->json();
    }

    /**
     * Check SMS Balance
     */
    public function getBalance()
    {
        $url = "http://bulksmsbd.net/api/getBalanceApi";

        $response = Http::asForm()->post($url, [
            'api_key' => $this->apiKey,
        ]);

        return $response->json();
    }
}
