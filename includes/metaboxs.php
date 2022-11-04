<?php

add_action('add_meta_boxes', 'thinkus_employee_single_metabox' );

require  THINKEMPLOYEE_PLUGIN_DIR . '/includes/metaboxs/singles_metas.php';
require  THINKEMPLOYEE_PLUGIN_DIR . '/includes/metaboxs/term-meta.php';
require  THINKEMPLOYEE_PLUGIN_DIR . '/includes/metaboxs/modalidad-term-meta.php';
require  THINKEMPLOYEE_PLUGIN_DIR . '/includes/metaboxs/ciudades-term-meta.php';
require  THINKEMPLOYEE_PLUGIN_DIR . '/includes/metaboxs/perfil-term-meta.php';
require  THINKEMPLOYEE_PLUGIN_DIR . '/includes/metaboxs/ubicacion-term-meta.php';

