<?php

namespace App\Helper\Emailer;


use App\Entity\Contact;
use App\Entity\Conversation;
use App\Model\Message;

interface EmailerInterface
{
    public function sendNewMessage(Message $message, Contact $contact, ?Conversation $conversation = null): bool;

    public function getConversationMessages(Conversation $conversation): array;

    public function getSenderContactConversationMessage(Contact $contact, Conversation $conversation): array;

    public function getConversationInfo(string $conversationId): array;

    public function send(Message $message);
}