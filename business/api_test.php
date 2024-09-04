<?php
$headers = [
"User-agent:Example REST APIClient",
"Authorization:token i0PTgksg4agQpVWWIbaQz6ucHq84cotk"
];
$ch = curl_init();
$company ="absa";
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL,"https://b2bhint.com/api/company?token=i0PTgksg4agQpVWWIbaQz6ucHq84cotk&filter=".$company);
$company = array();
$data =curl_exec($ch);
curl_close($ch);
$res = json_decode($data,true);

if(strlen($res['companies'][0]['name']) > 0)
{
	return true;
}
else{
	return false;
}

if(
	empty($_POST['username']) || empty($_POST['password']) || empty($_POST['variable']) empty()
){

}


?>
