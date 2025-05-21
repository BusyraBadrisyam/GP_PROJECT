<?php
include 'config.php';
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['MemberID'])) {
    header("Location: memberlogin.php"); // Redirect to login if not logged in
    exit;
}

$memberID = $_SESSION['MemberID'];
$memberData = [];

// Fetch member data from the database
$query = "SELECT Name, Email, Phone, Address, MembershipStatus, ExpiryDate, DateJoined FROM Member WHERE MemberID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $memberID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $memberData = $result->fetch_assoc();
} else {
    echo "<script>alert('Error fetching profile data.');</script>";
    exit;
}

$currentDate = date('Y-m-d H:i:s');
$expiryDate = $memberData['ExpiryDate'];

// Calculate Membership Status
if ($expiryDate > $currentDate) {
    $membershipStatus = 'Active';
} else {
    $membershipStatus = 'Inactive';
}

// Update the database to reflect the correct Membership Status
if ($membershipStatus !== $memberData['MembershipStatus']) {
    $updateStatusQuery = "UPDATE Member SET MembershipStatus = ? WHERE MemberID = ?";
    $updateStmt = $conn->prepare($updateStatusQuery);
    $updateStmt->bind_param("si", $membershipStatus, $memberID);
    $updateStmt->execute();
    $updateStmt->close();
}

// Update the $memberData array to reflect changes
$memberData['MembershipStatus'] = $membershipStatus;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Knicks Netball Club Membership</title>
<!--CSS = comprehensive style sheet for a modern, interactive, and responsive webpage-->
<style type="text/css">
  /* Reset Styles */
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    outline: 0;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    font: inherit;
    border: 0;
  }

  html {
    font-size: 12px;
    line-height: 1.5;
    -webkit-tap-highlight-color: transparent;
    font-family: 'Roboto', sans-serif;
    font-feature-settings: 'tnum';
  }

  body {
    font-family: 'Roboto', sans-serif;
    font-size: 14px;
    line-height: 1.5;
    color: #000;
    background: linear-gradient(rgba(0, 0, 0, 1.0), rgba(0, 0, 0, 0.6)), url('https://ohmyfacts.com/wp-content/uploads/2024/11/28-facts-about-netball-1730515319.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    min-height: 100vh; /* Ensures it covers the viewport */
    margin: 0;
    padding: 0;
}

  .pageview {
    overflow: hidden;
  }

  .lazy {
    background: none !important;
  }

  ol, ul {
    list-style: none;
  }

  b {
    font-weight: bold;
  }

  .visibility-hidden {
    visibility: hidden !important;
  }

  .cursor-pointer {
    cursor: pointer;
  }

  .full-height {
    height: 100%;
  }

  .full-width {
    width: 100%;
  }

  .full-mask-size {
    -webkit-mask-size: 100% 100%;
  }

  .mask-position {
    -webkit-mask-position: 0% 0%;
  }

  .u-select-none {
    user-select: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
  }

  .p-absolute {
    position: absolute;
  }

  .p-relative {
    position: relative;
  }

  /* Section Styling */
  .section-container {
    margin: auto;
  }

  .text-block-css {
    display: inline-block;
    word-break: break-word;
    -webkit-background-clip: text !important;
  }
</style>
<style type="text/css">
    /* Navigation Bar Styles */
        #AllTop {
            top: 0px;
            left: 0px;
            position: fixed; /* Sticks the navigation bar at the top */
            width: 100%;
            height: 64px;
            z-index: 1000; /* Keeps it above other elements */
        }

        #AllTop .section-wrapper {
            opacity: 1;
        }

        #AllTop .section-background {
            background-color: maroon; /* White background, Background color for the navigation bar */
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        #TAJUKOPT {
            top: 5px;
            left: 50px;
            width: 300px;
            height: 54px;
        }

        #TAJUKOPT .text-block {
            background: none;
        }

        #TAJUKOPT .text-block-css {
            color: gold; /* Logo/Title color */
            font-size: 36px;
            font-weight: bold;
        }

        /* Navigation Buttons */
        #partition-container {
            display: flex; /* Aligns buttons horizontally */
            gap: 0px; /* Space between buttons */
            position: fixed; /* Sticks buttons with the navigation bar */
            top: 4.5px; /* Adjust vertical alignment */
            right: 60px; /* Adjust horizontal alignment */
            z-index: 1010; /* Keeps it above other elements */
        }

        .button-css {
            background: maroon; /*linear-gradient(45deg, maroon 50px,gold 
            );*/ /* Maroon to teal gradient */
            color: white;
            text-decoration: none;
/*          border-radius: 20px; /* Rounded buttons */
            font-weight: bold;
            transition: transform 0.3s, background 0.3s ease;
            /*border-color: rgba(229, 231, 235, 1);
            border-style: solid;*/
            font-size: 26px;
            text-align: center;
            padding: 10px 20px;
            cursor: pointer;
            display: inline-block; /* Ensures buttons are visible */
            z-index: 1020; /* Higher than container */
        }

        .button-css a {
            text-decoration: none;
            color: gold; /* Text color for links */
        }

        .button-css:hover {
           background: linear-gradient(180deg, maroon 30px, gold); 
        }
