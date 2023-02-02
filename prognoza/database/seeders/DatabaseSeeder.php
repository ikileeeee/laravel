<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Prognoza;
use App\Models\Region;
use App\Models\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Prognoza::truncate();
        Region::truncate();
        User::truncate();
         $u1= User::create([
            'name'=>"Ivana",
            'prezime'=>"Drndarevic",
            'email'=>"iki@gmail.com",
            'password'=>bcrypt('iki123')
         ]);
         $user=User::factory(2)->create();

        $r3=Region::create([
            'naziv'=>"Istocna Srbija",
            'opis'=>"Obuhvata Istocnu Srbiju",
        ]);

        Region::insert([
            [
                'naziv'=>"Severna Srbija",
                'opis'=>"Obuhvata Backu, Banat i Srem",
            ],
            [
                'naziv'=>"Juzna Srbija",
                'opis'=>"Obuhvata Juznu Srbiju",
            ]
        ]);
        
        $r1=Region::create([
            'naziv'=>"Zapadna Srbija",
            'opis'=>"Obuhvata Zapadnu Srbiju",
        ]);
        $r5=Region::create([
            'naziv'=>"Beograd",
            'opis'=>"Region koji obuhvata grad Beograd i centralnu Srbiju",
        ]);

        Prognoza::create([
            'temperatura'=>'10',
            'dan'=>'22-12-15',
            'pojava'=>'Sneg',
            'region_id'=>$r1->id,
            'user_id'=>$u1->id
        ]);
        Prognoza::create([
            'temperatura'=>'12',
            'dan'=>'22-12-16',
            'pojava'=>'Snezna oluja',
            'region_id'=>$r3->id,
            'user_id'=>$u1->id
        ]);
        $reg=Region::factory(3)->create();

    }
}
