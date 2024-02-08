<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
   public function getProvince(Request $request)
   {
      try {
         $id = $request->query('id');
         $province = $id ? Province::findOrFail($id) : Province::all();

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
}
