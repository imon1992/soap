<?php
ini_set("soap.wsdl_cache_enabled", "0");
//$client = new SoapClient("server/stockquote1.wsdl");
//var_dump('stockquote1.wsdl');
//var_dump($client);
//print($client->__getFunctions());
//var_dump($client->__getFunctions());
//print($client->getQuote("ibm"));
//print($client->asd(1234));
//var_dump($client->getCarsInfoByParams('{"mark": "BMW"}'));
//var_dump($client->getFullCarInfo("1"));
//var_dump($client->getCarModelMarkId());
//var_dump($client->getCarsInfoByParams(111));
//$client->__getLastResponse()
try {
    $client = new SoapClient("server/stockquote1.wsdl");
    var_dump($client->getCarsInfoByParams('{"mark": "BMW"}'));
    var_dump($client->getFullCarInfo("1"));
    var_dump($client->getCarModelMarkId(2312));
}catch(SoapFault $e) {
    var_dump($e->getMessage());
//    $dostupna = false;
//    trigger_error('Ошибка авторизации или внутренняя ошибка сервера. Не удалось связаться с базой.', E_ERROR);

}
