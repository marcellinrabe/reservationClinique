<link rel="stylesheet" href="css/calendrier.css">
<?php
    include 'classes/semaine.class.php';

    try{
        $month = new Month($_GET['m'] ?? NULL, $_GET['y'] ?? NULL);
        $week = new Week($month, $_GET['w'] ?? NULL);
    }
    catch(Exception $e){
        $month = new Month(NULL, NULL);
        $week = new Week($month,  NULL);
    }
    $week->current = $_GET['w'] ?? $week->current; // 1 par défaut

    $start = $week->first_ofweek($week->ref_month->intMonth, $week->ref_month->year)/*->format('Y-m-d')*/; // 1 jour de la semaine
    $maintenant = date('Y-m-d');
    $tab_maintenant = explode('-', $maintenant);
    $tab_limite= [];
    $limite = $start->format('Y-m-d');
    $tab_limite= explode('-', $limite);


?>

<p class="lien">
    <a href="indexa.php?w= <?=$week->current<2 ? $week->last+1:intval(($week->current)-1); ?>&m=<?= $week->current<2? $week->ref_month->prev_month()->intMonth:$week->ref_month->intMonth;?>&y=<?=$week->current<2? $week->ref_month->prev_month()->year:$month->year; ?>">
        <?php if(intval($tab_maintenant[1]) <= intval($tab_limite[1])): echo 'précedent |'; endif; ?>
    </a>
    <p class="mois"><?= $month->to_string(); ?></p>
    <a href="indexa.php?w=<?=$week->current< ($week->last)-1 ? intval(($week->current)+1): 1;?>&m=<?= $week->current<($week->last)-1? $month->intMonth: $week->ref_month->next_month()->intMonth;?>&y=<?= $week->current<($week->last)-1? $month->year: $month->next_month()->year;?>">| suivant</a>
</p>

<table>
    <?php
    
        foreach($week->horaire as $ligne => $hour): ?>
            <tr>
                <?php foreach($week->strDays as $cle => $strDay):
                 // on parcourt les jours de la semaine
                 $day = (clone $week->start)->modify(" + {$cle} days"); 
                 $test = $_SESSION['id'] ?? NULL;
                 $ligne_timestamp = gmmktime($hour-2,0,0,$day->format('m'),$day->format('Y'),$day->format('d'));
                $d = date('H:i:s', $ligne_timestamp);

                 $condition =  $test ? 'backend.php?d='.$day->format('Y-m-d').'&h='.($d) : ' connexion.php';
                ?>
                 
                 <td class=" <?= $month->at_month($day)?' ' :'in_previously_month';?>">
                    <?php if($ligne !== 0) : 
                            $events = $week->all_events($day, $d);
                            echo $events[0]['heure_debut'] ?? ' '.'<br/>';
                        ?>
                        
                        <a class="rdv" href="<?= $condition;?>">
                    <?php
                    endif;
                    ?>
                     <?php if($ligne === 0):
                        echo $strDay.'<br/>';
                        echo $day->format('d'); 
                else:
                    if(!(isset($events[0]['heure_debut']))):
                    echo "prendre rendez-vous";
                    endif;
                endif;
                if($ligne !== 0){ echo '</a>';};    
                    ?>          
               </td>

                <?php 
                endforeach; ?>
            </tr>
<?php endforeach; 

?>
</table>

