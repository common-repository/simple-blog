 var sb = jQuery.noConflict();
 sb(document).ready(function() {
	sb('#simple_pub_cal').pickmeup({
		position		: 'bottom',
		hide_on_select	: true,
                //max: new Date(),
				format  : 'd-m-Y'
	});

 });
sb(document).ready(function() {

	

	sb.fn.upload_listing_image_750_350 = function( button ) {
		// Uploading files
		var file_frame;
		var button_id = button.attr('id');
		var field_id = button_id.replace( '_button', '' );

		// If the media frame already exists, reopen it.
		if ( file_frame ) {
		  file_frame.open();
		  return;
		}

		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		  title: sb( this ).data( 'uploader_title' ),
		  button: {
		    text: sb( this ).data( 'uploader_button_text' ),
		  },
		  multiple: false
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
		  var attachment = file_frame.state().get('selection').first().toJSON();
		  sb("#"+field_id).val(attachment.id);
		  sb("#listingimagediv750_350 img").attr('src',attachment.url);
		  sb( '#listingimagediv750_350 img' ).show();
		  sb( '#' + button_id ).attr( 'id', 'remove_listing_image_button_750_350' );
		  sb( '#remove_listing_image_button_750_350' ).text( 'Remove listing image 750px*350px' );
		});

		// Finally, open the modal
		file_frame.open();
	};
	sb.fn.upload_listing_image_740_360 = function( button ) {
		// Uploading files
		var file_frame;
		var button_id = button.attr('id');
		var field_id = button_id.replace( '_button', '' );

		// If the media frame already exists, reopen it.
		if ( file_frame ) {
		  file_frame.open();
		  return;
		}

		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		  title: sb( this ).data( 'uploader_title' ),
		  button: {
		    text: sb( this ).data( 'uploader_button_text' ),
		  },
		  multiple: false
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
		  var attachment = file_frame.state().get('selection').first().toJSON();
		  sb("#"+field_id).val(attachment.id);
		  sb("#listingimagediv740_360 img").attr('src',attachment.url);
		  sb( '#listingimagediv740_360 img' ).show();
		  sb( '#' + button_id ).attr( 'id', 'remove_listing_image_button_740_360' );
		  sb( '#remove_listing_image_button_740_360' ).text( 'Remove listing image 740px*360px' );
		});

		// Finally, open the modal
		file_frame.open();
	};
	sb.fn.upload_listing_image_350_250 = function( button ) {
		// Uploading files
		var file_frame;
		var button_id = button.attr('id');
		var field_id = button_id.replace( '_button', '' );

		// If the media frame already exists, reopen it.
		if ( file_frame ) {
		  file_frame.open();
		  return;
		}

		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		  title: sb( this ).data( 'uploader_title' ),
		  button: {
		    text: sb( this ).data( 'uploader_button_text' ),
		  },
		  multiple: false
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
		  var attachment = file_frame.state().get('selection').first().toJSON();
		  sb("#"+field_id).val(attachment.id);
		  sb("#listingimagediv350_250 img").attr('src',attachment.url);
		  sb( '#listingimagediv350_250 img' ).show();
		  sb( '#' + button_id ).attr( 'id', 'remove_listing_image_button_350_250' );
		  sb( '#remove_listing_image_button_350_250' ).text( 'Remove listing image 350px*250px' );
		});

		// Finally, open the modal
		file_frame.open();
	};
	
	sb.fn.upload_listing_image_350_220 = function( button ) {
		// Uploading files
		var file_frame;
		var button_id = button.attr('id');
		var field_id = button_id.replace( '_button', '' );

		// If the media frame already exists, reopen it.
		if ( file_frame ) {
		  file_frame.open();
		  return;
		}

		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		  title: sb( this ).data( 'uploader_title' ),
		  button: {
		    text: sb( this ).data( 'uploader_button_text' ),
		  },
		  multiple: false
		});

		// When an image is selected, run a callback.
		 file_frame.on( 'select', function() {
		  var attachment = file_frame.state().get('selection').first().toJSON();
		  sb("#"+field_id).val(attachment.id);
		  sb("#listingimagediv350_220 img").attr('src',attachment.url);
		  sb( '#listingimagediv350_220 img' ).show();
		  sb( '#' + button_id ).attr( 'id', 'remove_listing_image_button_350_220' );
		  sb( '#remove_listing_image_button_350_220' ).text( 'Remove listing image 350px*220px' );
		});

		// Finally, open the modal
		file_frame.open();
	};
	
	sb('#listingimagediv750_350').on( 'click', '#upload_listing_image_button_750_350', function( event ) {
		event.preventDefault();
		sb.fn.upload_listing_image_750_350( sb(this) );
	});

	sb('#listingimagediv750_350').on( 'click', '#remove_listing_image_button_750_350', function( event ) {
		event.preventDefault();
		sb( '#upload_listing_image_750_350' ).val( '' );
		sb( '#listingimagediv750_350 img' ).attr( 'src', '' );
		sb( '#listingimagediv750_350 img' ).hide();
		sb( this ).attr( 'id', 'upload_listing_image_button_750_350' );
		sb( '#upload_listing_image_button_750_350' ).text( 'Set listing image for Blog of 750px*350px' );
	});
		sb('#listingimagediv740_360').on( 'click', '#upload_listing_image_button_740_360', function( event ) {
		event.preventDefault();
		sb.fn.upload_listing_image_740_360( sb(this) );
	});

	sb('#listingimagediv740_360').on( 'click', '#remove_listing_image_button_740_360', function( event ) {
		event.preventDefault();
		sb( '#upload_listing_image_740_360' ).val( '' );
		sb( '#listingimagediv740_360 img' ).attr( 'src', '' );
		sb( '#listingimagediv740_360 img' ).hide();
		sb( this ).attr( 'id', 'upload_listing_image_button_740_360' );
		sb( '#upload_listing_image_button_740_360' ).text( 'Set listing image for Blog of 740px*360px' );
	});
	
	sb('#listingimagediv350_220').on( 'click', '#upload_listing_image_button_350_220', function( event ) {
		event.preventDefault();
		sb.fn.upload_listing_image_350_220( sb(this) );
	});

	sb('#listingimagediv350_220').on( 'click', '#remove_listing_image_button_350_220', function( event ) {
		event.preventDefault();
		sb( '#upload_listing_image_350_220' ).val( '' );
		sb( '#listingimagediv350_220 img' ).attr( 'src', '' );
		sb( '#listingimagediv350_220 img' ).hide();
		sb( this ).attr( 'id', 'upload_listing_image_button_350_220' );
		sb( '#upload_listing_image_button_350_220' ).text( 'Set listing image for Blog of 350px*220px' );
	});
	
	
	sb('#listingimagediv350_250').on( 'click', '#upload_listing_image_button_350_250', function( event ) {
		event.preventDefault();
		sb.fn.upload_listing_image_350_250( sb(this) );
	});

	sb('#listingimagediv350_250').on( 'click', '#remove_listing_image_button_350_250', function( event ) {
		event.preventDefault();
		sb( '#upload_listing_image_350_250' ).val( '' );
		sb( '#listingimagediv350_250 img' ).attr( 'src', '' );
		sb( '#listingimagediv350_250 img' ).hide();
		sb( this ).attr( 'id', 'upload_listing_image_button_350_250' );
		sb( '#upload_listing_image_button_350_250' ).text( 'Set listing image for Blog of 350px*250px' );
	});

});
 

