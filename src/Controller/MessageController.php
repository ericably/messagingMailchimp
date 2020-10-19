<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Factory\ContactFactory;
use App\Factory\ConversationFactory;
use App\Factory\MessageFactory;
use App\Helper\Emailer\EmailerInterface;
use App\Model\Message;
use App\Form\MessageType;
use App\Repository\ContactRepository;
use App\Repository\ConversationRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends AbstractController
{
    /**
     * @Route("/message", name="message")
     * @Route("/message/{conversationId}", name="message_conversation")
     */
    public function index(
        Request $request,
        EmailerInterface $emailer,
        ConversationFactory $conversationFactory,
        ConversationRepository $conversationRepository,
        ContactFactory $contactFactory,
        ContactRepository $contactRepository,
        MessageFactory $messageFactory
    ) {
        $conversationId = $request->get('conversationId');
        if ($conversationId) {
            $conversation = $conversationRepository->find($conversationId);
        } else {
            $conversation = $conversationFactory->create();
        }

        $message = $messageFactory->create();
        $message->setSender($this->getParameter('app_sender'));

        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        $conversationMessages = $emailer->getConversationMessages($conversation);

        if ($form->isSubmitted() && $form->isValid()){
            $contact = $contactFactory->create($message->getSender());
            $receiver = $contactFactory->create($message->getReceiver());
            $emailer->sendNewMessage($message, $contact);
            $conversationRepository->save($conversation);

            $conversation->setContact($contact);
            $conversation->setReceiver($receiver);
            $contactRepository->save($contact);

            $this->addFlash(
                'success',
                'Email envoyé'
            );
            return $this->redirectToRoute('message_conversation', ['conversationId' => $conversation->getId()]);
        }

        return $this->render('message/index.html.twig', [
            'form'=>$form->createView(),
            'conversation_messages' => $conversationMessages
        ]);
    }
}
