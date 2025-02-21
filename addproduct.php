<?php
session_start();
$color = "navbar-light orange darken-4";
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="SHORTCUT ICON" href="images/fibble.png" type="image/x-icon" />
    <link rel="ICON" href="images/logo.png" type="image/ico" />
    <title>Add Medicine</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mdb.min.css" rel="stylesheet">
    <link href="css/style.css?<?php echo time(); ?>" rel="stylesheet">
  </head>

  <?php
    if ($_SESSION['role'] == 0) {
  ?>
    <body class="violetgradient">
      <?php include 'navbar.php'; ?>
      <center>
        <div class="customalert">
          <div class="alertcontent">
            <div id="alertText"> &nbsp </div>
            <img id="qrious">
            <div id="bottomText" style="margin-top: 10px; margin-bottom: 15px;"> &nbsp </div>
            <button class="formbtn" onclick="downloadImage()"> Download QR <i class="fa fa-download"
                aria-hidden="true"></i></button>
            <button id="closebutton" class="formbtn"> Done </button>
          </div>
        </div>
      </center>

      <div class="bgrolesadd">
        <center>
          <div class="mycardstyle">
            <div class="greyarea">
              <form id="form1" autocomplete="off">
                <div class="formitem">
                  <label type="text" class="formlabel"> Product Name </label>
                  <input type="text" class="forminput" id="prodname" required>
                  <input type="hidden" class="forminput" id="user" value=<?php echo $_SESSION['username']; ?> required>
                </div>
                <button class="formbtn" id="mansub" type="submit">Register Item</button>
              </form>
            </div>
          </div>
          <div class="iframecontainer">
            <iframe src="https://cdscoonline.gov.in/CDSCO/soam/drug_data.jsp" frameborder="0"
              class="iframecontent"></iframe>
          </div>
        </center>
        <?php
          } else {
            include 'redirection.php';
            redirect('index.php');
          }
        ?>
      <div class='box'>
        <div class='wave -one'></div>
        <div class='wave -two'></div>
        <div class='wave -three'></div>
      </div>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <!-- Material Design Bootstrap-->
      <script type="text/javascript" src="js/popper.min.js"></script>
      <script type="text/javascript" src="js/bootstrap.min.js"></script>
      <script type="text/javascript" src="js/mdb.min.js"></script>
      <script type="text/javascript" src="js/changetitle.js"></script>
      <!-- Web3.js -->
      <script src="web3.min.js"></script>
      <!-- QR Code Library-->
      <script src="./dist/qrious.js"></script>
      <!-- QR Code Reader -->
      <script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/qr_packed.js"></script>
      <script src="app.js"></script>
      <!-- Web3 Injection -->
      <script>


        ////// Initialize Web3 \\\\\\
        if (typeof web3 !== 'undefined') {
          web3 = new Web3(web3.currentProvider);
          web3 = new Web3(new Web3.providers.HttpProvider('HTTP://127.0.0.1:7545'));
        } else {
          web3 = new Web3(new Web3.providers.HttpProvider('HTTP://127.0.0.1:7545'));
        }

        ////// Set the Contract \\\\\\
        var contract = new web3.eth.Contract(contractAbi, contractAddress);
        $("#manufacturer").on("click", function () {
          $("#districard").hide("fast", "linear");
          $("#manufacturercard").show("fast", "linear");
        });

        $("#distributor").on("click", function () {
          $("#manufacturercard").hide("fast", "linear");
          $("#districard").show("fast", "linear");
        });

        $("#closebutton").on("click", function () {
          $(".customalert").hide("fast", "linear");
        });


        $('#form1').on('submit', function (event) {
          event.preventDefault();
          prodname = $('#prodname').val();
          username = $('#user').val();
          prodname = prodname + "<br>Registered By: " + username;
          console.log(prodname);
          var today = new Date();
          var thisdate = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();

          web3.eth.getAccounts().then(async function (accounts) {
            var receipt = await contract.methods.newItem(prodname, thisdate).send({ from: accounts[0], gas: 1000000 })
              .then(receipt => {
                var msg = "<h5 style='color: #53D769'><b>Item Added Successfully</b></h5><p>Product ID: " + receipt.events.Added.returnValues[0] + "</p>";
                qr.value = receipt.events.Added.returnValues[0];
                $bottom = "<p style='color: #FECB2E'> You may print the QR Code if required </p>"
                $("#alertText").html(msg);
                $("#qrious").show();
                $("#bottomText").html($bottom);
                $(".customalert").show("fast", "linear");
              });
          });
          $("#prodname").val('');
        });

        $('#form2').on('submit', function (event) {
          event.preventDefault();
          prodid = $('#prodid').val();
          prodlocation = $('#prodlocation').val();
          console.log(prodid);
          console.log(prodlocation);
          var today = new Date();
          var thisdate = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
          var info = "<br><br><b>Date: " + thisdate + "</b><br>Location: " + prodlocation;
          web3.eth.getAccounts().then(async function (accounts) {
            var receipt = await contract.methods.addState(prodid, info).send({ from: accounts[0], gas: 1000000 })
              .then(receipt => {
                var msg = "Item has been updated ";
                $("#alertText").html(msg);
                $("#qrious").hide();
                $("#bottomText").hide();
                $(".customalert").show("fast", "linear");
              });
          });
          $("#prodid").val('');
          $("#prodlocation").val('');
        });


        function isInputNumber(evt) {
          var ch = String.fromCharCode(evt.which);
          if (!(/[0-9]/.test(ch))) {
            evt.preventDefault();
          }
        }

        (function () {
          var qr = window.qr = new QRious({
            element: document.getElementById('qrious'),
            size: 200,
            value: '0'
          });
        })();

        ////// Function for downloading qr code \\\\\\
        function downloadImage() {
          var img = document.getElementById("qrious").src;
          var link = document.createElement('a');
          link.href = img;
          link.download = "medicine.jpg";
          document.body.appendChild(link);
          link.click();
          document.body.removeChild(link);
        }

        function showAlert(message) {
          $("#alertText").html(message);
          $("#qrious").hide();
          $("#bottomText").hide();
          $(".customalert").show("fast", "linear");
        }

        $("#aboutbtn").on("click", function () {
          showAlert("A Decentralised End to End Logistics Application that stores the whereabouts of product at every freight hub to the Blockchain. At consumer end, customers can easily scan product's QR CODE and get complete information about the provenance of that product hence empowering	consumers to only purchase authentic and quality products.");
        });
        
      </script>
  </body>

</html>