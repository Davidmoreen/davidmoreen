/**
 * Contact page
 * 
 * @author Davidmoreen <davidmoreen@gmail.com>
 * @version 1.0
 */


$(function() {
	
	// Contact form validation
	var form           = $("#contact_form");
	var name           = $("#name");
	var nameError      = $("#name_error");
	var email          = $("#email");
	var emailError     = $("#email_error");
	var message        = $("#message");
	var messageError   = $("#message_error");
	var submitBtn      = $("#submit_button");
	
	// Submit the form if passed
	form.submit(function(e) {
		submitBtn.attr("value", "Validating...");
		
		if (validateName() & validateEmail() & validateMessage()) {
			submitBtn.attr("value", "Sending...");
			return true;
		} else {
			e.preventDefault();
			submitBtn.attr("value", "Errors...");
			setTimeout(function(){ submitBtn.attr("value", "Send") }, 3000);
		}
		
	});
	
	
	/**
	 * Validate functions
	 */
	function validateName() {
		var field = name.val();
		var filter = /^[a-zA-Z ]{1,75}$/;
			
		if (filter.test(field)) {
			name.removeClass("input_error");
			nameError.text("");
			return true;
		} else {
			name.addClass("input_error");
			nameError.text("Youre name...");
			return false;
		}
	}

	function validateEmail() {
		var field = email.val();
		var filter = /^([a-z0-9])(([-a-z0-9._])*([a-z0-9]))*\@([a-z0-9])(([a-z0-9-])*([a-z0-9]))+(\.([a-z0-9])([-a-z0-9_-])?([a-z0-9])+)+$/i;
		if (!filter.test(field)) {
			email.addClass("input_error");
			emailError.text("Invalid email address");
			return false;
		} else {
			email.removeClass("input_error");
			emailError.text("");
			return true;
		}
	}

	function validateMessage() {
		var field = $.trim(message.val());
		message.text(field);
		if (field.length < 10) {
			message.addClass("input_error");
			messageError.text("Just a tad bit longer. Maybe " + (10-field.length) + " more character" + (field.length == 9? "." : "s."));
			return false;
		} else {
			message.removeClass("input_error");
			messageError.text("");
			return true;
		}
	}
	
});