<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.squareonemd.co.uk
 * @since      1.0.0
 *
 * @package    Tismy_User_Profile_Upload
 * @subpackage Tismy_User_Profile_Upload/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Tismy_User_Profile_Upload
 * @subpackage Tismy_User_Profile_Upload/admin
 * @author     Elliott Richmond <elliott@squareonemd.co.uk>
 */
class Tismy_User_Profile_Upload_Admin {

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
	 * @param      string    $tismy_user_profile_upload       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $tismy_user_profile_upload, $version ) {

		$this->tismy_user_profile_upload = $tismy_user_profile_upload;
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
		 * defined in Tismy_User_Profile_Upload_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tismy_User_Profile_Upload_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->tismy_user_profile_upload, plugin_dir_url( __FILE__ ) . 'css/tismy-user-profile-upload-admin.css', array(), $this->version, 'all' );

		wp_enqueue_style( $this->tismy_user_profile_upload . '-media-profile-image', plugin_dir_url( __FILE__ ) . 'css/media-profile-image.css', array(), $this->version, 'all'  );

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
		 * defined in Tismy_User_Profile_Upload_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tismy_User_Profile_Upload_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->tismy_user_profile_upload, plugin_dir_url( __FILE__ ) . 'js/tismy-user-profile-upload-admin.js', array( 'jquery' ), $this->version, false );

		wp_enqueue_media();
		
		wp_enqueue_script($this->tismy_user_profile_upload . '-media-profile-image', plugin_dir_url( __FILE__ ) . '/js/media-profile-image.js', array( 'jquery' ), $this->version, false );
	}

	public function extra_profile_fields( $user ) {
		if (!current_user_can('upload_files')) {
			return;
		}
	    // get the value of profile image
	    $profile_image_id = get_user_meta( $user->ID, 'profile_image_id', true );
	    if (empty($profile_image_id) || !isset($profile_image_id)) { ?>
			<tr valign="top">
			<th scope="row">Profile Image</th>
				<td>
					
					<p class="hide-if-no-js">
					    <a title="Set Profile Image" href="javascript:;" id="profile-uploader">Set profile image</a>
					</p>
					 
					<div id="profile-image-container" class="hidden">
					    <img src="" alt="" title="" />
					    <input type="hidden" id="profile-image-src" name="profile_image_src" value="" />
					</div>
					
					<p class="hide-if-no-js hidden">
					    <a title="Set Profile Image" href="javascript:;" id="remove-profile-image">Remove profile image</a>
					</p>
					 
					
				</td>
			</tr>
		<?php } else { ?>
			<tr valign="top">
				<th scope="row">Profile Image</th>
				<td>
					<p class="hide-if-no-js hidden">
					    <a title="Set Profile Image" href="javascript:;" id="profile-uploader">Set profile image</a>
					</p>
					<div id="profile-image-container">
					    <?php echo wp_get_attachment_image( $profile_image_id, 'full' ); ?>
					    <input type="hidden" id="profile-image-src" name="profile_image_src" value="<?php echo $profile_image_id; ?>" />
					</div>
					<p class="hide-if-no-js">
					    <a title="Set Profile Image" href="javascript:;" id="remove-profile-image">Remove profile image</a>
					</p>
				</td>
			</tr>
		<?php } ?>
		<?php
	}

	public function update_extra_profile_fields($user_id) {
	     if ( current_user_can('edit_user',$user_id) ) {
	
		     if (isset($_POST['profile_image_src']) && (int)($_POST['profile_image_src'])) {
			     update_user_meta($user_id, 'profile_image_id', (int)$_POST['profile_image_src']);
		     } else {
			     delete_user_meta($user_id, 'profile_image_id');
		     }
	     }
	}

	public function my_custom_avatar( $avatar, $id_or_email, $size, $default, $alt ) {
	    $user = false;
	    
	    if ( is_numeric( $id_or_email ) ) {
	
	        $id = (int) $id_or_email;
	        $user = get_user_by( 'id' , $id );
	
	    } elseif ( is_object( $id_or_email ) ) {
		    
	        if (!empty( $id_or_email->user_id ) ) {
		                    
	            $id = (int) $id_or_email->user_id;
	            $user = get_user_by( 'id' , $id );
	        }
	
	    } else {
	        $user = get_user_by( 'email', $id_or_email );	
	    }
	    
	    if ( $user && is_object( $user ) ) {
		    
			$override = get_user_meta($user->ID, 'profile_image_id');
	
			if ((int)$override) {
				$profile_image_url = wp_get_attachment_url( $override[0] );
	            $avatar = $profile_image_url;
	            $avatar = "<img alt='{$alt}' src='{$avatar}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
			} else {
				$avatar = get_avatar($user, 32);
			}
	
	    }
	
	    return $avatar;
	}

}
