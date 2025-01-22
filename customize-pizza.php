<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customize Your Pizza</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        main {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background: white;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        h1 {
            text-align: center;
            color: #ff7700;
        }
        .section {
            margin-bottom: 30px;
        }
        .options {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .option {
            padding: 10px 15px;
            background: #f1f1f1;
            border: 2px solid transparent;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            flex: 1 1 calc(33% - 20px);
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }
        .option:hover {
            background: #ffefdc;
        }
        .option.selected {
            background: #ff7700;
            color: white;
            border: 2px solid #e66800;
        }
        .counter {
            margin-top: 10px;
        }
        .counter span {
            font-size: 18px;
            font-weight: bold;
        }
        textarea {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            resize: vertical;
        }
        button {
            background-color: #ff7700;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }
        button:hover {
            background-color: #e66800;
        }
        #go-back {
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        #go-back:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <main>
        <h1>Customize Your Pizza</h1>

        <div class="section">
            <h2>Select Your Pizza Type</h2>
            <div class="options" id="pizza-type-options">
                <div class="option" data-value="Pepperoni">Pepperoni</div>
                <div class="option" data-value="Cheese">Cheese</div>
                <div class="option" data-value="Meat Lovers">Meat Lovers</div>
            </div>
        </div>

        <div class="section" id="pizza-size-section" style="display: none;">
            <h2>Select Your Pizza Size</h2>
            <div class="options" id="pizza-size-options">
                <div class="option" data-value="Slice">Slice</div>
                <div class="option" data-value="Whole">Whole (16")</div>
            </div>
        </div>

        <div class="section" id="slice-counter" style="display: none;">
            <h3>Select Number of Slices</h3>
            <div class="counter">
                <button id="slice-minus">-</button>
                <span id="slice-count">0</span>
                <button id="slice-plus">+</button>
            </div>
        </div>

        <div class="section">
            <h2>Select Your Dip</h2>
            <div class="options" id="dip-options">
                <div class="option" data-value="Creamy Garlic">Creamy Garlic – $1.25</div>
                <div class="option" data-value="Ranch">Ranch – $1.25</div>
                <div class="option" data-value="Chipotle">Chipotle – $1.25</div>
            </div>
        </div>

        <div class="section">
            <h2>Special Instructions</h2>
            <textarea id="special-instructions" rows="4" placeholder="Any special requests?"></textarea>
        </div>

        <button id="submit-order">Submit Order</button>
        <button id="go-back">Go Back</button>
    </main>

    <script>
        let selectedPizzaType = null;
        let selectedPizzaSize = null;
        let sliceCount = 0;

        document.querySelectorAll('#pizza-type-options .option').forEach(option => {
            option.addEventListener('click', () => {
                selectedPizzaType = option.dataset.value;
                document.querySelectorAll('#pizza-type-options .option').forEach(opt => opt.classList.remove('selected'));
                option.classList.add('selected');
                document.getElementById('pizza-size-section').style.display = 'block';
            });
        });

        document.querySelectorAll('#pizza-size-options .option').forEach(option => {
            option.addEventListener('click', () => {
                selectedPizzaSize = option.dataset.value;
                document.querySelectorAll('#pizza-size-options .option').forEach(opt => opt.classList.remove('selected'));
                option.classList.add('selected');

                if (selectedPizzaSize === 'Slice') {
                    document.getElementById('slice-counter').style.display = 'block';
                } else {
                    document.getElementById('slice-counter').style.display = 'none';
                    sliceCount = 0; // Reset slice count when switching to whole pizza
                    document.getElementById('slice-count').textContent = sliceCount;
                }
            });
        });

        document.getElementById('slice-plus').addEventListener('click', () => {
            if (sliceCount < 5) {
                sliceCount++;
                document.getElementById('slice-count').textContent = sliceCount;
            } else {
                alert('You can only select up to 5 slices. Please choose a whole pizza instead.');
            }
        });

        document.getElementById('slice-minus').addEventListener('click', () => {
            if (sliceCount > 0) {
                sliceCount--;
                document.getElementById('slice-count').textContent = sliceCount;
            }
        });

document.querySelectorAll('#dip-options .option').forEach(option => {
    option.addEventListener('click', () => {
        document.querySelectorAll('#dip-options .option').forEach(opt => opt.classList.remove('selected'));

        option.classList.add('selected');
    });
});


        function getSelectedOption(sectionId) {
            return document.querySelector(`#${sectionId} .selected`)?.dataset.value || null;
        }

        document.getElementById('submit-order').addEventListener('click', () => {
            if (!selectedPizzaType) {
                alert("Please select a pizza type.");
                return;
            }

            const selectedDip = getSelectedOption('dip-options');
            const specialInstructions = document.getElementById('special-instructions').value;

            const order = {
                pizzaType: selectedPizzaType,
                pizzaSize: selectedPizzaSize,
                slices: selectedPizzaSize === 'Slice' ? sliceCount : null,
                dip: selectedDip,
                instructions: specialInstructions
            };

            console.log("Order Submitted:", order);
            alert("Your order has been submitted successfully! Check the console for details.");
        });

        document.getElementById('go-back').addEventListener('click', () => {
            window.history.back();
        });
    </script>
</body>
</html>
