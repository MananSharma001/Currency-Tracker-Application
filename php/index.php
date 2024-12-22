<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Money Transfer App</title>
</head>
<body>
<h1>Welcome to the Money Transfer Application</h1>
<form method="POST" action="index.php">
    <button type="submit" name="register">Register</button>
    <button type="submit" name="login">Login</button>
    <button type="submit" name="transaction">Add Transaction</button>
    <button type="submit" name="view_transactions">View Transactions</button>
</form>

<?php
if (isset($_POST['register'])) {
    header("Location: register.php");
} elseif (isset($_POST['login'])) {
    header("Location: login.php");
} elseif (isset($_POST['transaction'])) {
    if (!isset($_SESSION['username'])) {
        echo "<p>You need to login or register first!</p>";
    } else {
        header("Location: transfer.php");
    }
} elseif (isset($_POST['view_transactions'])) {
    if (!isset($_SESSION['username'])) {
        echo "<p>You need to login or register first!</p>";
    } else {
        header("Location: view_transactions.php");
    }
}
?>
</body>
</html>
