<?php
ini_set("soap.wsdl_cache_enabled", "0");

include('config.php');
if($_POST['AllModelsMarksId'])
{
    try
    {
        $client = new SoapClient(HTTP_WSDL);
        echo $client->getCarModelMarkId();
    }catch (SoapFault $e)
    {
        echo json_encode($e->getMessage());
    }

}

if($_POST['sortCar'])
{
    try
    {
        $client = new SoapClient(HTTP_WSDL);
        echo $client->getCarsInfoByParams($_POST['sortCar']);
    }catch (SoapFault $e)
    {
        echo json_encode($e->getMessage());
    }

}

if($_POST['carId'])
{
    try
    {
        $client = new SoapClient(HTTP_WSDL);
        echo $client->getFullCarInfo($_POST['carId']);
    }catch (SoapFault $e)
    {
        echo json_encode($e->getMessage());
    }

}
if($_POST['order'])
{
    try
    {
        $client = new SoapClient(HTTP_WSDL);
        echo $client->addOrder($_POST['order']);
    }catch (SoapFault $e)
    {
        echo json_encode($e->getMessage());
    }

}
