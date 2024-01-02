<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Jobs\crawl_assets;
use App\Jobs\crawl_data_job;
use Storage;
use DB;
use DOMDocument;
use DOMXPath;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Cache;
use App\Models\cve;
class CrawlController extends Controller
{
    public function crawlAssets() {
        crawl_data_job::dispatch();
        return "Job đã được chạy!";
    }

    public function subnet_3_calculate() {
        
        //ví dụ
        $data = '[
            {
              "id": "64605d26303473f151ff9009",
              "name": "Apache Web Server",
              "part": "a",
              "vendor": "Apache",
              "product": "Apache Tomcat",
              "version": "9.0.62",
              "cpe": "cpe:2.3:a:apache:tomcat:9.0.62:*:*:*:*:*:*:*"
            },
            {
              "id": "6477272803c4f00f023460aa",
              "name": "OS on Web Server",
              "part": "o",
              "vendor": "Canonical",
              "product": "Ubuntu",
              "version": "16.04 LTS",
              "cpe": "cpe:2.3:o:canonical:ubuntu_linux:16.04:*:*:*:lts:*:x64:*"
            },
            {
              "id": "6450bd0bb71968d0d9cf4d1c",
              "name": "Database on Web Server",
              "part": "a",
              "vendor": "MariaDB",
              "product": "MariaDB",
              "version": "1809",
              "cpe": "cpe:2.3:a:mariadb:mariadb:10.0.38:*:*:*:*:*:*:*"
            }
          ]';

        $list_assets = json_decode($data, true);
        $total_security_score = 0;

        foreach($list_assets as &$asset) {
            $asset['security_score'] = 10;
            $count_security_vulnerability = 0;
            // $asset['cpe'] = "cpe:2.3:o:canonical:ubuntu_linux:16.04:*:*:*:lts:*:x64:*"; //. test
            $cves = cve::whereIn('cpe', [$asset['cpe']])->get();
            if (count($cves) > 0) {
                foreach($cves as $cve) {
                    if ($cve->impact['baseMetricV3']['cvssV3']['baseScore'] > 5) {
                        $count_security_vulnerability++;
                    }
                }
            }

            if ($count_security_vulnerability > 30) {
                $asset['security_score'] = 0;
            }
            else {
                $asset['security_score'] = 10 -  round($count_security_vulnerability / 3);
            }

            $total_security_score += $asset['security_score'];
            // $asset['list_cve_score'] = [];

            // $url = 'https://nvd.nist.gov/vuln/search/results';
            // $headers = [
            //     'Accept' => '*/*',
            //     'User-Agent' => 'PostmanRuntime/7.36.0',
            // ];
    
            // $data = [
            //     "form_type" => "Advanced",
            //     "results_type" => "overview",
            //     "isCpeNameSearch" => "true",
            //     "seach_type" => "all",
            //     "query" => $asset['cpe'],
            // ];
            // dd($asset['cpe']);
    
            // $response = Http::withHeaders($headers)->get($url, $data);


            // // $html = file_get_contents('https://nvd.nist.gov/vuln/search/results?form_type=Advanced&results_type=overview&isCpeNameSearch=true&seach_type=all&query=cpe:2.3:o:canonical:ubuntu_linux:20.04:*:*:*:lts:*:*:*');
            // $html = $response->body();
            // $dom = new DOMDocument;
            // libxml_use_internal_errors(true);
            // $dom->loadHTML($html);
            // libxml_clear_errors();

            // $xpath = new DOMXPath($dom);

            // // Find all <td nowrap="nowrap"> elements
            // $tdNodes = $xpath->query('//td[@nowrap="nowrap"]');

            // // Iterate through each <td> element and output its content
            // foreach ($tdNodes as $tdNode) {
            //     $textContent = trim($tdNode->textContent);
            //     $patternV31 = '/V3\.1:\s*([\d.]+)\s*([A-Z]+)\s*/';
            //     $patternV20 = '/V2\.0:\s*([\d.]+)\s*([A-Z]+)\s*/';

            //     // Match V3.1 value
            //     preg_match($patternV31, $textContent, $matchesV31);
            //     $v31Text = isset($matchesV31[0]) ? trim($matchesV31[0]) : 'N/A';
            

            //     // Match V2.0 value
            //     preg_match($patternV20, $textContent, $matchesV20);
            //     $v20Text = isset($matchesV20[0]) ? trim($matchesV20[0]) : 'N/A';

            //     // Create an associative array
            //     $$asset['list_cve_score'][] = [
            //         "V3.1" => $v31Text,
            //         "V2.0" => $v20Text,
            //     ];
            // }
        }
        return [
            "list_assets" => $list_assets,
            "system_security_score" => round($total_security_score / count($list_assets))
        ];
    }
}
