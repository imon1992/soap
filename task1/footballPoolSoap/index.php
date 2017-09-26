<?php
include ('config.php');
include('libs/SoapClientFootballPool.php');

$soapClient = new SoapClientFootballPool();
$countries = $soapClient->getCountries();
if($_POST['country'] != '')
{
    $defenders = $soapClient->getDefendersByCountry($_POST['country']);
}

if($_GET['cities'] == 'cities')
{
    $cities = $soapClient->getCitiesGamesPlayed();
}

if($_GET['stadiums'] == 'stadiums')
{
    $stadiums = $soapClient->getStadiumNames();
}

include ("templates/index.php");

