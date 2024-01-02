<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Storage;
use Illuminate\Support\Facades\Http;
use DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Date;


class crawl_data_job implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        if (Cache::has('last_updated')) {
            $last_updated = Cache::get('last_updated');
            
        } else {
            $last_updated = "2015-01-01";
            Cache::put('last_updated', $last_updated, 3600);
        }

        $publishDateStart = date("Y-m-01", strtotime("$last_updated +1 month"));
        $publishDateEnd = date("Y-m-t", strtotime($publishDateStart));

        $url = 'https://www.cvedetails.com/api/v1/vulnerability/search';
        $headers = [
            'Authorization' => 'Bearer 8c10858bffb3bf405636a6cd8e05517999be3035.eyJzdWIiOjEyNzcsImlhdCI6MTcwMjM5NDg2OSwiZXhwIjoxNzA0OTMxMjAwLCJraWQiOjEsImMiOiJXbkN2XC9KbDlZcDJXWVhrRElDS2p2enE0alhYK1wvTW1CSGFDK0dFVXpvRElMQzBKWnlwc2JodkVraGYwMVA3dG9PNkZnaUNwMSJ9',
            'Accept' => '*/*',
            'User-Agent' => 'PostmanRuntime/7.36.0',
        ];

        $data = [
            "publishDateStart" => $publishDateStart,
            "publishDateEnd" => $publishDateEnd,
        ];

        $response = Http::withHeaders($headers)->get($url, $data);
        if ($response->successful()) {
            // Đường dẫn đến file JSON
            $jsonFilePath = 'assets.json'; // Thay đổi tùy vào đường dẫn thực tế của bạn

            // Đọc dữ liệu từ file JSON hiện tại
            $jsonData = json_decode(Storage::get($jsonFilePath), true);



            $data = $response->json()['results'];
            if(count($data) > 0) {
                foreach ($data as $cve) {
                    $response2 = Http::withHeaders($headers)->get("https://www.cvedetails.com/cve/" . $cve['cveId']);
                    // $response2 = Http::withHeaders($headers)->get("https://www.cvedetails.com/cve/CVE-2017-1536/"); //test
                    $pattern = '/cpe:2\.3:[^<]+/';

                    // Perform the regex match
                    preg_match_all($pattern, $response2->body(), $matches);
                    foreach ($matches[0] as $cpe) {
                        $cpe_details = explode(":", $cpe);


                        $new_element = [
                            "name"=> $cpe_details[4],
                            "part"=> $cpe_details[2],
                            "vendor"=> $cpe_details[3],
                            "product"=> $cpe_details[4],
                            "version"=> $cpe_details[5],
                            "cpe"=> $cpe
                        ];
                        $jsonData[] = $new_element;
                    }
                }
            }
                // Chuyển đổi lại thành định dạng JSON
            $jsonString = json_encode($jsonData, JSON_PRETTY_PRINT);
            // Ghi dữ liệu mới vào file JSON
            Storage::put($jsonFilePath, $jsonString);
        }

        Cache::put('last_updated', $publishDateStart, 3600);
        echo("last updated: " . $publishDateStart . "\n");
    }
}
