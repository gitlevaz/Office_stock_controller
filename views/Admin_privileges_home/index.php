<div class="row">
<div class="col-sm-2 col-md-2">
	<div class="row"><div class="col-sm-12 col-md-12"><a href="<?php ROOT?>Admin_home" class="backButton"><i class="fa fa-arrow-circle-left" aria-hidden="true" style="margin-right:2%"></i>Back</a></div></div>
	<?php
	include 'views/common/Admin_privileges_right.php';
	?>	
</div>
<div class="col-sm-10 col-md-10">
	<div class="panel panel-info">
	  <div class="panel-heading"><h1><i class="fa fa-user-plus" aria-hidden="true" style="margin-right:0.5%"></i>Add new Profile</h1></div>
	  <div class="panel-body">
	<form action="<?php echo ROOT?>Admin_privileges_home/create" id="form_privileges" class="inv_form index_form">
		<input type="text" class="form-control" placeholder="profile name" name="val_1">
	<div class="row">
	    <div class="col-sm-6 col-md-6"></div>
	    <div class="col-sm-6 col-md-6">
			<input type="submit" value="Create" class="btn btn-primary btn-block">
			<div id="msg_box"></div>
		</div>
	</div>
	</form>
	</div>
	</div>

	<div class="panel panel-info">
	  <div class="panel-body">
		<ul id="profile_list">
			
		</ul>
	  </div>
	  </div>
</div>
</div>
