<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Style/Dashboard.css">
    <title>UCC Students</title>
    <style>
        /* adjusts main element on a page by page basis */
        main {
                max-width: 1400px;
                /* margin: 40px auto;
                padding: 20px; */
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
    </style>
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
            <a href="Course Schedule.php" class="btn" id="linkBtn">Course Schedule</a>
            <a href="CourseEnrollment.php" class="btn" id="linkBtn">Course Enrollment</a>
            <a onclick="history.back()" class="back" id="back">Go Back</a>
        </div>
    </nav>
    <main>
        <h2>Current Students</h2>
        <!-- <input type="text" id="search-input" placeholder="Search for a student..."> -->
        <table id="students-table">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Full Name</th>
                    <!-- <th>Middle</th>
                    <th>Last</th> -->
                    <th>Personal Email</th>
                    <th>School Email</th>
                    <th>Home Address</th>
                    <th>Home Contact</th>
                    <th>Work Contact</th>
                    <th>Mobile Contact</th>
                    <th>Next of Kin</th>
                    <th>NOK Contact</th>
                    <th>Program</th>
                    <th>GPA</th>
                </tr>
            </thead>
            <tbody id="students-table-body">
                <?php
                // Database configuration
                include 'db_connection.php';

                // Fetch students from the database
                $sql = "SELECT * FROM students";
                $result = $conn->query($sql);

                // Display students in the table
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['student_id'] . "</td>";
                        echo "<td>" . $row['first_name'] . " " .$row['middle_name'] .  " " .$row['last_name'] . "</td>";
                        // echo "<td>" . $row['middle_name'] . "</td>";
                        // echo "<td>" . $row['last_name'] . "</td>";
                        echo "<td>" . $row['personal_email'] . "</td>";
                        echo "<td>" . $row['student_email'] . "</td>";
                        echo "<td>" . $row['home_address'] . "</td>";
                        echo "<td>" . $row['home_contact'] . "</td>";
                        echo "<td>" . $row['work_contact'] . "</td>";
                        echo "<td>" . $row['mobile_contact'] . "</td>";
                        echo "<td>" . $row['next_of_kin'] . "</td>";
                        echo "<td>" . $row['nok_contact'] . "</td>";
                        echo "<td>" . $row['program'] . "</td>";
                        echo "<td>" . $row['gpa'] . "</td>";
                        echo "</tr>";
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
