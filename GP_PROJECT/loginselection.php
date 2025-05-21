<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Selection</title>
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        body {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.5)), url('https://ohmyfacts.com/wp-content/uploads/2024/11/28-facts-about-netball-1730515319.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: floralwhite;
            text-align: center;
        }

        .container {
            background: maroon;
            padding: 50px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 400px;
        }

        h1 {
            font-size: 36px;
            margin-bottom: 30px;
            font-weight: bold;
            color: gold;
        }

        .button-group {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            gap: 20px;
        }

        .button-group a {
            text-decoration: none;
        }

        button {
            padding: 15px 40px;
            margin-bottom: 20px;
            background: gold;
            color: maroon;
            border: none;
            border-radius: 8px;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.3s ease;
        }
        button:hover {
            background: darkgoldenrod;
            transform: scale(1.1);
            color: floralwhite;
        }

       /* @media screen and (max-width: 768px) {
            .container {
                width: 90%;
            }

            button {
                padding: 10px 30px;
                font-size: 18px;
            }
        }*/
        .container a {
            color: gold;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
        }

        .container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>LOGIN AS</h1>
        <div class="button-group">
            <a href="adminlogin.php"><button>Admin</button></a>
            <a href="memberlogin.php"><button>Member</button></a>
        </div>
        <a href="home_knicks.php" class="back-container">Back to Home Page</a>
    </div>
</body>
</html>
