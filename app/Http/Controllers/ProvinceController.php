<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Utilities\RajaOngkir;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProvinceController extends Controller
{
   public function getProvince(Request $request)
   {
      try {
         $id = $request->query('id');
         $source = $request->cookie('data-source');

         if ($source == "raja-ongkir") {
            $province = $this->fromRajaOngkir($id);
         } else {
            $province = $this->fromLocal($id);
         }

         return $this->responseJson(
            'success',
            200,
            'Obtained',
            $province
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

   public function fromLocal($id)
   {
      try {
         $province = $id ? Province::findOrFail($id) : Province::all();
         return $province;
      } catch (\Throwable $th) {
         throw new Exception($th->getMessage(), 500);
      }
   }

   public function fromRajaOngkir($id)
   {
      try {
         $rajaOngkir = new RajaOngkir();
         $province = $id ? $rajaOngkir->getProvinceById($id) : $rajaOngkir->getProvinces();
         return $province;
      } catch (\Throwable $th) {
         throw new Exception($th->getMessage(), 500);
      }
   }
}
