<?php
/**
 * Odin functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package Odin
 * @since 2.2.0
 */

/**
 * Sets content width.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 600;
}

/**
 * Odin Classes.
 */
require_once get_template_directory() . '/core/classes/class-bootstrap-nav.php';
require_once get_template_directory() . '/core/classes/class-shortcodes.php';
//require_once get_template_directory() . '/core/classes/class-shortcodes-menu.php';
require_once get_template_directory() . '/core/classes/class-thumbnail-resizer.php';
// require_once get_template_directory() . '/core/classes/class-theme-options.php';
// require_once get_template_directory() . '/core/classes/class-options-helper.php';
// require_once get_template_directory() . '/core/classes/class-post-type.php';
// require_once get_template_directory() . '/core/classes/class-taxonomy.php';
// require_once get_template_directory() . '/core/classes/class-metabox.php';
// require_once get_template_directory() . '/core/classes/abstracts/abstract-front-end-form.php';
// require_once get_template_directory() . '/core/classes/class-contact-form.php';
// require_once get_template_directory() . '/core/classes/class-post-form.php';
// require_once get_template_directory() . '/core/classes/class-user-meta.php';
// require_once get_template_directory() . '/core/classes/class-post-status.php';
//require_once get_template_directory() . '/core/classes/class-term-meta.php';

/**
 * Odin Widgets.
 */
require_once get_template_directory() . '/core/classes/widgets/class-widget-like-box.php';




