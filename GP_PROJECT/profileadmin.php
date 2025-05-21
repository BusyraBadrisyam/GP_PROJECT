<?php
include 'config.php'; // Include database connection
session_start();

// Check if admin is logged in
if (!isset($_SESSION['AdminID'])) {
    header("Location: adminlogin.php");
    exit;
}

$adminID = $_SESSION['AdminID'];

// Fetch admin details from the database
$query = "SELECT * FROM Admin WHERE AdminID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $adminID);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();

// Handle profile updates
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Update admin information in the database
    $updateQuery = "UPDATE Admin SET Name = ?, Email = ?, Phone = ? WHERE AdminID = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("sssi", $name, $email, $phone, $adminID);

    if ($stmt->execute()) {
        echo "<script>alert('Profile updated successfully!'); window.location.href='profileadmin.php';</script>";
    } else {
        echo "<script>alert('Error updating profile: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
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
            background: goldenrod;
            border-radius: 10px;
            padding: 20px;
            margin: 50px auto;
            margin-top: 150px;
            width: 90%;
            max-width: 800px;
            text-align: center;
        }
        .profile-info {
            display: flex;
            justify-content: space-between;
            padding: 10px;
        }
        .container h2 {
            font-weight: bold;
            margin-right: 10px;
            font-size: 50px;
            font-family: 'Playfair Display', serif;
            color: maroon;
        }
        .profile-info label {
            font-weight: bold;
            margin-right: 5px;
            font-size: 20px;
            color: maroon;
        }
        .profile-info input {
            font-weight: bold;
            font-size: 18px;
            color: maroon;
        }
        .editable-field {
            width: 70%;
            padding: 5px;
            border: 2px solid maroon;
            border-radius: 4px;
            outline: none;
        }
        .buttons {
            margin-top: 20px;
        }
        .button {
            margin: 5px;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: white;
            font-weight: bold;
            font-size: 18px;
        }
        .edit-button {
            background-color: maroon;
            color: white;
            background: transform 0.5s ease-in-out;
        }
        .edit-button:hover {
            transform: scale(1.1);
        }
        .save-button {
            background-color: #11bf3d;
        }
        .save-button:hover {
            background-color: #218838;
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
            const fields = ['fullname', 'email', 'phone'];
            fields.forEach(field => {
                const input = document.getElementById(`input_${field}`);
                input.disabled = !enable;
            });
            document.getElementById('saveButton').style.display = enable ? 'inline-block' : 'none';
            document.getElementById('cancelButton').style.display = enable ? 'inline-block' : 'none';
            document.getElementById('editButton').style.display = enable ? 'none' : 'inline-block';
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
                <a href="homeadmin.php" class="button-text u-select-none">Home</a>
            </div>
        </div>
        <div class="com-button cursor-pointer animation">
            <div class="button-css">
                <span class="button-loader"></span>
                <a href="staffA.php" class="button-text u-select-none">Staff Directory</a>
            </div>
        </div>
        <div class="com-button cursor-pointer animation">
            <div class="button-css">
                <span class="button-loader"></span>
                <a href="webpolicyA.php" class="button-text u-select-none">Policy</a>
            </div>
        </div>
        <div class="com-button cursor-pointer animation">
            <div class="button-css">
                <span class="button-loader"></span>
                <a href="profileadmin.php" class="button-text u-select-none">Profile</a>
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
        <h2>ADMIN PROFILE</h2>
        <form action="" method="POST">
            <div class="profile-info">
                <label for="input_fullname">Full Name:</label>
                <input type="text" id="input_fullname" name="fullname" class="editable-field" value="<?php echo htmlspecialchars($admin['Name']); ?>" disabled>
            </div>
            <div class="profile-info">
                <label for="input_email">Email:</label>
                <input type="email" id="input_email" name="email" class="editable-field" value="<?php echo htmlspecialchars($admin['Email']); ?>" disabled>
            </div>
            <div class="profile-info">
                <label for="input_phone">Phone:</label>
                <input type="text" id="input_phone" name="phone" class="editable-field" value="<?php echo htmlspecialchars($admin['Phone']); ?>" disabled>
            </div>
            <div class="buttons">
                <button type="button" id="editButton" class="button edit-button" onclick="toggleEditMode(true)">Edit</button>
                <button type="submit" id="saveButton" class="button save-button" style="display:none;">Save</button>
                <button type="button" id="cancelButton" class="button cancel-button" onclick="toggleEditMode(false)" style="display:none;">Cancel</button>
            </div>
        </form>
    </div>
</body>
</html>
