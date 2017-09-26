<?php

define("SOAP_SERVER","http://www.cbr.ru/DailyInfoWebServ/DailyInfo.asmx?WSDL");

define("CONTENT_TYPE", "Content-type: text/xml;charset=\"utf-8\"");
define("ACCEPT", "Accept: text/xml");
define("CACHE_CONTROL", "Cache-Control: no-cache");
define("PRAGMA", "Pragma: no-cache");

define('ENUM_VALUTES_POST','<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <EnumValutesXML xmlns="http://web.cbr.ru/">
      <Seld>seldValue</Seld>
    </EnumValutesXML>
  </soap:Body>
  </soap:Envelope>');

define('SOAP_ACTION', 'SOAPAction: "http://web.cbr.ru/EnumValutesXML"');
define('SOAP_HOST', 'Host: www.cbr.ru');
