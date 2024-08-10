<?php
$api_key = "AIzaSyBGK4pYmqLk1CGCjuOztXLtV4CUcLyaZOc";

$url = "https://generativelanguage.googleapis.com/v1/models/gemini-pro:generateContent?key={$api_key}";
if(isset($_GET["ask"])){
    $ask = $_GET["ask"];
} else {
    $ask = "hello";
}

$data = array(
    "contents" => array(
        array(
            "role" => "user",
            "parts" => array(
                array(
                    "text" => $ask
                )
            )
        )
    )
);

$json_data = json_encode($data);
$ch = curl_init($url);

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);
curl_close($ch);

if (curl_errno($ch)) {
    echo 'Curl error: ' . curl_error($ch);
}

$json = json_decode($response, true);

$xx = $json["candidates"][0]["content"]["parts"][0]["text"];
echo $xx;