<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
    /**
     * 1. Importez le contenu du fichier user.sql dans une nouvelle base de données.
     * 2. Utilisez un des objets de connexion que nous avons fait ensemble pour vous connecter à votre base de données.
     *
     * Pour chaque résultat de requête, affichez les informations, ex:  Age minimum: 36 ans <br>   ( pour obtenir une information par ligne ).
     *
     * 3. Récupérez l'age minimum des utilisateurs.
     * 4. Récupérez l'âge maximum des utilisateurs.
     * 5. Récupérez le nombre total d'utilisateurs dans la table à l'aide de la fonction d'agrégation COUNT().
     * 6. Récupérer le nombre d'utilisateurs ayant un numéro de rue plus grand ou égal à 5.
     * 7. Récupérez la moyenne d'âge des utilisateurs.
     * 8. Récupérer la somme des numéros de maison des utilisateurs ( bien que ca n'ait pas de sens ).
     */

    // TODO Votre code ici, commencez par require un des objet de connexion que nous avons fait ensemble.

    $server = 'localhost';
    $user = 'root';
    $pwd = '';
    $db = 'base_test';

    try {

        $maConnexion = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $pwd);
        $maConnexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $maConnexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        //question 3
        $pom = $maConnexion->prepare("SELECT MIN(age) as minimum FROM user");

        $state = $pom->execute();

        if ($state) {
            $min = $pom->fetch();
            echo "<div>Le plus petit age trouver est: " . $min['minimum'] . " ans</div>";
        } else {
            echo "Une erreur est survenue en récupérant les données de la table.";
        }

        //question 4
        $pom = $maConnexion->prepare("SELECT MAX(age) as maximum FROM user");

        $state = $pom->execute();

        if ($state) {
            $max = $pom->fetch();
            echo "<div>Le plus grand age trouver est: " . $max['maximum'] . " ans</div>";
        } else {
            echo "Une erreur est survenue en récupérant les données de la table.";
        }

        //question 5
        $pom = $maConnexion->prepare("SELECT count(*) as number FROM user WHERE nom");

        $state = $pom->execute();

        if ($state) {
            $count = $pom->fetch();
            echo "<div>Le nombre d'utilisateur est: " . $count['number'] . "</div>";
        } else {
            echo "Une erreur est survenue en récupérant les données de la table.";
        }

        //question 6
        $pom = $maConnexion->prepare("SELECT count(*) as number FROM user WHERE numero >= 5");

        $state = $pom->execute();

        if ($state) {
            $count = $pom->fetch();
            echo "<div>Le nombre d'utilisateur ayant un numero de rue supérieur ou égale à cinq est: " . $count['number'] . "</div>";
        } else {
            echo "Une erreur est survenue en récupérant les données de la table.";
        }

        //question 7
        $pom = $maConnexion->prepare("SELECT AVG(age) as moyenne_age FROM user");

        $state = $pom->execute();

        if ($state) {
            $average = $pom->fetch();
            echo "<div>L'age moyen des utilisateurs est: " . $average['moyenne_age'] . " ans</div>";
        } else {
            echo "Une erreur est survenue en récupérant les données de la table.";
        }

        //question 8
        $pom = $maConnexion->prepare("SELECT SUM(numero) as somme_numero FROM user");

        $state = $pom->execute();

        if ($state) {
            $sum = $pom->fetch();
            echo "<div>La somme des numéro de maison des utilisateurs est: " . $sum['somme_numero'] . "</div>";
        } else {
            echo "Une erreur est survenue en récupérant les données de la table.";
        }
    }
    catch (PDOException $exception) {
        echo "Erreur de connexion: " . $exception->getMessage();
    }

    ?>
</body>
</html>

