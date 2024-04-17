<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/Style/Dashboard.css">
        <title>UCC Student Registration</title>
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
            <h2>Student Registration</h2>
            <form id="registration-form" method="post">
                
                <label for="first-name">First Name:</label>
                <input type="text" id="first-name" name="first_name" required>

                <label for="middle-name">Middle Name:</label>
                <input type="text" id="middle-name" name="middle_name">

                <label for="last-name">Last Name:</label>
                <input type="text" id="last-name" name="last_name" required>

                <label for="personal-email">Personal Email:</label>
                <input type="text" id="personal-email" name="personal_email" required>

                <label for="mobile-contact">Mobile Number:</label>
                <input type="tel" id="mobile-contact" name="mobile_contact" required>

                <label for="home-contact">Home Number:</label>
                <input type="tel" id="home-contact" name="home_contact" optional>

                <label for="work-contact">Work Number:</label>
                <input type="tel" id="work-contact" name="work_contact" optional>

                <label for="home-address">Home Address:</label>
                <textarea type="text" id="home-address" name="home_address" required></textarea>

                <label for="next-of-kin">Next of Kin:</label>
                <input type="text" id="next-of-kin" name="next_of_kin" required>

                <label for="kon-contact">Next of Kin Contact Number:</label>
                <input type="tel" id="kin-contact" name="nok_contact" required>

                <label for="program">Program of Study:</label>
                <div id="program-options">
                    <select id="program" name="program">
                        <option value="Business Administration">Business Administration</option>
                        <option value="Science">Science</option>
                        <option value="Information Technology">Information Technology</option>
                    </select>
                </div>

                <label for="passwd">Password:</label>
                <input type="text" id="passwd" name="pass_word" required>

                <button type="submit" class="btn">Submit</button>
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Database configuration
                include 'db_connection.php';

                // Generate identification number
                $student_id = '2024' . rand(0001, 9999);

                // Generate student email
                function generateStudentEmail($lastName, $firstname) {
                    return strtolower($lastName) . "." . strtolower($firstname) . "@stu.ucc.edu.jm";
                }

                // Handle form submission
                $studentData = array(
                    "student_id" => $student_id,
                    "first_name" => $_POST["first_name"],
                    "middle_name" => $_POST["middle_name"],
                    "last_name" => $_POST["last_name"],
                    "personal_email" => $_POST["personal_email"],
                    "mobile_contact" => $_POST["mobile_contact"],
                    "home_contact" => $_POST["home_contact"],
                    "work_contact" => $_POST["work_contact"],
                    "home_address" => $_POST["home_address"],
                    "next_of_kin" => $_POST["next_of_kin"],
                    "nok_contact" => $_POST["nok_contact"],
                    "program" => $_POST["program"],
                    "student_email" => generateStudentEmail($_POST["last_name"], $_POST["first_name"]),
                    "pass_word" => $_POST["pass_word"],
                );

                try{
                    // Prepare and bind parameters
                    $stmt = $conn->prepare("INSERT INTO students (student_id, first_name, middle_name, last_name, personal_email, mobile_contact, home_contact, work_contact, home_address, next_of_kin, nok_contact, program, student_email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("sssssssssssss", $studentData["student_id"], $studentData["first_name"], $studentData["middle_name"], $studentData["last_name"], $studentData["personal_email"], $studentData["mobile_contact"], $studentData["home_contact"], $studentData["work_contact"], $studentData["home_address"], $studentData["next_of_kin"], $studentData["nok_contact"], $studentData["program"], $studentData["student_email"]);

                    // Execute the first INSERT statement
                    $stmt->execute();
                    
                    // Get the password from the form
                    $password = $_POST["pass_word"];

                    // Hash the password
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("INSERT INTO login_stu_cred (student_id, pass_word) VALUES (?, ?)");
                    $stmt->bind_param("ss", $studentData["student_id"], $studentData["pass_word"]);

                    // Execute the secont INSERT statement
                    $stmt->execute();

                    // Close statement and connection
                    $stmt->close();
                    $conn->close();

                    header("Location: Dashboard.php?message=" . urlencode("Student registered successfully!") . "&student_id=" . urlencode($studentData["student_id"]));
                    exit();
                } catch (mysqli_sql_exception $e) {
                    // Check if the error is due to duplicate entry
                    if (strpos($e->getMessage(), "Duplicate entry") !== false) {
                        // Duplicate entry error message
                        header("Location: UCC_Register.php?message=" . urlencode("Duplicate entry! The Student ID already exists."));
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
