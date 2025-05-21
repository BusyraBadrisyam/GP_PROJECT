<?php
include 'config.php'; // Database connection
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if email and password are provided
    if (!empty($email) && !empty($password)) {
        // Query the Admin table
        $sql = "SELECT AdminID, Name, Password FROM admin WHERE Email = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($adminID, $name, $hashed_password);
                $stmt->fetch();

                // Verify password
                if (password_verify($password, $hashed_password)) {
                    // Set session variables for the logged-in admin
                    $_SESSION['AdminID'] = $adminID;
                    $_SESSION['Name'] = $name;

                    // Redirect to the admin dashboard
                    echo "<script>alert('Admin login successful!'); window.location = 'homeadmin.php';</script>";
                } else {
                    // Invalid password
                    echo "<script>alert('Invalid password. Please try again.'); window.location = 'adminlogin.php';</script>";
                }
            } else {
                // No admin found with this email
                echo "<script>alert('No admin account found with this email.'); window.location = 'adminlogin.php';</script>";
            }

            $stmt->close();
        } else {
            // Query preparation failed
            echo "<script>alert('Error: Unable to prepare query.'); window.location = 'adminlogin.php';</script>";
        }
    } else {
        // Email or password missing
        echo "<script>alert('Please provide both email and password.'); window.location = 'adminlogin.php';</script>";
    }
} else {
    // Redirect if not a POST request
    header('Location: adminlogin.php');
    exit;
}
?>
