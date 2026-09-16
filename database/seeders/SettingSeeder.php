<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'app_name' =>'POS - Restaurant',
            'business_name' =>'Kopi Kenangan',
            'institution' =>'Pusat Pelatihan Kerja Daerah Jakarta Pusat'
        ]);
    }
}
