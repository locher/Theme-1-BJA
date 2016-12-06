<?php
    $absolute_path = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
    $wp_load = $absolute_path[0] . 'wp-load.php';
    require_once($wp_load);

    header('Content-type: text/css');
    header('Cache-control: must-revalidate');

    $colorAdmin = get_field('couleur_principale', 'option', false);

    echo str_replace(array("#ff0000"), $colorAdmin, file_get_contents('style.css'));

?>