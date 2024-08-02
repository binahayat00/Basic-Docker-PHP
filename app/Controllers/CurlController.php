<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Attributes\Get;
use App\Config;

class CurlController
{
    public function __construct(protected Config $config)
    {
    }

    #[Get('/curl')]
    public function index(): mixed
    {
        $url = "https://api.emailable.com/v1/verify?" . http_build_query($this->config->emailable);
        $handle = curl_init();

        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_HTTPGET, true);

        $response = curl_exec($handle);
        curl_close($handle);

        return $response;
    }
}
