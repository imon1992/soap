<?php
ini_set("soap.wsdl_cache_enabled", "0");
include("classTest.php");

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
//$server->addFunction("asd");
$server->setClass('classTest');
$server->handle();
?>