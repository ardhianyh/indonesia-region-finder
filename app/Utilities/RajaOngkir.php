<?php

namespace App\Utilities;

use GuzzleHttp\Client;

class RajaOngkir
{
   protected $client;

   function __construct()
   {
      $this->client = new Client([
         "headers" => [
            "key" => env('RAJA_ONGKIR_API_KEY')
         ]
      ]);
   }

   public function getProvinces()
   {
      $fetchData = $this->client->request('GET', 'https://api.rajaongkir.com/starter/province');
      $reponses = json_decode($fetchData->getBody());
      return $reponses->rajaongkir->results;
   }

   public function getProvinceById($id)
   {
      $fetchData = $this->client->request('GET', 'https://api.rajaongkir.com/starter/province?id=' . $id);
      $reponses = json_decode($fetchData->getBody());
      return $reponses->rajaongkir->results;
   }

   public function getCities()
   {
      $fetchData = $this->client->request('GET', 'https://api.rajaongkir.com/starter/city');
      $reponses = json_decode($fetchData->getBody());
      return $reponses->rajaongkir->results;
   }

   public function getCityById($id)
   {
      $fetchData = $this->client->request('GET', 'https://api.rajaongkir.com/starter/city?id=' . $id);
      $reponses = json_decode($fetchData->getBody());
      return $reponses->rajaongkir->results;
   }

   public function getCitiesByProvinceId($id)
   {
      $fetchData = $this->client->request('GET', 'https://api.rajaongkir.com/starter/city?province=' . $id);
      $reponses = json_decode($fetchData->getBody());
      return $reponses->rajaongkir->results;
   }
}
