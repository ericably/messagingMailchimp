<?php

namespace App\Factory;

use App\Entity\Contact;

class ContactFactory
{
    public function create(string $email): Contact
    {
        $contact = new Contact();
        $contact->setEmail($email);

        return $contact;
    }

}