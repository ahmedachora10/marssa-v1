<?php

namespace App\Helper;

use Illuminate\Support\Facades\Log;

class Ws
{

    private $_apiKey;
    private $_instanceID;
    private $_status;
    public $message;
    public $phone;
    public $url;
    public $fileUrl;
    public $fileExt;
    private $type = "message";

    public function __construct($phone, $message = null)
    {
        $this->phone = $phone;
        $this->message = $message;
        $accessInfo = \App\Models\Attribute::where(['key' => 'whatsappApi', 'store_id' => 1])->first();
        $this->_apiKey = data_get(json_decode($accessInfo->value), 'token');
        $this->_instanceID = data_get(json_decode($accessInfo->value), 'instance_id');
        $this->_status = data_get(json_decode($accessInfo->value), 'status');
        $this->url = 'https://api.chat-api.com/instance' . $this->_instanceID . '/message?token=' . $this->_apiKey;
    }

    public static function make($phone, $message = null)
    {
        return new self($phone, $message);
    }

    public function asFile($fileUrl, $ext)
    {
        $this->fileUrl = $fileUrl;
        $this->fileExt = $ext;
        $this->url = 'https://api.chat-api.com/instance' . $this->_instanceID . '/sendFile?token=' . $this->_apiKey;
        $this->type = "sendFile";
        return $this;
    }

    public function send()
    {
        if ($this->_status != false) {
            try {
//                if (str_contains($this->phone, '+222') || str_contains($this->phone, '222')) {
                    $data = [
                        'phone' => $this->phone, // Receivers phone
                        'body' => $this->message == null ? $this->fileUrl : $this->message, // Message
                    ];
                    if ($this->message == null) {
                        $data['filename'] = $this->fileExt;
                    }
                    $json = json_encode($data); // Encode data to JSON
                    // Make a POST request
                    $options = stream_context_create(['http' => [
                        'method' => 'POST',
                        'header' => 'Content-type: application/json',
                        'content' => $json
                    ]
                    ]);
                    // Send a request
                    $result = file_get_contents($this->url, false, $options);
                    Log::info($result);
//                }
            } catch (\Exception $e) {

            }
        }
    }


}