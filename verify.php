<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<?php

require('config.php');

session_start();

require('razorpay-php/razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false) {
    $api = new Api($keyId, $keySecret);

    try {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    } catch (SignatureVerificationError $e) {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true) {
   
    $url = 'http://localhost:7071/api/Transaction/Add';
    $data = array('pid' => $_SESSION['razorpay_order_id'], 'txnId' => $_POST['razorpay_payment_id'], 'currency' => 'INR');
    //$token ='eyJhbGciOiJodHRwOi8vd3d3LnczLm9yZy8yMDAxLzA0L3htbGRzaWctbW9yZSNobWFjLXNoYTI1NiIsInR5cCI6IkpXVCJ9.eyJlbWFpbGFkZHJlc3MiOiJhZG1pbkB1bndhc3RlbmV0d29yay5pbiIsInJvbGUiOiJBZG1pbiIsImV4cCI6MTY4Mjc2OTYwNCwiaXNzIjoiYXBpLm15YWRtaW4uY29tIiwiYXVkIjoiYXBpLm15YWRtaW4uY29tIn0.EwuVJzCPWacnPPkVUm4GjVnFQBPMrw-w3OrX05OG8Gg';
    // use key 'http' even if you send the request to https://...
    $options = array(
        'http' => array(
            'header' => "Content-type: application/x-www-form-urlencoded\r\n","Authorization", "Bearer eyJhbGciOiJodHRwOi8vd3d3LnczLm9yZy8yMDAxLzA0L3htbGRzaWctbW9yZSNobWFjLXNoYTI1NiIsInR5cCI6IkpXVCJ9.eyJlbWFpbGFkZHJlc3MiOiJhZG1pbkB1bndhc3RlbmV0d29yay5pbiIsInJvbGUiOiJBZG1pbiIsImV4cCI6MTY4Mjc2OTYwNCwiaXNzIjoiYXBpLm15YWRtaW4uY29tIiwiYXVkIjoiYXBpLm15YWRtaW4uY29tIn0.EwuVJzCPWacnPPkVUm4GjVnFQBPMrw-w3OrX05OG8Gg",
            'method' => 'POST', 
            'content' => http_build_query($data)
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) { /* Handle error */
    }

    var_dump($result);

    $html = "<p>Your payment was successful</p>
             <p>Payment ID: {$_POST['razorpay_payment_id']}</p>
             <p>Order ID:{$_SESSION['razorpay_order_id']}</p>";
} else {
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
}

echo $html;
?>
