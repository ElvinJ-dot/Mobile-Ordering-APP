<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Snacks & Drinks</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .section {
            margin: 20px;
        }
        h2 {
            text-align: center;
        }
        .item {
            display: inline-block;
            width: 200px;
            text-align: center;
            margin: 15px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .item img {
            width: 100%;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .item p {
            margin: 10px 0;
            font-size: 16px;
        }
        .item button {
            background-color: #ff7700;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 10px;
        }
        .item button:hover {
            background-color: #e66800;
        }
        .counter {
            display: none;
            margin-top: 10px;
        }
        .counter span {
            font-size: 18px;
            font-weight: bold;
        }
        button.counter-button {
            background-color: #ff7700;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
        }
        button.counter-button:hover {
            background-color: #e66800;
        }
        .order-buttons {
            text-align: center;
            margin-top: 30px;
        }
        .order-buttons button {
            margin: 0 10px;
        }
    </style>
</head>
<body>

    <div class="section" id="chips">
        <h2>Chips</h2>
        <div class="item" id="doritos">
            <img src="https://via.placeholder.com/200x200.png?text=Doritos+Nacho" alt="Doritos Nacho">
            <p>Doritos Nacho (70g) – $2.19</p>
            <button onclick="showCounter('doritos')">Select</button>
            <div class="counter" id="doritos-counter">
                <button class="counter-button" onclick="updateCounter('doritos', -1)">-</button>
                <span id="doritos-count">0</span>
                <button class="counter-button" onclick="updateCounter('doritos', 1)">+</button>
            </div>
        </div>
        <div class="item" id="ruffles">
            <img src="https://via.placeholder.com/200x200.png?text=Ruffles" alt="Ruffles All Dressed">
            <p>Ruffles All Dressed (65g) – $2.19</p>
            <button onclick="showCounter('ruffles')">Select</button>
            <div class="counter" id="ruffles-counter">
                <button class="counter-button" onclick="updateCounter('ruffles', -1)">-</button>
                <span id="ruffles-count">0</span>
                <button class="counter-button" onclick="updateCounter('ruffles', 1)">+</button>
            </div>
        </div>
    </div>

    <div class="section" id="drinks">
        <h2>Drinks</h2>
        <div class="item" id="dasani">
            <img src="https://via.placeholder.com/200x200.png?text=Dasani+Water" alt="Dasani Water">
            <p>Dasani Water (591ml) – $2.25</p>
            <button onclick="showCounter('dasani')">Select</button>
            <div class="counter" id="dasani-counter">
                <button class="counter-button" onclick="updateCounter('dasani', -1)">-</button>
                <span id="dasani-count">0</span>
                <button class="counter-button" onclick="updateCounter('dasani', 1)">+</button>
            </div>
        </div>
        <div class="item" id="cocaCola">
            <img src="https://via.placeholder.com/200x200.png?text=CocaCola" alt="Coca-Cola">
            <p>Coca-Cola (500ml) – $2.85</p>
            <button onclick="showCounter('cocaCola')">Select</button>
            <div class="counter" id="cocaCola-counter">
                <button class="counter-button" onclick="updateCounter('cocaCola', -1)">-</button>
                <span id="cocaCola-count">0</span>
                <button class="counter-button" onclick="updateCounter('cocaCola', 1)">+</button>
            </div>
        </div>
    </div>

    <div class="order-buttons">
        <button onclick="submitOrder()">Submit Order</button>
        <button onclick="goBack()">Go Back</button>
    </div>

    <script>
        function showCounter(item) {
            document.getElementById(`${item}-counter`).style.display = 'block';
        }

        function updateCounter(item, change) {
            const countElement = document.getElementById(`${item}-count`);
            let count = parseInt(countElement.textContent);
            count += change;
            
            if (count < 0) count = 0;
            if (count > 5) count = 5;

            countElement.textContent = count;
        }

        function submitOrder() {
            alert('Your order has been submitted!');
        }

        function goBack() {
            window.history.back();
        }
    </script>

</body>
</html>
