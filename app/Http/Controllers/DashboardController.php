<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function readCSV($csvFile, $array)
    {
        $file_handle = fopen($csvFile, 'r');
        while (!feof($file_handle)) {
            $line_of_text[] = fgetcsv($file_handle, 0, $array['delimiter']);
        }
        fclose($file_handle);
        return $line_of_text;
    }

    public function index()
    {
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');

        // forecast dates 10 days after
        $forecastDates = collect(array());
        for ($i = 1; $i <= 10; $i++) {
            $forecastDates->push(Carbon::now()->addDays($i)->format('Y-m-d'));
        }

        // dd($forecastDates[9]);

        $labels = ['item_id', 'date', 'p10', 'p50', 'p90', 'mean'];

        $data = collect(array());

        $forecastDataTable = collect(array());

        $csvFileNames = [
            'stockout_forecast_export_2021-12-14T13-20-10Z_part0.csv',
            'stockout_forecast_export_2021-12-14T13-20-10Z_part1.csv',
            'stockout_forecast_export_2021-12-14T13-20-10Z_part2.csv',
            'stockout_forecast_export_2021-12-14T13-20-10Z_part3.csv'
        ];

        // Put all the data from csv into $data
        foreach ($csvFileNames as $csvFileName) {
            $csvFile = 'https://stockoutforecastbucket.s3.ap-southeast-1.amazonaws.com/' . $csvFileName;
        
            $dataFile = $this->readCSV($csvFile, array('delimiter' => ','));
    
            unset($dataFile[0]);

            // dd($dataFile);
            
            $keyState = 0;

            foreach ($dataFile as $item) {
                // $date = date('Y-m-d', strtotime($item[1]));
                $data->push([
                    'item_id' => $item[0],
                    'date' => $forecastDates[$keyState],
                    'p10' => $item[2],
                    'p50' => $item[3],
                    'p90' => $item[4],
                    'mean' => $item[5]
                ]);
                $keyState++;

                if ($keyState == 10) $keyState = 0;
                // dd(Carbon::tomorrow()->format('Y-m-d'));
            }
            // $data = array_merge($data, $dataFile);
        }

        $tomorrowData = $data->where('date', Carbon::tomorrow()->format('Y-m-d'))->toArray();
        $currentStock = collect([
            'item_1' => 5,        
            'item_2' => 6,        
            'item_3' => 4,        
            'item_4' => 8,        
            'item_5' => 9,        
            'item_6' => 10,        
            'item_7' => 13,        
            'item_8' => 1,        
            'item_9' => 5,        
            'item_10' => 7,        
            'item_11' => 7,        
            'item_12' => 8,        
            'item_13' => 3,        
            'item_14' => 11,        
            'item_15' => 4,        
            'item_16' => 1
        ]);

        // Widget data, ini yang dipakai untuk tampilan ($line, $pie, $table)
        $line = array();
        $pie = [
            'understock' => 0,
            'overstock' => 0,
            'normal' => 0
        ];
        $table = collect();

        foreach ($tomorrowData as $item) {
            $predictedStock = (int)$item['mean'];
            $status = 'normal';

            if ($currentStock[$item['item_id']] < $predictedStock - 2) {
                $status = 'understock';
                $pie['understock']++;
            } elseif ($currentStock[$item['item_id']] > $predictedStock + 2) {
                $status = 'overstock';
                $pie['overstock']++;
            } else {
                $status = 'normal';
                $pie['normal']++;
            }

            $table->push([
                'item_id' => $item['item_id'],
                'date' => $item['date'],
                'current_stock' => $currentStock[$item['item_id']],
                'predicted_stock' => $predictedStock,
                'status' => $status
            ]);
        }

        foreach ($forecastDates as $key => $date) {
            $dataPerDate = $data->where('date', $date)->toArray();

            foreach ($dataPerDate as $item) {
                $line['date'][$date] = $date;
                $line[$item['item_id']][] = (int)$item['mean'];
            }
        }

        $table->toArray();

        return view('dashboard.index', compact('line', 'pie', 'table'));
    }
}
