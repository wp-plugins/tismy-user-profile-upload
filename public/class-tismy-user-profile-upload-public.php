<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.squareonemd.co.uk
 * @since      1.0.0
 *
 * @package    Tismy_User_Profile_Upload
 * @subpackage Tismy_User_Profile_Upload/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Tismy_User_Profile_Upload
 * @subpackage Tismy_User_Profile_Upload/public
 * @author     Elliott Richmond <elliott@squareonemd.co.uk>
 */
class Tismy_User_Profile_Upload_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $tismy_user_profile_upload    The ID of this plugin.
	 */
	private $tismy_user_profile_upload;

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
	 * @param      string    $tismy_user_profile_upload       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $tismy_user_profile_upload, $version ) {

		$this->tismy_user_profile_upload = $tismy_user_profile_upload;
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
		 * defined in Tismy_User_Profile_Upload_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tismy_User_Profile_Upload_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->tismy_user_profile_upload, plugin_dir_url( __FILE__ ) . 'css/tismy-user-profile-upload-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Tismy_User_Profile_Upload_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tismy_User_Profile_Upload_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->tismy_user_profile_upload, plugin_dir_url( __FILE__ ) . 'js/tismy-user-profile-upload-public.js', array( 'jquery' ), $this->version, false );

	}

}
