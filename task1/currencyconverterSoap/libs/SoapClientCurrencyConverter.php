<?php

class SoapClientCurrencyConverter {

    protected $soapServer;

    public function  __construct(){
        $this->soapServer = SOAP_SERVER;
    }

    public function getCurrencies($period){
        $result = [];

        $client = new SoapClient($this->soapServer);
        $currenciesXML = $client->EnumValutesXML(['Seld'=>$period]);

        $currencies = new SimpleXMLElement($currenciesXML->EnumValutesXMLResult->any);

        foreach($currencies as $currency){
            $currencyArr['Vcode'] = trim($currency->Vcode);
            $currencyArr['Vname'] = trim($currency->Vname);
            $currencyArr['VEngname'] = trim($currency->VEngname);
            $currencyArr['Vnom'] = trim($currency->Vnom);
            $currencyArr['VcommonCode'] = trim($currency->VcommonCode);
            $currencyArr['VnumCode'] = trim($currency->VnumCode);
            $currencyArr['VcharCode'] = trim($currency->VcharCode);
            $result[] = $currencyArr;
        }

        return $result;
    }


}
