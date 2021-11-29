<?php
    include_once "C:/xampp/htdocs/rendez vous clinique/classes/personne.class.php";
    include_once "C:/xampp/htdocs/rendez vous clinique/classes/client.class.php";
    include_once "C:/xampp/htdocs/rendez vous clinique/classes/docteur.class.php";




    class Comptes extends Personne{
        private static $personne;
        public static $client;
        public static $docteur;

    
        public function __construct(string $olona, string $p, string $c, string $n, string $f, int $a, string $e, string $t, string $o){
            //$this->personne = $olona; 
            $this->pseudo = $p;
            $this->code_ = $c;
            $this->nom = $n;
            $this->prenom = $f;
            $this->age = $a;
            $this->email = $e;
            $this->telephone = $t;
            switch($olona){
                case 'client':
                    $this->banque = $o;
                    break;
                case 'docteur':
                    $this->specialite = $o;
                    break;
                default:
                    return false;
            }
            $this->creation();
        }

        public function creation(){
            // verification si un pseudo de même nom existe déjà
                $r = Personne::requete('SELECT pseudo FROM Compte WHERE pseudo = :pseudo;');
                $r->execute(array('pseudo'=>$this->pseudo));
                if($r->fetch()){
                    echo '<p style="color:red; text-align:center;">';
                    echo 'le pseudo existe déjà</p>';
                    include 'inscription.php';     
                }
                else{
                    $r->closeCursor(); 
                    //fini pour la verification et laissons place à l'enregistrement dans la base

                    // insertion dans la base
                    $e = Personne::requete('INSERT INTO Compte(pseudo, code_) VALUES(:pseudo, :code_);');
                    $e-> execute(array('pseudo'=> $this->pseudo,'code_'=> $this->code_));
            
                    $i = Personne::requete('SELECT * FROM Compte WHERE pseudo = :pseudo;');
                    $i->execute(array('pseudo'=>$this->pseudo));
                    if($one = $i->fetch());
                    switch(self::$personne){
                    case 'client':
                        new Clients($one['id'], $this->nom, $this->prenom,
                                    $this->age, $this->email, $this->telephone,
                                    $this->banque, $one['pseudo'], $one['code_']);
                        break;
                    case 'docteur':
                        new Docteur($one['id'], $this->nom, $this->prenom,
                                    $this->age, $this->email, $this->telephone,
                                    $this->specialite, $one['pseudo'], $one['code_']);

                        break;
                    default:
                        break;
                }
            }
        }

        public function get_info($colonne){
            switch($colonne){
                case 'code':
                    return $this->code_;
                    break;
                default:
                    return 'paramètre inconnu';
            }
        }

            

        public function suppression(){
            $s = Personne::requete('DELETE FROM Compte WHERE pseudo :pseudo;');
            $s->execute(array('pseudo'=>$_SESSION['pseudo']));
            unset($_SESSION['pseudo']);

            $i = Personne::requete('SELECT id_compte FROM Compte WHERE pseudo = :pseudo;');
            $i->execute(array('pseudo'=>$this->pseudo));
            $one = $i->fetch();

            switch(self::$personne){
                case 'client':
                    $d = Personne::requete('DELETE FROM Clients WHERE id_compte :i;');
                    $d->execute(array('i'=> $one['id']));
                    break;
                
                case 'docteurs':
                    $d = Personne::requete('DELETE FROM Docteurs WHERE id_compte :i;');
                    $d->execute(array('i'=> $one['id']));
                    break;

                default:
                    return false;
            }
        }

        static function se_connecter(string $p, string $c){
            $v = Personne::requete('SELECT code_ FROM Compte WHERE pseudo = :pseudo'); // v comme verification
            $v->execute(array('pseudo'=>$p));

            if($pass = $v->fetch()){
                if($pass['code_'] != $c){
                    return 'mot de passe incorrect';
                }
            }
            else{
                    return 'le pseudo n\'existe pas';
            }

            return 'connecté';


        }   
    }


?>