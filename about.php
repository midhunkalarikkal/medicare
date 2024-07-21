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
    <title>About & Contact</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mdb.min.css" rel="stylesheet">

    <link href="css/about.css?<?php echo time(); ?>" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  </head>
  <body class="violetgradient">
  <?php
    include "navbar.php"
    ?>
    <div style="width: 100%">
      <center>

      <div class="description">
        <p><strong style="font-size: 25px;">Medicare</strong> is a Decentralized E2E Application that stores the whereabouts of MEDICINE at every freight hub on the Blockchain. At consumer end, customers can simply scan the QR CODE of products and get complete information about the provenance of that product hence empowering consumers to only purchase authentic and quality products.</p>
      </div>
      <!--Editing start-->
      <div class="loginformcard" id="maincard4">
            <h4> Contact us</h4>
            <form id="submit-form" style="margin-top: 30px; margin-bottom: 30px;" action="https://script.google.com/macros/s/AKfycbzvlTTwVkoiM-lEPPilLJetRidtdrZhSyXbUjlyaUtmgRKFQg9LORfPYeMKq2Y7S3oC6A/exec" 
            method="POST">

            <label type="text" class="formlabel"> Name</label>
            <input type="text" class="forminput" name="name" id="value">

            <label type="text" class="formlabel"> Email</label>
            <input type="email" class="forminput" name="email" id="value">

            <label type="text" class="formlabel"> Message</label>
            <textarea name="message" class="forminput" cols="30" rows="10"></textarea>

            <button class="formbtn" value="Submit" type="submit">Send response</button>
      </div>
      <!--Editing end-->
      </center>
    </div>
    <script>
        $("#submit-form").submit((e)=>{
            e.preventDefault()
            $.ajax({
                url:"",
                data:$("#submit-form").serialize(),
                method:"post",
                success:function (response){
                    alert("Form submitted successfully")
                    window.location.reload()
                    //window.location.href="https://google.com"
                },
                error:function (err){
                    alert("Something Error")
    
                }
            })
        })
    </script>
    <script type="text/javascript" src="js/changetitle.js"></script>
  </body>
</html>
