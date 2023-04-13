<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ingredients extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ingredients')->insert(
            ['ingredient' => 'beef', 'quantity' => '150000']
        );
        DB::table('ingredients')->insert(
            ['ingredient' => 'cheese', 'quantity' => '30000'],
        );
        DB::table('ingredients')->insert(
            ['ingredient' => 'onion', 'quantity' => '20000']
        );
    }
}
