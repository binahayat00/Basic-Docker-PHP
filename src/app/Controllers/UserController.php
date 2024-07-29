<?php

namespace App\Controllers;

use App\View;
use App\Attributes\{
    Get,
    Post,
};
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class UserController
{
    public function __construct(protected MailerInterface $mailer)
    {

    }
    #[Get(path:"/users/create")]
    public function create(): View
    {
        return View::make("users/register");
    }

    #[Post(path:"/users")]
    public function register()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $firstName = explode(' ', $name)[0];

        $text = <<<Body
        Hello $firstName,
        
        Thanks for siging up!
        Body;

        $html = View::make('emails/welcome', ['firstName' => $firstName])->render();

        $email = (new Email())
                    ->from('support@example.com')
                    ->to($email)
                    ->subject('Welcome!')
                    ->attach('Welcome File!','welcome.txt')
                    ->text($text)
                    ->html($html);

        $this->mailer->send($email);
    }
}
