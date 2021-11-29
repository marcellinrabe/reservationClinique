<?php
    include_once "C:/xampp/htdocs/rendez vous clinique/classes/personne.class.php";
    
    /* Attention!!! quand il faut instancier le client, il faut importer le fichier "personne.class.php" dans 
    la page dans laquelle on l'instancie */
    /* Tandremo, rehefa oe tena vita ny inscription vo créer ny client, ce qui veut dire que création de compte et l'enregistrement des
    informations personnelles dans la base doit se faire successivement et ensemble */
    class Clients extends Personne{
        protected $banque;
              
        function __construct(int $i, string $n, string $p, int $a, string $e, string $t, string $b, string $l, string $c){ // l as login
            $this->id = $i;
            $this->nom = $n;
            $this->prenom = $p;
            $this->age = $a;
            $this->email = $e;
            $this->telephone = $t;
            $this->banque = $b;
            $this->pseudo = $l;
            $this->code_ = $c;
            $this->photo = 'images/profile.png';
            $this->creation();
            
        }
        
        function get_info($colonne){
            switch($colonne){
                case 'nom':
                    return $this->nom;
                case 'prenom':
                    return $this->prenom;
                case 'age':
                    return $this->age;
                case 'email':
                    return $this->email;
                case 'telephone':
                    return $this->telephone;
                case 'banque':
                    return $this->banque;
                case 'photo':
                    return $this->photo;
                case 'pseudo':
                    return $this->pseudo;
                case 'code_':
                    return $this->code_;
                default:
                    return "parametre inconnu";
            }
        }

        public function creation(){
    /* le paramêtre optionnel zany soit numéro de carte bancaire ce qui doit être de type varchar afin de conserver le 0 
    @voalohany ra voalohany. de ny numéro de téléphone koa zany tokony karan'izany */
    /* se connecte au db et inserer les données du nouveau client */

            
            $r = Personne::requete('INSERT INTO clients(id, nom, prenom, age, email,
                                                     telephone, banque, photo, pseudo, code_) VALUES(
                                                     :id, :n, :p, :a, :e, :t, :b, :i, :l, :c);');
            $r-> execute(array('id'=> $this->id, 'n'=> $this->nom, 'p'=> $this->prenom, 
                               'a'=> $this->age, 'e'=> $this->email, 't'=> $this->telephone,
                               'b'=> $this->banque, 'i'=> $this->photo,
                               'l' => $this->pseudo, 'c' => $this->code_)); // i as image
        }
    }
?>