<?php

namespace App\Helper\Emailer;


use App\Entity\Contact;
use App\Entity\Conversation;
use App\Model\Message;
use Twig\Environment;
use \Swift_Mailer;
use \Swift_Message;

class SwiftEmailer implements EmailerInterface
{
    /**
     * @var Swift_Mailer
     */
    private $mailer;

    /**
     * @var Environment
     */
    private $renderer;

    public function __construct(Swift_Mailer $mailer, Environment $renderer)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }

    public function sendNewMessage(Message $message, Contact $contact, ?Conversation $conversation = null): bool
    {
        $message = (new Swift_Message())
            ->setSubject($message->getSubject())
            ->setFrom($message->getSender())
            ->setTo($message->getReceiver())
            ->setReplyTo($message->getReceiver())
            ->setBody($message->getContent())
        ;

        $this->mailer->send($message);

        return true;
    }

    public function getConversationMessages(Conversation $conversation): array
    {
        // TODO: Implement getConversationMessages() method.
    }

    public function getSenderContactConversationMessage(Contact $contact, Conversation $conversation): array
    {
        // TODO: Implement getSenderContactConversationMessage() method.
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