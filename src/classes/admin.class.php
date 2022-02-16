<?php
    session_start();
    include_once "C:/xampp/htdocs/rendez vous clinique/classes/compte.class.php";
    include_once "C:/xampp/htdocs/rendez vous clinique/classes/docteur.class.php";

    class Admin{

        protected $docteurs_liste;

        function __construct(){
            $this->docteurs_liste = array();
        }

        public function ajouter_docteur(string $n, string $p, int $a, string $e, string $t, string $s, string $l, string $c){
            $this->docteurs_liste[]= new Docteur($n, $p, $a, $e, $t, $s, $l, $c);
        }
    }
?>