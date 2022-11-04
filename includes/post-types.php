<?php
 //registro de empleo
 if ( ! function_exists('employee_function') ) {

    // Register Custom Post Type
    function employee_function() {
         $label_name = get_option('header_title')&& get_option('header_title')!= '' ? get_option('header_title'):'Vacantes laborales';
        $labels = array(
            'name'                  => _x(  $label_name , 'Post Type General Name', 'thinkus-employee' ),
            'singular_name'         => _x( 'Vacante laboral', 'Post Type Singular Name', 'thinkus-employee' ),
            'menu_name'             => __( 'Vacante laboral', 'thinkus-employee' ),
            'name_admin_bar'        => __( 'Vacante laboral', 'thinkus-employee' ),
            'archives'              => __( 'Listo de vacantes', 'thinkus-employee' ),
            'attributes'            => __( 'Atributo de las vacantes', 'thinkus-employee' ),
            'parent_item_colon'     => __( 'Vacante superior', 'thinkus-employee' ),
            'all_items'             => __( 'Todas las vacantes', 'thinkus-employee' ),
            'add_new_item'          => __( 'Añadir nueva vacante', 'thinkus-employee' ),
            'add_new'               => __( 'Añair nueva', 'thinkus-employee' ),
            'new_item'              => __( 'Nueva Vacante laboral', 'thinkus-employee' ),
            'edit_item'             => __( 'Editar vacante', 'thinkus-employee' ),
            'update_item'           => __( 'Actualizar vacante', 'thinkus-employee' ),
            'view_item'             => __( 'Ver vacante', 'thinkus-employee' ),
            'view_items'            => __( 'Ver vacantes', 'thinkus-employee' ),
            'search_items'          => __( 'Buscar vacante', 'thinkus-employee' ),
            'not_found'             => __( 'No encontrado', 'thinkus-employee' ),
            'not_found_in_trash'    => __( 'No encontrado en la basura', 'thinkus-employee' ),
            'featured_image'        => __( 'Imagen destacada', 'thinkus-employee' ),
            'set_featured_image'    => __( 'Configurar imagen destacada', 'thinkus-employee' ),
            'remove_featured_image' => __( 'Remover imagen destacada', 'thinkus-employee' ),
            'use_featured_image'    => __( 'Utilizar como imagen destacada', 'thinkus-employee' ),
            'insert_into_item'      => __( 'Insertar en la vacante', 'thinkus-employee' ),
            'uploaded_to_this_item' => __( 'Cargado para esta vacante', 'thinkus-employee' ),
            'items_list'            => __( 'Lista de vacantes', 'thinkus-employee' ),
            'items_list_navigation' => __( 'Lista de navegación de vacantes', 'thinkus-employee' ),
            'filter_items_list'     => __( 'Filtrar lista de vacantes', 'thinkus-employee' ),
        );
        $rewrite = array(
            'slug'                  =>  __('vacantes', 'thinkus-employee'),
            'with_front'            => true,
            'pages'                 => true,
            'feeds'                 => true,
        );
        $args = array(
            'label'                 => __( 'Vacante laboral', 'thinkus-employee' ),
            'description'           => __( 'Registro de ofertas de empleo', 'thinkus-employee' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'revisions', 'custom-fields' ),
            'taxonomies'            => array( 'thinkus_ubicacion', 'Thinkus_ciudad', 'thinkus_perfil', 'thinkus_modalidad' ),
            'hierarchical'          => true,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-businessman',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => __('vacantes', 'thinkus-employee'),
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'rewrite'               => $rewrite,
            'capability_type'       => 'page',
            'show_in_rest'          => true,
            'rest_base'             => __('vacantes', 'thinkus-employee'),
        );
        register_post_type( 'thinkus_employee', $args );
    
    }
    add_action( 'init', 'employee_function', 0 );
    
    }
   
   