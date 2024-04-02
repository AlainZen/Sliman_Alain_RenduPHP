<?php
include 'db_connection.php';


if (isset($_GET['tweet_id'])) {
    
    $tweet_id = $_GET['tweet_id'];
    $sql = "DELETE FROM tweets WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $tweet_id);
    $result = mysqli_stmt_execute($stmt);

    
    if ($result) {
        
        header("Location: index.php");
        exit();
    } else {
        echo "Erreur lors de la suppression du tweet.";
    }
} else {
    header("Location: index.php");
    exit();
}
?>

