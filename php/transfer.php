// transfer.php

<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "money_transfer_db"; // Ensure the correct DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Getting the POST data
if (isset($_POST['first_currency'], $_POST['second_currency'], $_POST['exchange_rate'], $_POST['amount'], $_POST['username'])) {
    $first_currency = $_POST['first_currency'];
    $second_currency = $_POST['second_currency'];
    $exchange_rate = $_POST['exchange_rate'];
    $amount = $_POST['amount'];
    $username = $_POST['username'];
    $converted_amount = $amount * $exchange_rate;
    $transaction_date = date('Y-m-d H:i:s');

    // Insert the transaction data into the database
    $sql = "INSERT INTO transactions (username, currency_from, currency_to, exchange_rate, amount, converted_amount, transaction_date) 
            VALUES ('$username', '$first_currency', '$second_currency', '$exchange_rate', '$amount', '$converted_amount', '$transaction_date')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Transaction successful!";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Missing data.";
}

$conn->close();
?>
