<?php

namespace Bobbybouwmann\Messenger;

use GuzzleHttp\Client;

class Messenger
{
    protected $accessToken = '';

    protected $baseUrl = 'https://graph.facebook.com/v2.6/me/messages';

    protected $config;

    public function __construct($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    public function send(Message $message, $recipient)
    {
        $data = $this->createDataForRequest($message->buildMessage(), $recipient);

        return $this->doRequest($data);
    }

    protected function createDataForRequest($messageData = [], $recipient)
    {
        return [
            'form_params' => [
                'recipient' => ['id' => $recipient],
                'message'   => $messageData,
            ],
        ];
    }

    protected function doRequest($data)
    {
        $url = $this->buildUrl();

        $client = new Client();
        $response = $client->request('POST', $url, $data);

        return $response;
    }

    protected function buildUrl()
    {
        return $this->baseUrl . '?access_token=' . $this->accessToken;
    }
}