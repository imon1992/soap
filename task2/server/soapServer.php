<?php
ini_set('soap.wsdl_cache_enabled', '0'); 
ini_set('soap.wsdl_cache_ttl', '0'); 
//ini_set("soap.wsdl_cache_enabled", "0");
include("libs/CarInfoSql.php");
//$c = new CarIfroSql();
//$quotes = array(
////    "ibm" => 98.42
////);
////
////function getQuote($symbol) {
////
//////    global $quotes;
//////    return $quotes[$symbol];
////}
//function asd($id){
//    return $id;
//    }
//    ini_set("soap.wsdl_cache_enabled", "0"); // ÏËÀÁÍËÛÒ×ÎÅWSDL
    $server = new SoapServer("myWSDL.wsdl");
//    //$server->addFunction("asd");
    $server->setClass('CarInfoSql');
    $server->handle();
