<?php

namespace S25\RatesApiClient;

use S25\RatesApiClient\Contracts\Client;
use S25\RatesApiClient\Contracts\Specs\RatesSpec as RatesSpecContract;
use S25\RatesApiClient\Payload\Rate;
use S25\RatesApiClient\Specs\RatesSpec;

class RateStorage implements Contracts\RateStorage
{
    private Client $client;
    /** @var Rate[][][] */
    private array $rates;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->rates = [];
    }

    public function getRate(string $baseCode, string $quoteCode, \DateTimeInterface $moment): ?Rate
    {
        foreach ($this->rates[$baseCode][$quoteCode] ?? [] as $rate) {
            if ($rate->atMoment($moment)) {
                return $rate;
            }
        }

        $rates = $this->client->requestRates()
            ->setSpec(
                RatesSpec::create()
                    ->setBaseCode($baseCode)
                    ->setQuoteCode($quoteCode)
                    ->setUsedAt($moment)
            )->perform();

        $this->addRates($rates);

        foreach ($rates as $rate) {
            if ($rate->atMoment($moment)) {
                return $rate;
            }
        }

        return null;
    }

    public function getRateValue(string $baseCode, string $quoteCode, \DateTimeInterface $moment): ?float
    {
        $rate = $this->getRate($baseCode, $quoteCode, $moment);

        return $rate instanceof Rate ? $rate->value : null;
    }

    public function prefetch(RatesSpecContract $spec): void
    {
        $rates = $this->client->requestRates()
            ->setSpec($spec)
            ->perform();

        $this->addRates($rates);
    }

    /**
     * @param Rate[] $rates
     */
    private function addRates(array $rates): void
    {
        foreach ($rates as $rate) {
            $this->rates[$rate->baseCode][$rate->quoteCode][] = $rate;
        }
    }
}