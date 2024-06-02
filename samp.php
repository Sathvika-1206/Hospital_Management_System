<?php
$servername= "localhost";
$username="root";
$password="";
$dbname="sample";

$con = mysqli_connect($servername,$username,$password,$dbname);
if(mysqli_connect_error()){
  echo "Failed";
  exit();
}
echo "Success"
?>

<?php
// Database connection parameters
$servername = "localhost"; // Change this if your MySQL server is hosted elsewhere
$db_username = "root"; // Change this to your MySQL username
$db_password = " "; // Change this to your MySQL password
$db_name = "hospital"; // Change this to the name of your MySQL database

// Retrieve form data
$form_username = $_POST['username'];
$form_password = $_POST['password'];
$form_usertype = $_POST['usertype'];

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL statement
$sql = "SELECT * FROM users WHERE username='$form_username' AND password='$form_password' AND usertype='$form_usertype'";

// Execute SQL statement
$result = $conn->query($sql);

// Check if a matching user is found
if ($result->num_rows > 0) {
    // User found, redirect to dashboard based on usertype
    if ($form_usertype === 'doctor') {
        header("Location: doctor_dashboard.php");
        exit;
    } else {
        header("Location: patient_dashboard.php");
        exit;
    }
} else {
    // User not found, redirect back to login page with error message
    header("Location: login_page.php?error=1");
    exit;
}

// Close connection
$conn->close();
?>
