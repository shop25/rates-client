<?php

namespace S25\RatesApiClient\Payload;

class Rate
{
    public string              $baseCode;
    public string              $quoteCode;
    public \DateTimeInterface  $createdAt;
    public ?\DateTimeInterface $sealedAt;
    public float               $value;

    public function __construct(
        string $baseCode,
        string $quoteCode,
        string $createdAt,
        ?string $sealedAt,
        float $value
    ) {
        $this->baseCode = $baseCode;
        $this->quoteCode = $quoteCode;
        $this->createdAt = new \DateTimeImmutable($createdAt);
        $this->sealedAt = $sealedAt !== null ? new \DateTimeImmutable($sealedAt) : null;
        $this->value = $value;
    }

    public function atMoment(\DateTimeInterface $moment): bool
    {
        return $this->createdAt <= $moment && ($this->sealedAt === null || $moment < $this->sealedAt);
    }
}