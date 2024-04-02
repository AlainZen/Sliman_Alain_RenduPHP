<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "twitter";
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>
