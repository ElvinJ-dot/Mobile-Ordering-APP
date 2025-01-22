<?php
session_start();
include('db_connection.php'); // Assume db_connect.php contains your DB connection

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Get user information
$user_id = $_SESSION['id'];
$username = $_SESSION['username'];

// Fetch order history from the orders table
$stmt = $conn->prepare("
    SELECT order_id, order_date, total_amount, status 
    FROM orders 
    WHERE id = ? 
    ORDER BY order_date DESC
");
$stmt->execute([$user_id]);
$order_history = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cute+Font&family=DM+Serif+Text:ital@0;1&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <style>


        .container {
            max-width: 900px;
            margin: 30px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            font-size: 2rem;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        table th {
            background-color:rgba(255, 119, 0, 0.84);
            color: white;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        table tr:hover {
            background-color: #f1f1f1;
        }
        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #3498db;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include('header.php'); ?>


    <div class="container">
        <h2>Hello, <?php echo htmlspecialchars($username); ?>!</h2>
        <p>Here is your order history:</p>

        <?php if (count($order_history) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Order Date</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($order_history as $order): ?>
                        <tr>
                            <td><?php echo $order['order_id']; ?></td>
                            <td><?php echo $order['order_date']; ?></td>
                            <td>$<?php echo number_format($order['total_amount'], 2); ?></td>
                            <td><?php echo htmlspecialchars(ucfirst($order['status'])); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>You have no orders in your history.</p>
        <?php endif; ?>

    </div>
</body>
<?php include('footer.php'); ?>
</html>
