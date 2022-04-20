<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CityCollection extends ResourceCollection
{
    /**
     * The "data" wrapper that should be applied.
     * It returns json for all collection elements (cities), also addition info is returned
     * @var string
     */
    public static $wrap = 'data'; // First json keynode for API response


    public $preserveKeys = true;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
//         return parent::toArray($request);
        $output = [
            config('api.API_RESULT_STATUS') => config('api.VALUE_API_RESULT_OK'),   
            'data'                          => $this->collection,            
        ];

        return $output;

    }
}
