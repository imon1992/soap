<?php
include ('config.php');
include('libs/CUrlFootballPool.php');

$soapClient = new CUrlFootballPool();
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

