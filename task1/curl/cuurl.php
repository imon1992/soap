<?php
//Data, connection, auth
$dataFromTheForm = $_POST['fieldName']; // request data from the form
$soapUrl = "http://footballpool.dataaccess.eu/data/info.wso?WSDL"; // asmx URL of WSDL
//$soapUser = "username";  //  username
//$soapPassword = "password"; // password

// xml post structure

$xmlPostString = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
    <soap:Body>
        <Cities xmlns="http://footballpool.dataaccess.eu">
        </Cities>
    </soap:Body>
</soap:Envelope>';

$headers = array(
    "Content-type: text/xml;charset=\"utf-8\"",
    "Accept: text/xml",
    "Cache-Control: no-cache",
    "Pragma: no-cache",
    "Host: footballpool.dataaccess.eu",
//                        "SOAPAction: http://footballpool.dataaccess.eu/data/info.wso/Cities",
    "Content-length: " . strlen($xmlPostString),
); //SOAPAction: your op URL

$url = $soapUrl;

// PHP cURL  for https connection with auth
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlPostString);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// converting
$response = curl_exec($ch);
curl_close($ch);
var_dump($response);
//$client = new SoapClient($this->soapServer);
//$client = new SimpleXMLElement($response);
//$c = $client->CitiesResult;
//foreach()
//var_dump($c);
//             converting
$response1 = str_replace("<soap:Body>", "", $response);
$response2 = str_replace("</soap:Body>", "", $response1);
$response3 = str_replace("m:", "", $response2);
//             convertingc to XML
//new SimpleXMLElement($currenciesXML->EnumValutesXMLResult->any)
$parser = simplexml_load_string($response3);
//             user $parser to get your data out of XML response and to display it.
//var_dump($response2);
//var_dump($parser->CitiesResponse);
var_dump($parser);
