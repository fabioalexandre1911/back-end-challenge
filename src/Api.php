<?php

class Api 
{
    private $currencyConverter;
    private $exchangeRateService;

    public function __construct(CurrencyConverter $currencyConverter, ExchangeRateService $exchangeRateService)
    {
        $this->currencyConverter = $currencyConverter;
        $this->exchangeRateService = $exchangeRateService;
    }

    public function handleRequest()
    {
        header("Content-Type: application/json");

        // Obtém o caminho da URL e valida o formato com a regex
        $path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $pattern = '#^exchange/([0-9.]+)/([A-Z]{3})/([A-Z]{3})/([0-9.]+)$#';

        if (!preg_match($pattern, $path, $matches)) {
            http_response_code(400);
            echo json_encode(["error" => "Invalid URL format. Use /exchange/{amount}/{from}/{to}/{rate}"]);
            return;
        }

        // Extrai os parâmetros
        $amount = (float) $matches[1];
        $from = $matches[2];
        $to = $matches[3];
        $rate = (float) $matches[4];

        // Calcula o valor convertido
        $convertedAmount = $this->currencyConverter->convert($amount, $rate);
        $symbol = $this->exchangeRateService->getSymbol($to);

        if ($symbol === null) {
            http_response_code(400);
            echo json_encode(["error" => "Unsupported currency code for 'to' parameter."]);
            return;
        }

        echo json_encode([
            "valorConvertido" => $convertedAmount,
            "simboloMoeda" => $symbol
        ]);
    }
}
