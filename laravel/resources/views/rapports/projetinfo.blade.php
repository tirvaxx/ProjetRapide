

@extends('layouts.rapportsLayout')
@section('content')

<?php 
if(isset($dataRapport) ) {

  echo '<h1>' . $nomRapport . ' </h1>';
//  dd($dataRapport);
   

    $data = (array)$dataRapport;
    $prev_projet_id = 0;
    $projet_id =0;
    for($i=0; $i < count($data); $i++){
        $projet_id = $data[$i]->projet_id;   
 
         if($projet_id != $prev_projet_id && $prev_projet_id != 0) {
          echo '    </tbody>';
          echo '  </table>';
          echo '</div>';
        }
      
        if(  $prev_projet_id != $projet_id ){    
          echo '<div class="table-rapport table-responsive">';
          echo '  <table class="table-bordered table-hover">';
          echo '    <caption >' .   $data[$i]->projet_nom . ' </caption>';      
          echo '    <thead>';
          echo '      <tr>';
          echo '        <th>Projet Date dûe</th>';
          echo '        <th>Projet Jours retard</th>';
          echo '        <th>Projet Date Completée</th>';
          echo '        <th>Projet Jours Complétée</th>';

          echo '        <th>Sprint #</th>';
          echo '        <th>Sprint Date Début</th>';
          echo '        <th>Sprint Date Fin</th>';
          echo '        <th>Sprint Retard</th>';
          

          echo '        <th>Tache Nom</th>';
          echo '        <th>Tache Date dûe</th>';
          echo '        <th>Tache Jour Retard</th>';
          echo '      </tr>';
          echo '    </thead>';
          echo '    <tbody >';
        }
       
        echo '      <tr>';
        echo '        <td>' . $data[$i]->projet_date_du .'</td>';

        echo '        <td ' . ($data[$i]->projet_retard < 0 ? ' class="bg-danger" >' : '>  ') .   ($data[$i]->projet_retard < 0 ?  (-1 * $data[$i]->projet_retard) : '&nbsp;') . ' </td>';
        echo '        <td>' . $data[$i]->projet_date_complete .'</td>';
        echo '        <td>' . $data[$i]->projet_complete .'</td>';
        
        echo '        <td>' . $data[$i]->sprint_numero .'</td>';
        echo '        <td>' . $data[$i]->sprint_date_debut .'</td>';
        echo '        <td>' . $data[$i]->sprint_date_fin .'</td>';
        echo '        <td>' . $data[$i]->sprint_retard .'</td>';
        echo '        <td>' . $data[$i]->tache_nom .'</td>';
        echo '        <td>' . $data[$i]->tache_date_du .'</td>';
        
        echo '        <td>' . $data[$i]->tache_retard .'</td>';
        echo '      </tr>';
      
        $prev_projet_id = $projet_id;

            
     
    } //for

        echo '    </tbody>';
        echo '  </table>';
        echo '</div>';


 }else {
    echo "<h1>Rapport non disponible</h1>";
 } 
?>
  

@endsection


