<?php

class CurrencyConverter
{
    public function convert($amount, $rate)
    {
        return round($amount * $rate, 2);
    }
}
