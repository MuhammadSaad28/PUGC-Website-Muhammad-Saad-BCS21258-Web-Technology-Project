<?php
// Database configuration
$servername = "localhost";
$username = "root"; // Default username for XAMPP
$password = "";     // Default password for XAMPP (empty by default)
$dbname = "Project Web Technology";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $conn->real_escape_string($_POST['email']);

    $sql = "INSERT INTO newsletter (email) VALUES ('$email')";
    if ($conn->query($sql) === TRUE) {
        // If submission is successful, show a success message with a countdown
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Form Submission Success</title>
            <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
            <style>
                body {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    background-color: #f8f9fa;
                }
                .success-message {
                    background-color: #d4edda;
                    color: #155724;
                    border: 1px solid #c3e6cb;
                    padding: 20px;
                    border-radius: 5px;
                    text-align: center;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
                .countdown {
                    font-weight: bold;
                }
            </style>
        </head>
        <body>
            <div class='success-message'>
                <h3>Success!</h3>
                <p>You have been subscribed. Thank you!</p>
                <p>You will be redirected in <span id='countdown' class='countdown'>3</span> seconds.</p>
            </div>
            <script>
                let seconds = 3;
                const countdownElement = document.getElementById('countdown');
                const interval = setInterval(() => {
                    seconds--;
                    countdownElement.textContent = seconds;
                    if (seconds <= 0) {
                        clearInterval(interval);
                        window.location.href = 'http://127.0.0.1:5501/index.html#contact';
                    }
                }, 1000);
            </script>
        </body>
        </html>";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Form not submitted via POST.";
}
$conn->close();
?>
