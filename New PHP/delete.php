<?php

try {
    
    $database = new PDO('mysql:host=localhost;dbname=twitter', 'root', '');

    
    if (isset($_POST['user']) && !empty($_POST['user'])) {
        $user = $_POST['user'];

       
        $request = $database->prepare(
            'SELECT id FROM users WHERE pseudo = :pseudo'
        );
        $request->execute([
            'pseudo' => $user
        ]);
        $userId = $request->fetchColumn();

        
        if ($userId) {
            
            $request = $database->prepare(
                'DELETE FROM tweets WHERE author_id = :user_id'
            );
            $request->execute([
                'user_id' => $userId
            ]);
        } else {
            
            throw new Exception("User doesn't exist");
        }

        // Rediriger vers la page d'accueil avec le pseudo de l'utilisateur
        header('Location: http://localhost/?user=' . $user);
        exit();
    } else {
        throw new Exception("User is missing");
    }
} catch (Exception $e) {
    die('Error: ' . $e->getMessage());
}
