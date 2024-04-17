<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <div class="container">
        <section class="feed">
            <form id="tweetForm" action="twitt.php" method="POST">
                <?php if (!empty($user)): ?>
                    <input type="hidden" name="user" value="<?= $user ?>">
                <?php endif; ?>
                
                <textarea placeholder="What's on your mind?" name="message"></textarea>
                <button type="submit">Tweet</button>
            </form>
            <ul>
                <?php foreach ($tweets as $tweet): ?>
                    <div class="tweet">
                        <h1><?= $tweet['pseudo'] ?></h1>
                        <li><?= $tweet['message'] ?></li>
                        
                        <!-- le btn supprimer ne s'affchiera que si le users connecter est bien le twittos -->
                        <?php if (!empty($user) && $tweet['pseudo'] === $user): ?>
                            <form action="delete.php" class="delete" method="post">
                                <input type="hidden" name="user" value="<?= $user ?>">
                                <button type="submit" class="delete-button">Supprimer</button>
                            </form>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </ul>
        </section>
    </div>

</body>

</html>
