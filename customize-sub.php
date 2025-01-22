<?php
include_once('session.php');
include('db_connection.php'); // Assume db_connect.php contains your DB connection

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Get user information
$user_id = $_SESSION['id'];
$username = $_SESSION['username'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sub_id = $_POST['sub_id'];
    $quantity = $_POST['quantity'];
    
    // Get sub details
    $stmt = $conn->prepare("SELECT * FROM sub_menu WHERE sub_id = ?");
    $stmt->execute([$sub_id]);
    $sub = $stmt->fetch();

    if ($sub) {
        $total_amount = $sub['sub_price'] * $quantity;

        // Insert the order into the orders table
        $stmt = $conn->prepare("INSERT INTO orders (id, order_date, total_amount, status) VALUES (?, NOW(), ?, ?)");
        $stmt->execute([$user_id, $total_amount, 'pending']);

        echo 'Your order has been placed!';
        echo 'You will be redirected to the orders page in 5 seconds.';
        echo '<script>
            setTimeout(function() {
                window.location.href = "orders.php"; // Replace with your target page
            }, 5000); // 5000 milliseconds = 5 seconds
        </script>';
    }
}

// Fetch available subs
$stmt = $conn->query("SELECT * FROM sub_menu");
$subs = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customize Sub</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        header {
            background-color:rgba(255, 119, 0, 0.91);
            color: white;
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ccc;
        }
        h1, h2 {
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            font-size: 2rem;
            margin-bottom: 15px;
        }
        h2 {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        label {
            font-size: 1rem;
            font-weight: bold;
        }
        select, input[type="number"] {
            padding: 10px;
            font-size: 1rem;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-top: 5px;
        }
        select {
            width: 100%;
        }
        button {
            padding: 12px 20px;
            font-size: 1rem;
            background-color:rgba(255, 119, 0, 0.84);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color:rgba(206, 98, 4, 0.84);
        }
        .order-info {
            margin-top: 20px;
            font-size: 1rem;
            color: #27ae60;
        }
        .error {
            margin-top: 20px;
            font-size: 1rem;
            color: #e74c3c;
        }
    </style>
</head>
<body>


    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
        <p>Choose your favorite sub and place your order.</p>
        <img src="Images/sub.jpg" alt="" style="width: 90%; height: auto; margin-left:30px">

        <form method="POST" action="">
            <label for="sub_id">Choose a sub:</label>
            <select name="sub_id" id="sub_id" required>
                <?php foreach ($subs as $sub): ?>
                    <option value="<?php echo $sub['sub_id']; ?>"><?php echo htmlspecialchars($sub['sub_name']); ?> - $<?php echo $sub['sub_price']; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" id="quantity" min="1" value="1" required>

            <button type="submit">Place Order</button>
        </form>

        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($sub)): ?>
            <div class="order-info">Your order for <?php echo htmlspecialchars($sub['sub_name']); ?> has been placed successfully!</div>
        <?php endif; ?>
    </div>
</body>
</html>