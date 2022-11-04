<?php
add_action( 'add_meta_boxes_comment', 'thinkus_comment_meta_data' );

function thinkus_comment_meta_data(){
    add_meta_box( 'thinkus_comment', __( 'Información del usuario' ), 'thinkus_comment_meta_data_html', 'comment', 'normal', 'high' );
}

function thinkus_comment_meta_data_html($comment){
   /**
    *   'user_id'=>$get_user->ID,
    *   'telephone'=>  $telephone,
    *   'salary' =>$salary,
    *   'tecnologies'=> $tecnologies,
    *   'acceptance'=>$acceptance,
    *   'resume_file'=>$file_id,
    *   'first_name'=>$first_name,
    *   'last_name'=>$last_name,
    *   'country'=> $country,
    *   'city'=>$city
    */
    $user_id=get_comment_meta( $comment->comment_ID, 'user_id', true )&& get_comment_meta( $comment->comment_ID, 'user_id', true )!=''?get_comment_meta( $comment->comment_ID, 'user_id', true ):'';
    $telephone=get_comment_meta( $comment->comment_ID, 'telephone', true )&& get_comment_meta( $comment->comment_ID, 'telephone', true )!=''?get_comment_meta( $comment->comment_ID, 'telephone', true ):'';
    $salary =get_comment_meta( $comment->comment_ID, 'salary', true )&& get_comment_meta( $comment->comment_ID, 'salary', true )!=''?get_comment_meta( $comment->comment_ID, 'salary', true ):'';
    $tecnologies=get_comment_meta( $comment->comment_ID, 'tecnologies', true )&& get_comment_meta( $comment->comment_ID, 'tecnologies', true )!=''?get_comment_meta( $comment->comment_ID, 'tecnologies', true ):[];
    $acceptance=get_comment_meta( $comment->comment_ID, 'acceptance', true )&& get_comment_meta( $comment->comment_ID, 'acceptance', true )!=''?'<span style="color:green;">Aceptado</span>':'<span style="color:red;">Rechazado</span>';
    $resume_file=get_comment_meta( $comment->comment_ID, 'resume_file', true )&& get_comment_meta( $comment->comment_ID, 'resume_file', true )!=''?get_comment_meta( $comment->comment_ID, 'resume_file', true ):'';
    $country=get_comment_meta( $comment->comment_ID, 'country', true )&& get_comment_meta( $comment->comment_ID, 'country', true )!=''?get_comment_meta( $comment->comment_ID, 'country', true ):'';
    $city=get_comment_meta( $comment->comment_ID, 'city', true )&& get_comment_meta( $comment->comment_ID, 'city', true )!=''?get_comment_meta( $comment->comment_ID, 'city', true ):'';
    
    $comment_meta_data =[
        'Teléfono'=>  $telephone,
        'Salario' =>$salary,
        'tecnologies'=> $tecnologies,
        'País de residencia'=> $country,
        'Ciudad'=>$city,
        'Terminos'=>$acceptance,
        'resume_file'=>$resume_file,
        'user_id'=>$user_id,
    ]
    //wp_get_attachment_url($resume_file):''
    ?>
    
    <div class="comment-metadata">
        <?php
        foreach ( $comment_meta_data as $comment_meta_key=>$comment_meta_value){
            if($comment_meta_key=='tecnologies')
            {
                echo '<div class="metadata-row">';
                echo '<h3><b style="font-weight:700;">Tecnologias: </b>:</h3>';
                echo '<ol class="tecno-list">';
                foreach($comment_meta_value as $element){
                    echo '<li class="tecno-element">'.$element.'</li>';
                }
                echo '</ol>';
                echo '</div>';
            }
            elseif($comment_meta_key=='resume_file'){
                echo '<div class="metadata-row">';
                echo '<h3>';
             
              echo '<a class="button button-primary" target="_blank" href="'.wp_get_attachment_url($comment_meta_value).'">Decargar HV</a>';
                echo '</h3>';
                echo '</div>';
            }elseif($comment_meta_key=='user_id'){
                echo '<div class="metadata-row">';
                echo '<h3>';
             
              echo '<a class="button button-secondary" href="'.admin_url().'user-edit.php?user_id='.$comment_meta_value.'&wp_http_referer=%2Fwp-admin%2Fusers.php">Ir al perfil</a>';
                echo '</h3>';
                echo '</div>';
            }else{
                echo '<div class="metadata-row">';
                echo '<h3>';
                echo '<b style="font-weight:700;">'.$comment_meta_key.': </b>';
                echo $comment_meta_value;
                echo '</h3>';
                echo '</div>';
            }
        }
        ?>
    </div>
    <?php
}
