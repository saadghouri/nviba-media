<?php $path = "assets/uploads/" . $eventInfo['image_path']; 
$getUrl = explode("/", $_SERVER['REQUEST_URI']);
$userData = $this->session->userdata('logged_in');?>

<div class="col-md-12">
	
	<div class="col-md-9">
		<h3><?php echo $eventInfo['name']; ?></h3>
		<p><strong><u>Event Description</u></strong><br><?php echo $eventInfo['description']; ?></p>
		<p><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> <strong>Start Date: </strong> <?php echo  $eventInfo['start_date']; ?></p>
		<p><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> <strong>End Date: </strong> <?php echo  $eventInfo['end_date']; ?></p>
		<p><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> <strong>Location: </strong> <?php echo $eventInfo['address']; ?></p>
		
	</div>
	<div class="col-md-3">
		<div class="row"><img class="img-responsive " src="<?php echo base_url() . $path ?>"></div><br>
		<div class="row registered_user_title"><strong><u>Registered Users</u></strong></div>	
		<?php 
			if(empty($registeredMembers)){?>
				<div class="row"> No registered members </div>	
			<?php
			}
			else
			{
				foreach($registeredMembers as $members):?>
					<div class="row"> <?php echo $members['fname'] . " " . $members['lname'];?></div>
			<?php endforeach; }?>
			<!-- } -->
				
	</div>
</div>


<div class="col-md-12">
	<!-- Register for event !-->	
	<div class="col-md-9">
		<form id="register_event">
			<input type="hidden" class="form-control" id="eventId" name="event_id" value="<?php echo $getUrl[4]; ?>">
			<input type="hidden" class="form-control" id="userId" name="user_id" value="<?php echo $userData['id']; ?>">
			<div class="form-group">
				<button id="registrationButton" class="btn btn-danger form-control" type="submit" style="display:block"name="name">Register Now</button>
			</div>
		</form>
	</div>
</div>



<script>

	$(document).ready(function(){
		$("#register_event").submit(function(e){
			e.preventDefault();
			var form_data = $('form#register_event').serializeArray();
			$.ajax({
				url: '<?php echo base_url(); ?>' + 'events/checkUserRegisteration',
				type: 'POST',
				data: form_data,
				success: function(data){
					console.log(data);
					var r = JSON.parse(data);
					if(r.error_code == 0){
						$('.bg-success').hide();
						$('.bg-danger').html(r.message);
						$('.bg-danger').show();
					}
					if(r.error_code == 1){
						$('.bg-danger').hide();
						$('.bg-success').html(r.message);
						$('.bg-success').show();
					}

				},
				error: function(data){
					console.log(data);
				}
			});
		});
	});
</script>