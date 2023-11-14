<?php

namespace App\Helper;

use function Symfony\Component\String\s;

class Messages
{

    private $_messages;


    public function __construct()
    {
        $message = \App\Models\Attribute::where(['key' => 'scheduledMessages'])->get();
        foreach ($message as $item) {
            $jsonData = json_decode($item->value);
            if ($jsonData->type == 'file') {
                $this->_messages[] = [
                    'image' => asset(data_get($jsonData, 'image')),
                    'ext' => data_get($jsonData, 'ext'),
                    'name' => data_get($jsonData, 'name'),
                    'type' => 'file',
                    'time' => $this->calculateTimeAsSecond((array)$jsonData),
                ];
            } else {
                $this->_messages[] = [
                    'type' => 'message',
                    'text' => data_get($jsonData, 'message'),
                    'time' => $this->calculateTimeAsSecond((array)$jsonData),
                ];
            }
        }
    }

    public static function get()
    {
        return (new self());
    }

    public function all()
    {
        return $this->_messages;
    }

    public function getTime($time)
    {
        return $this->_messages[$time];
    }

    function calculateTimeAsSecond($elements)
    {
        $dayOnSecond = $elements['day'] * 24 * 60 * 60;
        $hourOnSecond = $elements['hour'] * 60 * 60;
        $minuteOnSecond = $elements['minute'] * 60;
        $secondOnSecond = $elements['second'];
        return $dayOnSecond + $hourOnSecond + $minuteOnSecond + $secondOnSecond;
    }
}
