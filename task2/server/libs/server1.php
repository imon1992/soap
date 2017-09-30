<?php
ini_set("soap.wsdl_cache_enabled", "0");
include('SoapResponse.php');

$server = new SoapServer(LOCAL_WSDL);
$server->setClass('SoapResponse');
$server->handle();