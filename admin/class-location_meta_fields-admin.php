<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://codepixelz.com
 * @since      1.0.0
 *
 * @package    Location_meta_fields
 * @subpackage Location_meta_fields/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Location_meta_fields
 * @subpackage Location_meta_fields/admin
 * @author     codepixelz <codepixelz@gmail.com>
 */
class Location_meta_fields_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Location_meta_fields_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Location_meta_fields_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/location_meta_fields-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Location_meta_fields_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Location_meta_fields_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/location_meta_fields-admin.js', array( 'jquery' ), $this->version, false );

	}



	public function register_location() {
    $labels = array(
        'name' => __( 'Location', 'my_custom_post','custom' ),
        'singular_name' => __( 'Locations', 'my_custom_post', 'custom' ),
        'add_new' => __( 'Add New', 'my_custom_post', 'custom' ),
        'add_new_item' => __( 'Add New Location', 'my_custom_post', 'custom' ),
        'edit_item' => __( 'Edit Location', 'my_custom_post', 'custom' ),
        'new_item' => __( 'New Location', 'my_custom_post', 'custom' ),
        'view_item' => __( 'View Location', 'my_custom_post', 'custom' ),
        'search_items' => __( 'Search Locations', 'my_custom_post', 'custom' ),
        'not_found' => __( 'No ThemePosts found', 'my_custom_post', 'custom' ),
        'not_found_in_trash' => __( 'No Locations found in Trash', 'my_custom_post', 'custom' ),
        'parent_item_colon' => __( 'Parent Locations:', 'my_custom_post', 'custom' ),
        'menu_name' => __( 'Location', 'my_custom_post', 'custom' ),
    );


    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => null,
        'menu_icon' => 'dashicons-admin-site',
        'supports' => array('title','editor')
    );
    register_post_type( 'location', $args );
}

// Add the location Meta Boxes

function add_location_metaboxes() {

	add_meta_box(
        'custom_meta_box_location',
        __( 'Location Meta fields', $this->get_plugin_name ),
        array( $this, 'custom_meta_box_location' ),
        'location',
        'normal',
        'default'
    );


}

function custom_meta_box_location($object)
{
    wp_nonce_field(plugin_basename( __FILE__ ), "meta-box-nonce");

    ?>
        <div class="cpm-location-meta-field-sec">
            <label for="meta-box-text">Price</label>
            <input name="meta-box-price" type="text" value="<?php echo get_post_meta($object->ID, "meta-box-price", true); ?>">

            <br>

            <label for="meta-box-dropdown">Phone Number</label>
            <input name="meta-box-phone" type="text" value="<?php echo get_post_meta($object->ID, "meta-box-phone", true); ?>">

            <br>

            <label for="meta-box-checkbox">When Can I Start?</label>
            <textarea name="meta-box-wcis"><?php echo get_post_meta($object->ID, "meta-box-wcis", true); ?></textarea>
        </div>
    <?php
}

// Save the Metabox Data
/*function save_custom_meta_box($post_id)
{
    if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], plugin_basename( __FILE__ ) ))
        return $post_id;

    if(!current_user_can("edit_post", $post_id))
        return $post_id;

    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
        return $post_id;

    $meta_box_price_value = "";
    $meta_box_phone_value = "";
    $meta_box_wcis_value = "";

    if(isset($_POST["meta-box-price"]))
    {
        $meta_box_price_value = $_POST["meta-box-price"];
    }
    update_post_meta($post_id, "meta-box-price", $meta_box_price_value);

    if(isset($_POST["meta-box-phone"]))
    {
        $meta_box_phone_value = $_POST["meta-box-phone"];
    }
    update_post_meta($post_id, "meta-box-phone", $meta_box_phone_value);

    if(isset($_POST["meta-box-wcis"]))
    {
        $meta_box_wcis_value = $_POST["meta-box-wcis"];
    }
    update_post_meta($post_id, "meta-box-wcis", $meta_box_wcis_value);
}
*/

function save_custom_meta_box( $post_id ) {

        if( isset( $_POST['meta-box-nonce'] ) && isset( $_POST['post_type'] ) ) {

            // Don't save if the user hasn't submitted the changes
            if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
                return;
            } // end if

            // Verify that the input is coming from the proper form
            if( ! wp_verify_nonce( $_POST['meta-box-nonce'], plugin_basename( __FILE__ ) ) ) {
                return;
            } // end if

            // Make sure the user has permissions to post
            if( 'post' == $_POST['post_type']) {
                if( ! current_user_can( 'edit_post', $post_id ) ) {
                    return;
                } // end if
            } // end if/else

            // Read the post message and its position
            $price = isset( $_POST['meta-box-price'] ) ? $_POST['meta-box-price'] : '';

            $phone = isset( $_POST['meta-box-phone'] ) ? $_POST['meta-box-phone'] : '';

            $wcis = isset( $_POST['meta-box-wcis'] ) ? $_POST['meta-box-wcis'] : '';
           

            // If the value for the post message exists, delete it first. I don't want to write extra rows into the table.
            if ( 0 == count( get_post_meta( $post_id, 'meta-box-price' ) ) ) {
                delete_post_meta( $post_id, 'meta-box-price' );
            } // end if

            // Update it for this post.
            update_post_meta( $post_id, 'meta-box-price', $price );

            // If the value for the post message exists, delete it first. I don't want to write extra rows into the table.
            if ( 0 == count( get_post_meta( $post_id, 'meta-box-phone' ) ) ) {
                delete_post_meta( $post_id, 'meta-box-phone' );
            } // end if
            update_post_meta( $post_id, 'meta-box-phone', $phone );

            // If the value for the post message exists, delete it first. I don't want to write extra rows into the table.
            if ( 0 == count( get_post_meta( $post_id, 'meta-box-wcis' ) ) ) {
                delete_post_meta( $post_id, 'meta-box-wcis' );
            } // end if
            update_post_meta( $post_id, 'meta-box-wcis', $wcis );
            

        } // end if

    } // end save_notice


    function cpt_location_meta_shortcode(){
        $args = array(
            'post_type' => 'location',
            'post_status' => 'publish'
        );

        $string = '';
        $query = new WP_Query( $args );
        if( $query->have_posts() ){
            $string .= '<div class="location-details-section">';
            while( $query->have_posts() ){
                $query->the_post();
                $wcis=get_post_meta(get_the_ID(), "meta-box-wcis", true);
                $price=get_post_meta(get_the_ID(), "meta-box-price", true);
                $phoneno=get_post_meta(get_the_ID(), "meta-box-phone", true);
                //var_dump($wcis);
                $string .= '<h2>' . get_the_title() . '</h2><div class="location-content">'.get_the_content().'</div><span>When can I Start? :</span>'.$wcis.'<br/><span>Price :</span>'.$price.'<br/><span>Phone Number : </span>'.$phoneno.'<br>';

            }
            $string .= '</div>';
        }
        wp_reset_postdata();
        return $string;
    }

}

