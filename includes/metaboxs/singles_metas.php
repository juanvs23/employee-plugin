<?php

function thinkus_employee_single_metabox(){
   add_meta_box( 'thinkus_employee_single_metabox', 
                 'Carga de datos de la oferta laboral', 
                 'thinkus_employee_form_single_metabox', 
                 'thinkus_employee', 
                 'advanced', 
                 'high', 
                 null );
}

function thinkus_employee_form_single_metabox(){
    global $post;
  
    /** 
     * Items
    */
    $requirement =  get_post_meta($post->ID, 'requirement', true)? get_post_meta($post->ID, 'requirement', true):'[]';
    $languages =  get_post_meta($post->ID, 'languages', true)? get_post_meta($post->ID, 'languages', true):'[]';
    $whitlist = get_post_meta($post->ID, 'whitlist', true)? get_post_meta($post->ID, 'whitlist', true):'[]';
    /**
     * Infos
     */
    $requirement_info =  get_post_meta($post->ID, 'requirement-info', true)? get_post_meta($post->ID, 'requirement-info', true):'';
    $languages_info =  get_post_meta($post->ID, 'languages-info', true)? get_post_meta($post->ID, 'languages-info', true):'';
    $whitlist_info = get_post_meta($post->ID, 'whitlist-info', true)? get_post_meta($post->ID, 'whitlist-info', true):'';
     /**
      * Work Times
      */
    $workTime= get_post_meta($post->ID, 'workTime', true)? get_post_meta($post->ID, 'workTime', true):'{ inicio: "", fin: "",jornal:"", days: [] }';
    $expireTime= get_post_meta($post->ID, 'expireTime', true)? get_post_meta($post->ID, 'expireTime', true):'';

    /**
     * active offer
     */
    $active_offer = get_post_meta($post->ID, 'active-offer', true)? 'true':'false';
    
    echo '<input type="hidden" name="job_data" id="job_data" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
    

  ?>
  <script>
  var job_requirement ={items:<?php echo $requirement; ?>,info:'<?php echo $requirement_info; ?>'};
  
  var job_whitlist ={items:<?php echo $whitlist; ?>,info:'<?php echo $whitlist_info; ?>'};
  
  var job_languages ={items: <?php echo $languages; ?>,info: '<?php echo $languages_info; ?>'};
  
  var job_workTime =<?php echo $workTime; ?>;
  
  var job_expireTime ='<?php echo $expireTime; ?>';
  var active_offer =<?php echo $active_offer; ?>;
  </script>
  <!--Input was created with react-->
 <div id="reactMetabox"></div><!--React container-->
  <?php
}
function thinkus_employee_form_single_save_fields($post_id){
  global $post;
  if ( !wp_verify_nonce( $_POST['job_data'], plugin_basename(__FILE__) )) {
    return $post->ID;
    }
  if ( !current_user_can( 'edit_post', $post->ID ))
  return $post->ID;
  /**
   * data
   */
  //items
  $job_datas['requirement'] = $_POST['requirement'];
  $job_datas['whitlist'] = $_POST['whitlist'];
  $job_datas['languages'] = $_POST['languages'];
  
  //info
  $job_datas['requirement-info'] = $_POST['requirement-info'];
  $job_datas['whitlist-info'] = $_POST['whitlist-info'];
  $job_datas['languages-info'] = $_POST['languages-info'];
  
  //workTime
  $job_datas['workTime'] = $_POST['workTime'];
  $job_datas['expireTime'] = $_POST['expireTime'];
 
  //active offer
  $job_datas['active-offer'] =$_POST['active-offer']=='on'?true:false;
 /* var_dump($job_datas);
  die(); */
  foreach ($job_datas as $key => $value) { 
		if( $post->post_type == 'revision' ) return; // Verificamos que no se trate de una revisión.
		if(get_post_meta($post->ID, $key, false)) { // Si ya tiene un valor, lo actualizamos.
			update_post_meta($post->ID, $key, $value);
		} else { // Si no tiene un valor, lo creamos.
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key); // Si está en blanco, lo borramos.
	}
  
  
}
add_action( 'save_post', 'thinkus_employee_form_single_save_fields' );
add_action( 'new_to_publish', 'thinkus_employee_form_single_save_fields' );