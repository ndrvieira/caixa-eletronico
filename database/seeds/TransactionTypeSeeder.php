<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transaction_types')->insert([
            'name' => 'deposit'
        ]);

        DB::table('transaction_types')->insert([
            'name' => 'withdraw'
        ]);
    }
}
