<div class="row">
<div class="col-sm-2 col-md-2">
	<div class="row"><div class="col-sm-12 col-md-12"><a href="<?php ROOT?>Store_home" class="backButton"><i class="fa fa-arrow-circle-left" aria-hidden="true" style="margin-right:2%"></i>Back</a></div></div>
	<?php
	include 'views/common/Grn_right.php';
	?>	
</div>
<div class="col-sm-10 col-md-10">
	<div class="panel panel-info">
	  <div class="panel-heading"><h1><i class="fa fa-file-text-o" aria-hidden="true" style="margin-right:0.5%"></i>Add Grn</h1></div>
	  <div class="panel-body">
	<form action="" id="" class="form_main" data-parsley-validate=""> 
	 <div class="row">
		 	<div class="col-sm-6 col-md-6">
				 <input type="text" class="form-control index grnmain" name="val_1" placeholder="grn_no" disabled="">
				 <select id="supplierr" data-options="suppliers supplier first_name id"  class="suppliers form-control getdata_options" name="val_2" required="">

				 </select>
				 <select name="val_3" class="form-control" required="">
				    <option></option>
				 	<option>Credit</option>
				 	<option>Cash</option>
				 </select>
		 	</div>
		 	<div class="col-sm-6 col-md-6">
				 <input type="text" class="form-control datepicker" name="val_4" placeholder="date" required="">
				 <input type="text" class="form-control" name="val_5" placeholder="invoice No" required="">
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
	        <!-- <th>Exp Date</th> -->
	        <th>FOC</th>
	        <th>Unit Price</th>
	        <th>Qty</th>
	        <th></th>
	        <!-- <th>Containers</th> -->
	        <th></th>
	        <th>Amount</th>
	        <th></th>
	      </tr>
	    </thead>
	    <tbody>
	      <tr class="info" id="maintabletop">
	      	<form action="<?php echo ROOT?>Grn_home/addgrn_sub" id="" class="form_sub" data-parsley-validate="">
	        <td><input type="text" class="val_1 form-control" style="width:80px" required="" name="val_1"></td>
	        <td>				 
	        	<select id="stockitems" data-options="stockitems stockitems item_name id"  class="stockitems getdata_options val_2 form-control" name="val_2" required="" style="width:80px"></select>
			</td>
			<!-- <td><input type="text" class="form-control datepicker val_9" name="val_9" placeholder="date" required="" style="width:100px;"></td> -->
			<td><input type="checkbox" name="" value="" id="foc_check"></td>
	        <td><input type="number" class="val_3 form-control" name="val_3" style="width:100px;" readonly></td>
	       	<td><input type="number" min="1" numberonly required="" class="val_4 form-control" name="val_4" style="width:100px;" readonly></td>
	        <td><input type="text" readonly class="val_5 form-control" style="width:50px;"></td>
	        <!-- <td><input type="text" class="val_6 form-control" name="val_6" style="width: 100px;"></td> -->
	       	<td>
				<select class="val_7 form-control" name="val_7">
                                <option value="0" selected="">Type</option>
                                <option>Packs</option>
                                <option>Pkts</option>
                                <option>Jar</option>
                                <option>Nos</option>
                                <option>Cans</option>
                                <option>Tins</option>
                                <option>Tub</option>
                                <option>Boxes</option>
                                <option>Cases</option>
                                <option>Glass Bots</option>
                                <option>Ganis</option>
                                <option>Pet Bots</option>
                                <option>Satches</option>
                                <option>Blister Pack</option>
                                <option>Bars</option>
                                <option>Pots</option>
                                <option>Portions</option>
                </select>
	       	</td>
	        <td><input type="text" class="val_8 form-control" name="val_8" style="width:100px;" numberonly></td>
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
		<button type="button" class="btn btn-primary btn-block" id="save_btn" >Save Grn</button>
		<div id="msg_box"></div>	
	    </div>
	</div>
</div>
</div>
</div>
</div>
<script type="text/javascript">
</script>