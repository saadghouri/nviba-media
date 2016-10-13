
<form id="user_signup">
	<div class="form-group">
		<label for="exampleInputFirstName">First Name</label>
		<input type="text" class="form-control" id="exampleInputFirstName" name="fname" placeholder="First Name">
	</div>

	<div class="form-group">
		<label for="exampleInputLastName">Last Name</label>
		<input type="text" class="form-control" id="exampleInputLastName" name="lname" placeholder="Last Name">
	</div>

	<div class="form-group">
		<label for="exampleInputEmail1">Email address</label>
		<input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Email">
	</div>

	<div class="form-group">
		<label for="exampleInputPassword1">Password</label>
		<input type="password" class="password form-control" id="exampleInputPassword1" name="password" placeholder="Password">
		<span class="show-error" style="color:red" hidden><div id="messages"></div></span>
	</div>
	<div class="clearfix form-group">
        <label class="form-label col-sm-2">Password Strength</label>
        <div class="col-sm-8" id="example-progress-bar-container">
 
        </div>
    </div>
	
	<div class="form-group">	
		<input type="hidden" name="date_created "value="<?php echo date('Y-m-d'); ?>">
	</div>
	
	<button type="submit" class="btn btn-default">Submit</button>
	<a href="<?php echo base_url(); ?>user/login" class="pull-right">Sign in</a>
</form>

<script src="<?php echo base_url();?>assets/js/app.js"></script>

<script>

	$(document).ready(function(){
		$('#user_signup').submit(function(e){
			e.preventDefault();
			var form_data = $('form#user_signup').serializeArray();
			$.ajax({
				url: '<?php echo base_url(); ?>' + 'user/getUserRegistrationFormValues',
				type: 'POST',
				data: form_data,
				success: function(data) {
					var r = JSON.parse(data);
					if(r.error_code == 0){
			        	$(".bg-success").hide();
			        	$(".bg-danger").html(r.message);
			        	$(".bg-danger").show();
			        }

			        if(r.error_code == 1){
			        	$(".bg-danger").hide();
			        	$(".bg-success").html("User successfully added");
			        	$(".bg-success").show();
			        	$("#user_signup")[0].reset();
			        }

				},
				error: function(){
					console.log(data);
				}
			});
		});

		$('#exampleInputPassword1').strengthMeter('progressBar', {
	        container: $('#example-progress-bar-container')
	    });
	});
</script>