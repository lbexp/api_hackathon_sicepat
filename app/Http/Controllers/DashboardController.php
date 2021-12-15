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

        dd($data->toArray());
        
        // Change $data date
        // $keyState = 0;
        // $processedData = collect(array());
        
        // foreach ($data as $item) {
        //     $processedData->push([
        //         'item_id' => $item[0],
        //         'date' => $item[1],
        //         'p10' => $item[2],
        //         'p50' => $item[3],
        //         'p90' => $item[4],
        //         'mean' => $item[5]
        //     ]);
        //     $keyState++;
        // }

        // dd($processedData->toArray());

        return view('dashboard.index', compact('data', 'labels'));
    }
}
