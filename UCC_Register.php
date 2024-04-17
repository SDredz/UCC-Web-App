<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/Style/Dashboard.css">
        <title>UCC Dashboard</title>
        <style>
             /* adjusts main element on a page by page basis */
            main {
                max-width: 600px;
                margin: 40px auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            main h2 {
                color: #333;
                font-size: 30px;
                margin-bottom: 10px;
                text-align: center;
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
            <h1>University of Common Wealth Caribbean (UCC)</h1>
            <a id="Logout" class="btn" href="LecturerRegistration.php">Lecturer Sign Up</a>
        </header>
        <main>
            <h2>Welcome to UCC!</h2>
            <p>Please choose an option from the navigation menu.</p>
            <nav>
                <ul id="nav-links">
                    <?php
                    $links = [
                        ['text' => 'Student Login', 'href' => 'StudentLogin.php', 'action' => 'promptStudent'],
                        ['text' => 'Lecturer Login', 'href' => 'AdminLogin.php', 'action' => 'promptAdmin'],
                        ['text' => 'Register as a Student', 'href' => 'StudentRegistration.php', 'action' => 'showRegistrationForm'],
                    ];

                    foreach ($links as $link) {
                        echo '<li><a href="' . $link['href'] . '">' . $link['text'] . '</a></li>';
                    }
                    ?>
                </ul>
            </nav>
        </main>

    </body>
</html>
