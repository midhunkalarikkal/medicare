<?php 
session_start(); 
$color="navbar-dark cyan darken-3";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="SHORTCUT ICON" href="images/fibble.png" type="image/x-icon" />
    <link rel="ICON" href="images/logo.png" type="image/ico" />

    <title>Scan Medicine</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="css/bootstrap.min.css?<?php echo time(); ?>" rel="stylesheet">
    <link href="css/mdb.min.css" rel="stylesheet">

    <link href="css/style.css?<?php echo time(); ?>" rel="stylesheet">

    <style>
      #timestamp{
        margin-top: 20px;
      }
      .forminputtime{
    width: 40%;
    border: 1px solid;
    border-color: #EAEAEA;
    height: 30px;
    padding: 8px;
    border-radius: 5px 5px 5px 5px;
    font-family: Helvetica, sans-serif;
    }
    .forminputtime:hover{
        background-color: #FCFCFC;
        border-color:#5FC9F8;
        transition: background-color 0.5s ease;
        transition: border-color 0.5s ease;
    }
    .forminputtime:focus{
        background-color: #FCFCFC;
        border-color:#147EFB;
        transition: background-color 0.5s ease;
    }
    </style>

  </head>
  <?php
    if( $_SESSION['role']==0 || $_SESSION['role']==1  ){
  ?>
  <body class="violetgradient">
    <?php include 'navbar.php'; ?>
    <center>
        <div class="customalert">
            <div class="alertcontent">
                <div id="alertText"> &nbsp </div>
                <img id="qrious">
                <div id="bottomText" style="margin-top: 10px; margin-bottom: 15px;"> &nbsp </div>
                <button id="closebutton" class="formbtn"> Done </button>
            </div>
        </div>
    </center>

      <div></div>
      <div class="bgroles">
      <center>
        <!--Code for camera-->
      <div class="centered">
        <div class="row" id="camdiv">
        <div class="col">
          <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
          <div class="col-sm-12">
            <video id="preview" class="p-1 border" style="width: 20%; height: 20%; margin-top:180px;"></video>
          </div>
          <div class="cambtn" data-toggle="buttons">
            <button id="frontcam"  name="options" value="1" autocomplete="off" checked><i class="fa fa-camera" aria-hidden="true"></i> Front camera</button>
            <button id="backcam" name="options" value="2" autocomplete="off"><i class="fa fa-undo" aria-hidden="true"></i> Back camera</button>
          </div>
        </div>
      </div>
        <div class="mycardstyle" style="margin-top:0px;">
            <div class="greyarea">
                <form id="form2" autocomplete="off">
                    <div class="formitem">
                        <label type="text" class="formlabel"> Received Product ID </label>
                        <input type="text" class="forminput" id="prodid" onkeypress="isInputNumber(event)" required>
                        <label class=qrcode-text-btn style="width:4%;display:none;">
                            <input type=file accept="image/*" id="selectedFile" style="display:none" capture=environment onchange="openQRCamera(this);" tabindex=-1>
                        </label>
                        <br>
                        <button class="qrbutton2" onclick="document.getElementById('selectedFile').click();" style="margin-bottom: 5px;margin-top: 5px;">
                        <i class="fa fa-upload" aria-hidden="true"></i> Upload QR
                        </button>
                        <button class="qrbutton2" onclick="showDiv(),opcam();" style="margin-bottom: 5px;margin-top: 5px;">
                        <i class='fa fa-qrcode'></i> Scan QR
                        </button>
                    </div>
                    <div class="formitem">
                        <label type="text" class="formlabel"> Freight Hub Location </label>
                        <input type="text" class="forminput" id="prodlocation" required>


                       <!--editing start-->

                      <label type="text" class="formlabel" id="timestamp"> Timestamp </label>
                      <div style="display: flex; justify-content:center;">
                        <input type="text" class="forminputtime" id="timedate">
                        <input type="text" class="forminputtime" id="timeday">
                      </div>
                        <!--editing end-->
                    </div>
                    <button class="formbtn" id="mansub" type="submit">Update</button>
                </form>
            </div>
      </center>
  </div>
    <?php
    }else{
        include 'redirection.php';
        redirect('index.php');
    }
    ?>

    <div class='box'>
      <div class='wave -one'></div>
      <div class='wave -two'></div>
      <div class='wave -three'></div>
    </div>

    
     
    
    <!-- JQuery -->
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
      // Initialize Web3
      if (typeof web3 !== 'undefined') {
        web3 = new Web3(web3.currentProvider);
        web3 = new Web3(new Web3.providers.HttpProvider('HTTP://127.0.0.1:7545'));
      } else {
        web3 = new Web3(new Web3.providers.HttpProvider('HTTP://127.0.0.1:7545'));
      }

      // Set the Contract
    var contract = new web3.eth.Contract(contractAbi, contractAddress);

    $("#manufacturer").on("click", function(){
        $("#districard").hide("fast","linear");
        $("#manufacturercard").show("fast","linear");
    });

    $("#distributor").on("click", function(){
        $("#manufacturercard").hide("fast","linear");
        $("#districard").show("fast","linear");
    });

    $("#closebutton").on("click", function(){
        $(".customalert").hide("fast","linear");
    });


    $('#form1').on('submit', function(event) {
        event.preventDefault(); // to prevent page reload when form is submitted
        prodname = $('#prodname').val();
        console.log(prodname);
        var today = new Date();
        var thisdate = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();

        web3.eth.getAccounts().then(async function(accounts) {
          var receipt = await contract.methods.newItem(prodname, thisdate).send({ from: accounts[0], gas: 1000000 })
          .then(receipt => {
              var msg="<h5 style='color: #53D769'><b>Item Added Successfully</b></h5><p>Product ID: "+receipt.events.Added.returnValues[0]+"</p>";
              qr.value = receipt.events.Added.returnValues[0];
              $bottom="<p style='color: #FECB2E'> You may print the QR Code if required </p>"
              $("#alertText").html(msg);
              $("#qrious").show();
              $("#bottomText").html($bottom);
              $(".customalert").show("fast","linear");
          });
          //console.log(receipt);
        });
        $("#prodname").val('');
        
    });


    // Code for detecting location
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    }
    function showPosition(position) {
            var autoLocation = position.coords.latitude +", " + position.coords.longitude;
            const latitude = position.coords. latitude;
            const longitude = position.coords.longitude;
            const geoApiUrl = `https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=${latitude}&longitude=${longitude}&localityLanguage=en`
            fetch(geoApiUrl)
            .then(res => res.json())
            .then(data => {
              console.log(data.city)
              var city = data.city;
              var state = data.principalSubdivision;
              $("#prodlocation").val(state +" , "+city+" , "+autoLocation); 
            })   
    }
    

    $('#form2').on('submit', function(event) {
        event.preventDefault(); // to prevent page reload when form is submitted
        prodid = $('#prodid').val();
        prodlocation = $('#prodlocation').val();
        console.log(prodid);
        console.log(prodlocation);
        var today = new Date();
        var thisdate = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
        var info = "<br><br><b>Date: "+thisdate+"</b><br>Location: "+prodlocation +" <br>Day: "+ todayname +" , Time: "+currenttime;
        web3.eth.getAccounts().then(async function(accounts) {
          var receipt = await contract.methods.addState(prodid, info).send({ from: accounts[0], gas: 1000000 })
          .then(receipt => {
              var msg="Item has been updated ";
              $("#alertText").html(msg);
              $("#qrious").hide();
              $("#bottomText").hide();
              $(".customalert").show("fast","linear");
          });
        });
        $("#prodid").val('');
      });


    function isInputNumber(evt){
      var ch = String.fromCharCode(evt.which);
      if(!(/[0-9]/.test(ch))){
          evt.preventDefault();
      }
    }


    //code for open file explorer
    function openQRCamera(node) {
		var reader = new FileReader();
		reader.onload = function() {
			node.value = "";
			qrcode.callback = function(res) {
			if(res instanceof Error) {
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

  //Code for scanning qr code using camera
  function opcam(){
      window.dataLayer = window.dataLayer || [];
	    function gtag(){dataLayer.push(arguments);}
	    gtag('js', new Date());
	    gtag('config', 'UA-131906273-1'); 

      var scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5, mirror: false });
			scanner.addListener('scan',function(content){
        document.getElementById("prodid").value = content;
        hideDiv();
					//window.location.href=content;
			});
					Instascan.Camera.getCameras().then(function (cameras){
						if(cameras.length>0){
							scanner.start(cameras[0]);
							$('[name="options"]').on('change',function(){
								if($(this).val()==1){
									if(cameras[0]!=""){
										scanner.start(cameras[0]);
									}else{
										alert('No Front camera found!');
									}
								}else if($(this).val()==2){
									if(cameras[1]!=""){
										scanner.start(cameras[1]);
									}else{
										alert('No Back camera found!');
									}
								}
							});
						}else{
							console.error('No cameras found.');
							alert('No cameras found.');
						}
					}).catch(function(e){
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

  function showAlert(message){
      $("#alertText").html(message);
      $("#qrious").hide();
      $("#bottomText").hide();
      $(".customalert").show("fast","linear");
    }

    $("#aboutbtn").on("click", function(){
        showAlert("A Decentralised End to End Logistics Application that stores the whereabouts of product at every freight hub to the Blockchain. At consumer end, customers can easily scan product's QR CODE and get complete information about the provenance of that product hence empowering	consumers to only purchase authentic and quality products.");
    });

    //Editing start


  

    function showtime(){
      setTimeout(function(){
      var date = new Date();
      var amorpm = date.getHours() < 12 ? "am" : "pm";
      var datestring = putZero(date.getHours()%12)+":"+putZero(date.getMinutes())+":"+putZero(date.getSeconds())+" "+amorpm;  
      document.getElementById("timedate").value = "Time: "+datestring;
      showtime();
      },1000);
    }
    showtime();

            function putZero(nm){
                return nm < 10 ? "0"+nm:nm;
            }
            var date = new Date();
            var todayname;
            const da = date.getDay();
            switch(da){
              case 0:
                todayname = "Sunday"
                  break;
              case 1:
                todayname = "Monday";
                  break;
              case 2:
                todayname ="Tuesday";
                  break;
              case 3:
                todayname = "Wednesday";
                  break;
              case 4:
                todayname = "Thursday";
                  break;
              case 5:
                todayname = "Friday";
                  break;
              case 6:
                todayname = "Saturday";
                  break;
            }
            document.getElementById("timeday").value = "Day: "+todayname;

            var currenttime;
            function getCurrentTime() {
              var currentTime = new Date();
              var hours = currentTime.getHours();
              var minutes = currentTime.getMinutes();
              var seconds = currentTime.getSeconds();
              
              var formattedTime = hours + ":" + minutes + ":" + seconds;
              currenttime = formattedTime;
              
              // Do something with the current time
            }
            getCurrentTime();
            console.log(currenttime);
    //Editing end

    
    
    </script>
  </body>
</html>
