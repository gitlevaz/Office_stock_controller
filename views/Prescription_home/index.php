<div class="row">
<div class="messagepop pop">
<span class="patient_name">Test</span>
<a class="close close_s rega_cancel" href="/">Close</a>
<div class="row">
    <div id="login_form">
        <br>
    	<div class="row pagin" id="report"> 

		</div>
    </div>
</div>
</div>

<div class="messagepop2 pop2">
<span class="patient_name">Test</span>
<a class="close close_n rega_cancel" href="/">Close</a>
<div class="row">
    <div id="login_form">
        <br>
    	<div class="row pagin" id="report_note"> 

		</div>
    </div>
</div>
</div>



<div class="col-sm-2 col-md-2">
	<div class="row"><div class="col-sm-12 col-md-12"><a href="<?php ROOT?>Pos_home" class="backButton"><i class="fa fa-arrow-circle-left" aria-hidden="true" style="margin-right:2%"></i>Back</a></div></div>
	<?php
	include 'views/common/prescription_right.php';
	?>	
	<br>
    <div class="row">
    	<div class="col-sm-12 col-md-12">
    		<div class="prescriptions">
    			<h4 style="margin-top:0;">Recent Orders</h4>
    		</div>
    	</div>
    </div>
</div>
<div class="col-sm-10 col-md-10">
	<div class="panel panel-info">
	  <div class="panel-heading"><h1><i class="fa fa-newspaper-o" aria-hidden="true" style="margin-right:0.5%; transform: rotate(90deg);"></i>Add Prescription</h1></div>
	  <div class="panel-body">
	<form action="" id="" class="form_main" data-parsley-validate=""> 
	 <input type="hidden" name="localtime" id="localtime">
	 <div class="row">
		 	<div class="col-sm-3 col-md-3">
				 <input type="text" class="form-control index prescriptionmaster" name="val_1" placeholder="Prescription Number" disabled="">
				 <input type="text" class="form-control patient_number" name="val_2" placeholder="Patient Number" tabindex="1">
				 <a href="" class="pt_history">View Client History</a>
		 	</div>
		 	<div class="col-sm-3 col-md-3">
				 <input type="text" class="form-control" name="val_3" placeholder="date" required="" id="demo">
				 <select id="customerselect" data-options="customer customers first_name id Select_Patient first_name"  class="customer form-control getdata_options" name="val_4" required="">
				 </select>
		 	</div>
		 	<div class="col-sm-3 col-md-3">
				 <input type="text" class="form-control patient_age" name="val_5" placeholder="age" disabled="">
				 <input type="text" class="form-control patient_weight" name="val_6" placeholder="weight" disabled="">
		 	</div>
		 	<div class="col-sm-3 col-md-3">
		 	     <textarea  class="form-control" rows="3" placeholder="note" name="val_7"></textarea>
		 	     <a href="" class="pt_nots">View Notes</a>
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
	        <th style="width:25%;">Drug Name</th>
	        <th style="width:8%;">Qty</th>
	        <th style="width:10%;">Dosage</th>
	        <th style="width:6%;"></th>
	        <th style="width:10%;"></th>
	        <th style="width:10%;">Days</th>
	        <th style="width:10%;">Weeks</th>
	        <th style="width:10%;">Months</th>
	        <th style="width:10%;">Total</th>
	        <th></th>
	      </tr>
	    </thead>
	    <tbody>
	      <tr class="info" id="maintabletop">
	      	<form action="<?php echo ROOT?>Grn_home/addgrn_sub" id="" class="form_sub" data-parsley-validate="">
	      	<input type="hidden" class="check_sta" value="" name="" numberonly>
	        <td>				 
		 		<input list="item_name_list" autocomplete="off" class="form-control inner_text" name="itemName" id="itemName" style="width:100%;" required tabindex="2">
                <datalist id="item_name_list">
                <?php
                 $data=$this->list;
                 foreach ($data as $value) {
                 	echo "<option value='".$value['item_name']."' data-value='".$value['id']."'>";
                 }
                 
                ?>

                </datalist>
			</td>
			<td>
			<input type="number" class="form-control val8 pres_val8" name="" readonly style="padding-left:5px;padding-right:0px;">
			</td>
	        <td><input type="number" class="form-control val4" name="" numberonly tabindex="3"></td>
	        <td><input type="text" class="form-control val5" name="" numberonly readonly="" style="width:80px;"></td>
	        <td><select class="form-control val6" tabindex="4">
	        		<option value=""></option>
	        		<option value="2">bd</option>
	        		<option value="3">tds</option>
	        		<option value="1">mane</option>
	        		<option value="1">Noct</option>
	        		<option value="4">6h</option>
	        		<option value="0">stat</option>
	        		<option value="0">s.o.s</option>
	        		</select>
	        		</td>
	        <td><input type="number" id="vald1" class="form-control val1 validates" name="" style="width:100px;" tabindex="5" numberonly></td>
	       	<td><input type="number" id="vald2" class="form-control val2 validates" name="" style="width:100px;" numberonly required="" ></td>
	        <td><input type="number" id="vald3" class="form-control val3 validates"></td>
	        <td><input type="text" class="form-control val7" name="" numberonly readonly="" required=""></td>
	        <td><input type="submit" class="btn btn-info form-control sub_btn" value="Add" tabindex="6"></td>
	        </form>
	      </tr>


	    </tbody>
	  </table>
	</div>
	<label>Total&nbsp</label><span class="number_format" id="total_val">0.00</span>
	<!-- <input type="text" readonly="" id="total_val" class="number_format" value="0.00"> -->
  	<div class="row">
  	<div class="col-sm-6 col-md-6">
  		<button type="button" class="btn btn-warning btn-block" id="print_btn"><p>PRINT VIEW <span class="glyphicon glyphicon-print"></span></p></button>
  	</div>
  	<div class="col-sm-6 col-md-6">
		<button type="button" class="btn btn-primary btn-block" id="save_btn" tabindex="7"><p>SAVE <span class="glyphicon glyphicon-save"></span></p></button>
		<div id="msg_box"></div></div>
	</div>
  </div>

</div>
	</div>
</div>
<script type="text/javascript">
</script>