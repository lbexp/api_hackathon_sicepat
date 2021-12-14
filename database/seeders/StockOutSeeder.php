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
        for ($i = 1825; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d H:i:s');
            
            $items = [
                'Apple iPhone 13',
                'Apple iPhone 13 Pro',
                'Samsung Galaxy S21',
                'Samsung Galaxy S21 Ultra',
                'Samsung Galaxy Z Fold3',
                'Samsung Galaxy Z Flip3',
                'Xiaomi Mix 4',
                'Xiaomi Mi 11',
                'Xiaomi Mi 11 Ultra',
                'Xiaomi Mi 11 Pro',
                'Xiaomi Mi Mix Fold',
                'Xiaomi 11T Pro',
                'Google Pixel 6 Pro',
                'Google Pixel 6',
                'Vivo X70 Pro',
                'Huawei Mate X2'
            ];

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
