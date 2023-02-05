<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->truncate();

        DB::table('settings')->insert([
            [
                'setting_key' => 'company_name',
                'setting_value' => 'Superior Manufacturing',
            ],
            [
                'setting_key' => 'company_country',
                'setting_value' => 'Kenya',
            ],
            [
                'setting_key' => 'company_address',
                'setting_value' => '100000 Riverside',
            ],
            [
                'setting_key' => 'company_city',
                'setting_value' => 'Nairobi',
            ],
            [
                'setting_key' => 'company_zip',
                'setting_value' => '00100',
            ],
            [
                'setting_key' => 'company_email',
                'setting_value' => 'info@superiormanufacturing.com',
            ],
            [
                'setting_key' => 'company_website',
                'setting_value' => 'superiormanufacturing.com',
            ],
            [
                'setting_key' => 'company_pin',
                'setting_value' => 'A012345678T',
            ],
            [
                'setting_key' => 'company_currency',
                'setting_value' => 'KES',
            ],
            [
                'setting_key' => 'currency_symbol',
                'setting_value' => 'Ksh',
            ],
            [
                'setting_key' => 'currency_position',
                'setting_value' => 'left',
            ],
            [
                'setting_key' => 'company_logo',
                'setting_value' => 'bk.jpg',
            ],
        ]);
    }
}
