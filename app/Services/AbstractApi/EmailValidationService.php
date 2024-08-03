<?php

namespace App\Services\AbstractApi;

use App\Contracts\Services\EmailValidationInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class EmailValidationService implements EmailValidationInterface
{
    private $baseUrl = 'https://emailvalidation.abstractapi.com/v1/';
    public function __construct(private string $apiKey)
    {
    }

    public function verify(string $email): array
    {
        $stack = HandlerStack::create();

        $maxRetries = 3;

        $stack->push($this->getRetryMiddleware($maxRetries));

        $client = new Client(
            [
                'base_uri' => $this->baseUrl,
                'timeout' => 5,
                'handler' => $stack,
            ]
        );
        // $handle = curl_init();
        $query = [
            'email' => $email,
            'api_key' => $this->apiKey,
        ];

        $postfixUrl = '';
        // $url = $this->baseUrl . "verify?" . http_build_query($params);
        $request = $client->get($postfixUrl, compact('query'));
        // curl_setopt($handle, CURLOPT_URL, $url);
        // curl_setopt($handle, CURLOPT_HTTPGET, true);


        // curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

        // $response = curl_exec($handle);
        // curl_close($handle);

        return json_decode($request->getBody()->getContents(), true);
    }

    public function getRetryMiddleware(int $maxRetries)
    {
        return Middleware::retry(
            function (int $retries, RequestInterface $request, ?ResponseInterface $response = null, ?\RuntimeException $exception = null) use ($maxRetries) {
                if ($retries >= $maxRetries) {                    
                    return false;
                }

                if ($response && in_array($response->getStatusCode(), [249, 429, 503])) {                    
                    return true;
                }

                if ($exception instanceof ConnectException) {                    
                    return true;
                }

                return false;
            }
        );
    }
}
