<?php
if(!class_exists('Thinkus_meta')){
   
class Thinkus_meta{
	public $meta_fields;
  public $meta_name;
  public $class_meta;


	public function __construct($arg) {
    
    $this->meta_fields = $arg['fields'];
    $this->meta_name = $arg['name'];
    $this->class_meta = $arg['class_meta'];

		
	}
  public function init(){
    if ( is_admin() ) {
			add_action( $this->meta_name.'_add_form_fields', array( $this, 'create_fields' ), 10, 2 );
			add_action( $this->meta_name.'_edit_form_fields', array( $this, 'edit_fields' ),  10, 2 );
			add_action( 'created_'.$this->meta_name, array( $this, 'save_fields' ), 10, 1 );
			add_action( 'edited_'.$this->meta_name,  array( $this, 'save_fields' ), 10, 1 ); 
                        add_action( 'admin_footer', array( $this, 'media_fields' ) );
			add_action( 'admin_enqueue_scripts', 'wp_enqueue_media' );
            
		}
  }
    
    public function media_fields() {
		?><script>
			jQuery(document).ready(function($){
				if ( typeof wp.media !== 'undefined' ) {
					var _custom_media = true,
					_orig_send_attachment = wp.media.editor.send.attachment;
					$('.taxokey-media').click(function(e) {
						var send_attachment_bkp = wp.media.editor.send.attachment;
						var button = $(this);
						var id = button.attr('id').replace('_button', '');
						_custom_media = true;
							wp.media.editor.send.attachment = function(props, attachment){
							if ( _custom_media ) {
								$('input#'+id).val(attachment.id);
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

	public function create_fields( $taxonomy ) {
		$output = '';
		foreach ( $this->meta_fields as $meta_field ) {
			$label = '<label for="' . $meta_field['id'] . '">' . $meta_field['label'] . '</label>';
			if ( empty( $meta_value ) ) {
				if ( isset( $meta_field['default'] ) ) {
					$meta_value = $meta_field['default'];
				}
			}
			switch ( $meta_field['type'] ) {
        case 'media':
          $meta_url = '';
          if ($meta_value) {
              $meta_url = wp_get_attachment_url($meta_value);
          }
      $input = sprintf(
          '<input style="display:none;" id="%s" name="%s" type="text" value="%s"><div id="preview%s" style="margin-right:10px;border:2px solid #eee;display:inline-block;width: 100px;height:100px;background-image:url(%s);background-size:contain;background-repeat:no-repeat;"></div><input style="width: 19%%;margin-right:5px;" class="button taxokey-media" id="%s_button" name="%s_button" type="button" value="Seleccionar" /><input style="width: 19%%;" class="button remove-media" id="%s_buttonremove" name="%s_buttonremove" type="button" value="Borrar" />',
          $meta_field['id'],
          $meta_field['id'],
          $meta_value,
          $meta_field['id'],
          $meta_url,
          $meta_field['id'],
          $meta_field['id'],
          $meta_field['id'],
          $meta_field['id']
      );
        break;
        case 'wysiwyg':
          $input =array(
            'content' => 	$meta_value!=''?	$meta_value:'',
          'custom_editor_id' =>  $meta_field['id'],
          'custom_editor_name' =>  $meta_field['id'],
          'args' => array(
                  'media_buttons' => false, // This setting removes the media button.
                  'textarea_name' => $meta_field['id'], // Set custom name.
                  'textarea_rows' => get_option('default_post_edit_rows', 10), //Determine the number of rows.
                  'quicktags' => false, // Remove view as HTML button.
          ),
          );
         
        break;
				default:
					$input = sprintf(
						'<input %s id="%s" name="%s" type="%s" value="%s">',
						$meta_field['type'] !== 'color' ? '' : '',
						$meta_field['id'],
						$meta_field['id'],
						$meta_field['type'],
						$meta_value
					);
			}
			$output .= '<div class="form-field">'.$this->format_rows( $label, $input, $meta_field['type'] ).'</div>';
		}
		echo $output;
	}
	public function edit_fields( $term, $taxonomy ) {
		$output = '';
		foreach ( $this->meta_fields as $meta_field ) {
			$label = '<label for="' . $meta_field['id'] . '">' . $meta_field['label'] . '</label>';
			$meta_value = get_term_meta( $term->term_id, $meta_field['id'], true );
			switch ( $meta_field['type'] ) {
                
                                case 'media':
                                    $meta_url = '';
                                        if ($meta_value) {
                                            $meta_url = wp_get_attachment_url($meta_value);
                                        }
                                    $input = sprintf(
                                      '<input style="display:none;" id="%s" name="%s" type="text" value="%s"><div id="preview%s" style="margin-right:10px;border:2px solid #eee;display:inline-block;width: 100px;height:100px;background-image:url(%s);background-size:contain;background-repeat:no-repeat;"></div><input style="width: 19%%;margin-right:5px;" class="button taxokey-media" id="%s_button" name="%s_button" type="button" value="Seleccionar" /><input style="width: 19%%;" class="button remove-media" id="%s_buttonremove" name="%s_buttonremove" type="button" value="Borrar" />',
                                        $meta_field['id'],
                                        $meta_field['id'],
                                        $meta_value,
                                        $meta_field['id'],
                                        $meta_url,
                                        $meta_field['id'],
                                        $meta_field['id'],
                                        $meta_field['id'],
                                        $meta_field['id']
                                    );
                                    break;
                                    case 'wysiwyg':
                                      $input =array(
                                        'content' => 	$meta_value,
                                      'custom_editor_id' =>  $meta_field['id'],
                                      'custom_editor_name' =>  $meta_field['id'],
                                      'args' => array(
                                              'media_buttons' => false, // This setting removes the media button.
                                              'textarea_name' => $meta_field['id'], // Set custom name.
                                              'textarea_rows' => get_option('default_post_edit_rows', 10), //Determine the number of rows.
                                              'quicktags' => false, // Remove view as HTML button.
                                      ),
                                      );
                                     
                                    break;

				default:
					$input = sprintf(
						'<input %s id="%s" name="%s" type="%s" value="%s">',
						$meta_field['type'] !== 'color' ? '' : '',
						$meta_field['id'],
						$meta_field['id'],
						$meta_field['type'],
						$meta_value
					);
			}
			$output .= $this->format_rows( $label, $input,$meta_field['type'] );
		}
		echo '<div class="form-field">' . $output . '</div>';
	}
	public function format_rows( $label, $input, $type ) {
		switch ($type) {
      case 'wysiwyg':
        '<tr class="form-field"><th>'.$label.'</th><td>'. wp_editor(  $input['content'], $input['custom_editor_id'],  $input['args'] ).'</td></tr>';
        break;    
      default:
        return '<tr class="form-field"><th>'.$label.'</th><td>'.$input.'</td></tr>';
      
    }
	}
	public function save_fields( $term_id ) {
  
		foreach ( $this->meta_fields as $meta_field ) {

			if ( isset( $_POST[ $meta_field['id'] ] ) ) {
				switch ( $meta_field['type'] ) {
					case 'email':
						$_POST[ $meta_field['id'] ] = sanitize_email( $_POST[ $meta_field['id'] ] );
						break;
					case 'text':
						$_POST[ $meta_field['id'] ] = sanitize_text_field( $_POST[ $meta_field['id'] ] );
						break;
				}
      
				update_term_meta( $term_id, $meta_field['id'], $_POST[ $meta_field['id']] );
			} else if ( $meta_field['type'] === 'checkbox' ) {
				update_term_meta( $term_id, $meta_field['id'], '0' );
			}
		}
	}
}

}