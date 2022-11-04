<?php

if(! function_exists('thinkus_uploads_function') ){
    function thinkus_uploads_function(){
        
     
        $upload_dir = wp_upload_dir();
        $upload_path = $upload_dir['path'] . DIRECTORY_SEPARATOR;
        $num_files = count($_FILES['file']['tmp_name']);
    
        $newupload = 0;
    
        if ( !empty($_FILES) ) {
            $files = $_FILES;
            foreach($files as $file) {
                $newfile = array (
                        'name' => $file['name'],
                        'type' => $file['type'],
                        'tmp_name' => $file['tmp_name'],
                        'error' => $file['error'],
                        'size' => $file['size']
                );
    
                $_FILES = array('upload'=>$newfile);
                foreach($_FILES as $file => $array) {
                    $newupload = media_handle_upload( $file, 0 );
                }
            
        }
    
        return wp_send_json_success(array($newupload)); 
    }

       

    }
    add_action( 'wp_ajax_thinkus_upload_handler','thinkus_uploads_function' );
    add_action( 'wp_ajax_nopriv_thinkus_upload_handler','thinkus_uploads_function' );
}