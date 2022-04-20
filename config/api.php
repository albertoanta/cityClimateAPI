
<?php

return [
    /*
    |--------------------------------------------------------------------------
    | API QUERY
    |--------------------------------------------------------------------------
    |
    | API Params Names and values
    |
    */
    
    'API_QUERY_PARAM_ORDER_BY' => env('API_QUERY_PARAM_ORDER_BY', 'orderby'),

    'VALUE_FIELD_NAME'  => 'name',
    'VALUE_FIELD_ID'    => 'id',


    'API_RESULT_STATUS'     => 'status',
    'VALUE_API_RESULT_OK'   => 'ok',
    'VALUE_API_RESULT_ERROR'=> 'error',
    

    // External API URL to get forecast
    // https://weatherapi.pelmorex.com/v1/longterm/eltiempo/placecode/{ID}

    'URL_EXTERNAL_API_FORECAST'=> 'https://weatherapi.pelmorex.com/v1/longterm/eltiempo/placecode',


];