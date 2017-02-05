<?php 

if ($_GET['c']):
    
    $invites = new WP_Query(array(
        'post_type'=>'invite',
        'posts_per_page'=>-1
    ));
    
    if ($invites->have_posts()):
    
    //création du tableau avec les entêtes
    $list_invites = array(array('Nom','Email','Participera ?', 'Nombre de personnes','Noms des accompagnants','Message'));
    $nbPersonnesTotales = 0;
    
    while ($invites->have_posts()) : $invites->the_post();

    // Noms des accompagnants    
    $nomsAccompagnants = '';
    
    if(have_rows('accompagnants')){
        while( have_rows('accompagnants') ): the_row();
        $nomsAccompagnants .= get_sub_field('nom').', ';
        endwhile;
    }

    //Remplacer les 1 par des Oui ou Non
    $participera = get_field('participera');
    if($participera == 1) $participera = 'Oui';
    else $participera = 'Non';
    
    $accompagne = get_field('accompagne');
    if($accompagne == 1) $accompagne = 'Oui';
    else $accompagne = 'Non';   

    //Ajout d'autant ligne qu'il y a dans le while
    array_push($list_invites, array(get_the_title(), get_field('email'), $participera, get_field('nombre_de_personnes'), $nomsAccompagnants, strip_tags(get_field('message_facultatif'))));
    $nbPersonnesTotales += get_field('nombre_de_personnes');
    
    endwhile;

    array_push($list_invites, array('', '', '', 'Nombres de personnes total : '.$nbPersonnesTotales, '', ''));
    
    endif; //query   
    

    //Création du CSV
    function outputCSV($data) {
        $outputBuffer = fopen("php://output", 'w');
        foreach($data as $val) {
            fputcsv($outputBuffer, $val);
        }
        fclose($outputBuffer);
    }
    
    $filename = "liste-invites_".date("j.n.Y_G.i.s");

    header("Content-type: text/csv");
    header("Content-Disposition: attachment; filename={$filename}.csv");
    header("Pragma: no-cache");
    header("Expires: 0");

    outputCSV($list_invites);  

    exit;
    
endif;

?>

<div class="wrap">

<h1>Export CSV de la liste des invités</h1>

<p>Le fichier généré est un .csv, utilisable avec n'importe quel tableur (Excel, Numbers, Google drive, etc.)<br/>
Le nom du ficher est composé de la date et de l'heure du jour, pour que vous sachiez toujours lequel est le plus récent.</p>
<a href="<?php echo $_SERVER['REQUEST_URI']; ?>&c=1&noheader=true" class="button-primary">Exporter la liste au format .csv</a>

<h2>Tableau récapitulatif</h2>

<?php
  
    $invites = new WP_Query(array(
        'post_type'=>'invite',
        'posts_per_page'=>-1
    ));

    if ($invites->have_posts()): 

    echo('<table class="widefat striped pages"><thead><tr><th class="manage-column">Nom</th><th class="manage-column">Email</th><th class="manage-column">Participera</th><th class="manage-column">Nombre de personnes</th><th class="manage-column">Nom des accompagnants</th><th class="manage-column">Message</th></tr></thead>');
    
    $nbPersonnesTotales = 0;

    while ($invites->have_posts()) : $invites->the_post();
    
    $participera = get_field('participera');
    if($participera == 1) $participera = '<strong style="color: green">Oui</strong>';
    else $participera = '<span style="color:red;">Non</span>';
    
    $accompagne = get_field('accompagne');
    if($accompagne == 1) $accompagne = '<strong style="color: green">Oui</strong>';
    else $accompagne = '<span style="color:red;">Non</span>';   
    
    $nbPersonnes = get_field('nombre_de_personnes');
    
    $nbPersonnesTotales += $nbPersonnes;
    
    // Noms des accompagnants
    
    $nomsAccompagnants = '';
    
    if(have_rows('accompagnants')){
        while( have_rows('accompagnants') ): the_row();
        $nomsAccompagnants .= get_sub_field('nom').', ';
        endwhile;
    }

    echo('<tr><td>'.get_the_title().'</td><td>'.get_field('email').'</td><td>'.$participera.'</td><td>'.$nbPersonnes.'</td><td>'.$nomsAccompagnants.'</td><td>'.get_field('message_facultatif').'</td></tr>');

    endwhile; 
    
    echo('<tfoot><tr><th class="manage-column"></th><th class="manage-column"></th><th class="manage-column"></th><th class="manage-column">'.$nbPersonnesTotales.'</th><th class="manage-column"></th><th class="manage-column"></th></tr></tfoot>');

    echo("</table>");
    
    endif;
    
?>

<h2>Nombre total de personnes présentes : <?php echo $nbPersonnesTotales;?></h2>

</div>