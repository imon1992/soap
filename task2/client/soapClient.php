<?php
ini_set("soap.wsdl_cache_enabled", "0");
//ini_set('default_socket_timeout', 60);
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

if($_POST['AllModelsMarksId'])
{
    try
    {
        $client = new SoapClient("http://192.168.0.15/~user14/soap/task2/server/stockquote.wsdl",array('trace' => true, 'keep_alive' => false));
//var_dump($client->__getFunctions());
        echo $client->getCarModelMarkId();
    }catch (SoapFault $e)
    {
      echo $e->getMessage();
    }

}
//try {
//$client->addOrder('dsa');
//print($client->__getFunctions());
//var_dump($client->__getFunctions());
//    var_dump($client->getCarsInfoByParams('{"mark": "BMW"}'));
//    var_dump($client->getFullCarInfo(1));
//    var_dump($client->getCarModelMarkId(2312));
//    echo $client->addOrder($_POST['json_name']);
//    echo $_POST['json_name'];
//}catch(SoapFault $e) {
//    echo $e->getMessage();
//    echo $e;
//    var_dump($e->getMessage());
//    $dostupna = false;
//    trigger_error('Ошибка авторизации или внутренняя ошибка сервера. Не удалось связаться с базой.', E_ERROR);

//}
