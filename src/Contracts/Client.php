<?php

namespace S25\RatesApiClient\Contracts;

interface Client
{
    public function requestCurrencies(): Request\CurrenciesRequest;

    public function requestRates(): Request\RatesRequest;
}