<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('store-transactions', function () {
    $yesterday = \Carbon\Carbon::now()->subDay();
    $transactions = \App\Transaction::whereDate('created_at', $yesterday)->sum('amount');
    dump($transactions);
})->describe('Display an inspiring quote');
