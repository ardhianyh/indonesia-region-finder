<?php

namespace App\Console\Commands;

use App\Models\City;
use App\Models\Province;
use App\Utilities\RajaOngkir;
use Illuminate\Console\Command;

class DataFetcher extends Command
{
    protected $rajaOngkir;
    protected $signature = 'fetch-data-rajaongkir';
    protected $description = 'Retrieve provinces and cities from RajaOngkir then save to local database';

    function __construct()
    {
        parent::__construct();
        $this->rajaOngkir = new RajaOngkir();
    }

    public function handle()
    {
        $fetchProvinces = $this->getProvinces();
        $provinces = $this->insertProvince($fetchProvinces);
        $this->insertCities(array_reverse($provinces));
    }

    protected function getProvinces()
    {
        echo "Retrieving provinces from RajaOngkir...." . PHP_EOL;
        $provinces = $this->rajaOngkir->getProvinces();
        echo "Retrieved from RajaOngkir" . PHP_EOL;

        return $provinces;
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

    protected function insertCities($provinces)
    {
        if (count($provinces) == 0) {
            echo "Completed!" . PHP_EOL;
            return;
        }

        $province = array_pop($provinces);

        echo "Retrieving cities under " . $province['name'] . PHP_EOL;

        $cities = $this->rajaOngkir->getCitiesByProvinceId($province['id']);

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
