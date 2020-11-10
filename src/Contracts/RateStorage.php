<?php

namespace S25\RatesApiClient\Contracts;

use S25\RatesApiClient\Contracts\Specs\RatesSpec;
use S25\RatesApiClient\Payload\Rate;

interface RateStorage
{
    public function getRate(string $baseCode, string $quoteCode, \DateTimeInterface $moment): ?Rate;

    public function getRateValue(string $baseCode, string $quoteCode, \DateTimeInterface $moment): ?float;

    public function prefetch(RatesSpec $spec): void;
}