<div class="row">
	<div class="col-sm-2 col-md-2">
		<div class="row"><div class="col-sm-12 col-md-12"><a href="<?php ROOT?>Reports_home" class="backButton">Back</a></div></div>
		<?php
		//include 'views/common/Inventory_home.php';
		?>	
	</div>
	<div class="col-sm-10 col-md-10">
	    <div class="panel panel-info">
		  <div class="panel-heading"><h1>Prescriptions</h1></div>
		   <div class="panel-body">
				<div class="row search_types">
					<div class="col-sm-8 col-md-8">
						<input type="text" placeholder="form" class="datepicker date_from">
						<input type="text" placeholder="to" class="datepicker date_to">
						<input type="text" placeholder="Prescription Number" class="prescrip_no">
						<input type="Button" class="search_btn" value="Search">
						<label><div id="msg_box"></div></label>	
					</div>
					<div class="col-sm-4 col-md-4">
						<div class="indic indic1">Pending items</div>
						<div class="indic indic2">Issued items</div>
					</div>
				</div>
				<div class="row pagin" id="report"> 

				</div>
		   </div>
		</div>
	</div>
</div>
