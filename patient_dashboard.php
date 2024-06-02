<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Details</title>
   <link href="style3.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Patient Details</h1>
        <div class="details">
            <?php
            session_start(); // Start the session if not already started

            // Check if the user is logged in as a patient
            if (!isset($_COOKIE['username'])) {
                // Redirect to the login page if the username cookie is not set
                header("Location: login.php");
                exit;
            }

            // Retrieve the username from the cookie
            $username = $_COOKIE['username'];

            // Connect to the database
            $servername = "localhost";
            $username_db = "root";
            $password_db = "";
            $dbname = "sample";

            $con = mysqli_connect($servername, $username_db, $password_db, $dbname);
            if (mysqli_connect_error()) {
                echo "Failed to connect to database";
                exit();
            }

            // Fetch patient details using the username
            $sql = "SELECT * FROM patients WHERE username='$username'";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                // Patient found, display patient details
                $row = $result->fetch_assoc();
                // Display patient details
                echo "<p><strong>Name:</strong> " . $row['name'] . "</p>";
                echo "<p><strong>Age:</strong> " . $row['age'] . "</p>";
                echo "<p><strong>Gender:</strong> " . $row['gender'] . "</p>";
                echo "<p><strong>Address:</strong> " . $row['address'] . "</p>";
                echo "<p><strong>Phone:</strong> " . $row['phone'] . "</p>";
                echo "<p><strong>Consulting Doctor:</strong> " . $row['consulting_doctor'] . "</p>";
                echo "<p><strong>Department:</strong> " . $row['department'] . "</p>";
                echo "<p><strong>Medical History:</strong> " . $row['medical_history'] . "</p>";
                echo "<p><strong>Diagnosis:</strong> " . $row['diagnosis'] . "</p>";
                echo "<p><strong>Prescription:</strong> " . $row['prescription'] . "</p>";
                echo "<p><strong>Treatment Plan:</strong> " . $row['treatment_plan'] . "</p>";
                echo "<p><strong>Last Consultant Date:</strong> " . $row['last_consultant'] . "</p>";
                echo "<p><strong>Next Consultant Date:</strong> " . $row['next_consulting_date'] . "</p>";
                
                // Display other details as needed
            } else {
                echo "Patient details not found.";
            }

            // Close the database connection
            $con->close();
            ?>
        </div>
        <button class="btn" onclick="goBack()">Go Back</button>
    </div>
    <script>
      function goBack() {
            window.history.back();
        }

      </script>
</body>
</html>
