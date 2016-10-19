<?php


/* START display the custom dashboard widget. */
function register_my_dashboard_widget() {
    global $wp_meta_boxes;
    wp_add_dashboard_widget(
        'my_dashboard_widget',
        'Documentation and Notes',
        'my_dashboard_widget_display'
    );
    $dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
    $my_widget = array( 'my_dashboard_widget' => $dashboard['my_dashboard_widget'] );
    unset( $dashboard['my_dashboard_widget'] );
    $sorted_dashboard = array_merge( $my_widget, $dashboard );
    $wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
}
add_action( 'wp_dashboard_setup', 'register_my_dashboard_widget' );
function my_dashboard_widget_display() {
    ?>
    <p>This is where important information about this website will be displayed.</p>
    <h2>Title</h2>
    <p>Information about that</p>
    <?php
} /* END display the custom dashboard widget. */


/* Remove wp-emoji-release.min.js from loading. */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );



// Creates a shortcode that displays the current date:
function thisYear( $atts ){
    return date("Y");
}
add_shortcode( 'displayYear', 'thisYear' );

// Enables widgets in a text widget .
add_filter('widget_text','do_shortcode');



/* Change the Login Logo that displays on the admin login page  */
function my_login_logo() { ?>
    <style type="text/css">
        .login h1 a {
            background-image: url(/wp-content/themes/CURRENT-THEME-DIRECTORY/images/mstile-150x150.png);
            background-size: 270px;
            background-position: center center;
            padding-bottom: 0px;
            height: 120px;
            width: 270px;
            -webkit-background-size: 270px;
        }

        #login{
            padding-top: 60px;
            margin-top: 0;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );






/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (!isset($content_width))
{
    $content_width = 900;
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('fullwidth', 1300, '', true); // Extra Large Thumbnail
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail

    function my_custom_sizes( $sizes ) {
        return array_merge( $sizes, array(
            'fullwidth' => __( 'full width' ),
            'small' => __( 'small' ),
        ) );
    }

    // Add Support for Custom Backgrounds - Uncomment below if you're going to use
    /*add_theme_support('custom-background', array(
	'default-color' => 'FFF',
	'default-image' => get_template_directory_uri() . '/img/bg.jpg'
    ));*/

    // Add Support for Custom Header - Uncomment below if you're going to use
    /*add_theme_support('custom-header', array(
	'default-image'			=> get_template_directory_uri() . '/img/headers/default.jpg',
	'header-text'			=> false,
	'default-text-color'		=> '000',
	'width'				=> 1000,
	'height'			=> 198,
	'random-default'		=> false,
	'wp-head-callback'		=> $wphead_cb,
	'admin-head-callback'		=> $adminhead_cb,
	'admin-preview-callback'	=> $adminpreview_cb
    ));*/

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('roundation', get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// HTML5 Blank navigation
function roundation_nav()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => '',
		'container'       => 'div',
		'container_class' => 'menu-{menu slug}-container',
		'container_id'    => '',
		'menu_class'      => 'menu',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul>%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}

// Load HTML5 Blank scripts (header.php)
function roundation_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

    	wp_register_script('conditionizr', get_template_directory_uri() . '/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0'); // Conditionizr
        wp_enqueue_script('conditionizr'); // Enqueue it!

        wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1'); // Modernizr
        wp_enqueue_script('modernizr'); // Enqueue it!

        wp_register_script('boot3', get_template_directory_uri() . '/js/bootstrap.min.js');
        wp_enqueue_script('boot3');
    }
}

// Load HTML5 Blank conditional scripts
function roundation_conditional_scripts()
{
    if (is_page('pagenamehere')) {
        wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
        wp_enqueue_script('scriptname'); // Enqueue it!
    }


}

