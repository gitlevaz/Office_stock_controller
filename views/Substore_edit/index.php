<div class="row">
<div class="col-sm-2 col-md-2">
	<div class="row"><div class="col-sm-12 col-md-12"><a href="<?php ROOT?>Substore_home" class="backButton"><i class="fa fa-arrow-circle-left" aria-hidden="true" style="margin-right:2%"></i>Back</a></div></div>
	<?php
	include 'views/common/newsubstore_right.php';
	?>	
</div>
<div class="col-sm-10 col-md-10">
	<div class="panel panel-info">
	  <div class="panel-heading"><h1><i class="fa fa-pencil" aria-hidden="true" style="margin-right:0.5%"></i>Edit Substore</h1></div>
	  <div class="panel-body">
	<form action="<?php echo ROOT?>Substore_edit/edit" id="" class="main_form" data-parsley-validate=""> 
		 <input type="hidden" value="" class="hidden_val1" name="hidden_val1">
	 <div class="row">
		 	<div class="col-sm-6 col-md-6">
				 <input type="text" class="form-control" name="val_1" placeholder="Sub Store(Rep) Code" disabled>
				 <input type="text" class="form-control ed_val_1" name="val_2" placeholder="Sub Store(Rep) Name" required="">
				 <input type="text" class="form-control ed_val_2" name="val_3" placeholder="Address 1" >
				 <input type="text" class="form-control ed_val_3" name="val_4" placeholder="Telephone" >
				 <input type="text" class="form-control ed_val_4" name="val_5" placeholder="Contact Person" >
				 <input type="number" class="form-control ed_val_5" name="val_6" placeholder="Credit Limit" numberonly>
				 <input type="text" class="form-control ed_val_6" name="val_7" placeholder="Bank Name">
		 	</div>
		 	<div class="col-sm-6 col-md-6">
				 <input type="text" class="form-control datepicker ed_val_7" name="val_8" placeholder="Added Date" required="">
				 <input type="text" class="form-control ed_val_8" name="val_9" placeholder="Branch Name" required="">
				 <input type="text" class="form-control ed_val_9" name="val_10" placeholder="Address 2">
				 <input type="email" class="form-control ed_val_10" name="val_11" placeholder="Email" >
				 <input type="text" class="form-control ed_val_11" name="val_12" placeholder="Contact No">
				 <input type="number" class="form-control ed_val_12" name="val_13" placeholder="Opening Balance" numberonly>
				 <input type="text" class="form-control ed_val_13" name="val_14" placeholder="Account No">
		 	</div>
	 </div>
	 <div class="row">
		<div class="col-sm-6 col-md-6"></div>
		<div class="col-sm-6 col-md-6">
		<input type="submit" value="Save" class="btn btn-primary btn-block">
		<div id="msg_box"></div>
		</div>
	 </div>
	</form>
    </div>
    </div>

	<div class="row" id="container">
	<div class="edit_animation"></div>
<!-- 		<ul class="pagination">
		</ul> -->
        <div class="pagin col-sm-12 col-md-12">
        	
        </div>
	</div>

</div>
</div>
