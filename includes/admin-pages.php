<?php
// Settings Page: ConfiguraciónPaginaDeVacante
// Retrieving values: get_option( 'your_field_id' )
class ConfiguraciónPaginaDeVacante_Settings_Page {

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'wph_create_settings' ) );
		add_action( 'admin_init', array( $this, 'wph_setup_sections' ) );
		add_action( 'admin_init', array( $this, 'wph_setup_fields' ) );
                add_action( 'admin_footer', array( $this, 'media_fields' ) );
		add_action( 'admin_enqueue_scripts', 'wp_enqueue_media' );
	}

	public function wph_create_settings() {
		$page_title = 'Configuración pagina de vacante';
		$menu_title = 'Configuración pagina de vacante';
		$capability = 'manage_options';
		$menu_slug = 'offer-page-config';
        $parent_slug ='edit.php?post_type=thinkus_employee';
		$callback = array($this, 'wph_settings_content');
        add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $callback, 3 );
              //  add_posts_page($page_title, $menu_title, $capability, $slug, $callback);
		
	}
    
	public function wph_settings_content() { ?>
		<div class="wrap">
            <style>
                input[type=text]{
                    display:block;
                    width:100%;

                }
                .post_form{
                    padding: 15px;
                    margin: 50px auto;
                    max-width:950px;
                }
                .wrap h1 {
    font-size: 2rem;
    text-align: center;
    display: block;
    width: 100%;
    font-weight: 700;
}
            </style>
			<h1>Configuración pagina de vacante</h1>
			<?php settings_errors(); ?>
			<form method="POST" class="post_form" action="options.php">
				<?php
					settings_fields( 'ConfiguraciónPaginaDeVacante' );
					do_settings_sections( 'ConfiguraciónPaginaDeVacante' );
					submit_button();
				?>
			</form>
		</div> <?php
	}

	public function wph_setup_sections() {
		add_settings_section( 'ConfiguraciónPaginaDeVacante_section', 'Esta pagina carga la configuración basica del contenido de la pagina principal de la sección de vacantes.', array(), 'ConfiguraciónPaginaDeVacante' );
	}

	public function wph_setup_fields() {
		$fields = array(
                    array(
                        'section' => 'ConfiguraciónPaginaDeVacante_section',
                        'label' => 'Titulo del header',
                        'placeholder' => 'Ofertas',
                        'id' => 'header_title',
                        'desc' => 'Titulo en el header de la pagina',
                        'type' => 'text',
                    ),
        
                    array(
                        'section' => 'ConfiguraciónPaginaDeVacante_section',
                        'label' => 'Descripción del header',
                        'placeholder' => 'Texto descriptivo',
                        'id' => 'header_description',
                        'desc' => 'Descripción del header',
                        'type' => 'wysiwyg',
                    ),
					array(
                        'section' => 'ConfiguraciónPaginaDeVacante_section',
                        'label' => 'Correo a nofiticar',
                        'placeholder' => ' ',
                        'id' => 'notify_email',
                        'desc' => 'Titulo de la pagina',
                        'type' => 'text',
                    ),
        
                    array(
                        'section' => 'ConfiguraciónPaginaDeVacante_section',
                        'label' => 'Imagen del header',
                        'placeholder' => ' ',
                        'id' => 'Header_image',
                        'type' => 'media',
                        'returnvalue' => 'url'
                    ),
        
                    array(
                        'section' => 'ConfiguraciónPaginaDeVacante_section',
                        'label' => 'Titulo de la pagina',
                        'placeholder' => ' ',
                        'id' => 'page_title',
                        'desc' => 'Titulo de la pagina',
                        'type' => 'text',
                    )
		);
		foreach( $fields as $field ){
			add_settings_field( $field['id'], $field['label'], array( $this, 'wph_field_callback' ), 'ConfiguraciónPaginaDeVacante', $field['section'], $field );
			register_setting( 'ConfiguraciónPaginaDeVacante', $field['id'] );
		}
	}
	public function wph_field_callback( $field ) {
		$value = get_option( $field['id'] );
		$placeholder = '';
		if ( isset($field['placeholder']) ) {
			$placeholder = $field['placeholder'];
		}
		switch ( $field['type'] ) {
            
                        case 'media':
                            $field_url = '';
                            if ($value) {
                                if ($field['returnvalue'] == 'url') {
                                    $field_url = $value;
                                } else {
                                    $field_url = wp_get_attachment_url($value);
                                }
                            }
                            printf(
                                '<input style="display:none;" id="%s" name="%s" type="text" value="%s"  data-return="%s"><div id="preview%s" style="margin-right:10px;border:1px solid #e2e4e7;background-color:#fafafa;display:inline-block;width: 100px;height:100px;background-image:url(%s);background-size:cover;background-repeat:no-repeat;background-position:center;"></div><input style="width: 19%%;margin-right:5px;" class="button menutitle-media" id="%s_button" name="%s_button" type="button" value="Select" /><input style="width: 19%%;" class="button remove-media" id="%s_buttonremove" name="%s_buttonremove" type="button" value="Clear" />',
                                $field['id'],
                                $field['id'],
                                $value,
                                $field['returnvalue'],
                                $field['id'],
                                $field_url,
                                $field['id'],
                                $field['id'],
                                $field['id'],
                                $field['id']
                            );
                            break;

            
                        case 'wysiwyg':
                            wp_editor($value, $field['id']);
                            break;

			default:
				printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />',
					$field['id'],
					$field['type'],
					$placeholder,
					$value
				);
		}
		if( isset($field['desc']) ) {
			if( $desc = $field['desc'] ) {
				printf( '<p class="description">%s </p>', $desc );
			}
		}
	}
    
    public function media_fields() {
		?><script>
			jQuery(document).ready(function($){
				if ( typeof wp.media !== 'undefined' ) {
					var _custom_media = true,
					_orig_send_attachment = wp.media.editor.send.attachment;
					$('.menutitle-media').click(function(e) {
						var send_attachment_bkp = wp.media.editor.send.attachment;
						var button = $(this);
						var id = button.attr('id').replace('_button', '');
						_custom_media = true;
							wp.media.editor.send.attachment = function(props, attachment){
							if ( _custom_media ) {
								if ($('input#' + id).data('return') == 'url') {
									$('input#' + id).val(attachment.url);
								} else {
									$('input#' + id).val(attachment.id);
								}
								$('div#preview'+id).css('background-image', 'url('+attachment.url+')');
							} else {
								return _orig_send_attachment.apply( this, [props, attachment] );
							};
						}
						wp.media.editor.open(button);
						return false;
					});
					$('.add_media').on('click', function(){
						_custom_media = false;
					});
					$('.remove-media').on('click', function(){
						var parent = $(this).parents('td');
						parent.find('input[type="text"]').val('');
						parent.find('div').css('background-image', 'url()');
					});
				}
			});
		</script><?php
	}
    
}
new ConfiguraciónPaginaDeVacante_Settings_Page();