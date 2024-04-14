<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Style/Dashboard.css">
    <title>UCC Student Registration</title>
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
<header>
    <img id="logo" src = "/Resources/logo.png">
    <h1>University of Common Wealth Caribbean</h1>
</header>
<main>
    <h2>Student Registration</h2>
    <form id="registration-form" method="post">
        <label for="identification-number">Identification Number:</label>
        <input type="text" id="identification-number" name="identification_number" readonly>

        <label for="first-name">First Name:</label>
        <input type="text" id="first-name" name="first_name" required>

        <label for="middle-name">Middle Name:</label>
        <input type="text" id="middle-name" name="middle_name">

        <label for="last-name">Last Name:</label>
        <input type="text" id="last-name" name="last_name" required>

        <label for="email">Personal Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="mobile-number">Mobile Number:</label>
        <input type="tel" id="mobile-number" name="mobile_number" required>

        <label for="home-number">Home Number:</label>
        <input type="tel" id="home-number" name="home_number" optional>

        <label for="work-number">Work Number:</label>
        <input type="tel" id="work-number" name="work_number" optional>

        <label for="address">Home Address:</label>
        <textarea id="address" name="address" required></textarea>

        <label for="next-of-kin">Next of Kin:</label>
        <input type="text" id="next-of-kin" name="next_of_kin" required>

        <label for="kin-contact">Next of Kin Contact Number:</label>
        <input type="tel" id="kin-contact" name="kin_contact" required>

        <label for="program">Program of Study:</label>
        <div id="program-options">
            <label for="program-business">Business</label>
            <input type="radio" id="program-business" name="program" value="Business" required>

            <label for="program-science">Science</label>
            <input type="radio" id="program-science" name="program" value="Science">

            <label for="program-information-technology">Information Technology</label>
            <input type="radio" id="program-information-technology" name="program" value="Information Technology">
        </div>

        <label for="passwd">Password:</label>
        <input type="text" id="passwd" name="passwd" required>

        <button type="submit" class="btn">Submit</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Database configuration
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "ucc_database";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Generate identification number
        $identificationNumber = '2024' . rand(10000, 99999);

        // Generate student email
        function generateStudentEmail($firstName) {
            return strtolower($firstName) . "@ucc.com";
        }

        // Handle form submission
        $studentData = array(
            "identification_number" => $identificationNumber,
            "first_name" => $_POST["first_name"],
            "middle_name" => $_POST["middle_name"],
            "last_name" => $_POST["last_name"],
            "email" => $_POST["email"],
            "mobile_number" => $_POST["mobile_number"],
            "home_number" => isset($_POST["home_number"]) ? $_POST["home_number"] : "",
            "work_number" => isset($_POST["work_number"]) ? $_POST["work_number"] : "",
            "address" => $_POST["address"],
            "next_of_kin" => $_POST["next_of_kin"],
            "kin_contact" => $_POST["kin_contact"],
            "program" => $_POST["program"],
            "student_email" => generateStudentEmail($_POST["first_name"])
        );

        // Prepare and bind parameters
        $stmt = $conn->prepare("INSERT INTO your_table_name (identification_number, first_name, middle_name, last_name, email, mobile_number, home_number, work_number, address, next_of_kin, kin_contact, program, student_email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssssssss", $studentData["identification_number"], $studentData["first_name"], $studentData["middle_name"], $studentData["last_name"], $studentData["email"], $studentData["mobile_number"], $studentData["home_number"], $studentData["work_number"], $studentData["address"], $studentData["next_of_kin"], $studentData["kin_contact"], $studentData["program"], $studentData["student_email"]);

        // Execute query
        $stmt->execute();

        // Check for errors
        if ($stmt->error) {
            echo "Error: " . $stmt->error;
        } else {
            echo "Student registered successfully!";
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    }
    ?>
</main>
</body>
</html>
