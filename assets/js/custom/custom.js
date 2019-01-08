$(document).ready(function(){

	var current_email = $('input[name="email"]').val();

	$(document).on('change', 'input[name="email"]', function(){
		
		$('.pDiv').show();
		if(current_email != $(this).val()){

			$.ajax({
		        type: 'POST',
		        url: base_url+'login/check_email',
		        data: {email: $(this).val()},
		        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
		        success: function (data){
		            var obj = JSON.parse(data);

		            if(obj.error){
		            	$('.pDiv').hide();
		            	alert('This email already taken !');
		            }else{
		            	$('.pDiv').show();
		            }
		        }
		    });
		}
	});
});