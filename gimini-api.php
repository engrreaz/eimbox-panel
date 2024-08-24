<?php
// https://rapidapi.com/swift-api-swift-api-default/api/open-ai-text-to-speech1/playground/apiendpoint_610ab9ae-2b78-4460-861f-99fdfc99def3

$api_key = "AIzaSyBGK4pYmqLk1CGCjuOztXLtV4CUcLyaZOc";

$url = "https://generativelanguage.googleapis.com/v1/models/gemini-pro:generateContent?key={$api_key}";
$ask = "hello";
if(isset($_GET["ask"])){
    $ask = $_GET["ask"];
} 

if(isset($_POST["ask"])){
    $ask = $_POST["ask"] . ' reply in short if possible ';
} 

// echo $ask;

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


$curl = curl_init();
curl_setopt_array($curl, [
	CURLOPT_URL => "https://open-ai-text-to-speech1.p.rapidapi.com/",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => json_encode([
		'model' => 'tts-1',
		'input' => $xx,
		'voice' => 'alloy'
	]),
	CURLOPT_HTTPHEADER => [
		"Content-Type: application/json",
		"x-rapidapi-host: open-ai-text-to-speech1.p.rapidapi.com",
		"x-rapidapi-key: be52840334msh616fdcaba9a2402p13a0e9jsn17cdbcea7c12"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	// echo $response;
	file_put_contents('tts/speech.mp3', $response);
	echo 'saved';
	// echo var_dump($response);
	
}