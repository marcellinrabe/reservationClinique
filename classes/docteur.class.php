<?php
    /* Attention!!! quand il faut instancier le docteur, il faut importer le fichier "personne.class.php" dans 
    la page dans laquelle on l'instancie */
    class Docteur extends Personne{
        protected $specialite;

        /* constante pour la representation des info du docteur */
        const WIDTH= '350px';
        const HEIGHT= '300px';
        const BORDER= 'rgb(58,198,97) solid 1px';
        const BORDER_RADIUS= '3px';
        /* ---------------------------------------------------- */
         
        function __construct( string $n, string $p, int $a, string $e, string $t, string $s, string $l, string $c){
            /* id pour l'id, n pour name, f pour first, $a pour age; $num pour number; */
            $this->nom = $n;
            $this->prenom = $p;
            $this->age = $a;
            $this->email = $e;
            $this->telephone = $t;
            $this->specialite = $s;
            $this->pseudo = $l;
            $this->code_ = $c;
            $this->photo = 'images/profile.png';
            $this->creation();
            //$this->compte = $this->creer_compte();
        }
    
        function get_info($colonne){
            switch($colonne){
                case 'nom':
                    return $this->nom;
                case "prenom":
                    return $this->prenom;
                case 'age':
                    return $this->age;
                case 'email':
                    return $this->email;
                case 'telephone':
                    return $this->telephone;
                case 'specialite':
                    return $this->specialite;
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

        public function presentation(){ 
            /* se connecter au db et soutirer le nom du docteur, son image et sa spécialité */ 
            echo '<div class="doctor_side" style="width: '.self::WIDTH.'; height: '.self::HEIGHT.'; border: '.self::BORDER.'; border-radius: '.self::BORDER_RADIUS.' ;">';
            echo '<img src="'.$this->photo.'" alt="image du docteur" class="docImg">';
            echo '<h1>'.$this->get_info('nom').'</h1>';
            echo '<p>'.$this->get_info('specialite').'</p>';
            echo '</div>';
        }

        public function creation(){
            /* le paramêtre optionnel zany soit numéro de carte bancaire ce qui doit être de type varchar afin de conserver le 0 
            @voalohany ra voalohany. de ny numéro de téléphone koa zany tokony karan'izany */
            /* se connecte au db et inserer les données du nouveau client */
                    
            $r = Personne::requete('INSERT INTO docteurs(id, nom, prenom, age, email, 
                                             telephone, specialite, photo, pseudo, code_) VALUES(
                                             :id, :n, :p, :a, :e, :t, :s, :i, :l, :c);'); //e comme enregistrement
            $r-> execute(array('id'=> $this->id, 'n'=> $this->nom, 'p'=> $this->prenom,
                               'a'=> $this->age, 'e'=> $this->email, 't'=> $this->telephone,
                               's'=> $this->specialite, 'i'=> $this->photo,
                               'l' => $this->pseudo, 'c' => $this->code_));
        }
    }
?>