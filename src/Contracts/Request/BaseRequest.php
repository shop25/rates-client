<?php

namespace S25\RatesApiClient\Contracts\Request;

use GuzzleHttp\Promise\PromiseInterface;

interface BaseRequest
{
    public function performAsync(): PromiseInterface;

    public function perform();
}