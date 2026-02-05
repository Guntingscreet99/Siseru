<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;

class TwilioService
{
    protected $client;
    protected $from;

    public function __construct()
    {
        $this->client = new Client(config('services.twilio.sid'), config('services.twilio.token'));
        $this->from = config('services.twilio.from');
    }

    public function sendWhatsAppMessage($to, $body)
    {
        try {
            $message = $this->client->messages->create(
                "whatsapp:$to",
                [
                    "from" => $this->from,
                    "body" => $body
                ]
            );
            return $message->sid;
        } catch (\Exception $e) {
            Log::error('Twilio WhatsApp Error: ' . $e->getMessage());
            return false;
        }
    }
}
