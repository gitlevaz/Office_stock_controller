<div class="row">
<div class="col-sm-2 col-md-2">
	<div class="row"><div class="col-sm-12 col-md-12"><a href="<?php ROOT?>Store_home" class="backButton"><i class="fa fa-arrow-circle-left" aria-hidden="true" style="margin-right:2%"></i>Back</a></div></div>
	<div class="row">
    <div class="col-sm-12 col-md-12">
	<?php
	include 'views/common/stock_right.php';
	?>
	</div>
	</div>	
</div>
<div class="col-sm-10 col-md-10">
	<div class="panel panel-info">
	  <div class="panel-heading"><h1><i class="fa fa-archive aria-hidden=" true"="" style="margin-right:0.5%"></i>New Stock items</h1></div>
	  <div class="panel-body">
	<form action="<?php echo ROOT?>Stockitmes_home/create" id="" class="form_main" data-parsley-validate=""> 
	 <div class="row">
		 	<div class="col-sm-6 col-md-6">
		 	     <input type="text" class="form-control itme_code" name="val_12" placeholder="Item code">
		 	     <input type="text" class="form-control" name="val_1" placeholder="Item Name" required="">
				 <input type="text" class="form-control" name="val_2" placeholder="Model">
				 <input type="number" class="form-control" name="val_3" placeholder="Cost Price" numberonly>
				 <input type="number" class="form-control" name="val_4" placeholder="Last Price" numberonly>
				 <input type="number" class="form-control" name="val_5" placeholder="Re Order Limit" numberonly>
		 	</div>
		 	<div class="col-sm-6 col-md-6">
		 		 <select class="form-control" name="val_6" id="category" required="">
		 		      <option value="0">-Select Category-</option>
		 		 	<?php
		 		 	  foreach ($this->cats as $value) {
		 		 	  ?>
		 		 	  <option value="<?php echo $value['id']?>"><?php echo $value['category_name']?></option>
		 		 	  <?php
		 		 	  }
		 		 	?>
		 		 </select>
		 		 <select class="form-control" name="val_7" id="subcategory" required="">
		 		 	<option value="0">-Select Sub Category-</option>
		 		 </select>
		 		 <div class="row">
		 		 	<!-- <div class="col-md-4">
						 <select class="form-control unit_in" name="val_8" required="">
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
		 		    </div> -->
		 		 	<!-- <div class="col-md-4"> -->
						 <!-- <select class="form-control issueas" name="val_13">
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
		 		 	</div> -->
		 		 	<div class="col-md-12">
		 		 		<input type="number" class="form-control qty_in" name="val_14" placeholder="Quantity" numberonly>
		 		 	</div>
		 		 </div>
				 <input type="number" class="form-control" name="val_9" placeholder="Opening Bal" numberonly>
				 <input type="number" class="form-control" name="val_10" placeholder="Selling Price" numberonly>
				 <input type="number" class="form-control" name="val_11" placeholder="Re Order Level" numberonly>

		 	</div>
	 </div>
	 <div class="row">
		<div class="col-sm-6 col-md-6"></div>
		<div class="col-sm-6 col-md-6">
		<div id="msg_box"></div>
		<input type="submit" value="Create" class="btn btn-primary btn-block">
		</div>
		</div>
	 </div>
	</form>
	</div>
	</div>
	</div>
	</div>
</div>
</div>