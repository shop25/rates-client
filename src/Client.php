<?php

namespace S25\RatesApiClient;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use S25\RatesApiClient\Exception\ValidationException;

class Client implements Contracts\Client
{
    private \Closure $performCallback;

    public function __construct(string $serviceUrl)
    {
        $serviceUrl = rtrim($serviceUrl, '/');

        $guzzle = new GuzzleClient(
            [
                'base_uri' => "{$serviceUrl}/api/v1.0/",
                'headers' => [
                    'X-Requested-With' => 'XMLHttpRequest',
                ],
            ]
        );

        $this->performCallback = function (string $method, string $endpoint, $data) use ($guzzle) {
            $promise = $guzzle->requestAsync($method, $endpoint, ['json' => $data]);

            return $promise->then(
                \Closure::fromCallable([$this, 'getJson']),
                \Closure::fromCallable([$this, 'handleValidationError'])
            );
        };
    }

    public function requestRates(): Contracts\Request\RatesRequest
    {
        return new Request\RatesRequest($this->performCallback);
    }

    private function getJson(ResponseInterface $response)
    {
        $contents = $response->getBody()->getContents();

        return json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
    }

    private function getErrors(ResponseInterface $response): array
    {
        $errors = $this->getJson($response)['errors'] ?? null;

        return is_array($errors) ? $errors : [];
    }

    private function handleValidationError($exception): void
    {
        if (!$exception instanceof RequestException) {
            throw $exception;
        }

        $response = $exception->getResponse();

        if (!$response || $response->getStatusCode() !== 422) {
            throw $exception;
        }

        $request = $exception->getRequest();

        throw new ValidationException(
            "В запросе {$request->getMethod()} {$request->getUri()} переданы некорректные данные",
            $this->getErrors($response)
        );
    }
}