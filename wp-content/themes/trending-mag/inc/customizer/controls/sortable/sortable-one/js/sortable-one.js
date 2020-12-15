( function( $ ) {
    jQuery(document).ready(function($) {

        /**
		 * Sortable Options
		 */

		// Make our list sortable
		$( 'ul.sortable-one-options-list' ).sortable({
			handle: '.sortable-one-options-handle',
			axis: 'y',
			update: function( e, ui ){
				$( 'input.sortable-one-options-item' ).trigger( 'change' );
			}
		});

		// On change
		$( 'input.sortable-one-options-item' ).on( 'change', function() {
			// Get the value, and convert to string.
			this_checkboxes_values = $( this ).parents( 'ul.sortable-one-options-list' ).find( 'input.sortable-one-options-item' ).map( function() {
				var active = '0';
				if( $( this ).prop("checked") ){
					var active = '1';
				}
				return this.name + ':' + active;
			}).get().join( ',' );

			// Add the value to hidden input.
			$( this ).parents( 'ul.sortable-one-options-list' ).find( 'input.sortable-one-options' ).val( this_checkboxes_values ).trigger( 'change' );
		});
    });
} ) ( jQuery );
