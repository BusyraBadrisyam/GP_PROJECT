<?php
// Include database configuration
include 'config.php';

// Map AdminID or Name to image paths
$adminImages = [
    'Hani Batrisyia Binti Ahmad' => 'image\hani.jpg',
    'Asyikin Binti Zailan' => 'image\asyi.jpg',
    'Nurin Afrina Binti Rostam' => 'image\nurin.jpg',
    'Aminur Shuhada Binti Asri' => 'image\mino.jpg', // Add more admins as needed
];

// Fetch admin contact information
$adminQuery = "SELECT Name, Email, Phone FROM Admin";
$result = $conn->query($adminQuery);

if ($result === false) {
    die("Database Query Error: " . $conn->error);
}

// Store all admin records in an array
$admins = [];
while ($row = $result->fetch_assoc()) {
    $admins[] = $row;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Directory - Knicks Netball Club</title>
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
        /* Container for the organization chart and contact info */
        .content-container {
            /*background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;*/
            padding: 20px;
            margin: 50px auto;
            width: 90%;
            max-width: 800px;
            text-align: center;
        }

        .organization-chart h1 {
            font-size: 60px;
            margin: 0;
            color: gold;
            font-weight: bold;
            font-family: 'Playfair Display', serif;
            margin-bottom: 20px;
        }
        .organization-chart {
            margin: 30px 0;
            text-align: center;
        }

        .organization-chart img {
            max-width: 100%;
            height: auto;
            border: 2px solid maroon;
            border-radius: 10px;
        }

        .admin-contact {
            margin-top: 30px;
            font-size: 18px;
            display: flex; /* Enable flexbox */
            color: gold;
            display: flex;
            flex-direction: column;
            gap: 20px; /* Space between admin cards */
            align-items: center; /* Center all the cards horizontally */
            justify-content: center; /* Center the cards horizontally */
        }

        .admin-contact h1 {
            font-size: 60px;
            margin: 0;
            color: gold;
            font-weight: bold;
            font-family: 'Playfair Display', serif;
            margin-bottom: 20px;
            text-align: center;
        }

        .admin-card {
            display: flex;
            align-items: center;
/*            background: maroon;
            border: 2px solid gold;*/
            border-radius: 10px;
            padding: 10px;
            width: 90%; /* Set the card width */
            gap: 20px; /* Space between image and contact info */
            max-width: 450px; /* Optional: restrict the width of the card */
        }

        .admin-image {
            flex: 0 0 100px; /* Fixed width for the image */
            height: 100px; /* Fixed height for the image */
            border-radius: 50%; /* Circular image */
            overflow: hidden;
            border: 3px solid gold;
        }

        .admin-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .admin-details {
            flex: 1;
            text-align: left;
        }

        .admin-details p {
            margin: 5px 0;
            line-height: 1.5;
            color: gold;
            font-weight: bold;
        }

        .admin-details a {
            color: floralwhite;
            text-decoration: none;
        }

        .admin-details a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Navigation bar -->
    <div id="AllTop">
        <div class="section-wrapper full-width full-height p-relative">
            <div class="section-background p-absolute full-width full-height"></div>
            <div class="section-container full-height p-relative">
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
                <a href="home_knicks.php" class="button-text u-select-none">Home</a>
            </div>
        </div>
        <div class="com-button cursor-pointer animation">
            <div class="button-css">
                <span class="button-loader"></span>
                <a href="staff.php" class="button-text u-select-none">Staff Directory</a>
            </div>
        </div>
        <div class="com-button cursor-pointer animation">
            <div class="button-css">
                <span class="button-loader"></span>
                <a href="webpolicy.php" class="button-text u-select-none">Policy</a>
            </div>
        </div>
        <div class="com-button cursor-pointer animation">
            <div class="button-css">
                <span class="button-loader"></span>
                <a href="loginselection.php" class="button-text u-select-none">Log In</a>
            </div>
        </div>
    </div>
</div>

    <!-- Main Content -->
    <div class="content-container">
        <!-- Organization Chart -->
        <div class="organization-chart">
            <h1>Knicks Organization Chart</h1>
            <img src="image\ORG_CHART.png" alt="Organization Chart">
            <!-- Replace 'organization_chart.jpg' with the actual image file name -->
        </div>

         <!-- Admin Contact Info -->
        <div class="admin-contact">
            <h1>Admin Contacts</h1>
            <?php if (!empty($admins)): ?>
        <?php foreach ($admins as $adminInfo): ?>
            <div class="admin-card">
                <!-- Left: Admin Image -->
                <div class="admin-image">
                    <img src="<?= isset($adminImages[$adminInfo['Name']]) ? htmlspecialchars($adminImages[$adminInfo['Name']]) : 'image/default_admin.png'; ?>" alt="Admin Image">
                </div>
                <!-- Right: Admin Details -->
                <div class="admin-details">
                    <p><strong>Name:</strong> <?= htmlspecialchars($adminInfo['Name']); ?></p>
                    <p><strong>Email:</strong> <a href="mailto:<?= htmlspecialchars($adminInfo['Email']); ?>"><?= htmlspecialchars($adminInfo['Email']); ?></a></p>
                    <p><strong>Phone:</strong> <a href="tel:<?= htmlspecialchars($adminInfo['Phone']); ?>"><?= htmlspecialchars($adminInfo['Phone']); ?></a></p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No admin contact information available.</p>
    <?php endif; ?>
</div>
</body>
</html>
