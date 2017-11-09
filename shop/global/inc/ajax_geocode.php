<?
@header("Content-Type: text/html; charset=utf-8");

//$keyWord = iconv("utf-8","euckr",$_REQUEST["addr"]);
//$keyWord = iconv("euckr","utf-8",$_REQUEST["addr"]);

$keyWord = urlencode($_REQUEST["addr"]);

echo $keyWord;

$key = "973fa2a6a19a7fb22ddcdd337eb12850";
$gUrl = "http://openapi.map.naver.com/api/geocode?key=".$key."&encoding=utf-8&coord=latlng&output=json&query=".$keyWord;



$curl_opt = array(
	CURLOPT_URL => $gUrl,
	CURLOPT_HEADER => 0,
	CURLOPT_FRESH_CONNECT => 1,
	CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_SSL_VERIFYPEER => 0
);

$resUrl = curl_init();
curl_setopt_array( $resUrl, $curl_opt);

try {
	$res = curl_exec($resUrl);
} catch(exception $e) {
	print_r($e);
}

curl_close($resUrl);

$res = file_get_contents($gUrl);

$row = json_decode($res, true);

//echo "<pre>";
//print_r($row);

if( isset($row["result"]["items"][0]["point"]) ) {
	echo $row["result"]["items"][0]["point"]["x"]."|".$row["result"]["items"][0]["point"]["y"];
} else {
	echo "127.0396037|37.5010226";
}

//echo $res;

?>