</style>
<style>
        .container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 20px;
            margin: 50px auto;
            width: 90%;
            max-width: 800px;
            text-align: center;
            margin-top: 100px;
        }
        .header h1 {
            font-size: 40px;
            margin: 0;
            color: maroon;
            font-weight: bold;
            font-family: 'Playfair Display', serif;
        }
        .membership-status {
            margin-top: 20px;
            font-size: 16px;
            font-weight: bold;
            color: maroon;
        }
        .membership-status span {
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .membership-status .active {
            color: green;
            border: 1px solid green;
        }
        .membership-status .inactive {
            color: red;
            border: 1px solid red;
        }
        .renew-button {
            background-color: #11bf3d;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            margin-top: 10px;
        }
        .renew-button:hover {
            background-color: #0f9b2e;
        }
        .form-container {
            margin-top: 30px;
        }
        .form-row {
            display: flex;
            justify-content: left;
            margin-bottom: 15px;
        }
        .form-row label {
            width: 30%;
            text-align: right;
            margin-right: 10px;
            font-weight: bold;
            font-weight: bold;
            font-size: 18px;
            color: maroon;
        }
        .form-row input {
            width: 60%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background: white;
        }
        .buttons {
            text-align: right;
            margin-top: 20px;
        }
        .buttons button {
            margin: 0 5px;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: white;
            font-weight: bold;
        }
        .edit-button {
            background-color: #007bff;
        }
        .edit-button:hover {
            background-color: #0056b3;
        }
        .save-button {
            background-color: #11bf3d;
        }
        .save-button:hover {
            background-color: #0f9b2e;
        }
        .cancel-button {
            background-color: #d30418;
        }
        .cancel-button:hover {
            background-color: #c82333;
        }
    </style>
    <script>
        function toggleEditMode(enable) {
        const inputs = document.querySelectorAll('.form-row input');
        inputs.forEach(input => input.disabled = !enable);
        document.getElementById('saveButton').style.display = enable ? 'inline-block' : 'none';
        document.getElementById('cancelButton').style.display = enable ? 'inline-block' : 'none';
        document.getElementById('editButton').style.display = enable ? 'none' : 'inline-block';
    }

        function saveChanges() {
            document.getElementById('profileForm').submit();
        }
    </script>
</head>
<body>
    <div id="AllTop">
        <div class="section-wrapper full-width full-height p-relative">
            <div class="section-background p-absolute full-width full-height"></div>
            <div class="section-container full-height p-relative">

                <!-- Knicks Netball Club Title -->
                <div id="TAJUKOPT" class="com-text-block p-absolute cursor-pointer" style="transition: 0.3s;">
                    <div class="text-block">
                        <p class="text-block-css full-width">Knicks Netball</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Buttons -->
    <div id="partition-container">
        <div class="com-button cursor-pointer animation">
            <div class="button-css">
                <span class="button-loader"></span>
                <a href="homemember.php" class="button-text u-select-none">Home</a>
            </div>
        </div>
        <div class="com-button cursor-pointer animation">
            <div class="button-css">
                <span class="button-loader"></span>
                <a href="staffM.php" class="button-text u-select-none">Staff Directory</a>
            </div>
        </div>
        <div class="com-button cursor-pointer animation">
            <div class="button-css">
                <span class="button-loader"></span>
                <a href="webpolicyM.php" class="button-text u-select-none">Policy</a>
            </div>
        </div>
        <div class="com-button cursor-pointer animation">
            <div class="button-css">
                <span class="button-loader"></span>
                <a href="profilemember.php" class="button-text u-select-none">Profile</a>
            </div>
        </div>
        <div class="com-button cursor-pointer animation">
            <div class="button-css">
                <span class="button-loader"></span>
                <a href="logout_knicks.php" class="button-text u-select-none">Log Out</a>
            </div>
        </div>
    </div>
</div>
    <div class="container">
        <div class="header">
            <h1>PROFILE</h1>
        </div>

        <div class="membership-status">
        Membership Status: 
        <span class="<?= $membershipStatus == 'Active' ? 'active' : 'inactive'; ?>">
            <?= $membershipStatus; ?>
        </span>
        <br>
        Expiry Date: <span><?= htmlspecialchars($expiryDate); ?></span>
    <?php if ($membershipStatus == 'Inactive'): ?>
        <button class="renew-button" onclick="window.location.href='renewmembership.php'">Renew</button>
    <?php endif; ?>
    </div>

        <div class="form-container">
            <form id="profileForm" action="update_profile.php" method="POST">
    <div class="form-row">
                    <label for="name">Full Name:</label>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($memberData['Name']); ?>" disabled>
                </div>
                <div class="form-row">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($memberData['Email']); ?>" disabled>
                </div>
                <div class="form-row">
                    <label for="phone">Phone No:</label>
                    <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($memberData['Phone']); ?>" disabled>
                </div>
    <div class="form-row">
    <label for="datejoin">Date Joined:</label>
    <input type="date" id="datejoin" name="datejoin" value="<?= htmlspecialchars(date('Y-m-d', strtotime($memberData['DateJoined']))); ?>" readonly>
    </div>
    <div class="form-row">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" value="<?= htmlspecialchars($memberData['Address']); ?>" disabled>
                </div>
    <div class="buttons">
        <button type="button" id="editButton" class="edit-button" onclick="toggleEditMode(true)">Edit</button>
        <button type="submit" id="saveButton" class="save-button" style="display:none;">Save</button>
        <button type="button" id="cancelButton" class="cancel-button" style="display:none;" onclick="toggleEditMode(false)">Cancel</button>
    </div>
</form>

        </div>
    </div>
</body>
</html>
