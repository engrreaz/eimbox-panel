<?php

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
		'input' => 'Hi I am labib Shahriar. whats about you?',
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