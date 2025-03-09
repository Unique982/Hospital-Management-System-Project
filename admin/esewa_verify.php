<!-- esewa_verify.php -->
<?php
if (isset($_GET['transaction_uuid'])) {
    $transaction_uuid = $_GET['transaction_uuid'];
    echo $transaction_uuid ;
    $amount = 100;
    $esewa_url = "https://rc-epay.esewa.com.np/api/epay/transaction";

    $data = [
        'transaction_uuid' => $transaction_uuid,
        'amount' => $amount,
        'product_code' => 'EPAYTEST'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $esewa_url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    echo "<h2>Payment Verification Response:</h2>";
    echo "<pre>$response
     echo $transaction_uuid;
    </pre>";
} else {
    echo "<h2>Invalid Request</h2>";
}
?>
