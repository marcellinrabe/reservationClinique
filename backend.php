<!-- c'est ici que se situe l'industrie des données 
Tout les données entrées par l'utilisateur sont renvoyés en premier abord ici, 
puis verifier et traiter ici avant des les renvoyés vers les pages respectives.
-->
<?php
    //header('Location:profile.php?pseudo='.$_POST['pseudo']?? ($_GET['pseudo'] ?? $_SESSION['pseudo']).'&code_='.$_POST['code_']??$_GET['code_']);
    session_start();
    include_once "C:/xampp/htdocs/rendez vous clinique/classes/client.class.php";
    include_once "C:/xampp/htdocs/rendez vous clinique/classes/compte.class.php";
    include_once "C:/xampp/htdocs/rendez vous clinique/classes/personne.class.php";
    
    /*$c= Comptes::requete('SELECT pseudo FROM compte where pseudo = :pseudo');
    $c->execute(    ['pseudo' => $_POST['pseudo'] ?? $_SESSION['pseudo']]);
    if($c->fetch()){
       echo '<p style="color:red; text-align:center;">';
        echo 'Le pseudo existe déjà</p>';
        include 'inscription.php';
    }
    
    if($_POST['code_'] != $_POST['code_repeat']){
        echo '<p style="color:red; text-align:center;">';
        echo 'mot de passe incorrect</p>';
        include 'inscription.php';
    }
    else{
        $clients_liste = new Comptes('client', $_POST['pseudo'], $_POST['code_'],$_POST['nom'], $_POST['prenom'], 
                                     (int)$_POST['age'], $_POST['email'], $_POST['telephone'], $_POST['banque']);
        ?>
        </form> */  

if(isset($_SESSION['id'])){
    $s = new DateTime($_GET['h']);
    $s_fin = (clone $s);
    $s_fin = $s_fin->modify('+1 hours');
    $i = Comptes::requete('INSERT INTO rdv(jour, heure_debut, heure_fin) VALUES(:d, :s, :e)');
    $i->execute(    ['d'=> $_GET['d'],
                     's'=> $s->format('H:i:s'),
                     'e'=> $s_fin->format('H:i:s')
    ]  );

    $info = Comptes::requete('SELECT id_rdv FROM rdv WHERE jour= :d AND  heure_debut= :s');
    $info->execute(    ['d'=> $_GET['d'],
                        's'=> $s->format('H:i:s')
    ]  );
    $result = $info->fetch();
    echo '<p>Bonjour Mr/Mme '.$_SESSION['pseudo'].'</p>';
    echo '<p>Votre rendez vous est le '. $_GET['d'].' à '.$s->format('H:i:s').'</p>';
    echo '<p>Numéro de rendez-vous: '.$result['id_rdv'];
}         
?>
<p><a href="indexa.php">Acceuil</a></p>
<P><a href="profile.php?pseudo=<?= $_SESSION['pseudo'] ?>&code_=<?= $_SESSION['code'] ?>">Mon compte</a></p>
