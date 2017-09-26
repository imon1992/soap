<?php

class CUrlFootballPool {

    protected $soapServer;

    public function  __construct(){
        $this->soapServer = SOAP_SERVER;
    }

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
        return $headers;
    }
    public function getCitiesGamesPlayed(){
        $result = [];

        $headers = $this->makeHeaders();
        array_push($headers,"Content-length: " . strlen(SOAP_CITIES_POST));

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, SOAP_SERVER);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, SOAP_CITIES_POST);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        $responseXML = $this->clearResponse($response);

        $responseXML = simplexml_load_string($responseXML);

        foreach($responseXML->CitiesResponse->CitiesResult->string as $city){
            $result[] = trim($city);
        }

        return $result;
    }

    public function getStadiumNames(){
        $result = [];

        $headers = $this->makeHeaders();
        array_push($headers,"Content-length: " . strlen(SOAP_STADIUMS_POST));

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, SOAP_SERVER);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, SOAP_STADIUMS_POST);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        $responseXML = $this->clearResponse($response);

        $responseXML = simplexml_load_string($responseXML);

        foreach($responseXML->StadiumNamesResponse->StadiumNamesResult->string as $stadium){
            $result[] = trim($stadium);
        }

        return $result;
    }

    public function getDefendersByCountry($country){
        $result = [];
        $postParams = "sCountryName=$country";
        $headers = $this->makeHeaders();
        array_push($headers,"Content-length: " . strlen(SOAP_DEFENDERS_POST));

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, SOAP_SERVER);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postParams);
        curl_setopt($ch, CURLOPT_POSTFIELDS, SOAP_DEFENDERS_POST);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        $responseXML = $this->clearResponse($response);
        $responseXML = simplexml_load_string($responseXML);

        foreach($responseXML->AllDefendersResponse->AllDefendersResult->string as $defender){
            $result[] = trim($defender);
        }

        return $result;
    }

    public function getCountries(){
        $result = [];

        $headers = $this->makeHeaders();
        array_push($headers,"Content-length: " . strlen(SOAP_COUNTRIES_POST));

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, SOAP_SERVER);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, SOAP_COUNTRIES_POST);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        $responseXML = $this->clearResponse($response);
        $responseXML = simplexml_load_string($responseXML);

        foreach($responseXML->CountryNamesResponse->CountryNamesResult->tCountryInfo as $country){
            $result[] = rtrim($country->sName);
        }

        return $result;
    }

}
