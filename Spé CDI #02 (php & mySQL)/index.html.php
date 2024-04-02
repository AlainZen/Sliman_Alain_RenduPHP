<?php 
include 'db_connection.php';
$token = uniqid();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mini Twitter</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <aside>
        </aside>
        <section class="feed">
            <form action="add_tweet.php" method="post">
                <textarea name="content" placeholder="Quoi de neuf ?"></textarea>
                <input type="text" name="user" placeholder="Votre nom">
                <button type="submit">Tweeter</button>
            </form>
            <div class="tweets">
                <?php
                $sql = "SELECT * FROM tweets";
                $result = mysqli_query($conn, $sql);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='tweet'>";
                        echo "<p>" . $row['messages'] . "</p>";
                        echo "<span>Par: " . $row['author_id'] . "</span>";
                        echo "<a href='delete_tweet.php?tweet_id=" . $row['id'] . "'>Supprimer</a>";
                        echo "</div>";
                    }
                } else {
                    echo "Aucun tweet trouvé.";
                }
                ?>
            </div>
        </section>
    </div>
</body>
</html>

