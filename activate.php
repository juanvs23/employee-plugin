<?php
class ThinkusEmployeeActivate{
    public function insert_page($page ){
        wp_insert_post( $my_post );
    }
    public function register_taxonomy($args, $taxonomy){
        register_taxonomy($taxonomy, $args);
    }

    
    public function register_post_type($args, $post_type){
        register_post_type($post_type, $args);
    }
public function init(){
    add_action( 'init', [$his,'register_post_type'], 0,  );
    
}
    
}