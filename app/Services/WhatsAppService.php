<?php

namespace App\Services;

class WhatsAppService
{
    public static function sendMessage($to, $body, $file = null, $delay = 10, $schedule = 1665408510000)
    {
        $curl = curl_init();

        $pesan = [
            "messageType" => "text",
            "to" => $to,
            "body" => $body,
            "file" => $file,
            "delay" => $delay,
            "schedule" => $schedule
        ];

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.starsender.online/api/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($pesan),
            CURLOPT_HTTPHEADER => array(
                'Content-Type:application/json',
                'Authorization: 3c6e1bf44afaf296ce941feb4d91da009facecd1'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
}
