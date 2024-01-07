<?php

namespace App\Http\Controllers;


use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
<<<<<<< Updated upstream
use function MongoDB\BSON\ObjectId;
=======
use App\Models\cve;
>>>>>>> Stashed changes

class ScoreBoardController extends Controller
{
    protected $data_tmp = [];
    public function __construct()
    {
        $this->data_tmp = [
            "log_management_list" => [
                ["id" => 1, "name" => "Splunk", "image" => "https://www.splunk.com/content/dam/splunk-logo-dark.svg", "point" => 10],
                ["id" => 2, "name" => "Elasticsearch", "image" => "https://static-www.elastic.co/v3/assets/bltefdd0b53724fa2ce/blt36f2da8d650732a0/5d0823c3d8ff351753cbc99f/logo-elasticsearch-32-color.svg", "point" => 9],
                ["id" => 3, "name" => "Loggly", "image" => "https://www.loggly.com/wp-content/uploads/2023/07/SW_Logo_Division_Loggly_Web_Orange.svg", "point" => 8],
                ["id" => 4, "name" => "Sumo Logic", "image" => "https://assets-www.sumologic.com/assets/refresh-images/footer/sumo-lockup.png", "point" => 7],
                ["id" => 5, "name" => "LogRhythm", "image" => "https://attachments.insent.ai/logrhythm/logo-logrhythm-1657126227445?1657126227539", "point" => 7],
                ["id" => 6, "name" => "New Relic", "image" => "https://scontent.fsgn5-2.fna.fbcdn.net/v/t39.30808-1/281769690_10160125860812495_4541212653657046312_n.jpg?stp=dst-jpg_p320x320&_nc_cat=105&ccb=1-7&_nc_sid=596444&_nc_ohc=uukgW1HcQRMAX_qUPKl&_nc_ht=scontent.fsgn5-2.fna&oh=00_AfB6lEt9tV7hK8esoQM8S-821Tp186X9hkewkixXhda7RQ&oe=65993B5C", "point" => 7],
                ["id" => 7, "name" => "Datadog", "image" => "https://imgix.datadoghq.com/img/dd_logo_n_70x75.png?ch=Width,DPR&fit=max&auto=format&w=70&h=75", "point" => 7],
            ],
            "vulnerability_management_list" => [
                ["id" => 1, "name" => "Qualys VMDR", "image" => "https://ik.imagekit.io/qualys/image/logo/qualys.svg", "point" => 10],
                ["id" => 2, "name" => "Tenable.io", "image" => "https://static.tenable.com/press/logos/TenableLogo_FullColor_RGB.svg", "point" => 9],
                ["id" => 3, "name" => "Rapid7 InsightVM", "image" => "https://www.rapid7.com/Areas/Docs/includes/img/r7-nav/Rapid7_logo.svg", "point" => 8],
                ["id" => 4, "name" => "Nessus", "image" => "https://cdn.dribbble.com/users/238042/screenshots/1014644/nessus-logo.png", "point" => 7],
                ["id" => 5, "name" => "OpenVAS", "image" => "	https://www.openvas.org/img/inmenulogo.png", "point" => 6],
                ["id" => 6, "name" => "Qualys Cloud Agent", "image" => "https://ik.imagekit.io/qualys/image/logo/qualys.svg", "point" => 8],
                ["id" => 7, "name" => "Tenable.io Cloud", "image" => "https://ik.imagekit.io/qualys/image/logo/qualys.svg", "point" => 8],
                ["id" => 8, "name" => "Rapid7 InsightVM Cloud", "image" => "https://static.tenable.com/press/logos/TenableLogo_FullColor_RGB.svg", "point" => 8]
            ],
            "security_awareness_training_list" => [
                ["id" => 1, "name" => "KnowBe4", "image" => "https://www.knowbe4.com/hubfs/KB4-logo.svg?noresize", "point" => 10],
                ["id" => 2, "name" => "PhishMe", "image" => "https://www.splunk.com/content/dam/splunk-logo-dark.svg", "point" => 9],
                ["id" => 3, "name" => "Cofense", "image" => "https://ehhbozgsut3.exactdn.com/wp-content/uploads/2023/11/cofense-tagline-logo.svg", "point" => 9],
                ["id" => 4, "name" => "Wombat Security Technologies", "image" => "https://www.proofpoint.com/themes/custom/proofpoint/dist/app-drupal/assets/logo-reg.svg", "point" => 8],
                ["id" => 5, "name" => "SecurityMetrics", "image" => "	https://www.securitymetrics.com/content/dam/securitymetrics/Header/sm_logo.svg", "point" => 7],
                ["id" => 6, "name" => "Palo Alto Networks Cortex XSOAR", "image" => "https://www.paloaltonetworks.com/etc/clientlibs/clean/imgs/cortex-logo-light.svg", "point" => 8],
                ["id" => 7, "name" => "Microsoft Security Awareness Training", "image" => "https://www.microsoft.com/library/svy/ms-logo-short.png", "point" => 6],
                ["id" => 8, "name" => "Cisco Secure Endpoint Security Awareness Training", "image" => "https://www.splunk.com/content/dam/splunk-logo-dark.svg", "point" => 6]
            ],
            "incident_response_plan_list" => [
                ["id" => 1, "name" => "Cortex XSOAR", "image" => "https://www.paloaltonetworks.com/etc/clientlibs/clean/imgs/cortex-logo-light.svg", "point" => 10],
                ["id" => 2, "name" => "Splunk SOAR", "image" => "https://www.splunk.com/content/dam/splunk-logo-dark.svg", "point" => 9],
                ["id" => 3, "name" => "Rapid7 InsightIDR", "image" => "https://www.rapid7.com/Areas/Docs/includes/img/r7-nav/Rapid7_logo.svg", "point" => 9],
                ["id" => 4, "name" => "LogRhythm SOAR", "image" => "https://attachments.insent.ai/logrhythm/logo-logrhythm-1657126227445?1657126227539", "point" => 8],
                ["id" => 5, "name" => "Micro Focus Security Orchestrator", "image" => "https://pnx-assets-prod.s3.amazonaws.com/2023-06/opentext_logo_8.svg", "point" => 8],
                ["id" => 6, "name" => "IBM Resilient", "image" => "https://www.forcepoint.com/sites/all/themes/custom/fp/assets/img/logos/forcepoint.svg", "point" => 7],
                ["id" => 7, "name" => "Symantec Endpoint Detection and Response (EDR)", "image" => "https://www.manageengine.com/images/logo/manageengine-logo.svg", "point" => 7],
                ["id" => 8, "name" => "Cisco SecureX", "image" => "https://www.splunk.com/content/dam/splunk-logo-dark.svg", "point" => 7]
            ]
        ];
    }

