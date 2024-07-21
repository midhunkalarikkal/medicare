<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "supplychain";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["email"])) {
            $email = $_POST["email"];

            $stmt = $conn->prepare("DELETE FROM authemail WHERE email = ?");
            $stmt->bind_param("i", $email);

            if ($stmt->execute()) {
                echo "Row deleted successfully!";
            } else {
                echo "Error deleting row: " . $stmt->error;
            }
            $stmt->close();
        }
    }

    $conn->close();
?>