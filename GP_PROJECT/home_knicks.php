<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Knicks</title>
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
    margin: 0;
    padding: 0;
    height: 455%; /* Ensures the height is 100% of the viewport */
    font-family: 'Roboto', sans-serif;
  }

  body {
    font-family: 'Roboto', sans-serif;
    font-size: 14px;
    line-height: 1.5;
    color: #000;
    background: linear-gradient(rgba(0, 0, 0, 1.5), rgba(0, 0, 0, 0.8)), url('https://ohmyfacts.com/wp-content/uploads/2024/11/28-facts-about-netball-1730515319.jpg'); /* Add background image dynamically, gelapkan gambar sikit */
    background-size: cover;
    background-position: center; 
    background-repeat: no-repeat;
    margin: 0;
    padding: 0;
    height: 100%; /* Ensures the height is 100% of the viewport */
    font-family: 'Roboto', sans-serif;
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
    flex: 1; /* Makes the container expand to fill available space */
    width: 100%;
    padding: 20px;
    text-align: center;
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
        /* Styling for the Club Section */
        .club-container {
            margin: 50px auto;
            max-width: 1400px;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            position: relative;
            top: 40px;
        }

        .club-logo {
            width: 150px;
            height: auto;
            border-radius: 50%;
            margin-bottom: 20px;
/*            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);*/
            transition: transform 0.5s ease; /* Add subtle scale effect */
    }

    .club-container:hover .club-logo {
        transform: scale(1.2); /* Slightly enlarges the logo on hover */
    }

        .club-container h2 {
            font-size: 60px;
            font-weight: bold;
            margin-bottom: 20px;
            font-family: 'Playfair Display', serif;
            color: gold;
        }

        .club-container p {
            font-size: 18px;
            line-height: 1.6;
            font-family: 'Roboto', sans-serif;
            color: gold;
            font-weight: bold;
            text-align: center;
        }

        .vision-mission {
            display: flex;
            margin-top: 50px;
            flex-direction: column;
            gap: 15px;
        }
        .vision {
/*            background: maroon;*/
            padding: 15px; /* Reduced padding for smaller boxes */
            border-radius: 8px;
            flex: none; /* Prevents the items from stretching */
            text-align: center;
            transition: background 0.5s ease-in-out, color 0.5s ease-in-out;
/*            max-width: 800px; /* Limits the width of the boxes */
            margin: 0 auto; /* Centers the boxes */
            height: 250px; /* Ensure consistent height for all cards */
            width: 500px;
        }
        .vision h3 {
            font-size: 40px;
            font-weight: bold;
            margin-bottom: 15px;
            font-family: 'Playfair Display', serif;
            color: gold;
            margin-bottom: 10px;
        }
        .mission h3 {
            font-size: 40px;
            font-weight: bold;
            margin-bottom: 15px;
            font-family: 'Playfair Display', serif;
            color: gold;
            text-align: center;
        }
        .vision p {
            font-size: 20px;
            line-height: 1.6;
            color: gold;
            font-weight: bold;
            text-align: center;
        }
.kotakmissionbesor {
    display: flex;
    flex-direction: row; /* Ensures items stack horizontally */
/*    background: maroon;*/
    padding: 5px; 
    border-radius: 8px;
    text-align: center;
/*    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);*/
    transition: background 0.5s ease-in-out, color 0.5s ease-in-out;
    width: auto; /* Adjusts to fit the child boxes */
    justify-content: center; /* Centers the child boxes horizontally */
    align-items: center; /* Aligns child boxes vertically */
}

.kotakmission1, .kotakmission2, .kotakmission3, .kotakmission4 {
/*    background: maroon;*/
    padding: 15px; 
    text-align: center;
    /*box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);*/
    transition: background 0.5s ease-in-out, color 0.5s ease-in-out;
    margin: 0px 0; /* Adds vertical space between items */
    width: 350px;
    position: relative;
}

.kotakmission p, .kotakmission1 p, .kotakmission2 p, .kotakmission3 p, .kotakmission4 p {
    font-size: 18px;
    line-height: 1.6;
    color: gold;
    font-weight: bold;
    text-align: left;
    transition: background 0.5s ease-in-out, color 0.5s ease-in-out;
}

.kotakmission3:hover, .kotakmission4:hover {
    background: goldenrod;
}
.kotakmission1:hover, .kotakmission2:hover {
    background: goldenrod;
}
.kotakmission3:hover p, .kotakmission4:hover p {
    color: maroon;
}
.kotakmission1:hover p, .kotakmission2:hover p {
    color: maroon;
}
</style>
<style>
        .knicks-container {
            margin: 30px auto;
            margin-top: 80px;
            max-width: 1000px;
            padding: 5px;
            background: maroon;
            border-radius: 40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            /*transition: background 2s ease;  Smooth and slow transition */
        }
/*      .knicks-container:hover {
            background: linear-gradient(45deg, maroon, goldenrod);
            transition: 0.5s ease;
        }*/

        .knicks-container h2 {
            color: gold;
            font-size: 40px;
            font-weight: bold;
            font-family: 'Playfair Display', serif;
            text-align: center; /* Center horizontally */
            vertical-align: middle; /* Center vertically */
            margin-bottom: 5px;
            /*-webkit-text-stroke: 0.2px black;  Outline color and width */
        }
        .knicks-container h2:hover {
        color: gold;
        }
        .knicks-container1 {
            margin: 30px auto;
/*            margin-top: 80px;*/
            max-width: 1000px;
/*            padding: 5px;*/
/*            background: maroon;*/
            border-radius: 8px;
/*            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);*/
            text-align: center;
            /*transition: background 2s ease;  Smooth and slow transition */
        }
        .knicks-container1 h2 {
            color: gold;
            font-size: 80px;
            font-weight: bold;
            font-family: 'Playfair Display', serif;
            text-align: center; /* Center horizontally */
            vertical-align: middle; /* Center vertically */
            /*-webkit-text-stroke: 0.2px black;  Outline color and width */
        }
        .knicks-container1 h2:hover {
        color: gold;
        }
       .knicks-container2 {
            margin: 30px auto;
            margin-top: 80px;
            max-width: 740px;
            padding: 5px;
            background: maroon;
            border-radius: 40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
      .knicks-container2:hover {
            background: linear-gradient(45deg, maroon, goldenrod);
            transition: background 2s ease-in-out;  
/*            Smooth and slow transition */
        }

        .knicks-container2 h2 {
            color: gold;
            font-size: 40px;
            font-weight: bold;
            font-family: 'Playfair Display', serif;
            text-align: center; /* Center horizontally */
            vertical-align: middle; /* Center vertically */
            margin-bottom: 5px;
            /*-webkit-text-stroke: 0.2px black;  Outline color and width */
        }
        .knicks-container2 h2:hover {
        color: gold;
        }

        .knicks-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); /* Responsive grid */
        gap: 20px; /* Space between items */
        justify-content: center; /* Centers the grid horizontally */
        width: 50%; /* Ensures grid takes full width of the container */
        max-width: 1000px; /* Limits the width of the grid */
        margin: 0 auto; /* Centers the grid container */
        }

        .knicks-grid1 {
        display: grid;
        grid-template-columns: repeat(2, 1fr); /* Creates 2 columns per row */
        gap: 20px; /* Space between items */
        justify-content: center; /* Centers the grid horizontally */
        width: 60%; /* Ensures grid takes full width of the container */
        max-width: 1000px; /* Limits the width of the grid */
        margin: 20px auto; /* Centers the grid container */
        }

        .knicks-grid2 {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); /* Responsive grid */
        gap: 20px; /* Space between items */
        justify-content: center; /* Centers the grid horizontally */
        width: 800px; /* Ensures grid takes full width of the container */
        max-width: 1000px; /* Limits the width of the grid */
        margin: -35px auto; /* Centers the grid container */
        }

        .knicks-item {
/*            background: palegoldenrod;*/
           /* border: 1px solid #ddd;*/
            border-radius: 15px;
            padding: 10px;
            text-align: center;
            transition: background 0.5s ease-in-out;
        }
        .knicks-item:hover {
            background: goldenrod;
            transition: 0.5s ease-in-out;
        }
        .knicks-item2 {
/*            background: palegoldenrod;*/
           /* border: 1px solid #ddd;*/
            border-radius: 15px;
            padding: 20px;
            text-align: center;
/*            transition: background 0.5s ease-in-out;*/
            margin-bottom: 20px;
        }
