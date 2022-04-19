<?php

namespace App\Http\Controllers;

use App\Http\Resources\CityCollection;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         
         $cities = City::OrderBy('name', 'asc')->get();
         if (! $cities->isEmpty()){
            return new CityCollection($cities);
         }
         
         else{
             return response()->json([
                'status' => 'error',
                
            ]);
         }
        // return new CityCollection(City::all());
        
    }

   
   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

   
}
