
<?php

    class Month{
        protected $strMonths =['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin',
                            'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
       
        public $intMonth;
        public $year;
        // public $current_week; class week
        protected $start; 
        protected $last;  
        public $day = array();

        public function __construct($m, $y){
            $param = $this->verifier($m, $y);
            $this->intMonth = $param[0];
            $this->year = $param[1];
            $this ->start = $this->first_day();
            $this->last = $this->last_day();
            // $this->current_week = 1;
        }


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

        public function get_value(int $horaire): int{
            /**
             * si le paramètre passé est m, alors la fonction retourne le mois
             * sinon si le paramètre est y, la fonction retourne l'année
             */
            switch($horaire){
                case 'm':
                    return $this->intMonth;
                case 'y':
                    return $this->year;
                default:
                    return NULL;
            }
        }

        private function verifier($m, $y):array {

            $m = $m ?? (int)date('m');
            $m = (int)$m;

            $y = $y ?? (int)date('Y');
            $y = (int)$y;

            if ($m < 1 || $m > 12){
                $m = $m === 0 ? 12 : ($m % 12);
            }
            return [$m, $y];
        }

        public function to_string():string{ // tokony manana copie week
            /**
             * retourne la date en format mars 2021(exemple)
             */
            return $this->strMonths[($this->intMonth)-1].' '.$this->year;
        }

        public function first_day(): DateTime{
            $d = "{$this->year}-{$this->intMonth}";
            return new DateTime($d);
        }

        public function last_day(): DateTime{
            $d = (clone $this->start)->modify('+1month - 1day');
            return $d;
        }
    
        public function get_allweeks_number():int{
            /**
             * get_allweeks_number
             * on va procéder ainsi pour savoir le nombre de semaine dans n'importe quelle mois
             * on soustrait le nombre de jour de la semaine de l'année pointant sur le dernier jour du mois
             * par le nombre de jour de la semaine de l'année pointant sur le premier jour du mois 
             * le tout plus 1
             * @param $start: premier jour de n'importe quelle mois
             * @param $end: dernier jour de n'importe quelle mois
             */
            $start = $this->first_day();
            $end = (clone $start)->modify('+1 month -1 day');
            $number = intval($end->format('W')) - intval($start->format('W')) + 1; // tokony +1 fona ra logique
            // pour le cas ou le nombre de semaine qu'on pointe est négatif
            if($number < 0){
                return $end->format('W');
            }
            return $number;
        }
    
        public function at_month(DateTime $d): bool{
            /**
             * si la date passée en paramètre est au même mois mois de l'année
             * que la date du premier jour du mois pointé alors ils sont dans la
             * même mois 
             */

            return $this->first_day()->format('Y-m') === $d->format('Y-m');
        }

        public function next_month():Month{
            $m = ($this->intMonth) + 1;
            $y = $this->year;
    
            if($m > 12){
                $m = 1;
                $y += 1;
            }
            return new Month($m, $y);
        }
    
        public function prev_month():Month{
            $m = ($this->intMonth)-1;
            $y = $this->year;
    
            if($m < 1){
                $m= 12;
                $y -= 1;
            }
            return new Month($m, $y);
        }
    }
        
    class Week extends Month{
        public $horaire = [7, 8, 9, 10, 11,12, 13, 14, 15, 16, 17, 18];
        public $strDays = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
        public $ref_month;
        public $start;
        public $last;
        public $current;
        

        public function __construct(Month $m, $cur){
            $this->ref_month = $m;
            $this->last = $this->ref_month->get_allweeks_number() - 1;
            $this->current = $cur ?? 1;
            $this->start = $this->first_ofweek($this->ref_month->intMonth, $this->ref_month->year);
        }

        public function prev_week():Week{
             
            return new Week($this->ref_month, $this->current-1);
        }

        public function first_ofweek():DateTime{
              $m = $this->ref_month->intMonth;
              $y = $this->ref_month->year;
            $d = $this->current > 2 ? (1 + 7*(($this->current)-2)):1;
            $first  = new DateTime("{$y}-{$m}-{$d}");
             return $first ->modify('last monday');
        }

        public function last_ofweek():DateTime{
            $start = $this->first_ofweek($this->ref_month->intMonth, $this->ref_month->year);
            return (clone $start)->modify('+1week -1day') ;
        }

        public function next_week():Week{
            
            return new Week($this->ref_month, $this->current+1);
        }

        function all_events(DateTime $d, $h){ // week, tokony select tous les évènements pendant cette semaine
                $events = array();
                $d= $d->format('Y-m-d');
                $r1 = Month::requete('SELECT DISTINCT heure_debut, heure_fin FROM rdv WHERE jour = :d AND heure_debut = :h ORDER BY heure_debut ASC');
                $r1->execute(['d'=> $d, 'h'=>$h]);
                $h = $r1->fetchAll(); 
            //echo '<pre>'; print_r($h); echo '</pre>'; 
            return $h;
        }

        public function to_string():string{ // tokony manana copie week
            /**
             * retourne la date en format mars 2021(exemple)
             */
            return $this->strMonths[($this->intMonth)-1].' '.$this->year;
        }
    }
   
?>