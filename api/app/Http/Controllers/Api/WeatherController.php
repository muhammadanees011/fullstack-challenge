<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Weather;

class WeatherController extends Controller
{

    //--------------STORE WEATHER DATA FOR USERS------------
    public function store(Request $request,$user_id){
          $weather=new Weather();
          $weather->user_id=$user_id;
          $weather->feels_like=$request->main['feels_like'];
          $weather->grnd_level=$request->main['grnd_level'];
          $weather->humidity=$request->main['humidity'];
          $weather->pressure=$request->main['pressure'];
          $weather->sea_level=$request->main['sea_level'];
          $weather->temp=$request->main['temp'];
          $weather->temp_max=$request->main['temp_max'];
          $weather->temp_min=$request->main['temp_min'];
          $weather->main=$request->weather[0]['main'];
          $weather->description=$request->weather[0]['description'];
          $weather->visibility=$request->visibility;
          $weather->timezone=$request->timezone;
          $weather->wind_deg=$request->wind['deg'];
          $weather->wind_gust=$request->wind['gust'];
          $weather->wind_speed=$request->wind['speed'];
          $weather->save();
          return response()->json([
            'message' => 'weather data stored successfully!',
            'weather' => $weather
        ]);
    }


    //-------------UPDATE WEATHER DATA FOR USERS---------------------
    public function update(Request $request,$user_id){
        $weather=Weather::where('user_id',$user_id)->first();
        $weather->feels_like=$request->main['feels_like'];
        $weather->grnd_level=$request->main['grnd_level'];
        $weather->humidity=$request->main['humidity'];
        $weather->pressure=$request->main['pressure'];
        $weather->sea_level=$request->main['sea_level'];
        $weather->temp=$request->main['temp'];
        $weather->temp_max=$request->main['temp_max'];
        $weather->temp_min=$request->main['temp_min'];
        $weather->main=$request->weather[0]['main'];
        $weather->description=$request->weather[0]['description'];
        $weather->visibility=$request->visibility;
        $weather->timezone=$request->timezone;
        $weather->wind_deg=$request->wind['deg'];
        $weather->wind_gust=$request->wind['gust'];
        $weather->wind_speed=$request->wind['speed'];
        $weather->save();
        return response()->json([
          'message' => 'weather data updated successfully!',
          'weather' => $weather
      ]);

    }
    
}
