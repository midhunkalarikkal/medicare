<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Check Medicine</title>
    <link rel="SHORTCUT ICON" href="images/fibble.png" type="image/x-icon" />
    <link rel="ICON" href="images/logo.png" type="image/ico" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mdbmin.css" rel="stylesheet">
    <link href="css/mdb.min.css?<?php echo time(); ?>" rel="stylesheet">
    <link href="css/style.css?<?php echo time(); ?>" rel="stylesheet">

  </head>
  <?php
    if (isset($_SESSION['role'])) {
  ?>

    <body class="violetgradient">
      <?php
        include "navbar.php"
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
      <div>
        <center>
          <div class="centered">
            <div class="row" id="camdiv">
              <div class="col">
                <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
                <div class="col-sm-12">
                  <video id="preview" class="p-1 border" style="width: 20%; height: 20%;"></video>
                </div>
                <div class="cambtn" data-toggle="buttons">
                  <button id="frontcam" name="options" value="1" autocomplete="off" checked><i class="fa fa-camera"
                      aria-hidden="true"></i> Front camera</button>
                  <button id="backcam" name="options" value="2" autocomplete="off"><i class="fa fa-undo"
                      aria-hidden="true"></i> Back camera</button>
                </div>
              </div>
            </div>

            <form role="form" autocomplete="off">
              <input type="text" id="searchText" class="searchBox" placeholder="Enter Product Code"
                onkeypress="isInputNumber(event)" required>
              <label class=qrcode-text-btn style="width:4%;display:none;">
                <input type=file accept="image/*" id="selectedFile" style="display:none" capture=environment
                  onchange="openfile(this);" tabindex=-1>
              </label>
              <button type="submit" id="searchButton" class="searchBtn"><i class="fa fa-search"></i></button>
            </form>
            <button class="uploadbtn" onclick="document.getElementById('selectedFile').click(),hideDiv();">
              <i class="fa fa-upload" aria-hidden="true"></i> Upload QR
            </button>
            <button class="qrbutton" onclick="showDiv(),opcam();">
              <i class='fa fa-qrcode'></i> Scan QR
            </button>
            <br><br>
            <p id="database" class="cardstyle">No Data to Display</p>
          </div>
        </center>
      </div>

      <div class='box'>
        <div class='wave -one'></div>
        <div class='wave -two'></div>
        <div class='wave -three'></div>
      </div>

    <?php 
      } else {
        include 'redirection.php';
        redirect("index.php");
      } 
    ?>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/mdb.min.js"></script>
    <script type="text/javascript" src="js/changetitle.js"></script>
    <script src="web3.min.js"></script>
    <script src="app.js"></script>

    <!-- QR Code Reader -->
    <script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/qr_packed.js"></script>

    <!-- Web3 Injection -->
    <script>
      web3 = new Web3(new Web3.providers.HttpProvider('HTTP://127.0.0.1:7545'));
      ////// Set the Contract \\\\\\
      var contract = new web3.eth.Contract(contractAbi, contractAddress);

      $(".cardstyle").hide();
      $('form').on('submit', function (event) {
        event.preventDefault();
        greeting = $('input').val();
        console.log(greeting)

        contract.methods.searchProduct(greeting).call(function (err, result) {
          console.log(err, result)
          $(".cardstyle").show("fast", "linear");
          $("#database").html(result);
        });
      });


      function isInputNumber(evt) {
        var ch = String.fromCharCode(evt.which);
        if (!(/[0-9]/.test(ch))) {
          evt.preventDefault();
        }
      }

      $("#closebutton").on("click", function () {
        $(".customalert").hide("fast", "linear");
      });

      ////// Code for uploading qr code \\\\\\
      function openfile(node) {
        var reader = new FileReader();
        reader.onload = function () {
          node.value = "";
          qrcode.callback = function (res) {
            if (res instanceof Error) {
              alert("No QR code found. Please make sure the QR code is within the camera's frame and try again.");
            } else {
              node.parentNode.previousElementSibling.value = res;
              document.getElementById('searchButton').click();
            }
          };
          qrcode.decode(reader.result);
        };
        reader.readAsDataURL(node.files[0]);
      }

      ////// Code for scanning qr code using camera \\\\\\
      function opcam() {
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', 'UA-131906273-1');

        var scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5, mirror: false });
        scanner.addListener('scan', function (content) {
          document.getElementById("searchText").value = content;
          hideDiv();
        });
        Instascan.Camera.getCameras().then(function (cameras) {
          if (cameras.length > 0) {
            scanner.start(cameras[0]);
            $('[name="options"]').on('change', function () {
              if ($(this).val() == 1) {
                if (cameras[0] != "") {
                  scanner.start(cameras[0]);
                } else {
                  alert('No Front camera found!');
                }
              } else if ($(this).val() == 2) {
                if (cameras[1] != "") {
                  scanner.start(cameras[1]);
                } else {
                  alert('No Back camera found!');
                }
              }
            });
          } else {
            console.error('No cameras found.');
            alert('No cameras found.');
          }
        }).catch(function (e) {
          console.error(e);
          alert(e);
        });

        (adsbygoogle = window.adsbygoogle || []).push({});
      }

      function hideDiv() {
        var div = document.getElementById("camdiv");
        div.style.display = "none";
      }

      function showDiv() {
        var div = document.getElementById("camdiv");
        div.style.display = "block";
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