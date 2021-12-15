<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $labels = ['item_id', 'date', 'p10', 'p50', 'p90', 'mean'];
        // $data = array();
        $data = collect(array());

        $csvFileNames = [
            'stockout_forecast_export_2021-12-14T13-20-10Z_part0.csv',
            'stockout_forecast_export_2021-12-14T13-20-10Z_part1.csv',
            'stockout_forecast_export_2021-12-14T13-20-10Z_part2.csv',
            'stockout_forecast_export_2021-12-14T13-20-10Z_part3.csv'
        ];

        foreach ($csvFileNames as $csvFileName) {
            $csvFile = 'https://stockoutforecastbucket.s3.ap-southeast-1.amazonaws.com/' . $csvFileName;
        
            $dataFile = $this->readCSV($csvFile, array('delimiter' => ','));
    
            unset($dataFile[0]);
            
            foreach ($dataFile as $item) {
                $data->push([
                    'item_id' => $item[0],
                    'date' => $item[1],
                    'p10' => $item[2],
                    'p50' => $item[3],
                    'p90' => $item[4],
                    'mean' => $item[5]
                ]);
            }
            
            // $data = array_merge($data, $dataFile);
        }

        // $artikel = Artikel::where('status', 'publikasi')->where('published_at', '<=', Carbon::now())->orderBy('published_at', 'desc');

        // if(Session::get('lg') == 'en' ) {
        //     $artikel = $artikel->where('judul_english', '!=', null)->paginate(9);
        //     return view('content_english.articles', compact('artikel'));
        // }

        // $artikel = $artikel->paginate(9);

        // return view('dashboard.index', compact('artikel'));
        return view('dashboard.index', compact('data'));
    }
}
