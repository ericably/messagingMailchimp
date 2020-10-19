<?php

namespace App\Factory;


use App\Entity\Conversation;

class ConversationFactory
{
    public function create(): Conversation
    {
        return new Conversation();
    }
}