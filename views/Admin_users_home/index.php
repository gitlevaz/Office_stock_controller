<div class="row">
<div class="col-sm-2 col-md-2">
	<div class="row"><div class="col-sm-12 col-md-12"><a href="<?php ROOT?>Admin_home" class="backButton"><i class="fa fa-arrow-circle-left" aria-hidden="true" style="margin-right:2%"></i>Back</a></div></div>
	<?php
	include 'views/common/admin_user_right.php';
	?>	
</div>
<div class="col-sm-10 col-md-10">
	<div class="panel panel-info">
	  <div class="panel-heading"><h1><i class="fa fa-user-plus" aria-hidden="true" style="margin-right:0.5%"></i>Add new user</h1></div>
	  <div class="panel-body">
	<form action="<?php echo ROOT?>Admin_users_home/create" id="form_login" class="user_form" data-parsley-validate="">
		 <input type="email" class="form-control" name="val_1" placeholder="email" required="">
		 <input type="text"  class="form-control" name="val_2" placeholder="User name" required="">
		 <select class="form-control" name="val_5">
		 	<?php
		 		foreach ($this->privs as $value) {
		    ?>
		    <option value=<?php echo $value['id']?> ><?php echo $value['name']?></option>
		    <?php
		 		}
		 	?>
		 </select>
		 <input type="text"  class="form-control" name="val_3" id="password" placeholder="password" required="">
		 <input type="text"  class="form-control" name="val_4" id="conf_password" placeholder="confirm password" required="">
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
</div>
</div>
