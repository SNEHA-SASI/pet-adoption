<?php
// Database connection (same as login.php)
$host = "localhost";
$dbname = "my_database";
$username = "root";
$password = "Root";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    // Insert new user into the database
    $stmt = $pdo->prepare("INSERT INTO my_database.users (username, password) VALUES (:username, :password)");
    $stmt->bindParam(':username', $inputUsername);
    $stmt->bindParam(':password', $inputPassword);

    if ($stmt->execute()) {
        $message = "<p style='color: black;'>User registered successfully!</p>";
    } else {
        $message = "<p style='color: red;'>Error registering user.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('animals.jpg');
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            position: relative;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-size: 1rem;
            color: #333;
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 12px;
            font-size: 1rem;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .message {
            text-align: center;
            margin-top: 10px;
            font-size: 1rem;
        }

        .message a {
            color: #007BFF;
            text-decoration: none;
        }

        .message a:hover {
            text-decoration: underline;
        }

        /* Adjusted positioning for the success message */
        .success-message {
            position: absolute;
            bottom: -0.1cm; /* Move it exactly 0.1 cm down from the previous position */
            left: 50%; /* Horizontally center it */
            transform: translateX(-50%); /* Correct the centering */
            text-align: center;
            width: 100%;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Register</h2>

        <form action="register.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>

            <button type="submit">Register</button>
        </form>

        <div class="message">
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>

        <!-- Display success message at the bottom -->
        <?php if (isset($message)) { ?>
            <div class="success-message"><?php echo $message; ?></div>
        <?php } ?>
    </div>

</body>
</html>
