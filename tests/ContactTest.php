<?php

namespace App\Tests;


use App\Entity\Contact;
use App\Model\Message;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolation;

class ContactTest extends KernelTestCase
{
    public function getEntity(): Contact
    {
        $contact = new Contact();
        $contact->setEmail('eric@leemo.com');

        return $contact;
    }

    public function assertHasErrors(Contact $contact, int $number = 0)
    {
        self::bootKernel();
        $errors = self::$container->get('validator')->validate($contact);

        $errorsMessage = [];

        /** @var ConstraintViolation $error */
        foreach ($errors as $error){
            $errorsMessage[] = $error->getPropertyPath() . '=>' . $error->getMessage();
        }
        $this->assertCount($number, $errors, implode(',', $errorsMessage));
    }

    public function testValidModel()
    {
        $this->assertHasErrors($this->getEntity(), 0);
    }

    public function testInvalidEntity()
    {
        $contact = $this->getEntity();
        $contact->setEmail('eric@leemo');

        $this->assertHasErrors($contact, 1);
    }

    public function testInvalidBlankEmailEntity()
    {
        $contact = $this->getEntity();
        $contact->setEmail('');

        $this->assertHasErrors($contact, 1);
    }

}