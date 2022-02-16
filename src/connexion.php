<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/compte.css">
</head>
<body>
    <form action="profile.php" method="post">
        <p>
            <label for="pseudo">Pseudo</label><br/>
            <input type="text" name="pseudo" id="pseudo" required>
        </p>
            
        <p>
            <label for="code_">Mot de passe</label><br/>
            <input type="password" name="code_" id="code_" required><br/>
        </p>
            
        <div class="submit"><input type="submit" value="connexion"></div>
    </form>
</body>
</html>