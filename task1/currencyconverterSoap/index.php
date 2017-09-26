<?php
include ('config.php');
include('libs/SoapClientCurrencyConverter.php');

$soapClient = new SoapClientCurrencyConverter();

if($_POST['currency'] != ''){
    $currencies = $soapClient->getCurrencies($_POST['currency']);
}

include ("templates/index.php");

