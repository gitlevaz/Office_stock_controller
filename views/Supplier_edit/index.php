<div class="row">
<div class="col-sm-2 col-md-2">
	<div class="row">
    <div class="col-sm-12 col-md-12">
    <a href="<?php ROOT?>Inventory_home" class="backButton"><i class="fa fa-arrow-circle-left" aria-hidden="true" style="margin-right:2%"></i>Back</a> </div></div>
    <div class="row">
    <div class="col-sm-12 col-md-12">
	<?php
	include 'views/common/supplier_right.php';
	?>
    </div></div>	
</div>
<div class="col-sm-10 col-md-10">
<div class="row">
<div class="col-sm-12 col-md-12">
<div class="panel panel-info">
<div class="panel-heading"><h1><i class="fa fa-pencil" aria-hidden="true" style="margin-right:0.5%"></i>Edit Supplier</h1></div>
<div class="panel-body">
	<form action="<?php echo ROOT?>Supplier_edit/edit" id="" class="customer_form" data-parsley-validate=""> 
		 <input type="hidden" value="" class="hidden_val1" name="hidden_val1">
	 <div class="row">
		 	<div class="col-sm-6 col-md-6">
				 <input type="text" class="form-control ed_val_1" name="val_1" placeholder="first name" required="">
				 <input type="text" class="form-control ed_val_2" name="val_2" placeholder="address" required="">
				 <input type="email" class="form-control ed_val_3" name="val_3" placeholder="email" required="">
				 <input type="number" class="form-control ed_val_4" name="val_4" placeholder="credit limit" numberonly>
				 <input type="text" class="form-control ed_val_5" name="val_5" placeholder="bank Name" >
				 <input type="text" class="form-control ed_val_6" name="val_6" placeholder="payment date" numberonly>
		 	</div>
		 	<div class="col-sm-6 col-md-6">
				 <input type="text" class="form-control ed_val_7" name="val_7" placeholder="last name" required="">
				 <input type="text" class="form-control ed_val_8" name="val_8" placeholder="contact Mobile" required="">
				 <input type="text" class="form-control ed_val_9" name="val_9" placeholder="contact Land" required="">
				 <input type="number" class="form-control ed_val_10" name="val_10" placeholder="opening Balance" numberonly>
				 <input type="text" class="form-control ed_val_11" name="val_11" placeholder="account No" >
				 <input type="text" class="form-control ed_val_12" name="val_12" placeholder="Remaining before" numberonly>
		 	</div>
	 </div>
	 <div class="row">
		<div class="col-sm-6 col-md-6">
        <div id="msg_box"></div></div>
        <div class="col-sm-6 col-md-6">
		<input type="submit" value="Save" class="btn btn-primary btn-block"></div>
	 </div>
	</form>
</div>
</div>
</div>
</div>

	<div class="row" id="container">
    <div class="col-sm-12 col-md-12">
	<div class="edit_animation"></div>
<!-- 		<ul class="pagination">
		</ul> -->
        <div class="pagin">
        	
        </div></div>
	</div>
</div>
</div>
