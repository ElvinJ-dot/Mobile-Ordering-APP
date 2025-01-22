<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="icon" type="image/x-icon" href="Images/favicon.png">

    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cute+Font&family=DM+Serif+Text:ital@0;1&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
</head>
<?php include('header.php'); ?>

<style>
    /* General styles */
/* General Styles */
body {
    font-family: "DM Serif Text", serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
    color: #333;
}

main {
    max-width: 1200px;
    margin: 20px auto;
    padding: 10px;
}

section {
    margin: 0 auto;
}
/* Section Box */
.section-box, .chef-menu {
    background-color: #fff;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    width: 75%;
}

.section-box h3, .chef-menu h2 {
    font-size: 1.8em;
    color: #ff7700;
    margin-bottom: 10px;
    font-weight: bold;
    text-shadow: 1px 1px rgb(57, 57, 57);
}

/* Table */
.chef-menu table {
    width: 100%;
    margin-top: 20px;
    border-collapse:separate;
    border:solid grey 1px;
    border-radius:6px;
}

.chef-menu table th, .chef-menu table td {
    padding: 12px;
    text-align: left;
    border: 1px solid #ddd;
}

.chef-menu table th {
    background-color:rgba(255, 119, 0, 0.84);
    color: #fff;
    font-weight: bold;
}

.chef-menu table td {
    background-color: #fafafa;
}

/* List Styling */
.section-box ul {
    list-style-type: none;
    padding: 0;
    margin: 10px 0;
}

.section-box ul li {
    padding: 8px 0;
    font-size: 1.1em;
    color: #555;
}

.section-box ul li span {
    font-weight: bold;
    color: #333;
}

/* Responsive Design */
@media (max-width: 768px) {
    main {
        margin: 10px;
        padding: 5px;
    }

    .section-box, .chef-menu {
        width: 100%;
        padding: 15px;
    }

    .chef-menu table th, .chef-menu table td {
        font-size: 0.9em;
    }
}

</style>

<main>
    <!-- Chef's Menu -->
    <section class="chef-menu">
        <h2>This Week’s Chef’s Choice Menu</h2>
        <p>
            January 20 to January 26
        </p>

        <table>
            <thead>
                <tr>
                    <th>Day of Week</th>
                    <th>Feature Meal</th>
                    <th>Vegetarian Option</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Monday</td>
                    <td>Grilled Breast of Chicken with orange, Rosemary, and red onion</td>
                    <td>Vegetable Samosa with Mint Chutney</td>
                </tr>
                <tr>
                    <td>Tuesday</td>
                    <td>Chicken Parmesan</td>
                    <td>Vegetable Lasagna</td>
                </tr>
                <tr>
                    <td>Wednesday</td>
                    <td>Chicken Fajitas</td>
                    <td>Veggie Quesadilla with Rice</td>
                </tr>
                <tr>
                    <td>Thursday</td>
                    <td>Weiner Schnitzel</td>
                    <td>Three Cheese Perogies with Fried Onion</td>
                </tr>
                <tr>
                    <td>Friday</td>
                    <td>Chicken Korma</td>
                    <td>Vegetable Biryani</td>
                </tr>
                <tr>
                    <td>Saturday</td>
                    <td>Southern Fried Chicken</td>
                    <td>Veggie Nuggets with Plum Sauce</td>
                </tr>
                <tr>
                    <td>Sunday</td>
                    <td>Chef’s Choice</td>
                    <td>Chef’s Choice</td>
                </tr>
            </tbody>
        </table>
    </section>

    <!-- Coffee and Sweets Section -->
    <section class="section-box">
        <h3>Coffee and Sweets</h3>

        <h4>Coffee</h4>
        <ul>
            <li><span>Small</span> - $2.00, <span>Medium</span> - $2.30, <span>Large</span> - $2.50</li>
        </ul>

        <h4>Cappuccino</h4>
        <ul>
            <li><span>Small</span> - $2.50, <span>Medium</span> - $2.75, <span>Large</span> - $3.05</li>
        </ul>

        <h4>Hot Chocolate</h4>
        <ul>
            <li><span>Small</span> - $2.50, <span>Medium</span> - $2.75, <span>Large</span> - $3.05</li>
        </ul>

        <h4>David's Tea</h4>
        <ul>
            <li><span>Small</span> - $2.35, <span>Large</span> - $2.95</li>
        </ul>

        <h4>Extra Tea Bag</h4>
        <ul>
            <li><span>$1.00</span></li>
        </ul>


    </section>

 <section class="section-box">
 <h3>Sweets</h3>
        <ul>
            <li><span>Large Cookie</span> - $2.85</li>
            <li><span>Muffin</span> - $2.25</li>
            <li><span>Large Pastry</span> - $3.50</li>
            <li><span>Maverick's Donut</span> - $3.50</li>
        </ul>

 </section>
    <!-- Pizza Section -->
    <section class="section-box">
        <h3>It’s A Slice Pizza</h3>
        <ul>
            <li>Cheese, Pepperoni, Combination, Meat Lovers, Vegetarian. <span>Slice</span> - $4.50, <span>Whole Pizza 16"</span> - $24.00 <span>Dip</span> - $1.25</li>
        </ul>
    </section>

    <!-- Wraps Section -->
    <section class="section-box">
        <h3>It’s A Wrap</h3>
        <ul>
            <li>Italian Meatball, Crispy Chicken, Italian Cold Cut Trio, Black Forest Ham, Smoked Turkey, Black Bean Patty, Pulled Smoked Brisket (Halal) <br>from <span>6"</span> - $5.75 to <span>12"</span> - $12.95</li>
        </ul>

        <h4>Premium Wraps</h4>
        <ul>
            <li>Spicy Habanero Chicken, Southwest Shaved Steak, BLT, Slow Roasted Chicken (Halal) <span>6"</span> - $7.75, <span>12"</span> - $13.95</li>
        </ul>
    </section>

    <!-- Grill Section -->
    <section class="section-box">
        <h3>Mardi Gras Grill</h3>
        <ul>
            <li><span>Chicken Fingers</span> - $9.25</li>
            <li><span>Poutine</span> - $6.75</li>
        </ul>
    </section>

    <!-- Weekday Breakfast Section -->
    <section class="section-box">
        <h3>Weekday Breakfast</h3>
        <ul>
            <li><span>Breakfast Sandwich</span> - With bacon, sausage, or ham & egg served on an English muffin. $5.00</li>
            <li><span>Hashbrown</span> - $1.50</li>
        </ul>
    </section>
</main>

<?php include('footer.php'); ?>
