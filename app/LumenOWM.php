<?php


namespace App;

use SimpleXMLElement;

/**
 * Service class for requesting and parsing current weather in a given location in a given form
 * Class LumenOWM
 * @package App
 */
class LumenOWM
{
    /**
     * Invokes service methods for request formatting
     * @param string $city
     * @param string $mode
     * @return false|string
     */
    public function getWeather(string $city, string $mode = 'json')
    {
        $url = $this->getQuery($city, $mode);
        return $this->getResponse($url);
    }

    /**
     * Invokes a query composition logic
     * @param string $city
     * @param string $mode
     * @return string
     */
    public function getQuery(string $city, string $mode)
    {
        $weatherQuery = (new WeatherQueryBuilder($city, $mode))
                        ->addUnits()
                        ->addLang()
                        ->addApiKey()
                        ->build();

        return $weatherQuery->query;
    }

    /**
     * Sends request to a given URL-path
     * @param string $url
     * @return false|string
     */
    public function getResponse(string $url)
    {
        $response = file_get_contents($url);
        return $response;
    }

    /**
     * Parses retrieved weather data in a json format
     * @param string $current_weather
     * @return false|string
     */
    public static function parseJson(string $current_weather)
    {
        $json = json_decode($current_weather);
        $jsonArr = [];
        $jsonArr['date'] = date("D M j G:i:s T Y", $json->dt);
        $jsonArr['temperature'] = $json->main->temp;
        $jsonArr['wind_direction'] = $json->wind->deg;
        $jsonArr['wind_speed'] = $json->wind->speed;
        $jsonArr['pressure'] = $json->main->pressure;
        $jsonArr['humidity'] = $json->main->humidity;
        $jsonArr['clouds'] = $json->clouds->all;
        $jsonArr['city'] = $json->name;
        $jsonArr['country'] = $json->sys->country;
        $jsonArr['city_id'] = $json->id;

        return json_encode($jsonArr);
    }

    /**
     * Parses retrieved weather data in a xml format
     * @param string $current_weather
     * @return mixed
     */
    public static function parseXML(string $current_weather)
    {
        $xml = new SimpleXMLElement($current_weather);
        $xmlArr = [];
        $xmlArr['date'] = $xml->lastupdate['value'];
        $xmlArr['wind_speed'] = $xml->wind->speed['value'];
        $xmlArr['temp'] = $xml->temperature['value'];
        $xmlArr['wind_direction'] = $xml->wind->direction['value'];
        $xmlArr['humidity'] = $xml->humidity['value'];
        $xmlArr['pressure'] = $xml->pressure['value'];
        $xmlArr['clouds'] = $xml->clouds['value'];
        $xmlArr['city'] = $xml->city['name'];
        $xmlArr['country'] = $xml->city->country;
        $xmlArr['city_id'] = $xml->city['id'];

        $newxml = new SimpleXMLElement('<weather/>');

        foreach($xmlArr as $key => $value ) {
            $newxml->addChild("$key","$value");
        }

        return $newxml->asXML();
    }
}
