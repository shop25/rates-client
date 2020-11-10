<?php

namespace S25\RatesApiClient\Contracts\Request;

use GuzzleHttp\Promise\PromiseInterface;
use S25\RatesApiClient\Contracts\Specs\RatesSpec;
use S25\RatesApiClient\Payload\Rate;

/**
 * Interface RatesRequest
 * @package S25\RatesApiClient\Contracts\Request
 *
 * Все методы опциональны.
 *
 * Возвращает:
 *   $result[] = [string $baseCode, string $quoteCode, datetime $createdAt, datetime|null $sealedAt, float $value];
 *  где datetime - строка в формате
 *
 * @method Rate[] perform()
 * @method PromiseInterface performAsync() = PromiseInterface<Rate[]>
 */
interface RatesRequest extends BaseRequest
{
    public function setSpec(RatesSpec $spec): self;
}