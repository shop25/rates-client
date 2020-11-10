<?php

namespace S25\RatesApiClient\Contracts\Specs;

interface RatesSpec
{
    public function getBaseCode(): ?string;

    public function getQuoteCode(): ?string;

    public function getUsedFrom(): ?\DateTimeInterface;

    public function getUsedTill(): ?\DateTimeInterface;

    public function getUsedAt(): ?\DateTimeInterface;
}