<?php

namespace App\Exception\Email;

class SendException extends \Exception
{
    protected $message = "Failed to Send Email!";
}
