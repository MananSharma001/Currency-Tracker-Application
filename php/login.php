<?php
// Database connection details
$servername = "localhost";
$dbusername = "root";  // Use your actual database username
$dbpassword = "";      // Use your actual database password
$dbname = "money_transfer_db"; // Ensure this matches your actual database name

// Create a database connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the posted data
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validate input
    if (empty($username) || empty($password)) {
        echo "Please provide both username and password.";
        $conn->close();
        exit();
    }

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if login is successful
    if ($result->num_rows > 0) {
        echo "Login successful!";
    } else {
        echo "Invalid username or password.";
    }

    // Close the statement and connection
    $stmt->close();
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
