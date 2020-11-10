<?php

namespace S25\RatesApiClient\Request;

use GuzzleHttp\Promise\PromiseInterface;
use S25\RatesApiClient\Contracts\Request\BaseRequest as BaseRequestContract;
use S25\RatesApiClient\Exception\RequestSetupException;

abstract class BaseRequest implements BaseRequestContract
{
    private $performCallback;

    public function __construct(callable $performCallback)
    {
        $this->performCallback = $performCallback;
    }

    protected function requestMethod(): string
    {
        return 'GET';
    }

    abstract protected function requestEndpoint(): string;

    protected function requestData(): ?array
    {
        return null;
    }

    protected function validateSetup(): array
    {
        return [];
    }

    protected function transformResult($data)
    {
        return $data;
    }

    public function performAsync(): PromiseInterface
    {
        $errors = $this->validateSetup();

        if ($errors) {
            $errorMessage = implode('; ', $errors);

            throw new RequestSetupException($errorMessage);
        }

        /** @var PromiseInterface $promise */
        $promise = ($this->performCallback)($this->requestMethod(), $this->requestEndpoint(), $this->requestData());

        return $promise->then(\Closure::fromCallable([$this, 'transformResult']));
    }

    public function perform()
    {
        $promise = $this->performAsync();

        return $promise->wait(true);
    }
}