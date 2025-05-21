<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
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
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            width: 400px;
            text-align: center;
        }

        .container h2 {
            font-size: 32px;
            font-weight: bold;
            color: maroon;
            margin-bottom: 30px;
        }

        .container label {
            font-size: 16px;
            color: #333;
            margin-bottom: 8px;
            display: block;
            text-align: left;
        }

        .container input {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
        }

        .container button {
            width: 100%;
            padding: 15px;
            background-color: maroon;
            color: white;
            font-size: 18px;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .container button:hover {
            background-color: goldenrod;
            transform: scale(1.05);
        }

        .container .link {
            margin-top: 15px;
            font-size: 16px;
            color: maroon;
            text-decoration: none;
        }

        .container .link:hover {
            text-decoration: underline;
        }

        .container a {
            display: block;
            margin-top: 10px;
            font-size: 16px;
            color: maroon;
            text-decoration: none;
        }

        .container a:hover {
            text-decoration: underline;
        }

/*        @media screen and (max-width: 768px) {
            .container {
                width: 90%;
            }

            .container h2 {
                font-size: 28px;
            }

            .container button {
                padding: 10px;
                font-size: 16px;
            }
        }*/
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Login</h2>
        <form action="adminprocess.php" method="POST">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" placeholder="Enter your email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>

            <button type="submit">Login</button>
        </form>
        <a href="loginselection.php" class="link">Back to Login Selection</a>
    </div>
</body>
</html>
