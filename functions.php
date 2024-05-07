<?php 
add_theme_support('menus');
?>

<?php
add_action('cmb2_admin_init', 'cmb2_fields_home');

function cmb2_fields_home() {
  $cmb = new_cmb2_box([
    'id' => 'home_box',
    'title' => 'Sobre',
    'object_types' => ['post'],
    // 'object_types' => ['page', 'post'],
    'show_on' => [
       'key' => 'index',
       'value' => 'index.php',
    ]
  ]);

  $cmb->add_field([
    'name' => 'Foto menu do sidebar',
    'id' => 'foto',
    'type' => 'file',
    'options' => [
      'url' => false,
    ]
  ]);
  
  $cmb->add_field([
    'name' => 'texto 1',
    'id' => 'texto1',
    'type' => 'text',
  ]);

  $cmb->add_field([
    'name' => 'texto 2',
    'id' => 'texto2',
    'type' => 'text',
  ]);

  $cmb->add_field([
    'name' => 'texto 3',
    'id' => 'texto3',
    'type' => 'text',
  ]);

  $cmb->add_field([
    'name' => 'Descrição',
    'id' => 'descricao',
    'type' => 'textarea',
  ]);

  $projetos = $cmb->add_field([
    'name' => 'Projetos',
    'id' => 'projetos',
    'type' => 'group',
    'repeatable' => true,
    'options' => [
      'group_title' => 'Projeto {#}',
      'add_button' => 'Adicionar Projeto',
      'sortable' => true,
    ]
  ]);
    
  $cmb->add_group_field($projetos, [
    'name' => 'Nome',
    'id' => 'nome',
    'type' => 'text',
  ]);
    
  $cmb->add_group_field($projetos, [
    'name' => 'Descrição',
    'id' => 'descricao',
    'type' => 'textarea',
  ]);
  
  $cmb->add_group_field($projetos, [
    'name' => 'Vídeo',
    'id' => 'video',
    'type' => 'text_url'
  ]);

  $cmb->add_group_field($projetos, [
    'name' => 'Site',
    'id' => 'site',
    'type' => 'text_url'
  ]);

  $cmb->add_group_field($projetos, [
    'name' => 'Repositório',
    'id' => 'repositorio',
    'type' => 'text_url'
  ]);

  $contatos = $cmb->add_field([
    'name' => 'Contatos',
    'id' => 'contatos',
    'type' => 'group',
    'repeatable' => true,
    'options' => [
      'group_title' => 'Contato {#}',
      'add_button' => 'Adicionar Contato',
      'sortable' => true,
    ]
  ]);

  $cmb->add_group_field($contatos, [
    'name' => 'Link',
    'id' => 'link',
    'type' => 'text_url'
  ]);
  
  $cmb->add_group_field($contatos, [
    'name' => 'Icone',
    'id' => 'icone',
    'type' => 'file',
    'options' => [
      'url' => false,
    ]
  ]);
  
  $cmb->add_group_field($contatos, [
    'name' => 'Rótulo',
    'id' => 'rotulo',
    'type' => 'text',
  ]);
  
  $cmb->add_group_field($contatos, [
    'name' => 'Info',
    'id' => 'info',
    'type' => 'text',
  ]);
}

function get_field2($key, $page_id = 0) {
  $id = $page_id !== 0 ? $page_id : get_the_ID();
  return get_post_meta($id, $key, true);
}

function the_field2($key, $page_id = 0) {
  echo get_field2($key, $page_id);
}

/**
 * Allow SVG uploads for administrator users.
 *
 * @param array $upload_mimes Allowed mime types.
 *
 * @return mixed
 */
add_filter(
	'upload_mimes',
	function ( $upload_mimes ) {
		// By default, only administrator users are allowed to add SVGs.
		// To enable more user types edit or comment the lines below but beware of
		// the security risks if you allow any user to upload SVG files.
		if ( ! current_user_can( 'administrator' ) ) {
			return $upload_mimes;
		}

		$upload_mimes['svg']  = 'image/svg+xml';
		$upload_mimes['svgz'] = 'image/svg+xml';

		return $upload_mimes;
	}
);

/**
 * Add SVG files mime check.
 *
 * @param array        $wp_check_filetype_and_ext Values for the extension, mime type, and corrected filename.
 * @param string       $file Full path to the file.
 * @param string       $filename The name of the file (may differ from $file due to $file being in a tmp directory).
 * @param string[]     $mimes Array of mime types keyed by their file extension regex.
 * @param string|false $real_mime The actual mime type or false if the type cannot be determined.
 */
add_filter(
	'wp_check_filetype_and_ext',
	function ( $wp_check_filetype_and_ext, $file, $filename, $mimes, $real_mime ) {

		if ( ! $wp_check_filetype_and_ext['type'] ) {

			$check_filetype  = wp_check_filetype( $filename, $mimes );
			$ext             = $check_filetype['ext'];
			$type            = $check_filetype['type'];
			$proper_filename = $filename;

			if ( $type && 0 === strpos( $type, 'image/' ) && 'svg' !== $ext ) {
				$ext  = false;
				$type = false;
			}

			$wp_check_filetype_and_ext = compact( 'ext', 'type', 'proper_filename' );
		}

		return $wp_check_filetype_and_ext;

	},
	10,
	5
);
?>





