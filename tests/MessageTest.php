<?php

namespace App\Tests;


use App\Model\Message;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolation;

class MessageTest extends KernelTestCase
{
    public function getModel(): Message
    {
        $message = new Message();
        $message->setSubject('leemo');
        $message->setContent('on fait juste un test');
        $message->setSender('eric@leemo.com');
        $message->setReceiver('toto@gmail.com');

        return $message;
    }

    public function assertHasErrors(Message $message, int $number = 0)
    {
        self::bootKernel();
        $errors = self::$container->get('validator')->validate($message);

        $errorsMessage = [];

        /** @var ConstraintViolation $error */
        foreach ($errors as $error){
            $errorsMessage[] = $error->getPropertyPath() . '=>' . $error->getMessage();
        }
        $this->assertCount($number, $errors, implode(',', $errorsMessage));
    }

    public function testValidModel()
    {
        $this->assertHasErrors($this->getModel(), 0);
    }

    public function testInvalidModel()
    {
        $message = $this->getModel();
        $message->setSender('eric@leemo');

        $this->assertHasErrors($message, 1);
    }

    public function testInvalidBlankEmailModel()
    {
        $message = $this->getModel();
        $message->setSender('');
        $message->setReceiver('');

        $this->assertHasErrors($message, 2);
    }

    public function testInvalidBlankMessageModel()
    {
        $message = $this->getModel();
        $message->setContent('');

        $this->assertHasErrors($message, 1);
    }

    public function testInvalidBlankSubjectModel()
    {
        $message = $this->getModel();
        $message->setSubject('');

        $this->assertHasErrors($message, 1);
    }

}