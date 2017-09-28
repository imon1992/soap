<?php
include('CarInfoSql.php');
ini_set('soap.wsdl_cache_enabled', 'Off');


$quotes = array(
    "ibm" => 98.42
);

function getQuote($symbol) {
    global $quotes;
    return $quotes[$symbol];
}

ini_set("soap.wsdl_cache_enabled", "0"); // отключаем кэширование WSDL
$server = new SoapServer("../asd.wsdl");
$server->addFunction("getQuote");
$server->handle();
?>