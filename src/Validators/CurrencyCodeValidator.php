<?php

namespace S25\RatesApiClient\Validators;

class CurrencyCodeValidator extends BaseValidator
{
    public static function validate($currencyCode): ?string
    {
        return preg_match('/^[a-z]{3}$/i', $currencyCode)
            ? null
            : "Код валюты {$currencyCode} не соответсвует ISO 4217";
    }
}