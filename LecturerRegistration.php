<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/Style/Dashboard.css">
        <title>UCC Lecturer Registration</title>
        <style>
             /* adjusts main element on a page by page basis */
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
            <img id="logo" src = "/Resources/logo.png">
            <h1>University of Common Wealth Caribbean</h1>
        </header>
        <main>
            <h2>Lecturer Registration</h2>
            <form id="registration-form" method="post">
                
                <label for="lecturer-title">Title</label>
                <input type="text" id="lecturer-title" name="lecturer_title" required>

                <label for="lecturer-firstname">First Name:</label>
                <input type="text" id="lecturer-firstname" name="lecturer_firstname" required>

                <label for="lecturer-lastname">Last Name:</label>
                <input type="text" id="lecturer-firstname" name="lecturer_lastname" required>

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

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Database configuration
                include 'db_connection.php';

                // Generate identification number
                $lecturer_ID = '2024' . rand(0000, 9999);

                // Generate student email
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

                try{
                    // Prepare and bind parameters
                    $stmt = $conn->prepare("INSERT INTO lecturer_database (lecturer_ID, lecturer_title, lecturer_firstname, lecturer_lastname, lecturer_department, lecturer_position) VALUES (?, ?, ?, ?, ? ,?)");
                    $stmt->bind_param("ssssss", $lecturerData["lecturer_ID"], $lecturerData["lecturer_title"], $lecturerData["lecturer_firstname"], $lecturerData["lecturer_lastname"], $lecturerData["lecturer_department"], $lecturerData["lecturer_position"]);

                    // Execute the first INSERT statement
                    $stmt->execute();

                    // Get the password from the form
                    $password = $_POST["pass_word"];

                    // Hash the password
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("INSERT INTO login_lec_cred (lecturer_ID, pass_word) VALUES (?, ?)");
                    $stmt->bind_param("ss", $lecturerData["lecturer_ID"], $lecturerData["pass_word"]);

                    // Execute the secont INSERT statement
                    $stmt->execute();

                    // Close statement and connection
                    $stmt->close();
                    $conn->close();

                    // Success check
                    header("Location: Dashboard.php?message=" . urlencode("Lecturer registered successfully!"));
                    exit();
                } catch (mysqli_sql_exception $e) {
                    // Check if the error is due to duplicate entry
                    if (strpos($e->getMessage(), "Duplicate entry") !== false) {
                        // Duplicate entry error message
                        header("Location: UCC_Register.php?message=" . urlencode("Duplicate entry! The lecturer ID already exists."));
                        exit();
                    } else {
                        // Other errors
                        echo "Error: " . $e->getMessage();
                    }
                }
                
            }
            ?>
        </main>
    </body>
</html>
