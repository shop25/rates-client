<?php

namespace S25\RatesApiClient\Request;

use S25\RatesApiClient\Contracts\Request\CurrenciesRequest as CurrenciesRequestContract;
use S25\RatesApiClient\Payload\Currency;

class CurrenciesRequest extends BaseRequest implements CurrenciesRequestContract
{
    protected function requestEndpoint(): string
    {
        return "currencies";
    }

    protected function transformResult($data)
    {
        if (!is_array($data)) {
            throw new \RuntimeException("Result is not an array");
        }

        return array_map(static fn($data) => new Currency(
            $data[0], // code
            $data[1], // name
            $data[2], // sign
            $data[3], // decimals
            $data[4] // multiplier
        ), $data);
    }
}
