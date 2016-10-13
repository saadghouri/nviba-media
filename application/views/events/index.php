

<?php echo $this->session->flashdata('success');
$userData = $this->session->userdata('logged_in');?>
<h3> Create a new event </h3>
<form id="new_event" method="POST" action="events/verifyevent" enctype="multipart/form-data">

	<div class="form-group">
		<label for="eventName">Name</label>
		<input type="text" class="form-control" id="eventName" name="name" placeholder="Name" required>
	</div>

	<div class="form-group">
		<label for="eventDescription">Description</label>
		<textarea class="form-control" id="eventDescription" name="description" rows="5" placeholder="Description" required></textarea>
	</div>

	<div class="row">
		<div id="start_date" class="col-md-6 input-append date form_datetime form-group">
			<label for="startDate">Start Date</label>
			<input class="form-control" id="startDate" name="start_date" type="text" readonly required>
			<span class="add-on"><i class="icon-th"></i></span>
		</div>

		<div class="col-md-6 input-append date form_datetime2 form-group">
			<label for="endDate">End Date</label>
			<input class="form-control" id="endDate" name="end_date" type="text" readonly required>
			<span class="add-on"><i class="icon-th"></i></span>
		</div>
	</div>

	<div class="form-group">
		<label for="eventAddress">Address</label>
		<input type="text" class="form-control" id="eventAddress" name="address" placeholder="Address" required>
	</div>

	<div class="form-group">
		<label for="uploadImage">Upload Image</label>
		<input class="form-control" id="uploadImage" name="image_path" type="file" required>
	</div>

	<div class="form-group">
		<input type="hidden" class="form-control" id="userId" name="user_id" value="<?php echo $userData['id']; ?>">
	</div>

	<button type="submit" class="btn btn-default">Submit</button> 
</form>



 
<script type="text/javascript">
    $(".form_datetime").datetimepicker({
        format: "dd-MM-yyyy hh:ii:ss"
    });


     $(".form_datetime2").datetimepicker({
        format: "dd-MM-yyyy hh:ii:ss"
    });


     $(document).ready(function(){
     	
	    var endDate;
	    var newEndDate;
	    var endDateTimeStamp;
	    var startDate;
	    var newStartDate;
	    var startDateTimeStamp;
	   

	    $('#startDate').change(function(){
	    	startDate = document.getElementById("startDate").value;
	    	newStartDate = new Date(startDate);
	    	startDateTimeStamp = newStartDate.getTime();
	    	
	    	var currentDate = Date.now();
	    	if(startDateTimeStamp < currentDate)
		    {
		    	$('.bg-danger').html("Start date cannot be less then current date.");
		    	document.getElementById("startDate").value = "";
		    }
		    else{
		    	$('.bg-danger').hide();
		    }
	    });

	    $("#endDate").change(function (){
	    	endDate = document.getElementById("endDate").value;
	    	newEndDate = new Date(endDate);
	    	endDateTimeStamp = newEndDate.getTime();
		    if (startDateTimeStamp > endDateTimeStamp) {
		    	$('.bg-danger').show();
		        $('.bg-danger').html("End date cannot be less then start date.");
		        document.getElementById("endDate").value = "";
		    }
		    else
		    {
		    	$('.bg-danger').hide();
		    }
		});

	   	// function validateForm(){
	   		$('#new_event').submit(function(e){
			e.preventDefault();
			$(".bg-danger").hide();
			$(".bg-success").hide();
	    	
	    	if($("#eventName").val() == null ||  $("#eventName").val() == ""){
	    		$(".bg-danger").html("Enter the name of the event.");
	    		$(".bg-danger").show();
	    	}
	    	else if($("#eventDescription").val() == null ||  $("#eventDescription").val() == ""){
	    		$(".bg-danger").html("Enter the description of the event.");
	    		$(".bg-danger").show();
	    	}
	    	else if($("#eventAddress").val() == null ||  $("#eventAddress").val() == ""){
	    		$(".bg-danger").html("Enter the location of the event.");
	    		$(".bg-danger").show();
	    	}
	    	else if(($("#startDate").val() ==null || $("#endDate").val() == null) ||  ($("#startDate").val() == "" || $("#endDate").val() == "")){
	    		$(".bg-danger").html("The start date or end date of the event cannot be empty");
	    		$(".bg-danger").show();
	    	}
	    	else{
	    		$(".bg-danger").hide();
	    		$('#new_event').unbind().submit();
	    	}
	    	
	    });
	   // }
	// 	$('#new_event').submit(function(e){
	// 		e.preventDefault();
	// 		var form_data = $('form#new_event').serializeArray();
	// 		// var file_data = $('#uploadImage').prop('files')[0]; 
	// 		// console.log(file_data);
	// 		// if(typeof file_data !== 'undefined')
	// 		// {
	// 		// 	form_data.push({name: 'image_path', value: file_data.name});
	// 		// }
	// 		if(form_data[2]['value'] != "" || form_data[3]['value'] != "")
	//     	{	
 //    			form_data[2]['value'] = startDateTimeStamp.toString(); 
	// 			form_data[3]['value'] = endDateTimeStamp.toString();
	// 		}
	// 		// console.log(form_data);
	// 		$.ajax({
	// 			url: '<?php echo base_url(); ?>' + 'event/verifyevent',
	// 			type:'POST',
	// 			processData: false,
 //     	 		contentType: false,
	// 			data: form_data,
	// 			success: function(data){
	// 				console.log(data);
					
	// 				var r = JSON.parse(data);
	// 				if(r.error_code == 0){
	// 					$(".bg-success").hide();
	// 		        	$(".bg-danger").html(r.message);
	// 		        	$(".bg-danger").show();
	// 				}
					
	// 				if(r.error_code == 1){
	// 					$(".bg-danger").hide();
	// 					$(".bg-success").html(r.message);
	// 					$(".bg-success").show();
	// 				}

	// 			},
	// 			error: function(){
	// 				console.log(data);
	// 			}
	// 		});
	// 	});
	});
</script>   
