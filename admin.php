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
    <title>Admin Medicare</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mdb.min.css" rel="stylesheet">

    <link href="css/about.css?<?php echo time(); ?>" rel="stylesheet">
    <style>
        body{
            overflow: auto;
        }
        .table-container {
        display: flex;
        }

        .table-container table {
        margin-right: 60px; 
        }
        .custom-table {
            margin-top: 100px;
            width: 50%;
            border-collapse: collapse;
            margin-left: 30px;
        }

        .custom-table th, .custom-table td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        .custom-table th {
            background-color: #f2f2f2;
            font-size: 18px;
            font-weight: bold;
        }
        .custom-table tr {
            background-color: #dddddd;
        }
        .custom-table td{
            font-size: 15px;
            font-weight: bold;
        }

        .custom-table-two {
            max-height: 100px;
            margin-top: 100px;
            width: 20%;
            border-collapse: collapse;
            margin-left: 30px;
        }

        .custom-table-two th, .custom-table-two td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }

        .custom-table-two th {
            background-color: #f2f2f2;
            font-size: 18px;
            font-weight: bold;
        }
        .custom-table-two tr {
            background-color: #dddddd;
        }
        .custom-table-two td{
            font-size: 15px;
            font-weight: bold;
        }
</style>

  </head>
  <body class="violetgradient"> 
    <?php
    include "adminnavbar.php"
    ?>
    <div class="table-container" style="width: 100%">
    <?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "supplychain";
      
      // Create a connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      
      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }

      $sql = "SELECT * FROM users";
        $result = $conn->query($sql);

        // Check if the query was successful
        if ($result === false) {
            die("Error: " . $conn->error);
        }

        if ($result->num_rows > 0) {
            echo "<table class='custom-table'>";
            echo "<tr><th>Id</th><th>Email</th><th>Username</th><th>Password</th><th>Role</th></tr>";
        
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["username"] . "</td>";
                echo "<td>" . $row["password"] . "</td>";
                echo "<td>" . $row["role"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No data found.";
        }

        $conn->close();
      ?>

<?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "supplychain";
      
      // Create a connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      
      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }

      $sql = "SELECT * FROM authemail";
        $result = $conn->query($sql);

        // Check if the query was successful
        if ($result === false) {
            die("Error: " . $conn->error);
        }

        if ($result->num_rows > 0) {
            echo "<table class='custom-table-two'>";
            echo "<tr><th>Govt Regitered Emails</th></tr>";
        
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["email"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No data found.";
        }

        $conn->close();
      ?>
      </div>
      <center>
      <div class="loginformcard" id="maincard4">
            <h4> Govt Registered Emails</h4>
            <form id="submit-form" style="margin-top: 30px; margin-bottom: 30px;"method="POST" action="authemail.php">

            <label type="text" class="formlabel"> Email</label>
            <input type="email" class="forminput" name="email" id="value">

            <button class="formbtn" value="Submit" type="submit">Save</button>
      </div>
      </center>
      <!--Medicine table-->
      <script type="text/javascript" src="js/changetitle.js"></script>
  </body>
</html>
