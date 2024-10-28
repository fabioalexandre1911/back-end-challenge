<?php

class ExchangeRateService
{
    private $currencySymbols = [
        "BRL" => "R$",
        "USD" => "$",
        "EUR" => "€"
    ];

    public function getSymbol($currencyCode)
    {
        return $this->currencySymbols[$currencyCode] ?? null;
    }
} 
