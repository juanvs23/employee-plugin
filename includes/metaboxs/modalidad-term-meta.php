<?php
if(class_exists('Thinkus_meta')){
    $arg = array(
        'name'=>'thinkus_modalidad',
        'meta_class'=>'Thinkus_meta',
        'fields'=>array(
            array(
                'label' => 'Titulo del header',
                'id' => 'header_title',
                'default' => '',
                'type' => 'text',
            ),
    
          
    
            array(
                'label' => 'Imagen del header',
                'id' => 'image_header',
                'default' => '',
                'type' => 'media',
            ),
    
            array(
                'label' => 'Titulo de la pagina',
                'id' => 'Page_title',
                'default' => '',
                'type' => 'text',
            )
        )

       );
    $ubication = new Thinkus_meta($arg);
    $ubication->init();
}
