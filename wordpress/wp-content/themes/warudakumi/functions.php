<?php

/**
 * _s functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package _s
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

if (!function_exists('_s_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function _s_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on _s, use a find and replace
		 * to change '_s' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('_s', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__('Primary', '_s'),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'_s_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action('after_setup_theme', '_s_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function _s_content_width()
{
	$GLOBALS['content_width'] = apply_filters('_s_content_width', 640);
}
add_action('after_setup_theme', '_s_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function _s_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', '_s'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', '_s'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', '_s_widgets_init');

//デフォルトjQueryを読み込まない
function delete_jquery() {
	if (!is_admin()) {
	  wp_deregister_script('jquery');
	}
  }
  add_action('init', 'delete_jquery');

/**
 * Enqueue scripts and styles.
 */
function _s_scripts()
{
	//stylesheet読み込み
	//wp_enqueue_style('style', get_template_directory_uri() . '/css/style.min.css');
	wp_enqueue_style('style', get_template_directory_uri() . '/css/style.css');
	//fontawesome
	wp_enqueue_style('fontawesome', 'https://use.fontawesome.com/releases/v5.6.3/css/all.css',array(), '5.6.3');
	wp_style_add_data('_s-style', 'rtl', 'replace');
	
	
	// jQuery
	wp_enqueue_script('script_jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', array(),'3.2.1', true);
	//JS iScroll
	wp_enqueue_script('script_JS_iScroll', 'https://cdnjs.cloudflare.com/ajax/libs/iScroll/5.2.0/iscroll.min.js', array(),'5.2.0', true);
	// JS nav
	wp_enqueue_script('JS_nav', get_template_directory_uri() . '/assets/js/nav.js', array(), _S_VERSION, true);
	//JS yurayura
	wp_enqueue_script('JS_yurayura', get_template_directory_uri() . '/assets/js/yurayura.js', array(), _S_VERSION, true);
	//midnight
	wp_enqueue_script('midnight', get_template_directory_uri() . '/assets/js/midnight.jquery.min.js', array(), _S_VERSION, true);
	//colorbox
	wp_enqueue_script('colorbox', get_template_directory_uri() . '/assets/js/jquery.colorbox-min.js', array(), _S_VERSION, true);
	//main.js
	wp_enqueue_script('main.js', get_template_directory_uri() . '/assets/js/main.js', array(), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', '_s_scripts');


	
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
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}


function Change_menulabel()
{
	global $menu;
	global $submenu;
	$name = 'Design works All';
	$menu[5][0] = $name;
	$submenu['edit.php'][5][0] = $name . '一覧';
	$submenu['edit.php'][10][0] = '新しいDesign works';
}
function Change_objectlabel()
{
	global $wp_post_types;
	$name = 'Design works All';
	$labels = &$wp_post_types['post']->labels;
	$labels->name = $name;
	$labels->singular_name = $name;
	$labels->add_new = _x('追加', $name);
	$labels->add_new_item = $name . 'の新規追加';
	$labels->edit_item = $name . 'の編集';
	$labels->new_item = '新規' . $name;
	$labels->view_item = $name . 'を表示';
	$labels->search_items = $name . 'を検索';
	$labels->not_found = $name . 'が見つかりませんでした';
	$labels->not_found_in_trash = 'ゴミ箱に' . $name . 'は見つかりませんでした';
}
add_action('init', 'Change_objectlabel');
add_action('admin_menu', 'Change_menulabel');



function get_post_number($previous = false, $same_term = true, $taxonomy = 'category')
{
  global $wpdb;

  if ((!$post = get_post()) || !taxonomy_exists($taxonomy))
    return null;

  $current_post_date = $post->post_date;
  $join = '';
  $where = '';

  if ($same_term) {
    $join .= " INNER JOIN $wpdb->term_relationships AS tr ON p.ID = tr.object_id INNER JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id";
    $where .= $wpdb->prepare("AND tt.taxonomy = %s", $taxonomy);

    if (!is_object_in_taxonomy($post->post_type, $taxonomy))
      return null;

    $terms = get_the_terms($post->ID, $taxonomy);
    if ($terms) {
      $terms = wp_list_sort($terms, array('term_id' => 'ASC'));
      $term = $terms[0];
      $where .= " AND tt.term_id = {$term->term_id}";
    }
  }

  if (is_user_logged_in()) {
    $user_id = get_current_user_id();

    $post_type_object = get_post_type_object($post->post_type);
    if (empty($post_type_object)) {
      $post_type_cap    = $post->post_type;
      $read_private_cap = 'read_private_' . $post_type_cap . 's';
    } else {
      $read_private_cap = $post_type_object->cap->read_private_posts;
    }

    $private_states = get_post_stati(array('private' => true));
    $where .= " AND ( p.post_status = 'publish'";
    foreach ((array) $private_states as $state) {
      if (current_user_can($read_private_cap)) {
        $where .= $wpdb->prepare(" OR p.post_status = %s", $state);
      } else {
        $where .= $wpdb->prepare(" OR (p.post_author = %d AND p.post_status = %s)", $user_id, $state);
      }
    }
    $where .= " )";
  } else {
    $where .= " AND p.post_status = 'publish'";
  }

  $op = $previous ? '<=' : '>=';
  $order = $previous ? 'ASC' : 'DESC';

  $where = $wpdb->prepare("WHERE p.post_date $op %s AND p.post_type = %s $where", $current_post_date, $post->post_type);
  $sql = "SELECT COUNT(*) FROM $wpdb->posts AS p $join $where ORDER BY p.post_date $order";
  $number = (int)$wpdb->get_var($sql);

  return $number;
}