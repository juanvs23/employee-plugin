<?php
if(!file_exists('thinkus_resume_file_function')){
    function thinkus_resume_file_function(){
        $get_url =wp_get_attachment_url($_POST['resume_id']);
        return wp_send_json_success($get_url); 
    }
    add_action( 'wp_ajax_thinkus_resume_file','thinkus_resume_file_function' );
    add_action( 'wp_ajax_nopriv_thinkus_resume_file','thinkus_resume_file_function' );
}