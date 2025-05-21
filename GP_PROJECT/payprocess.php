<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $paymentType = $_POST['bank']; // Use the bank (e.g., Maybank, CIMB) as the payment type
    $renewalPeriod = intval($_POST['renewal_period']); // Renewal period from the form (e.g., 3, 6, 9, or 12)
    $amount = $_POST['amount'];

    // Fetch MemberID and current ExpiryDate based on email
    $query = "SELECT MemberID, ExpiryDate FROM Member WHERE Email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $member = $result->fetch_assoc();

    if (!$member) {
        echo "<script>alert('Member not found! Please check your email.'); window.history.back();</script>";
        exit;
    }

    $memberID = $member['MemberID'];
    $currentExpiryDate = $member['ExpiryDate'];

    // If the expiry date is already expired, use the current timestamp as the base
    $baseDate = ($currentExpiryDate > date('Y-m-d H:i:s')) ? $currentExpiryDate : date('Y-m-d H:i:s');

    // Calculate renewal period in minutes (for demo purposes)
    // 3 months = 2 minutes, 6 months = 4 minutes, 9 months = 6 minutes, 12 months = 8 minutes
    $demoMinutes = ($renewalPeriod / 3) * 2;

    // Calculate new ExpiryDate based on the demo minutes
    $newExpiryDate = date('Y-m-d H:i:s', strtotime($baseDate . " + $demoMinutes minutes"));

    $paymentDate = date('Y-m-d H:i:s'); // Current payment timestamp
    $paymentStatus = 'Completed';

    // Insert payment record into the Payment table
    $paymentSQL = "INSERT INTO Payment (MemberID, PaymentType, Amount, PaymentDate, NextDueDate, PaymentStatus)
                   VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($paymentSQL);
    $stmt->bind_param("issdss", $memberID, $paymentType, $amount, $paymentDate, $newExpiryDate, $paymentStatus);

    if ($stmt->execute()) {
        // Update ExpiryDate in the Member table
        $updateSQL = "UPDATE Member SET ExpiryDate = ? WHERE MemberID = ?";
        $updateStmt = $conn->prepare($updateSQL);
        $updateStmt->bind_param("si", $newExpiryDate, $memberID);

        if ($updateStmt->execute()) {
            echo "<script>
                    alert('Membership renewal successful! Paid via $paymentType.');
                    window.location.href = 'profilemember.php';
                  </script>";
        } else {
            echo "<script>alert('Error updating membership status: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('Error processing payment: " . $conn->error . "');</script>";
    }
}
?>
