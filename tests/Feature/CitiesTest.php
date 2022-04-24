<?php

namespace Tests\Feature;

use App\Models\City;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Client\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ListCitiesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test void   
     *
     * @return void
     */
    public function test_cities_api()
    {
        $this->withoutExceptionHandling();
     
            City::create([
                'id'    => 'ESXX0016',
                'name'  => 'A Coruña'
            ]);
    
            City::create([
                'id'    => 'ESCT0001',
                'name'  => 'Barcelona'
            ]);
    
            City::create([
                'id'    => 'ESXX0006',
                'name'  => 'Bilbao'
            ]);
    
            City::create([
                'id'    => 'ESXX0656',
                'name'  => 'Castro-Urdiales'
            ]);
    
            City::create([
                'id'    => 'ESMX0001',
                'name'  => 'Madrid'
            ]);
    
            $city = City::create([
                'id'    => 'ESXX0004',
                'name'  => 'Sevilla'
            ]);

           
     
        $response = $this->get('http://localhost:8000/api/cities/ESCT0001/forecast/?token=my-secret-token'); 
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'status',
                "data" => [                 
                        'id',
                        'name'                                  
                ]
                
            ]);

         
        $response = $this->get(route('api.cities.index').'?orderby=name&token=my-secret-token');       
        $response->assertStatus(200);
        $response->assertSee($city->name);

        $response = $this->get('http://localhost:8000/api/cities/ESCT0001/forecast/?token=my-secret-token');       
        $response->assertStatus(200);
        $response->assertSee('Barcelona');

        $response->assertJsonStructure([
            'status',
                "data" => [                 
                        'id',
                        'name',
                        'TemperatureMax', 
                        'TemperatureMin', 
                        'forecastDays'
                ]
                
            ]);

    }

}