if ( ! function_exists( 'odin_setup_features' ) ) {

	/**
	 * Setup theme features.
	 *
	 * @since 2.2.0
	 */
	function odin_setup_features() {

		/**
		 * Add support for multiple languages.
		 */
		load_theme_textdomain( 'odin', get_template_directory() . '/languages' );

		/**
		 * Register nav menus.
		 */
		register_nav_menus(
			array(
				'main-menu' => __( 'Main Menu', 'odin' )
			)
		);

		/*
		 * Add post_thumbnails suport.
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Add feed link.
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Support Custom Header.
		 */
		$default = array(
			'width'         => 0,
			'height'        => 0,
			'flex-height'   => false,
			'flex-width'    => false,
			'header-text'   => false,
			'default-image' => '',
			'uploads'       => true,
		);

		add_theme_support( 'custom-header', $default );

		/**
		 * Support Custom Background.
		 */
		$defaults = array(
			'default-color' => '',
			'default-image' => '',
		);

		add_theme_support( 'custom-background', $defaults );

		/**
		 * Support Custom Editor Style.
		 */
		add_editor_style( 'assets/css/editor-style.css' );

		/**
		 * Add support for infinite scroll.
		 */
		add_theme_support(
			'infinite-scroll',
			array(
				'type'           => 'scroll',
				'footer_widgets' => false,
				'container'      => 'content',
				'wrapper'        => false,
				'render'         => false,
				'posts_per_page' => get_option( 'posts_per_page' )
			)
		);

		/**
		 * Add support for Post Formats.
		 */
		// add_theme_support( 'post-formats', array(
		//     'aside',
		//     'gallery',
		//     'link',
		//     'image',
		//     'quote',
		//     'status',
		//     'video',
		//     'audio',
		//     'chat'
		// ) );

		/**
		 * Support The Excerpt on pages.
		 */
		// add_post_type_support( 'page', 'excerpt' );

		/**
		 * Switch default core markup for search form, comment form, and comments to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption'
			)
		);

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for custom logo.
		 *
		 *  @since Odin 2.2.10
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 240,
			'width'       => 240,
			'flex-height' => true,
		) );
	}
}

add_action( 'after_setup_theme', 'odin_setup_features' );

/**
 * Register widget areas.
 *
 * @since 2.2.0
 */
function odin_widgets_init() {
	register_sidebar(
		array(
			'name' => __( 'Main Sidebar', 'odin' ),
			'id' => 'main-sidebar',
			'description' => __( 'Site Main Sidebar', 'odin' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widgettitle widget-title">',
			'after_title' => '</h3>',
		)
	);
}

add_action( 'widgets_init', 'odin_widgets_init' );

/**
 * Flush Rewrite Rules for new CPTs and Taxonomies.
 *
 * @since 2.2.0
 */
function odin_flush_rewrite() {
	flush_rewrite_rules();
}

add_action( 'after_switch_theme', 'odin_flush_rewrite' );

/**
 * Load site scripts.
 *
 * @since 2.2.0
 */
function odin_enqueue_scripts() {
	$template_url = get_template_directory_uri();

	// Loads Odin main stylesheet.
	wp_enqueue_style( 'odin-style', get_stylesheet_uri(), array(), null, 'all' );

	// jQuery.
	wp_enqueue_script( 'jquery' );

	// Html5Shiv
	wp_enqueue_script( 'html5shiv', $template_url . '/assets/js/html5.js' );
	wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

	// General scripts.
	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
		// Bootstrap.
		wp_enqueue_script( 'bootstrap', $template_url . '/assets/js/libs/bootstrap.min.js', array(), null, true );

		// FitVids.
		wp_enqueue_script( 'fitvids', $template_url . '/assets/js/libs/jquery.fitvids.js', array(), null, true );

		// Main jQuery.
		wp_enqueue_script( 'odin-main', $template_url . '/assets/js/main.js', array(), null, true );
	} else {
		// Grunt main file with Bootstrap, FitVids and others libs.
		wp_enqueue_script( 'odin-main-min', $template_url . '/assets/js/main.min.js', array(), null, true );
	}

	// Grunt watch livereload in the browser.
	// wp_enqueue_script( 'odin-livereload', 'http://localhost:35729/livereload.js?snipver=1', array(), null, true );

	// Load Thread comments WordPress script.
	if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'odin_enqueue_scripts', 1 );

/**
 * Odin custom stylesheet URI.
 *
 * @since  2.2.0
 *
 * @param  string $uri Default URI.
 * @param  string $dir Stylesheet directory URI.
 *
 * @return string      New URI.
 */
function odin_stylesheet_uri( $uri, $dir ) {
	return $dir . '/assets/css/style.css';
}

add_filter( 'stylesheet_uri', 'odin_stylesheet_uri', 10, 2 );



// Register Custom Post Types
function custom_animal_type() {

	$labels = array(
		'name'                  => _x( 'Animais', 'Post Type General Name', 'odin' ),
		'singular_name'         => _x( 'Animal', 'Post Type Singular Name', 'odin' ),
		'menu_name'             => __( 'Animais', 'odin' ),
		'name_admin_bar'        => __( 'Animais', 'odin' ),
		'archives'              => __( 'Animais arquivados', 'odin' ),
		'attributes'            => __( 'Item Attributes', 'odin' ),
		'parent_item_colon'     => __( '', 'odin' ),
		'all_items'             => __( 'Todos os itens', 'odin' ),
		'add_new_item'          => __( 'Adicionar novo item', 'odin' ),
		'add_new'               => __( 'Adicionar Animal', 'odin' ),
		'new_item'              => __( 'Novo animal', 'odin' ),
		'edit_item'             => __( 'Editar item', 'odin' ),
		'update_item'           => __( 'Atualizar item', 'odin' ),
		'view_item'             => __( 'Ver item', 'odin' ),
		'view_items'            => __( 'Ver itens', 'odin' ),
		'search_items'          => __( 'Buscar animal', 'odin' ),
		'not_found'             => __( 'Não encontrado', 'odin' ),
		'not_found_in_trash'    => __( 'Não encontrado na lixeira', 'odin' ),
		'featured_image'        => __( 'Imagem destacada', 'odin' ),
		'set_featured_image'    => __( 'Definir imagem destacada', 'odin' ),
		'remove_featured_image' => __( 'Remover imagem destacada', 'odin' ),
		'use_featured_image'    => __( 'Usar como imagem destacada', 'odin' ),
		'insert_into_item'      => __( 'Adicionar a este item', 'odin' ),
		'uploaded_to_this_item' => __( 'Subidos por este item', 'odin' ),
		'items_list'            => __( 'Lista de itens', 'odin' ),
		'items_list_navigation' => __( 'Items list navigation', 'odin' ),
		'filter_items_list'     => __( 'Filtrar itens da lista', 'odin' ),
	);
	$args = array(
		'label'                 => __( 'Animal', 'odin' ),
		'labels'                => $labels,
		'supports'              => array( 'custom-fields' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-buddicons-activity',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest'          => true,
	);
	register_post_type( 'animal', $args );

}

function custom_consulta_type() {

	$labels = array(
		'name'                  => _x( 'Consultas', 'Post Type General Name', 'odin' ),
		'singular_name'         => _x( 'Consulta', 'Post Type Singular Name', 'odin' ),
		'menu_name'             => __( 'Consultas', 'odin' ),
		'name_admin_bar'        => __( 'Consultas', 'odin' ),
		'archives'              => __( 'Consultas arquivadas', 'odin' ),
		'attributes'            => __( 'Item Attributes', 'odin' ),
		'parent_item_colon'     => __( '', 'odin' ),
		'all_items'             => __( 'Todos os itens', 'odin' ),
		'add_new_item'          => __( 'Adicionar novo item', 'odin' ),
		'add_new'               => __( 'Adicionar consulta', 'odin' ),
		'new_item'              => __( 'Novo consulta', 'odin' ),
		'edit_item'             => __( 'Editar item', 'odin' ),
		'update_item'           => __( 'Atualizar item', 'odin' ),
		'view_item'             => __( 'Ver item', 'odin' ),
		'view_items'            => __( 'Ver itens', 'odin' ),
		'search_items'          => __( 'Buscar consulta', 'odin' ),
		'not_found'             => __( 'Não encontrado', 'odin' ),
		'not_found_in_trash'    => __( 'Não encontrado na lixeira', 'odin' ),
		'featured_image'        => __( 'Imagem destacada', 'odin' ),
		'set_featured_image'    => __( 'Definir imagem destacada', 'odin' ),
		'remove_featured_image' => __( 'Remover imagem destacada', 'odin' ),
		'use_featured_image'    => __( 'Usar como imagem destacada', 'odin' ),
		'insert_into_item'      => __( 'Adicionar a este item', 'odin' ),
		'uploaded_to_this_item' => __( 'Subidos por este item', 'odin' ),
		'items_list'            => __( 'Lista de itens', 'odin' ),
		'items_list_navigation' => __( 'Items list navigation', 'odin' ),
		'filter_items_list'     => __( 'Filtrar itens da lista', 'odin' ),
	);
	$args = array(
		'label'                 => __( 'Consulta', 'odin' ),
		'labels'                => $labels,
		'supports'              => array( 'custom-fields' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-buddicons-activity',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest'          => true,

	);
	register_post_type( 'consulta', $args );

}

add_action( 'init', 'custom_animal_type', 0 );
add_action( 'init', 'custom_consulta_type', 0 );






get_template_part('requests/animal/new');


/**
 * Query WooCommerce activation
 *
 * @since  2.2.6
 *
 * @return boolean
 */
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {
		return class_exists( 'woocommerce' ) ? true : false;
	}
}

/**
 * Core Helpers.
 */
require_once get_template_directory() . '/core/helpers.php';

/**
 * WP Custom Admin.
 */
require_once get_template_directory() . '/inc/admin.php';

/**
 * Comments loop.
 */
require_once get_template_directory() . '/inc/comments-loop.php';

/**
 * WP optimize functions.
 */
require_once get_template_directory() . '/inc/optimize.php';

/**
 * Custom template tags.
 */
require_once get_template_directory() . '/inc/template-tags.php';

/**
 * WooCommerce compatibility files.
 */
if ( is_woocommerce_activated() ) {
	add_theme_support( 'woocommerce' );
	require get_template_directory() . '/inc/woocommerce/hooks.php';
	require get_template_directory() . '/inc/woocommerce/functions.php';
	require get_template_directory() . '/inc/woocommerce/template-tags.php';
}
