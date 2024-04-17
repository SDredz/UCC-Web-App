<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/Style/Dashboard.css">
        <title>UCC Dashboard</title>
        <style>
             /* adjusts main element on a page by page basis */
            main {
                max-width: 900px;
                /* position: fixed; */
                margin: 10% auto;
                /* margin-left: 20%; */
                padding: 20px;
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
            main h2 {
                color: #333;
                font-size: 30px;
                margin-bottom: 10px;
                text-align: center;
            }
        </style>
       <script>
        // Function to parse URL parameters
        function getParameterByName(name, url) {
            if (!url) url = window.location.href;
            name = name.replace(/[\[\]]/g, "\\$&");
            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, " "));
        }

        // Function to display message as a popup
        function displayMessage() {
            var message = getParameterByName('message');
            var studentId = getParameterByName('student_id');
            var lecturerId = getParameterByName('lecturer_ID');
            if (message || studentId) {
                var alertText = "";
                if (message) {
                    alertText += message + "\n";
                }
                if (studentId) {
                    alertText += "Your student ID is: " + studentId;
                }
                if (lecturerId) {
                    alertText += "Your lecturer ID is: " + lecturerId;
                }
                alert(alertText);
            }
        }

        // Call the function when the page loads
        window.onload = function() {
            displayMessage();
        };
        </script>

    </head>
    <body>
        <div class="blur-background"></div>
        <header>
            <img id="logo" src = "/Resources/logo.png">
            <h1>University of Common Wealth Caribbean</h1>
            <a id="Logout" class="btn" href="UCC_Register.php">Logout</a>
        </header>
        
        <!-- <nav>
            <div class="sidebar">
                <h2>Lecturer Add/Drop</h2>
                <a href="Courses.php" class="btn" id="linkBtn">Available Courses</a>
                <a href="Lecturer.php" class="btn" id="linkBtn">Current Lecturers</a>
                <a href="StudentDisplay.php" class="btn" id="linkBtn">Current Students</a>
                <a href="Course Schedule.php" class="btn" id="linkBtn">Course Schedule</a>
                <a href="course-enrollment.html" class="btn" id="linkBtn">Course Enrollment</a>
                <a onclick="history.back()" class="back" id="back">Go Back</a>
            </div> 
        </nav> -->
        <main>
            <h2>Welome to UCC!</h2>
            <nav>
                <ul>
                    <li><a href="Courses.php">Available Courses</a></li>
                    <li><a href="Lecturer.php">Current Lecturers</a></li>
                    <li><a href="Course Schedule.php">Course Schedule</a></li>
                    <li><a href="CourseEnrollment.php">Course Enrollment</a></li>
                </ul>
            </nav>
        </main>
    </body>
</html>