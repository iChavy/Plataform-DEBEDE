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
        \App\Models\Country::factory(10)->create();
        \App\Models\AgeRestriction::factory(10)->create();
        \App\Models\Gender::factory(10)->create();
        \App\Models\Bank::factory(10)->create();
        \App\Models\Functionality::factory(10)->create();
        \App\Models\Role::factory(10)->create();
        \App\Models\PaymentMethod::factory(10)->create();
        \App\Models\CoinPack::factory(10)->create();
        

        \App\Models\User::factory(10)->create();
        \App\Models\RoleFunctionality::factory(10)->create();
        \App\Models\BankMethod::factory(10)->create();
        \App\Models\FollowUp::factory(10)->create();
        \App\Models\UserCoin::factory(10)->create();
        \App\Models\Transaction::factory(10)->create();
        \App\Models\WishList::factory(10)->create();
        \App\Models\UserPaymentMethod::factory(10)->create();
        \App\Models\Game::factory(10)->create();       
        \App\Models\GameGenre::factory(10)->create();
        \App\Models\GameTransaction::factory(10)->create();

        \App\Models\Library::factory(10)->create();

        \App\Models\Valuation::factory(10)->create();

        \App\Models\GameWishList::factory(10)->create();

        \App\Models\GeographicRestriction::factory(10)->create();
    }
}
