( function( $ ) {
	/*9 Tab*/
	/*13 Enter*/
	/*primary menu submenu on header*/
	$( document ).on(
		'focus',
		'#cwp-header-wrap .cwp-primary-menu-wrapper a',
		function(e){
			$( this ).parentsUntil( ".cwp-primary-menu",'li' ).addClass( 'cwp-open-submenu' );
		}
	);
	$( document ).on(
		'blur',
		'#cwp-header-wrap .cwp-primary-menu-wrapper a',
		function(e){
			$( '.cwp-primary-menu li' ).removeClass( 'cwp-open-submenu' );
		}
	);
	/*primary menu submenu on menu sidebar*/
	$( document ).on(
		'focus',
		'.cwp-header-menu-sidebar .cwp-primary-menu-wrapper a',
		function(e){
			$( this ).next( '.sub-menu' ).addClass( 'open' );
			$( this ).parentsUntil( ".cwp-primary-menu",'li .sub-menu' ).addClass( 'open' );
		}
	);
	$( document ).on(
		'blur',
		'.cwp-header-menu-sidebar .cwp-primary-menu-wrapper a',
		function(e){
			$( '.cwp-header-menu-sidebar .cwp-primary-menu li .sub-menu' ).removeClass( 'open' );
		}
	);

	/*Menu Icon Close/Open*/
	function cwpCloseBtn(){
		$( '.cwp-close-btn' ).trigger( 'click' );
		$( '#cwp-menu-icon-btn-text' ).focus();
	}
	$( document ).on(
		'focus',
		'.cwp-hms-last-focus',
		function(e){
			e.preventDefault();
			cwpCloseBtn();
		}
	);

	$( document ).on(
		'keydown',
		'.cwp-close-btn',
		function(e){
			let key   = e.which,
			cFocusOut = false;
			if (key === 13) {
				cFocusOut = true
			} else if (e.which === 9) {
				if (e.shiftKey === true) {
					cFocusOut = true
				}
			}
			if ( cFocusOut) {
				e.preventDefault();
				cwpCloseBtn();
			}
		}
	);
	$( document ).on(
		'keydown',
		'#cwp-menu-icon-btn-text',
		function(e){
			let key = e.which;
			if (key === 13) {
				e.preventDefault();
				$( 'body' ).addClass( 'cwp-show-menu-sidebar' );
				e.stopPropagation();
				$( '.cwp-close-btn' ).focus();
			}
		}
	);

	/*Dropdown Search*/
	$( document ).on(
		'keydown',
		'#cwp-dropdown-search-form-wrapper',
		function(e){
			let dropdownSearch = document.getElementById( 'cwp-dropdown-search-form-wrapper' ),
			keyCode            = e.keyCode || e.which;

			if (keyCode === 9) {
				dropdownSearch.addEventListener(
					'focusout',
					e => {
						let leavingSearchParent = ! dropdownSearch.contains( e.relatedTarget );
						if (leavingSearchParent) {
							$( '.cwp-search-dropdown' ).removeClass( 'is-active-dropdown' );
						}
					}
				);
			}
		}
	);

} )( jQuery );

/**
 * Skip link focus fixed
 */
( function() {
	var isIe = /(trident|msie)/i.test( navigator.userAgent );

	if ( isIe && document.getElementById && window.addEventListener ) {
		window.addEventListener(
			'hashchange',
			function() {
				var id = location.hash.substring( 1 ),
				element;

				if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
					return;
				}

				element = document.getElementById( id );

				if ( element ) {
					if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
						element.tabIndex = -1;
					}

					element.focus();
				}
			},
			false
		);
	}
}() );
