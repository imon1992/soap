<?php
ini_set("soap.wsdl_cache_enabled", "0");
$client = new SoapClient("stockquote1.wsdl");
//var_dump('stockquote1.wsdl');
//var_dump($client);
//print($client->__getFunctions());
var_dump($client->__getFunctions());
//print($client->getQuote("ibm"));
//print($client->asd(1234));
var_dump($client->getCarsInfoByParams(1));
$client->__getLastResponse()
?>
