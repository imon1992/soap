<?php
include('CarInfoSql.php');

class SoapResponse
{

    private $carInfo;

    public function __construct()
    {
        $this->carInfo = new CarInfoSql();
    }

    public function getCarsInfoByParams($paramsJson)
    {
        $params = json_decode($paramsJson, true);

        if(is_array($params)) {
            $result = $this->carInfo->getCarsInfoByParams($params);
        }else
        {
            $result = 'error';
        }
        $resultJSON = json_encode($result);
        return $resultJSON;
    }

    public function getFullCarInfo($idJson)
    {
//        return 'sfasfas';
        $id = json_decode($idJson);
        $result = $this->carInfo->getModelYearAmountColorSpeedPrice($id);
        $resultJSON = json_encode($result);
        return $resultJSON;
    }

    public function getCarModelMarkId()
    {
        $result = $this->carInfo->getCarMarkAndModel();
        $resultJSON = json_encode($result);
        return $resultJSON;
    }

    public function addOrder($orderParamsJson)
    {
//        return $orderParamsJson;
        $orderParams = json_decode($orderParamsJson,true);
        if(is_array($orderParams))
        {
            $result = $this->carInfo->addOrder($orderParams);
        }else
        {
            $result =  'error';
        }
        $resultJSON = json_encode($result);
        return $resultJSON;
    }

}
//
//$c = new SoapResponse();
//$x = $c->addOrder('{"carId":1,"firstName":"Andrew","surname":"Kolotii","paymentMethod":"credit card"}');
//var_dump($x);