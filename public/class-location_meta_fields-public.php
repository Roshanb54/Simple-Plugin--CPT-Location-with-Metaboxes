<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://codepixelz.com
 * @since      1.0.0
 *
 * @package    Location_meta_fields
 * @subpackage Location_meta_fields/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Location_meta_fields
 * @subpackage Location_meta_fields/public
 * @author     codepixelz <codepixelz@gmail.com>
 */
class Location_meta_fields_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/location_meta_fields-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/location_meta_fields-public.js', array( 'jquery' ), $this->version, false );

	}


//shortcode hook function
	public function register_shortcodes() {

    add_shortcode( 'location-details', array( $this, 'cpt_location_meta_shortcode' ) );

}


	//shortcode function
	public  function cpt_location_meta_shortcode(){
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
