<?php

namespace S25\RatesApiClient\Specs;

use S25\RatesApiClient\Contracts\Specs\RatesSpec as RatesSpecContract;
use S25\RatesApiClient\Validators\CurrencyCodeValidator;

class RatesSpec implements RatesSpecContract
{
    private ?string              $baseCode  = null;
    private ?string              $quoteCode = null;
    private ?\DateTimeInterface  $usedFrom  = null;
    private ?\DateTimeInterface  $usedTill  = null;
    private ?\DateTimeInterface  $usedAt    = null;

    public static function create(): self
    {
        return new self;
    }

    public function setBaseCode(string $baseCode): self
    {
        CurrencyCodeValidator::assert($baseCode);

        $this->baseCode = $baseCode;

        return $this;
    }

    public function setQuoteCode(string $quoteCode): self
    {
        CurrencyCodeValidator::assert($quoteCode);

        $this->quoteCode = $quoteCode;

        return $this;
    }

    public function setUsedFrom(\DateTimeInterface $moment): self
    {
        $this->usedFrom = $moment;

        return $this;
    }

    public function setUsedTill(\DateTimeInterface $moment): self
    {
        $this->usedTill = $moment;

        return $this;
    }

    public function setUsedAt(\DateTimeInterface $moment): self
    {
        $this->usedAt = $moment;

        return $this;
    }

    // S25\RatesApiClient\Contracts\Specs\RatesSpec

    public function getBaseCode(): ?string
    {
        return $this->baseCode;
    }

    public function getQuoteCode(): ?string
    {
        return $this->quoteCode;
    }

    public function getUsedFrom(): ?\DateTimeInterface
    {
        return $this->usedFrom;
    }

    public function getUsedTill(): ?\DateTimeInterface
    {
        return $this->usedTill;
    }

    public function getUsedAt(): ?\DateTimeInterface
    {
        return $this->usedAt;
    }
}