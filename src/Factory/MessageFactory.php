<?php

namespace App\Factory;


use App\Model\Message;

class MessageFactory
{
    public function create(): Message
    {
        return new Message();
    }

}