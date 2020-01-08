<?php

namespace App\Http\Controllers;

use App\LumenOWM;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

/**
 * Main weather app controller
 * Class WeatherController
 * @package App\Http\Controllers
 */
class WeatherController extends BaseController
{
    /**
     * Homepage route for weather app
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('weather.index');
    }

    /**
     * Current weather response route via data file download
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function response(Request $request)
    {
        $lowm = new LumenOWM();

        $city = $request->get('location');
        $mode = $request->get('mode');

        $filename = 'weather_data.json';

        if ($request->get('mode') === 'xml') {
            $filename = 'weather_data.xml';
        }

        try {
            $current_weather = $lowm->getWeather($city, $mode);
        } catch(\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage(), 'code' => $e->getCode()]);
        }

        if (!($request->get('mode') === 'xml')) {
            $data = LumenOWM::parseJson($current_weather);
        } else {
            $data = LumenOWM::parseXML($current_weather);
        }

        $file = fopen($filename,'w+');
        fwrite($file, $data);
        fclose($file);

        return view('weather.response', [
            'filename' => $filename
        ]);
    }
}
