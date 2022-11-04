<?php

// Rgistration form
function thinkus_registration_function( $atts ) {

	// Attributes
	$atts = shortcode_atts(
		array(
			'offer_id' => '',
            
		),
		$atts,
		'thinkus_registration'
	);
       
$offer_id = $atts['offer_id']!=''?$atts['offer_id']:false;
$nonce = wp_create_nonce( 'security-offer' );
    ob_start();
global $wpdb, $user_ID; 

if(is_user_logged_in()){
    echo' '. $user_ID;
}else{
?>
<form action="" novalidate method="post" class="postulation-form" id="postulation-form">
    <input type="hidden" name="nonce" value="<?php echo $nonce; ?>">
    <input type="hidden" name="action" value="registration_offer">
    <input type="hidden" name="offer_id" value="<?php echo $offer_id;?>">
    <div class="form-row">
        <label for="first_name" class="postulation-label">
            Nombre 
            <span class="required">*</span>
        </label>
        <div class="postulation-input-content">
            <input placeholder="Nombre" type="text" name="first_name" id="first_name" class="postulation-input">
            <p class="info-alert empty">Este campo No puede quedar vacio</p>
        </div>
    </div>
    <div class="form-row">
        <label for="last_name" class="postulation-label">
            Apellido
            <span class="required">*</span>
        </label>
        <div class="postulation-input-content">
            <input placeholder="Apellido" type="text" name="last_name" id="last_name" class="postulation-input">
            <p class="info-alert empty">Este campo No puede quedar vacio</p>
        </div>
    </div>
    <div class="form-row">
        <label for="user_email" class="postulation-label">
            Email
            <span class="required">*</span>
        </label>
        <div class="postulation-input-content">
            <input type="email" placeholder="Email" name="user_email" id="user_email" class="postulation-input">
            <p class="info-alert empty">Este campo No puede quedar vacio</p>
            <p class="info-alert wrong-format">Formato de correo incorrecto</p>
        </div>
    </div>
    <div class="form-row">
        <label for="dropzone-file" class="postulation-label">
            Adjuntar hoja de vida
            <span class="required">*</span>
            <div class="addtional-info">PDF,DOC o formato similar</div>
        </label>
        <div class="postulation-input-content">
            <input type="hidden" name="file-id" id="file-id">
          <?php
          $form_html='';
            $form_html .= '<div id="mwp-dropform-wrapper">';
            $form_html .= '<div id="dropzone-file" class="dropzone"></div>'; // element for dropzone field
            $form_html .= wp_nonce_field('mwp_dropform_register_ajax_nonce', 'mwp-dropform-nonce', true, false); // returns security nonce field
            $form_html .= '</div>';
            echo $form_html;
          ?>
            <p class="info-alert empty">Este campo No puede quedar vacio</p>
            <p class="info-alert wrong-format">Formato de archivo incorrecto</p>
        </div>
    </div>
    <div class="form-row">
        <label for="telephone" class="postulation-label">
        Teléfono
            <span class="required">*</span>
          
        </label>
        <div class="postulation-input-content">
            <input type="tel" placeholder="Teléfono" name="telephone" id="telephone" class="postulation-input">
            <p class="info-alert empty">Este campo No puede quedar vacio</p>
            <p class="info-alert wrong-format">Formato de teléfono incorrecto</p>
        </div>
    </div>
    <div class="form-row">
        <label for="salary" class="postulation-label">
        Aspiración salarial
            <span class="required">*</span>
          
        </label>
        <div class="postulation-input-content">
            <input type="text" placeholder="Aspiración salarial" name="salary" id="salary" class="postulation-input">
            <p class="info-alert empty">Este campo No puede quedar vacio</p>
           
        </div>
    </div>
    <div class="form-row">
        <label for="tecnologies" class="postulation-label">
        Tecnologías que maneja
            <span class="required">*</span>
          
        </label>
        <div class="postulation-input-content">
           <input type="hidden" id="get-tecnologies" name="tecnologies[]">
          <select id="tecnologies"   class="postulation-label" multiple>
          <?php
            $terms = get_terms( array(
                'taxonomy' => 'thinkus_perfil',
                'hide_empty' => false,
            ) );
            echo '<option value="">Tecnologías que maneja</option>';
            foreach( $terms  as  $term){
             echo '<option value="'.$term->name.'">'.$term->name.'</option>';
            }
            ?>
          </select>
            <p class="info-alert empty">Este campo No puede quedar vacio</p>
           
        </div>
    </div>
    <div class="form-row">
        <label for="country" class="postulation-label">
        País
            <span class="required">*</span>
          
        </label>
        <div class="postulation-input-content">
            <input type="text" name="country" placeholder="País" id="country" class="postulation-input">
            <p class="info-alert empty">Este campo No puede quedar vacio</p>
           
        </div>
    </div>
    <div class="form-row">
        <label for="city" class="postulation-label">
        Ciudad de residencia
            <span class="required">*</span>
          
        </label>
        <div class="postulation-input-content">
            <input type="text" placeholder="Ciudad de residencia" name="city" id="city" class="postulation-input">
            <p class="info-alert empty">Este campo No puede quedar vacio</p>
           
        </div>
    </div>
    <div class="aceptance-row">
        <div class="">
            <label for="acceptance" class="acceptance-label">
            <input type="checkbox" name="acceptance" id="acceptance" class="accept">
              <span class="acceptance-text">
              Marcando esta casilla acepta los términos y condiciones. Más información  
              
              <?php 
              $policy_page_title  = '';
              $policy_page_url    = '';
              $policy_page_id     = (int) get_option( 'wp_page_for_privacy_policy' );
              
              if ( $policy_page_id && get_post_status( $policy_page_id ) === 'publish' ) {
                  $policy_page_title  = get_the_title( $policy_page_id );
                  $policy_page_url    = get_permalink( $policy_page_id );
              }
              
              if($policy_page_id): ?>
<a href="<?php echo esc_url(get_permalink($policy_page_id)) ?>" target="_blank">aquí<span class="required">*</span></a>
<?php endif; ?>
              
</span>

            </label>
           
           
        </div>
    </div>
    <div class="form-row">
      <button type="submit" id="send-offer" class="send-offer">Postularse</button>
    </div>
</form>
<?php
}
return ob_get_clean();
}
add_shortcode( 'thinkus_registration', 'thinkus_registration_function' );