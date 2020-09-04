<div class="row">
<div class="col-sm-2 col-md-2">
	<div class="row"><div class="col-sm-12 col-md-12"><a href="<?php ROOT?>Pos_home" class="backButton"><i class="fa fa-arrow-circle-left" aria-hidden="true" style="margin-right:2%"></i>Back</a></div></div>
	<?php
	include 'views/common/invoice_right.php';
	?>	
</div>
<div class="col-sm-10 col-md-10">
	<div class="panel panel-info">
	  <div class="panel-heading"><h1><i class="fa fa-newspaper-o" aria-hidden="true" style="margin-right:0.5%; transform: rotate(90deg);"></i>Add invoice</h1></div>
	  <div class="panel-body">
	<form action="" id="" class="form_main" data-parsley-validate=""> 
	 <div class="row">
		 	<div class="col-sm-6 col-md-6">
				 <input type="text" class="form-control index invoicemaster" name="val_1" placeholder="invoice Number" disabled="">
				 <select id="supplierr" data-options="customer customers first_name id"  class="customer form-control getdata_options" name="val_2" required="">
				 </select>
		 	</div>
		 	<div class="col-sm-6 col-md-6">
				 <input type="text" class="form-control datepicker" name="val_3" placeholder="date" required="">
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
	      	<form action="<?php echo ROOT?>Grn_home/addgrn_sub" id="" class="form_sub" data-parsley-validate="">
	        <td><input type="text" class="val_1 form-control" style="width:80px" required="" name="val_1"></td>
	        <td>				 
	        	<select id="stockitems" data-options="stockitems stockitems item_name id"  class="stockitems getdata_options val_2 form-control" name="val_2" required=""></select>
			</td>
	        <td><input type="number" class="val_3 form-control" name="val_3" style="width:100px;" numberonly readonly></td>
	       	<td><input type="number" min="1" numberonly required="" class="val_4 form-control" name="val_4" style="width:100px;" readonly></td>
	        <td><input type="text" readonly class="val_5 form-control" style="width:50px;"></td>
	        <td><input type="text" class="val_8 form-control" name="val_8" numberonly></td>
	        <td><input type="submit" class="btn btn-info form-control" value="Add"></td>
	        </form>
	      </tr>


	    </tbody>
	  </table>
	</div>
	<label>Total&nbsp</label><span class="number_format" id="total_val">0.00</span>
	<!-- <input type="text" readonly="" id="total_val" class="number_format" value="0.00"> -->
  	<div class="row">
  	<div class="col-sm-6 col-md-6">
  		<button type="submit" class="btn btn-warning btn-block" id="print_btn"><p>PRINT VIEW <span class="glyphicon glyphicon-print"></span></p></button>
  	</div>
  	<div class="col-sm-6 col-md-6">
		<!-- <button type="button" class="btn btn-primary btn-block" id="save_btn" ><p>SAVE <span class="glyphicon glyphicon-save"></span></p></button> -->
		<button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal" id="save_btn" ><p>SAVE <span class="glyphicon glyphicon-save"></span></p></button>
	
		<div id="msg_box"></div></div>
	</div>
  </div>

</div>
	</div>
</div>

<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" id="print_btn2"  data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input id="Amount" class="form-control input-cl" type="Amount" name="Amount" value="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> -->
<script type="text/javascript">
</script>