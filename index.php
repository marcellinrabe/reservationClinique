<?php

    declare(strict_types= 1); 
    session_start();

    # import all classes 
    spl_autoload_register(function($classe){
        require 'classes/' .$classe. '.class.php';
    });



// tokony dans tout les pages le fonction connexion[@db]() mila accessible, de nataoko any @fichier "personne.class.php" aloha ilay izy
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>titre de la page</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/calendrier.css">
</head>
<body>
    <div class="blocPage">
        <header>
            <?php include "classes/personne.class.php";?>
            <?php include "classes/docteur.class.php";?>

            <div class="background">
                <nav> <!-- (1) -->


                <a href="connexion.php">connexion</a> <!-- login.php -->
                    <a href="inscription.php">s'incrire</a>
                </nav>
            </div>
            <div class="grandTitre"><h1>NOM DE LA CLINIQUE</h1></div>
            <div class="options"> <!-- centrer -->
                <h2>En quoi pouvons-nous vous aider ?</h2> 
                <a href="#example">réserver une horaire</a>
                <a href="#consultation">consulter votre horaire</a>
            </div>
        </header>
        <div class="forDocList"> <!-- (2) --> 
            
            <?php 
                //docteurs->presentation()
                
            ?>

        </div>
        <section class="reservation">
            <h1 id="example">Reserver une horaire</h1>
            <div class="calendar">
                <?php include 'calendrier.php'; ?>
            </div>
        <!--(3)  --> 

        </section>

        <section class="consultation">
            <h1 id="consultation" >Rechercher votre horaire de rendez-vous</h1>
            <form action="index.php" method="post">
                <input type="search" placeholder="le numéro de votre rendez-vous ex:RDV1" name="recherche" id="recherche">
                <input type="submit" value="rechercher">
                <div class="errorSearch">
                       <!-- (4) -->
                </div>
            </form>
        </section>
<?php
    if(isset($_POST['recherche'])):
        $rdv = 'rdv';
    $r = Personne::requete('SELECT * FROM rdv ');
    $r->execute([]);
    $i = 0;
    while($id = $r->fetch()){
        if($id['id_rdv'] === $_POST['recherche']){
            $i+=1;
            $_SESSION['date'] = $id['jour'];
            $_SESSION['heure'] = $id['heure_debut'];
        }
    }
    if($i === 0){
        echo 'numéro de rendez vous invalide<br/>';
    }
    else{
        echo 'Date :'.$_SESSION['date'];
        echo '<br/>Heure :'.$_SESSION['heure'];
    }
   
endif;
?>
        <footer>
            <a href="infoPlus.php">A propos</a>
            <p>Mini projet à rendre à Mr Nirina(ESTI)</p>
        </footer>
    </div>
</body>
</html>

<!--
Explication:

(1): coin @angle droite en haut 
    <a href="profile.php">profil</a>  accessible seulement si l'internaute est connecté sinon, on nous renvoie
    un message qui nous sollicite de se connecter ou de créer un compte  
            
            
             Eclaircissement à propos de la page du profil:
            Dans la page profil, le client peut ajouter son photo pour le faire reconnaître.
            Dans la page profil sont listés ses informations personnelles. Les noms et Prénoms, âge ne sont 
            jamais modifiables tandisque que son numéro de téléphone et sa carte bancaire l'est.
            Dans la page profil, le client est informée de ses derniers historique de rendez-vous et si il y a
            un ou des rendez-vous à venir: il(s) s'afficheront aussi
            (je sais! c'est du boulot mais au moins ce sera cool :) ) 


(2): la liste des docteurs se défile un à un chacun leur tour en animation 
    d'intervalle de temps de 5s 
        
         Explication à propos de la liste des docteurs:
        Je suppose de créer 3 ou 4 docteurs fictives avec des spécialités différentes et les informations
        à propos d'eux(nom, image et spécialité seulement) se défileront ici à tour de rôle et en boucle


(3): Explication à propos de la calendrier :
            Quand l'utilisateur est connecté ou pas, dans cette section s'afficher une calendrier des horaires 
            disponibles: sur les horaires disponsibles sont disponibles sont afficher les mots "déjà reservé".
            Quand on n'est pas connecté et qu'on clique sur une horaire dispo, on nous renvoie une message qui
            nous sollicite de se connecter ou de créer un compte afin de réserver une horaire.
            Enfin, quand on est connecté et qu'on clique sur une horaire dispo, il s'afficher un bouton "reserver
            cette horaire" et c'est après quand on clique sur le bouton que la réservation est terminé, on a déja 
            pris le prix du consultation à ce moment-là. Une réservation peut être annulé avant 48heures de la 
            rendez-vous mais il n'y aura pas de rembourssement. L'annulation de la réservation se fasse dans la page
            profile dans le fichier "profile.php"

(4): Ici s'affiche le résultat du recherche<br/>
    S'il y a erreur(pseudo incorrect) alors On nous renvoie un message qui sollicite de bien 
    vérifier le pseudo entré<br/>
-->