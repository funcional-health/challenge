<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Industry::class, 1)->create(['name' => 'Funcional',]);

        factory(App\Industry::class, 1)->create(['name' => 'Johnson & Johnson',]);

        factory(App\Industry::class, 1)->create(['name' => 'Protect & Gamble',]);

        factory(App\Industry::class, 1)->create(['name' => 'Vanguard',]);

        factory(App\Product::class, 100)->create();
    }
}
