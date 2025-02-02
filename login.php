<?php
session_start();

// Database connection
$host = "localhost";  // Database host
$dbname = "my_database";  // Database name
$username = "root";  // Database username
$password = "Root";  // Database password (replace with the correct password)

try {
    // Try to create a new PDO instance and connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected to the database successfully!";
} catch (PDOException $e) {
    // If connection fails, catch the exception and display an error message
    die("Could not connect to the database: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    // Prepare the SQL statement to fetch user data
    $stmt = $pdo->prepare("SELECT * FROM my_database.users WHERE username = :username LIMIT 1");
    $stmt->bindParam(':username', $inputUsername, PDO::PARAM_STR);
    $stmt->execute();

    // Check if user exists
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    // echo("alert( $user[password])");
    
    if ($user &&  $user['password'] == $inputPassword) {
        
        echo("$user[username],$user[password]");
        echo("alert(login successfull)");
        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: welcome.php");  
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('muyal.jpg');
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color:rgb(0, 1, 0);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color:rgb(3, 25, 4);
        }
        .error {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Login</h2>

        <?php if (isset($error)) { ?>
            <div class="error">
                <?php echo $error; ?>
            </div>
        <?php } ?>

        <form action="login.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>
    </div>

</body>
</html>
