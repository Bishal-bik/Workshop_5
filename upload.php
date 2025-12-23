<?php
include 'includes/header.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
try {
if (!isset($_FILES['portfolio'])) {
throw new Exception('No file uploaded');
}


$file = $_FILES['portfolio'];
$allowedTypes = ['pdf', 'jpg', 'jpeg', 'png'];
$maxSize = 2 * 1024 * 1024;


$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));


if (!in_array($ext, $allowedTypes)) {
throw new Exception('Invalid file type');
}


if ($file['size'] > $maxSize) {
throw new Exception('File size exceeds 2MB');
}


if (!is_dir('uploads')) {
throw new Exception('Upload directory not found');
}


$newName = 'portfolio_' . time() . '.' . $ext;


if (!move_uploaded_file($file['tmp_name'], 'uploads/' . $newName)) {
throw new Exception('File upload failed');
}


echo "<p style='color:green;'>File uploaded successfully!</p>";
} catch (Exception $e) {
echo "<p style='color:red;'>Error: " . $e->getMessage() . "</p>";
}
}
?>


<form method="post" enctype="multipart/form-data">
Select Portfolio File:
<input type="file" name="portfolio"><br><br>
<button type="submit">Upload</button>
</form>


<?php include 'includes/footer.php'; ?>