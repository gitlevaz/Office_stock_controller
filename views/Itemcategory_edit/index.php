<div class="row">
<div class="col-sm-2 col-md-2">
	<div class="row"><div class="col-sm-12 col-md-12"><a href="<?php ROOT?>Itemcategory_home" class="backButton"><i class="fa fa-arrow-circle-left" aria-hidden="true" style="margin-right:2%"></i>Back</a></div></div>
	<?php
	include 'views/common/itemcategory_right.php';
	?>	
</div>
<div class="col-sm-10 col-md-10">
    <div class="panel panel-info">
	  <div class="panel-heading"><h1><i class="fa fa-pencil" aria-hidden="true" style="margin-right:0.5%"></i>Edit Itemcategory</h1></div>
	  <div class="panel-body">
	<form action="<?php echo ROOT?>Itemcategory_edit/edit" id="" class="customer_form" data-parsley-validate=""> 
	 <input type="hidden" value="" class="hidden_val1" name="hidden_val1">
	 <div class="row">
		 	<div class="col-sm-6 col-md-6">
				 <input type="text" class="form-control ed_val_1" name="val_1" placeholder="Category" required="">
		 	</div>
		 	<div class="col-sm-6 col-md-6">
		 	</div>
	 </div>
	 <div class="row">
		<div class="col-sm-6 col-md-6">
		<div id="msg_box"></div>
		<input type="submit" value="Save" class="btn btn-primary btn-block">
		</div>
		<div class="col-sm-6 col-md-6"></div>
	 </div>
	</form>
	</div>
	</div>

	<div class="row" id="container">
	<div class="edit_animation"></div>
<!-- 		<ul class="pagination">
		</ul> -->
        <div class="col-sm-12 col-md-12 pagin">
        	
        </div>
	</div>
</div>
</div>