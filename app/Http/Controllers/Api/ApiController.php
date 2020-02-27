<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;

class ApiController extends Controller
{

    ///********************* Api Response Fucntion *******************//
    public static function ApiResponse($data = null, $message = null, $status, $type)
    {
        switch ($type) {
            case 'getdata':
                $api_message = ["title" => "success", "message" => $message];
                $array = [
                    "api_status" => 1,
                    "api_http" => $status,
                    "api_message" => (object) $api_message,
                    "data" => $data,

                ];
                break;
            case 'data_added':
                $api_message = ["title" => "success", "message" => $message];
                if ($data) {
                    $array = [
                        "api_status" => 1,
                        "api_http" => $status,
                        "api_message" => (object) $api_message,
                        "data"      => $data
                    ];
                } else {
                    $array = [
                        "api_status" => 1,
                        "api_http" => $status,
                        "api_message" => (object) $api_message,
                    ];
                }
                break;
            case 'error':
                $api_message = ["title" => "error", "message" => $message];

                $array = [
                    "api_status" => 0,
                    "api_http" => $status,
                    "api_message" => (object) $api_message,
                    "data" => $data,

                ];

                break;

            default:
                # code...
                break;
        }

        return response($array, $status);
    }

    ///********************* Error Handeller Function  *******************//

    public static function ErrorHandler($msg, $lang = null)
    {
        $messages = [
            "getdata" => "Data returned successfully",
            "Unauthorized" => "Your mobile number or password that you've entered is incorrect",
            "data_added" => "Data Added successfully",
            "not_verified" => "Your account is not verified",
            "invalid_verification" => "Invalid Verification Code",
            "data_delete"               => "Data Deleted successfully"
        ];
        return $messages[$msg];
    }

    #send mobile otp function
    public static function send_mobile_opt($mobile_number, $verification_code)
    {

        $http     =  new \GuzzleHttp\Client();
        try {
            $response = $http->post('https://www.alfa-cell.com/api/msgSend.php', [
                'form_params'   => [
                    'apiKey'    => ENV("SMSAPIKEY"),
                    "sender"    => "CreativMinds",
                    'msg'      =>  "Your Verifecation Code is: " . $verification_code,
                    'numbers'   => $mobile_number,
                ],
            ]);
            # decode response
            $status = json_decode((string) $response->getBody(), true);
            if ($status == 1) {
                $response =  ['code' => 200, 'response' => "sms send successfuly"];
            } else {

                $response =  ['code' => 404, 'response' => self::handle_alfa_call_reponse_statuse($status)];
            }
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $response = $e->getResponse()->getBody()->getContents();
            $response =  ['code' => 404, 'response' => $response];
        }
        return $response;
    }
    # handle sms response
    public  static function handle_alfa_call_reponse_statuse($statuse)
    {
        switch ($statuse) {
            case 1:
                return "success";
                break;
            case 15:
                return "you gave entered an invalid number ";
                break;
            default:
                return "opps , please call our support ";
                break;
        }
    }
}
