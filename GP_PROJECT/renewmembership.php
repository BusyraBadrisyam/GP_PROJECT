<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renew Membership</title>
    <style>
        /* General Styles */
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            font-size: 14px;
            line-height: 1.5;
            color: #000;
            background: linear-gradient(rgba(0, 0, 0, 1.0), rgba(0, 0, 0, 0.6)), url('https://ohmyfacts.com/wp-content/uploads/2024/11/28-facts-about-netball-1730515319.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
        }
        .container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 20px;
            margin: 70px auto;
            width: 90%;
            max-width: 600px;
            text-align: center;
            margin-top: 200px;
        }
        .header h1 {
            font-size: 40px;
            margin: 0;
            color: maroon;
            font-weight: bold;
            font-family: 'Playfair Display', serif;
        }
        .form-row {
            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
            text-align: left;
        }
        .form-row label {
            font-weight: bold;
            margin-bottom: 5px;
            font-size: 18px;
            color: maroon;
        }
        .form-row input, .form-row select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background: white;
        }
        .buttons {
            margin-top: 20px;
            text-align: center;
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
        .submit-button {
            background-color: #11bf3d;
        }
        .submit-button:hover {
            background-color: #0f9b2e;
        }
        .back-button {
            background-color: #d30418;
        }
        .back-button:hover {
            background-color: #b00215;
        }
    </style>
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
    <script>
        function calculateAmount() {
            const renewalPeriod = document.getElementById("renewal-period").value;
            const amountField = document.getElementById("amount");
            let totalAmount = 0;

            switch (renewalPeriod) {
                case "3":
                    totalAmount = 100;
                    break;
                case "6":
                    totalAmount = 200;
                    break;
                case "9":
                    totalAmount = 300;
                    break;
                case "12":
                    totalAmount = 400;
                    break;
            }
            amountField.value = totalAmount;
        }

        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("renewal-period").addEventListener("change", calculateAmount);
        });
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
                <a href="staff.php" class="button-text u-select-none">Staff Directory</a>
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
            <h1>Renew Membership</h1>
        </div>
        <form action="payprocess.php" method="POST">
            <div class="form-row">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-row">
                <label for="bank">Payment Type:</label>
                <select id="bank" name="bank" required>
                    <option value="" disabled selected>Select Your Bank</option>
                    <option value="Maybank">Maybank</option>
                    <option value="Bank Islam">Bank Islam</option>
                    <option value="RHB Bank">RHB Bank</option>
                    <option value="CIMB Bank">CIMB Bank</option>
                </select>
            </div>
            <div class="form-row">
                <label for="renewal-period">Renewal Period:</label>
                <select id="renewal-period" name="renewal_period" required>
                    <option value="" disabled selected>Months</option>
                    <option value="3">3 Months</option>
                    <option value="6">6 Months</option>
                    <option value="9">9 Months</option>
                    <option value="12">12 Months</option>
                </select>
            </div>
            <div class="form-row">
                <label for="amount">Amount:</label>
                <input type="number" id="amount" name="amount" readonly>
            </div>
            <div class="buttons">
                <button type="submit" class="submit-button">Pay Now</button>
                <button type="button" class="back-button" onclick="window.location.href='profilemember.php'">Cancel</button>
            </div>
        </form>
    </div>
</body>
</html>
