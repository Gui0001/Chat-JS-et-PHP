<?php

try {
    // On définit les infos nécéssaires pour PDO (dsn)
    $dsn = "mysql:dbname=chat;host=localhost:3300";
    $user = "root";
    $password = "";
    $options = array(
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    );

    // Instanciation de PDO    
    $pdo = new PDO($dsn, $user, $password, $options);

    // On va passer par GET afin de savoir si on récupère les messages ou si on envoit via la variable action.
    // Par défaut on peut définir comme valeur pour $action "list"
    $action = "list";

    // Si action existe bien dans GET on récupère sa valeur
    if (array_key_exists('action', $_GET)) {
        $action = $_GET['action'];
    }

    // Fonction de récupération des messages
    function getMessages() {
        // On recup la variable pdo
        global $pdo;

        // On écrit notre requete SQL
        $req = $pdo->query("SELECT * FROM messages ORDER BY created_at DESC");

        // On vient fetchAll les résultats et on json_encode le resultat
        $messages = $req->fetchAll();
        echo json_encode($messages);
    }

    // Fonction d'envoit des messages
    function sendMessage() {
        // On recup la variable pdo
        global $pdo;

        // Si il manque auteur ou contenu alors on a une erreur
        if (!empty($_POST['author']) && !empty($_POST['content'])) {
            $author = $_POST['author'];
            $content = $_POST['content'];
        } else {
            echo "Il manque des champs !";
        }

        // On prépare notre requete SQL
        $req = $pdo->prepare("INSERT INTO messages (author, content, created_at) VALUES (:author, :content, NOW())");

        // On vient expliciter les variables. On peut aussi utiliser bind_params
        $req->bindParam(':author', $author);
        $req->bindParam(':content', $content);

        // On éxecute la requete
        $req->execute();
    }

    // Condition : selon la valeur de l'action on appelle la bonne fonction
    if ($action == "write") {
        sendMessage();
    } else {
        getMessages();
    }
}
catch (PDOException $error) {
    die("Il y a une erreur : " . $error . "<br>");
}