<?php
// Database connection parameters
$servername = "localhost"; // Change this if your MySQL server is hosted elsewhere
$db_username = "root"; // Change this to your MySQL username
$db_password = ""; // Change this to your MySQL password
$db_name = "sample"; // Change this to the name of your MySQL database

// Retrieve form data
$id = $_POST['id'] ?? '';
$diagnosis = $_POST['diagnosis'] ?? '';
$prescription = $_POST['prescription'] ?? '';
$treatment_plan= $_POST['treatment_plan'] ?? '';
$next_consulting_date = $_POST['next_consulting_date'] ?? '';
//$form_usertype = $_POST['usertype'];

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update query to update patient details
$query = "UPDATE patients SET diagnosis = '$diagnosis', prescription = '$prescription', treatment_plan ='$treatment_plan', next_consulting_date='$next_consulting_date' WHERE id = $id";


// Execute the update query
if ($conn->query($query) === TRUE) {
    echo "<script>alert('Updated successfully!');window.location.href = 'index.php';</script>";
} else {
    // Handle update error
    echo "Error updating patient details: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
