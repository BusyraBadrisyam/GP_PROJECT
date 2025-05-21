<?php
// Include the database connection
include 'config.php';

// Query total members
$totalMembersQuery = "SELECT COUNT(*) AS total FROM Member";
$result = $conn->query($totalMembersQuery);
$totalMembers = $result->fetch_assoc()['total'];

// Query active members
$activeMembersQuery = "SELECT COUNT(*) AS active FROM Member WHERE MembershipStatus = 'Active'";
$result = $conn->query($activeMembersQuery);
$activeMembers = $result->fetch_assoc()['active'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $date = $_POST['date'];

    // Handle file upload
    $targetDir = "image/"; // Relative directory to store images
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        // Save relative path to database
        $sql = "INSERT INTO Tournament (TournamentName, TournamentDate, ImageURL) 
                VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $date, $targetFile);

        if ($stmt->execute()) {
            echo "<script>alert('Tournament added successfully!');</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('Error uploading image.');</script>";
    }
}

// Fetch active members from the database boleh appear on table
$query = "SELECT MemberID, Name, MembershipStatus FROM Member";
$result = $conn->query($query);

if (!$result) {
    die("Error fetching data: " . $conn->error);
}

// Delete tour request
if (isset($_GET['delete'])) {
    $tournamentID = intval($_GET['delete']); // Sanitize input
    $deleteQuery = "DELETE FROM Tournament WHERE TournamentID = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $tournamentID);

    if ($stmt->execute()) {
        echo "<script>alert('Tournament deleted successfully!'); window.location.href='homeadmin.php';</script>";
    } else {
        echo "<script>alert('Error: Unable to delete tournament. " . $conn->error . "');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Admin - Knicks</title>
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
    min-height: 100vh; /* Ensures it covers the full viewport height */
    margin: 0; /* Removes default margin */
    padding: 0;
    display: flex;
    flex-direction: column; /* Ensures the content aligns properly */
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
        .dashboard-container {
            width: 200%;
            max-width: 800px;
            margin: 100px auto; /* adjust ketinggian */
/*            background: rgba(255, 255, 255, 0.2); /* adjust transparency box */
            padding: 20px;
            position: relative;
            top: -50px;
            margin-bottom: 10px;
            /*border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);*/
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 80px;
            font-weight: bold;
            margin-top: 20px;
            color: gold;
            font-family: 'Playfair Display', serif;
        }
        .dashboard-cards {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
        }
        .card {
            width: 45%;
            padding: 20px;
            background: maroon;
            color: white;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border: 4px solid darkgoldenrod;
        }
        .card h2 {
            font-size: 18px;
            margin-bottom: 10px;
            color: white;
            font-weight: bold;
        }
        .card p {
            font-size: 24px;
            font-weight: bold;
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

<style type="text/css">
/*
        .view-profile-btn {
            display: block;
            width: 100%;
            padding: 10px;
            border-radius: 20px; /* Rounded buttons 
            background: maroon;
            color: white;
            font-weight: bold;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .view-profile-btn:hover {
            background-color: #aaa;
        }

         Arrows 
        .arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
            color: #000;
            cursor: pointer;
            background-color: #f1f3f9;
            padding: 10px;
            border-radius: 40%;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 10;
        }

        .arrow-left {
            left: 0px;
        }

        .arrow-right {
            right: 0px;
        }
        */
        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size:40px;
            font-weight: bold;
            margin-top: 20px;
            color: gold;
            font-family: 'Playfair Display', serif;
        }
        h3 {
            color: white;
            font-weight: bold;
            font-size: 20px;
        }

        .table1 {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            background: #fff;
        }
        .table1 th {
            border: 2px solid darkgoldenrod;
            padding: 10px;
            text-align: center;
            background: maroon;
            color: whitesmoke;
            font-weight: bold;
        }

        .table1 td {
            border: 2px solid darkgoldenrod;
            padding: 10px;
            text-align: center;
        }
        .status-active {
            color: green;
            font-weight: bold;
        }
        .status-inactive {
            color: red;
            font-weight: bold;
        }
        .table2 {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            background: #fff;
        }
        .table2 th {
            border: 2px solid darkgoldenrod;
            padding: 10px;
            text-align: center;
            background-color: maroon;
            color: white;
            font-weight: bold;
        }
        .table2 td {
            background-color: #f4f4f4;
            border: 2px solid darkgoldenrod;
            padding: 10px;
            text-align: center;
        }
        .btn {
            padding: 6px 13px;
            border: black;
            cursor: pointer;
            border-radius: 5px;
            font-weight: bold;
        }
        .btn-edit {
            background-color: #ffc107;
            color: black;
            text-decoration: none;
        }
        .btn-delete {
            background-color: #ed0f0f;
            color: white;
        }
    </style>
    <style type="text/css">
        /* styling pop up form */
         .kotakform {
            max-width: 1200px;
            text-align: center;
        }

        .add-button {
            padding: 10px 20px;
            background: maroon;
            color: gold;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
            margin-top: -15px;
            position: relative;
            left: 296px;
        }

        .add-button:hover {
            background: goldenrod;
            color: maroon;
        }

        /* Modal Styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Black overlay */
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 400px;
            position: relative;
        }

        .modal-content h2 {
            margin: 0 0 20px;
            color: maroon;
            text-align: center;
        }

        .modal-content label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .modal-content input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .modal-content button {
            padding: 10px 20px;
            background: maroon;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
        }

        .modal-content button:hover {
            background: goldenrod;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            color: black;
            cursor: pointer;
        }

        .close:hover {
            color: red;
        }

    </style>
    <style type="text/css">
        /* Styling for the Search Box */
.search-container {
    margin-bottom: 20px;
    text-align: right; /* Center the form */
}

.search-container label {
    font-weight: bold;
    font-size: 18px;
    color: maroon;
    margin-right: 10px;
}

.search-container select {
    padding: 10px;
    font-size: 16px;
    border: 2px solid maroon;
    border-radius: 5px;
    background: white;
    color: maroon;
    outline: none;
    transition: all 0.3s ease;
}

.search-container select:hover {
    border-color: darkgoldenrod;
}

.search-container button {
    padding: 10px 20px;
    font-size: 16px;
    color: white;
    background: maroon;
    border: 2px solid maroon;
    border-radius: 5px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
}

.search-container button:hover {
    background: darkgoldenrod;
    border-color: darkgoldenrod;
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

<!-- dah setup supaya scrollable thru pages -->
<div class="dashboard-container">
        <h1>Admin Dashboard</h1>
        <div class="dashboard-cards">
            <div class="card">
                <h3>Total Members</h3>
                <p><?php echo $totalMembers; ?></p>
            </div>
            <div class="card">
                <h3>Active Members</h3>
                <p><?php echo $activeMembers; ?></p>
            </div>
        </div>
        <!-- List of Members -->
<h2>Members List</h2>
<div class="search-container">
    <form method="GET" action="homeadmin.php">
        <!-- <label for="status">Search by Membership Status:</label> -->
        <select id="status" name="status">
            <option value="">-- Select Status --</option>
            <option value="Active" <?php echo isset($_GET['status']) && $_GET['status'] === 'Active' ? 'selected' : ''; ?>>Active</option>
            <option value="Inactive" <?php echo isset($_GET['status']) && $_GET['status'] === 'Inactive' ? 'selected' : ''; ?>>Inactive</option>
        </select>
        <button type="submit">Search</button>
    </form>
</div>

<table class="table1">
    <thead>
        <tr>
            <th>Member ID</th>
            <th>Name</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Include your database connection
        include 'config.php';

        // Base query
        $query = "SELECT MemberID, Name, MembershipStatus FROM Member";

        // Apply filtering if status is selected
        if (isset($_GET['status']) && !empty($_GET['status'])) {
            $status = $_GET['status'];
            $query .= " WHERE MembershipStatus = ?";
        }

        $stmt = $conn->prepare($query);

        // Bind parameter if filtering is applied
        if (isset($status)) {
            $stmt->bind_param("s", $status);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        // Check if any rows are found
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['MemberID']) . "</td>
                        <td>" . htmlspecialchars($row['Name']) . "</td>
                        <td class='" . ($row['MembershipStatus'] === 'Active' ? 'status-active' : 'status-inactive') . "'>" .
                            htmlspecialchars($row['MembershipStatus']) . "
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No results found.</td></tr>";
        }

        $stmt->close();
        ?>
    </tbody>
</table>
        <!-- Tournament Table Section -->
    <h2>Tournament List</h2>
    
<div class="kotakform">
        <button class="add-button" id="open-modal">Add Tournament</button>
    </div>
    
    <table class="table2">
        <thead>
            <tr>
                <th>No. ID</th>
                <th>Tournament</th>
                <th>Date</th>
                <th>Manage</th>
            </tr>
        </thead>
        <tbody>
    <?php
    // Fetch tournaments from the database
    $query = "SELECT * FROM Tournament";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['TournamentID']}</td>
                    <td>{$row['TournamentName']}</td>
                    <td>{$row['TournamentDate']}</td>
                    <td>
                        <a href='edittour.php?tournamentID={$row['TournamentID']}' class='btn btn-edit'>Edit</a>
                        <a href='?delete={$row['TournamentID']}' class='btn btn-delete' onclick='return confirm(\"Are you sure you want to delete this tournament?\");'>Delete</a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No tournaments found.</td></tr>";
    }
    ?>
</tbody>
    </table>
    </div>    

    <!-- Modal -->
    <div class="modal" id="modal">
        <div class="modal-content">
            <span class="close" id="close-modal">&times;</span>
            <h2>Add Tournament</h2>
            <form action="adminaddtour.php" method="POST" enctype="multipart/form-data">
                <label for="name">Tournament Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="date">Tournament Date:</label>
                <input type="date" id="date" name="date" required>

                <label for="image">Tournament Image:</label>
                <input type="file" id="image" name="image" accept="image/*" required>

                <button type="submit">Add Tournament</button>
            </form>
        </div>
    </div>

    <script>
        // JavaScript to control the modal
        const modal = document.getElementById('modal');
        const openModal = document.getElementById('open-modal');
        const closeModal = document.getElementById('close-modal');

        openModal.addEventListener('click', () => {
            modal.style.display = 'flex';
        });

        closeModal.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        // Close the modal when clicking outside of it
        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });
    </script>

</body>
</html>
