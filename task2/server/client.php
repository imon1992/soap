<?php
ini_set('soap.wsdl_cache_enabled', '0'); 
ini_set('soap.wsdl_cache_ttl', '0'); 
$client = new SoapClient("myWSDL.wsdl");
//print($client->__getFunctions());
var_dump($client->__getFunctions());
//print($client->getModelYearAmountColorSpeedPrice('1'));
print($client->asd(1234));
