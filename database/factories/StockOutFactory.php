<?php

namespace Database\Factories;

use App\Models\StockOut;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockOutFactory extends Factory
{
    
    // protected $model = StockOut::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_barang' => $this->faker->name(),
            'jumlah_keluar' => Arr::random([1 ,2 ,3 ,4 ,5 ,6 ,7 ,8 ,9 ,10, 11, 12, 13, 14, 15]),
            'tanggal_keluar' => $this->faker->dateTimeBetween('-30 days', 'now'),
        ];
    }
}
