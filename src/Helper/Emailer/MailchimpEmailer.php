<?php

namespace App\Helper\Emailer;


use App\Entity\Contact;
use App\Entity\Conversation;
use App\Mandrill\TransactionalClient;
use App\Model\Message;
use App\Repository\ConversationRepository;

class MailchimpEmailer implements EmailerInterface
{
    /**
     * @var TransactionalClient
     */
    private $transactionalClient;

    /**
     * @var ConversationRepository
     */
    private $conversationRepository;

    public function __construct(TransactionalClient $transactionalClient, ConversationRepository $conversationRepository)
    {
        $this->transactionalClient = $transactionalClient;
        $this->conversationRepository = $conversationRepository;
    }

    public function sendNewMessage(Message $message, Contact $contact, ?Conversation $conversation = null): bool
    {
        $message = [
            "from_email" => $message->getSender(),
            "subject" => $message->getSubject(),
            "text" => $message->getContent(),
            "to" => [
                [
                    "email" => $message->getReceiver(),
                    "type" => "to"
                ]
            ]
        ];

        $this->transactionalClient->messages->send(["message" => $message]);

        return true;

    }

    public function getConversationMessages(Conversation $conversation): array
    {
        $repo = $this->conversationRepository->findOneBy(["id" => $conversation->getId()]);
        if ($repo !== null){
            $sender = $repo->getContact()->getEmail();
            $receiver = $repo->getReceiver()->getEmail();
        }

        $listMessages = $this->transactionalClient->messages->search();
        $listMessages = json_decode(json_encode($listMessages),true);

        $conversationMessages = [];
        if (isset($sender, $receiver)){
            foreach ($listMessages as $listMessage){
                if ($listMessage["email"] === $receiver
                    && $listMessage["sender"] === $sender
                    && $listMessage["state"] === "sent"){

                    $conversationMessages[] = $this->transactionalClient->messages->content(["id" => $listMessage["_id"]]);
                }
            }
        }

        return array_reverse(json_decode(json_encode($conversationMessages),true));
    }

    public function getSenderContactConversationMessage(Contact $contact, Conversation $conversation): array
    {
        // TODO: Implement getContactConversationMessage() method.
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