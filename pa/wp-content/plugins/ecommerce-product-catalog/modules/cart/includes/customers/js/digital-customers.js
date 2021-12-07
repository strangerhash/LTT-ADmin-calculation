/*!
 impleCode Shopping Cart
 (c) 2020 Norbert Dreszer - http://implecode.com
 */

jQuery( document ).ready( function () {
    jQuery( ".login_button.not-logged a, .popup_login_form .closer" ).click( function ( event ) {
        event.preventDefault();
        digital_customer_toggle_popup_login();
    } );
    jQuery( ".inside_login" ).tabs();
} );

function digital_customer_toggle_popup_login() {
    var login_form = jQuery( ".popup_login_form" );
    login_form.toggle( "slide", { "direction": "up" }, function () {
        if ( login_form.is( ":hidden" ) ) {
            jQuery( "#ic_overlay" ).hide();
            if ( is_mobile_login_popup() ) {
                jQuery( 'html' ).css( "overflow", "auto" );
            }
            login_form.find( ".login-submit input[name='redirect_to']" ).val( window.location.href );
        } else {
            jQuery( "#ic_overlay" ).show();
            if ( is_mobile_login_popup() ) {
                jQuery( 'html' ).css( "overflow", "hidden" );
            }
        }
    } );
}

function digital_customer_hide_popup_login() {
    jQuery( ".popup_login_form" ).hide( "slide", { "direction": "up" }, function () {
        jQuery( "#ic_overlay" ).hide();
        if ( is_mobile_theme() ) {
            jQuery( 'html' ).css( "overflow", "auto" );
        }
    } );
}

function is_mobile_login_popup() {
    return false;
}
