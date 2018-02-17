<?php
/**
* cornerstone functions and definitions
*
* @link https://developer.wordpress.org/themes/basics/theme-functions/
*
* @package cornerstone
*/
if ( ! function_exists( 'cornerstone_setup' ) ) :
   /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * Note that this function is hooked into the after_setup_theme hook, which
   * runs before the init hook. The init hook is too late for some features, such
   * as indicating support for post thumbnails.
   */
   function cornerstone_setup() {
      /*
      * Make theme available for translation.
      * Translations can be filed in the /languages/ directory.
      * If you're building a theme based on cornerstone, use a find and replace
      * to change 'cornerstone' to the name of your theme in all the template files.
      */
      load_theme_textdomain( 'cornerstone', get_template_directory() . '/languages' );
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
         'menu-1' => esc_html__( 'Primary', 'cornerstone' ),
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
      add_theme_support( 'custom-background', apply_filters( 'cornerstone_custom_background_args', array(
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
add_action( 'after_setup_theme', 'cornerstone_setup' );
/**
* Set the content width in pixels, based on the theme's design and stylesheet.
*
* Priority 0 to make it available to lower priority callbacks.
*
* @global int $content_width
*/
function cornerstone_content_width() {
   $GLOBALS['content_width'] = apply_filters( 'cornerstone_content_width', 640 );
}
add_action( 'after_setup_theme', 'cornerstone_content_width', 0 );
/**
* Register widget area.
*
* @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
*/
function cornerstone_widgets_init() {
   register_sidebar( array(
      'name'          => esc_html__( 'Sidebar', 'cornerstone' ),
      'id'            => 'sidebar-1',
      'description'   => esc_html__( 'Add widgets here.', 'cornerstone' ),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h2 class="widget-title">',
      'after_title'   => '</h2>',
   ) );
}
add_action( 'widgets_init', 'cornerstone_widgets_init' );
/**
* Enqueue scripts and styles.
*/
function cornerstone_scripts() {
   wp_enqueue_style( 'cornerstone-style', get_stylesheet_uri() );
   wp_enqueue_script( 'cornerstone-jquery', get_template_directory_uri() . '/js/jquery.min.js', array(), '20151215', true );
   wp_enqueue_script( 'cornerstone-foundation', get_template_directory_uri() . '/js/foundation.min.js', array(), '20151215', true );
   wp_enqueue_script( 'cornerstone-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
   wp_enqueue_script( 'cornerstone-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
      wp_enqueue_script( 'cornerstone-main', get_template_directory_uri() . '/js/main.js', array(), '20151215', true );
      
   // wp_register_script( 'parallax', 'https://cdnjs.cloudflare.com/ajax/libs/parallax/3.1.0/parallax.min.js', null, null, true );
   // wp_enqueue_script('parallax');  

   if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
      wp_enqueue_script( 'comment-reply' );
   }
}
add_action( 'wp_enqueue_scripts', 'cornerstone_scripts' );
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
// add settings to customizer
function cornerstone_theme_customizer( $wp_customize ) {
   $wp_customize->add_control(
new WP_Customize_Image_Control(
$wp_customize,
'hero_logo',
array(
'label'      => __( 'Upload a Hero Logo', 'cornerstone' ),
'section'    => 'header_image',
)
)
);
$wp_customize->add_control(
new WP_Customize_Image_Control(
$wp_customize,
'menu_logo',
array(
'label'      => __( 'Upload a Menu Logo', 'cornerstone' ),
'section'    => 'title_tagline',
)
)
);
$wp_customize->add_section( 'cornerstone_footer_section' , array(
'title'    => __( 'Footer Section', 'cornerstone' ),
'priority' => 30
) );
$menu_items = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
$select_menu = [
   'NULL' => __('Select a Menu'),
];

foreach ($menu_items as $item) {
      $select_menu[$item->term_id] = __($item->name);
   }
$wp_customize->add_control(
new WP_Customize_Control(
$wp_customize,
'footer_menu',
array(
'label'          => __( 'Footer Menu', 'cornerstone' ),
'section'        => 'cornerstone_footer_section',
'settings'       => 'footer_menu',
'type'           => 'select',
'choices'        => $select_menu,
)
)
   );
$wp_customize->add_control(
new WP_Customize_Control(
$wp_customize,
'text_section_1',
array(
'label'          => __( 'Text Section One', 'cornerstone' ),
'section'        => 'cornerstone_footer_section',
'settings'       => 'text_section_1',
'description'    => __('Here ( both textareas :0 ) you can enter HTML. You can also use font awesome icons Check out how  <a href="http://fontawesome.io/icons/">here</a>. Also you can use Foundation classes <a href="https://foundation.zurb.com/sites/docs/">See Here</a>.'),
'type'           => 'textarea',
)
)
   );
   
   $wp_customize->add_control(
new WP_Customize_Control(
$wp_customize,
'text_section_2',
array(
'label'          => __( 'Text Section Two', 'cornerstone' ),
'section'        => 'cornerstone_footer_section',
'settings'       => 'text_section_2',
'type'           => 'textarea',
)
)
   );
      $wp_customize->add_control(
new WP_Customize_Control(
$wp_customize,
'text_section_3',
array(
'label'          => __( 'Text Section Three', 'cornerstone' ),
'section'        => 'cornerstone_footer_section',
'settings'       => 'text_section_3',
'type'           => 'textarea',
)
)
   );
}
add_action( 'customize_register', 'cornerstone_theme_customizer' );
// added settings in customizer.php
// Donate
function single_purpose_donate ($purpose){
echo '<form class="paypal_form" action="https://www.paypal.com/cgi-bin/webscr" method="post">
   <input name="cmd" type="hidden" value="_donations">
   <input name="business" type="hidden" value="carla@cornerstoneinternational.org">
   <input name="item_name" type="hidden" value="'. $purpose .'">
   <input name="currency_code" type="hidden" value="USD">
   <input class="paypal_btn" title="paypal" alt="'. $purpose .'" name="submit" value="donate" type="submit">
</form>';
}
function donate_select_func($atts){
   $atts = shortcode_atts( array(
        'projects' => [],
    ), $atts );
   $atts = explode(",", $atts['projects']);
   $missionaries = new WP_query(array(
     'posts_per_page' => -1,
     'post_type' => 'missionary',
   ));
   $options = "";
   if (!empty($atts)){
      foreach ($atts as $value) {
         $options .= "<option value=". str_replace(" ", '%20', $value) .">". $value ."</option>";
      }
   }

   foreach ($missionaries->posts as $missionary) {
   $project_name = get_field('project_name', $missionary->ID);   
      $options .= '<option value="'. $missionary->post_title . (!empty($project_name)? " - " . $project_name : "") .'">'. $missionary->post_title . (!empty($project_name)? " - " . $project_name : "") . '</option>';
   }


   return '<form class="paypal_form" action="https://www.paypal.com/cgi-bin/webscr" method="post">
         <input name="cmd" type="hidden" value="_donations">
         <input name="business" type="hidden" value="carla@cornerstoneinternational.org">
         <select name="item_name">
         '.$options .'
         </select>
         <input name="currency_code" type="hidden" value="USD">
         <input class="paypal_btn read-on button" title="paypal" name="submit" value="donate" type="submit">
      </form>';

}

add_shortcode( 'donate_select', 'donate_select_func' );
