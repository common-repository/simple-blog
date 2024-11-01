<?php
/*
Plugin Name: Simple Blog
Plugin URI: #
Description: Declares a plugin that will create a custom post type displaying Blogs.
Version: 1.0
Author: vikashsrivastava1111989
Author URI: #
License: GPLv3
*/
?>
<?php

$siteurl = get_option('siteurl');
add_action( 'admin_enqueue_scripts', 'sb_wpvs_add_my_stylesheet' );
    function sb_wpvs_add_my_stylesheet() {
        // Respects SSL, Style.css is relative to the current file
        wp_register_style( 'wpvs-style', plugins_url('/css/simple-blog.css', __FILE__) );//updated on 
        wp_enqueue_style( 'wpvs-style' );
		wp_register_style( 'wpvs-pickme', plugins_url('/css/simple-pickme.css', __FILE__));//updated on 
        wp_enqueue_style( 'wpvs-pickme' );
		//wp_register_style( 'wpvs-boot', ''.$plugin_url.'/simpleBlog/simple-blog-css/bootstrap.css' );//updated on 
        //wp_enqueue_style( 'wpvs-boot' );
		wp_register_style( 'wpvs-tem-style',  plugins_url('/simpleBlog/simple-blog-css/style.css', __FILE__));//updated on 
        wp_enqueue_style( 'wpvs-tem-style' );
    }
	sb_wpvs_add_my_stylesheet();
//wp_enqueue_script("jquery");

add_action( 'admin_enqueue_scripts', 'sb_wpvs_scripts_method_pickme' ); // wp_enqueue_scripts action hook to link only on the front-end
function sb_wpvs_scripts_method_pickme() {
 wp_enqueue_script('simple-pickme', plugins_url('/js/simple-pickme.js', __FILE__) , array('jquery'), '', true );
 wp_enqueue_script('simple-pickme-actv',  plugins_url('/js/simple-pickme-actv.js', __FILE__) , '', true );
 //wp_enqueue_script('simple-bootstrap', $plugin_url. '/simpleBlog/simple-blog-js/bootstrap.min.js', array('jquery'), '', true );
 
}

wp_enqueue_script("jquery");

add_action( 'init', 'sb_create_blog_section' );
function sb_create_blog_section() {
    register_post_type( 'Blog',
        array(
            'labels' => array(
                'name' => 'Blog',
                'singular_name' => 'Blog',
                'add_new' => 'Add New Blog Post',
                'add_new_item' => 'Add New Blog',
                'edit' => 'Edit',
                'edit_item' => 'Edit Blog',
                'new_item' => 'New Blog',
                'view' => 'View',
                'view_item' => 'View Blog',
                'search_items' => 'Search Blog',
                'not_found' => 'No Blog found',
                'not_found_in_trash' => 'No Blog found in Trash',
                'parent' => 'Parent Blog'
            ),
 
            'public' => true,
            'menu_position' => 15,
            'supports' => array( 'title', 'comments' , 'editor' , 'thumbnail'),
			//'menu_icon' => plugins_url( 'images/image.png', __FILE__ ),
            'has_archive' => true
        )
    );
}

