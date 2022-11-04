<?php
/**
 * function thinkus_general_localize
 */
if(!function_exists('thinkus_employee_general_localize')){
   function thinkus_employee_general_localize(){
       return array(
           'admin_ajax' => admin_url('admin-ajax.php'),
           'project_url'=> THINKEMPLOYEE_PLUGIN_URL,
           'upload_file' => admin_url('admin-ajax.php?action=thinkus_upload_handler'),
           'delete_file' => admin_url('admin-ajax.php?action=thinkus_delete_file'),
           'resume_file' => admin_url('admin-ajax.php?action=thinkus_resume_file'),
           
       );
   };
}


/**
 * Add stylesheets and scripts
 */
//frontend
function thinkus_employee_scripts_theme(){
   if (  !wp_style_is('relaway-font')) {
      # code...
      wp_enqueue_style( 'relaway-font','https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700;1,900&display=swap', array(), THINKEMPLOYEE_PLUGIN_VERSION, 'all' );
   } 
   //https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css
   if(
      !wp_style_is('fontAwesome-6')
   ){
      wp_enqueue_style( 'fontAwesome-6','https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css?display=swap', array('relaway-font'), THINKEMPLOYEE_PLUGIN_VERSION, 'all' );
   }

   wp_enqueue_style( 'think-employee',THINKEMPLOYEE_PLUGIN_URL.'assets/css/frontend/main.css', array('fontAwesome-6','relaway-font'), THINKEMPLOYEE_PLUGIN_VERSION, 'all' );
   wp_enqueue_script('think-employee',THINKEMPLOYEE_PLUGIN_URL.'assets/js/frontend/main.js', array(), THINKEMPLOYEE_PLUGIN_VERSION, true);
   wp_localize_script('think-employee','thinkus_employee_front_ajax',thinkus_employee_general_localize());
}

add_action( 'wp_enqueue_scripts', 'thinkus_employee_scripts_theme',10000 );
//backend
function thinkus_employee_scripts_admin() {
   if(
      !wp_style_is('fontAwesome-6')
   ){
      wp_enqueue_style( 'fontAwesome-6','https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css?display=swap', array(), THINKEMPLOYEE_PLUGIN_VERSION, 'all' );
   }
   if ( ! did_action( 'wp_enqueue_media' ) ) {
       wp_enqueue_media();
   }
   if(!did_action('wp-color-picker')){
       wp_enqueue_style( 'wp-color-picker' );
   }
   wp_enqueue_style( 'thinkus_employee_admin_main', THINKEMPLOYEE_PLUGIN_URL . '/assets/css/admin/backoffice.css', 
   array('fontAwesome-6'),  // if the parent theme code has a dependency, copy it to here
   THINKEMPLOYEE_PLUGIN_VERSION
);
   wp_enqueue_script( 'thinkus_employee_admin_main', THINKEMPLOYEE_PLUGIN_URL . '/assets/js/admin/back.js', ['jquery','wp-color-picker'],THINKEMPLOYEE_PLUGIN_VERSION, true );
   wp_localize_script('thinkus_employee_admin_main','thinkus_employee_admin_ajax',thinkus_employee_general_localize());
}

add_action( 'admin_enqueue_scripts', 'thinkus_employee_scripts_admin',10000 );






/**
 * imports
 */
   require THINKEMPLOYEE_PLUGIN_DIR . '/includes/post-types.php';
   require THINKEMPLOYEE_PLUGIN_DIR . '/includes/taxonomies.php';
   require THINKEMPLOYEE_PLUGIN_DIR. '/includes/metaboxs.php';
   require THINKEMPLOYEE_PLUGIN_DIR. '/includes/admin-pages.php';
   require THINKEMPLOYEE_PLUGIN_DIR. '/includes/filters.php';
   require THINKEMPLOYEE_PLUGIN_DIR. '/includes/shortcodes.php';
   require THINKEMPLOYEE_PLUGIN_DIR. '/includes/functions/uploads.php';
   require THINKEMPLOYEE_PLUGIN_DIR. '/includes/functions/remove.php';
   require THINKEMPLOYEE_PLUGIN_DIR. '/includes/functions/add_postulation.php';
   require THINKEMPLOYEE_PLUGIN_DIR. '/includes/functions/thinkus_resume_file.php';
   require THINKEMPLOYEE_PLUGIN_DIR. '/includes/display_comment_meta.php';
   require THINKEMPLOYEE_PLUGIN_DIR. '/includes/add_userdata.php';
   




 