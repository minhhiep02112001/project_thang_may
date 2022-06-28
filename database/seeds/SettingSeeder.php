<?php

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = array(
            'logo_icon'=>'',
            'logo_header'=>'',
            'logo_footer'=>'',
            'meta_title'=>'',
            'meta_description'=>'',
            'meta_keyword'=>'',
            'website'=>'',
            'email'=>'',
            'link_facebook'=>'',
            'address'=>'',
            'phone'=>'',
            'tax'=>'',
            'category_home'=>''
        );

        foreach ($settings as $key => $value) {
            \App\Model\Setting::updateOrCreate(
                ['key'=>$key],
                [
                'key' => $key,
                'value' => $value,
            ]);
        }
    }
}
