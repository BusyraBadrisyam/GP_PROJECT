<?php
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $memberID = $_SESSION['MemberID'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Ensure Date Joined is not part of the update query
    $updateQuery = "UPDATE Member SET Name = ?, Email = ?, Phone = ?, Address = ? WHERE MemberID = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ssssi", $name, $email, $phone, $address, $memberID);

    if ($stmt->execute()) {
        echo "<script>alert('Profile updated successfully!'); window.location.href = 'profilemember.php';</script>";
    } else {
        echo "<script>alert('Error updating profile.'); window.location.href = 'profilemember.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
