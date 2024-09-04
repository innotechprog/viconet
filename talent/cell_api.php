<?php
$headers = [
"User-agent:Example REST APIClient",
"Authorization:token i0PTgksg4agQpVWWIbaQz6ucHq84cotk"
];
$check = "";
$ch = curl_init();
if(isset($_POST['cell']))
{
$number = $_POST['cell'];
}
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL,"https://api.numlookupapi.com/v1/validate/".$number."?apikey=num_live_mXTUeXhR4L1PMGJjidHdKGz3diSaPeQjwyvfi1CZ");
//$company = array();
$data =curl_exec($ch);
curl_close($ch);
$res = json_decode($data,true);
foreach ($res as $key => $value) {
	//echo $key.'='.$value."<br>";
	if($key == 'valid'){
		if ($value == 1) {
			echo "valid";
		}
		else{
			echo "invalid";
		}
	}
}
/*
*/
?>