// Load HTML5 Blank styles
function roundation_styles()
{
    wp_register_style('normalize', get_template_directory_uri() . '/normalize.css', array(), '1.0', 'all');
    wp_enqueue_style('normalize'); // Enqueue it!

    wp_register_style('roundation', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('roundation'); // Enqueue it!

    wp_register_style( 'boot1', get_template_directory_uri().'/css/bootstrap.min.css' );
    wp_enqueue_style( 'boot1');
    wp_register_style( 'boot2', get_template_directory_uri().'/css/bootstrap-theme.min.css' );
    wp_enqueue_style( 'boot2');
}

// Register HTML5 Blank Navigation
function register_html5_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'roundation'), // Main Navigation
        'sidebar-menu' => __('Sidebar Menu', 'roundation'), // Sidebar Navigation
        'extra-menu' => __('Extra Menu', 'roundation') // Extra Navigation if needed (duplicate as many as you need!)
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'roundation'),
        'description' => __('Description for this widget-area...', 'roundation'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Widget Area 2', 'roundation'),
        'description' => __('Description for this widget-area...', 'roundation'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));


        register_sidebar(array(
            'name' => 'Footer Column 1',
            'id' => 'footer1',
            'before_widget' => '<div class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        ));

        register_sidebar(array(
            'name' => 'Footer Column 2',
            'id' => 'footer2',
            'before_widget' => '<div class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        ));

        register_sidebar(array(
            'name' => 'Footer Column 3',
            'id' => 'footer3',
            'before_widget' => '<div class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        ));

        register_sidebar(array(
            'name' => 'Footer Column 4',
            'id' => 'footer4',
            'before_widget' => '<div class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        ));

}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function html5_blank_view_article($more)
{
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'roundation') . '</a>';
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Removes absolute path from inserted images
function remove_absolute_path( $html )
{
    $site_url1 = site_url(); // http://disenodev.linklotus.com/
    $html = str_replace( $site_url1, "", $html);
    return $html;
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function roundationgravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function roundationcomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'roundation_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'roundation_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'roundation_styles'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
add_action('init', 'create_post_type_testimonial');
add_action('init', 'create_post_type_portfolio'); // Add our HTML5 Blank Custom Post Type
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'roundationgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_absolute_path', 10); // Remove the http://domain.com from images that get inserted.
add_filter('image_send_to_editor', 'remove_absolute_path', 10); // Remove the http://domain.com from images that get inserted.

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// This make sure that the auto <p> tag feature in Worpress Content runs after everything else,
// keeping the usability but stopping the random insertions:
remove_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', 'wpautop' , 99);

// Shortcodes
add_shortcode('bottomCTA', 'bottomCTA');


/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/

// Create a Custom Post type for Testimonials
// They are used in the revolutionary slider on the home page.
function create_post_type_testimonial()
{
    register_taxonomy_for_object_type('category', 'testimonial'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'testimonial');
    register_post_type('testimonial', // Register Custom Post Type
        array(
            'labels' => array(
                'name' => __('Testimonials', 'testimonial'), // Rename these to suit
                'singular_name' => __('Testimonial Posts', 'testimonial'),
                'add_new' => __('Add New', 'testimonial'),
                'add_new_item' => __('Add New Testimonial Posts', 'testimonial'),
                'edit' => __('Edit', 'testimonial'),
                'edit_item' => __('Edit Testimonial Posts', 'testimonial'),
                'new_item' => __('New Testimonial Posts', 'testimonial'),
                'view' => __('View Testimonial Posts', 'testimonial'),
                'view_item' => __('View Testimonial Posts', 'testimonial'),
                'search_items' => __('Search Testimonial Posts', 'testimonial'),
                'not_found' => __('No Testimonial Posts found', 'testimonial'),
                'not_found_in_trash' => __('No Testimonial Posts found in Trash', 'testimonial')
            ),
            'exclude_from_search' => false,
            'public' => true,
            'hierarchical' => false, // Allows your posts to behave like Hierarchy Pages
            'has_archive' => true,
            'supports' => array(
                'title',
                'editor',
                'page-attributes',
                'excerpt',
                'thumbnail'
            ), // Go to Dashboard Custom HTML5 Blank post for supports
            'can_export' => true, // Allows export in Tools > Export
            'taxonomies' => array(
                'post_tag',
                'category'
            ), // Add Category and Post Tags support
            'menu_icon'           => 'dashicons-testimonial'
        ));
}

function create_post_type_portfolio()
{
    register_taxonomy_for_object_type('category', 'portfolio'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'portfolio');
    register_post_type('portfolio', // Register Custom Post Type
        array(
            'labels' => array(
                'name' => __('Portfolio', 'portfolio'), // Rename these to suit
                'singular_name' => __('Case Study', 'case-study'),
                'add_new' => __('Add New', 'case-study'),
                'add_new_item' => __('Add New Portfolio Case Study', 'case-study'),
                'edit' => __('Edit', 'case-study'),
                'edit_item' => __('Edit Case Study Posts', 'case-study'),
                'new_item' => __('New Case Study Posts', 'case-study'),
                'view' => __('View Case Study Posts', 'case-study'),
                'view_item' => __('View Case Study Posts', 'case-study'),
                'search_items' => __('Search Case Study Posts', 'case-study'),
                'not_found' => __('No Case Study Posts found', 'case-study'),
                'not_found_in_trash' => __('No Case Study Posts found in Trash', 'case-study')
            ),
            'exclude_from_search' => false,
            'public' => true,
            'hierarchical' => false, // Allows your posts to behave like Hierarchy Pages
            'has_archive' => true,
            'supports' => array(
                'title',
                'editor',
                'page-attributes',
                'excerpt',
                'thumbnail'
            ), // Go to Dashboard Custom HTML5 Blank post for supports
            'can_export' => true, // Allows export in Tools > Export
            'taxonomies' => array(
                'post_tag',
                'category'
            ), // Add Category and Post Tags support
            'rewrite' => array(
                'slug' => 'case-study',
                'with_front' => false
            ),  // Changes the slug / permalink to case-study instead of portfolio
            'menu_icon'           => 'dashicons-format-gallery'
        ));
}


/*------------------------------------*\
	ShortCode Functions
\*------------------------------------*/

// This shord code is for the bottom Call To Action area. Example:
// [bottomCTA  text="Let's meet in person." color="#2d8fce"]
function bottomCTA( $atts ) {
    $output = '';
    $pull_quote_atts = shortcode_atts( array(
        'text' => 'Want to start a conversation?',
        'color' => 'orange',
    ), $atts );
    $textContent = $pull_quote_atts[ 'text' ];
    $color = $pull_quote_atts[ 'color' ];

    if ($color == 'orange'){
        $color = "#de5326";
    } else if ($color == 'green'){
        $color = "#8fac3d";
    }
    $output .= '<div class="bottomCTA" style="background-color:'.$color.'">';
    $output .= '<div class="bottomCTAText">'. $textContent .'</div>';
    $output .= '<div class="bottomButtonCTA"><a class="buttonWhite" href="/contact/">Contact KCD PR</a></div>';
    $output .= '</div>';
    return $output;
}
// The shortcode is activated somewhere else in this doc, here is what it looks like:
// add_shortcode('bottomCTA', 'bottomCTA');



?>
