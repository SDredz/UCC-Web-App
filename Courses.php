<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Style/Dashboard.css">
    <title>UCC Courses</title>
</head>
<body>
    <header>
        <img id="logo" src="/Resources/logo.png">
        <h1>University of Common Wealth Caribbean</h1>
        <a id="Logout" class="btn" href="StudentLogin.php">Logout</a>
    </header>
    <nav>
        <div class="sidebar">
            <h2>Lecturer Add/Drop</h2>
            <a href="Courses.php" class="btn" id="linkBtn">Available Courses</a>
            <a href="Lecturer.php" class="btn" id="linkBtn">Current Lecturers</a>
            <a href="StudentDisplay.php" class="btn" id="linkBtn">Current Students</a>
            <a href="CourseSchedule.php" class="btn" id="linkBtn">Course Schedule</a>
            <a href="CourseEnrollment.php" class="btn" id="linkBtn">Course Enrollment</a>
            <a href="javascript:history.back()" class="back" id="back">Go Back</a>
        </div>
    </nav>
    <main>
        <h2>Available Courses</h2>
        <input type="text" id="search-input" placeholder="Search by course code or title...">
        <table id="courses-table">
            <thead>
                <tr>
                    <th>Course Code</th>
                    <th>Title</th>
                    <th>Credits</th>
                    <th>Degree Level</th>
                    <th>Prerequisites</th>
                </tr>
            </thead>
            <tbody id="courses-table-body">
                <?php
                // Establish database connection
                $servername = "localhost";
                $username = "your_username";
                $password = "your_password";
                $database = "your_database_name";

                $conn = mysqli_connect($servername, $username, $password, $database);

                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Fetch courses from database
                $sql = "SELECT * FROM courses";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // Output data of each row
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['course_code'] . "</td>";
                        echo "<td>" . $row['title'] . "</td>";
                        echo "<td>" . $row['credits'] . "</td>";
                        echo "<td>" . $row['degree_level'] . "</td>";
                        echo "<td>" . $row['prerequisites'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No courses found</td></tr>";
                }

                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>
