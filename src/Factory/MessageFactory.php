<?php

namespace App\Factory;


use App\Model\Message;

class MessageFactory
{
    public function create(string  $email): Message
    {
        $message = new Message();
        $message->setSender($email);

        return $message;
    }
}