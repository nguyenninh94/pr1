<?php include 'inc/header.php'; ?>

 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
        	<form action="hello" method="get" id="member">
                	<input name="Domain" type="text" value="Username" class="field" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Username';}">
                    <input name="Domain" type="password" value="Password" class="field" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}">
                 </form>
                 <p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
                    <div class="buttons"><div><button class="grey">Sign In</button></div></div>
                    </div>
    	<div class="register_account">
    	<?php
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $userName=$_POST['name'];
                $city=$_POST['city'];
                $zipcode=$_POST['zipcode'];
                $email=$_POST['email'];
                $address=$_POST['address'];
                $country=$_POST['country'];
                $phone=$_POST['phone'];
                $password=$_POST['password'];
                $userInsert=$brand->insertUser($userName,$city, $zipcode,$email,$address,$country,$phone,$password);
}
?>
    		<h3>Register New Account</h3>
    		<form>
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" value="Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}" >
							</div>
							
							<div>
							   <input type="text" name="city" value="City" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'City';}">
							</div>
							
							<div>
								<input type="text" name="zipcode" value="Zip-Code" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Zip-Code';}">
							</div>
							<div>
								<input type="text" name="email" value="E-Mail" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'E-Mail';}">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address"  value="Address" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Address';}">
						</div>
		    		<div>
						<select id="country" name="country" name="country" onchange="change_country(this.value)" class="frm-field required">
							<option value="null">Select a Country</option>         
							<option value="AF">Afghanistan</option>
							<option value="AL">Albania</option>
							<option value="DZ">Algeria</option>
							<option value="AR">Argentina</option>
							<option value="AM">Armenia</option>
							<option value="AW">Aruba</option>
							<option value="AU">Australia</option>
							<option value="AT">Austria</option>
							<option value="AZ">Azerbaijan</option>
							<option value="BS">Bahamas</option>
							<option value="BH">Bahrain</option>
							<option value="BD">Bangladesh</option>
							<option value="BD">VietNam</option>

		         </select>
				 </div>		        
	
		           <div>
		          <input type="text" name="phone" value="Phone" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Phone';}">
		          </div>
				  
				  <div>
					<input type="text" name="password" value="Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><button class="grey">Create Account</button></div></div>
		    <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>