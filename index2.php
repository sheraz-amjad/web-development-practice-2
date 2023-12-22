<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "Signup";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$signupSuccess = false;
$emailExists = false;
$invalidLogin = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form is for signup or login
    if (isset($_POST['signup'])) {
        // Handle signup form data
        $username = $_POST['txt'];
        $email = $_POST['email'];
        $password = $_POST['pswd'];

		$checkEmailQuery = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($checkEmailQuery);

        if ($result->num_rows > 0) {
            $emailExists = true;
        } else {
            // Perform the SQL query to insert data into the users table
            $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
            
            if ($conn->query($sql) === TRUE) {
                $signupSuccess = true;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    } elseif (isset($_POST['login'])) {
        // Handle login form data
        $email = $_POST['email'];
        $password = $_POST['pswd'];

        // Perform the SQL query to check login credentials
        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result = $conn->query($sql);

		if ($result->num_rows > 0) {
			// Redirect to the after-login file
			header("Location: index1.php");
			exit();
		} else {
			$invalidLogin = true;
		}
    }
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Slide Navbar</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">

	<script>
        <?php

if ($emailExists) {
	echo "window.onload = function() {
		alert ('Email already exists. Please choose a different email.');
	}";
}

if ($invalidLogin) {
	echo "window.onload = function() {
		alert('Invalid login credentials. Please try again.');
	}";
}

        // Add JavaScript to toggle visibility based on signup success
        if ($signupSuccess) {
            echo "window.onload = function() {
                document.getElementById('signup-form').style.display = 'none';
                document.getElementById('login-form').style.display = 'none';
            }";
        }
        ?>
    </script>

</head>
<body>
    <div class="main">     
        <input type="checkbox" id="chk" aria-hidden="true">

            <div class="signup" id="signup-form">
                <form method="post" action="">
                    <label for="chk" aria-hidden="true">Sign up</label>
                    <input type="text" name="txt" placeholder="User name" required="">
                    <input type="email" name="email" placeholder="Email" required="">
                    <input type="password" name="pswd" placeholder="Password" required="">
                    <button type="submit" name="signup">Sign up</button>
                </form>
            </div>

            <div class="login" id="login-form">
                <form method="post" action="">
                    <label for="chk" aria-hidden="true">Login</label>
                    <input type="email" name="email" placeholder="Email" required="">
                    <input type="password" name="pswd" placeholder="Password" required="">
                    <button type="submit" name="login">Login</button>
                </form>
            </div>
    </div>
</body>
</html>
