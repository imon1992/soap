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
            return 'error';
        }
        $resultJSON = json_encode($result);
        return $resultJSON;
    }

    public function getFullCarInfo($idJson)
    {
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

}