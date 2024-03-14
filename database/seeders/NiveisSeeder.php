<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NiveisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ["nome" => "ENSINO MÉDIO"],
            ["nome" => "GRADUAÇÃO"]
        ];
        DB::table('niveis')->insert($data);
    }
}
