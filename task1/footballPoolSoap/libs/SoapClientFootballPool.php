<?php

class SoapClientFootballPool {

    protected $soapServer;

    public function  __construct(){
        $this->soapServer = SOAP_SERVER;
    }

    public function getCitiesGamesPlayed(){
        $result = [];

        $client = new SoapClient($this->soapServer);
        $cities = $client->Cities();

        foreach($cities->CitiesResult->string as $city){
            $result[] = $city;
        }

        return $result;
    }

    public function getStadiumNames(){
        $result = [];

        $client = new SoapClient($this->soapServer);
        $stadiums = $client->StadiumNames();

        foreach($stadiums->StadiumNamesResult->string as $stadium){
            $result[] = $stadium;
        }

        return $result;
    }

    public function getDefendersByCountry($country){
        $result = [];

        $client = new SoapClient($this->soapServer);

        $defenders = $client->AllDefenders(['sCountryName' => $country]);

        foreach($defenders->AllDefendersResult->string as $defender){
            $result[] = $defender;
        }

        return $result;
    }

    public function getCountries(){
        $result = [];

        $client = new SoapClient($this->soapServer);

        $Countries = $client->CountryNames (['bWithCompetitors' => true]);

        foreach($Countries->CountryNamesResult->tCountryInfo as $country){
            $result[] = rtrim($country->sName);
        }
//var_dump($result);
        return $result;
    }

}
