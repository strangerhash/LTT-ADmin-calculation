/*Dashboard3 Init*/
 
"use strict"; 
$(document).ready(function() {
	var upgrade_url = $('a#upgrade_url').attr('href');

	/*Toaster Alert*/
	$.toast({
		heading: 'Welcome!',
		text: '<p>Please upgrade your account to avoid deactivation.</p><a href="'+ upgrade_url +'" class="btn btn-primary btn-sm mt-10">Upgrade</a>',
		position: 'top-right',
		loaderBg:'#00acf0',
		class: 'jq-toast-primary',
		hideAfter: 8000, 
		stack: 6,
		showHideTransition: 'fade'
	});
});
