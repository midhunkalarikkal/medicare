<?php
// Database connection details
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

// Handle delete operation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["email"])) {
        $email = $_POST["email"];

        // Prepare the delete statement
        $stmt = $conn->prepare("DELETE FROM authemail WHERE email = ?");
        $stmt->bind_param("i", $email);

        // Execute the delete statement
        if ($stmt->execute()) {
            // Deletion successful
            echo "Row deleted successfully!";
        } else {
            // Error occurred during deletion
            echo "Error deleting row: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the database connection
$conn->close();
?>
