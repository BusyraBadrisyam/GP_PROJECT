<?php
include 'config.php'; 
session_start();

// Check if already logged in
if (isset($_SESSION['MemberID'])) {
    header('Location: homemember.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check for valid input
    if (!empty($email) && !empty($password)) {
        // Query to get member data
        $sql = "SELECT MemberID, Name, Password, MembershipStatus FROM Member WHERE Email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($memberID, $name, $hashed_password, $membershipStatus);
            $stmt->fetch();

            // Verify the password
            if (password_verify($password, $hashed_password)) {
                if ($membershipStatus === 'Active') {
                    $_SESSION['MemberID'] = $memberID;
                    $_SESSION['Name'] = $name;
                    echo "<script>alert('Login successful! Redirecting...'); window.location.href = 'homemember.php';</script>";
                } else {
                    $_SESSION['MemberID'] = $memberID; // Set the session for inactive members too
                    $_SESSION['Name'] = $name;
                    echo "<script>alert('Your membership is inactive.'); window.location.href = 'homemember.php';</script>";
                }
            } else {
                echo "<script>alert('Incorrect password. Please try again.'); window.location.href = 'memberlogin.php';</script>";
            }
        } else {
            echo "<script>alert('No member found with that email. Please register.'); window.location.href = 'memberregister.php';</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Please fill in both email and password.');</script>";
    }
}
?>
