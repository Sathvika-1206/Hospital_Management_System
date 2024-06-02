<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style5.css">
       
</head>
<body>
<div class=container>
    <h2>LOGIN</h2>
    <form action="login.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <label for="usertype">Login As:</label><br>
        <select id="usertype" name="usertype">
            <option value="doctor">Doctor</option>
            <option value="patient">Patient</option>
        </select><br><br>
    
   
      
        <input id ="btn" type="submit" value="Login">
    </form>
    </div>
</body>
</html>
<?php
//print_r($_POST);

$servername= "localhost";
$username="root";
$password="";
$dbname="sample";
//$_POST['username]?? '';
$form_username = $_POST['username']?? '';
$form_password = $_POST['password']?? '';
$form_usertype = $_POST['usertype']?? '';

$con = mysqli_connect($servername,$username,$password,$dbname);
if(mysqli_connect_error()){
  echo "Failed";
  exit();
}
$sql = "SELECT * FROM users WHERE username='$form_username' AND password='$form_password' AND usertype='$form_usertype'";

// Execute SQL statement
$result = $con->query($sql);
if ($result->num_rows > 0) {
  // User found, redirect to dashboard based on usertype
  setcookie('username', $form_username, time() + (86400 * 30), "/");
  if ($form_usertype === 'doctor') {
      header("Location: doctor_dashboard.php");
      //echo "doctor";
      exit;
  } else {
      header("Location: patient_dashboard.php");
     // echo "patient";
     
     //header("Location: patient_dashboard.php?username=");
     //header("Location: patient_dashboard.php");
      exit;
  }
} else {
  
  // User not found, redirect back to login page with error message
  //header("Location: login_page.php?error=1");
  //echo "invalid";
 //echo "<script>alert('Invalid Credentials');</script>";
  exit;
  
}

// Close connection
$con->close();
?>