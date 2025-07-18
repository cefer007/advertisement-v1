<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Ban;
use App\Models\Car;
use App\Models\CarSupplier;
use App\Models\City;
use App\Models\Color;
use App\Models\Currency;
use App\Models\FuelType;
use App\Models\Gear;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//         \App\Models\User::factory(1)->create();



         $user = User::query()
             ->where('email', 'admin@gmail.com')
             ->first();

         if(!$user)
         {
             \App\Models\User::factory()->create([
                 'name' => 'Admin',
                 'email' => 'admin@gmail.com',
                 'password' => bcrypt('password'),
             ]);
         }

        Car::factory(100)->create();

        FuelType::query()
            ->insert([
                [
                    'name' => 'Benzin'
                ],
                [
                    'name' => 'Qaz'
                ],
                [
                    'name' => 'Dizel'
                ],
                [
                    'name' => 'Hibrid'
                ],
                [
                    'name' => 'Elektro'
                ],
                [
                    'name' => 'Plug in Hibrid'
                ],
            ]);

        Gear::query()
            ->insert([
                [
                    'name' => 'Arxa'
                ],
                [
                    'name' => 'Ön'
                ],
                [
                    'name' => 'Tam'
                ],
            ]);

        Ban::query()
            ->insert([
                [
                    'name' => 'Avtobus'
                ],
                [
                    'name' => 'Dartqı'
                ],
                [
                    'name' => 'Furqon'
                ],
                [
                    'name' => 'Moped'
                ],
                [
                    'name' => 'Motosiklet'
                ],
                [
                    'name' => 'Sedan'
                ],
                [
                    'name' => 'SUV'
                ],
                [
                    'name' => 'Fayton'
                ],
                [
                    'name' => 'Karavan'
                ],
            ]);

        Color::query()
            ->insert([
                [
                    'name' => 'Qırmızı'
                ],
                [
                    'name' => 'Çəhrayı'
                ],
                [
                    'name' => 'Yaşıl'
                ],
                [
                    'name' => 'Qara'
                ],
                [
                    'name' => 'Ağ'
                ],
            ]);

        Currency::query()
            ->insert([
                [
                    'name' => 'Manat',
                    'code' => 'AZN',
                ],
                [
                    'name' => 'Dollar',
                    'code' => 'USD',
                ],
                [
                    'name' => 'Avro',
                    'code' => 'EUR',
                ],
            ]);

        CarSupplier::query()
            ->insert([
                [
                    'name' => 'Yüngül lehimli disklər'
                ],
                [
                    'name' => 'Mərkəzi qapanma'
                ],
                [
                    'name' => 'Dəri salon'
                ],
                [
                    'name' => 'ABS'
                ],
                [
                    'name' => 'Park radarı'
                ],
                [
                    'name' => 'Ksenon lampalar'
                ],
                [
                    'name' => 'Lyuk'
                ],
                [
                    'name' => 'Yağış sensoru'
                ],
            ]);

        City::query()
            ->insert([
                [
                    'name' => 'Bakı'
                ],
                [
                    'name' => 'Sumqayıt'
                ],
                [
                    'name' => 'Salyan'
                ],
                [
                    'name' => 'Xırdalan'
                ],
                [
                    'name' => 'Gəncə'
                ],
                [
                    'name' => 'Şamaxı'
                ],
            ]);


    }
}
