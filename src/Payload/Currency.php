<?php

namespace S25\RatesApiClient\Payload;

class Currency
{
    public string  $code;
    public ?string $sign;
    public string  $name;
    public int     $decimals;
    public int     $multiplier;

    public function __construct(
        string $code,
        ?string $sign,
        string $name,
        int $decimals = 0,
        int $multiplier = 1
    ) {
        $this->code = $code;
        $this->sign = $sign;
        $this->name = $name;
        $this->decimals = $decimals;
        $this->multiplier = $multiplier;
    }
}