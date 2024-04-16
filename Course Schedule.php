<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/Style/Dashboard.css">
        <title>Search for a Course Schedule</title>
    </head>
    <body>
        <div class="blur-background"></div>
        <header>
            <img id="logo" src = "/Resources/logo.png">
            <h1>University of Common Wealth Caribbean</h1>
            <a id="Logout" class="btn" href="UCC_Register.php">Logout</a>
        </header>
        <nav>
            <div class="sidebar">
                <h2>Course Schedule</h2>
                <a href="Courses.php" class="btn" id="linkBtn">Available Courses</a>
                <a href="Lecturer.php" class="btn" id="linkBtn">Current Lecturers</a>
                <a href="StudentDisplay.php" class="btn" id="linkBtn">Current Students</a>
                <a href="CourseEnrollment.php" class="btn" id="linkBtn">Course Enrollment</a>
                <a onclick="history.back()" class="back" id="back">Go Back</a>
            </div>
        </nav>
        <main>
            <!-- <h1>Search for a Course Schedule</h1>
            <form action="/search" method="post">
                <label for="course_code">Course Code:</label>
                <input type="text" id="course_code" name="course_code" required>
                <br>
                <label for="lecturer_id">Lecturer ID:</label>
                <input type="text" id="lecturer_id" name="lecturer_id" required>
                <br>
                <button type="submit">Search</button>
            </form> -->
            <h2>Course Schedule</h2>
            <!-- <form method="post">
                <label for="search_input">Search:</label>
                <input type="text"  placeholder="Course..." name="search_input" id="search_input">
                <select name="course_code">
                    <option value="Human Resources">Human Resources</option>
                    <option value="Business Administration">Business Administration</option>
                </select>
                <button type="submit">Search</button>
            </form> -->

        <table id="students-table">
            <thead>
                <tr>
                    <th>Coruse Code</th>
                    <th>Lecturer ID</th>
                    <th>Year</th>
                    <th>Semester</th>
                    <th>Section</th>
                    <th>Day</th>
                    <th>Time</th>
                    <th>Location</th>
                </tr>
            </thead>
            <tbody id="students-table-body">
                <?php
                // Database configuration
                include 'db_connection.php';
                
                // Fetch students from the database
                $sql = "SELECT * FROM course_schedule";
                $result = $conn->query($sql);

                // Display students in the table
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['course_code'] . "</td>";
                        echo "<td>" . $row['lecturer_ID'] . "</td>";
                        echo "<td>" . $row['semesteryear'] . "</td>";
                        echo "<td>" . $row['semester'] . "</td>";
                        echo "<td>" . $row['section'] . "</td>";
                        echo "<td>" . $row['course_day'] . "</td>";
                        echo "<td>" . $row['course_time'] . "</td>";
                        echo "<td>" . $row['location'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No Courses found found</td></tr>";
                }

                // Close connection
                $conn->close();
                ?>
            </tbody>
        </table>
        </main>    
    </body>
</html>