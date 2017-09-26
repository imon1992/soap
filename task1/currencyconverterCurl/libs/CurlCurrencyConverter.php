<?php

class CurlCurrencyConverter{

    private function clearResponse($responseXML){
        $responseXML = str_replace("<soap:Body>", "", $responseXML);
        $responseXML = str_replace("</soap:Body>", "", $responseXML);
        $responseXML = str_replace("m:", "", $responseXML);
        return $responseXML;
    }
    private function makeHeaders(){
        $headers = [];
        array_push($headers,CONTENT_TYPE);
        array_push($headers,ACCEPT);
        array_push($headers,CACHE_CONTROL);
        array_push($headers,PRAGMA);
        array_push($headers,HOST);
        array_push($headers,SOAP_ACTION);
        return $headers;
    }

    public function getCurrencies($period){
        $reult = [];
        
        $enumPost =  ENUM_VALUTES_POST;
        $enumPost = str_replace('seldValue',$period,$enumPost);
        
        $headers = $this->makeHeaders();
        array_push($headers,"Content-length: " . strlen($enumPost));
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, SOAP_SERVER);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $enumPost);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $response = curl_exec($ch);
        curl_close($ch);
        
        $responseXML = $this->clearResponse($response);
        $responseXML = simplexml_load_string($responseXML);

        foreach($responseXML->EnumValutesXMLResponse->EnumValutesXMLResult->ValuteData->EnumValutes as $key=>$currency){
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
