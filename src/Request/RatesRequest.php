<?php

namespace S25\RatesApiClient\Request;

use S25\RatesApiClient\Contracts\Request\RatesRequest as RatesRequestContract;
use S25\RatesApiClient\Contracts\Specs\RatesSpec;
use S25\RatesApiClient\Payload\Rate;

class RatesRequest extends BaseRequest implements RatesRequestContract
{
    private const DATETIME_FORMAT = 'Y-m-d H:i:s';

    private RatesSpec $spec;

    protected function requestEndpoint(): string
    {
        return "rates";
    }

    protected function requestData(): ?array
    {
        $usedFrom = $this->spec->getUsedFrom() ? $this->spec->getUsedFrom()->format(self::DATETIME_FORMAT) : null;
        $usedTill = $this->spec->getUsedTill() ? $this->spec->getUsedTill()->format(self::DATETIME_FORMAT) : null;
        $usedAt = $this->spec->getUsedAt() ? $this->spec->getUsedAt()->format(self::DATETIME_FORMAT) : null;

        return array_filter(
            [
                'baseCode' => $this->spec->getBaseCode(),
                'quoteCode' => $this->spec->getQuoteCode(),
                'usedFrom' => $usedFrom,
                'usedTill' => $usedTill,
                'usedAt' => $usedAt,
            ]
        );
    }

    protected function transformResult($data)
    {
        if (!is_array($data)) {
            throw new \RuntimeException("Result is not an array");
        }

        return array_map(static fn($data) => new Rate($data[0], $data[1], $data[2], $data[3], $data[4]), $data);
    }

    public function setSpec(RatesSpec $spec): RatesRequestContract
    {
        $this->spec = $spec;

        return $this;
    }
}