    public function index() {

        return view('layout', $this->data_tmp);
    }
    public function detail() {
        $data_map = [];
        foreach ($this->data_tmp as $key=>$item) {
            $point = 0;
            $total = count($item);
            foreach ($item as $data) {
                $point += $data['point'];
            }
            if(!isset($data_map[$key])) {
                $data_map[$key] = [
                    "name" => $key === "log_management_list" ? "Log management":($key === "vulnerability_management_list" ? "Vulnerability management":
                        ($key === "security_awareness_training_list" ? "Security awareness training":"Incident response plan")),
                    "point" => $point,
                    "medium_score" => $point / count($item),
                    "total" => count($item)
                ];
            }
        }
        $cal_security_monitoring = $this->subnet_3_calculate();
        $data_map['security_monitoring'] = [
            "name" => "security monitoring",
            "medium_score" => $cal_security_monitoring['system_security_score'],
        ];
        return view('detail',['data'=> $data_map]);
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
    public function importData(Request $request) {
        $number =  rand ( 100 , 999 );
        // Test database connection
        $data = [
            "createdBy" => "644fbf5307b8766e6fd88b9e",
            "updatedBy" => "644fbf5307b8766e6fd88b9e",
            "name" => "TEST_ID=". time(),
            "description" => "Description TEST_ID=". time(),
            "status" => "Operations",
            "systemProfileId" => "64b29e5419c695b9e3242b77",
            "systemProfileName" => "Unraveled",
            "securityGoals" => [
                [
                    "id" => 4,
                    "name" => "Dữ liệu được bảo vệ",
                    "description" => "Dữ liệu được bảo mật",
                    "assetId" => "6450bd0bb71968d0d9cf4d1c",
                    "confidentiality" => "HIGH",
                    "integrity" => "LOW",
                    "availability" => "LOW"
                ],
                [
                    "id" => 5,
                    "name" => "Hệ cơ sở dữ liệu luôn sẵn sàng",
                    "description" => "Dữ liệu luôn sẵn sàng",
                    "assetId" => "6450bd0bb71968d0d9cf4d1c",
                    "confidentiality" => "HIGH",
                    "integrity" => "MEDIUM",
                    "availability" => "HIGH"
                ],
                [
                    "id" => 6,
                    "name" => "Dữ liệu được mã hóa đầy đủ",
                    "description" => "Dữ liệu cá nhân của người dùng phải được mã hóa trước khi lưu",
                    "assetId" => "6450bd0bb71968d0d9cf4d1c",
                    "confidentiality" => "HIGH",
                    "integrity" => "HIGH",
                    "availability" => "LOW"
                ],
                [
                    "id" => 7,
                    "name" => "Quyền root trên CSDL được bảo vệ",
                    "description" => "Đảm bảo quyền root được bảo vệ",
                    "assetId" => "6450bd0bb71968d0d9cf4d1c",
                    "confidentiality" => "HIGH",
                    "integrity" => "HIGH",
                    "availability" => "HIGH"
                ],
                [
                    "id" => 8,
                    "name" => "Máy chủ Web luôn họat động 24/7",
                    "description" => "Luôn luôn hoạt động",
                    "assetId" => "64605d26303473f151ff9009",
                    "confidentiality" => "LOW",
                    "integrity" => "MEDIUM",
                    "availability" => "HIGH"
                ],
                [
                    "id" => 5,
                    "name" => "Máy chủ Web có khả năng tự điều phối giao tiếp",
                    "description" => "Máy chủ hoạt động tốt",
                    "assetId" => "64605d26303473f151ff9009",
                    "confidentiality" => "LOW",
                    "integrity" => "MEDIUM",
                    "availability" => "HIGH"
                ],
                [
                    "id" => 6,
                    "name" => "Preventing buffer overflows",
                    "description" => "Preventing buffer overflows",
                    "assetId" => "64b29e1c7547af07cfdec81a",
                    "confidentiality" => "HIGH",
                    "integrity" => "HIGH",
                    "availability" => "HIGH"
                ]
            ],
            "assets" => [
                [
                    "id" => "6450bd0bb71968d0d9cf4d1c",
                    "name" => "database server",
                    "part" => "a",
                    "vendor" => "MariaDB",
                    "product" => "MariaDB",
                    "version" => "10.0.38",
                    "cpe" => "cpe:2.3:a:mariadb:mariadb:10.0.38:*:*:*:*:*:*:*"
                ],
                [
                    "id" => "64605d26303473f151ff9009",
                    "name" => "web server",
                    "part" => "a",
                    "vendor" => "Apache",
                    "product" => "Apache Tomcat",
                    "version" => "9.0.62",
                    "cpe" => "cpe:2.3:a:apache:tomcat:9.0.62:*:*:*:*:*:*:*"
                ],
                [
                    "id" => "64b273a375f945d248cec247",
                    "name" => "computer window",
                    "part" => "o",
                    "vendor" => "Microsoft",
                    "product" => "Windows 10",
                    "version" => "1909",
                    "cpe" => "cpe:2.3:o:microsoft:windows_10:1909:*:*:*:*:*:x64:*"
                ],
                [
                    "id" => "64b273c475f945d248cec24b",
                    "name" => "computer ubuntu",
                    "part" => "o",
                    "vendor" => "Canonical",
                    "product" => "Ubuntu",
                    "version" => "18.04 LTS",
                    "cpe" => "cpe:2.3:o:canonical:ubuntu_linux:18.04:*:*:*:lts:*:*:*"
                ],
                [
                    "id" => "64b29e1c7547af07cfdec81a",
                    "name" => "SFTP server",
                    "part" => "a",
                    "vendor" => "Green End",
                    "product" => "SFTP server",
                    "version" => "0.2.1",
                    "cpe" => "cpe:2.3:a:greenend:sftpserver:0.2.1:*:*:*:*:*:*:*"
                ],
                [
                    "id" => "64b7ad20400c275283e3edcf",
                    "name" => "honeypot server",
                    "part" => "a",
                    "vendor" => "Apache",
                    "product" => "HTTP server",
                    "version" => "0.8.11",
                    "cpe" => "cpe:2.3:a:apache:http_server:0.8.11:*:*:*:*:*:*:*"
                ]
            ],
            "assetRelationships" => [
                [
                    "id" => 1,
                    "source" => "64b273a375f945d248cec247",
                    "target" => "64b273c475f945d248cec24b",
                    "accessVector" => "NETWORK",
                    "privilege" => "NONE"
                ],
                [
                    "id" => 2,
                    "source" => "64b273c475f945d248cec24b",
                    "target" => "64605d26303473f151ff9009",
                    "accessVector" => "NETWORK",
                    "privilege" => "APP_USER"
                ],
                [
                    "id" => 3,
                    "source" => "64605d26303473f151ff9009",
                    "target" => "6450bd0bb71968d0d9cf4d1c",
                    "accessVector" => "ADJACENT_NETWORK",
                    "privilege" => "APP_USER"
                ],
                [
                    "id" => 4,
                    "source" => "64605d26303473f151ff9009",
                    "target" => "64b29e1c7547af07cfdec81a",
                    "accessVector" => "NETWORK",
                    "privilege" => "APP_USER"
                ],
                [
                    "id" => 5,
                    "source" => "64b273a375f945d248cec247",
                    "target" => "64b7ad20400c275283e3edcf",
                    "accessVector" => "NETWORK",
                    "privilege" => "NONE"
                ],
                [
                    "id" => 6,
                    "source" => "64b273c475f945d248cec24b",
                    "target" => "64b7ad20400c275283e3edcf",
                    "accessVector" => "NETWORK",
                    "privilege" => "NONE"
                ]
            ],
            "countermeasures" => [
                [
                    "oid" => "64b7e0c6c8dd72612b8cc52a"
                ]
            ],
            "attackers" => [
                [
                    "oid" => "64b7b757c8dd72612b8cc39a"
                ]
            ],
            "cves" => [
                [
                    "oid" => "64b7b75fc8dd72612b8cc3a9"
                ],
                [
                    "oid" => "64b7b764c8dd72612b8cc3b7"
                ],
                [
                    "oid" => "64b7b768c8dd72612b8cc3c5"
                ],
                [
                    "oid" => "64b7b772c8dd72612b8cc3d3"
                ],
                [
                    "oid" => "64b7b77bc8dd72612b8cc3e1"
                ],
                [
                    "oid" => "64b7b785c8dd72612b8cc3ef"
                ],
                [
                    "oid" => "64b7b797c8dd72612b8cc40d"
                ],
                [
                    "oid" => "64b7b79bc8dd72612b8cc41b"
                ],
                [
                    "oid" => "64b7b7dac8dd72612b8cc42d"
                ],
                [
                    "oid" => "64b7b7f2c8dd72612b8cc43b"
                ],
                [
                    "oid" => "64b7bad9c8dd72612b8cc450"
                ],
                [
                    "oid" => "659941cff63e9b3bfa97b7e2"
                ],
                [
                    "oid" => "659950a3f63e9b3bfa97bbd9"
                ],
                [
                    "oid" => "65996499f63e9b3bfa97bd8f"
                ]
            ],
            "exploitability" => "High",
            "remediationLevel" => "Unavailable",
            "reportConfidence" => "Confirmed",
            "createdAt" => [
                "date" => "2023-07-19T10:12:50.844Z"
            ],
            "updatedAt" => [
                "date" => "2024-01-06T15:08:52.438Z"
            ],
            "__v" => 178,
            "attackGraph" => [
                "nodes" => [],
                "edges" => []
            ],
            "baseBenefit" => 100,
            "baseImpact" => 100,
            "benefitCriterion" => 100,
            "damageCriterion" => 100,
            "deploymentScenarioId" => "64b7b722c8dd72612b8cc395",
            "id" => "64b7b722c8dd72612b8cc395"
        ];
        try {
            $deploymentScenarioId = DB::table('deploymentscenarios')->insertGetId($data);
            if(!$deploymentScenarioId) throw new \Exception('deploymentscenarios create failed');
            $deploymentScenario = DB::table('deploymentscenarios')->find($deploymentScenarioId);
            return response()->json([
                "data" => $deploymentScenario,
                "status" => "success"
            ]);
        }catch (\Exception $e) {
            return response()->json([
                "data" => [],
                "status" => "failed",
                "msg" => $e->getMessage()
            ], 400);
        }
    }
    public function getLastDeploymentScenario(Request $request) {
        $deploymentScenario = DB::table('deploymentscenarios')->orderBy('createdAt','DESC')->first();
        return response()->json([
            "data" => $deploymentScenario,
            "status" => "success"
        ]);
    }
}
