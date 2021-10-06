<?php

namespace S25\RatesApiClient\Payload;

class Currency
{
    public string  $code;
    public string  $name;
    public ?string $sign;
    public int     $decimals;
    public int     $multiplier;

    public function __construct(
        string $code,
        string $name,
        ?string $sign,
        int $decimals = 0,
        int $multiplier = 1
    ) {
        $this->code = $code;
        $this->name = $name;
        $this->sign = $sign;
        $this->decimals = $decimals;
        $this->multiplier = $multiplier;
    }
}
