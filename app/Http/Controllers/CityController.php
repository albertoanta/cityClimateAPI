<?php

namespace App\Http\Controllers;

use App\Http\Resources\CityCollection;
use App\Http\Resources\CityResource;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use PhpParser\Node\Expr\Cast\Double;

class CityController extends Controller
{

    const DEFAULT_DAYS_FORECAST = 5;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */    
    public function index(Request $request)
    {
        
         $sortField = $this->calculateOrderField($request);
         $cities = City::OrderBy($sortField, 'asc')->get();
         if (! $cities->isEmpty()){
            return new CityCollection($cities);
         }
         
         else{
             return response()->json([
                config('api.API_RESULT_STATUS') => config('api.VALUE_API_RESULT_ERROR')                
            ]);
         }
        // return new CityCollection(City::all());
        
    }

    /**
     * 
     */
    public function forecastByCity(Request $request, City $city, int $days = self::DEFAULT_DAYS_FORECAST){


          if (empty($city)) {
              return response()->json([                  
                  config('api.API_RESULT_STATUS') => config('api.VALUE_API_RESULT_ERROR') ,                  
              ], 404);
          }
          
        
        $filterForecast = false;    
        $idCity = $city->id ?? null;
        $forecastAPI = $this->getForecastExternalAPI($idCity);
        $filterForecast = $this->getTempsFromForecast($forecastAPI, $days);

        $cityResource= new CityResource($city);     
        $forecastResponse = array_merge($cityResource->toArray($this), $filterForecast);
        
        return response()->json([
            config('api.API_RESULT_STATUS') => config('api.VALUE_API_RESULT_OK')                ,
            'data' => $forecastResponse
        ]);
    }


    

    /**
     * Calculare forecast for a number of days from any forecast given
     */
    protected function getTempsFromForecast(array $forecast, int $numberOfDays = self::DEFAULT_DAYS_FORECAST){
        $maxTemp =  $minTemp = null;
        $forecast_working = array_slice($forecast["longterm"], 0, $numberOfDays);
        foreach($forecast_working as $iteration => $itemForecast){
            $currentMax = $itemForecast["temperatureMax"]["value"];
            $currentMin = $itemForecast["temperatureMin"]["value"];
            if ($maxTemp === null && $minTemp === null){
                $maxTemp = $currentMax;
                $minTemp = $currentMin;
            }else{
                if ($currentMin < $minTemp) 
                    $minTemp = $currentMin;
                if ($currentMax > $maxTemp) 
                    $maxTemp = $currentMax;                         
            }           
        }        
        return ['TemperatureMax' => $maxTemp, 'TemperatureMin' => $minTemp, 'forecastDays'=> $numberOfDays];
        

    }


    public function getForecastExternalAPI(string $idCity)  {
        
        $params=  [] ;
        
        $endpointForecast = config('api.URL_EXTERNAL_API_FORECAST') . "/$idCity";
        $response =  Http::get($endpointForecast, $params);
        

        if ($response->status() != 200){
            return false;
        }

        return $response->json();
        
        
    }

    /**
     * Evaluate params. Nowadays for sorting type (id or name of city)
     */
    protected function calculateOrderField(Request $request){
        $defaultSortFiled   = config('api.VALUE_FIELD_ID');
        $availableFields    = [$defaultSortFiled, config('api.VALUE_FIELD_NAME')];        
        $sortField          = $request->input(config('api.API_QUERY_PARAM_ORDER_BY')) ?? $defaultSortFiled;
        return in_array($sortField, $availableFields) ? $sortField : $defaultSortFiled;
    }
   

   
}
