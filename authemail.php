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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $inputValue = $_POST["email"];
    }

    $stmt = $conn->prepare("INSERT INTO authemail (email) VALUES (?)");
    $stmt->bind_param("s", $inputValue);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        header("Location: admin.php");
    } else {
        $message = "Email is not saved to database!";
        echo '<script>alert("' . $message . '");</script>';
    }
    $stmt->close();
    $conn->close();
    ?>