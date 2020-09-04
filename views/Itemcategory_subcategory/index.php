<div class="row">
<div class="col-sm-2 col-md-2">
	<div class="row"><div class="col-sm-12 col-md-12"><a href="<?php ROOT?>Itemcategory_home" class="backButton"><i class="fa fa-arrow-circle-left" aria-hidden="true" style="margin-right:2%"></i>Back</a></div></div>
	<?php
	include 'views/common/itemsubcategory_right.php';
	?>	
</div>
<div class="col-sm-10 col-md-10">
	<div class="panel panel-info">
	  <div class="panel-heading"><h1><i class="fa fa-suitcase" aria-hidden="true" style="margin-right:0.5%"></i>Add Item subcategory</h1></div>
	  <div class="panel-body">
	<form action="<?php echo ROOT?>Itemcategory_subcategory/create" id="" class="category_form" data-parsley-validate=""> 
		<input type="hidden" value="" class="hidden_val1" name="hidden_val1">
		<div class="row">
		 	<div class="col-sm-6 col-md-6">
		 	     <select class="form-control" name="val_1" placeholder="Category" required="">
		 	     <?php
		 	     $val=$this->cats;
		 	     foreach ($val as $value) {
		 	     ?>
		 	     <option value="<?php  echo $value['id']?>"><?php  echo $value['category_name']?></option>
		 	     <?php
		 	     }
		 	     ?>
		 	     </select>
		 		 <input type="text" class="form-control" name="val_2" placeholder="Category" required="">
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
</div>
</div>