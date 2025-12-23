<?php
// Include header
include 'includes/header.php';
?>

<h2>Student List</h2>

<?php
// Check if file exists
if (!file_exists("students.txt")) {
    echo "<p>No student data found.</p>";
} else {
    // Read all lines from the file
    $lines = file("students.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    if (empty($lines)) {
        echo "<p>No student data available.</p>";
    } else {
        // Loop through each line and display
        foreach ($lines as $line) {
            // Split the line by " | "
            $parts = explode(" | ", $line);

            // Get Name
            $name = isset($parts[0]) ? str_replace("Name: ", "", $parts[0]) : "";

            // Get Email
            $email = isset($parts[1]) ? str_replace("Email: ", "", $parts[1]) : "";

            // Get Skills as array
            $skillsStr = isset($parts[2]) ? str_replace("Skills: ", "", $parts[2]) : "";
            $skillsArray = explode(", ", $skillsStr);

            // Display student info
            echo "<p>";
            echo "<strong>Name:</strong> $name <br>";
            echo "<strong>Email:</strong> $email <br>";
            echo "<strong>Skills:</strong> ";
            echo "<pre>";
            print_r($skillsArray); // Display skills as an array
            echo "</pre>";
            echo "</p><hr>";
        }
    }
}
?>

<?php
// Include footer
include 'includes/footer.php';
?>
