<h3> Login </h3>

<form id="user_login"  method="POST" action="loginVerification">
	<div class="form-group">
		<label for="exampleInputEmail1">Email address</label>
		<input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Email">
	</div>

	<div class="form-group">
		<label for="exampleInputPassword1">Password</label>
		<input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
	</div>
		
	<button type="submit" class="btn btn-default">Submit</button> 
	<a href="<?php echo base_url(); ?>user/signup" class="pull-right">Sign up</a> 
</form>




<script>

$(document).ready(function(){	
	$('#user_login').submit(function(e){
		e.preventDefault();

		var form_data = $('form#user_login').serializeArray();
		$.ajax({
			url: '<?php echo base_url(); ?>' + 'user/loginVerification',
			type:'POST',
			data: form_data,
			success: function(data){
				var r = JSON.parse(data);
				if(r.error_code == 0){
					$(".bg-success").hide();
		        	$(".bg-danger").html(r.message);
		        	$(".bg-danger").show();
				}
				
				if(r.error_code == 1){
					// console.log('<?php echo base_url(); ?>');
					window.location.href = '<?php echo base_url(); ?>';
				}

			},
			error: function(){
				console.log(data);
			}
		});
	});
});

</script>