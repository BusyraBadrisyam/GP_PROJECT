<?php
include 'config.php';

// Fetch tournament details
if (isset($_GET['tournamentID'])) {
    $tournamentID = intval($_GET['tournamentID']);
    $query = "SELECT * FROM Tournament WHERE TournamentID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $tournamentID);
    $stmt->execute();
    $result = $stmt->get_result();
    $tournament = $result->fetch_assoc();
    if (!$tournament) {
        die("Tournament not found.");
    }
} else {
    die("Invalid request. Tournament ID is missing.");
}

// Update tournament details
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $date = $_POST['date'];

    // Handle file upload if a new image is provided
    if (!empty($_FILES["image"]["name"])) {
        $targetDir = "image/";
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $imageURL = $targetFile;
        } else {
            echo "<script>alert('Error uploading image.');</script>";
            $imageURL = $tournament['ImageURL']; // Fallback to existing image
        }
    } else {
        $imageURL = $tournament['ImageURL']; // Keep the existing image
    }

    $updateQuery = "UPDATE Tournament SET TournamentName = ?, TournamentDate = ?, ImageURL = ? WHERE TournamentID = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("sssi", $name, $date, $imageURL, $tournamentID);

    if ($stmt->execute()) {
        echo "<script>alert('Tournament updated successfully!'); window.location.href = 'homeadmin.php';</script>";
    } else {
        echo "<script>alert('Error updating tournament: " . $conn->error . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tournament</title>
    <style>
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.8)), url('https://ohmyfacts.com/wp-content/uploads/2024/11/28-facts-about-netball-1730515319.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: maroon; /* Slight transparency */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 400px;
            text-align: center;
        }
        .container h2 {
            color: gold;
            font-size: 35px;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .container p {
            color: gold;
            font-size: 16px;
            margin-bottom: 20px;
            font-weight: bold;
        }
        label {
            display: block;
            font-size: 18px;
            font-weight: bold;
            color: gold;
            margin-bottom: 10px;
            text-align: left;
        }
        input[type="text"],
        input[type="date"] {
            width: 95%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        input[type="file"] {
            width: 95%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            color: gold;
        }
        img {
            border-radius: 5px;
            margin: 10px 0;
            margin-bottom: 20px;
        }
        button {
            padding: 12px 20px;
            background: goldenrod;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            transition: background 0.3s ease;
        }
        button:hover {
            background: goldenrod;
            color: maroon;
        }
        .back-button {
            background-color: goldenrod;
            color: white;
            margin-bottom: 10px;
            width: 20%;
            position: relative;
            right: 160px;
        }
        .back-button:hover {
            background-color: goldenrod;
            color: maroon;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Tournament</h2>
         <!-- Back Button -->
        <button class="back-button" onclick="window.location.href='homeadmin.php';">Back</button>
        <form action="edittour.php?tournamentID=<?php echo $tournamentID; ?>" method="POST" enctype="multipart/form-data">
            <label for="name">Tournament Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($tournament['TournamentName']); ?>" required>

            <label for="date">Tournament Date:</label>
            <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($tournament['TournamentDate']); ?>" required>

            <label for="image">Tournament Image:</label>
            <input type="file" id="image" name="image" accept="image/*">
            <p>Current Image:</p>
            <img src="<?php echo htmlspecialchars($tournament['ImageURL']); ?>" alt="Tournament Image" style="width: 100px;">

            <button type="submit">Update Tournament</button>
        </form>
    </div>
</body>
</html>
