<?php
/**
 * Back-end Challenge.
 *
 * PHP version 7.4
 *
 * Este será o arquivo chamado na execução dos testes automátizados.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Fábio Sousa <fasfort@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

require_once 'CurrencyConverter.php';
require_once 'ExchangeRateService.php';
require_once 'Api.php';

$exchangeRateService = new ExchangeRateService();
$currencyConverter = new CurrencyConverter();
$api = new Api($currencyConverter, $exchangeRateService);

$api->handleRequest();