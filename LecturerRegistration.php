<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Meta and CSS links -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/Style/Dashboard.css">
        <title>UCC Lecturer Registration</title>
        <style>
             /* Inline CSS for main element */
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
            <!-- Header with logo and title -->
            <img id="logo" src="/Resources/logo.png">
            <h1>University of Common Wealth Caribbean</h1>
        </header>
        <main>
            <h2>Lecturer Registration</h2>
            <form id="registration-form" method="post">
                <!-- Form fields for lecturer registration -->
                <label for="lecturer-title">Title</label>
                <input type="text" id="lecturer-title" name="lecturer_title" required>

                <label for="lecturer-firstname">First Name:</label>
                <input type="text" id="lecturer-firstname" name="lecturer_firstname" required>

                <label for="lecturer-lastname">Last Name:</label>
                <input type="text" id="lecturer-lastname" name="lecturer_lastname" required>

                <label for="lecturer-deparment">Deparment</label>
                <div id="pdept-options">
                    <select id="lecturer-dept" name="lecturer_department">
                        <option value="Business Administration">Business Administration</option>
                        <option value="Science">Science</option>
                        <option value="Information Technology">Information Technology</option>
                    </select>
                </div>
                <!-- <input type="text" id="lecturer-dept" name="lecturer_department" required> -->

                <label for="lecturer-position">Position:</label>
                <input type="tel" id="lecturer-position" name="lecturer_position" required>                

                <label for="passwd">Password:</label>
                <input type="text" id="passwd" name="pass_word" required>

                <button type="submit" class="btn">Submit</button>
            </form>
            <div style="text-align: center;">
                <button type="button" class="btn" onclick="toggleForm()" style="background-color: #007BFF; color: white; margin-top: 20px; border: none; outline: none;">Close Form</button>
            </div>

            <script>
                function toggleForm() {
                    var form = document.getElementById("registration-form");
                    if (form.style.display === "none") {
                        form.style.display = "block";
                    } else {
                        form.style.display = "none";
                    }
                }
            </script>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Include database connection
                include 'db_connection.php';

                // Generate identification number
                $lecturer_ID = '2024' . rand(0000, 9999);

                // Function to generate student email
                function generateStudentEmail($lastName, $firstname) {
                    return strtolower($lastName) . "." . strtolower($firstname) . "@stu.ucc.edu.jm";
                }

                // Handle form submission
                $lecturerData = array(
                    "lecturer_ID" => $lecturer_ID,
                    "lecturer_title" => $_POST["lecturer_title"],
                    "lecturer_firstname" => $_POST["lecturer_firstname"],
                    "lecturer_lastname" => $_POST["lecturer_lastname"],
                    "lecturer_department" => $_POST["lecturer_department"],
                    "lecturer_position" => $_POST["lecturer_position"],
                    "pass_word" => $_POST["pass_word"],
                );

                try {
                    // Prepare and bind parameters for lecturer_database
                    $stmt = $conn->prepare("INSERT INTO lecturer_database (lecturer_ID, lecturer_title, lecturer_firstname, lecturer_lastname, lecturer_department, lecturer_position) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("ssssss", $lecturerData["lecturer_ID"], $lecturerData["lecturer_title"], $lecturerData["lecturer_firstname"], $lecturerData["lecturer_lastname"], $lecturerData["lecturer_department"], $lecturerData["lecturer_position"]);

                    // Execute the first INSERT statement
                    $stmt->execute();

                    // Get the password from the form
                    $password = $_POST["pass_word"];

                    // Hash the password
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("INSERT INTO login_lec_cred (lecturer_ID, pass_word) VALUES (?, ?)");
                    $stmt->bind_param("ss", $lecturerData["lecturer_ID"], $lecturerData["pass_word"]);

                    // Execute the second INSERT statement
                    $stmt->execute();

                    // Close statement and connection
                    $stmt->close();
                    $conn->close();

                    // Redirect on success
                    header("Location: Dashboard.php?message=" . urlencode("Lecturer registered successfully!") . "&lecturer_ID=" . urlencode($lecturerData["lecturer_ID"]));
                    exit();
                } catch (mysqli_sql_exception $e) {
                    // Handle duplicate entry error
                    if (strpos($e->getMessage(), "Duplicate entry") !== false) {
                        header("Location: UCC_Register.php?message=" . urlencode("Duplicate entry! The lecturer ID already exists."));
                        exit();
                    } else {
                        // Handle other errors
                        echo "Error: " . $e->getMessage();
                    }
                }
            }
            ?>
        </main>
    </body>
</html>
