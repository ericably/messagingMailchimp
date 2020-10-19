<?php

namespace App\Helper\Emailer;


use App\Entity\Contact;
use App\Entity\Conversation;
use App\Model\Message;

class FixturesEmailer implements EmailerInterface
{
    public function sendNewMessage(Message $message, Contact $contact, ?Conversation $conversation = null): bool
    {
        if($contact->getEmail()) {
            return true;
        }

        return false;
    }

    public function getConversationMessages(Conversation $conversation): array
    {
        return [
            [
                "sender" => "toto@email.com",
                "text" => "Hello It is mes",
                "receivers" => "tata@email.com",
            ],
            [
                "sender" => "tata@email.com",
                "text" => "WHo are you ",
                "receivers" => "toto@email.com",
            ],
            [
                "sender" => "toto@email.com",
                "text" => "toto and you",
                "receivers" => "tata@email.com",
            ],
            [
                "sender" => "tata@email.com",
                "text" => "tata is my name",
                "receivers" => "toto@email.com",
            ],
            [
                "sender" => "toto@email.com",
                "message" => "nice to meet you",
                "receivers" => "tata@email.com",
            ],
        ];
    }

    public function getSenderContactConversationMessage(Contact $contact, Conversation $conversation): array
    {
        if ("toto@email.com" === $contact->getEmail()) {
            return [
                [
                    "sender" => "toto@email.com",
                    "text" => "Hello It is mes",
                    "receivers" => "tata@email.com",
                ],
                [
                    "sender" => "toto@email.com",
                    "text" => "toto and you",
                    "receivers" => "tata@email.com",
                ],
                [
                    "sender" => "toto@email.com",
                    "text" => "nice to meet you",
                    "receivers" => "tata@email.com",
                ],
            ];
        }

        return [
            [
                "sender" => "tata@email.com",
                "text" => "WHo are you ",
                "receivers" => "toto@email.com",
            ],
            [
                "sender" => "tata@email.com",
                "text" => "tata is my name",
                "receivers" => "toto@email.com",
            ],
        ];
    }

    public function getConversationInfo(string $conversationId): array
    {
        // TODO: Implement getConversationInfo() method.
    }

    public function send(Message $message)
    {
        // TODO: Implement send() method.
    }
}