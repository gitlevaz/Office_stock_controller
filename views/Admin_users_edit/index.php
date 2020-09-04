<div class="row">
<div class="col-sm-2 col-md-2">
	<div class="row"><a href="<?php ROOT?>Admin_home" class="backButton"><i class="fa fa-arrow-circle-left" aria-hidden="true" style="margin-right:2%"></i>Back  </a></div>
	<?php
	include 'views/common/admin_user_right.php';
	?>	
</div>
<div class="col-sm-10 col-md-10">
	<div class="panel panel-info">
	  <div class="panel-heading"><h1><i class="fa fa-pencil" aria-hidden="true" style="margin-right:0.5%"></i>Edit user</h1></div>
	  <div class="panel-body">
	<form action="<?php echo ROOT?>Admin_users_edit/save" id="form_login" class="user_form" data-parsley-validate="">
		<?php
		?>
		 <input type="hidden" name="val_x" class="ed_val_x">
		 <input type="email" class="form-control ed_val_1" name="val_1" placeholder="email" required="">
		 <input type="text"  class="form-control ed_val_2" name="val_2" placeholder="User name" required=""> 
		 <select class="form-control ed_val_3" name="val_5"> 
		 	<?php
		 		foreach ($this->privs as $value) {
		 			$che=null;
		    ?>
		    <option value='<?php echo $value['id'];?>' <?php echo $che;?>><?php echo $value['name'];?></option>
		    <?php
		   }
		 	?>
		 </select>
		 <input type="text"  class="form-control ed_val_4" name="val_6" id="old_password" placeholder="old password" required="">
		 <input type="password"  class="form-control" name="val_3" id="password" placeholder="new password" required="">
		 <input type="password"  class="form-control" name="val_4" id="conf_password" placeholder="confirm password" required="">
		 

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
		<div class="row">
        <div class=" pagin col-sm-12 col-md-12">
        	
        </div>
        </div>
</div>
</div>
