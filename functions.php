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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'mmbeta' ),
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
	) );

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
		register_taxonomy( 'preise', array( 'preistraeger' ), $args );

	}
	add_action( 'init', 'add_taxonomy_preise', 0 );

	// Change Password protected wording

	function my_password_form() {
	    global $post;
	    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	    $o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
	    ' . __( "Bitte geben Sie das Passwort aus der Printausgabe ein, um den Inhalt zu sehen:" ) . "<br>" . '
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

	//Custom fields for Preisträger
	if(function_exists("register_field_group"))
	{
		register_field_group(array (
			'id' => 'acf_post-fields',
			'title' => 'Post-Fields',
			'fields' => array (
				array (
					'key' => 'field_568e1b987eb0d',
					'label' => 'Teaser-Link',
					'name' => 'link',
					'type' => 'page_link',
					'instructions' => 'Wenn dieses Feld ausgefüllt ist, linkt der Teaser nicht auf den Beitrag selbst, sondern auf die hier eingetragene Seite/Post/Preisträger.',
					'post_type' => array (
						0 => 'all',
					),
					'allow_null' => 1,
					'multiple' => 0,
				),
			),
			'location' => array (
				array (
					array (
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'post',
						'order_no' => 0,
						'group_no' => 0,
					),
				),
				array (
					array (
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'preistraeger',
						'order_no' => 0,
						'group_no' => 1,
					),
				),
			),
			'options' => array (
				'position' => 'normal',
				'layout' => 'no_box',
				'hide_on_screen' => array (
				),
			),
			'menu_order' => 0,
		));
		register_field_group(array (
			'id' => 'acf_preistrager-felder',
			'title' => 'Preisträger-Felder',
			'fields' => array (
				array (
					'key' => 'field_568c54a877aa9',
					'label' => 'Platz',
					'name' => 'platz',
					'type' => 'number',
					'instructions' => 'Zum Beispiel: Platz 1 von 10',
					'required' => 1,
					'default_value' => 1,
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'min' => 1,
					'max' => 10,
					'step' => 1,
				),
				array (
					'key' => 'field_5690fbcdd9c84',
					'label' => 'Preis-Titel',
					'name' => 'preis-titel',
					'type' => 'text',
					'instructions' => 'z.B. Journalistin des Jahres oder Kulturjournalist des Jahres. Wenn nicht ausgefüllt, erscheint zB. Platz 8, Kategorie Kultur ',
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'formatting' => 'html',
					'maxlength' => '',
				),
				array (
					'key' => 'field_5690fcafd9c85',
					'label' => 'Vorname',
					'name' => 'vorname',
					'type' => 'text',
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'formatting' => 'html',
					'maxlength' => '',
				),
				array (
					'key' => 'field_5690fb23d9c83',
					'label' => 'Nachname',
					'name' => 'nachname',
					'type' => 'text',
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'formatting' => 'html',
					'maxlength' => '',
				),
				array (
					'key' => 'field_568c5b142551c',
					'label' => 'Position',
					'name' => 'position',
					'type' => 'text',
					'instructions' => 'In welcher Position/Funktion wurde die Person ausgezeichnet?',
					'required' => 1,
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'formatting' => 'html',
					'maxlength' => '',
				),
				array (
					'key' => 'field_568c592ec49ed',
					'label' => 'Jury-Begründung',
					'name' => 'begruendung',
					'type' => 'wysiwyg',
					'instructions' => 'z.B. " Journalistin mit Profil und klarer Haltung: Im Sommer 2015 zeigte Reschke mit ihrem Kommentar ,Aufstand der Anständigen‘ in den ,Tagesthemen‘, was der Journalismus in Zeiten der ,Lügenpresse‘-Vorwürfe braucht: Haltung..."',
					'default_value' => '',
					'toolbar' => 'basic',
					'media_upload' => 'no',
				),
			),
			'location' => array (
				array (
					array (
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'preistraeger',
						'order_no' => 0,
						'group_no' => 0,
					),
				),
			),
			'options' => array (
				'position' => 'acf_after_title',
				'layout' => 'no_box',
				'hide_on_screen' => array (
				),
			),
			'menu_order' => 0,
		));
	}

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'mmbeta_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // mmbeta_setup
add_action( 'after_setup_theme', 'mmbeta_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mmbeta_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'mmbeta_content_width', 640 );
}
add_action( 'after_setup_theme', 'mmbeta_content_width', 0 );

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
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'mmbeta_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function mmbeta_scripts() {
	wp_enqueue_style( 'mmbeta-custom', get_template_directory_uri() . '/css/mmbeta-custom.css' );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css' );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array( 'jquery' ), '20151106', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mmbeta_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
