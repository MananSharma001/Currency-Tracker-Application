<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Transactions</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>View Transactions</h2>
        <form action="view_transactions.php" method="POST">

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>

            <button type="submit">View Transactions</button>
        </form>
    </div>
</body>
</html>
