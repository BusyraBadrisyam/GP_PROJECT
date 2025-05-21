<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $date = $_POST['date'];

    // Handle file upload
    $targetDir = "image/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        $imageURL = $targetFile;

        $insertQuery = "INSERT INTO Tournament (TournamentName, TournamentDate, ImageURL) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("sss", $name, $date, $imageURL);

        if ($stmt->execute()) {
            echo "<script>alert('Tournament added successfully!'); window.location.href = 'homeadmin.php';</script>";
        } else {
            echo "<script>alert('Error adding tournament: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('Error uploading image.');</script>";
    }
}
?>
