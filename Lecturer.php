<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Style/Dashboard.css">
    <title>Lecturers</title>
</head>
<body>
    <div class="blur-background"></div>
    <header>
        <img id="logo" src="/Resources/logo.png">
        <h1>University of Common Wealth Caribbean</h1>
        <a id="Logout" class="btn" href="AdminLogin.html">Logout</a>
    </header>
    <nav>
        <div class="sidebar">
            <h2>Lecturer Add/Drop</h2>
            <a href="Courses.php" class="btn" id="linkBtn">Available Courses</a>
            <a href="StudentDisplay.php" class="btn" id="linkBtn">Current Students</a>
            <a href="Course Schedule.php" class="btn" id="linkBtn">Course Schedule</a>
            <a href="course-enrollment.html" class="btn" id="linkBtn">Course Enrollment</a>
            <a onclick="history.back()" class="back" id="back">Go Back</a>
        </div>
    </nav>
    <main>
        <h2>Lecturers</h2>
        <a id="add-lecturer-btn" class="btn">Add Lecturer</a>
        <a id="delete-lecturer-btn" class="btn">Fire Lecturer</a>
        <table id="lecturers-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Department</th>
                    <th>Position</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Database configuration
                include 'db_connection.php';

                // Fetch lecturers from the database
                $sql = "SELECT * FROM lecturer_database";
                $result = $conn->query($sql);

                // Display lecturers in the table
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['lecturer_ID'] . "</td>";
                        echo "<td>" . $row['lecturer_title'] . "</td>";
                        echo "<td>" . $row['lecturer_firstname'] . "</td>";
                        echo "<td>" . $row['lecturer_lastname'] . "</td>";
                        echo "<td>" . $row['lecturer_department'] . "</td>";
                        echo "<td>" . $row['lecturer_position'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "0 results";
                }

                // Close connection
                $conn->close();
                ?>
                <!-- Lecturers will be displayed here -->
            </tbody>
        </table>
    </main>
    
</body>
</html>
