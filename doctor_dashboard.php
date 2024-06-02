<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Details</title>
    <link href="style6.css" rel="stylesheet">
</head>
<body>
    <div class="container">
    <h2>Enter Patient ID to Review the Reports</h2>

    <form action="" method="post">
        <label for="patient">Patient ID:</label><br>
        <input type="text" id="patient" name="patient" required><br><br>

        <input id="btn" type="submit" value="Get Patient Details">
    </form>
</div>
    <?php
    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $servername = "localhost";
            $username_db = "root";
            $password_db = "";
            $dbname = "sample";
        // Assuming you have already established a database connection
        $con = mysqli_connect($servername, $username_db, $password_db, $dbname);

        // Check for connection errors
        if (mysqli_connect_error()) {
            echo "Failed to connect to database";
            exit();
        }

        // Assuming you have received the patient ID via POST method
        $patient_id = $_POST['patient'];

        // Query to select patient details including the consulting doctor for the patient
        $query = "SELECT * FROM patients WHERE id = $patient_id";

        // Execute the query
        $result = mysqli_query($con, $query);

        // Check if the query was successful
        if ($result) {
            // Fetch the result row
            $row = mysqli_fetch_assoc($result);
            
            // Check if the consulting doctor exists for the patient
            if ($row) {
                // Extract patient details from the result
                $id = $row['id'];
                $name = $row['name'];
                $diagnosis = $row['diagnosis'];
                $prescription = $row['prescription'];
                $treatment_plan = $row['treatment_plan'];
                $next_consulting_date = $row['next_consulting_date'];
                // Add other patient details here
                
                // Display patient details in input fields for editing
                echo "<div class='update-form'>";
                echo "<form action='update.php' method='post'>";
                echo "<input type='hidden' name='patient_id' value='$patient_id'>";
                echo "<input type='hidden' name='id' value='$id'><br>";
                echo "Diagnosis: <input type='text' name='diagnosis' value='$diagnosis'><br>";
                echo "Prescription: <input type='text' name='prescription' value='$prescription'><br>";
                echo "Treatment Plan: <input type='text' name='treatment_plan' value='$treatment_plan'><br>";
                echo "Next Consulting Date: <input type='text' name='next_consulting_date' value='$next_consulting_date'><br>";
                // Add other input fields for patient details here
                echo "<input type='submit' value='Save'>";
                echo "</form>";
                echo "</div>";
            } else {
                echo "<p>No patient found with ID: $patient_id</p>";
            }
        } else {
            // Handle query execution error
            echo "<p>Error executing query: " . mysqli_error($con) . "</p>";
        }

        // Close the database connection
        mysqli_close($con);
    }
    ?>
</body>
</html>
