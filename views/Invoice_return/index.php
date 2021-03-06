<div class="row">
<div class="col-sm-2 col-md-2">
	<div class="row"><div class="col-sm-12 col-md-12"><a href="<?php ROOT?>Pos_home" class="backButton"><i class="fa fa-arrow-circle-left" aria-hidden="true" style="margin-right:2%"></i>Back</a></div></div>
	<?php
	include 'views/common/invoicereturn_right.php';
	?>	
</div>
<div class="col-sm-10 col-md-10">
	<div class="panel panel-info">
	  <div class="panel-heading"><h1>Add Invoice return</h1></div>
	  <div class="panel-body">
	<form action="" id="" class="form_main" data-parsley-validate=""> 
	 <div class="row">
		 	<div class="col-sm-6 col-md-6">
				 <input type="text" class="form-control index invoicertnmaster" name="val_1" placeholder="invoice Number" disabled="">
				 <select id="customer_data" data-options="customer customers first_name id"  class="customer form-control getdata_options" name="val_2" required="">
				 </select>
		 	</div>
		 	<div class="col-sm-6 col-md-6">
				 <input type="text" class="form-control datepicker" name="val_3" placeholder="date" required="">
				 <select id="invoice_data" class="invoice form-control" name="val_4" required="">
				 </select>
		 	</div>
	 </div>
	</form>
	</div>
	</div>

<div class="panel panel-default">
  <div class="panel-body">
    <div class="table-responsive" id="grncontent">
	  <table class="table" id="maintable">
	    <thead>
	      <tr>
	        <th>Item Code</th>
	        <th>Item Name</th>
	        <th>Unit Price</th>
	        <th>Qty</th>
	        <th></th>
	        <th>Amount</th>
	        <th></th>
	      </tr>
	    </thead>
	    <tbody>
	      <tr class="info" id="maintabletop">
	      	<form action="<?php echo ROOT?>Substore_returns/addreturn_sub" id="" class="form_sub" data-parsley-validate="">
	        <td><input type="text" class="val_1 form-control" style="width:80px" required="" name="val_1"></td>
	        <td>				 
	        	<select id="stockitems" class="stockitems val_2 form-control" name="val_2" required=""></select>
			</td>
	        <td><input type="number" class="val_3 form-control" name="val_3" style="width:100px;" numberonly readonly></td>
	       	<td><input type="number" min="1" numberonly required="" class="val_4 form-control" name="val_4" style="width:100px;" readonly></td>
	        <td><input type="text" readonly class="val_5 form-control" style="width:60px;"></td>
	        <td><input type="text" class="val_8 form-control" name="val_8" numberonly></td>
	        <td><input type="submit" class="btn btn-info" value="Add"></td>
	        </form>
	      </tr>


	    </tbody>
	  </table>
	</div>
	<label>Total&nbsp</label><span class="number_format" id="total_val">0.00</span>
	<!-- <input type="text" readonly="" id="total_val" class="number_format" value="0.00"> -->
	<div class="row">
	  	<div class="col-sm-6 col-md-6"></div>
	  	<div class="col-sm-6 col-md-6">
		<button type="button" class="btn btn-primary btn-block" id="save_btn" >Save Return Note</button>
		<div id="msg_box"></div></div>
	</div>
  </div>
</div>

</div>
</div>
<script type="text/javascript">
</script>
