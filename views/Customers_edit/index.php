<style type="text/css">

</style>

<div class="row">
<div class="col-sm-2 col-md-2">
	
	<div class="row">
	<div class="col-sm-12 col-md-12"><a href="<?php ROOT?>Inventory_home" class='backButton'><i class="fa fa-arrow-circle-left" aria-hidden="true" style="margin-right:2%"></i>
    <strong> Back</strong></a></div></div>
	
	<div class="row">
    <div class="col-sm-12 col-md-12">
	<?php
	include 'views/common/customer_right.php';
	?>	
	</div>
	</div>
</div>
<div class="col-sm-10 col-md-10">
	<div class="row">
    <div class="col-sm-12 col-md-12">
    <div class="panel panel-info">
	  <div class="panel-heading"><h1><i class="fa fa-pencil" aria-hidden="true" style="margin-right:0.5%"></i>Edit Customers</h1></div>
	  <div class="panel-body">
		<form action="<?php echo ROOT?>Customers_edit/edit" id="" class="customer_form" data-parsley-validate=""> 
		 <input type="hidden" value="" class="hidden_val1" name="hidden_val1">
		 <div class="row">
			 	<div class="col-sm-6 col-md-6">
			 	<input type="text" class="form-control ed_val_14" name="" placeholder="Client No" disabled="">
					 <input type="text" class="form-control ed_val_1" name="val_1" placeholder="first name" required="">
					 <input type="text" class="form-control ed_val_3" name="val_3" placeholder="address">
					 <input type="text" class="form-control ed_val_5" name="val_5" placeholder="email">
<label>Date of birth</label>					
<select name="val_11" class="ed_val_11 agecal age_month">
	<option value="00"> - Month - </option>
	<option value="01">January</option>
	<option value="02">Febuary</option>
	<option value="03">March</option>
	<option value="04">April</option>
	<option value="05">May</option>
	<option value="06">June</option>
	<option value="07">July</option>
	<option value="08">August</option>
	<option value="09">September</option>
	<option value="10">October</option>
	<option value="11">November</option>
	<option value="12">December</option>
</select>

<select name="val_12" class="ed_val_12 agecal age_day">
	<option value="00"> - Day - </option>
	<option value="01">1</option>
	<option value="02">2</option>
	<option value="03">3</option>
	<option value="04">4</option>
	<option value="05">5</option>
	<option value="06">6</option>
	<option value="07">7</option>
	<option value="08">8</option>
	<option value="09">9</option>
	<option value="10">10</option>
	<option value="11">11</option>
	<option value="12">12</option>
	<option value="13">13</option>
	<option value="14">14</option>
	<option value="15">15</option>
	<option value="16">16</option>
	<option value="17">17</option>
	<option value="18">18</option>
	<option value="19">19</option>
	<option value="20">20</option>
	<option value="21">21</option>
	<option value="22">22</option>
	<option value="23">23</option>
	<option value="24">24</option>
	<option value="25">25</option>
	<option value="26">26</option>
	<option value="27">27</option>
	<option value="28">28</option>
	<option value="29">29</option>
	<option value="30">30</option>
	<option value="31">31</option>
</select>

