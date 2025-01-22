<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $chicken_fingers = $_POST['chicken_fingers'];
    $french_fries = $_POST['french_fries'];
    $poutine = $_POST['poutine'];
    $sauces = isset($_POST['sauces']) ? $_POST['sauces'] : [];

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sides Selection</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        h2, h3 {
            color: #333;
        }

        #sides {
            max-width: 900px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .side-option {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .side-option span {
            font-size: 18px;
            color: #444;
        }

        .side-option button {
            width: 40px;
            height: 40px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 50%;
            font-size: 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .side-option button:hover {
            background-color: #45a049;
        }

        .count {
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }

        #sauce-options {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin: 20px 0;
        }

        #sauce-options .option {
            padding: 10px 20px;
            background-color: #f1f1f1;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #sauce-options .option:hover {
            background-color: #ddd;
        }

        #sauce-options .option.selected {
            background-color: #90EE90;
        }

        #selected-sauces {
            margin-top: 10px;
            font-size: 16px;
            color: #333;
        }

        .form-button {
            padding: 15px 30px;
            background-color: #007BFF;
            color: white;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin-top: 20px;
            width: 100%;
            transition: background-color 0.3s;
        }

        .form-button:hover {
            background-color: #0056b3;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group h3 {
            margin-bottom: 10px;
        }

        @media (max-width: 600px) {
            .side-option {
                flex-direction: column;
                text-align: center;
            }

            .side-option button {
                width: 50px;
                height: 50px;
                font-size: 22px;
            }

            #sauce-options {
                justify-content: center;
            }

            .form-button {
                padding: 12px 25px;
                font-size: 16px;
            }
        }
    </style>
</head>
<body>

<div id="sides">
    <h2>Sides</h2>
    <form method="POST">
        <div class="side-option">
            <span>Chicken Fingers - $9.00</span>
            <button type="button" class="increase" data-item="chicken-fingers">+</button>
            <span id="chicken-fingers-count" class="count">0</span>
            <button type="button" class="decrease" data-item="chicken-fingers">-</button>
            <input type="hidden" name="chicken_fingers" id="chicken-fingers-hidden" value="0">
        </div>
        <div class="side-option">
            <span>French Fries - $5.00</span>
            <button type="button" class="increase" data-item="french-fries">+</button>
            <span id="french-fries-count" class="count">0</span>
            <button type="button" class="decrease" data-item="french-fries">-</button>
            <input type="hidden" name="french_fries" id="french-fries-hidden" value="0">
        </div>
        <div class="side-option">
            <span>Poutine - $11.00</span>
            <button type="button" class="increase" data-item="poutine">+</button>
            <span id="poutine-count" class="count">0</span>
            <button type="button" class="decrease" data-item="poutine">-</button>
            <input type="hidden" name="poutine" id="poutine-hidden" value="0">
        </div>

        <div class="form-group">
            <h3>Sauce Selection ($1 each)</h3>
            <div id="sauce-options">
                <div class="option" data-sauce="plum">Plum</div>
                <div class="option" data-sauce="sweet-sour">Sweet & Sour</div>
                <div class="option" data-sauce="barbeque">Barbeque</div>
            </div>
            <input type="hidden" name="sauces[]" id="sauces-hidden" value="">

            <div id="selected-sauces"></div>
        </div>

        <button type="submit" class="form-button">Submit Order</button>
    </form>
</div>

<script>
    const maxOrders = 3;
    let currentOrders = 0;

    function updateCounter(item, action) {
        const countElement = document.getElementById(`${item}-count`);
        let count = parseInt(countElement.innerText);

        if (action === 'increase' && currentOrders < maxOrders) {
            count++;
            currentOrders++;
        } else if (action === 'decrease' && count > 0) {
            count--;
            currentOrders--;
        }

        countElement.innerText = count;
        document.getElementById(`${item}-hidden`).value = count;
    }

    document.querySelectorAll('.increase').forEach(button => {
        button.addEventListener('click', (e) => {
            const item = e.target.getAttribute('data-item');
            updateCounter(item, 'increase');
        });
    });

    document.querySelectorAll('.decrease').forEach(button => {
        button.addEventListener('click', (e) => {
            const item = e.target.getAttribute('data-item');
            updateCounter(item, 'decrease');
        });
    });

    document.querySelectorAll('#sauce-options .option').forEach(option => {
        option.addEventListener('click', () => {
            option.classList.toggle('selected');

            const selectedSauces = Array.from(document.querySelectorAll('#sauce-options .option.selected'))
                                        .map(opt => opt.getAttribute('data-sauce'));

            document.getElementById('selected-sauces').innerText = selectedSauces.length > 0 
                ? `Selected Sauces: ${selectedSauces.join(', ')}`
                : 'No sauces selected';

            document.getElementById('sauces-hidden').value = selectedSauces.join(',');
        });
    });
</script>

</body>
</html>
