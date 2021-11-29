<?php
    declare(strict_types= 1);
    
    abstract class Personne{
        protected $id;
        protected $nom;
        protected $prenom;
        protected $age;
        protected $email;
        protected $telephone;
        protected $photo;
        protected $compte;
        protected $pseudo;
        protected $code_;


    abstract function get_info($colonne);
    abstract function creation();

    static function requete(string $query){
        // retourne l'objet de connexion
        try{
            $c= new PDO('mysql:host=localhost;dbname=clinique', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); // c comme connexion
        }
        catch(Exception $e){
            die('Erreur : '.$e->getMessage());
        }

        $r = $c->prepare($query);
        return $r;
    }
    
    private function distinguer_user(string $personne, string $colonne){ //  distingue si la personne est client ou docteur et renvoie nom de la table respective
        if($colonne!=='id' && ($personne=='client' || $personne =='docteur')){
            $table = NULL;
            switch($personne){
                case 'client':
                    if($colonne=='specialite'){return false;}
                    else {
                        $table = "Clients";
                        return $table;
                    }
                    break;
                
                case 'docteur':
                    if($colonne!='banque'){return false;}
                    else{
                        $table = 'Docteurs';
                        return $table;
                    }
                    break;
                default:
                    break;
            }
        }
        else{
            return false;
        }
    }

    function set_info(string $personne, string $colonne, string $valeur){
        $table = $this->distinguer_user($personne, $colonne);
        if(!$table){
            die('erreur');
        }

        $r = self::requete('UPDATE :tables SET :colonne = :valeur WHERE id = :id;');
        $r->execute(array('tables' => $table, 
                          'colonne' => $colonne,
                          'valeur' => $valeur));
        return true;
    }
}
?>