$( document ).ready(function() {
    
    $( ".accounts").hide();
    $( ".cpassword").hide();
    
	$( "#showAccount" ).click(function() {
	 $( ".accounts" ).slideToggle( "slow" );
	});

	$( "#changePassword" ).click(function() {
	 $( ".cpassword" ).slideToggle( "slow" );
	});

});

