<?php

namespace S25\RatesApiClient\Validators;

class CurrencyCodeValidator extends BaseValidator
{
    /** @noinspection PhpParameterNameChangedDuringInheritanceInspection */
    public static function validate($currencyCode): ?string
    {
        return preg_match('/^[a-z]{3}$/i', $currencyCode)
            ? null
            : "Код валюты {$currencyCode} не соответствует ISO 4217";
    }
}
