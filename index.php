<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Let's chat !</title>
    <link rel="stylesheet" href="style.css">
    <script src="./app.js" defer></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>
<body>
    <h1>Let's Chat !</h1>

    <section class="chat">
        <div class="messages">
        </div>
        <div class="user-input">
            <form action="chat.php?action=list" method="post">
                <input type="text" id="author" name="author" placeholder="Pseudo">
                <input type="text" id="content" name="content" placeholder="Votre message...">
                <button type="submit">Envoyer</button>
            </form>
        </div>
    </section>
</body>
</html>