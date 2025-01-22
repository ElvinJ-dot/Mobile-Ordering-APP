<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>35th Street Market Café</title>
    <link rel="icon" type="image/x-icon" href="Images/favicon.png">
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cute+Font&family=DM+Serif+Text:ital@0;1&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
</head>
<body>
    <main>
    
    
        <?php include('header.php'); 
        
        ?>



        

        <div class="banner">
        </div>

        <div class="title-line">
            <h2>Order Now</h2>
        </div>
        <section id="home" class="tabs">
            <div class="tab">
                <a href="customize-sub.php">
                    <img src="Images/EfUpO5VXsAAaoK0.jpg" alt="Subs">
                    <h2>Subs</h2>
                    <p>Delicious subs made fresh daily.</p>
                </a>
            </div>
            <div class="tab">
                <a href="customize-pizza.php">
                    <img src="Images/pizza-veggie-italian-pizza-with-mozzarella-olives-sausage-and-vegetables-on-black-background-ai-generated-photo.jpg" alt="Pizzas">
                    <h2>Pizzas</h2>
                    <p>Hot, cheesy, and made to perfection.</p>
                </a>
            </div>
            <div class="tab">
                <a href="customize-sides.php">
                    <img src="Images/360_F_620487372_6eYL1S63J1TyhW24PJkNqjg70sCKN0pN.jpg" alt="Sides">
                    <h2>Sides</h2>
                    <p>Crispy. Savory. Irresistible.</p>
                </a>
            </div>
            <div class="tab">
                <a href="customize-items.php">
                    <img src="Images/chips-and-sips-BvcEvFl6.png" alt="Other Items">
                    <h2>Other Items</h2>
                    <p>Explore our diverse menu options.</p>
                </a>
            </div>
        </section>

        <div class="title-line">
            <h2>Location & Hours</h2>
        </div>
        <div class="location-time">
            <div class="location">
                <p><strong>Located in:</strong> Algonquin College - Ottawa Campus (R Building)</p>
                <p><strong>Address:</strong> Student Residences, Ottawa, ON K2G 1V8</p>
            </div>
            <div class="hours">
                <p><strong>Monday-Friday:</strong> 8 a.m. - 10 p.m.</p>
                <p><strong>Saturday-Sunday:</strong> 10 a.m. - 10 p.m.</p>
            </div>
            <div class="contact">
                <p><strong>Phone:</strong> (613) 727-7698</p>
            </div>
        </div>

        <!-- Café Tour Section -->
        <div class="title-line">
            <h2>Our Café Tour</h2>
        </div>
        <div class="video-section" style="width: 100%; margin: 20px auto; text-align: center;">
            <iframe 
                width="70%" 
                height="600" 
                src="https://www.youtube.com/embed/MBkhUviwFz4" 
                title="YouTube video player" 
                frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                allowfullscreen>
            </iframe>
        </div>
    </main>

    <?php include('footer.php'); ?>
</body>
</html>
