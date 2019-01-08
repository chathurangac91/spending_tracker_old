$(document).ready(function(){

	$(document).on('keyup', 'input[name="reset_email"]', function(){
		$('#email_error').html('');
	});

	$(document).on('click', '#reset_pw', function(){
		$('#reset_pw_form').submit();
	});

	// Reset Password
	$(document).on('submit', '#reset_pw_form', function(e){
		
		e.preventDefault();
		$('#reset_loading').show();
		var formData = new FormData($(this)[0]);

	    $.ajax({
	        type: 'POST',
	        url: base_url+'login/forgot_password',
	        data: formData,
	        cache: false,
	        contentType: false,
	        processData: false,
	        success: function (data){
	            var obj = JSON.parse(data);
	            $('#reset_loading').hide();
	            $('#email_error').html(obj.email_error);
            	
	            if(!obj.error){
	            	$('#reset_pw_modal').modal('hide');
	            	alert('New Password sent to your email. Please check your inbox.');
	            }
	        },
	        error: function () {
	        	$('#reset_loading').hide();
	        	$('#reset_pw_modal').modal('hide');
	        	alert('Something went wrong. Please try again !');
            }
	    });
	});

	// signup modal open. Get programmes and hostels
	$(document).on('click', '#sign_open', function(e){

		e.preventDefault();
		var programme_list = [];
		var hostel_list = [];

		$.ajax({
	        type: 'get',
	        url: base_url+'login/get_data',
	        cache: false,
	        contentType: false,
	        processData: false,
	        async: false,
	        success: function (data){
	            var obj = JSON.parse(data);

	            if(!obj.error){

	            	programme_list = obj.programmes;
	            	hostel_list = obj.hostels;

	            	// Set programmes
	            	var html = '<select class="form-control" name="programme">';
			    	html = html+'<option value="">- Select -</option>';
			    	
			    	for (var i = 0; i < programme_list.length; i++) {
			    		html = html+'<option value="'+programme_list[i].id+'">'+programme_list[i].name+'</option>';
			    	}
		            
		            html = html+'</select>';
		            html = html+'<small id="programme" class="help-block"></small>';
		          
		            $('.pro-area').html(html);

		            // Set hostels
	            	var html = '<select class="form-control" name="hostel">';
			    	html = html+'<option value="">- Select -</option>';
			    	
			    	for (var i = 0; i < hostel_list.length; i++) {
			    		html = html+'<option value="'+hostel_list[i].id+'">'+hostel_list[i].name+'</option>';
			    	}
		            
		            html = html+'</select>';
		            html = html+'<small id="hostel" class="help-block"></small>';
		          
		            $('.hostel-area').html(html);

		            // Open Modal
			    	$('#sign_modal').modal('show');

	            }else{
	            	alert('Something went wrong. Please try again !');
	            }
	        },
	        error: function () {
	        	alert('Something went wrong. Please try again !');
            }
	    });
	});

	// Student Sign up
	$(document).on('submit', '#sign_form', function(e){
		
		e.preventDefault();
		$('#sign_loading').show();
		var formData = new FormData($(this)[0]);

	    $.ajax({
	        type: 'POST',
	        url: base_url+'login/sign_up',
	        data: formData,
	        cache: false,
	        contentType: false,
	        processData: false,
	        success: function (data){
	            var obj = JSON.parse(data);

	            $('#sign_loading').hide();

	            $('#first_name').html(obj.first_name);
	            $('#last_name').html(obj.last_name);
	            $('#index_number').html(obj.index_number);
	            $('#email').html(obj.email);
	            $('#gender').html(obj.gender);
	            $('#date_of_birth').html(obj.date_of_birth);
	            $('#mobile').html(obj.mobile);
	            $('#study_mode').html(obj.study_mode);
	            $('#academic_year').html(obj.academic_year);
	            $('#programme').html(obj.programme);
	            $('#title').html(obj.title);
	            $('#middle_name').html(obj.middle_name);
	            $('#maiden_name').html(obj.maiden_name);
	            $('#nick_name').html(obj.nick_name);
	            $('#emergency_no').html(obj.emergency_no);
	            $('#address_1').html(obj.address_1);
	            $('#postal_box').html(obj.postal_box);
	            $('#district').html(obj.district);
	            $('#region').html(obj.region);
	            $('#hostel').html(obj.hostel);
	            $('#profile_picture').html(obj.profile_picture);
            	
	            if(!obj.error){
	            	$('#sign_form').trigger("reset");
	            	$('#sign_modal').modal('hide');
	            	alert('Succsessfully Registered ! Login credentials sent to your email.');
	            }
	        },
	        error: function () {
	        	$('#sign_loading').hide();
	        	$('#sign_modal').modal('hide');
	        	alert('Something went wrong. Please try again !');
            }
	    });
	});

	$(document).on('keyup', 'input[name="academic_year"]', function(){
		if($(this).val().length == 4){
			$(this).val($(this).val()+'/');
		}
	});

	$('input[name="academic_year"]').on('keypress', function(key) {
	    if(key.charCode < 48 || key.charCode > 57) return false;
	});
});
