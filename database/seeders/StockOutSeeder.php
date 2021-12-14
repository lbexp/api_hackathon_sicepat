<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Arr;

class StockOutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 365; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d H:i:s');
            
            $items = ['Item 1', 'Item 2', 'Item 3', 'Item 4', 'Item 5', 'Item 6', 'Item 7'];

            foreach ($items as $item) {
                DB::table('stock_outs')->insert([
                    'nama_barang' => $item,
                    'jumlah_keluar' => Arr::random([1 ,2 ,3 ,4 ,5 ,6 ,7 ,8 ,9 ,10, 11, 12, 13, 14, 15]),
                    'tanggal_keluar' => $date
                ]);
            }
        }
    }
}
