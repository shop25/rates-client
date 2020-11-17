<?php


namespace S25\RatesApiClient\Contracts\Request;

use GuzzleHttp\Promise\PromiseInterface;
use S25\RatesApiClient\Payload\Currency;

/**
 * Interface CurrenciesRequest
 * @package S25\RatesApiClient\Contracts\Request
 *
 * @method Currency[] perform()
 * @method PromiseInterface performAsync() = PromiseInterface<Currency[]>
 */
interface CurrenciesRequest
{
}