/*        .knicks-item2:hover {
            background: goldenrod;
        }*/
        .knicks-image1 {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 0px;
        }
        .knicks-image2 {
            max-width: 100%;
            height: 500px;
            border-radius: 8px;
            margin-bottom: 40px;
        }

        .knicks-image {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 10px;
            object-fit: cover; /* Ensures the image fills its container without distortion */
            max-height: 1000px; /* Set a maximum height to control the zoom level */
        }
        .button-container {
        display: flex; /* Centers the button horizontally */
        justify-content: center; /* Aligns the button in the middle of the container */
        align-items: center; /* Vertically centers the button */
        margin-bottom: -5px;/* Adjust spacing above */
        margin-top: -5px;/* Adjust spacing below */
    }
        .join-button {
        padding: 10px 20px;
        background: maroon;
        color: gold;
        text-decoration: none;
        border-radius: 5px;
        font-size: 30px;
        font-weight: bold;
        cursor: pointer;
        transition: transform 0.5s ease, background 0.5s ease;
    }

.join-button:hover {
    transform: scale(1.3);
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
<!-- Club Section -->
<div class="container">
    <div class="club-container">
        <img src="image\knicks.jpg" alt="Knicks Netball Club Logo" class="club-logo">
        <h2>Welcome to Knicks Netball Club</h2>
        <p>At the Knicks Netball Club, we believe in more than just the game – we believe in creating a legacy. We are a vibrant and dynamic club dedicated to bringing together individuals who share a passion for netball. Whether you're a seasoned player or just starting, you'll find a supportive community here that encourages growth, celebrates achievements, and builds lasting friendships. Our club offers top-notch training programs, competitive tournaments, and opportunities to engage in community outreach. We aim to empower our members, instilling confidence, discipline, and resilience both on and off the court.</p>
        </div>
   

        <!-- Vision and Mission -->
        <div class="vision-mission">
            <div class="vision">
                <h3>Our Vision</h3>
                <p>"To become a leading netball club renowned for fostering excellence, teamwork, and empowerment, inspiring individuals to achieve their full potential both on and off the court."</p>
            </div>
            <div class="mission">
    <h3>Our Mission</h3>
    <div class="kotakmissionbesor">
        <div class="kotakmission1">
            <p>To provide a supportive and inclusive environment where netball enthusiasts of all levels can thrive.</p>
        </div>
        <div class="kotakmission2">
            <p>To promote physical fitness, teamwork, and sportsmanship through dynamic training and competitive opportunities.</p>
        </div>
        <div class="kotakmission3">
            <p>To build lasting connections and a strong sense of community among players, staff, and supporters.</p>
        </div>
        <div class="kotakmission4">
            <p>To nurture leadership, discipline, and confidence in our members, preparing them for challenges on and beyond the netball court.</p>
        </div>
    </div>
</div>
</div>


<div class="knicks-container2">
        <h2>Game Highlights</h2>
    </div>
        <div class="knicks-grid1">
    <div class="knicks-item">
        <img src="image\bushie.jpg" alt="Item 1" class="knicks-image">
    </div>
    <div class="knicks-item">
        <img src="image\bushie1.jpg" alt="Item 2" class="knicks-image">
    </div>
    <div class="knicks-item">
        <img src="image\bushie2.jpg" alt="Item 3" class="knicks-image">
    </div>
    <div class="knicks-item">
        <img src="image\bushie3.jpg" alt="Item 4" class="knicks-image">
    </div>
</div>

<div class="knicks-container">
        <h2>Let's Meet Knicks Family</h2>
    </div>
        <div class="knicks-grid">
            <!-- Merchandise 1 -->
            <div class="knicks-item">
                <img src="image\knicksfam.jpg" alt="Jersey Knicks" class="knicks-image1">
            </div>
        </div>
</div>

<div class="knicks-container1">
        <h2>Let's Join Us !</h2>
    </div>
        <div class="knicks-grid2">
            <!-- Merchandise 1 -->
            <div class="knicks-item2">
                <img src="image\jerseytour.png" alt="Jersey Knicks" class="knicks-image2">
                <div class="button-container">
                <a href="homemember.php" class="join-button">JOIN US</a></div>
            </div>
        </div>
</div>


</body>
</html>
