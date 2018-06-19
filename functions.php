<?php
/**
 * campfire functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package campfire
 */

if ( ! function_exists( 'campfire_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function campfire_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on campfire, use a find and replace
		 * to change 'campfire' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'campfire', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'campfire' ),
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

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'campfire_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'campfire_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function campfire_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'campfire_content_width', 640 );
}
add_action( 'after_setup_theme', 'campfire_content_width', 0 );

/**
 * Add "Page Details" meta box
 */
function details_meta_box_markup($object)
{
	wp_nonce_field(basename(__FILE__), "meta-box-nonce");
	?>
		<div>
			<label for="meta-description">Description</label>
			<input name="meta-description" type="text" value="<?php echo get_post_meta($object->ID, "meta-description", true); ?>">
		</div>
	<?php  
}

function add_details_meta_box()
{
    add_meta_box("details-meta-box", "Details", "details_meta_box_markup", ["page", "post"], "normal", "high", null);
}

add_action("add_meta_boxes", "add_details_meta_box");

/**
 * Save data from "Page Details" meta box
 */

function save_details_meta_box($post_id, $post, $update)
{
	if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__)))
		return $post_id;

	if(!current_user_can("edit_post", $post_id))
		return $post_id;

	if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
		return $post_id;

	$meta_description_value = "";

	if(isset($_POST["meta-description"]))
	{
			$meta_description_value = $_POST["meta-description"];
	}   
	update_post_meta($post_id, "meta-description", $meta_description_value);
}

add_action("save_post", "save_details_meta_box", 10, 3);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function campfire_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'campfire' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'campfire' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'campfire_widgets_init' );
/**
 * Add secondary logo
 */
function your_theme_customizer_setting($wp_customize) {
	// add a setting 
	$wp_customize->add_setting('secondary_logo');
	// Add a control to upload the secondary logo
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'secondary_logo', array(
		'label' => 'Upload Secondary Logo',
		'section' => 'title_tagline', //this is the section where the custom-logo from WordPress is
		'settings' => 'secondary_logo',
		'priority' => 8 // show it just below the custom-logo
	)));
	}
	
	add_action('customize_register', 'your_theme_customizer_setting');
/**
 * Enqueue scripts and styles.
 */
function campfire_scripts() {
	wp_enqueue_style( 'campfire-style', get_stylesheet_uri() );

	wp_enqueue_style( 'wpb-google-fonts', 'https://fonts.googleapis.com/css?family=Alegreya+SC:400,700|Alegreya+Sans:700', false );

	wp_enqueue_script( 'campfire-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'campfire-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'campfire_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
/**
 * Allow SVG uploads
 */
function add_file_types_to_uploads($file_types){
	$new_filetypes = array();
	$new_filetypes['svg'] = 'image/svg+xml';
	$file_types = array_merge($file_types, $new_filetypes );
	return $file_types;
	}
	add_action('upload_mimes', 'add_file_types_to_uploads');