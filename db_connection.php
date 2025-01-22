<?php


$host = "localhost";         // Database host
$dbname = "35thCafeDB"; // Your database name
$username = "root";          // MySQL username
$password = "";
$port = 3307;  
$dsn = "mysql:host=$host;dbname=$dbname;port=$port";


try {
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
CATCh(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>


 