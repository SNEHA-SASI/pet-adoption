<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");  // Redirect to login if not logged in
    exit();
}

// Function to get session value or default to 'N/A'
function getSessionValue($key) {
    return isset($_SESSION[$key]) ? $_SESSION[$key] : 'N/A';
}

// Assuming user details are stored in the session
$username = $_SESSION['username'];
$name = getSessionValue('name');
$age = getSessionValue('age');
$breed = getSessionValue('breed');
$vaccineStatus = getSessionValue('vaccineStatus');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Adoption System</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; padding: 20px; }
        .container {
            max-width: 1000px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .pet-card {
            border: 1px solid #ddd;
            padding: 15px;
            margin: 10px;
            border-radius: 5px;
            width: 23%; /* Adjust the width of each pet card */
            text-align: center;
        }
        img {
            width: 150px;
            height: 150px;
            border-radius: 10px;
            object-fit: cover;
        }
        .hidden { display: none; }
        .profile-box { background-color: #fff; padding: 20px; border-radius: 8px; border: 1px solid #ddd; }
    </style>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
    <h2>Available Pets for Adoption</h2>
    <div class="container">
        <div class="pet-card">
            <img src="https://i.ytimg.com/vi/PqweYCDi3uc/maxresdefault.jpg" alt="Buddy">
            <h2>Buddy</h2>
            <p>Dog, 2 years old</p>
            <button onclick="adopt('Buddy')">Adopt</button>
        </div>
        <div class="pet-card">
            <img src="https://th.bing.com/th/id/OIP.O1NDKYyaEaE27UuLDHz7cQHaGk?rs=1&pid=ImgDetMain" alt="Whiskers">
            <h2>Whiskers</h2>
            <p>Cat, 3 years old</p>
            <button onclick="adopt('Whiskers')">Adopt</button>
        </div>
        <div class="pet-card">
            <img src="pattyykuttan.jpg" alt="Scuby">
            <h2>Scuby</h2>
            <p>Dog, 5 months old</p>
            <button onclick="adopt('Scuby')">Adopt</button>
        </div>
        <div class="pet-card">
            <img src="goat.jpg" alt="Mannikutty">
            <h2>Mannikutty</h2>
            <p>Goat, 4 months old</p>
            <button onclick="adopt('Mannikutty')">Adopt</button>
        </div>
        <div class="pet-card">
            <img src="https://images.pexels.com/photos/4001296/pexels-photo-4001296.jpeg" alt="Charlie">
            <h2>Charlie</h2>
            <p>Rabbit, 1 year old</p>
            <button onclick="adopt('Charlie')">Adopt</button>
        </div>
        <div class="pet-card">
            <img src="cow.jpeg" alt="Mercy">
            <h2>Mercy</h2>
            <p>Cow, 5 years old</p>
            <button onclick="adopt('Mercy')">Adopt</button>
        </div>
    </div>
    <div id="adoption-form" class="hidden">
        <h2>Adopt <span id="pet-name"></span></h2>
        <form onsubmit="submitForm(event)">
            <label for="name">Your Name:</label>
            <input type="text" id="name" required>
            <br><br>
            <label for="email">Your Email:</label>
            <input type="email" id="email" required>
            <br><br>
            <button type="submit">Submit Adoption Request</button>
        </form>
    </div>
    <script>
        function adopt(petName) {
            document.getElementById('pet-name').textContent = petName;
            document.getElementById('adoption-form').classList.remove('hidden');
        }
        function submitForm(event) {
            event.preventDefault();
            alert(`Adoption request sent for ${document.getElementById('pet-name').textContent}!`);
            document.getElementById('adoption-form').classList.add('hidden');
        }
    </script>
</body>
</html>
