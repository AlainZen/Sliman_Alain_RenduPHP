<?php

try {
    $database = new PDO('mysql:host=localhost;dbname=twitter', 'root', '');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Verifier si le champ message est présent et non vide
        if (isset($_POST['message']) && !empty($_POST['message'])) {
            $message = $_POST['message'];

            // Verifier si le pseudo est présent et non vide
            if (isset($_POST['user']) && !empty($_POST['user'])) {
                $user = $_POST['user'];

                // Requete pour récup l'id de l'utilisateur
                $request = $database->prepare(
                    'SELECT id FROM users WHERE pseudo = :pseudo'
                );
                $request->execute([
                    'pseudo' => $user
                ]);
                $userId = $request->fetchColumn();

                if ($userId) {
                    // Requete pour insérer le tweet dans la DB
                    $request = $database->prepare(
                        'INSERT INTO tweets (message, author_id) VALUES (:message, :author_id)'
                    );
                    $request->execute([
                        'message' => $message,
                        'author_id' => $userId
                    ]);
                } else {
                    // Si l'utilisateur n'existe pas ça insérer le tweet sans l'id de l'utilisateur
                    $request = $database->prepare(
                        'INSERT INTO tweets (message) VALUES (:message)'
                    );
                    $request->execute([
                        'message' => $message
                    ]);
                }

                header('Location: http://localhost/?user=' . $user);
                exit();
            } else {
                die('Pseudo is missing');
            }
        } else {
            // Si le champ message est manquant, afficher une erreur
            die('Message is missing');
        }
    } else {
        // Si la méthode de requête n'est pas POST, afficher une erreur
        die('Method not allowed');
    }
} catch (PDOException $e) {
    // En cas d'erreur de connexion à la base de données, afficher un message d'erreur
    die('Could not connect to the database: ' . $e->getMessage()); //c'est bonnnnnn c'est fix
}
