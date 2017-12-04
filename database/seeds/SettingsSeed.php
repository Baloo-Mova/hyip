<?php

use Illuminate\Database\Seeder;

class SettingsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            \App\Models\Settings::truncate();
            \App\Models\Settings::insert([
                [
                    'smtp' => 'smtp.gmail.com',
                    'smtp_port' => 465,
                    'smtp_login' => 'hyipsws@gmail.com',
                    'smtp_pasw' => 'Nelly418390',
                    'smtp_secure' => 'ssl',
                    'payeer_number' => 'P72440668',
                    'payeer_api_id' => '400881970',
                    'payeer_api_key' => 'rJYqKJGimwvOfMvq',
                    'payeer_m_shop' => '395290401',
                    'payeer_m_key' => '123',
                    'admin_ips' => '["127.0.0.1", "127.0.0.2"]',
                    'min_sum' => 10,
                    'max_sum' => 500,
                    'received' => 0
                ]
            ]);
        } catch (Exception $ex) {
        }
    }
}
