<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="SHORTCUT ICON" href="images/fibble.png" type="image/x-icon" />
  <link rel="ICON" href="images/logo.png" type="image/ico" />

  <title>Sign in / Sign up</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/mdb.min.css" rel="stylesheet">
  <link href="css/sampleindex.css?<?php echo time(); ?>" rel="stylesheet">
  <style>
    .bone {
      position: fixed;
      bottom: 30px;
      right: 30px;
      font-size: 18px;
      display: inline-block;
      padding: 10px 20px;
      background-color: #333;
      color: #fff;
      text-decoration: none;
      border-radius: 10px;
      box-shadow: 0 3px 6px rgba(0, 0, 0, 0.3);
      text-decoration: none;
      font-family: Arial, sans-serif;
    }

    .bone:hover {
      background-color: #555;
    }
  </style>

</head>

<body class="violetgradient">
  <?php
  if (!isset($_SESSION['role'])) {
    ?>
    <center>
      <div class="customalert">
        <div class="alertcontent">
          <div id="alertText"> &nbsp </div>
          <img id="qrious">
          <div id="bottomText" style="margin-top: 10px; margin-bottom: 15px;"> &nbsp </div>
          <button id="closebutton" class="formbtn"> OK </button>
        </div>
      </div>
    </center>
    <div style="width: 100%">
      <center>

        <div class="loginformcard" id="card1">
          <h3> Welcome to the supply shain WEB 3 - APP </h3>
          <p style="max-width: 80%;">
            <strong>MEDICARE</strong> is a Decentralized E2E Application that stores the whereabouts of MEDICINE at every
            freight hub on the Blockchain. At consumer end, customers can simply scan the QR CODE of products and get
            complete information about the provenance of that product hence empowering consumers to only purchase
            authentic and quality products.
          </p>
          <div class="cardbtnarea">
            <button class="col-md-5 rolebtn" id="login">Login</button>
            <button class="col-md-5 rolebtn" id="signup">Signup</button>
          </div>
        </div>

        <div class="loginformcard" id="maincard4">
          <h4> Id Verification </h4>
          <form style="margin-top: 30px; margin-bottom: 30px;" action="validation.php" method="POST"
            onsubmit="return checkSecondForm(this);">
            <label type="text" class="formlabel"> Enter your id </label>
            <input type="text" class="forminput" name="value" id="value" onkeypress="isNotChar(event)" required>
            <button class="formbtn" name="loginsubmit" id="loginsubmit" value="submitted!" type="submit">Validate</button>
            <br>
            <a href="#" id="uidtosignup"> Just a consumer </a>
          </form>
        </div>

        <div class="loginformcard" id="maincard3">
          <h4> Create your new account</h4>
          <form style="margin-top: 30px; margin-bottom: 30px;" action="registration.php" method="POST"
            onsubmit="return checkSecondForm(this);">

            <label type="text" class="formlabel"> Email </label>
            <input type="text" class="forminput" name="email" id="email" onkeypress="isNotChar(event)" required>

            <label type="text" class="formlabel" style="margin-top: 10px;"> Userame </label>
            <input type="text" class="forminput" name="username" id="username" onkeypress="blockSpaces(event)" required>

            <label type="text" class="formlabel" style="margin-top: 10px;"> Password </label>
            <input type="password" class="forminput" name="pw" id="pw" onkeypress="isNotChar(event)" required>

            <label type="text" class="formlabel" style="margin-top: 10px;"> Confirm Password </label>
            <input type="password" class="forminput" name-"cpw" id="cpw" onkeypress="isNotChar(event)" required>

            <label type="text" class="formlabel" style="margin-top: 10px;"> Select Your Role </label>
            <select class="formselect" id="dropdown1" name="role">
              <option value="0" selected>Manufacturer</option>
              <option value="1">Retailer</option>
              <option value="1">Distributor</option>
            </select>

            <button class="formbtn" name="loginsubmit" value="submitted!" type="submit">Register</button>

            <br>
            <a href="#" id="gotologin"> Already have an account? Login to your existing account </a>
          </form>
        </div>

        <div class="loginformcard" id="maincard5">
          <h4> Create your new account</h4>
          <form style="margin-top: 30px; margin-bottom: 30px;" action="registration.php" method="POST"
            onsubmit="return checkSecondForm(this);">

            <label type="text" class="formlabel"> Email </label>
            <input type="text" class="forminput" name="email" id="email" onkeypress="isNotChar(event)" required>

            <label type="text" class="formlabel" style="margin-top: 10px;"> Userame </label>
            <input type="text" class="forminput" name="username" id="username" onkeypress="blockSpaces(event)" required>

            <label type="text" class="formlabel" style="margin-top: 10px;"> Password </label>
            <input type="password" class="forminput" name="pw" id="pw" onkeypress="isNotChar(event)" required>

            <label type="text" class="formlabel" style="margin-top: 10px;"> Confirm Password </label>
            <input type="password" class="forminput" name-"cpw" id="cpw" onkeypress="isNotChar(event)" required>

            <label type="text" class="formlabel" style="margin-top: 10px;"> User role </label>
            <select class="formselect" id="dropdown1" name="role">
              <option value="2" selected>Consumer</option>
            </select>

            <button class="formbtn" name="loginsubmit" value="submitted!" type="submit">Register</button>

            <br>
            <a href="#" id="gotologinfromcustomer"> Already have an account? Login to your existing account </a>
          </form>
        </div>

        <div class="loginformcard" id="maincard2">
          <h4> Login to your existing account</h4>
          <form style="margin-top: 30px; margin-bottom: 30px;" action="login.php" method="POST"
            onsubmit="return checkFirstForm(this);">

            <label type="text" class="formlabel"> Email </label>
            <input type="text" class="forminput" name="email" id="email" onkeypress="isNotChar(event)" required>

            <label type="text" class="formlabel" style="margin-top: 10px;"> Password </label>
            <input type="password" class="forminput" name="pw" id="pw" onkeypress="isNotChar(event)" required>

            <button class="formbtn" name="loginsubmit" type="submit">Login</button>

            <br>
            <a href="#" id="gotosignup"> Don't have an account? Create a new account now</a>
          </form>
        </div>

      </center>
    </div>

    <div>
      <button class="bone" onclick="redirectToPHP()"><i class="fa-solid fa-house"></i> Back to home</button>
    </div>

    <?php
      } else {
        include 'redirection.php';
        redirect('checkproduct.php');
      }
    ?>

  <!-- JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <!-- Material Design Bootstrap-->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <script type="text/javascript" src="js/changetitle.js"></script>
  <script>

    function isInputNumber(evt) {
      var ch = String.fromCharCode(evt.which);
      if (!(/[0-9]/.test(ch))) {
        evt.preventDefault();
      }
    }
    function isNotChar(evt) {
      var ch = String.fromCharCode(evt.which);
      if (ch == "'") {
        evt.preventDefault();
      }
    }

    function blockSpaces(evt) {
      var ch = String.fromCharCode(evt.which);
      if (ch == "'" || ch == " ") {
        evt.preventDefault();
      }
    }

    function blockSpecialChar(e) {
      var k;
      document.all ? k = e.keyCode : k = e.which;
      return ((k >= 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 46 || k == 42 || k == 33 || k == 32 || (k >= 48 && k <= 57));
    }

    $("#login").on("click", function () {
      $("#card1").hide("fast", "linear");
      $("#maincard3").hide("fast", "linear");
      $("#maincard2").show("fast", "linear");
    });

    $("#gotologin").on("click", function () {
      $("#card1").hide("fast", "linear");
      $("#maincard3").hide("fast", "linear");
      $("#maincard2").show("fast", "linear");
    });

    $("#openlogin").on("click", function () {
      $("#card1").hide("fast", "linear");
      $("#maincard3").hide("fast", "linear");
      $("#maincard2").show("fast", "linear");
    });

    $("#signup").on("click", function () {
      $("#card1").hide("fast", "linear");
      $("#maincard2").hide("fast", "linear");
      $("#maincard3").hide("fast", "linear");
      $("#maincard4").show("fast", "linear");
    });

    $("#gotosignup").on("click", function () {
      $("#card1").hide("fast", "linear");
      $("#maincard2").hide("fast", "linear");
      $("#maincard4").show("fast", "linear");
    });

    $("#opensignup").on("click", function () {
      $("#card1").hide("fast", "linear");
      $("#maincard2").hide("fast", "linear");
      $("#maincard3").show("fast", "linear");
    });

    $("#closebutton").on("click", function () {
      $(".customalert").hide("fast", "linear");
    });

    $("#uidtosignup").on("click", function () {
      $("#card1").hide("fast", "linear");
      $("#maincard2").hide("fast", "linear");
      $("#maincard4").hide("fast", "linear");
      $("#maincard3").hide("fast", "linear");
      $("#maincard5").show("fast", "linear");
    });

    $("#gotologinfromcustomer").on("click", function () {
      $("#card1").hide("fast", "linear");
      $("#maincard5").hide("fast", "linear");
      $("#maincard2").show("fast", "linear");
    });

    function checkSecondForm(theform) {
      var email = theform.email.value;
      var pw = theform.pw.value;
      var cpw = theform.cpw.value;

      if (!validateEmail(email)) {
        showAlert("Invalid Email address");
        return false;
      }

      if (pw != cpw) {
        showAlert("Please check your password");
        return false;
      }
      return true;
    }

    function checkFirstForm(theform) {
      var email = theform.email.value;

      if (!validateEmail(email)) {
        showAlert("Invalid Email address");
        return false;
      }
      return true;
    }

    function showAlert(message) {
      $("#alertText").html(message);
      $("#qrious").hide();
      $("#bottomText").hide();
      $(".customalert").show("fast", "linear");
    }

    function validateEmail(email) {
      var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return re.test(email);
    }

    function redirectToPHP() {
      window.location.href = "index.php";
    }
  </script>
  
</body>

</html>