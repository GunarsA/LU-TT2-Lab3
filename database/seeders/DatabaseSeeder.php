<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\Manufacturer;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Country::create(['name' => 'Germany', 'code' => 'DE']);
        Country::create(['name' => 'Italy', 'code' => 'IT']);
        Country::create(['name' => 'France', 'code' => 'FR']);
        Country::create(['name' => 'Spain', 'code' => 'ES']);
        Country::create(['name' => 'Japan', 'code' => 'JP']);

        #approach #1 - create instance of manufacturer, call save on collection
        $france = Country::where('name', 'France')->first();
        $renault = new Manufacturer();
        $renault->name = 'Renault';
        $renault->founded = 1899;
        $renault->website = 'https://www.renault.com';
        $france->manufacturers()->save($renault);

        #approach #2 - use "create"  shortcut of collection
        $france->manufacturers()->create(['name' => 'Peugeot', 'founded' => 1810, 'website' => 'https://www.peugeot.com']);

        #approach #3 - calling "associate" on sub-object
        $germany = Country::where('name', 'Germany')->first();
        $audi = new Manufacturer();
        $audi->name = 'Audi';
        $audi->founded = 1909;
        $audi->website = 'https://www.audi.com';
        $audi->country()->associate($germany);
        $audi->save();

        $spain = Country::where('name', 'Spain')->first();
        $japan = Country::where('name', 'Japan')->first();
        $spain->manufacturers()->create(['name' => 'Seat', 'founded' => 1950, 'website' => 'https://www.seat.com']);
        $japan->manufacturers()->create(['name' => 'Toyota', 'founded' => 1937, 'website' => 'https://www.toyota.com']);
        $germany->manufacturers()->create(['name' => 'Volkswagen', 'founded' => 1937, 'website' => 'https://www.volkswagen.com']);

        $volkswagen = Manufacturer::where('name', 'Volkswagen')->first();
        $audi = Manufacturer::where('name', 'Audi')->first();
        $seat = Manufacturer::where('name', 'Seat')->first();
        $volkswagen->carmodels()->create(['name' => 'Passat', 'production_started' => 1973, 'min_price' => 25000.00]);
        $volkswagen->carmodels()->create(['name' => 'Golf', 'production_started' => 1974, 'min_price' => 20000.00]);
        $volkswagen->carmodels()->create(['name' => 'Multivan', 'production_started' => 1985, 'min_price' => 40000.00]);
        $audi->carmodels()->create(['name' => 'A4', 'production_started' => 1994, 'min_price' => 30000.00]);
        $audi->carmodels()->create(['name' => 'A6', 'production_started' => 1994, 'min_price' => 40000.00]);
        $audi->carmodels()->create(['name' => 'Q3', 'production_started' => 2011, 'min_price' => 35000.00]);
        $audi->carmodels()->create(['name' => 'Q4', 'production_started' => 2019, 'min_price' => 40000.00]);
        $audi->carmodels()->create(['name' => 'Q5', 'production_started' => 2008, 'min_price' => 45000.00]);
        $seat->carmodels()->create(['name' => 'Toledo', 'production_started' => 1991, 'min_price' => 20000.00]);
        $seat->carmodels()->create(['name' => 'Ibiza', 'production_started' => 1984, 'min_price' => 15000.00]);
    }
}
