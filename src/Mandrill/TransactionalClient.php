<?php
declare(strict_types=1);

namespace App\Mandrill;

use MailchimpTransactional\ApiClient;

class TransactionalClient extends ApiClient
{
    public function __construct(string $transactionalApiKey)
    {
        parent::__construct();
        $this->setApiKey($transactionalApiKey);
    }
}