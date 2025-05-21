<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Login</title>
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

        .login-container {
            background-color: rgba(255, 255, 255, 0.9); /* Slight transparency */
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            width: 400px;
            text-align: center;
        }

        .login-container h1 {
            font-size: 32px;
            font-weight: bold;
            color: maroon;
            margin-bottom: 20px;
        }

        .login-container label {
            font-size: 16px;
            color: #333;
            display: block;
            text-align: left;
            margin-bottom: 8px;
        }

        .login-container input {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
        }

        .login-container button {
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
            margin-bottom: 10px;
        }

        .login-container button:hover {
            background-color: goldenrod;
            transform: scale(1.05);
        }

        .login-container a {
            color: maroon;
            text-decoration: none;
            font-size: 16px;
        }

        .login-container a:hover {
            text-decoration: underline;
        }

        .login-container b {
            font-size: 16px;
            color: maroon;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Member Login</h1>
        <form action="memberprocess.php" method="POST">
            <form action="member_login_process.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>

            <button type="submit">Log In</button>
        </form>
        <a href="loginselection.php">Back to Login Selection</a><br>
        <b>Don't have an account yet?</b>
        <a href="memberregister.php">Register here.</a>
    </div>
</body>
</html>
