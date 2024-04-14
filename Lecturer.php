<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Style/Dashboard.css">
    <title>Lecturers</title>
</head>
<body>
    <header>
        <img id="logo" src="/Resources/logo.png">
        <h1>University of Common Wealth Caribbean</h1>
        <a id="Logout" class="btn" href="AdminLogin.html">Logout</a>
    </header>
    <nav>
        <div class="sidebar">
            <h2>Lecturer Add/Drop</h2>
            <a href="Courses.php" class="btn" id="linkBtn">Available Courses</a>
            <a href="Lecturer.php" class="btn" id="linkBtn">Current Lecturers</a>
            <a href="StudentDisplay.html" class="btn" id="linkBtn">Current Students</a>
            <a href="Course Schedule.html" class="btn" id="linkBtn">Course Schedule</a>
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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Position</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Database configuration
                $servername = "localhost";
                $username = "your_username";
                $password = "your_password";
                $database = "your_database_name";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $database);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch lecturers from the database
                $sql = "SELECT * FROM lecturers";
                $result = $conn->query($sql);

                // Display lecturers in the table
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['Department'] . "</td>";
                        echo "<td>" . $row['Position'] . "</td>";
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
