<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Style/Dashboard.css">
    <title>UCC Students</title>
</head>
<body>
    <div class="blur-background"></div>
    <header>
        <img id="logo" src="/Resources/logo.png">
        <h1>University of Common Wealth Caribbean</h1>
        <a id="Logout" class="btn" href="UCC_Register.php">Logout</a>
    </header>
    <nav>
        <div class="sidebar">
            <h2>Lecturer Add/Drop</h2>
            <a href="Courses.php" class="btn" id="linkBtn">Available Courses</a>
            <a href="Lecturer.php" class="btn" id="linkBtn">Current Lecturers</a>
            <a href="StudentDisplay.php" class="btn" id="linkBtn">Current Students</a>
            <a href="Course Schedule.php" class="btn" id="linkBtn">Course Schedule</a>
            <a onclick="history.back()" class="back" id="back">Go Back</a>
        </div>
    </nav>
    <main>
        <h2>Course Enrollment</h2>
        <!-- <input type="text" id="search-input" placeholder="Search for a student..."> -->
        <table id="students-table">
            <thead>
                <tr>
                    <th>Course code</th>
                    <th>Student ID</th>
                    <th>Year</th>
                    <th>Course Grade</th>
                    <th>Exam Grade</th>
                    <th>Project Grade</th>
                </tr>
            </thead>
            <tbody id="coruse-enrol-table-body">
                <?php
                // Database configuration
                include 'db_connection.php';

                // Fetch students from the database
                $sql = "SELECT * FROM course_enrolment";
                $result = $conn->query($sql);

                // Display students in the table
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['course_code'] . "</td>";
                        echo "<td>" . $row['student_id'] . "</td>";
                        echo "<td>" . $row['semesteryear'] . "</td>";
                        echo "<td>" . $row['course_work_grade'] . "</td>";
                        echo "<td>" . $row['final_exam_grade'] . "</td>";
                        echo "<td>" . $row['project_grade'] . "</td>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No students found</td></tr>";
                }

                // Close connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>
