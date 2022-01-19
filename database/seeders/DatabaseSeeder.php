<?php

namespace Database\Seeders;

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
        \App\Models\Country::factory(100)->create();
        \App\Models\AgeRestriction::factory(100)->create();
        \App\Models\Gender::factory(100)->create();
        \App\Models\Bank::factory(100)->create();
        \App\Models\Functionality::factory(100)->create();
        \App\Models\Role::factory(3)->create();
        \App\Models\PaymentMethod::factory(100)->create();
        \App\Models\CoinPack::factory(100)->create();
        

        \App\Models\User::factory(100)->create();
        \App\Models\RoleFunctionality::factory(50)->create();
        \App\Models\BankMethod::factory(100)->create();
        \App\Models\FollowUp::factory(100)->create();
        \App\Models\UserCoin::factory(100)->create();
        \App\Models\Transaction::factory(100)->create();
        \App\Models\WishList::factory(100)->create();
        \App\Models\UserPaymentMethod::factory(100)->create();
        \App\Models\Game::factory(100)->create();       
        \App\Models\GameGenre::factory(100)->create();
        \App\Models\GameTransaction::factory(100)->create();

        \App\Models\Library::factory(100)->create();

        \App\Models\Valuation::factory(100)->create();

        \App\Models\GameWishList::factory(100)->create();

        \App\Models\GeographicRestriction::factory(100)->create();
    }
}
