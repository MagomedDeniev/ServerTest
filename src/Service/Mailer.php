<?php

namespace App\Service;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

class Mailer
{
    public function __construct(
        private MailerInterface $mailer,
        private $email = '',
        private string $to = '',
        private string $subject = '',
        private string $template = '',
        public array $variables = []
    ) {}

    public function notify(): void
    {
        $email = (new TemplatedEmail())
            ->from(new Address($this->getFrom(), 'ServerTest'))
            ->to($this->getTo())
            ->subject($this->getSubject())
            ->htmlTemplate($this->getTemplate())
            ->context($this->getVariables());

        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $e) {
        }
    }

    public function getFrom()
    {
        return $this->email;
    }

    public function setFrom($email): Mailer
    {
        $this->email = $email;

        return $this;
    }

    public function getTo()
    {
        return $this->to;
    }

    public function setTo($to): Mailer
    {
        $this->to = $to;

        return $this;
    }

    public function getTemplate(): string
    {
        return $this->template;
    }

    public function setTemplate($template): Mailer
    {
        $this->template = $template;

        return $this;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function setSubject($subject): Mailer
    {
        $this->subject = $subject;

        return $this;
    }

    public function getVariables(): array
    {
        return $this->variables;
    }

    public function setVariables($variables): Mailer
    {
        $this->variables = $variables;

        return $this;
    }
}
