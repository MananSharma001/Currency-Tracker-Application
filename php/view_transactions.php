// view_transactions.php

<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "money_transfer_db"; // Ensure correct DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if username is provided
if (isset($_POST['username'])) {
    $username = $_POST['username'];

    // Fetch transactions for this user
    $sql = "SELECT * FROM transactions WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Transaction ID: " . $row["id"] . 
                 " - Username: " . $row["username"] . 
                 " - From: " . $row["currency_from"] . 
                 " - To: " . $row["currency_to"] . 
                 " - Exchange Rate: " . $row["exchange_rate"] . 
                 " - Amount: " . $row["amount"] . 
                 " - Converted Amount: " . $row["converted_amount"] . 
                 " - Date: " . $row["transaction_date"] . "<br>";
        }
    } else {
        echo "No transactions found";
    }
} else {
    echo "Username not provided.";
}

$conn->close();
?>
