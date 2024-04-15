<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/Style/Dashboard.css">
        <title>UCC Dashboard</title>
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
            <h1>University of Common Wealth Caribbean (UCC)</h1>
        </header>
        <main>
            <h2>Welcome to UCC!</h2>
            <p>Please choose an option from the navigation menu.</p>
            <nav>
                <ul id="nav-links">
                    <?php
                    $links = [
                        ['text' => 'Admin Login', 'href' => 'AdminLogin.php', 'action' => 'promptAdmin'],
                        ['text' => 'Student Login', 'href' => 'StudentLogin.php', 'action' => 'promptStudent'],
                        ['text' => 'Available Courses', 'href' => 'Courses.php', 'action' => 'showAvailable'],
                        ['text' => 'Register', 'href' => 'StudentRegistration.php', 'action' => 'showRegistrationForm'],
                    ];

                    foreach ($links as $link) {
                        echo '<li><a href="' . $link['href'] . '">' . $link['text'] . '</a></li>';
                    }
                    ?>
                </ul>
            </nav>
        </main>
        <?php
        // PHP function to handle admin prompt
        function promptAdmin() {
            if (confirm('Are you an admin?')) {
                header("Location: AdminLogin.html");
            } else {
                // Placeholder
            }
        }

        // PHP function to handle student prompt
        function promptStudent() {
            if (confirm('Are you a student?')) {
                header("Location: StudentLogin.html");
            } else {
                // Placeholder
            }
        }

        // PHP function to show available courses
        function showAvailable() {
            header("Location: Courses.html");
        }

        // PHP function to show registration form
        function showRegistrationForm() {
            header("Location: StudentRegistration.html");
        }
        ?>
    </body>
</html>
