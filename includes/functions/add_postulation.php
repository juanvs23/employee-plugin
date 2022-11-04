<?php

if(!function_exists('thinkus_registration_offer_function')){
    function thinkus_registration_offer(){
        if( isset($_POST['nonce'])&& wp_verify_nonce($_POST['nonce'],'security-offer' ) ){
            global $wpdb;
           
            $user_email =$_POST['user_email'];
            $offer_id= $_POST['offer_id'] && $_POST['offer_id']!=''? $_POST['offer_id']:0 ;
            $salary= $_POST['salary'];
            $tecnologies= explode(',',preg_replace('([^A-Za-z0-9, \._\-@])', '', $_POST['tecnologies'][0]));
            $telephone= $_POST['telephone'];
            $first_name = $_POST['first_name'];
            $last_name= $_POST['last_name'];
            $acceptance = $_POST['acceptance'];
            $file_id = $_POST['file-id'];
            $country = $_POST['country'];
            $city = $_POST['city'];
            $comment_contend= $_POST['offer_id'] && $_POST['offer_id']!=''? get_post($_POST['offer_id'])->post_title:'Formulario de trabajo' ;



          /*   $user_metas = array( 
                'telephone'=>  $telephone,
                'salary' =>$salary,
                'tecnologies'=> $tecnologies,
                'acceptance'=>$acceptance,
                'resume_file'=>$file_id,
                'first_name'=>$first_name,
                'last_name'=>$last_name,
                'country'=> $country,
                'city'=>$city

            ); */
           //return wp_send_json_success( ['user'=>$get_user,'comment'=>$comment]);
            //die();
            //create a new user
            $get_user =get_user_by( 'email',  $user_email );
            if(!$get_user){
                $new_user = register_new_user(  $user_email, $user_email );
                if( $new_user ){
                    $user_metas = array( 
                        'telephone'=>  $telephone,
                        'salary' =>$salary,
                        'tecnologies'=> $tecnologies,
                        'acceptance'=>$acceptance,
                        'resume_file'=>$file_id,
                        'first_name'=>$first_name,
                        'last_name'=>$last_name,
                        'country'=> $country,
                        'city'=>$city

                    );
                    foreach ( $user_metas as $key => $value){
                        update_user_meta($new_user,$key, $value);
                    }
                }

                 $get_user =get_user_by( 'email',  $user_email );
            }
            $comment_data =[
                'comment_post_ID'=>$offer_id,
                'user_id'=>$get_user->ID,
                'comment_author'=>$first_name.' '.$last_name,
                'comment_author_email'=>$user_email,
                'comment_approved'=>'0',
                'comment_content'=> $comment_contend,
                'comment_meta'=>[
                    'user_id'=>$get_user->ID,
                    'telephone'=>  $telephone,
                    'salary' =>$salary,
                    'tecnologies'=> $tecnologies,
                    'acceptance'=>$acceptance,
                    'resume_file'=>$file_id,
                    'first_name'=>$first_name,
                    'last_name'=>$last_name,
                    'country'=> $country,
                    'city'=>$city
                    
                ],
            ];
            
            
               
               

            if($offer_id!=0){
                $sql= "SELECT * FROM `{$wpdb->prefix}comments` WHERE comment_post_ID={$offer_id} and user_id = {$get_user->ID}";
                $has_comments = $wpdb->get_results($sql);
              
                    return wp_send_json_error( ['user'=> $comment_data['comment_author'] ,'message'=> 'Registrado' ]);
                
            }
            
           $comment=wp_insert_comment($comment_data);
           // wp_mail();
           return wp_send_json_success( ['user'=>$get_user,'comment'=>  $comment ]);
           


        }

        return wp_send_json_error(['message'=>'Wrong security']);
    }
    add_action( 'wp_ajax_registration_offer','thinkus_registration_offer' );
    add_action( 'wp_ajax_nopriv_registration_offer','thinkus_registration_offer' );
}