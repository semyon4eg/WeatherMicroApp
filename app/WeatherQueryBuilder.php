<?php


namespace App;

/**
 * Yeap, it's a Builder!
 * Class WeatherQueryBuilder
 * @package App
 */
class WeatherQueryBuilder
{
    public $query;
    public $city;
    public $mode;

    public $api_key = '0b6246126a12c6fba35126b980b217b6';
    public $weather_url = 'https://api.openweathermap.org/data/2.5/weather?';
    public $units = 'metric';
    public $lang = 'en';

    /**
     * WeatherQueryBuilder constructor.
     * @param string $city
     * @param string $mode
     */
    public function __construct(string $city,string $mode)
    {
        $this->query = $this->weather_url;
        $this->city = $city;
        $this->query .= 'q=' . $this->city;
        $this->mode = $mode;
        $this->query .= '&mode=' . $this->mode;
    }

    /**
     * Adds required units in a request
     * @return $this
     */
    public function addUnits()
    {
        $this->query .= '&units=' . $this->units;
        return $this;
    }

    /**
     * Adds required language in a request
     * @return $this
     */
    public function addLang()
    {
        $this->query .= '&lang=' . $this->lang;
        return $this;
    }

    /**
     * Adds an Api key ia a request
     * @return $this
     */
    public function addApiKey()
    {
        $this->query .= '&APPID=' . $this->api_key;
        return $this;
    }

    /**
     * Builds a query with a given data
     * @return WeatherQuery
     */
    public function build(): WeatherQuery
    {
        return new WeatherQuery($this);
    }
}
