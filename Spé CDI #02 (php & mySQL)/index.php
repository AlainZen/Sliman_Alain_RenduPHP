<?php
    $user = isset($_GET['user']) ? $_GET['user'] : "Inconnu";
    $tweets = isset($_GET['tweets']) ? $_GET['tweets'] : "Inconnu";

    require_once "index.html.php";