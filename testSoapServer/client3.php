<?php
$client = new SoapClient("stockquote1.wsdl");
//print($client->__getFunctions());
var_dump($client->__getFunctions());
//print($client->getQuote("ibm"));
print($client->asd(1234));
?>