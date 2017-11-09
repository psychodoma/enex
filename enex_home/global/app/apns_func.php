<?php
/*
pem 파일 암호는 "newstong" 입니다. php 스크립트에 설정하시는거 아시죠?
*/

function sendAPNS($target_token , $msg)
{
	//echo "sendAPNS func call..<br>";

	$payload = array();
		//$m = iconv("EUC-KR", "UTF-8", "님이");
	//	$msg = "나 먼저 간다";
	///	//       echo$m;
		$payload['aps'] = array('alert' => $msg, 'badge' => 0, 'sound' => 'default');
		//alert은 푸쉬가 도착했을 때 표시할 문구이고 badge는 푸쉬가 도착했을 때 아이콘에 표시할 뱃지 수이고
		//sound는 푸쉬가 도착했을 때 알림 소리이다.
		//이제 이 것을 JSON문법 형태로 고쳐야 한다.
		$push = json_encode($payload);
		//아주 간단하다. 만약 변환된 형태가 궁금하다면 최상단의 링크를 참조하시라.
		//만약 푸쉬를 통해서 앱으로 추가적인 정보를 전달해야 한다면 JSON으로 변환 전 추가적인 작업을 하자.
		//$payload['extra_info'] = array('name' => 'Lifeclue', 'blog' => 'http://blog.naver.com/legendx');
		//이런식으로 하면 푸쉬가 도착했을 때 앱에서 추가적으로 자료를 활용할 수 있다.
		//이제 아까 만들었던 pem파일을 써먹을 차례다. 경로를 입력하자.
		//만약 작성중인 php 파일과 같은 경로에 있다면
		$ctx = stream_context_create();
		$apnsCert = 'apns_prd.pem';
		//그리고 애플의 푸쉬서버와 통신할 stream context를 작성한다.
		$streamContext = stream_context_create();
		stream_context_set_option($streamContext, 'ssl', 'local_cert', $apnsCert);
		$passphrase = 'stock4989';
		stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
		//그대로 갖다 붙이면 된다;
		//이제 애플의 푸쉬 서버에 연결해보자.
		$apns = @stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $error, $errorString, 60, STREAM_CLIENT_CONNECT, $streamContext);
		//$apns = stream_socket_client('ssl://gateway.push.apple.com:2195', $error, $errorString, 60, STREAM_CLIENT_CONNECT, $streamContext);
		//만약 앱을 배포할 때에는 애플 프로비저닝 포털의 App ID에서 개발용이 아닌 배포용 푸쉬 인증서를 받으신 후
		
		if ($apns == FALSE) {
		       //echo"Error while getting stream socket ($error): $errorString";
		}
		
		//키체인에서 다시 인증서와 키를 추출한 후에 pem으로 돌리고 서버에 올리신 후 위에 있는 $apnsCert 변수의
		//파일명을 바꿔주시면 되며, 바로 이 위에 있는 $apns변수의 주소에서 sandbox를 빼주시면 된다.
		//ssl://gateway.push.apple.com
		if (!$apns) {
			//echo "Failed to connect $error $errorString\n";
		//print "Failed to connect $error $errorString\n";
		//       echo"Failed to connect $error $errorString\n";
		return;
		}else {
		//       echo"Succeed<br>";
		} 
		
		//$token64 = $target_token;//'64797cda8a11906d731ea4f696c4e067c5191a28a63ed5fafe5f925885ac93ae'; // 테스트할 토큰.. 
		//$token64 = '001eb2b754d9f256b97d2f31088539fa77b7da9a42af9e416141834ef43af090'; // 테스트할 토큰.. 
		//$msg = chr(0).pack("n",32).pack('H*',$token64).pack("n",strlen($payload)).$payload;
		$token64 = $target_token;
	/* 	$token64 = "0f1137aa0933bbb3312a7278a4fca3a0484ce96d24b744fd0bbe5bc6d049f5d6"; */
		//만약 요청에 실패하면 Failed to connect가 브라우저에 뜰 것이다.
		//자, 이제 드디어 푸쉬를 넣을 차례다! 아래 2줄만 반복하면 된다.
		@$apnsMessage = chr(0) . chr(0) . chr(32) . pack('H*', $token64) . chr(0) . chr(strlen($push)) . $push;
		//$apnsMessage = chr(0) . chr(0) . chr(32) . base64_decode($token64) . chr(0) . chr(strlen($payload)) . $payload;
		$writeResult = fwrite($apns, $apnsMessage);
		//마지막으로 썼던 것은 스스로 정리하자.
		@socket_close($apns);
		fclose($apns);
}
?>
