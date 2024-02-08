<?php

namespace App\Console\Commands;

use App\Models\City;
use App\Models\Province;
use Illuminate\Console\Command;

class DataFetcher extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch-data-rajaongkir';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieve provinces and cities from RajaOngkir then save to local database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $fetchProvinces = $this->getProvinces();
        $provinces = $this->insertProvince($fetchProvinces);

        $this->insertCities(array_reverse($provinces));
    }

    protected function getProvinces()
    {
        echo "Retrieving provinces from RajaOngkir...." . PHP_EOL;
        $client = new \GuzzleHttp\Client();
        $fetchData = $client->request('GET', 'https://api.rajaongkir.com/starter/province', [
            "headers" => [
                "key" => env('RAJA_ONGKIR_API_KEY')
            ]
        ]);
        $reponses = json_decode($fetchData->getBody());
        echo "Retrieved from RajaOngkir" . PHP_EOL;
        return $reponses->rajaongkir->results;
    }

    protected function insertProvince($data)
    {
        echo "Start insert provinces to local database" . PHP_EOL;
        $provinces = [];
        foreach ($data as $key => $res) {
            $province = Province::create(["name" => $res->province]);
            $provinces[$key] = [
                "id" => $res->province_id,
                "name" => $province->name
            ];
            echo "[success] " . $province['name'] . PHP_EOL;
        }

        echo "Province Successfuly Inserted" . PHP_EOL;
        return $provinces;
    }

    protected function getCitiesByProvinceId($id)
    {
        $client = new \GuzzleHttp\Client();
        $fetchData = $client->request('GET', 'https://api.rajaongkir.com/starter/city?province=' . $id, [
            "headers" => [
                "key" => env('RAJA_ONGKIR_API_KEY')
            ]
        ]);
        $reponses = json_decode($fetchData->getBody());
        return $reponses->rajaongkir->results;
    }

    protected function insertCities($provinces)
    {
        if (count($provinces) == 0) {
            echo "Completed!" . PHP_EOL;
            return;
        }

        $province = array_pop($provinces);

        echo "Retrieving cities under " . $province['name'] . " from RajaOngkir" . PHP_EOL;
        $cities = $this->getCitiesByProvinceId($province['id']);
        echo "Retrieved. Start insert all cities to local database" . PHP_EOL;

        foreach ($cities as $city) {
            City::create([
                "province_id" => $province['id'],
                "name" => $city->city_name,
            ]);

            echo "[success] " . $province['name'] . " - " . $city->city_name . PHP_EOL;
        }
        echo "Inserted Cities under " . $province['name'] . PHP_EOL;

        $this->insertCities($provinces);
    }
}
