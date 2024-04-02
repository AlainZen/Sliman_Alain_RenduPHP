<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['user'];
    $content = $_POST['content'];

    $sql = "INSERT INTO tweets (author_id, messages) VALUES ('$user', '$content')";
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Erreur : " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
