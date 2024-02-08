<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
   public function getCities(Request $request)
   {
      try {
         $id = $request->query('id');
         $province_id = $request->query('province_id');

         if ($province_id) {
            $cities = City::where('province_id', $province_id)->get();
         } else {
            $cities = $id ? City::findOrFail($id) : City::all();
         }

         return $this->responseJson(
            'success',
            200,
            'Obtained',
            $cities
         );
      } catch (\Throwable $th) {
         return $this->responseJSON(
            'error',
            500,
            $th->getMessage(),
            null
         );
      }
   }
}
