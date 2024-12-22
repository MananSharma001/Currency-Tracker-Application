<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency Transaction</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Currency Transaction</h1>
    <form action="transfer.php" method="POST">
        <label for="currency_from">From Currency (e.g., USD):</label>
        <input type="text" id="currency_from" name="currency_from" required><br><br>

        <label for="currency_to">To Currency (e.g., EUR):</label>
        <input type="text" id="currency_to" name="currency_to" required><br><br>

        <label for="exchange_rate">Exchange Rate:</label>
        <input type="number" step="0.01" id="exchange_rate" name="exchange_rate" required><br><br>

        <label for="amount">Amount:</label>
        <input type="number" step="0.01" id="amount" name="amount" required><br><br>

        <button type="submit">Transfer</button>
    </form>
</body>
</html>
