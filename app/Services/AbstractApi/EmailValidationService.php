<?php

declare(strict_types=1);

namespace App\Services\AbstractApi;

use GuzzleHttp\Client;
use GuzzleHttp\Middleware;
use GuzzleHttp\HandlerStack;
use App\Enums\EmailValidations;
use App\DTO\EmailValidationResult;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\ConnectException;
use App\Contracts\Services\EmailValidationInterface;

class EmailValidationService implements EmailValidationInterface
{
    private $baseUrl = 'https://emailvalidation.abstractapi.com/v1/';
    public function __construct(private string $apiKey)
    {
    }

    public function verify(string $email): EmailValidationResult
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
        $query = [
            'email' => $email,
            'api_key' => $this->apiKey,
        ];

        $postfixUrl = '';
        $request = $client->get($postfixUrl, compact('query'));

        $body = json_decode($request->getBody()->getContents(), true);

        return new EmailValidationResult((int) ($body['quality_score'] * 100), $body['deliverability'] === EmailValidations::ABSTRACT_DELIVERABLE->value);
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
