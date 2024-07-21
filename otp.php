<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="SHORTCUT ICON" href="images/fibble.png" type="image/x-icon" />
    <link rel="ICON" href="images/logo.png" type="image/ico" />
    <title>OTP Login</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mdb.min.css" rel="stylesheet">

    <link href="css/style.css?<?php echo time(); ?>" rel="stylesheet">

  </head>

  <body class="violetgradient">

    <div style="width: 100%">
      <center>
        <div class="loginformcard" style="margin-top: 50px; margin-bottom: 30px;">
          <h4> OTP Verification</h4>
          <form style="margin-top: 30px; margin-bottom: 30px;" method="post" action="">
            <label class="formlabel" for="otp">Check your email for otp</label>
            <input class="forminput" type="text" name="otp" id="otp" required><br>
            <input class="formbtn" type="submit" name="submit" value="Validate OTP">
          </form>
        </div>
      </center>
    </div>

    <?php
      ////// Function to check if entered OTP is valid \\\\\
      function isOTPValid($email, $enteredOTP)
      {
        $conn = mysqli_connect("localhost", "root", "", "supplychain");
        $query = "SELECT otp FROM authemailotp WHERE email='$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          $savedOTP = $row['otp'];
          if ($enteredOTP === $savedOTP) {
            return true;
          }
        }
        return false;
      }

      if (isset($_POST['submit'])) {
        $enteredOTP = $_POST['otp'];
        $email = $_GET['var'];

        if (isOTPValid($email, $enteredOTP)) {
          header("Location: sampleindex.php");
        } else {
          header("Location: uiderror.html");
        }
      }
    ?>
    <script type="text/javascript" src="js/changetitle.js"></script>
  </body>

</html>