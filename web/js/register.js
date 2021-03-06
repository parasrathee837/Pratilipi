$(document).ready(function(){
	
	$("#register").validate({
		alert('hello');
		submitHandler : function(e) {
		    $(form).submit();
		},
		rules : {
			name : {
				required : true
			},
			
			password : {
				required : true
			},
			confirm_password : {
				required : true,
				equalTo: "#password"
			}
		},
		messages : {
			name : {
				required : "Please enter Username"
			},
		
			password : {
				required : "Please enter Password"
			},
			confirm_password : {
				required : "Please enter Confirm password",
				equalTo: "Password and Confirm password doesn't match"
			}
		},
		errorPlacement : function(error, element) {
			$(element).closest('div').find('.help-block').html(error.html());
		},
		highlight : function(element) {
			$(element).closest('div').removeClass('has-success').addClass('has-error');
		},
		unhighlight: function(element, errorClass, validClass) {
			 $(element).closest('div').removeClass('has-error').addClass('has-success');
			 $(element).closest('div').find('.help-block').html('');
		}
	});
	
	
});


$(document).ready(function(){
	
	$("#login-form").validate({
		submitHandler : function(e) {
		    $(form).submit();
		},
		rules : {
			name : {
				required : true
			},
			
			password : {
				required : true
			},
			confirm_password : {
				required : true,
				equalTo: "#password"
			}
		},
		messages : {
			name : {
				required : "Please enter Username"
			},
		
			password : {
				required : "Please enter Password"
			}
		
		},
		errorPlacement : function(error, element) {
			$(element).closest('div').find('.help-block').html(error.html());
		},
		highlight : function(element) {
			$(element).closest('div').removeClass('has-success').addClass('has-error');
		},
		unhighlight: function(element, errorClass, validClass) {
			 $(element).closest('div').removeClass('has-error').addClass('has-success');
			 $(element).closest('div').find('.help-block').html('');
		}
	});
	
	
});