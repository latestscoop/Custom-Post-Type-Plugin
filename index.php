<?php 
    /*
    Plugin Name: Custom Post Type
    Plugin URI: http://www.latestscoop.co.uk
    Description: Blank Custom Post Type for WordPress
    Author: Sami Cooper
    Version: 0.9
    Author URI: http://www.latestscoop.co.uk
    */
?>
<?php
/*
----------
Sources:
Set
	https://codex.wordpress.org/Post_Types
	https://wordpress.org/support/topic/how-to-add-blog-prefix-for-custom-post-types-in-permalinks
Metaboxes
	http://wptheming.com/2010/08/custom-metabox-for-post-type/
----------
*/
/*
----------
Custom post_type
add name(s) and custom slug
----------
*/
add_action( 'init', 'create_post_type' );
function create_post_type() {
	register_post_type( 'name_of_post_type',
    array(
      'labels' => array(
        'name' => __( 'Names' ),
        'singular_name' => __( 'Name' )
      ),
      'public' => true,
      'show_ui' => true,
      'has_archive' => false,
      'rewrite' => array('with_front' => false, 'slug' => 'insert_slug_name'),
      'supports' => array( 'title', 'thumbnail' ),
      'menu_position' => 5,
      'register_meta_box_cb' => 'add_name_of_post_type_metaboxes',
    )
  );
}
/*
----------
Create metaboxes
----------
*/
add_action( 'add_meta_boxes', 'add_name_of_post_type_metaboxes' );
function add_name_of_post_type_metaboxes() {
	//create each metabox - list them
    add_meta_box('name_of_post_type_metabox_one', 'One', 'name_of_post_type_metabox_one', 'name_of_post_type', 'normal', 'default');
	add_meta_box('name_of_post_type_metabox_two', 'Two', 'name_of_post_type_metabox_two', 'name_of_post_type', 'normal', 'default');
}
//Metabox details
function name_of_post_type_metabox_details_one() {
	//must set global $post variable in each metabox instance
	global $post;
	//Security - Hidden field = the current time, the $action argument, and the current user ID
	//Only need to do this once, and will be checked at the end upon submission
	echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	//Short field
	$name_of_post_type_field_one = get_post_meta($post->ID, '_name_of_post_type_field_one', true);
    echo '<span style=" display:block; font-weight:bold; margin:20px 0 10px 0;">* Event Name:</span>';
    echo '<input type="text" name="_name_of_post_type_field_one" value="' . $name_of_post_type_field_one  . '" class="widefat" />';
	//Drop down field
	$name_of_post_type_field_two = get_post_meta($post->ID, '_name_of_post_type_field_two', true);
	echo '<span style=" display:block; font-weight:bold; margin:20px 0 10px 0;">* Are bookings live?</span>';
	echo '<select name="_name_of_post_type_field_two">';
	echo '<option value="Prebookings" ' . selected( $name_of_post_type_field_two, 'Prebookings' ) . ' >Pre-bookings are active</option>';
	echo '<option value="Bookings" ' . selected( $name_of_post_type_field_two, 'Bookings' ) . ' >Bookings are active</option>';
	echo '</select>';
	//Large field - TinyMCE
	$name_of_post_type_field_three = get_post_meta($post->ID, '_name_of_post_type_field_three', true);
	echo '<span style=" display:block; font-weight:bold; margin:20px 0 -20px 0;">* About the event (FULL):</span>';
	wp_editor( $name_of_post_type_field_three, '_name_of_post_type_field_three', array( '_name_of_post_type_field_three' => 'content', 'media_buttons' => false ) );
}
//Metabox details
function name_of_post_type_metabox_details_two() {
	//must set global $post variable in each metabox instance
	global $post;
	//Short field
	$name_of_post_type_field_four = get_post_meta($post->ID, '_name_of_post_type_field_four', true);
    echo '<span style=" display:block; font-weight:bold; margin:20px 0 10px 0;">Event agenda download URL:</span>';
    echo '<input type="text" name="_name_of_post_type_field_four" value="' . $name_of_post_type_field_four  . '" class="widefat" />';
	//Large field - TinyMCE
	$name_of_post_type_field_five = get_post_meta($post->ID, '_name_of_post_type_field_five', true);
	echo '<span style=" display:block; font-weight:bold; margin:20px 0 -20px 0;">* Agenda:</span>';
	wp_editor( $name_of_post_type_field_five, '_name_of_post_type_field_five', array( '_name_of_post_type_field_five' => 'content', 'media_buttons' => false ) );
}
/*
----------
Save the Metabox Data
----------
*/
$events_meta="";
function name_of_post_type_metabox_save($post_id, $post) {
	//Security check
	if ( isset ($_POST['eventmeta_noncename']) ) {
		if ( !wp_verify_nonce( $_POST['eventmeta_noncename'], plugin_basename(__FILE__) )) { return $post->ID; }
	}
	if ( !current_user_can( 'edit_post', $post->ID )) {	return $post->ID; }
	//List each field here
	if ( isset ($_POST['_name_of_post_type_field_one']) ) {
		$events_meta['_name_of_post_type_field_one'] = $_POST['_name_of_post_type_field_one'];
	}
	if ( isset ($_POST['_name_of_post_type_field_two']) ) {
		$events_meta['_name_of_post_type_field_two'] = $_POST['_name_of_post_type_field_two'];
	}
	if ( isset ($_POST['_name_of_post_type_field_three']) ) {
		$events_meta['_name_of_post_type_field_three'] = $_POST['_name_of_post_type_field_three'];
	}
	if ( isset ($_POST['_name_of_post_type_field_four']) ) {
		$events_meta['_name_of_post_type_field_four'] = $_POST['_name_of_post_type_field_four'];
	}
	if ( isset ($_POST['_name_of_post_type_field_five']) ) {
		$events_meta['_name_of_post_type_field_five'] = $_POST['_name_of_post_type_field_five'];
	}
	if (!empty($events_meta)){
		foreach ($events_meta as $key => $value) { // Cycle through the $events_meta array!
			if( $post->post_type == 'revision' ) return; // Don't store custom data twice
			$value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
			if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
				update_post_meta($post->ID, $key, $value);
			} else { // If the custom field doesn't have a value
				add_post_meta($post->ID, $key, $value);
			}
			if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
		}
	}
}
add_action('save_post', 'name_of_post_type_metabox_save', 1, 2); // save the custom fields
/*
----------
Template for posts
----------
*/
add_filter('single_template', 'name_of_post_type_post_template');
function name_of_post_type_post_template($single) {
    global $wp_query, $post;
	if ($post->post_type == "name_of_post_type"){
		if(file_exists( dirname( __FILE__ ) . '/templates/single-name_of_post_type.php') )
			return dirname( __FILE__ ) . '/templates/single-name_of_post_type.php';
	}
		return $single;
}
/*
----------
Template for pages
----------
*/
/*
add_filter( 'template_include', 'caw_event_page_template' );
function caw_event_page_template( $original_template ) {
	if ( file_exists( dirname( __FILE__ ) . '/templates/page-caw_event.php') ) {
		return dirname( __FILE__ ) . '/templates/page-caw_event.php';
	} else {
		return $original_template;
	}
}
*/
?>
