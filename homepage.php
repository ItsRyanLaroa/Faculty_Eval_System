
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Evaluation System</title>
    <link rel="stylesheet" href="css/homepage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
</head>
<body>
<header>
        <div class="container">
            <div class="navbar-header">
                <a href="homepage.php" class="navbar-logo">
                    <img src="images/feslogo.png" width="70" height="70">
                </a>
                <div class="logo-text">
                    <span class="logo_title">
                        Faculty Evaluation System
                    </span>
                    <span class="logo_subtitle">
                        St. Cecilia's College, Cebu - Inc.
                    </span>
                </div>
                <ul class="nav-navbar">
                    <li>
                        <a href="homepage.php">Home</a>
                    </li>
                    <li>
                        <a href="about-us.php">About</a>
                    </li>
                    <li>
                        <a href="#My Account">My Account</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <div style="min-height:400px; padding-bottom:10px;">
        <div class="pattern">
            <div class="container">
                <div class="row">
                    <div class="left-column">
                        <div class="overview">
                            <h2 style="font-size: 48px; font-weight: bold;">Faculty Evaluation System</h2>
                            <p style="font-size: 25px;">Students and teachers can now evaluate through this tool.</p>
                            <ul class="overview-list">
                                <li>
                                <i class="fa-solid fa-circle-check"></i>
                                    Students can evaluate teachers of subjects they enrolled in a semester.
                                </li>
                                <li>
                                <i class="fa-solid fa-circle-check"></i>
                                    Faculty can evaluate his/her colleagues in his/her respective department.
                                </li>
                                <li>
                                <li>
                                <i class="fa-solid fa-circle-check"></i>
                                    Faculty can evaluate their dean's department.
                                </li>
                                <li>
                            </ul>
                        </div>
                        <div class="button">
                            <button class="logBtn">Login</button>
                            <button class="regBtn">Register</button>
                        </div>
                    </div>
                    <div class="right-column">
                    <div class="slides">
                        <input type="radio" name="radio-btn" id="radio1" checked>
                        <input type="radio" name="radio-btn" id="radio2">
                        <input type="radio" name="radio-btn" id="radio3">
                        <div class="slide first">
                            <img src="images/assessment4.jpg" alt="">
                        </div>
                        <div class="slide">
                            <img src="images/assessment.jpg" alt="">
                        </div>
                        <div class="slide">
                            <img src="images/assessment3.jpg" alt="">
                        </div>

                        <div class="navigation-auto">
                            <div class="auto-btn1"></div>
                            <div class="auto-btn2"></div>
                            <div class="auto-btn3"></div>
                        </div>
                    </div>
                    <div class="navigation-manual">
                        <label for="radio1" class="manual-btn"></label>
                        <label for="radio2" class="manual-btn"></label>
                        <label for="radio3" class="manual-btn"></label>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="check-list">
        <div class="first-row">
            <i class="fa-solid fa-circle-dot"></i>
            <div class="text-columns">
                <div class="column1">
                    <h3>Students</h3>
                </div>
                <div class="column2">
                    <p>Students can assess the teachers of the subjects they are taking this semester.</p>
                </div>
            </div>
        </div>
        <div class="second-row">
            <i class="fa-solid fa-circle-dot"></i>
            <div class="text-columns">
                <div class="column1">
                    <h3>Faculty</h3>
                </div>
                <div class="column2">
                    <p>Faculty teachers can evaluate their colleagues within their own department.</p>
                </div>
            </div>
        </div>
        <div class="third-row">
            <i class="fa-solid fa-circle-dot"></i>
            <div class="text-columns">
                <div class="column1">
                    <h3>Teachers</h3>
                </div>
                <div class="column2">
                    <p>Teachers can evaluate their dean.</p>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="footer-pattern">
            <div class="footer-container">
                <div class="footer-text">
                    <h6>Faculty Evaluation System. All rights reserved.</h6>
                </div>
            </div>
        </div>
    </footer>

    <script type="text/javascript">
    
    var counter = 2;
    setInterval(function(){
        document.getElementById('radio' + counter).checked = true;
        counter++;
        if(counter > 3){
            counter = 1;
        }
    }, 5000);

</script> 
</body>
</html>