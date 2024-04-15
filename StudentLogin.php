<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Style/Dashboard.css">
    <title>UCC Student Login</title>
    <style>
        main {
            max-width: 1000px;
            margin: 40px auto;
            padding: 20px;
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
    </header>
    <main>
        <h2>Student Login</h2>
        <form id="Student-login-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="Student-name">Student Name:</label>
            <input type="text" id="Student-name" name="Student_name" required>

            <label for="Student-password">Password:</label>
            <input type="password" id="Student-password" name="Student_password" required>

            <button type="submit">Login</button>
        </form>
    </main>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

        // Get username and password from the form
        $username = $_POST["Student_name"];
        $password = $_POST["Student_password"];

        // Prepare SQL statement to select user
        $sql = "SELECT * FROM login_stu_cred WHERE student_id = ? AND pass_word = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);

        // Execute SQL statement
        $stmt->execute();

        // Get result
        $result = $stmt->get_result();

        // Check if user exists
        if ($result->num_rows > 0) {
            echo "<p>Logged in!</p>";
        } else {
            echo "<p>Invalid username or password</p>";
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>