add_action( 'init', 'sb_create_blog_taxonomies', 0 );
function sb_create_blog_taxonomies() {
	$labels = array(
		'name'              => _x( 'All Blogs Categories', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Blog Category', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Blogs Category', 'textdomain' ),
		'all_items'         => __( 'All Blogs Category', 'textdomain' ),
		'parent_item'       => __( 'Parent Blog Category', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Blog Category:', 'textdomain' ),
		'edit_item'         => __( 'Edit Blog Category', 'textdomain' ),
		'update_item'       => __( 'Update Blog Category', 'textdomain' ),
		'add_new_item'      => __( 'Add New Blog Category', 'textdomain' ),
		'new_item_name'     => __( 'New Blog Name', 'textdomain' ),
		'menu_name'         => __( 'Blog Category', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'all-blog' ),
	);

register_taxonomy( 'all-blog', array( 'blog' ), $args );
}
function sb_blog_add_meta_boxes( $post ){
	add_meta_box( 'blog_meta_box', __( 'Blog Details', 'blog_details' ), 'sb_blog_build_meta_box', 'blog', 'normal' , 'high' );
}
add_action( 'add_meta_boxes_blog', 'sb_blog_add_meta_boxes' );
function sb_blog_build_meta_box( $post ){
	// our code here
	wp_nonce_field( basename( __FILE__ ), 'blog_meta_box_nonce' );
	 $editor1 = get_post_meta( $post->ID, '_simple_short_content', true);
	 $author  = get_post_meta( $post->ID, '_simple_author', true);
	 $publishYearCal  = get_post_meta( $post->ID, '_simple_pub_cal', true);
	 $simple_pub_cal_man  = get_post_meta( $post->ID, '_simple_pub_cal_man', true);
		echo '<p class="simple_blog_label"><label for="simple-blog-content">Blog Short Content Box</label>Please Enter short content for the Blog</p>';
		echo wp_editor( $editor1, 'simple_short_content', array( 'textarea_name' => 'simple_short_content' ) );
		echo '<p class="simple_blog_label"><label for="simple-blog-author">Blog Author Box</label>Please enter author for the Blog</p>';
		echo '<input type="text" id="simple_author" placeholder="Please enter Author Name" name="simple_author" style="width:100%;" value="'.$author.'"/>';
		echo '<p class="simple_blog_label"><label for="simple-blog-calDate">Blog Publish Date</label>Please select Publish Date from calander for the Blog</p>';
		echo '<input type="text" placeholder="dd-mm-yyyy" id="simple_pub_cal" name="simple_pub_cal" value="'.$publishYearCal.'" readonly/>';
		echo '<p class="simple_blog_label"><label for="simple-blog-calDateManual_or"></label><h4 style="text-align:center;">OR</h4></p>';
		echo '<p class="simple_blog_label"><label for="simple-blog-calDateManual"></label>Please enter Publish Date <i>Manually</i> for the Blog</p>';
		echo '<input type="text" placeholder="dd-mm-yyyy" id="simple_pub_cal_man" name="simple_pub_cal_man" value="'.$simple_pub_cal_man.'"/>';
	}
function sb_blog_save_meta_box_data( $post_id ){
	// verify taxonomies meta box nonce
	
	if ( !isset( $_POST['blog_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['blog_meta_box_nonce'], basename( __FILE__ ) ) ){
		
		return;
	}
	// return if autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
		return;
	}
	// Check the user's permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ){
		return;
	}
	// store custom fields values
	if( isset( $_POST['simple_short_content'] ) ){
		$simple_short_content = $_POST['simple_short_content'];
		// sinitize array
		$simple_short_content = sanitize_text_field( $_POST['simple_short_content'] ) ;
		
		$simple_author = $_POST['simple_author'];
		// sinitize array
		$simple_author = sanitize_text_field( $_POST['simple_author'] ) ;
		
		$simple_pub_cal = $_POST['simple_pub_cal'];
		// sinitize array
		$simple_pub_cal = sanitize_text_field( $_POST['simple_pub_cal'] ) ;
		
		$simple_pub_cal_man = $_POST['simple_pub_cal_man'];
		// sinitize array
		$simple_pub_cal_man = sanitize_text_field( $_POST['simple_pub_cal_man'] ) ;

		
		// save data
		update_post_meta( $post_id, '_simple_short_content', $simple_short_content );
		update_post_meta( $post_id, '_simple_author', $simple_author );
		update_post_meta( $post_id, '_simple_pub_cal', $simple_pub_cal );
		update_post_meta( $post_id, '_simple_pub_cal_man', $simple_pub_cal_man );
	}else{
		// delete data
		delete_post_meta( $post_id, '_simple_short_content' );
		delete_post_meta( $post_id, '_simple_author' );
		delete_post_meta( $post_id, '_simple_pub_cal' );
		delete_post_meta( $post_id, '_simple_pub_cal_man' );
	}
}
add_action( 'save_post_blog', 'sb_blog_save_meta_box_data' , 10 ,2 );

add_action( 'add_meta_boxes', 'sb_listing_image_add_metabox_750_350' );
function sb_listing_image_add_metabox_750_350 () {
	add_meta_box( 'listingimagediv750_350', __( 'Blog Image Section for 750px*350px', 'text-domain' ), 'sb_listing_image_metabox_750_350', 'blog', 'normal', 'low');
}
function sb_listing_image_metabox_750_350 ( $post ) {
	global $content_width, $_wp_additional_image_sizes;
	$image_id = get_post_meta( $post->ID, '_listing_image_id_750_350', true );
	$old_content_width = $content_width;
	$content_width = 254;
	if ( $image_id && get_post( $image_id ) ) {
		if ( ! isset( $_wp_additional_image_sizes['post-thumbnail'] ) ) {
			$thumbnail_html = wp_get_attachment_image( $image_id, array( $content_width, $content_width ) );
		} else {
			$thumbnail_html = wp_get_attachment_image( $image_id, 'post-thumbnail' );
		}
		if ( ! empty( $thumbnail_html ) ) {
			$content = $thumbnail_html;
			$content .= '<p class="hide-if-no-js"><a href="javascript:;" id="remove_listing_image_button_750_350" >' . esc_html__( 'Remove Blog image of Resolution 750*350px', 'text-domain' ) . '</a></p>';
			$content .= '<input type="hidden" id="upload_listing_image_750_350" name="_listing_cover_image_750_350" value="' . esc_attr( $image_id ) . '" />';
		}
		$content_width = $old_content_width;
	} else {
		$content = '<img src="" style="width:' . esc_attr( $content_width ) . 'px;height:auto;border:0;display:none;" />';
		$content .= '<p class="hide-if-no-js"><a title="' . esc_attr__( 'Set Blog image [Resolution 750px*350px only]', 'text-domain' ) . '" href="javascript:;" id="upload_listing_image_button_750_350" id="set-listing-image-750-350" data-uploader_title="' . esc_attr__( 'Choose an Blog image of Resolution 750*350px', 'text-domain' ) . '" data-uploader_button_text="' . esc_attr__( 'Set Blog image of Resolution 750*350px', 'text-domain' ) . '">' . esc_html__( 'Set Blog image of Resolution 750*350px', 'text-domain' ) . '</a></p>';
		$content .= '<input type="hidden" id="upload_listing_image_750_350" name="_listing_cover_image_750_350" value="" />';
		
	}
	echo $content;
}
add_action( 'save_post', 'sb_listing_image_save_750_350', 10, 1 );
function sb_listing_image_save_750_350 ( $post_id ) {
	if( isset( $_POST['_listing_cover_image_750_350'] ) ) {
		$image_id = (int) $_POST['_listing_cover_image_750_350'];
		update_post_meta( $post_id, '_listing_image_id_750_350', $image_id );
	}
}

/*add_action( 'add_meta_boxes', 'sb_listing_image_add_metabox_350_250' );
function sb_listing_image_add_metabox_350_250 () {
	add_meta_box( 'listingimagediv350_250', __( 'Blog Image Section for 350px*250px', 'text-domain' ), 'sb_listing_image_metabox_350_250', 'blog', 'normal', 'low');
}
function sb_listing_image_metabox_350_250 ( $post ) {
	global $content_width, $_wp_additional_image_sizes;
	$image_id = get_post_meta( $post->ID, '_listing_image_id_350_250', true );
	$old_content_width = $content_width;
	$content_width = 254;
	if ( $image_id && get_post( $image_id ) ) {
		if ( ! isset( $_wp_additional_image_sizes['post-thumbnail'] ) ) {
			$thumbnail_html = wp_get_attachment_image( $image_id, array( $content_width, $content_width ) );
		} else {
			$thumbnail_html = wp_get_attachment_image( $image_id, 'post-thumbnail' );
		}
		if ( ! empty( $thumbnail_html ) ) {
			$content = $thumbnail_html;
			//350*250px
			$content .= '<p class="hide-if-no-js"><a href="javascript:;" id="remove_listing_image_button_350_250" >' . esc_html__( 'Remove Blog image of Resolution 350*250px', 'text-domain' ) . '</a></p>';
			$content .= '<input type="hidden" id="upload_listing_image_350_250" name="_listing_cover_image_350_250" value="' . esc_attr( $image_id ) . '" />';
			
		}
		$content_width = $old_content_width;
	} else {

		
		//350*250px
		$content = '<img src="" style="width:' . esc_attr( $content_width ) . 'px;height:auto;border:0;display:none;" />';
		$content .= '<p class="hide-if-no-js"><a title="' . esc_attr__( 'Set Blog image [Resolution 350px*250px only]', 'text-domain' ) . '" href="javascript:;" id="upload_listing_image_button_350_250" id="set-listing-image-350-250" data-uploader_title="' . esc_attr__( 'Choose an Blog image of Resolution 350*250px', 'text-domain' ) . '" data-uploader_button_text="' . esc_attr__( 'Set Blog image of Resolution 350*250px', 'text-domain' ) . '">' . esc_html__( 'Set Blog image of Resolution 350*250px', 'text-domain' ) . '</a></p>';
		$content .= '<input type="hidden" id="upload_listing_image_350_250" name="_listing_cover_image_350_250" value="" />';
		
		
	}
	echo $content;
}
add_action( 'save_post', 'sb_listing_image_save_350_250', 10, 1 );
function sb_listing_image_save_350_250 ( $post_id ) {
	if( isset( $_POST['_listing_cover_image_350_250'] ) ) {
		$image_id = (int) $_POST['_listing_cover_image_350_250'];
		update_post_meta( $post_id, '_listing_image_id_350_250', $image_id );
	}

}

add_action( 'add_meta_boxes', 'sb_listing_image_add_metabox_350_220' );
function sb_listing_image_add_metabox_350_220 () {
	add_meta_box( 'listingimagediv350_220', __( 'Blog Image Section for 350px*220px', 'text-domain' ), 'sb_listing_image_metabox_350_220', 'blog', 'normal', 'low');
}
function sb_listing_image_metabox_350_220 ( $post ) {
	global $content_width, $_wp_additional_image_sizes;
	$image_id = get_post_meta( $post->ID, '_listing_image_id_350_220', true );
	$old_content_width = $content_width;
	$content_width = 254;
	if ( $image_id && get_post( $image_id ) ) {
		if ( ! isset( $_wp_additional_image_sizes['post-thumbnail'] ) ) {
			$thumbnail_html = wp_get_attachment_image( $image_id, array( $content_width, $content_width ) );
		} else {
			$thumbnail_html = wp_get_attachment_image( $image_id, 'post-thumbnail' );
		}
		if ( ! empty( $thumbnail_html ) ) {
			$content = $thumbnail_html;
			//350*220px
			$content .= '<p class="hide-if-no-js"><a href="javascript:;" id="remove_listing_image_button_350_220" >' . esc_html__( 'Remove Blog image of Resolution 350*220px', 'text-domain' ) . '</a></p>';
			$content .= '<input type="hidden" id="upload_listing_image_350_220" name="_listing_cover_image_350_220" value="' . esc_attr( $image_id ) . '" />';
		}
		$content_width = $old_content_width;
	} else {

		
		//350*220px
		$content = '<img src="" style="width:' . esc_attr( $content_width ) . 'px;height:auto;border:0;display:none;" />';
		$content .= '<p class="hide-if-no-js"><a title="' . esc_attr__( 'Set Blog image [Resolution 350px*220px only]', 'text-domain' ) . '" href="javascript:;" id="upload_listing_image_button_350_220" id="set-listing-image-350-220" data-uploader_title="' . esc_attr__( 'Choose an Blog image of Resolution 350*220px', 'text-domain' ) . '" data-uploader_button_text="' . esc_attr__( 'Set Blog image of Resolution 350*220px', 'text-domain' ) . '">' . esc_html__( 'Set Blog image of Resolution 350*220px', 'text-domain' ) . '</a></p>';
		$content .= '<input type="hidden" id="upload_listing_image_350_220" name="_listing_cover_image_350_220" value="" />';
	}
	echo $content;
}
add_action( 'save_post', 'sb_listing_image_save_350_220', 10, 1 );
function sb_listing_image_save_350_220 ( $post_id ) {

	if( isset( $_POST['_listing_cover_image_350_220'] ) ) {
		$image_id = (int) $_POST['_listing_cover_image_350_220'];
		update_post_meta( $post_id, '_listing_image_id_350_220', $image_id );
	}
} */
//Detail page
add_action( 'add_meta_boxes', 'sb_listing_image_add_metabox_740_360' );
function sb_listing_image_add_metabox_740_360 () {
	add_meta_box( 'listingimagediv740_360', __( 'Detail Page-Blog Image Section for 740px*360px', 'text-domain' ), 'sb_listing_image_metabox_740_360', 'blog', 'normal', 'low');
}
function sb_listing_image_metabox_740_360 ( $post ) {
	global $content_width, $_wp_additional_image_sizes;
	$image_id = get_post_meta( $post->ID, '_listing_image_id_740_360', true );
	$old_content_width = $content_width;
	$content_width = 254;
	if ( $image_id && get_post( $image_id ) ) {
		if ( ! isset( $_wp_additional_image_sizes['post-thumbnail'] ) ) {
			$thumbnail_html = wp_get_attachment_image( $image_id, array( $content_width, $content_width ) );
		} else {
			$thumbnail_html = wp_get_attachment_image( $image_id, 'post-thumbnail' );
		}
		if ( ! empty( $thumbnail_html ) ) {
			$content = $thumbnail_html;
			//350*220px
			$content .= '<p class="hide-if-no-js"><a href="javascript:;" id="remove_listing_image_button_740_360" >' . esc_html__( 'Remove Blog image of Resolution 740*360px', 'text-domain' ) . '</a></p>';
			$content .= '<input type="hidden" id="upload_listing_image_740_360" name="_listing_cover_image_740_360" value="' . esc_attr( $image_id ) . '" />';
		}
		$content_width = $old_content_width;
	} else {

		
		//350*220px
		$content = '<img src="" style="width:' . esc_attr( $content_width ) . 'px;height:auto;border:0;display:none;" />';
		$content .= '<p class="hide-if-no-js"><a title="' . esc_attr__( 'Set Blog image [Resolution 740px*360px only]', 'text-domain' ) . '" href="javascript:;" id="upload_listing_image_button_740_360" id="set-listing-image-740-360" data-uploader_title="' . esc_attr__( 'Choose an Blog image of Resolution 740*360px', 'text-domain' ) . '" data-uploader_button_text="' . esc_attr__( 'Set Blog image of Resolution 740*360px', 'text-domain' ) . '">' . esc_html__( 'Set Blog image of Resolution 740*360px', 'text-domain' ) . '</a></p>';
		$content .= '<input type="hidden" id="upload_listing_image_740_360" name="_listing_cover_image_740_360" value="" />';
	}
	echo $content;
}
add_action( 'save_post', 'sb_listing_image_save_740_360', 10, 1 );
function sb_listing_image_save_740_360 ( $post_id ) {

	if( isset( $_POST['_listing_cover_image_740_360'] ) ) {
		$image_id = (int) $_POST['_listing_cover_image_740_360'];
		update_post_meta( $post_id, '_listing_image_id_740_360', $image_id );
	}
}

add_filter('gettext','sb_simple_enter_title');

function sb_simple_enter_title( $input ) {

    global $post_type;

    if( is_admin() && 'Enter title here' == $input && 'blog' == $post_type )
        return 'Enter Blog Title';

    return $input;
}

add_filter( 'template_include', 'sb_include_template_function', 1 );
function sb_include_template_function( $template_path ) {
	$plugin_url=plugins_url(__FILE__);
	$plugin_url = $plugin_url."/simple-blog";
    if ( get_post_type() == 'blog' ) {
        if ( is_single() ) {
            // checks if the file exists in the theme first,
            // otherwise serve the file from the plugin
            if ( $theme_file = locate_template( array ( 'simpleBlog/single-blog.php' ) ) ) {
                $template_path = $theme_file;
            } else {
				
                $template_path = plugin_dir_path( __FILE__ ) . '/simpleBlog/single-blog.php';
            }
        }
    }
    return $template_path;
}

// function to display number of posts.
function sb_getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count.'';
}

