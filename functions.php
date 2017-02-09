<?php
/*
 *  Author: Todd Motto | @toddmotto
 *  URL: html5blank.com | @html5blank
 *  Custom functions, support, custom post types and more.
 */

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
    add_image_size('s150', 150, 150, true);
    add_image_size('s200', 200, 200, true);
    add_image_size('s300', 300, 300, true);
    add_image_size('s400', 400, 400, true);
    add_image_size('sL1200', 1200, '', true);
    add_image_size('sL1500', 1500, '', true);
    add_image_size('sL2000', 2000, '', true);

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// Load HTML5 Blank scripts (header.php)
function html5blank_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

        wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1'); // Modernizr
        wp_enqueue_script('modernizr'); // Enqueue it!
        
       wp_register_script('scrollreveal', get_template_directory_uri() . '/js/lib/scrollreveal.min.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('scrollreveal'); // Enqueue it!
        
        wp_register_script('tweenMax', get_template_directory_uri() . '/js/lib/TweenMax.min.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('tweenMax'); // Enqueue it!        

        wp_register_script('myscripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('myscripts'); // Enqueue it!
        
        wp_register_script('lightbox', get_template_directory_uri() . '/js/lib/jquery.swipebox.min.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('lightbox'); // Enqueue it!
        wp_register_script('scriptlightbox', get_template_directory_uri() . '/js/scriptLightbox.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('scriptlightbox'); // Enqueue it!
    }
}


function html5blank_conditional_scripts()
{
    if (is_page_template('template_galerieLive.php')) {

    }
    
    if (is_page_template('template_home.php')) {
                wp_register_script('countdown', get_template_directory_uri() . '/js/lib/jquery.countdown.min.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('countdown'); // Enqueue it!
                wp_register_script('googlemap', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyD8agkTf4EVznJ-nWwaUyvn3ia11C3IhP4', '3.0.5', true); // Conditional script(s)
        wp_enqueue_script('googlemap'); // Enqueue it! 
                wp_register_script('script_gmap', get_template_directory_uri() . '/js/gmap.js', array('jquery'), '1.0.1', true); // Conditional script(s)
        wp_enqueue_script('script_gmap'); // Enqueue it!
    }
    
    if(is_page_template('template_mariage.php')){
        wp_register_script('googlemap', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyD8agkTf4EVznJ-nWwaUyvn3ia11C3IhP4', '3.0.5', true); // Conditional script(s)
        wp_enqueue_script('googlemap'); // Enqueue it!
		
        wp_register_script('script_gmap', get_template_directory_uri() . '/js/gmap.js', array('jquery'), '1.0.1', true); // Conditional script(s)
        wp_enqueue_script('script_gmap'); // Enqueue it!
    }
    
    if(is_page_template('template_formReponse.php')){
        
        wp_register_script('tagsinput', get_template_directory_uri() .'/js/lib/jquery.tagsinput.min.js', '3.0.5', true); // Conditional script(s)
        wp_enqueue_script('tagsinput'); // Enqueue it!
        
        wp_register_script('scriptForm', get_template_directory_uri() .'/js/formReponse.js', '3.0.5', true); // Conditional script(s)
        wp_enqueue_script('scriptForm'); // Enqueue it!
    }
}

// Load HTML5 Blank styles
function html5blank_styles()
{
    wp_register_style('html5blank', get_template_directory_uri() . '/style.php', array(), '1.0', 'all');
    wp_enqueue_style('html5blank'); // Enqueue it!
}

// Register HTML5 Blank Navigation
function register_html5_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'html5blank'), // Main Navigation
        'sidebar-menu' => __('Sidebar Menu', 'html5blank'), // Sidebar Navigation
        'extra-menu' => __('Extra Menu', 'html5blank') // Extra Navigation if needed (duplicate as many as you need!)
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
        'name' => __('Widget Area 1', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Widget Area 2', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
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
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function html5blankgravatar ($avatar_defaults)
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
function html5blankcomments($comment, $args, $depth)
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
    <<?php echo $tag ?>
        <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-
            <?php comment_ID() ?>">
                <?php if ( 'div' != $args['style'] ) : ?>
                    <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
                        <?php endif; ?>
                            <div class="comment-author vcard">
                                <?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?> </div>
                            <?php if ($comment->comment_approved == '0') : ?> <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
                                <br />
                                <?php endif; ?>
                                    <div class="comment-meta commentmetadata">
                                        <?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?>
                                    </div>
                                    <div class="wrapperCommentSingle">
                                        <?php comment_text() ?>
                                            <div class="reply">
                                                <?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                                            </div>
                                    </div>
                                    <?php if ( 'div' != $args['style'] ) : ?>
                    </div>
                    <?php endif; ?>
                        <?php }

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'html5blank_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'html5blank_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'html5blank_styles'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
add_action('init', 'create_post_type_html5'); // Add our HTML5 Blank Custom Post Type
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
add_filter('avatar_defaults', 'html5blankgravatar'); // Custom Gravatar in Settings > Discussion
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
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode('html5_shortcode_demo', 'html5_shortcode_demo'); // You can place [html5_shortcode_demo] in Pages, Posts now.
add_shortcode('html5_shortcode_demo_2', 'html5_shortcode_demo_2'); // Place [html5_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [html5_shortcode_demo] [html5_shortcode_demo_2] Here's the page title! [/html5_shortcode_demo_2] [/html5_shortcode_demo]

/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/

function create_post_type_html5()
{
    
    if(function_exists('acf_add_options_page')){
        
    // Histoire couple    
    register_post_type('histoire', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Notre histoire', 'bjamour'), // Rename these to suit
            'singular_name' => __('Anecdote', 'bjamour'),
            'add_new' => __('Ajouter une anecdote', 'bjamour'),
            'add_new_item' => __('Ajouter une anecdote', 'bjamour'),
            'edit' => __('Éditer', 'bjamour'),
            'edit_item' => __('Éditer une anecdote', 'bjamour'),
            'new_item' => __('Nouvelle étape', 'bjamour'),
            'view_item' => __('Voir l\'étape', 'bjamour')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'page-attributes'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
		'menu_icon' => 'dashicons-heart',
        'menu_position' => 10
    ));
        
    // Déroulement    
    register_post_type('deroulement', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Déroulement', 'bjamour'), // Rename these to suit
            'singular_name' => __('Déroulement', 'bjamour'),
            'add_new' => __('Ajouter une étape', 'bjamour'),
            'add_new_item' => __('Ajouter une étape', 'bjamour'),
            'edit' => __('Éditer une étape', 'bjamour'),
            'edit_item' => __('Éditer une étape', 'bjamour'),
            'new_item' => __('Nouvelle étape', 'bjamour'),
            'view_item' => __('Voir l\'étape', 'bjamour')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'page-attributes'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
		'menu_icon' => 'dashicons-clock',
        'menu_position' => 10
    ));
        
    // Témoins
    register_post_type('temoins', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Nos témoins', 'bjamour'), // Rename these to suit
            'singular_name' => __('Témoin', 'bjamour'),
            'add_new' => __('Ajouter un témoin', 'bjamour'),
            'add_new_item' => __('Ajouter un témoin', 'bjamour'),
            'edit' => __('Éditer', 'bjamour'),
            'edit_item' => __('Éditer un témoin', 'bjamour'),
            'new_item' => __('Nouveau témoin', 'bjamour'),
            'view_item' => __('Voir le témoin', 'bjamour')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
		'menu_icon' => 'dashicons-groups',
        'menu_position' => 10
    ));
        
    //Wishlist
    if(get_field('pack_achete', 'option') == "pack3"):
    
    register_post_type('wishlist', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Liste cadeaux', 'bjamour'), // Rename these to suit
            'singular_name' => __('Liste cadeaux', 'bjamour'),
            'add_new' => __('Ajouter un cadeau', 'bjamour'),
            'add_new_item' => __('Ajouter un cadeau', 'bjamour'),
            'edit' => __('Éditer un cadeau', 'bjamour'),
            'edit_item' => __('Éditer un cadeau', 'bjamour'),
            'new_item' => __('Nouveau cadeau', 'bjamour'),
            'view_item' => __('Voir le cadeau', 'bjamour')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
		'menu_icon' => 'dashicons-cart',
        'menu_position' => 10
    ));
    
    endif;
        
    
    
    //Covoiturage
    if(get_field('pack_achete', 'option') == "pack3"):
    
    register_post_type('covoiturage', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Covoiturage', 'bjamour'), // Rename these to suit
            'singular_name' => __('Covoiturage', 'bjamour'),
            'add_new' => __('Ajouter un trajet', 'bjamour'),
            'add_new_item' => __('Ajouter un trajet', 'bjamour'),
            'edit' => __('Éditer un trajet', 'bjamour'),
            'edit_item' => __('Éditer le trajet', 'bjamour'),
            'new_item' => __('Nouveau trajet', 'bjamour'),
            'view_item' => __('Voir le trajet', 'bjamour')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
		'menu_icon' => 'dashicons-location-alt',
        'menu_position' => 10
    ));
    
    endif;
    
    
    // Liste Hôtels    
    register_post_type('hotels', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Hôtels', 'bjamour'), // Rename these to suit
            'singular_name' => __('Hôtel', 'bjamour'),
            'add_new' => __('Ajouter un hôtel', 'bjamour'),
            'add_new_item' => __('Ajouter un hôtel', 'bjamour'),
            'edit' => __('Éditer', 'bjamour'),
            'edit_item' => __('Éditer un hôtel', 'bjamour'),
            'new_item' => __('Nouvel hôtel', 'bjamour'),
            'view_item' => __('Voir l\'hôtel', 'bjamour')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
		'menu_icon' => 'dashicons-store',
        'menu_position' => 10
    ));
        
    // Photos officielles
    
    register_post_type('photos_officielles', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Photos officielles', 'bjamour'), // Rename these to suit
            'singular_name' => __('Photos officielles', 'bjamour'),
            'add_new' => __('Ajouter un album', 'bjamour'),
            'add_new_item' => __('Ajouter un album', 'bjamour'),
            'edit' => __('Éditer', 'bjamour'),
            'edit_item' => __('Éditer un album', 'bjamour'),
            'new_item' => __('Nouvel album', 'bjamour'),
            'view_item' => __('Voir l\'album', 'bjamour')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'page-attributes'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
		'menu_icon' => 'dashicons-format-gallery',
        'menu_position' => 10
    ));

        
    //Partie Live pas pour les packs 1
    if(get_field('pack_achete', 'option') == "pack2" OR get_field('pack_achete', 'option') == "pack3"):
    
    register_post_type('live', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Photos Live !', 'bjamour'), // Rename these to suit
            'singular_name' => __('Live', 'bjamour'),
            'add_new' => __('Ajouter une publication', 'bjamour'),
            'add_new_item' => __('Ajouter une publication', 'bjamour'),
            'edit' => __('Éditer', 'bjamour'),
            'edit_item' => __('Éditer un live', 'bjamour'),
            'new_item' => __('Nouveau live', 'bjamour'),
            'view_item' => __('Voir le live', 'bjamour')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
		'menu_icon' => 'dashicons-format-image',
        'menu_position' => 10
    ));
    
    register_post_type('photos-invites', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Photos invités', 'bjamour'), // Rename these to suit
            'singular_name' => __('Photo invité', 'bjamour'),
            'add_new' => __('Ajouter', 'bjamour'),
            'add_new_item' => __('Ajouter une photo', 'bjamour'),
            'edit' => __('Éditer', 'bjamour'),
            'edit_item' => __('Éditer une photo', 'bjamour'),
            'new_item' => __('Nouvelle photo', 'bjamour'),
            'view_item' => __('Voir la photo', 'bjamour')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
		'menu_icon' => 'dashicons-format-image',
        'menu_position' => 10
    ));
    
    endif;
        
        
    //Liste invités
    
    register_post_type('invite', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Réponses invités', 'bjamour'), // Rename these to suit
            'singular_name' => __('Réponses invités', 'bjamour'),
            'add_new' => __('Ajouter', 'bjamour'),
            'add_new_item' => __('Ajouter un invité', 'bjamour'),
            'edit' => __('Éditer', 'bjamour'),
            'edit_item' => __('Éditer un invité', 'bjamour'),
            'new_item' => __('Nouvel invité', 'bjamour'),
            'view_item' => __('Voir l\'invité', 'bjamour')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
		'menu_icon' => 'dashicons-forms',
        'menu_position' => 99
    ));

}}


