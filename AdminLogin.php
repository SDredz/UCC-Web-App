<?php
// Start session
session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check admin credentials
    $adminName = $_POST['admin_name'];
    $adminPassword = $_POST['admin_password'];

    // Assuming admin credentials are 'Admin' and 'Admin'
    if ($adminName === 'Admin' && $adminPassword === 'Admin') {
        // Store admin login status in session
        $_SESSION['admin_logged_in'] = true;
        
        // Redirect to the admin dashboard
        header("Location: AdminDashboard.php");
        exit();
    } else {
        // Invalid credentials
        echo '<script>alert("Invalid admin name or password.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Style/Dashboard.css">
    <title>UCC Admin Login</title>
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
        <h2>Admin Login</h2>
        <form id="admin-login-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="admin-name">Admin Name:</label>
            <input type="text" id="admin-name" name="admin_name" required>

            <label for="admin-password">Password:</label>
            <input type="password" id="admin-password" name="admin_password" required>

            <button type="submit" class="btn">Login</button>
        </form>
    </main>
</body>
</html>
