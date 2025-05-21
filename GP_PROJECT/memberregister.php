<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $selectedBank = $_POST['bank']; // Selected bank from the form

    // Default values for new members
    $membershipStatus = 'Active'; // Set to 'Active' on registration
    // Set ExpiryDate to 2 minutes for demo purposes
    $expiryDate = date('Y-m-d H:i:s', strtotime('+2 minutes'));


    // Check if email already exists
    $checkEmailQuery = "SELECT Email FROM Member WHERE Email = ?";
    $stmt = $conn->prepare($checkEmailQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email already exists
        echo "<script>
                alert('Error: This email is already registered. Please use a different email.');
                window.history.back(); // Redirect back to the registration form
              </script>";
        exit;
    }

    // Insert member data into the database
    $sql = "INSERT INTO Member (Name, Email, Phone, Address, Password, MembershipStatus, ExpiryDate)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $name, $email, $phone, $address, $password, $membershipStatus, $expiryDate);

    if ($stmt->execute()) {
        // Store MemberID
        $memberID = $conn->insert_id;

        // Insert payment record into the Payment table
        $paymentType = 'Registration';
        $amount = 100.00; // Default registration fee
        $paymentDate = date('Y-m-d H:i:s'); // Full datetime
        $nextDueDate = date('Y-m-d', strtotime('+1 year')); // One year from today
        $paymentStatus = 'Completed';

        $paymentSQL = "INSERT INTO Payment (MemberID, PaymentType, Amount, PaymentDate, NextDueDate, PaymentStatus)
               VALUES (?, ?, ?, ?, ?, ?)";
        $paymentStmt = $conn->prepare($paymentSQL);

        if ($paymentStmt) {
            // Bind parameters and execute the query
            $paymentStmt->bind_param("issdss", $memberID, $paymentType, $amount, $paymentDate, $nextDueDate, $paymentStatus);

            if ($paymentStmt->execute()) {
                echo "<script>
                        alert('Registration and payment successful via $selectedBank!');
                        window.location.href = 'homemember.php';
                      </script>";
            } else {
                echo "<script>alert('Error: Unable to process payment.');</script>";
            }

            $paymentStmt->close();
        } else {
            echo "<script>alert('Error: Unable to prepare payment query.');</script>";
        }
    } else {
        // Handle SQL error for member insertion
        echo "<script>
                alert('Error: Unable to register. Please try again.');
              </script>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        /* Reset Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.5)), url('https://ohmyfacts.com/wp-content/uploads/2024/11/28-facts-about-netball-1730515319.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }

        .container {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 12px;
        padding: 30px;
        width: 90%;
        max-width: 500px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        text-align: center;
    }

    h2 {
        font-size: 30px;
        font-weight: bold;
        margin-bottom: 20px;
        color: maroon;
        font-family: 'Playfair Display', serif;
    }

    label {
        display: block;
        margin-bottom: 8px;
        text-align: left;
        font-size: 14px;
        color: #333;
        font-weight: bold;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    select {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 16px;
        outline: none;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    select {
        background: #f9f9f9;
        appearance: none;
        color: grey;
    }

    select:focus,
    input:focus {
        border-color: maroon;
        box-shadow: 0 0 5px maroon;
    }

    button {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 6px;
        background: maroon;
        color: white;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.3s ease;
        text-transform: uppercase;
    }

    button:hover {
        background: goldenrod;
    }

    a {
        color: maroon;
        text-decoration: none;
        font-weight: bold;
    }

    a:hover {
        text-decoration: underline;
    }

    b {
        display: block;
        margin-top: 10px;
        font-size: 16px;
        color: #333;
    }

    @media screen and (max-width: 768px) {
        .container {
            padding: 20px;
        }

        h2 {
            font-size: 24px;
        }

        button {
            font-size: 16px;
        }
    }
    </style>
</head>
<body>
    <div class="container" id="register-page">
    <h2>REGISTER</h2>
    <form action="memberregister.php" method="POST">
        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" placeholder="Enter your full name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" placeholder="Enter your phone number" required>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" placeholder="Enter your address" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>

        <label for="bank">Online Payment:</label>
        <select id="bank" name="bank" required>
            <option value="" disabled selected>Select Your Bank</option>
            <option value="Maybank">Maybank</option>
            <option value="Bank Islam">Bank Islam</option>
            <option value="RHB Bank">RHB Bank</option>
            <option value="CIMB Bank">CIMB Bank</option>
        </select>

        <button type="submit">Register and Pay</button>
    </form>
    <b>Already have an account? </b>
    <a href="loginselection.php">Log in</a>
</div>
</body>
</html>
