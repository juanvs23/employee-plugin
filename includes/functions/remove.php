<?php
function thinkus_delete_file()
{
    if (isset($_POST['file_id']) 
    && isset($_POST['mwp-dropform-nonce'])
    && wp_verify_nonce($_POST['mwp-dropform-nonce'], 'mwp_dropform_register_ajax_nonce')
) {
    $attachment_id = absint($_POST['file_id']);

        $result = wp_delete_attachment($attachment_id, true); // permanently delete attachment

        if ($result) {
            wp_send_json(array('status' => 'ok'));
        }

}else{
    return wp_send_json_error('error');
}
}
add_action( 'wp_ajax_thinkus_delete_file','thinkus_delete_file' );
add_action( 'wp_ajax_nopriv_thinkus_delete_file','thinkus_delete_file' );