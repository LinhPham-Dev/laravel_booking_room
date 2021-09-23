<?php

namespace Database\Seeders;

use App\Models\Backend\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        Payment::create([
            'name' => 'Pay at the counter',
            'status' => 1
        ]);
    }
}
