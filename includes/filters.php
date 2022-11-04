<?php

/**
 * this filter take archive and redirect to plugin archive function
 *
 * @param [string]  $original_template
 * @return [string] $template_directory
 */
function thinkus_employee_templates($original_template){
    // Check Theme Template or Plugin Template for archive-colective_society.php
    $file = trailingslashit(get_stylesheet_directory()) . 'archive-thinkus_employee.php';
    if(is_post_type_archive('thinkus_employee')) {
        //if archive-colective_society.php in the current  theme, else return the archive-colective_society.php file to the current tplugins directory.
        if(file_exists($file)) {
            return trailingslashit(get_stylesheet_directory()).'archive-thinkus_employee.php';
        } else {
            return THINKEMPLOYEE_PLUGIN_DIR . 'templates/archive-thinkus_employee.php';
        }
    } elseif(is_singular('thinkus_employee')) {
        if(file_exists(get_stylesheet_directory_uri() . 'single-thinkus_employee.php')) {
            return get_stylesheet_directory_uri() . 'single-thinkus_employee.php';
        } else {
            return THINKEMPLOYEE_PLUGIN_DIR . '/templates/single-thinkus_employee.php';
        }
    }elseif(is_tax('thinkus_ubicacion')){
        if(file_exists(get_stylesheet_directory_uri() . 'taxonomy-thinkus_ubicacion.php')) {
            return get_stylesheet_directory_uri() . 'taxonomy-thinkus_ubicacion.php';
        } else {
            return THINKEMPLOYEE_PLUGIN_DIR . '/templates/taxonomy-thinkus_ubicacion.php';
        }
    }elseif(is_tax('thinkus_ciudad')){
        if(file_exists(get_stylesheet_directory_uri() . 'taxonomy-thinkus_ciudad.php')) {
            return get_stylesheet_directory_uri() . 'taxonomy-thinkus_ciudad.php';
        } else {
            return THINKEMPLOYEE_PLUGIN_DIR . '/templates/taxonomy-thinkus_ciudad.php';
        }
    }elseif(is_tax('thinkus_perfil')){
        if(file_exists(get_stylesheet_directory_uri() . 'taxonomy-thinkus_perfil.php')) {
            return get_stylesheet_directory_uri() . 'taxonomy-thinkus_perfil.php';
        } else {
            return THINKEMPLOYEE_PLUGIN_DIR . '/templates/taxonomy-thinkus_perfil.php';
        }
    }elseif(is_tax('thinkus_modalidad')){
        if(file_exists(get_stylesheet_directory_uri() . 'taxonomy-thinkus_modalidad.php')) {
            return get_stylesheet_directory_uri() . 'taxonomy-thinkus_modalidad.php';
        } else {
            return THINKEMPLOYEE_PLUGIN_DIR . '/templates/taxonomy-thinkus_modalidad.php';
        }
    }
    return $original_template;
}
add_action('template_include', 'thinkus_employee_templates');


/**
 * Filters
 */
if(!file_exists('thinkus_font_family_attribute')){
    function thinkus_employee_font_family_attribute($tag, $handle, $src) {
       // if not your script, do nothing and return original $tag
       if('google-fonts-1'== $handle){
           return null;
       }
       if ( 'relaway-font' !== $handle ) {
           return $tag;
       }
       // change the script tag by adding type="module" and return it.
       //$tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
       $tag = '<link  rel="preconnect" href="https://fonts.googleapis.com">
       <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
       <link id="'.$handle.'" href="'.esc_url( $src ).'" rel="stylesheet">';
       return $tag;
    }
    add_filter('style_loader_tag', 'thinkus_employee_font_family_attribute' , 11, 4);
 }
 ///excerpt with control
 function thinkus_employee_custom_excerpts($limit) {
    return wp_trim_words(get_the_excerpt(), $limit, '...');
 };

/**
 * The below function will help to load template file from plugin directory of wordpress
 *  Extracted from : http://wordpress.stackexchange.com/questions/94343/get-template-part-from-plugin
 */ 
 

function thinkus_employee_get_template_part($slug, $name = null) {

 do_action("thinkus_employee_get_template_part_{$slug}", $slug, $name);

 $templates = array();
 if (isset($name))
     $templates[] = "{$slug}-{$name}.php";

 $templates[] = "{$slug}.php";

 thinkus_employee_get_template_path($templates, true, false);
}

/* Extend locate_template from WP Core 
* Define a location of your plugin file dir to a constant in this case = PLUGIN_DIR_PATH 
* Note: PLUGIN_DIR_PATH - can be any folder/subdirectory within your plugin files 
*/ 

function thinkus_employee_get_template_path($template_names, $load = false, $require_once = true ) {
   $located = ''; 
   foreach ( (array) $template_names as $template_name ) { 
     if ( !$template_name ) 
       continue; 

     /* search file within the PLUGIN_DIR_PATH only */ 
     if ( file_exists(THINKEMPLOYEE_PLUGIN_DIR . $template_name)) { 
       $located = THINKEMPLOYEE_PLUGIN_DIR . $template_name; 
       break; 
     } 
   }

   if ( $load && '' != $located )
       load_template( $located, $require_once );

   return $located;
}
//is_post_type
function is_post_type($type){
    global $wp_query;
    if ( $type == get_post_type($wp_query->post->ID) ) return true;
    return false;
} 

/**
 * disabled admin bar
 */
function thinkus_disable_admin_bar() {
    if (current_user_can('administrator') ) {
      // user can view admin bar
      show_admin_bar(true); // this line isn't essentially needed by default...
    } else {
      // hide admin bar
      show_admin_bar(false);
    }
 }
 add_action('after_setup_theme', 'thinkus_disable_admin_bar');


 
