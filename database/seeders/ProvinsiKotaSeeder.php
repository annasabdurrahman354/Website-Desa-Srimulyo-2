<?php

namespace Database\Seeders;

use ParseCsv\Csv;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinsiKotaSeeder extends Seeder
{
    protected static $path = __DIR__.'/data/csv';

    public static function getProvinces()
    {
        $result = self::getCsvData(self::$path.'/provinsi.csv');

        return $result;
    }

    public static function getRegencies()
    {
        $result = self::getCsvData(self::$path.'/kota.csv');

        return $result;
    }

    public function run()
    {
        $provinces = $this->getProvinces();
        $regencies = $this->getRegencies();

        DB::table('provinsis')->insert($provinces);
        DB::table('kota')->insert($regencies);
    }

    public static function getCsvData($path = '')
    {
        $csv = new Csv();
        $csv->auto($path);

        return $csv->data;
    }
}
