<h2 style="color:red">Do not Change This Code !!!!!!!!!!!!!!!!!</h2>

<div>
	<p>Create new root for</p>
	<form action="<?php ROOT;?>creative/create" method="post" id="create_root">
	 <label>Root Name</label><input type="text" name="val_1">
	 <input type="submit" value="Create">		
	</form>

	<p>Create new funtion for model</p>
	    <input type="hidden" value="<?php ROOT;?>creative/genarate_model" id="url_2">
	    <label>Select Model</label><input type="text" id="model">
    	<label>Select table base</label><select id="base_table">
    		<option>Select</option>
    		<?php
                $tables=$this->tables;
    			foreach ($tables as $key => $value) {
    			?>
    			<option><?echo $value['Tables_in_Office'];?></option>
    			<?php
    			}
    		?>
    	</select>
    	<label>Select Transaction Type</label><select id="type"><option>Select</option><option value="1">Insert</option><option value="2">Update</option><option value="3">Delete</option><option value="4">Derect Query</option></select>
        <input type="button" value="Submit" id='genarate_model'>
</div>