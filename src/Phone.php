<?php

namespace CleanArchitecture;

use InvalidArgumentException;

class Phone
{
    private string $ddd;
    private string $number;
    public function __construct(string $ddd, string $number)
    {
        $this->setDDD($ddd);
        $this->setNumber($number);
    }

    public function __toString(): string
    {
        return "({$this->ddd}) {$this->formatNumber($this->number)}";
    }

    private function setDDD(string $ddd): void
    {
        if (strlen($ddd) !== 2)
            throw new InvalidArgumentException("DDD Invalid");
        $this->ddd = $ddd;
    }

    private function setNumber(string $number): void
    {
        if (strlen($number) < 8 || strlen($number) > 9)
            throw new InvalidArgumentException("Number Invalid");
        $this->number = $number;
    }

    private function formatNumber(string $number): string
    {
        if (strlen($number) > 8) {
            return substr($number, 0, 1) . " " . substr($number, 1, 4) . "-" . substr($number, 5, 4);
        }
        return substr($number, 0, 4) . "-" . substr($number, 4, 4);
    }
}