<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;

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
                    "point_total" => $point / count($item),
                    "total" => count($item)
                ];
            }
        }
        return view('detail',['data'=>$data_map]);
    }
}
