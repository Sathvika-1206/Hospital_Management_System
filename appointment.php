<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Appointment</title>
  
<link href="style1.css" rel="stylesheet"/> 
</head>
<body>
  <div class="cover">
    <div class="box">
      <div class="inp">
      <form action="appointment.php" method="post">
           <label>Patient Name<span> *</span></label><br>
           <input type="text" name="name" id="name" placeholder="Patient Name" required><br>
           <label>Email Id</label><br>
           <input type="email" name="email" id="email" placeholder="Email-id"><br>
           <label>Phone Number <span> *</span></label><br>
           <input type="text" name="ph" id="ph" placeholder="Phone Number" required><br>
           <label>Address</label><br>
           <textarea name="ad" rows='2' cols='66' id="ad" placeholder="Address"></textarea><br>
           <label>Appointment Date Time <span> *</span></label><br>
           <input type="datetime-local" id="date" name="datetime" placeholder="" onfocus="clearPlaceholder()" required><br>
           <label>Department <span>*</span></label><br>
          <select name="department" id="department" required>
                <option value="">Select Department</option>
                <option value="general">General</option>
                <option value="cardio">Cardiology</option>
               <option value="ortho">Orthopedics</option>
               <option value="pediatric">Pediatrics</option>
           </select><br>
           <input type="submit" value="BACK" id="back">
           <input type="submit" value="BOOK APPOINTMENT" id="book">
      </form>
    </div>
    </div>
  </div>
  <script>
    function clearPlaceholder(){
    document.getElementById("date").value="";
    }
  </script>
</body>
</html>
<?php
$servername= "localhost";
$username="root";
$password="";
$dbname="sample";

$conn = mysqli_connect($servername,$username,$password,$dbname);
if(mysqli_connect_error()){
  echo "Failed";
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Escape user inputs for security
  $patient_name = $conn->real_escape_string($_POST['name']);
  $email = $conn->real_escape_string($_POST['email']);
  $phone_number = $conn->real_escape_string($_POST['ph']);
  $address = $conn->real_escape_string($_POST['ad']);
  $appointment_datetime = $_POST['datetime'];
  $department = $_POST['department'];

  // Insert appointment data into the database
  $sql = "INSERT INTO appointments (patientname, email, ph, address, appointment_datetime, department)
          VALUES ('$patient_name', '$email', '$phone_number', '$address', '$appointment_datetime', '$department')";

  if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Appointment Booked successfully!');window.location.href = 'index.php';</script>";
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

// Close connection
$conn->close();
?>