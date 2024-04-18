<?php 

try  {
    $database = new PDO('mysql:host=localhost;dbname=twitter','root','');

    $request = $database->prepare(
        'SELECT tweets.message, users.pseudo FROM tweets LEFT JOIN users ON users.id = tweets.author_id'
    );
    $request->execute();

    // Récupérer les tweets de la base de données
    $tweets = $request->fetchAll(PDO::FETCH_ASSOC);

    require_once 'index.html.php'; // et non include ptn
} catch(Exception $e) {
    die("Error connecting to the database: " . $e->getMessage());
}

?>
