 var sbx = jQuery.noConflict();
sbx(document).ready(function() {

	// Uploading files
	var file_frame;

	sbx.fn.upload_listing_image = function( button ) {
		var button_id = button.attr('id');
		var field_id = button_id.replace( '_button', '' );

		// If the media frame already exists, reopen it.
		if ( file_frame ) {
		  file_frame.open();
		  return;
		}

		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		  title: sbx( this ).data( 'uploader_title' ),
		  button: {
		    text: sbx( this ).data( 'uploader_button_text' ),
		  },
		  multiple: false
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
		  var attachment = file_frame.state().get('selection').first().toJSON();
		  sbx("#"+field_id).val(attachment.id);
		  sbx("#listingimagediv img").attr('src',attachment.url);
		  sbx( '#listingimagediv img' ).show();
		  sbx( '#' + button_id ).attr( 'id', 'remove_listing_image_button' );
		  sbx( '#remove_listing_image_button' ).text( 'Remove listing image' );
		});

		// Finally, open the modal
		file_frame.open();
	};

	sbx('#listingimagediv').on( 'click', '#upload_listing_image_button', function( event ) {
		alert("h");
		//event.preventDefault();
		sbx.fn.upload_listing_image( sbx(this) );
	});

	sbx('#listingimagediv').on( 'click', '#remove_listing_image_button', function( event ) {
		event.preventDefault();
		sbx( '#upload_listing_image' ).val( '' );
		sbx( '#listingimagediv img' ).attr( 'src', '' );
		sbx( '#listingimagediv img' ).hide();
		sbx( this ).attr( 'id', 'upload_listing_image_button' );
		sbx( '#upload_listing_image_button' ).text( 'Set listing image' );
	});

});
