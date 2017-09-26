<?php
define("SOAP_SERVER", "http://footballpool.dataaccess.eu/data/info.wso?WSDL");
define("SOAP_CITIES_POST", '<?xml version="1.0" encoding="utf-8"?>
                            <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                                <soap:Body>
                                    <Cities xmlns="http://footballpool.dataaccess.eu">
                                    </Cities>
                                </soap:Body>
                            </soap:Envelope>');
define("SOAP_STADIUMS_POST", '<?xml version="1.0" encoding="utf-8"?>
                                <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                                  <soap:Body>
                                    <StadiumNames xmlns="http://footballpool.dataaccess.eu">
                                    </StadiumNames>
                                  </soap:Body>
                                </soap:Envelope>');
define("SOAP_DEFENDERS_POST", '<?xml version="1.0" encoding="utf-8"?>
                                <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                                    <soap:Body>
                                        <AllDefenders xmlns="http://footballpool.dataaccess.eu">
                                            <sCountryName>countryValue</sCountryName>
                                        </AllDefenders>
                                    </soap:Body>
                                </soap:Envelope>');
define("SOAP_COUNTRIES_POST", '<?xml version="1.0" encoding="utf-8"?>
                                    <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                                      <soap:Body>
                                        <CountryNames xmlns="http://footballpool.dataaccess.eu">
                                          <bWithCompetitors>allCountries</bWithCompetitors>
                                        </CountryNames>
                                      </soap:Body>
                                    </soap:Envelope>');
define("CONTENT_TYPE", "Content-type: text/xml;charset=\"utf-8\"");
define("ACCEPT", "Accept: text/xml");
define("CACHE_CONTROL", "Cache-Control: no-cache");
define("PRAGMA", "Pragma: no-cache");
define("HOST", "Host: footballpool.dataaccess.eu");
