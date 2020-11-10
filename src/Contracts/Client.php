<?php

namespace S25\RatesApiClient\Contracts;

interface Client
{
    public function requestRates(): Request\RatesRequest;
}