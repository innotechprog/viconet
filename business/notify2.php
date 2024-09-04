<?php
session_start();
include "include/connect.php";
include "include/functions.php";
//Tell PayFast that this page is reachable by triggering a header 200
header( 'HTTP/1.0 200 OK' );
flush();

define( 'SANDBOX_MODE', false );
$pfHost = SANDBOX_MODE ? 'sandbox.payfast.co.za' : 'www.payfast.co.za';
// Posted variables from ITN
$pfData = $_POST;
$pfParamString ="";
// Strip any slashes in data
foreach( $pfData as $key => $val ) {
    $pfData[$key] = stripslashes( $val );
}

// Convert posted variables to a string
foreach( $pfData as $key => $val ) {
    if( $key !== 'signature' ) {
        $pfParamString .= $key .'='. urlencode( $val ) .'&';
    } else {
        break;
    }
}
$pfParamString = substr( $pfParamString, 0, -1 );

function pfValidSignature( $pfData, $pfParamString, $pfPassphrase = null ) {
    // Calculate security signature
    if($pfPassphrase === null) {
        $tempParamString = $pfParamString;
    } else {
        $tempParamString = $pfParamString.'&passphrase='.urlencode( $pfPassphrase );
    }

    $signature = md5( $tempParamString );
    return ( $pfData['signature'] === $signature );
} 

function pfValidIP() {
    // Variable initialization
    $validHosts = array(
        'www.payfast.co.za',
        'www.payfast.co.za',
        'w1w.payfast.co.za',
        'w2w.payfast.co.za',
        );

    $validIps = [];

    foreach( $validHosts as $pfHostname ) {
        $ips = gethostbynamel( $pfHostname );

        if( $ips !== false )
            $validIps = array_merge( $validIps, $ips );
    }

    // Remove duplicates
    $validIps = array_unique( $validIps );
    $referrerIp = gethostbyname(parse_url($_SERVER['HTTP_REFERER'])['host']);
    if( in_array( $referrerIp, $validIps, true ) ) {
        return true;
    }
    return false;
}
$email = $pfData['email_address'];
$_SESSION['corpid'] = md5($email);
include 'include/corp_auth.php';
$encrEmail = md5($email);
$cartTotal = $corp->getTotPrice2();

function pfValidPaymentData( $cartTotal, $pfData ) {
    return !(abs((float)$cartTotal - (float)$pfData['amount_gross']) > 0.01);
}
function pfValidServerConfirmation( $pfParamString, $pfHost = 'www.payfast.co.za', $pfProxy = null ) {
    // Use cURL (if available)
    if( in_array( 'curl', get_loaded_extensions(), true ) ) {
        // Variable initialization
        $url = 'https://'. $pfHost .'/eng/query/validate';

        // Create default cURL object
        $ch = curl_init();
    
        // Set cURL options - Use curl_setopt for greater PHP compatibility
        // Base settings
        curl_setopt( $ch, CURLOPT_USERAGENT, NULL );  // Set user agent
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );      // Return output as string rather than outputting it
        curl_setopt( $ch, CURLOPT_HEADER, false );             // Don't include header in output
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 2 );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, true );
        
        // Standard settings
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_POST, true );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $pfParamString );
        if( !empty( $pfProxy ) )
            curl_setopt( $ch, CURLOPT_PROXY, $pfProxy );
    
        // Execute cURL
        $response = curl_exec( $ch );
        curl_close( $ch );
        if ($response === 'VALID') {
            return true;
        }
    }
    return false;
}

//$myfile = fopen("notify.txt",'w') or die();

$check1 = pfValidSignature($pfData, $pfParamString);
$check2 = pfValidIP();
$check3 = pfValidPaymentData($cartTotal, $pfData);
$check4 = pfValidServerConfirmation($pfParamString, $pfHost);

if($check1 && $check2 && $check3 && $check4) {
    // All checks have passed, the payment is successful
} else {
    // Some checks have failed, check payment manually and log for investigation
} 

    $status = "paid";
    $pack_id = $pfData['item_name'];
    //$item_desc =$pfData['item_description'];
    $email_address = $pfData['email_address'];
    $name = $pfData['name_first'];
    $surname = $pfData['name_last'];
    $date = date('d-m-Y');
    $numUsers = $pfData['custom_str2'];
    $initialUsers = $corp->countUsersPerComp();
    $numUsers = $initialUsers + $numUsers;
    $inv_id = $pfData['m_payment_id'];
    $corp->compPackage($pack_id);
    $item_desc = $corp->getPackDesc();
    $corp->updateNumUsers($email_address,$numUsers);
   
    include "send_invoice2.php";
/*
$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");

$txt = $pfParamString."\n".$pack_id."\n".$email_address;
fwrite($myfile, $txt);
fclose($myfile);*/
    ?>

   