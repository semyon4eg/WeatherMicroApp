<?php


namespace App;

/**
 * Query object to perform a weather request
 * Class WeatherQuery
 * @package App
 */
class WeatherQuery
{
    public $query;
    protected $city;
    protected $mode;

    protected $api_key;
    protected $weather_url;
    protected $units;
    protected $lang;

    /**
     * WeatherQuery constructor.
     * @param WeatherQueryBuilder $builder
     */
    public function __construct(WeatherQueryBuilder $builder)
    {
        $this->query = $builder->query;
        $this->city = $builder->city;
        $this->mode = $builder->mode;

        $this->api_key = $builder->api_key;
        $this->weather_url = $builder->weather_url;
        $this->units = $builder->units;
        $this->lang = $builder->lang;
    }
}
