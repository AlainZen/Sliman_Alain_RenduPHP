<?php


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
                    // Si l'utilisateur n'existe pas il peut quand meme tweeter
                    $request = $database->prepare(
                        'INSERT INTO tweets (message) VALUES (:message)'
                    );
                    $request->execute([
                        'message' => $message
                    ]);
                }
                

                header('Location: http://localhost/?user=' . $user);
                exit();
            }else {
                    echo 'Erreur';
                    echo $_POST['message'];
                    echo $_POST['user'];
                    

        }
    }
}