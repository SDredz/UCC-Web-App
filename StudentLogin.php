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
            if (message) {
                alert(message);
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
        <img id="logo" src="/Resources/logo.png">
        <h1>University of Common Wealth Caribbean</h1>
    </header>
    <main>
        <h2>Student Login</h2>
        <form id="Student-login-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="Student-id">Student ID:</label>
            <input type="text" id="Student-id" name="student_id" required>

            <label for="Student-password">Password:</label>
            <input type="password" id="Student-password" name="Student_password" required>

            <button type="submit">Login</button>
        </form>
    </main>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Database configuration
        include 'db_connection.php';

        // Get username and password from the form
        $username = $_POST["student_id"];
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
            header("Location: Dashboard.php?message=" . urlencode("Student logged in successfully!"));
            exit();
        } else {
            header("Location: StudentLogin.php?message=" . urlencode("Invalid Username Or Password"));
            exit();
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>
