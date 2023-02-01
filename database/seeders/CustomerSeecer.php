<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CustomerSeecer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'customer_name'=>'কাস্টমারের নাম',
            'customer_english_name'=>'customer_english_name',
            'customer_relations'=>'কাস্টমারের পিতার নাম',
            'slug'=> Str::slug('কাস্টমারের-নাম'),
            'village_id'=>1,
            'laids_id'=>1,
            'privious_total_due'=>500,
            'status'=>1,
        ]);
    }
}
