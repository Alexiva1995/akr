<?php

namespace Database\Seeders;

use App\Models\Rank;
use Illuminate\Database\Seeder;

class RanksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        $arrayRank = [
            
            [
                "id"=>"1",
                "name"=>"EJECUTIVO",
                "description"=>"Tener dos referidos de rango EJECUTIVOS uno a cada lado",
                "points"=>"3000",
            ],
            [
                "id"=>"2",
                "name"=>"EJECUTIVO LÍDER",
                "description"=>"Tener dos referidos de rango EJECUTIVO LÍDER uno a cada lado",
                "points"=>"8000",
            ],
            [
                "id"=>"3",
                "name"=>"EJECUTIVO PREMIUM",
                "description"=>"Tener dos referidos de rango EJECUTIVO LÍDER uno a cada lado",
                "points"=>"30000",
            ],
            [
                "id"=>"4",
                "name"=>"MASTER NACIONAL",
                "description"=>"Tener dos referidos de rango EJECUTIVO PREMIUM uno a cada lado",
                "points"=>"50000",
            ],
            [
                "id"=>"5",
                "name"=>"MASTER INTERNACIONAL",
                "description"=>"Tener dos referidos de rango MASTER NACIONAL uno a cada lado",
                "points"=>"140000",
            ],
            [
                "id"=>"6",
                "name"=>"MASTER GLOBAL",
                "description"=>"Tener dos referidos de rango MASTER INTERNACIONAL uno a cada lado.",
                "points"=>"320000",
            ],
            [
                "id"=>"7",
                "name"=>"VICEPRESIDENTE",
                "description"=>"Tener dos referidos de rango MASTER GLOBAL uno a cada lado.",
                "points"=>"500000",
            ],
            [
                "id"=>"8",
                "name"=>"PRESIDENTE GLOBAL",
                "description"=>"Tener dos referidos de rango PRESIDENTE GLOBAL uno a cada lado",
                "points"=>"1500000",
            ],
        ];
        foreach ($arrayRank as $rank ) {
            Rank::create($rank);
        }
    }
}
