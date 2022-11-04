<?php
/**
 * Thinkus employee
 *
 * @package           ThinkusEmployee
 * @author            Juan Carlos Avila
 * @copyright         2022 Conocimiento coroporativo
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Thinkus Employee
 
 * Description:       Sistema de de gestión de reclutamiento.
 * Version:           1.0.0
 * Author:            Juan Carlos Avila
 * Author URI:        https://cco.systems/
 * Text Domain:       thinkus-employee
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */
//Constants
 define('THINKEMPLOYEE_PLUGIN_DIR', plugin_dir_path(__FILE__));
 define('THINKEMPLOYEE_PLUGIN_URL', plugin_dir_url(__FILE__));
 define('THINKEMPLOYEE_PLUGIN_FILE', __FILE__);
 define('THINKEMPLOYEE_PLUGIN_VERSION', '1.0.0');

 //Language domain
 add_action( 'plugins_loaded', 'thinkus_employee_textdomain' );
    function thinkus_employee_textdomain() {
    	load_plugin_textdomain( 'thinkus-employee', false, dirname( plugin_basename( THINKEMPLOYEE_PLUGIN_FILE ) ) . '/languages/' );
    }
 //Start the plugin 
 if (!function_exists('thinkus_employee_start')) {
       
     function thinkus_employee_start(){
         
        employee_function();
        if(!get_role('thinkus_talent')){
         $author = get_role( 'author' );
         add_role( 'thinkus_talent', 'Talento', $author->capabilities );
        }
        flush_rewrite_rules(); 

     }
 }
 
 register_activation_hook( __FILE__, 'thinkus_employee_start' );


require THINKEMPLOYEE_PLUGIN_DIR . '/activate.php';
require THINKEMPLOYEE_PLUGIN_DIR . '/functions.php';