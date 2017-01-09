<?php
/**
 * medium magazin beta functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package medium_magazin_beta
 */

if ( ! function_exists( 'mmbeta_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function mmbeta_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on medium magazin beta, use a find and replace
	 * to change 'mmbeta' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'mmbeta', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'preview', 210, 140 );
	add_image_size( 'cover', 360, 481, false );
	add_image_size( 'card', 450, 300, array( 'center', 'center' ) );
	add_image_size( 'square', 290, 290, array( 'center', 'center' ) );

	add_filter( 'image_size_names_choose', 'my_custom_sizes' );
 
	function my_custom_sizes( $sizes ) {
	    return array_merge( $sizes, array(
	        'preview' => __( 'klein, breit' ),
	        'cover' => __( 'Print Cover, klein' ),
	        'card' => __( 'mittel, breit' ),
	        'square' => __( 'mittel, quadratisch' )
	    ) );
	}

	// Mapping image size to teaser format

	function image_size_for_teaser($format) {
		$format_mapping = array(
      'hoch' => 'cover',
      'breit' => 'card',
      'quadratisch' => 'square',
      'rund' => 'square'		
		);
		return $format_mapping[$format];
	}

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'mmbeta' ),
		'footer' => esc_html__( 'Footer Menu', 'mmbeta' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
	) );

	//Admin Theme Options Page - needs ACF 5.o Pro installed
	if (function_exists('acf_add_options_page')) {
		acf_add_options_page( "mmbeta Settings" );
	}


	// mmbeta-Farben

	function mmbeta_color($color_name = 'grau') {
		$colors = array(
			'blau' => 'rgba(59,67,149,0.7)',
			'magenta' => 'rgba(149,36,86,1)',
			'gruen' => 'rgba(57,124,35,1)',
			'rot' => 'rgba(183,14,12,1)',
			'orange' => 'rgba(239,125,0,1)',
			'petrol' => 'rgba(0,97,116,1)',
			'grau' => '#f7f7f9'
		);

		if( $color_name && $colors[$color_name]){
			return $colors[$color_name];
		}else{
			return $colors['grau'];
		}
	}

	/*
	 * Add custom post type for Preistraeger 
	 */

	// Register Custom Post Type
	function add_post_type_preistraeger() {

		$labels = array(
			'name'                  => _x( 'Preisträger', 'Post Type General Name', 'text_domain' ),
			'singular_name'         => _x( 'Preisträger', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'             => __( 'Preisträger', 'text_domain' ),
			'name_admin_bar'        => __( 'Preisträger', 'text_domain' ),
			'archives'              => __( 'Preisträger-Verzeichnis', 'text_domain' ),
			'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
			'all_items'             => __( 'Alle Preisträger', 'text_domain' ),
			'add_new_item'          => __( 'Preisträger hinzufügen', 'text_domain' ),
			'add_new'               => __( 'Hinzufügen', 'text_domain' ),
			'new_item'              => __( 'Neuer Preisträger', 'text_domain' ),
			'edit_item'             => __( 'Preisträger bearbeiten', 'text_domain' ),
			'update_item'           => __( 'Preisträger aktualisieren', 'text_domain' ),
			'view_item'             => __( 'Preisträger ansehen', 'text_domain' ),
			'search_items'          => __( 'Preisträger suchen', 'text_domain' ),
			'not_found'             => __( 'Not found', 'text_domain' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
			'featured_image'        => __( 'Profilbild', 'text_domain' ),
			'set_featured_image'    => __( 'Profilbild festlegen', 'text_domain' ),
			'remove_featured_image' => __( 'Profilbild entfernen', 'text_domain' ),
			'use_featured_image'    => __( 'Benutzt ein Profilbild', 'text_domain' ),
			'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
			'items_list'            => __( 'Items list', 'text_domain' ),
			'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
			'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
		);
		$args = array(
			'label'                 => __( 'Preisträger', 'text_domain' ),
			'description'           => __( 'Zum Listen von Preisträgern.', 'text_domain' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'excerpt', 'thumbnail', 'revisions', 'custom-fields', ),
			'taxonomies'            => array( 'preise' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-universal-access-alt',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,		
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'post',
		);
		register_post_type( 'preistraeger', $args );

	}
	add_action( 'init', 'add_post_type_preistraeger', 0 );

	// Register Custom Taxonomy Preise
	function add_taxonomy_preise() {

		$labels = array(
			'name'                       => _x( 'Preise', 'Taxonomy General Name', 'text_domain' ),
			'singular_name'              => _x( 'Preis', 'Taxonomy Singular Name', 'text_domain' ),
			'menu_name'                  => __( 'Preise', 'text_domain' ),
			'all_items'                  => __( 'All Items', 'text_domain' ),
			'parent_item'                => __( 'Parent Item', 'text_domain' ),
			'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
			'new_item_name'              => __( 'Neuer Preis', 'text_domain' ),
			'add_new_item'               => __( 'Neuen Preis erstellen', 'text_domain' ),
			'edit_item'                  => __( 'Preis anpassen', 'text_domain' ),
			'update_item'                => __( 'Preis aktualisieren', 'text_domain' ),
			'view_item'                  => __( 'Preis ansehen', 'text_domain' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
			'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
			'popular_items'              => __( 'Popular Items', 'text_domain' ),
			'search_items'               => __( 'Search Items', 'text_domain' ),
			'not_found'                  => __( 'Not Found', 'text_domain' ),
			'no_terms'                   => __( 'No items', 'text_domain' ),
			'items_list'                 => __( 'Items list', 'text_domain' ),
			'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);
		register_taxonomy( 'preise', array( 'preistraeger', 'attachment', 'page' ), $args );

	}
	add_action( 'init', 'add_taxonomy_preise', 0 );


	// Change Password protected wording

	function my_password_form() {
	    global $post;
	    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	    $o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
	    ' . __( "Bitte geben Sie das Passwort aus der Printausgabe ein, um den Inhalt zu sehen (siehe Seite 23, MM1/2016):" ) . "<br>" . '
	    <input name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" /><input type="submit" name="Submit" value="' . esc_attr__( "Senden" ) . '" />
	    </form>
	    ';
	    return $o;
	}
	add_filter( 'the_password_form', 'my_password_form' );

	function my_excerpt_protected( $excerpt ) {
	    if ( post_password_required() )
	        $excerpt = get_the_password_form();
	    return $excerpt;
	}
	add_filter( 'the_excerpt', 'my_excerpt_protected' );

	// Strip "Protected:" from 

	function strip_protected_string($title) {
       return '%s';
	}
	add_filter('protected_title_format', 'strip_protected_string');

	// strip Archiv-Type from Archive-Title

	function strip_archive_type($title){
			$title = single_cat_title( '', false );
			return $title;
	}
	apply_filters( 'get_the_archive_title', 'strip_archive_type' );

	//Make auto embeds 16:9 and responsive with bootstrap classes
	function wrap_with_bt_embed($html){		
		$prepend = '<div class="embed-responsive embed-responsive-16by9 m-b">';
		$append = '</div>';
		$new_html = $prepend . $html . $append;
		return $new_html;
	}
	add_filter( 'embed_oembed_html', 'wrap_with_bt_embed', 10, 3);
	add_filter( 'video_embed_html', 'wrap_with_bt_embed' );


	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'mmbeta_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

}
endif; // mmbeta_setup
add_action( 'after_setup_theme', 'mmbeta_setup' );



/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mmbeta_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'mmbeta' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'mmbeta_widgets_init' );

// register Cover_Gallery_Widget
function register_cover_widget() {
    register_widget( 'Cover_Gallery_Widget' );
}
add_action( 'widgets_init', 'register_cover_widget' );


register_sidebar( array(
	'id'          => 'footer_sidebar',
	'name'        => 'Footer Widget Area',
	'description' => __( 'Hier können Widegts eingetragen werden, die im Footer der Seite erscheinen sollen.', 'text_domain' ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h3 class="widgettitle">',
	'after_title'   => '</h3>',
) );


/**
 * Enqueue scripts and styles.
 */
function mmbeta_scripts() {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css' );
	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'mmbeta-leitura-sans', get_template_directory_uri() . '/css/LeituraSans.css' );
	wp_enqueue_style( 'mmbeta-custom', get_template_directory_uri() . '/css/mmbeta-custom.css' );
	wp_enqueue_script( 'mmbeta-custom-js', get_template_directory_uri() . '/js/mmbeta.js', array( 'jquery' ), '20160201', true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array( 'jquery' ), '20151106', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mmbeta_scripts' );

function mmbeta_die_preiskategorie(){
  $taxonomy = 'preise';
  $id = get_the_ID();
  $args = array('orderby' => 'count', 'order' => 'DESC');
  $post_terms = wp_get_object_terms( $id, $taxonomy, $args );

  echo end($post_terms)->name;
}

function mmbeta_die_preiskategorie_object(){
  $taxonomy = 'preise';
  $id = get_the_ID();
  $args = array('orderby' => 'count', 'order' => 'DESC');
  $post_terms = wp_get_object_terms( $id, $taxonomy, $args );
  return end($post_terms);
}

// Gibt zurück, ob der Preisträger den Preis JDJ oder Top30 bekommen hat
function mmbeta_welcher_preis($return_value = 'name'){
  
  $taxonomy = 'preise';
  $id = get_the_ID();
  $args = array('orderby' => 'count', 'order' => 'DESC');
  $post_terms = wp_get_object_terms( $id, $taxonomy, $args );
  $two_tags_with_most_children = array_slice($post_terms, 0, 2);
  if ($two_tags_with_most_children[0]->count === $two_tags_with_most_children[1]->count) {
  	if($two_tags_with_most_children[0]->parent === 0 ){
  		return $two_tags_with_most_children[0]->$return_value;
  	}else{
  		return $two_tags_with_most_children[1]->$return_value;
  	}
  }else{
  	return $two_tags_with_most_children[0]->$return_value;
  }
}

// Bootstrap classes to post images
function html5_insert_image($html, $id, $caption, $title, $align, $url, $size, $alt) {
  $url = wp_get_attachment_image_src($id, $size);
  $html5 = "<figure class='figure " . $size . ' ' . 'align-' . $align . "'>";
  $html5 .= "<img class='figure-img img-responsive' src='" . $url[0] . "' alt='" . $alt . "' />";
  if ($caption) {
    $html5 .= "<figcaption class='figure-caption'>$caption</figcaption>";
  }
  $html5 .= "</figure>";
  return $html5;
}
add_filter( 'image_send_to_editor', 'html5_insert_image', 10, 8 );

//Custom Styles in Editor
function wpb_mce_buttons_2($buttons) {
    array_unshift($buttons, 'styleselect');
    return $buttons;
}

add_filter('mce_buttons_2', 'wpb_mce_buttons_2');

function my_mce_before_init_insert_formats( $init_array ) {  

// Define the style_formats array

	$style_formats = array(  
		// Each array child is a format with it's own settings
		array(  
			'title' => 'Zitat-Absatz',  
			'block' => 'blockquote',  
			'classes' => 'blockquote',
			'wrapper' => true,	
		),
		array(  
			'title' => 'rb: Zitat-Absatz',  
			'block' => 'blockquote',  
			'classes' => 'blockquote blockquote-reverse',
			'wrapper' => true,	
		),
	);  
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );  
	
	return $init_array;  
  
} 

// Get attachment id by url

function mm_get_attachment_id_from_url( $attachment_url = '' ) {
 
	global $wpdb;
	$attachment_id = false;
 
	// If there is no url, return.
	if ( '' == $attachment_url )
		return;
 
	// Get the upload directory paths
	$upload_dir_paths = wp_upload_dir();
 
	// Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
	if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
 
		// If this is the URL of an auto-generated thumbnail, get the URL of the original image
		$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
 
		// Remove the upload path base directory from the attachment URL
		$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
 
		// Finally, run a custom database query to get the attachment ID from the modified attachment URL
		$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
 
	}
 
	return $attachment_id;
}

// Attach callback to 'tiny_mce_before_init' 
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' ); 

/**
 * Custom fields (ACF required) for homepage, profiles, etc. 
 */
require get_template_directory() . '/inc/custom-fields.php';

/**
 * Implement Shortcodes.
 */
require get_template_directory() . '/inc/shortcodes.php';


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';