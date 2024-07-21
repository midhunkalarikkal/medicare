<?php
////// Function to generate OTP \\\\\\
function generateOTP()
{
    $digits = 6;
    $otp = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
    return $otp;
}

function isEmailExists($email)
{
    $conn = mysqli_connect("localhost", "root", "", "supplychain");
    $query = "SELECT * FROM authemail WHERE email='$email'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

require './PHPMailer-master/src/PHPMailer.php';
require './PHPMailer-master/src/SMTP.php';
require './PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

////// function to send otp \\\\\\
function sendOTP($email, $otp)
{

    $mail = new PHPMailer(true);

    try {
        ////// Server settings \\\\\\
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'blckchainmedicine@gmail.com';
        $mail->Password = 'shggbhblxfkmvbbo';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        ////// Sender, recipient details and content \\\\\\
        $mail->setFrom('blckchainmedicine@gmail.com', 'MEDICARE');
        $mail->addAddress($email, 'User');
        $mail->isHTML(true);
        $mail->Subject = 'OTP';
        $mail->Body = 'This is your otp ' . $otp . "<br> <br> MEDICARE is a Decentralized E2E Application that stores the whereabouts of MEDICINE at every freight hub on the Blockchain. At consumer end, customers can simply scan the QR CODE of products and get complete information about the provenance of that product hence empowering consumers to only purchase authentic and quality products.";

        $mail->send();
        echo 'Email sent successfully!';
    } catch (Exception $e) {
        echo 'Error: ' . $mail->ErrorInfo;
    }

}

////// Function to save OTP to the database \\\\\\
function saveOTP($email, $otp)
{
    $conn = mysqli_connect("localhost", "root", "", "supplychain");
    $query = "INSERT INTO authemailotp (email, otp) VALUES ('$email', '$otp')";
    mysqli_query($conn, $query);
}

function saveEmailAndOTPToSession($email)
{
    $_SESSION['temp_email'] = $email;
}

////// Function to delete email and otp after one minute from database \\\\\\
function deleteExpiredEntries()
{
    $conn = mysqli_connect("localhost", "root", "", "supplychain");
    $query = "DELETE FROM authemailotp WHERE created_at < NOW() - INTERVAL 1 MINUTE";
    mysqli_query($conn, $query);
}

////// Check if form is submitted \\\\\\
if (isset($_POST['submit'])) {
    $email = $_POST['email'];

    if (isEmailExists($email)) {
        $otp = generateOTP();
        saveOTP($email, $otp);
        // Save the email and OTP to the session
        saveEmailAndOTPToSession($email);
        // Send the OTP to the entered email
        sendOTP($email, $otp);

        $variable = $_SESSION['temp_email'];
        $url = "otp.php?var=" . urlencode($variable);
        header("Location: " . $url);
    } else {
        echo "Email does not exist in the database.";
    }
}

////// Delete expired email and OTP entries \\\\\\
deleteExpiredEntries();
?>