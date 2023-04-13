<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class product extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert(['item' => 'burger']);
        DB::table('products')->insert(['item' => 'pizza']);
        DB::table('products')->insert(['item' => 'pasta']);
    }
}
