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
    $host ='localhost';
    $dbname = 'sql_exo';
    $user = 'root';
    $pass = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::ERRMODE_EXCEPTION);


        $stmt = $pdo->prepare("SELECT MIN(age) as age FROM user");
        if ($stmt->execute()) {
            $min = $stmt->fetch();
            echo "<div>" . "Le plus jeune a " . $min['age'] . "ans." . "</div>";
        }

        $stmt = $pdo->prepare("SELECT MAX(age) as age FROM user");
        if ($stmt->execute()) {
            $min = $stmt->fetch();
            echo "<div>" . "Le plus a " . $min['age'] . "ans." . "</div>";
        }


        $stmt = $pdo->prepare("SELECT count(*) as number FROM user");
        if ($stmt->execute()) {
            $count = $stmt->fetch();
            echo "nombre d'utilisateur : " . $count['number'] ;
        }


        $stmt = $pdo->prepare("SELECT count(*) as street FROM user");
        if ($stmt->execute()) {
            $count = $stmt->fetch();
            echo "<div>" . "les users ayant un num de rue égale ou supp a 5 " . $count['street'] . "</div>";
        }


        $stmt = $pdo->prepare("SELECT AVG(age) as average FROM user");
        if ($stmt->execute()) {
            $average = $stmt->fetch();
            echo "<div>" . "la moyenne d'âge des utilisateurs :" . $average['average'] . "</div>";
        }

        $stmt = $pdo->prepare("SELECT SUM(numero) as total FROM user");
        if ($stmt->execute()){
            $sum = $stmt->fetch();
            echo "Somme des numéros de maison des utilisateurs égale à : " . $sum['total'];
        }
    }
    catch (PDOException $e){
        echo $e->getMessage();
    }


    ?>
</body>
</html>

