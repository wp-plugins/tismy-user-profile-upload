/**
 * Callback function for the 'click' event of the 'Set Footer Image'
 * anchor in its meta box.
 *
 * Displays the media uploader for selecting an image.
 *
 * @since 0.1.0
 */
function renderMediaUploader() {
    'use strict';
 
    var file_frame, image_data;
 
    /**
     * If an instance of file_frame already exists, then we can open it
     * rather than creating a new instance.
     */
/*
    if ( undefined !== file_frame ) {
 
        file_frame.open();
        return;
 
    }
 
*/
    /**
     * If we're this far, then an instance does not exist, so we need to
     * create our own.
     *
     * Here, use the wp.media library to define the settings of the Media
     * Uploader. We're opting to use the 'post' frame which is a template
     * defined in WordPress core and are initializing the file frame
     * with the 'insert' state.
     *
     * We're also not allowing the user to select more than one image.
     */
    file_frame = wp.media.frames.file_frame = wp.media({
			title:    "Insert Media",    // For production, this needs i18n.
			button:   {
				text: "Upload Image"     // For production, this needs i18n.
			},
			multiple: false
    });
    
 
    /**
     * Setup an event handler for what to do when an image has been
     * selected.
     *
     * Since we're using the 'view' state when initializing
     * the file_frame, we need to make sure that the handler is attached
     * to the insert event.
     */
    file_frame.on( 'select', function() {
 
		image_data = file_frame.state().get( 'selection' ).first().toJSON();
		
		console.log( image_data );
		
		for ( var image_property in image_data ) {

			/**
			 * Here, you have access to all of the properties
			 * provided by WordPress to the selected image.
			 *
			 * This is generally where you take the data and so whatever
			 * it is that you want to do.
			 *
			 * For purposes of example, we're just going to dump the
			 * properties into the console.
			 */
			console.log( image_property + ': ' + image_data[ image_property ] );


		}
	    
	    // After that, set the properties of the image and display it
	    jQuery( '#profile-image-container' )
	        .children( 'img' )
	            .attr( 'src', image_data.url )
	            .attr( 'alt', image_data.caption )
	            .attr( 'title', image_data.title )
	                        .show()
	        .parent()
	        .removeClass( 'hidden' );
	        
	    jQuery( '#profile-image-src' ).val( image_data.id ).show();
	 
	    // Next, hide the anchor responsible for allowing the user to select an image
	    jQuery( '#profile-image-container' ).prev().hide();
	    jQuery( '#profile-image-container' ).next().show();
	    
 
    });
 
    // Now display the actual file_frame
    file_frame.open();
 
}

function resetUploadForm( $ ) {
    'use strict';
 
    // First, we'll hide the image
    $( '#profile-image-container' )
        .children( 'img' )
        .hide();
 
    // Then display the previous container
    $( '#profile-image-container' )
        .prev()
        .show();
 
    // Finally, we add the 'hidden' class back to this anchor's parent
    $( '#profile-image-container' )
        .next()
        .hide()
        .addClass( 'hidden' );
        
    // at this point remove input value 
    $( '#profile-image-src' ).attr('value', '');
 
}
 
(function( $ ) {
    'use strict';
 
    $(function() {
        $( '#profile-uploader' ).on( 'click', function( evt ) {
 
            // Stop the anchor's default behavior
            evt.preventDefault();
 
            // Display the media uploader
            renderMediaUploader();
 
        });
 
    });
    
    $(function() {
		$( '#remove-profile-image' ).on( 'click', function( evt ) {
		     
		    // Stop the anchor's default behavior
		    evt.preventDefault();
		 
		    // Remove the image, toggle the anchors
		    resetUploadForm( $ );
		     
		});
    });

})( jQuery );