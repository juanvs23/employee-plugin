<?php
 //taxonomia ubicacion
 if ( ! function_exists( 'thinkus_ubicacion_function' ) ) {

    // Register Custom Taxonomy
    function thinkus_ubicacion_function() {
    
        $labels = array(
            'name'                       => _x( 'Ubicaciones', 'Taxonomy General Name', 'thinkus-employee' ),
            'singular_name'              => _x( 'Ubicación', 'Taxonomy Singular Name', 'thinkus-employee' ),
            'menu_name'                  => __( 'Ubicaciones', 'thinkus-employee' ),
            'all_items'                  => __( 'Todas las ubicaciones', 'thinkus-employee' ),
            'parent_item'                => __( 'Ubicación superior', 'thinkus-employee' ),
            'parent_item_colon'          => __( 'Ubicación superior:', 'thinkus-employee' ),
            'new_item_name'              => __( 'Nueva ubicación', 'thinkus-employee' ),
            'add_new_item'               => __( 'Añadir nueva ubicación', 'thinkus-employee' ),
            'edit_item'                  => __( 'Editar ubicación', 'thinkus-employee' ),
            'update_item'                => __( 'Actualizar ubicación', 'thinkus-employee' ),
            'view_item'                  => __( 'Ver ubicación', 'thinkus-employee' ),
            'separate_items_with_commas' => __( 'Separada provicias con comas', 'thinkus-employee' ),
            'add_or_remove_items'        => __( 'Añadir o remover ubicaciones', 'thinkus-employee' ),
            'choose_from_most_used'      => __( 'Elegir las mas utilizada', 'thinkus-employee' ),
            'popular_items'              => __( 'Ubicaciones populares', 'thinkus-employee' ),
            'search_items'               => __( 'Buscar ubicaciones', 'thinkus-employee' ),
            'not_found'                  => __( 'No encontrada', 'thinkus-employee' ),
            'no_terms'                   => __( 'No hay ubicaciones', 'thinkus-employee' ),
            'items_list'                 => __( 'Lista de ubicaciones', 'thinkus-employee' ),
            'items_list_navigation'      => __( 'Lista de navegación de ubicaciones', 'thinkus-employee' ),
        );
        $rewrite = array(
            'slug'                       => 'ubicaciones',
            'with_front'                 => true,
            'hierarchical'               => false,
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => false,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
            'rewrite'                    => $rewrite,
            'show_in_rest'               => true,
            'rest_base'                  => 'ubicaciones',
        );
        register_taxonomy( 'thinkus_ubicacion', array( 'thinkus_employee' ), $args );
    
    }
    add_action( 'init', 'thinkus_ubicacion_function', 0 );
    
    }
    //taxonomia ciudad
    if ( ! function_exists( 'thinkus_ciudad_function' ) ) {

        // Register Custom Taxonomy
        function thinkus_ciudad_function() {
        
            $labels = array(
                'name'                       => _x( 'Ciudades', 'Taxonomy General Name', 'thinkus-employee' ),
                'singular_name'              => _x( 'Ciudad', 'Taxonomy Singular Name', 'thinkus-employee' ),
                'menu_name'                  => __( 'Ciudades', 'thinkus-employee' ),
                'all_items'                  => __( 'Todas las ciudades', 'thinkus-employee' ),
                'parent_item'                => __( 'Ciudad superior', 'thinkus-employee' ),
                'parent_item_colon'          => __( 'Ciudad superior:', 'thinkus-employee' ),
                'new_item_name'              => __( 'Nueva ciudad', 'thinkus-employee' ),
                'add_new_item'               => __( 'Añadir nueva ciudad', 'thinkus-employee' ),
                'edit_item'                  => __( 'Editar ciudad', 'thinkus-employee' ),
                'update_item'                => __( 'Actualizar ciudad', 'thinkus-employee' ),
                'view_item'                  => __( 'Ver ciudad', 'thinkus-employee' ),
                'separate_items_with_commas' => __( 'Separada ciudades con comas', 'thinkus-employee' ),
                'add_or_remove_items'        => __( 'Añadir o remover ciudades', 'thinkus-employee' ),
                'choose_from_most_used'      => __( 'Elegir las mas utilizada', 'thinkus-employee' ),
                'popular_items'              => __( 'Provicias populares', 'thinkus-employee' ),
                'search_items'               => __( 'Buscar ciudades', 'thinkus-employee' ),
                'not_found'                  => __( 'No encontrada', 'thinkus-employee' ),
                'no_terms'                   => __( 'No hay ciudades', 'thinkus-employee' ),
                'items_list'                 => __( 'Lista de ciudades', 'thinkus-employee' ),
                'items_list_navigation'      => __( 'Lista de navegación de ciudades', 'thinkus-employee' ),
            );
            $rewrite = array(
                'slug'                       => 'ciudades',
                'with_front'                 => true,
                'hierarchical'               => false,
            );
            $args = array(
                'labels'                     => $labels,
                'hierarchical'               => false,
                'public'                     => true,
                'show_ui'                    => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'show_tagcloud'              => true,
                'rewrite'                    => $rewrite,
                'show_in_rest'               => true,
                'rest_base'                  => 'ciudades',
            );
            register_taxonomy( 'thinkus_ciudad', array( 'thinkus_employee' ), $args );
        
        }
        add_action( 'init', 'thinkus_ciudad_function', 0 );
        
        }
    //taxonomia perfil
    if ( ! function_exists( 'thinkus_perfil_function' ) ) {

        // Register Custom Taxonomy
        function thinkus_perfil_function() {
        
            $labels = array(
                'name'                       => _x( 'Perfiles técnicos', 'Taxonomy General Name', 'thinkus-employee' ),
                'singular_name'              => _x( 'Perfil técnico', 'Taxonomy Singular Name', 'thinkus-employee' ),
                'menu_name'                  => __( 'Perfiles técnicos', 'thinkus-employee' ),
                'all_items'                  => __( 'Todas las perfiles', 'thinkus-employee' ),
                'parent_item'                => __( 'Perfil superior', 'thinkus-employee' ),
                'parent_item_colon'          => __( 'Perfil superior:', 'thinkus-employee' ),
                'new_item_name'              => __( 'Nueva perfil', 'thinkus-employee' ),
                'add_new_item'               => __( 'Añadir nueva perfil', 'thinkus-employee' ),
                'edit_item'                  => __( 'Editar perfil', 'thinkus-employee' ),
                'update_item'                => __( 'Actualizar perfil', 'thinkus-employee' ),
                'view_item'                  => __( 'Ver perfil', 'thinkus-employee' ),
                'separate_items_with_commas' => __( 'Separada perfiles con comas', 'thinkus-employee' ),
                'add_or_remove_items'        => __( 'Añadir o remover perfiles', 'thinkus-employee' ),
                'choose_from_most_used'      => __( 'Elegir las mas utilizada', 'thinkus-employee' ),
                'popular_items'              => __( 'Perfiles populares', 'thinkus-employee' ),
                'search_items'               => __( 'Buscar perfiles', 'thinkus-employee' ),
                'not_found'                  => __( 'No encontrada', 'thinkus-employee' ),
                'no_terms'                   => __( 'No hay perfiles', 'thinkus-employee' ),
                'items_list'                 => __( 'Lista de perfiles', 'thinkus-employee' ),
                'items_list_navigation'      => __( 'Lista de navegación de perfiles', 'thinkus-employee' ),
            );
            $rewrite = array(
                'slug'                       => 'perfiles',
                'with_front'                 => true,
                'hierarchical'               => true,
            );
            $args = array(
                'labels'                     => $labels,
                'hierarchical'               => true,
                'public'                     => true,
                'show_ui'                    => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'show_tagcloud'              => true,
                'rewrite'                    => $rewrite,
                'show_in_rest'               => true,
                'rest_base'                  => 'perfiles',
            );
            register_taxonomy( 'thinkus_perfil', array( 'thinkus_employee' ), $args );
        
        }
        add_action( 'init', 'thinkus_perfil_function', 0 );
        
        }
    //taxonomia modalidad
    if ( ! function_exists( 'thinkus_modalidad_function' ) ) {

        // Register Custom Taxonomy
        function thinkus_modalidad_function() {
        
            $labels = array(
                'name'                       => _x( 'Modalidades', 'Taxonomy General Name', 'thinkus-employee' ),
                'singular_name'              => _x( 'Modalidad', 'Taxonomy Singular Name', 'thinkus-employee' ),
                'menu_name'                  => __( 'Modalidades', 'thinkus-employee' ),
                'all_items'                  => __( 'Todas las modalidades', 'thinkus-employee' ),
                'parent_item'                => __( 'Modalidad superior', 'thinkus-employee' ),
                'parent_item_colon'          => __( 'Modalidad superior:', 'thinkus-employee' ),
                'new_item_name'              => __( 'Nueva modalidad', 'thinkus-employee' ),
                'add_new_item'               => __( 'Añadir nueva modalidad', 'thinkus-employee' ),
                'edit_item'                  => __( 'Editar modalidad', 'thinkus-employee' ),
                'update_item'                => __( 'Actualizar modalidad', 'thinkus-employee' ),
                'view_item'                  => __( 'Ver modalidad', 'thinkus-employee' ),
                'separate_items_with_commas' => __( 'Separada modalidades con comas', 'thinkus-employee' ),
                'add_or_remove_items'        => __( 'Añadir o remover modalidades', 'thinkus-employee' ),
                'choose_from_most_used'      => __( 'Elegir las mas utilizada', 'thinkus-employee' ),
                'popular_items'              => __( 'Modalidades populares', 'thinkus-employee' ),
                'search_items'               => __( 'Buscar modalidades', 'thinkus-employee' ),
                'not_found'                  => __( 'No encontrada', 'thinkus-employee' ),
                'no_terms'                   => __( 'No hay modalidades', 'thinkus-employee' ),
                'items_list'                 => __( 'Lista de modalidades', 'thinkus-employee' ),
                'items_list_navigation'      => __( 'Lista de navegación de modalidades', 'thinkus-employee' ),
            );
            $rewrite = array(
                'slug'                       => 'modalidades',
                'with_front'                 => true,
                'hierarchical'               => false,
            );
            $args = array(
                'labels'                     => $labels,
                'hierarchical'               => false,
                'public'                     => true,
                'show_ui'                    => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'show_tagcloud'              => true,
                'rewrite'                    => $rewrite,
                'show_in_rest'               => true,
                'rest_base'                  => 'modalidades',
            );
            register_taxonomy( 'thinkus_modalidad', array( 'thinkus_employee' ), $args );
        
        }
        add_action( 'init', 'thinkus_modalidad_function', 0 );
        
        }