<div class="row">
	<div class="col-md-4 col-sm-4"></div>
	<div class="col-md-4 col-sm-4">
	<div class="panel panel-default">
  		<div class="panel-body">
  		<p><strong>Log In</strong></p>
		<form action="<?php echo ROOT?>home/logIn" id="form_login" class="inv_form index_form">
		    <input class="inv_input index_input form-control" type="text" name="userName" placeholder="USERNAME">
		    <br>
	     	<input class="inv_input index_input form-control" type="password" name="passWord" placeholder="PASSWORD">
	     	<div id="msg_box"></div>
	     	<br>
	     	<button type="submit" class="btn btn-primary btn-block inv_submit index_submit">Login</button>
		</form>
	    </div>
	</div>
	</div>
	<div class="col-md-4 col-sm-4"></div>
</div>