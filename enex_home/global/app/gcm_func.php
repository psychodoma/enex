<?php

function sendMessage($registration_id, $pushTitle, $pushContents)
{
	echo "sendMessage func call..<br>";
	$auth = "AIzaSyB59tmWUxAKpCmkASlC6-Cu29bFKXVqyqQ";

    $data = array(
        'registration_ids' => array($registration_id),
        'data' => array('title' =>$pushTitle , 'msg' =>$pushContents)
    );

    $headers = array(
        "Content-Type:application/json",
        "Authorization:key=".$auth
    );

	//print("<XMP>");
	//print(json_encode($data));
	//print("\n");

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://android.googleapis.com/gcm/send");
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $result = curl_exec($ch);

    //print_r($result);
    curl_close($ch);
}

/*

sendMessage('APA91bENhQSyVXWJf4aZwe7anfjG7XZa80AocpLB3NXNbrO2DMIT1Iy8UBaNOn82C3yYR6C-bA9yN7nLaxHwSJAqQCw3gbXP69PWmohBB4VDqnmnOcyNcjlfeeJLdKrT4tPWeBu8RiDB', '안녕!', '푸쉬 내용!!2');
echo 'adsf';
*/