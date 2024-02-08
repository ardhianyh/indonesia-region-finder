<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Utilities\RajaOngkir;
use Exception;
use Illuminate\Http\Request;

class CityController extends Controller
{
   public function getCities(Request $request)
   {
      try {
         $id = $request->query('id');
         $province_id = $request->query('province_id');
         $source = $request->cookie('data-source');

         if ($source == "raja-ongkir") {
            $cities = $this->fromRajaOngkir($id, $province_id);
         } else {
            $cities = $this->fromLocal($id, $province_id);
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

   public function fromLocal($id, $province_id)
   {
      try {
         if ($province_id) {
            $cities = City::where('province_id', $province_id)->get();
         } else {
            $cities = $id ? City::findOrFail($id) : City::all();
         }

         return $cities;
      } catch (\Throwable $th) {
         throw new Exception($th->getMessage(), 500);
      }
   }

   public function fromRajaOngkir($id, $province_id)
   {
      try {
         $rajaOngkir = new RajaOngkir();
         if ($province_id) {
            $cities = $rajaOngkir->getCitiesByProvinceId($province_id);
         } else {
            $cities = $id ? $rajaOngkir->getCityById($id) : $rajaOngkir->getCities();
         }

         return $cities;
      } catch (\Throwable $th) {
         throw new Exception($th->getMessage(), 500);
      }
   }
}