<select name="val_13" class="ed_val_13 agecal age_year">
	<option value="" class="now_year"> - Year - </option>
	<option value="2020">2020</option>
	<option value="2019">2019</option>	
	<option value="2018">2018</option>
	<option value="2017">2017</option>
	<option value="2016">2016</option>
	<option value="2015">2015</option>
	<option value="2014">2014</option>
	<option value="2013">2013</option>
	<option value="2012">2012</option>
	<option value="2011">2011</option>
	<option value="2010">2010</option>
	<option value="2009">2009</option>
	<option value="2008">2008</option>
	<option value="2007">2007</option>
	<option value="2006">2006</option>
	<option value="2005">2005</option>
	<option value="2004">2004</option>	
	<option value="2003">2003</option>
	<option value="2002">2002</option>
	<option value="2001">2001</option>
	<option value="2000">2000</option>
	<option value="1999">1999</option>
	<option value="1998">1998</option>
	<option value="1997">1997</option>
	<option value="1996">1996</option>
	<option value="1995">1995</option>
	<option value="1994">1994</option>
	<option value="1993">1993</option>
	<option value="1992">1992</option>
	<option value="1991">1991</option>
	<option value="1990">1990</option>
	<option value="1989">1989</option>
	<option value="1988">1988</option>
	<option value="1987">1987</option>
	<option value="1986">1986</option>
	<option value="1985">1985</option>
	<option value="1984">1984</option>
	<option value="1983">1983</option>
	<option value="1982">1982</option>
	<option value="1981">1981</option>
	<option value="1980">1980</option>
	<option value="1979">1979</option>
	<option value="1978">1978</option>
	<option value="1977">1977</option>
	<option value="1976">1976</option>
	<option value="1975">1975</option>
	<option value="1974">1974</option>
	<option value="1973">1973</option>
	<option value="1972">1972</option>
	<option value="1971">1971</option>
	<option value="1970">1970</option>
	<option value="1969">1969</option>
	<option value="1968">1968</option>
	<option value="1967">1967</option>
	<option value="1966">1966</option>
	<option value="1965">1965</option>
	<option value="1964">1964</option>
	<option value="1963">1963</option>
	<option value="1962">1962</option>
	<option value="1961">1961</option>
	<option value="1960">1960</option>
	<option value="1959">1959</option>
	<option value="1958">1958</option>
	<option value="1957">1957</option>
	<option value="1956">1956</option>
	<option value="1955">1955</option>
	<option value="1954">1954</option>
	<option value="1953">1953</option>
	<option value="1952">1952</option>
	<option value="1951">1951</option>
	<option value="1950">1950</option>
	<option value="1949">1949</option>
	<option value="1948">1948</option>
	<option value="1947">1947</option>
	<option value="1946">1946</option>
	<option value="1945">1945</option>
	<option value="1944">1944</option>
	<option value="1943">1943</option>
	<option value="1942">1942</option>
	<option value="1941">1941</option>
	<option value="1940">1940</option>
	<option value="1939">1939</option>
	<option value="1938">1938</option>
	<option value="1937">1937</option>
	<option value="1936">1936</option>
	<option value="1935">1935</option>
	<option value="1934">1934</option>
	<option value="1933">1933</option>
	<option value="1932">1932</option>
	<option value="1931">1931</option>
	<option value="1930">1930</option>
	<option value="1929">1929</option>
	<option value="1928">1928</option>
	<option value="1927">1927</option>
	<option value="1926">1926</option>
	<option value="1925">1925</option>
	<option value="1924">1924</option>
	<option value="1923">1923</option>
	<option value="1922">1922</option>
	<option value="1921">1921</option>
	<option value="1920">1920</option>
	<option value="1919">1919</option>
	<option value="1918">1918</option>
	<option value="1917">1917</option>
	<option value="1916">1916</option>
	<option value="1915">1915</option>
	<option value="1914">1914</option>
	<option value="1913">1913</option>
	<option value="1912">1912</option>
	<option value="1911">1911</option>
	<option value="1910">1910</option>
	
</select>
	<div class="age_cal"></div>
	 <!-- <input type="text" class="form-control ed_val_9" name="val_9" placeholder="weight Kg"> -->
			 	</div>
			 	<div class="col-sm-6 col-md-6">
					 <input type="text" class="form-control ed_val_2" name="val_2" placeholder="last name">
					 <input type="text" class="form-control ed_val_4" name="val_4" placeholder="contact No">
					 <!-- <input type="number" class="form-control ed_val_10 age_year_set" name="val_10" placeholder="age years" numberonly> -->
					 <!-- <input type="number" class="form-control ed_val_6" name="val_6" placeholder="height Cm" numberonly> -->
					 <input type="text" class="form-control ed_val_8" name="val_8" placeholder="account No" style="display:none">
		           	 <span><strong>Gender</strong></span>
					 <label class="radio-inline"><input type="radio" name="val_14" class="male" value="m" checked>Male</label>
					 <label class="radio-inline"><input type="radio" name="val_14" class="female" value="f">Female</label>
			 	</div>
		 </div>
		 <div class="row">
			<div class="col-sm-6 col-md-6"></div>
		    <div class="col-sm-6 col-md-6">
		    <div id="msg_box"></div>
			<input type="submit" value="Save" class="btn btn-primary btn-block">
			</div>
		 </div>
		</form>
</div></div>

		<div class="row">
			<div class="col-sm-4 col-md-4">
			<input type="text" placeholder="keyword" class="search_key"> <label><div id="msg_box"></div>
				<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
			</div>
			<div class="col-sm-4 col-md-4">
			</div>
			<div class="col-sm-4 col-md-4">		
			</div>
		</div>
		<div class="row" id="container">
	        <div class="col-sm-12 col-md-12 pagin">
	        	
	        </div>
	    </div>
</div>
</div>