<?php
ini_set("soap.wsdl_cache_enabled", "0");
//include("classTest.php");
include('CarInfoSql.php');
//$quotes = array(
//    "ibm" => 98.42
//);
//
//function getQuote($symbol) {
//
////    global $quotes;
////    return $quotes[$symbol];
//}

function asd($id){
    return $id;
}

ini_set("soap.wsdl_cache_enabled", "0"); // отключаем кэширование WSDL
$server = new SoapServer("stockquote1.wsdl");
//var_dump($server);
//$server->addFunction("asd");
$server->setClass('CarInfoSql');
//$server->setClass('classTest');
//$server->setPersistence(SOAP_PERSISTENCE_SESSION);

ob_clean();
ob_start();
$server->handle();
?>
