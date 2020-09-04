<div class="row">
<div class="col-sm-2 col-md-2">
	<div class="row"><div class="col-sm-12 col-md-12"><a href="<?php ROOT?>PayHome" class='backButton'><i class="fa fa-arrow-circle-left" aria-hidden="true" style="margin-right:2%"></i>Back</a></div></div>
	<?php
	include 'views/common/Employee_right.php';
	?>	
</div>
<div class="col-sm-10 col-md-10">
    <div class="panel panel-info">
	  <div class="panel-heading"><h1><i class="fa fa-pencil" aria-hidden="true" style="margin-right:0.5%"></i>Edit Employees</h1></div>
	  <div class="panel-body">
	<form action="<?php echo ROOT?>Stockitmes_edit/edit" id="" class="form_main" data-parsley-validate=""> 
	 <input type="hidden" value="" class="hidden_val1" name="hidden_val1">
	 <div class="row">
		 	<div class="col-sm-6 col-md-6">
		 	     <input type="text" class="form-control ed_val_12 itme_code" name="val_12" placeholder="Item code" required="">
		 	     <input type="text" class="form-control ed_val_1" name="val_1" placeholder="Itme Name" required="">
				 <input type="text" class="form-control ed_val_2" name="val_2" placeholder="Model">
				 <input type="number" class="form-control ed_val_3" name="val_3" placeholder="Cost Price" numberonly>
				 <input type="number" class="form-control ed_val_4" name="val_4" placeholder="Last Price" numberonly>
				 <input type="number" class="form-control ed_val_5" name="val_5" placeholder="Re Order Limit" numberonly>
		 	</div>
		 	<div class="col-sm-6 col-md-6">
		 		 <select class="form-control ed_val_6" name="val_6" id="category">
		 		       <option value="0">-Select Category-</option>
		 		 	<?php
		 		 	  foreach ($this->cats as $value) {
		 		 	  ?>
		 		 	  <option value="<?php echo $value['id']?>"><?php echo $value['category_name']?></option>
		 		 	  <?php
		 		 	  }
		 		 	?>
		 		 </select>
		 		 <select class="form-control ed_val_7" name="val_7" id="subcategory">
		 		 	<option value="0">-Select Sub Category-</option>
		 		 </select>
		 		 <div class="row">
		 		 	<div class="col-md-4">
						 <select class="form-control ed_val_8 unit_in" name="val_8" required="">
						   				<option value="">-Select Unit-</option>
						   				<option>Tablets</option>
						   				<option>Capsules</option>
						   				<option>Tubes</option>
		                                <option>Grms</option>
		                                <option>Cup</option>
		                                <option>Gal</option>
		                                <option>Jar</option>
		                                <option>Kg</option>
		                                <option>mg</option>
		                                <option>ml</option>
		                                <option>Ltr</option>
		                                <option>Pkts</option>
		                                <option>Packs</option>
		                                <option>Nos</option>
		                                <option>Cans</option>
		                                <option>Tins</option>
		                                <option>T_pac</option>
		                                <option>Tub</option>
		                                <option>Boxes</option>
		                                <option>Cases</option>
		                                <option>Glass Bots</option>
		                                <option>Ganis</option>
		                                <option>Pet Bots</option>
		                                <option>Satches</option>
		                                <option>Bndls</option>
		                                <option>Bottle</option>
		                                <option>Blister Pack</option>
		                                <option>Bars</option>
		                                <option>Pots</option>
		                                <option>Portions</option>
		                                <option>Pail</option>
		                 </select>
		 		    </div>
		 		 	<div class="col-md-4">
						 <select class="form-control ed_val_13 issueas" name="val_13">
						   				<option value="">-Issue as-</option>
						   				<option>Tablets</option>
						   				<option>Capsules</option>
						   				<option>Tubes</option>
		                                <option>Grms</option>
		                                <option>Cup</option>
		                                <option>Gal</option>
		                                <option>Jar</option>
		                                <option>Kg</option>
		                                <option>mg</option>
		                                <option>ml</option>
		                                <option>Ltr</option>
		                                <option>Pkts</option>
		                                <option>Packs</option>
		                                <option>Nos</option>
		                                <option>Cans</option>
		                                <option>Tins</option>
		                                <option>T_pac</option>
		                                <option>Tub</option>
		                                <option>Boxes</option>
		                                <option>Cases</option>
		                                <option>Glass Bots</option>
		                                <option>Ganis</option>
		                                <option>Pet Bots</option>
		                                <option>Satches</option>
		                                <option>Bndls</option>
		                                <option>Bottle</option>
		                                <option>Blister Pack</option>
		                                <option>Bars</option>
		                                <option>Pots</option>
		                                <option>Portions</option>
		                                <option>Pail</option>
		                 </select>
		 		 	</div>
		 		 	<div class="col-md-4">
		 		 		<input type="number" class="form-control ed_val_14 qty_in" name="val_14" placeholder="Quantity" numberonly>
		 		 	</div>
		 		 </div>
				 <input type="number" class="form-control ed_val_9" name="val_9" placeholder="Opening Bal" numberonly>
				 <input type="number" class="form-control ed_val_10" name="val_10" placeholder="Selling Price" numberonly>
				 <input type="number" class="form-control ed_val_11" name="val_11" placeholder="Re Order Level" numberonly>

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
		<div class="container">
		<div class="row">
			<div class="col-sm-4 col-md-4">
			<input type="text" placeholder="keyword" class="search_key"> <label><div id="msg_box"></div>
				<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
			</div>
			<div class="col-sm-4 col-md-4">
			</div>
			<div class="col-sm-4 col-md-4">		
			</div>
		</div>

	
	
	

		<div class="row">
        <div class="pagin col-sm-12 col-md-12">
        	
        </div>
        </div>
        </div>
	</div>
</div>
</div>