// function to count views.
function sb_setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}


// Add it to a column in WP-Admin
add_filter('sb_manage_posts_columns', 'sb_posts_column_views');
add_action('sb_manage_posts_custom_column', 'sb_posts_custom_column_views',5,2);
function sb_posts_column_views($defaults){
    $defaults;//&#91;'post_views'&#93; = __('Views');
    return $defaults;
}
function sb_posts_custom_column_views($column_name, $id){
	if($column_name === 'post_views'){
        echo getPostViews(get_the_ID());
    }
}
function sb_simple_blog_create_blog_page() {

$page = get_pages(); 	
	$blog_page= array(	'slug' => 'blogs',	'title' =>'Blog'	);

foreach ($page as $pages) { 
		$apage = $pages->post_name; 
		 switch ( $apage ){ 
			case 'blogs' :   				$blog_found= '1';		break;			
			default:					$no_page;			
		}		
	}

	if($blog_found != '1'){
		$page_id = wp_insert_post(array(
			'post_title' => $blog_page['title'],
			'post_type' =>'page',		
			'post_name' => $blog_page['slug'],
			'post_status' => 'publish',
			'post_content' => 'User profile and author page details page ! '	
		));
	 global $post;
    // Write here the remaining codes
	
	
	
	}
}
add_action('admin_init', 'sb_simple_blog_create_blog_page');

add_filter( 'page_template', 'sb_custom_page_template' );
function sb_custom_page_template( $page_template ) {
        global $post;
		$post_slug=$post->post_name;			if($post_slug == "blogs"){					 if ( $theme_file = locate_template( array ( 'simpleBlog/blog-listing-tpl.php' ) ) ) {                $page_template = $theme_file;            } else {				                $page_template = plugin_dir_path( __FILE__ ) . '/simpleBlog/blog-listing-tpl.php';				}			}
		
			return $page_template;
        
}
