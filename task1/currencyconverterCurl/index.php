<?php
include ('config.php');
include('libs/CurlCurrencyConverter.php');

$soapClient = new CurlCurrencyConverter();

if($_POST['currency'] != ''){
    $currencies = $soapClient->getCurrencies($_POST['currency']);
}

include ("templates/index.php");

