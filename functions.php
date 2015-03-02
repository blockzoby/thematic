<?php 

$defaults = array(
	'default-image'          => '',
	'width'                  => 0,
	'height'                 => 0,
	'flex-height'            => false,
	'flex-width'             => false,
	'uploads'                => true,
	'random-default'         => false,
	'header-text'            => true,
	'default-text-color'     => '',
	'wp-head-callback'       => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
);
add_theme_support( 'custom-header', $defaults );

add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails' ); 

add_action( 'init', 'register_my_menus' );
function register_my_menus() {
	register_nav_menus(
		array(
			'primary-menu' => __( 'Primary Menu' ),
			'secondary-menu' => __( 'Secondary Menu' ),
			'tertiary-menu' => __( 'Footer Menu' )
		)
	);
}
add_action( 'init', 'cleverleakpost' );
function cleverleakpost() {
  register_post_type( 'cleverleakpost',
    array(
      'labels' => array(
        'name' => __( 'Clever Leak Posts' ),
        'singular_name' => __( 'Clever Leak Posts' )
      ),
       'taxonomies' => array('category'),
       'query_var' => false,
      'public' => true,
      'has_archive' => true,
      'supports' => array( 'title', 'editor', 'excerpt','thumbnail','custom-fields')
    )
  );
  flush_rewrite_rules( false );
}


function pu_theme_menu()
{
  add_theme_page( 'Theme Option', 'Theme Options', 'manage_options', 'pu_theme_options.php', 'pu_theme_page');  
}
add_action('admin_menu', 'pu_theme_menu');
function pu_theme_page()
{
?>
    <div class="section panel">
      <h1>Custom Theme Options</h1>
      <form method="post" enctype="multipart/form-data" action="options.php">
        <?php 
          settings_fields('pu_theme_options'); 
        
          do_settings_sections('pu_theme_options.php');
        ?>
            <p class="submit">  
                <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />  
            </p>  
            
      </form>
      
     
    </div>
    <?php
}

/**
 * Register the settings to use on the theme options page
 */
add_action( 'admin_init', 'pu_register_settings' );

/**
 * Function to register the settings
 */
function pu_register_settings()
{
    // Register the settings with Validation callback
    register_setting( 'pu_theme_options', 'pu_theme_options', 'pu_validate_settings' );

    // Add settings section
    add_settings_section( 'pu_text_section', 'Text box Title', 'pu_display_section', 'pu_theme_options.php' );
	add_settings_section( 'pu_address_section', 'address', 'pu_display_section', 'pu_theme_options.php' );

    // Create textbox field
    $field_args = array(
      'type'      => 'text',
      'id'        => 'pu_textbox',
      'name'      => 'pu_textbox',
      'desc'      => 'Example of textbox description',
      'std'       => '',
      'label_for' => 'pu_textbox',
      'class'     => 'css_class'
    );

    add_settings_field( 'example_textbox', 'Example Textbox', 'pu_display_setting', 'pu_theme_options.php', 'pu_text_section', $field_args );
	
	
	 $field_args1 = array(
      'type'      => 'text',
      'id'        => 'pu_address',
      'name'      => 'pu_address',
      'desc'      => 'Address',
      'std'       => '',
      'label_for' => 'pu_address',
      'class'     => 'css_class'
    );

    add_settings_field( 'address', 'address', 'pu_display_setting', 'pu_theme_options.php', 'pu_address_section', $field_args1 );
}
function pu_display_section($section){ 

}
function pu_display_setting($args)
{
    extract( $args );

    $option_name = 'pu_theme_options';

    $options = get_option( $option_name );

    switch ( $type ) {  
          case 'text':  
              $options[$id] = stripslashes($options[$id]);  
              $options[$id] = esc_attr( $options[$id]);  
              echo "<input class='regular-text$class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";  
              echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";  
          break;  
    }
}


function pu_validate_settings($input)
{
  foreach($input as $k => $v)
  {
    $newinput[$k] = trim($v);
    
    // Check the input is a letter or a number
    if(!preg_match('/^[A-Z0-9 _]*$/i', $v)) {
      $newinput[$k] = '';
    }
  }

  return $newinput;
}


function myplugin_settings() {  
// Add tag metabox to page
register_taxonomy_for_object_type('post_tag', 'page'); 
// Add category metabox to page
register_taxonomy_for_object_type('category', 'page');  
}
 // Add to the admin_init hook of your theme functions.php file 
add_action( 'admin_init', 'myplugin_settings' );

function foobar_func( $atts ){
	return "foo and bar";
}
add_shortcode( 'foobar', 'foobar_func' );

function navigation(){
$defaults = array(
  'theme_location'  => '',
  'menu'            => '',
  'container'       => 'div',
  'container_class' => '',
  'container_id'    => '',
  'menu_class'      => 'menu',
  'menu_id'         => '',
  'echo'            => true,
  'fallback_cb'     => 'wp_page_menu',
  'before'          => '',
  'after'           => '',
  'link_before'     => '',
  'link_after'      => '',
  'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
  'depth'           => 0,
  'walker'          => ''
);
 
 return wp_nav_menu( $defaults );
}

function ShortTitle($text)

{

$chars_limit = 30;

$chars_text = strlen($text);

$text = $text." ";

$text = substr($text,0,$chars_limit);

$text = substr($text,0,strrpos($text,' '));

if ($chars_text > $chars_limit)

{

$text = $text."...";

}

return $text;

}
?>
