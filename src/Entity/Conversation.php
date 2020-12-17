<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConversationRepository::class)
 */
class Conversation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Conversation creator
     * @var Contact
     * @ORM\ManyToOne(targetEntity="Contact" , cascade={"persist", "remove"})
     */
    private $receiver;

    /**
     * Conversation creator
     * @var Contact
     * @ORM\ManyToOne(targetEntity="Contact")
     */
    private $contact;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Contact
     */
    public function getContact(): Contact
    {
        return $this->contact;
    }

    /**
     * @param Contact $contact
     */
    public function setContact(Contact $contact): void
    {
        $this->contact = $contact;
    }

    /**
     * @return Contact
     */
    public function getReceiver(): Contact
    {
        return $this->receiver;
    }

    /**
     * @param Contact $receiver
     */
    public function setReceiver(Contact $receiver): void
    {
        $this->receiver = $receiver;
    }

}
