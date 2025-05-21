<?php
// Include the database connection
include 'config.php';
session_start();

if (!isset($_SESSION['MemberID'])) {
    header("Location: memberlogin.php"); // Redirect to login if not logged in
    exit;
}

// Retrieve the MemberID from the session
$memberID = $_SESSION['MemberID'];


// Fetch the member's name using the MemberID
include 'config.php';
$query = "SELECT Name, MembershipStatus FROM Member WHERE MemberID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $memberID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<script>alert('Member not found. Please log in again.'); window.location.href = 'memberlogin.php';</script>";
    exit;
}

$row = $result->fetch_assoc();
$_SESSION['MembershipStatus'] = $row['MembershipStatus'];
$membershipStatus = $_SESSION['MembershipStatus'];
$fullName = $row['Name'];
$shortName = getShortName($fullName);


// username auto keluar
function getShortName($fullName) {
    $nameParts = explode(" ", $fullName);
    
    // Return the second word if it exists, otherwise fallback to the first word
    foreach ($nameParts as $part) {
        // Skip short conjunctions, prefixes, etc.
        if (strlen($part) > 2) {
            return ucfirst(strtolower($part)); // Capitalize the first letter
        }
    }
    return $nameParts[0]; // Default to the first word
}
//

// Fetch available tournaments
$tournamentsQuery = "SELECT TournamentName, TournamentDate, ImageURL FROM Tournament";
$tournaments = $conn->query($tournamentsQuery);

if (!$tournaments) {
    die("Error fetching tournaments: " . $conn->error);
}

// Admin WhatsApp number
$adminWhatsApp = "601111289581"; // Replace with the admin's WhatsApp number

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Member - Knicks</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">


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
        max-width: 1380px;
        margin: 50px auto;
        padding: 20px;
        background: rgba(255, 255, 255, 0);
        border-radius: 8px;
        position: relative;
        top: 10px;
        height: 180%;
    }

    ul {
        list-style: none;
        padding: 0;
    }
    li {
        margin: 10px 0;
        padding: 10px;
        background: #fff;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .tournament-container {
            margin: 30px auto;
            margin-top: 80px;
            max-width: 1400px;
            padding: 5px;
            background: linear-gradient(305deg, maroon 400px, goldenrod);
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            display: flex; /* Enables flexbox */
            justify-content: center; /* Horizontally centers the grid */
            align-items: flex-start; /* Aligns the grid items to the top */
            max-width: 1400px; /* Limits the container width */
        }
    .tournament-container:hover {    
    background: linear-gradient(305deg, maroon, goldenrod);
    transition: 0.5s ease-in-out;
    }

.tournament-container h2 {
    color: floralwhite;
    font-size: 40px;
    font-weight: bold;
    font-family: 'Playfair Display', serif;
    text-align: center;
    margin-bottom: 5px;
}

.tournament-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));/* Creates responsive grid */
    gap: 20px;
    max-width: 1400px; /* Keeps the grid width consistent */
    display: flex; /* Aligns buttons horizontally */
    gap: 50px; /* Space between buttons */
    width: 100%; /* Ensures the grid spans the full container width */
    justify-content: center; /* Centers the grid content */
}

.tournament-item {
    background: floralwhite;
    border-radius: 8px;
    padding: 20px;
    text-align: center;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column; /* Stack content vertically */
    justify-content: space-between; /* Distribute space */
    height: 100%; /* Ensure consistent height for all cards */
}
 .tournament-item:hover {
            background: palegoldenrod;
            transition: 0.5s ease-in-out;
        }

.tournament-image {
    width: 100%; /* Adjusts to the container width */
    height: 200px; /* Set a fixed height */
    object-fit: cover; /* Ensures the image scales without distortion */
    border-radius: 8px;
    margin-bottom: 10px;
}

.tournament-item h3 {
    color: #333;
    font-size: 24px;
    margin-bottom: 10px;
    font-weight: 700;
}

.tournament-item p {
    color: maroon;
    font-size: 18px;
    margin-bottom: 15px;
    font-weight: bold;
}

.join-button {
    padding: 10px 20px;
    background: maroon;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-size: 20px;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.3s ease;
}

.join-button:hover {
    background: goldenrod;
}
</style>
<style>
.tulisan {
    max-width: 1400px;
    margin-bottom: -80px;
    padding: 20px;
/*    background: goldenrod;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 1.0);*/
    text-align: center;
    }
    h1 {
        font-size: 50px;
        font-weight: 700;
        color: gold;
        text-align: center; /* Center horizontally */
        vertical-align: middle;  /*Center vertically*/ 
        /* -webkit-text-stroke: 1px #000;  tambah outline */
    }
