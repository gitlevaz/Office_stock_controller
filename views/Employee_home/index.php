<div class="row">
<div class="col-sm-2 col-md-2">
	<div class="row">
	  	<div class="col-sm-12 col-md-12">
	<a href="<?php ROOT?>PayHome" class="backButton"><i class="fa fa-arrow-circle-left" aria-hidden="true" style="margin-right:2%"></i>
	<strong> Back</strong></a></div></div>
	<div class="row">
    <div class="col-sm-12 col-md-12">
	<?php
	include 'views/common/Employee_right.php';
	?>
    </div>
	</div>
	</div>	
<div class="col-sm-10 col-md-10">
	<div class="panel panel-info">
	  <div class="panel-heading"><h1><i class="fa fa-user-plus" aria-hidden="true" style="margin-right:0.5%"></i>Add Employee</h1></div>
	  <div class="panel-body">
		<form action="<?php echo ROOT?>Employee_home/create" id="" class="customer_form" data-parsley-validate=""> 
		 <div class="row">
			 	<div class="col-sm-6 col-md-6">
			 	    <input type="text" class="form-control index customers" name="" placeholder="Employee No" disabled="">
					 <input type="text" class="form-control" name="val_1" placeholder="first name" required="">
					 <input type="text" class="form-control" name="val_3" placeholder="address" >
					 <input type="email" class="form-control" name="val_5" placeholder="email" required="" value="test@testmail.com">
					 <input type="text" class="form-control" name="val_7" placeholder="Basic salary" >
					 <input type="text" class="form-control" name="val_9" placeholder="Account Number " >
			 	</div>
			 	<div class="col-sm-6 col-md-6">
					 <input type="text" class="form-control" name="val_2" placeholder="last name">
					 <input type="text" class="form-control" name="val_4" placeholder="contact No" >
					 <input type="number" class="form-control age_year_set" name="val_10" placeholder="age years" numberonly>
					 <input type="number" class="form-control" name="val_6" placeholder="Job Category" >
					 <input type="number" class="form-control" name="val_8" placeholder="Joined date " >
					 <input type="number" class="form-control" name="val_11" placeholder="Bank Name" >

					 <span><strong>Gender</strong></span>
					 <label class="radio-inline"><input type="radio" name="val_14" class="male" value="m" checked>Male</label>
					 <label class="radio-inline"><input type="radio" name="val_14" class="female" value="f">Female</label>
			 	</div>
		 </div>
		 <div class="row">
		 <div class="col-sm-6 col-md-6"></div>
		 <div class="col-sm-6 col-md-6">
			<div id="msg_box"></div>
			<input type="submit" value="Create" class="btn btn-primary btn-block">
		 </div>
		 </div>
		</form>
	 </div>
	</div>	
</div>
</div>