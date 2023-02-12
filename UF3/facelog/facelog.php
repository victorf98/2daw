<?php
require_once "includes/custom-pages.php";
require_once "includes/db.php";

/**
 * Plugin Name: FaceLog Plugin
 * Plugin URI: http://boscdelacoma.cat
 * Description: Pràctica MP07.
 * Version: 0.1
 * Author: ELTEUNOM
 * Author URI:  http://boscdelacoma.cat
 **/

 const FACELOG_DB_VERSION = '1.0';
 const FACELOG_VERSION= '1.0';
 
 // Allow subscribers to see Private posts and pages
 $subRole = get_role( 'subscriber' );
 $subRole->add_cap( 'read_private_posts' );
 $subRole->add_cap( 'read_private_pages' );
 
//Crear shortcodes
 add_shortcode('gallery', 'facelog_gallery');
 add_shortcode('addlog', 'facelog_addlog');


 //Funció per crear el post de la galeria
 function crearGaleria()
{
  // Create post object
  $my_post = array(
    'post_title'    => wp_strip_all_tags('FaceLog'),
    'post_content'  => file_get_contents(__DIR__ . '/index.php'),
    'post_status'   => 'publish',
    'post_author'   => 1,
    'post_type'     => 'page',
  );

  wp_insert_post($my_post);
}

//Funció per crear el post de l'addlog
function crearAddlog()
{
  // Create post object
  $my_post = array(
    'post_title'    => wp_strip_all_tags('AddLog'),
    'post_content'  => file_get_contents(__DIR__ . '/uploads/index.php'),
    'post_status'   => 'private',
    'post_author'   => 1,
    'post_type'     => 'page',
  );

  wp_insert_post($my_post);
}

//Funció per borrar el post de la galeria i l'addlog
 function borrarGaleriaiAddlog()
{
  // Obté la pàgina pel títol
  $face_log = get_page_by_title('FaceLog');
  $add_log = get_page_by_title('AddLog');

  // Borra la pàgina de la base de dades pàgina
  wp_delete_post($face_log->ID);
  wp_delete_post($add_log->ID);
}

//Funció per borrar les imatges
function borrarImatges(){
  $rutes_imatges = [];
  $rutes_imatges  = obtenirRutes();
  foreach ($rutes_imatges as $ruta) {
    unlink($ruta);
  }
}

//Funció que fa tot el necessari quan s'inicia el plugin
function installPlugin(){
  crearTaula();
  crearGaleria();
  crearAddlog();
}

//Funció que fa tot el necessari quan es desactiva el plugin
function uninstallPlugin(){
  borrarGaleriaiAddlog();
  borrarImatges();
  borrarTaula();
}

//Funció que carrega els estils
function wpse_load_plugin_css() {
  $plugin_url = plugin_dir_url( __FILE__ );

  wp_enqueue_style( 'style', $plugin_url . 'assets/css/style.css' );
}
add_action( 'wp_enqueue_scripts', 'wpse_load_plugin_css' );

//Activar i desactivar el plugin
register_activation_hook(__FILE__, 'installPlugin');
register_deactivation_hook(__FILE__, 'uninstallPlugin');