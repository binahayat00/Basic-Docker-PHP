<?php

namespace App\Services\Emailable;

class EmailValidationService
{
    private $baseUrl = 'https://api.emailable.com/v1/';
    public function __construct(private string $apiKey)
    {
    }

    public function verify(string $email): array
    {
        $params = [
            'email' => $email,
            'api_key' => $this->apiKey,
        ];
        $url = $this->baseUrl . "verify?" . http_build_query($params);
        $handle = curl_init();

        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_HTTPGET, true);

        $response = curl_exec($handle);
        curl_close($handle);

        if($response !== false){
            return json_decode($response, true);
        }

        return [];
    }
}
