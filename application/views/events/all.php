<?php 
$userData = $this->session->userdata('logged_in'); 
// $path = "assets/uploads/" . $image_path; 
?>
<div class="col-md-12">
	<div class="col-md-4">
		<h3> List of events </h3>
	</div>
</div>


<div class="row"><br><br></div>
<?php 
if(!empty($eventData)){
foreach($eventData as $data):?> 

<div class="row event_details">	
	<a href="<?php echo base_url()?>events/show/<?php echo $data['id'];?>" >
		<div class="col-md-12">
			<div class="col-md-3">
				<?php $path = "assets/uploads/" . $data['image_path']; ?>
				<img class="img-responsive " src="<?php echo base_url() . $path ?>">
			</div>
			<div class="col-md-9">
				<p class="event_name"><strong><?php echo $data['name']; ?></strong> - <span class="eventAuthor">Event Created By <?php echo $data['fname'] . $data['lname']?></span></p>
				<p><?php echo substr($data['description'], 0, 230) . " ... "?></p>
				<p><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> <strong>Start Date: </strong> <?php echo  $data['start_date']; ?></p>
				<p><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> <strong>End Date: </strong> <?php echo  $data['end_date']; ?></p>
				<p><span class="glyphicon glyphicon-map-marker" aria-hidden="true"> <strong>Location: </strong> <?php echo $data['address']; ?>
			</div>
		</div>
	</a>
</div>
<br>
<?php endforeach;}else{echo $this->session->flashdata('danger');}?>