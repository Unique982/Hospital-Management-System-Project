<?php 
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

// Twilio library समावेश गर्नुहोस्
require __DIR__ . '/../vendor/autoload.php'; 
use Twilio\Rest\Client;

if(isset($_POST['send'])){
    $number = "+977". trim( $_POST['number']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
   

$sid    = "AC0c5128d8dae85bebb80513c2a21408d3";  // Replace with your Account SID
$token  = "52fc9ddc03d05ae4c97dfbe35a6030c2";  // Replace with your Auth Token
$twilio = new Client($sid, $token);

try {
    $message = $twilio->messages->create(
        +14703975780, // Replace with your verified number
        [
            "from" => "+14703975780", // Your Twilio number
            "body" => "Hello from Twilio trial!"
        ]
    );

    echo "Message sent! SID: " . $message->sid;
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}


}
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="" method="POST">
                        <label for="number">Phone</label>
                        <input type="number" name="number" required>
                        <br>
                        <label for="message">Message</label>
                        <input type="text" name="message" required>
                        <br>
                        <input type="submit" name="send" value="Send Msg" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