</style>

<!--merchandise order-->
<style>
        .merchandise-container {
            margin: 30px auto;
            margin-top: 80px;
            max-width: 1000px;
            padding: 5px;
            background: linear-gradient(305deg, maroon 400px, goldenrod);
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            /*transition: background 2s ease;  Smooth and slow transition */

        }

        .merchandise-container:hover {
            background: linear-gradient(305deg, maroon, goldenrod);
            transition: 0.5s ease-in-out;
        }

        .merchandise-container h2 {
            color: floralwhite;
            font-size: 40px;
            font-weight: bold;
            font-family: 'Playfair Display', serif;
            text-align: center; /* Center horizontally */
/*            vertical-align: middle; /* Center vertically */
            margin-bottom: 5px;
            /*-webkit-text-stroke: 0.2px black;  Outline color and width */
        }

        .merchandise-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
           /* flex-direction: column;  Stack content vertically */
            justify-content: center;
/*            height: 60px; /* Ensure consistent height for all cards */
            width: 70%;
            position: relative;
            left: 205px;
        }

        .merchandise-item {
            background: floralwhite;
           /* border: 1px solid #ddd;*/
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
         .merchandise-item:hover {
            background: palegoldenrod;
            transition: 0.5s ease-in-out;
        }

        .merchandise-image {
            max-width: 80%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .merchandise-item h3 {
            color: #333;
            font-size: 18px;
            margin-bottom: 10px;
            font-weight: bold;
            font-size: 30px;
            margin-bottom: 20px;
            font-family: 'Raleway', sans-serif;
        }

        .buy-button {
            padding: 10px 20px;
            background: maroon;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .buy-button:hover {
            background: goldenrod;
        }
    </style>
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

<!-- dah setup supaya scrollable thru pages -->
<div class="container">
    <div class="tulisan">
        <h1>Welcome, <?php echo htmlspecialchars($shortName); ?> !</h1></div>

        <!-- Tournaments Section -->
<div class="tournament-container">
    <h2>Available Tournaments</h2></div>
    <div class="tournament-grid">
        <?php while ($row = $tournaments->fetch_assoc()) { ?>
            <div class="tournament-item">
                <img src="<?php echo htmlspecialchars($row['ImageURL']); ?>" alt="<?php echo htmlspecialchars($row['TournamentName']); ?>" class="tournament-image">
                <h3><?php echo htmlspecialchars($row['TournamentName']); ?></h3>
                <p><?php $formattedDate = date("d F Y", strtotime($row['TournamentDate']));
    echo htmlspecialchars($formattedDate); ?></p>
    <?php if ($membershipStatus === 'Active') { ?>
                <!-- Show Join button for active members -->
                <a href="https://wa.me/60123456789?text=I%20want%20to%20join%20<?php echo urlencode($row['TournamentName']); ?>" class="join-button">JOIN</a>
            <?php } else { ?>
                <!-- Show Renew Membership button for inactive members -->
                <a href="renewmembership.php" class="join-button" style="background: grey;">Renew Membership</a>
            <?php } ?>
        </div>
    <?php } ?>
</div>
<div class="merchandise-container">
        <h2>Interested With Our Merchandise ?</h2>
    </div>
        <div class="merchandise-grid">
            <!-- Merchandise 1 -->
            <div class="merchandise-item">
                <img src="image\jerseyknicks.jpg" alt="Jersey Knicks" class="merchandise-image">
                <h3>JERSEY KNICKS</h3>
                <a href="https://wa.me/01111289581?text=Hello%20Admin,%20I%20would%20like%20to%20buy%20Jersey%20Knicks" class="buy-button" target="_blank">BUY</a>
            </div>

            <!-- Merchandise 2 -->
            <div class="merchandise-item">
                <img src="https://down-my.img.susercontent.com/file/my-11134207-7r98y-m0afiyji18w4c5" alt="Tudung Dexxe" class="merchandise-image">
                <h3>TUDUNG DEXXE</h3>
                <a href="https://wa.me/01111289581?text=Hello%20Admin,%20I%20would%20like%20to%20buy%20Tudung%20Dexxe" class="buy-button" target="_blank">BUY</a>
            </div>
        </div>
</body>
</html>
