<?php

namespace App\Controllers;

use App\View;
use App\Attributes\{
    Get,
    Post,
};
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

class UserController
{
    #[Get(path: "/users/create")]
    public function create(): View
    {
        return View::make("users/register");
    }

    #[Post(path: "/users")]
    public function register()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $firstName = explode(' ', $name)[0];

        $fromEmail = 'support@example.com';
        $fromName = 'Support';

        $text = <<<Body
        Hello $firstName,
        
        Thanks for siging up!
        Body;

        $html = View::make('emails/welcome', ['firstName' => $firstName])->render();

        (new \App\Models\Email())->queue(
            new Address($email,$name),
            new Address($fromEmail, $fromName),
            'Welcome',
            $html,
            $text
        );
    }
}
