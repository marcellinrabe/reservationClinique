<?php
    session_start();
    $pseudo = $_POST['pseudo'] ?? $_GET['pseudo'];
    $code = $_POST['code_'] ?? $_SESSION['code_'];


    $statut = Comptes::se_connecter($pseudo, $code);
    if(isset($_POST['pseudo'])):
        if($pseudo === $_POST['pseudo']):
            switch($statut):
                case 'le pseudo n\'existe pas':
                    echo '<p style="color:red; text-align:center;">';
                    echo $statut.'</p>';
                    include 'connexion.php';
                    break;

                case 'mot de passe incorrect':
                    echo '<p style="color:red; text-align:center;">';
                    echo $statut.'</p>';
                    include 'connexion.php';
                    break;
                default:
                    break;
            endswitch;
        endif;
    endif;

    $r = Comptes::requete('SELECT id FROM Clients WHERE pseudo = :p');
    $r -> execute(  ['p'=> $pseudo]  );
    $r = $r->fetch();


$_SESSION['id'] = $r['id'];
$_SESSION['pseudo'] = $pseudo;
$_SESSION['code_'] = $code;



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['pseudo'];?></title>
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>
    <a href="index.php?id=<?= $_SESSION['id']?>"> prendre rendez-vous </a>
    <!-- code html
    mi afficher informations 
    image
    pseudo
    telephone
    mail
    carte bancaire
    (button modifier informations)
    rehefa vo clique le button modifier informations:
        input image
        input pseudo
        input telephone 
        input carte bancaire
        (fichier vaovao info.php)

    rendez-vous a venir;
    -->
</body>
</html>

