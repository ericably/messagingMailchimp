<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Message
{
    /**
     * @var string
     * @Assert\NotBlank()
     */
    private $subject;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Email(message="Veuillez saisir un email valide")
     *
     */
    private $sender;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    private $content;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Email(message="Veuillez saisir un email valide")
     *
     */
    private $receiver;

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     * @return Message
     */
    public function setSubject(string $subject): Message
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return string
     */
    public function getSender(): string
    {
        return $this->sender;
    }

    /**
     * @param string $sender
     * @return Message
     */
    public function setSender(string $sender): Message
    {
        $this->sender = $sender;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Message
     */
    public function setContent(string $content): Message
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return string
     */
    public function getReceiver(): string
    {
        return $this->receiver;
    }

    /**
     * @param string $receiver
     * @return Message
     */
    public function setReceiver(string $receiver): Message
    {
        $this->receiver = $receiver;
        return $this;
    }
}