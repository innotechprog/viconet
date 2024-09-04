<?php
/**
 * @param array $data
 * @param null $passPhrase
 * @return string
 */
function generateSignature($data,$passPhrase = null) {
    // Create parameter string
    $pfOutput = '';
     foreach($data as $key => $val) {
        if($val !== '') {
            $pfOutput .= $key.'='.urlencode(trim($val)).'&';
        }
    }
    // Remove last ampersand
    $getString = substr($pfOutput,0,-1);
    if($passPhrase !== null) {
        $getString .= '&passphrase='.urlencode(trim($passPhrase));
    }
   $pfSignature = md5($getString);
    //$params['signature'] = $pfSignature;
    return $pfSignature;
}
$auth = md5($corp->getCompReg()).md5($pass);
// Construct variables
$cartTotal = $corp->getTotPrice2();// This amount needs to be sourced from your application
$data = array(
    // Merchant details
    'merchant_id' => '20772939',
    'merchant_key' => '0wcr2b201amv6',
    'return_url' => 'https://www.viconet.co.za/my-projects?auth='.$auth,
    'cancel_url' => 'https://www.viconet.co.za/view-basket?auth='.$auth,
    'notify_url' => 'https://www.viconet.co.za/notify',
    // Buyer details 
    'name_first' => $corp->getUserName(),
    'name_last'  => $corp->getUserSurname(),
    'email_address'=> $corp->getCompReg(),
    // Transaction details
    'm_payment_id' => $corp->generateInvoice(), //Unique payment ID to pass through to notify_url
    'amount' => number_format( sprintf( '%.2f', $cartTotal ), 2, '.', ''),
    'item_name' => $corp->getPackID(),
    'custom_str1' => $corp->createEndDate($corp->getPackDuration()),
    'custom_str2' => $numUsers,
    'custom_str3' => "none",
);

$signature = generateSignature($data);
//echo $signature;
$data['signature'] = $signature;

// If in testing mode make use of either sandbox.payfast.co.za or www.payfast.co.za
$testingMode = true;
$pfHost = $testingMode ? 'www.payfast.co.za' : 'www.payfast.co.za';
$htmlForm = '<form action="https://'.$pfHost.'/eng/process" method="post">';
foreach($data as $name=> $value)
{
    $htmlForm .= '<input name="'.$name.'" type="hidden" value=\''.$value.'\' />';
}
$htmlForm .= '<div class="form-group">
                    <div class="checkbox-input">
                        <input type="checkbox" required id="userTerms" name="userT_and_c" class="cust-checkbox" placeholder="">                         
                        <label class="checkbox-lbl">I accept <a href="legal documents/End User Payment Terms.pdf" target="blank">Payment Terms.</a></label> 
                        <div class="error-message"></div>           
                    </div>
                </div>
<input type="submit" class="bton btn2" style="width:100%;margin-top:20px" value="I agree - pay now" /></form>';

?>