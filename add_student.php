<!DOCTYPE html>
<html>
<head>
    <title>Add Student Info</title>
</head>
<body>

<h2>Add Student Information</h2>

<form method="post" action="">
    Name: <input type="text" name="name"><br><br>
    Email: <input type="text" name="email"><br><br>
    Skills (comma separated): <input type="text" name="skills"><br><br>
    <input type="submit" name="submit" value="Save">
</form>

<?php
if (isset($_POST['submit'])) {

    try {
        // Get input values and trim spaces
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $skills = trim($_POST['skills']);

        // Check if fields are empty
        if ($name == "" || $email == "" || $skills == "") {
            throw new Exception("All fields are required.");
        }

        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }

        // Convert skills string to array
        $skillsArray = explode(",", $skills);

        // Format data to save
        $data = "Name: $name | Email: $email | Skills: " . implode(", ", $skillsArray) . PHP_EOL;

        // Save to students.txt
        if (file_put_contents("students.txt", $data, FILE_APPEND)) {
            echo "<p style='color:green'>Student information saved successfully!</p>";
        } else {
            throw new Exception("Failed to save student data.");
        }

    } catch (Exception $e) {
        echo "<p style='color:red'>Error: " . $e->getMessage() . "</p>";
    }
}
?>

</body>
</html>
