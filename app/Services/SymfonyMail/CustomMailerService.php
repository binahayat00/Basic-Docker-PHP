<?php

namespace App\Services\SymfonyMail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Transport\TransportInterface;

class CustomMailerService implements MailerInterface
{
    protected TransportInterface $transport;
    public function __construct(protected string $dsn)
    {
        $this->transport = Transport::fromDsn($dsn);
    }
    function send(\Symfony\Component\Mime\RawMessage $message, \Symfony\Component\Mailer\Envelope|null $envelope = null): void
    {
        // $mailer = new Mailer\Mailer($transport);
        $this->transport->send($message, $envelope);
    }
}