/*------------------------------------*\
	ShortCode Functions
\*------------------------------------*/

// Shortcode Demo with Nested Capability
function html5_shortcode_demo($atts, $content = null)
{
    return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Shortcode Demo with simple <h2> tag
function html5_shortcode_demo_2($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
    return '<h2>' . $content . '</h2>';
}

if (!function_exists('ods_getTemplatePermalink')){
	function ods_getTemplatePermalink($template){
		$templates = get_pages(
			array(
				'hierarchical'=>0,
				'meta_key' => '_wp_page_template',
				'meta_value' => $template
			)
		);
		$template_id = $templates[0]->ID;
		return get_permalink($template_id);
    }
}

// Les pages d'options

if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page(array(
		'page_title' 	=> 'Administration',
		'menu_title'	=> 'Administration',
		'menu_slug' 	=> 'admin_bja',
		'capability'	=> 'edit_themes',
		'redirect'		=> false,
	));
	
	acf_add_options_page(array(
		'page_title' 	=> 'Vos options',
		'menu_title'	=> 'Vos options',
		'menu_slug' 	=> 'vos-options',
		'capability'	=> 'edit_posts',
		'redirect'		=> false,
	));	
}

//Autoriser les svg à l'upload

function allow_svg_mime_types( $mimes ){
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

add_filter( 'upload_mimes', 'allow_svg_mime_types' ); // Autoriser les svg

//Export liste d'invités depuis l'admin

if (!function_exists('bjAmr_admin_menu')){
	function bjAmr_admin_menu(){
        add_submenu_page('edit.php?post_type=invite', __('Exporter la liste', 'bjAmr'), __('Exporter la liste', 'bjAmr'), 'edit_posts', 'bjAmr_export', 'bjAmr_export');
        add_submenu_page('edit.php?post_type=live', __('Télécharger les photos', 'bjAmr'), __('Télécharger les photos', 'bjAmr'), 'edit_posts', 'bjAmr_live', 'bjAmr_live');
	}
}
add_action('admin_menu', 'bjAmr_admin_menu');

if (!function_exists('bjAmr_export')){
	function bjAmr_export(){
		if (!current_user_can('edit_posts')) {
			wp_die(__('You do not have sufficient permissions to access this page.'));
		}
       	include 'exportInvites.php';
    }
}

//Export photos lives

if (!function_exists('bjAmr_live')){
	function bjAmr_live(){
		if (!current_user_can('edit_posts')) {
			wp_die(__('You do not have sufficient permissions to access this page.'));
		}
       	include 'exportLive.php';
    }
}

//Envoi adresse email correct

add_filter( 'wp_mail_from', function() {
    return get_option('admin_email');
} );


// Sous page témoins

if(function_exists('acf_add_options_page'))
{
acf_add_options_page(array(
'page_title' 	=> 'Options page témoins',
'menu_title' 	=> 'Réglages fonctionnalité',
'menu_slug' 	=> 'options_temoins',
'capability' 	=> 'edit_posts', 
'parent_slug'	=> 'edit.php?post_type=temoins',
'position'	=> false,
'redirect'	=> false,
));
}

// Sous page hôtels

if(function_exists('acf_add_options_page'))
{
acf_add_options_page(array(
'page_title' 	=> 'Options page hôtel',
'menu_title' 	=> 'Réglages fonctionnalité',
'menu_slug' 	=> 'options_hotel',
'capability' 	=> 'edit_posts', 
'parent_slug'	=> 'edit.php?post_type=hotels',
'position'	=> false,
'redirect'	=> false,
));
}

// Sous page Live

if(function_exists('acf_add_options_page'))
{
acf_add_options_page(array(
'page_title' 	=> 'Options Live',
'menu_title' 	=> 'Réglages fonctionnalité',
'menu_slug' 	=> 'options_live',
'capability' 	=> 'edit_posts', 
'parent_slug'	=> 'edit.php?post_type=live',
'position'	=> false,
'redirect'	=> false,
));
}

// Sous page Photos invités

if(function_exists('acf_add_options_page'))
{
acf_add_options_page(array(
'page_title' 	=> 'Options photos invités',
'menu_title' 	=> 'Réglages fonctionnalité',
'menu_slug' 	=> 'options_invites',
'capability' 	=> 'edit_posts', 
'parent_slug'	=> 'edit.php?post_type=photos-invites',
'position'	=> false,
'redirect'	=> false,
));
}

// Sous page Histoire du couple

if(function_exists('acf_add_options_page'))
{
acf_add_options_page(array(
'page_title' 	=> 'Options histoire du couple',
'menu_title' 	=> 'Réglages fonctionnalité',
'menu_slug' 	=> 'options_histoire',
'capability' 	=> 'edit_posts', 
'parent_slug'	=> 'edit.php?post_type=histoire',
'position'	=> false,
'redirect'	=> false,
));
}

// Sous page Covoiturage

if(function_exists('acf_add_options_page'))
{
acf_add_options_page(array(
'page_title' 	=> 'Options covoiturage',
'menu_title' 	=> 'Réglages fonctionnalité',
'menu_slug' 	=> 'options_covoiturage',
'capability' 	=> 'edit_posts', 
'parent_slug'	=> 'edit.php?post_type=covoiturage',
'position'	=> false,
'redirect'	=> false,
));
}

// Sous page Wishlist

if(function_exists('acf_add_options_page'))
{
acf_add_options_page(array(
'page_title' 	=> 'Options wishlist',
'menu_title' 	=> 'Réglages fonctionnalité',
'menu_slug' 	=> 'options_wishlist',
'capability' 	=> 'edit_posts', 
'parent_slug'	=> 'edit.php?post_type=wishlist',
'position'	=> false,
'redirect'	=> false,
));
}

// Sous page Déroulement

if(function_exists('acf_add_options_page'))
{
acf_add_options_page(array(
'page_title' 	=> 'Options déroulement',
'menu_title' 	=> 'Réglages fonctionnalité',
'menu_slug' 	=> 'options_deroulement',
'capability' 	=> 'edit_posts', 
'parent_slug'	=> 'edit.php?post_type=deroulement',
'position'	=> false,
'redirect'	=> false,
));
}

// Comment form
	
function bja_disable_comment_url($fields) { 
    unset($fields['url']);
    return $fields;
}
add_filter('comment_form_default_fields','bja_disable_comment_url');


// Add covoiturage AJAX

function add_js_scripts() {
	wp_enqueue_script( 'covoiturage', get_template_directory_uri().'/js/covoiturage.js', array('jquery'), '1.0', true );

	// pass Ajax Url to script.js
	wp_localize_script('covoiturage', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
}

add_action('wp_enqueue_scripts', 'add_js_scripts');


add_action( 'wp_ajax_ajax_covoiturage', 'ajax_covoiturage' );
add_action( 'wp_ajax_nopriv_ajax_covoiturage', 'ajax_covoiturage' );


function ajax_covoiturage() {
    
	if(isset($_POST['nom']) && $_POST['nom'] != "" && isset($_POST['telephone']) && $_POST['telephone'] != "" && isset($_POST['email']) && $_POST['email'] != "" && isset($_POST['nombreDePlaces']) && $_POST['nombreDePlaces'] != "" && isset($_POST['villeDeDepart']) && $_POST['villeDeDepart'] != "" && isset($_POST['horaireDeDepart']) && $_POST['horaireDeDepart'] != ""){
    $name_correct = true;
    $name_covoit = $_POST['nom'];
    $phone_covoit = $_POST['telephone'];
    $email_covoit = $_POST['email'];
    $place_covoit = $_POST['nombreDePlaces'];
    $depart_covoit = $_POST['villeDeDepart'];
    $via_covoit = $_POST['arretsPossible'];
    $DateDepart_covoit = $_POST['horaireDeDepart'];
    $DateRetour_covoit = $_POST['horaireDeRetour'];
        
    }


if($name_correct == true){
    
    $postArgs = array(
        'post_title' => $name_covoit,
        'post_type' => 'covoiturage',
        'post_status' => 'publish',
    ); 
    
    $id = wp_insert_post($postArgs);    

    update_field('nom', $name_covoit, $id);
    update_field('telephone', $phone_covoit, $id);
    update_field('email', $email_covoit, $id);
    update_field('nombre_de_places', $place_covoit, $id);
    update_field('ville_de_depart', $depart_covoit, $id);
    update_field('arrêts_possible', $via_covoit, $id);
    update_field('horaire_de_depart', $DateDepart_covoit, $id);
    update_field('horaire_de_retour', $DateRetour_covoit, $id);
    
    $reponse = 'success';
    
    $ligne = '<tr class="new_covoit"><td><p>'.$depart_covoit.'</p><p>'.$via_covoit.'</p></td>
                <td><p>'.$DateDepart_covoit.'</p><p>'.$dateRetour_covoit.'</p></td>
                <td class="nbPlaces"><p>'.$place_covoit.'</p></td>
                <td><p>'.$name_covoit.'</p><p><a href="tel:'.str_replace(" ","",$phone_covoit).'">'.$phone_covoit.'</a> / <a href="mailto:'.$email_covoit.'">'.$email_covoit.'</a></p></td>
            </tr>';
    
    echo json_encode(array(
        'reponse'=>$reponse,
		'nom'=>$name_covoit,
		'telephone'=>$phone_covoit,
		'email'=>$email_covoit,
		'nombre_de_places'=>$place_covoit,
		'ville_de_depart'=>$depart_covoit,
		'arrets_possible'=>$via_covoit,
		'horaire_de_depart'=>$DateDepart_covoit,
		'horaire_de_retour'=>$DateRetour_covoit,
		'inser_table'=>$ligne
	));
   
    //Envoi de l'email
    
    //Récup le nom des mariés
    $maries = get_field('maries', 'option'); 
    
    require('inc/covoiturage_key.php');
    
    function encrypt( $string ) {
      $algorithm = 'rijndael-128'; // You can use any of the available
      $key = md5($covoiturageKey, true );
      $iv_length = mcrypt_get_iv_size( $algorithm, MCRYPT_MODE_CBC );
      $iv = mcrypt_create_iv( $iv_length, MCRYPT_RAND );
      $encrypted = mcrypt_encrypt( $algorithm, $key, $string, MCRYPT_MODE_CBC, $iv );
      $result = base64_encode( $iv . $encrypted );
      return $result;
    }
    
    $id = encrypt($id);
    $id = urlencode($id);
    
    // Design de l'email
    
    require('emails/template_email.php');
    
    $message_confirmation = '<p>Votre covoiturage a bien été posté. Voici un récapitulatif des éléments que vous avez saisi. Ces informations ne sont pas conservés par Bonjour Amour.</p><p><strong>Votre nom</strong> : '.$name_covoit.'</p><p><strong>Numéro de téléphone</strong> : '.$phone_covoit.'</p><p><strong>Email</strong> : '.$email_covoit.'</p><p><strong>Nombre de places</strong> : '.$place_covoit.'</p><p><strong>Ville de départ</strong> : '.$depart_covoit.'</p><p><strong>Arrêts possible</strong> : '.$via_covoit.'</p><p><strong>Date de départ</strong> : '.$DateDepart_covoit.'</p>
    <p><strong>Date de retour</strong> : '.$DateRetour_covoit.'</p><p><strong>Une fois votre voiture remplie ou si vous changez d\'avis, vous pouvez supprimer cette annonce en cliquant sur ce lien :</p><p><a href="'.site_url().'/validation/?type=covoiturage&id='.$id.'">Supprimer mon covoiturage</a></p>';
    
    $email_title = "Mariage de ".$maries[0]['prenom']." et ".$maries[1]['prenom']." : votre covoiturage";
    $email_html = bja_email($message_confirmation);
    $headers = array('Content-Type: text/html; charset=UTF-8;');
    
    wp_mail( $email_covoit, $email_title, $email_html, $headers);
    
    
}else{
    $reponse = "error";
    
    echo json_encode(array(
        'reponse' => $reponse
    ));
}

	die();
}


// Rechercher ville covoiturage AJAX

function add_js2_scripts() {
	wp_enqueue_script( 'covoiturage_search', get_template_directory_uri().'/js/covoiturage_search.js', array('jquery'), '1.0', true );

	// pass Ajax Url to script.js
	wp_localize_script('covoiturage_search', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
}

add_action('wp_enqueue_scripts', 'add_js2_scripts');
add_action( 'wp_ajax_ajax_covoiturage_search', 'ajax_covoiturage_search' );
add_action( 'wp_ajax_nopriv_ajax_covoiturage_search', 'ajax_covoiturage_search' );


function ajax_covoiturage_search() {
    
    if(isset($_POST['keyword'])){
        
        $keyword = $_POST['keyword']; 
    
        $argsPosts = array(
            'post_type'		=> 'covoiturage',
            'posts_per_page' => -1,
            'meta_query' => array(
                'relation' => 'AND',
                'meta_query' => array(
                    'relation' => 'OR',
                    array(
                        'key' => "ville_de_depart",
                        'value' => $keyword,
                        'compare' => 'LIKE'
                    ),
                    array(
                        'key' => "arrêts_possible",
                        'value' => $keyword,
                        'compare' => 'LIKE'
                    ),
                )
                
            ),
        ); 

        $queryPosts = new WP_Query( $argsPosts );

        if( $queryPosts->have_posts() ){
        
            $results = array();

            while( $queryPosts->have_posts() ) : $queryPosts->the_post();

                array_push($results, get_the_ID());

            endwhile;

            echo json_encode(array(
                'results'=>$results,
                'resultats'=> "oui"
            )
            );
        }else{
            echo json_encode(array(
                'resultats'=> "non",
                'message'=>'Aucun covoiturage pour '.$keyword)
            );
        }
    }

	die();
    
}


//
// AJAX réservation cadeau 
 //


function add_js3_scripts() {
	wp_enqueue_script( 'wishlist', get_template_directory_uri().'/js/resa_wishlist.js', array('jquery'), '1.0', true );

	// pass Ajax Url to script.js
	wp_localize_script('wishlist', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
}

add_action('wp_enqueue_scripts', 'add_js3_scripts');

add_action( 'wp_ajax_ajax_wishlist', 'ajax_wishlist' );
add_action( 'wp_ajax_nopriv_ajax_wishlist', 'ajax_wishlist' );


function ajax_wishlist() {
    
	if(isset($_POST['id_gift']) && $_POST['id_gift'] != "" && isset($_POST['email']) && $_POST['email'] != ""){
        $id_gift = $_POST['id_gift'];
        $name_gift = $_POST['name_gift'];
        $email = $_POST['email'];
        $good = true;
    }


if($good == true){
    
    update_field('etat_reservation', '1', $id_gift);
    
    $reponse = 'success';
    
    $ligne = 'truc à insérer';
    
    echo json_encode(array(
        'reponse'=>$reponse,
        'ligne' => $ligne,
		'id_gift'=>$id_gift,
		'name_gift'=>$name_gift,
		'email'=>$email        
	));
   
    //Envoi de l'email
    
    //Récup le nom des mariés
    $maries = get_field('maries', 'option'); 
    
    include('inc/covoiturage_key.php');
    
    function encrypt( $string ) {
      $algorithm = 'rijndael-128';
      $key = md5($covoiturageKey, true );
      $iv_length = mcrypt_get_iv_size( $algorithm, MCRYPT_MODE_CBC );
      $iv = mcrypt_create_iv( $iv_length, MCRYPT_RAND );
      $encrypted = mcrypt_encrypt( $algorithm, $key, $string, MCRYPT_MODE_CBC, $iv );
      $result = base64_encode( $iv . $encrypted );
      return $result;
    }
    
    $id_gift_encrypt = encrypt($id_gift);
    $id_gift_url= urlencode($id_gift_encrypt);
    
    // Design de l'email
    
    include('emails/template_email.php');
    
    $message_confirmation = '<p>Votre réservation pour le cadeau '.$name_gift.' a bien été pris en compte.</p>
    <p> Si vous sous souhaitez annuler la réservation, merci de suivre ce lien :</p>
    <p><a href="'.site_url().'/validation/?type=gift&id='.$id_gift_url.'">Annuler ma réservation</a></p>';
    
    $email_title = "Mariage de ".$maries[0]['prenom']." et ".$maries[1]['prenom']." : votre réservation de ".$name_gift;
    $email_html = bja_email($message_confirmation);
    $headers = array('Content-Type: text/html; charset=UTF-8;');
    
    wp_mail( $email, $email_title, $email_html, $headers);
    
    
}else{
    $reponse = "error";
    
    echo json_encode(array(
        'reponse' => $reponse
    ));
}

	die();
}


// Google map api

function my_acf_init() {
	
	acf_update_setting('google_api_key', 'AIzaSyD8agkTf4EVznJ-nWwaUyvn3ia11C3IhP4');
}

add_action('acf/init', 'my_acf_init');


//Supprimer des parties de l'admin

function custom_menu_page_removing() {
    //Virer tout ce qui est Actus pour les Packs 1
    if(function_exists('acf_add_options_page'))
    {
    if(get_field('pack_achete', 'option') == "pack1"):
     remove_menu_page( 'edit.php' );
     remove_menu_page( 'edit-comments.php' );
    endif;
    }
    
    $user = wp_get_current_user();
        if ( in_array( 'editor', (array) $user->roles ) ) {
        remove_menu_page( 'tools.php' );
        remove_menu_page( 'index.php' );
        remove_menu_page( 'upload.php' );
        remove_menu_page( 'admin.php' );
    }   
    
}

add_action( 'admin_menu', 'custom_menu_page_removing' );

//Remove du dashboard

function remove_dashboard_widgets() {
	global $wp_meta_boxes;

	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
//	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
//	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
//	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
//	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);

}

add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );

//Admin bar

function remove_admin_bar_links() {
	global $wp_admin_bar;
        $user = wp_get_current_user();
        if ( in_array( 'editor', (array) $user->roles ) ) {
	$wp_admin_bar->remove_menu('new-content');
	$wp_admin_bar->remove_menu('wp-logo');
	$wp_admin_bar->remove_menu('my-sites');
        }
}

add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );

// Add links custom bar

add_action('admin_bar_menu', 'add_toolbar_items', 1000);

function add_toolbar_items($admin_bar){ 
    $admin_bar->add_menu( array( 
        'id' => 'bja-guide',
        'title' => 'Consulter les guides Bonjour Amour',
        'href' => 'http://bonjouramour.fr/guides',
        'meta' => array(
            'title' => __('Voir les guides Bonjour Amour'), 
            'target' => '_blank',
        ),
    )
    );
}

// URL logo login

add_filter( 'login_headerurl', 'custom_loginlogo_url' );
function custom_loginlogo_url($url) {
	return 'http://bonjouramour.fr';
}

// Custom gallery

add_filter( 'post_gallery', 'my_post_gallery', 10, 2 );
function my_post_gallery( $output, $attr) {
    global $post, $wp_locale;

    static $instance = 0;
    $instance++;

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }

    extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post->ID,
        'itemtag'    => 'dl',
        'icontag'    => 'dt',
        'captiontag' => 'dd',
        'columns'    => 3,
        'size'       => 's400',
        'include'    => '',
        'exclude'    => ''
    ), $attr));

    $id = intval($id);
    if ( 'RAND' == $order )
        $orderby = 'none';

    if ( !empty($include) ) {
        $include = preg_replace( '/[^0-9,]+/', '', $include );
        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( !empty($exclude) ) {
        $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }

    if ( empty($attachments) )
        return '';

    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
        return $output;
    }

    $itemtag = tag_escape($itemtag);
    $captiontag = tag_escape($captiontag);
    $columns = intval($columns);
    $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
    $float = is_rtl() ? 'right' : 'left';

    $selector = "gallery-{$instance}";

    $output = apply_filters('gallery_style', "
        <style type='text/css'>
            #{$selector} {
                margin: auto;
            }
            #{$selector} .gallery-item {
                float: {$float};
                text-align: center;
                width: {$itemwidth}%;           }
            #{$selector} img {
            }
            #{$selector} .gallery-caption {
                margin-left: 0;
            }
        </style>
        <!-- see gallery_shortcode() in wp-includes/media.php -->
        <div id='$selector' class='gallery galleryid-{$id}'>");

    $i = 0;
    foreach ( $attachments as $id => $attachment ) {
        $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);

        $output .= "<{$itemtag} class='gallery-item'>";
        $output .= "
            <{$icontag} class='gallery-icon'>
                $link
            </{$icontag}>";
        if ( $captiontag && trim($attachment->post_excerpt) ) {
            $output .= "
                <{$captiontag} class='gallery-caption'>
                " . wptexturize($attachment->post_excerpt) . "
                </{$captiontag}>";
        }
        $output .= "</{$itemtag}>";
        if ( $columns > 0 && ++$i % $columns == 0 )
            $output .= '<br style="clear: both" />';
    }

    $output .= "
            <br style='clear: both;' />
        </div>\n";

    return $output;
}

//Custom WYSIWYG

function myplugin_tinymce_buttons( $buttons ) {
	//Remove the format dropdown select and text color selector
	$remove = array( 'alignleft', 'alignright', 'aligncenter', 'numlist', 'wp_more' );

	return array_diff( $buttons, $remove );
 }
add_filter( 'mce_buttons', 'myplugin_tinymce_buttons' );

function myplugin_tinymce_buttons2( $buttons ) {
	//Remove the format dropdown select and text color selector
	$remove = array( 'forecolor', 'hr', 'outdent', 'indent' );

	return array_diff( $buttons, $remove );
 }
add_filter( 'mce_buttons_2', 'myplugin_tinymce_buttons2' );

?>