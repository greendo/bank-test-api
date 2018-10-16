<?php

use Illuminate\Database\Seeder;

class Values extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Customer::class, 10)->create();
        factory(\App\Transaction::class, 10)->create();
    }
}
