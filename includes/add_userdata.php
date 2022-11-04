<?php
/**
  * Show user meta profile
  */
  //Adds Custom Column To Users List Table
  function thinkus_additional_profile_fields($user){
    /**
     *  'telephone'=>  $telephone,
     *  'salary' =>$salary,
     *  'tecnologies'=> $tecnologies,
     *  'acceptance'=>$acceptance,
     *  'resume_file'=>wp_get_attachment_url($file_id ),
     */

$telephone =get_user_meta( $user->ID, 'telephone', true ) && get_user_meta( $user->ID, 'telephone', true )!=''?get_user_meta( $user->ID, 'telephone', true ):'';
$salary =get_user_meta( $user->ID, 'salary', true ) && get_user_meta( $user->ID, 'salary', true )!=''?get_user_meta( $user->ID, 'salary', true ):'';
$country =get_user_meta( $user->ID, 'country', true ) && get_user_meta( $user->ID, 'country', true )!=''?get_user_meta( $user->ID, 'country', true ):'';
$city =get_user_meta( $user->ID, 'city', true ) && get_user_meta( $user->ID, 'city', true )!=''?get_user_meta( $user->ID, 'city', true ):'';
$tecnologies =get_user_meta( $user->ID, 'tecnologies', true ) && get_user_meta( $user->ID, 'tecnologies', true )!=''?get_user_meta( $user->ID, 'tecnologies', true ):[];
$resume_file =get_user_meta( $user->ID, 'resume_file', true ) && get_user_meta( $user->ID, 'resume_file', true )!=''?get_user_meta( $user->ID, 'resume_file', true ):'';
$resume_file_url = get_user_meta( $user->ID, 'resume_file', true ) && get_user_meta( $user->ID, 'resume_file', true )!=''? wp_get_attachment_url($resume_file):'';
$acceptance = get_user_meta( $user->ID, 'acceptance', true ) && get_user_meta( $user->ID, 'acceptance', true )!=false? 'checked':'';
?>
<h3>Información adicional del perfil</h3>
<table id="thinkus-newinfo" class="form-table" role="presentation">
	<tbody>
        <tr class="user-telephone-wrap">
		    <th>
                <label for="telephone">Teléfono: </label>
            </th>
			<td>
		        <input type="tel" name="telephone" id="telephone"  value="<?php echo $telephone; ?>" class="regular-text ltr">
	        </td>
		</tr>
        <tr class="salary-wrap">
            <th>
                <label for="salary">Salario</label>
            </th>
            <td>
                <input type="text" name="salary" id="salary" value="<?php echo $salary; ?>" class="regular-text code">
            </td>
        </tr>
        <tr class="resume_file-wrap">
            <th>
                <label for="salary">Archivo de hoja de vida</label>
            </th>
            <td class="postulation-input-content resume_file">
               <?php
               if($resume_file !=''){
                ?>
                 <a href="<?php echo $resume_file_url;?>"  id="resume_file" name="resume_file" target="_blank" class="button button-primary"> Descargar HV </a>
                <?php
               }else{
                ?>
                <p class="file-info">Archivo HV, no cargado</p>
                <?php
               }
               ?>
                <input type="hidden" name="file-id" id="file-id" value="<?php echo $resume_file;?>">
          <?php
          $form_html='';
            $form_html .= '<div id="mwp-dropform-wrapper">';
            $form_html .= '<div id="dropzone-file" class="dropzone "></div>'; // element for dropzone field
            $form_html .= wp_nonce_field('mwp_dropform_register_ajax_nonce', 'mwp-dropform-nonce', true, false); // returns security nonce field
            $form_html .= '</div>';
            echo $form_html;
          ?>
            </td>
        </tr>
        <tr class="select-tecnologies-wrap">
            <th>
                <label for="tecnologies">Tecnologias que maneja</label>
            </th>
            <td>
            <input type="hidden" id="get-tecnologies" name="tecnologies[]" value="<?php 
                if(count($tecnologies)>0){
                    echo "[";
                    $count  = 0;
                    foreach($tecnologies as $tecnology){
                        $count++;
                        echo trim($tecnology);
                        if(count($tecnologies)!= $count){
                            echo ',';
                        }
                    };
                    echo "]";
                }
                
                ?>">
               
                <?php
                
                 $terms = get_terms( array(
                    'taxonomy' => 'thinkus_perfil',
                    'hide_empty' => false,
                ) );
                $term_names = array_map(function($term){
                    return $term->name;
                },$terms );
               
                echo '<select   id="tecnologies" multiple="multiple">'; 
                foreach( $terms  as  $term){
                    if(in_array( $term->name,$tecnologies)){
                        echo '<option selected value="'.$term->name.'">'.$term->name.'</option>';
                    }else{
                        echo '<option value="'.$term->name.'">'.$term->name.'</option>';
                    }
                }
                foreach ($tecnologies as $tecnology) {
                    if(!in_array($tecnology,$term_names)){
                        echo '<option selected="selected" value="'.$tecnology.'">'.$tecnology.'</option>';
                    }
                }
                echo '</select>';
                ?>
               
            </td>
        </tr>
        <tr class="country-wrap">
            <th>
                <label for="country">País</label>
            </th>
            <td>
                <input type="text" name="country" id="country" value="<?php echo $country; ?>" class="regular-text code">
            </td>
        </tr>
        <tr class="city-wrap">
            <th>
                <label for="city">Ciudad de residencia</label>
            </th>
            <td>
                <input type="text" name="city" id="city" value="<?php echo $city; ?>" class="regular-text code">
            </td>
        </tr>
        <tr class="acceptance-wrap">
            <th>
                <label for="acceptance">Terminos aceptados</label>
            </th>
            <td>
                <input type="checkbox" name="acceptance" id="acceptance" <?php echo $acceptance;?> >
            </td>
        </tr>
    </tbody>

</table>
<?php

  }

	
  add_action( 'show_user_profile', 'thinkus_additional_profile_fields' ,3,10);
  add_action( 'edit_user_profile', 'thinkus_additional_profile_fields',3,10 );

  function thinkus_save_additional_profile_fields( $user_id ){
    if ( ! current_user_can( 'edit_user', $user_id ) ) {
   	 return false;
    }
    /**
     *  'telephone'=>  $telephone,
     *  'salary' =>$salary,
     *  'tecnologies'=> $tecnologies,
     *  'acceptance'=>$acceptance,
     *  'resume_file'=>$file_id ,
     */
 
  
    $salary= $_POST['salary'];
    $tecnologies= explode(',',preg_replace('([^A-Za-z0-9, \._\-@])', '', $_POST['tecnologies'][0]));
    $telephone= $_POST['telephone'];
    $acceptance = $_POST['acceptance'];
    $file_id = $_POST['file-id'];
    $country = $_POST['country'];
    $city = $_POST['city'];

    $user_metas = array( 
        'telephone'=>  $telephone,
        'salary' =>$salary,
        'tecnologies'=> $tecnologies,
        'acceptance'=>$acceptance =='on'?true:false,
        'resume_file'=>$file_id,
        'country'=> $country,
        'city'=>$city

      
    );
    foreach ( $user_metas as $key => $value){
        update_user_meta($user_id,$key, $value);
    }
/*  var_dump( $user_metas );
 var_dump( $user_id);
die; */
  }
  add_action( 'personal_options_update', 'thinkus_save_additional_profile_fields' );
add_action( 'edit_user_profile_update', 'thinkus_save_additional_profile_fields' );