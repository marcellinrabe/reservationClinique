<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inscription</title>
        <link rel="stylesheet" href="css/compte.css">
    </head>
    <body>
        <form action="backend.php" method="post">
            <p>
                <label for="pseudo">Pseudo</label><br/>
                <input type="text" name="pseudo" id="pseudo" required>
            </p>
        <div class="uneligne">
            <p>
                <label for="code_">Mot de passe</label><br/>
                <input type="password" name="code_" id="code_" required><br/>
            </p>
                
            <p>
                <label for="code_repeat">Vérifier le mot de passe</label><br/>
                <input type="password" name="code_repeat" id="code_repeat" required><br/>
            </p>
        </div>

        <div class="uneligne">
            <p>
                <label for="nom">Nom</label><br/>
                <input type="text" name="nom" id="nom" required><br/>
            </p>
        
            <p>
                <label for="prenom">Prénom</label><br/>
                <input type="text" name="prenom" id="prenom" required><br/>
            </p>
        </div>
        
        <div class="uneligne">
            <p>
                <label for="age">Age</label><br/> <!-- supérieur à 18 -->
                <input type="text" name="age" id="age" required><br/>
            </p>
            
            <p>
                <label for="email">Adresse email</label><br/>
                <input type="email" name="email" id="email" required>
            </p>
        </div>
        
        <p>
            <label for="telephone">Numéro de téléphone</label><br/> 
            <input type="tel" name="telephone" id="telephone" required><br/><br/>
            <a href="#whyTel">Pourquoi vouloir votre numéro de téléphone ?</a><br/> <!-- ancrer @na partie ambany page any fotsiny -->
        </p>
        
        <p>
            <label for="banque">Numéro de carte bancaire</label><br/> 
            <input type="text" name="banque" id="banque" required><br/><br/>
            <a href="#whyBanque">Pourquoi vouloir votre numéro de carte bancaire ?</a><br/> <!-- regex @ty de ancrer @na partie ambany page any fotsiny -->
        </p>

        <div><input type="submit" value="s'enregistrer"></div>
    </form>
    <body>
</html>
